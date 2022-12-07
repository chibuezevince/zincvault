<?php

namespace App\Http\Controllers\Admin;

use app\Models\User;
use App\Mail\SignupMail;
use App\Mail\ProfileMail;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use Illuminate\Support\Carbon;
use App\Mail\AdminTransferMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    
    public function diplayAllUsers()
    {
        return view('admin.users.all',['users'=>User::where('type', 2)->latest()->paginate(10)]);
    }

    public function displayUserPage(User $id){
        if(request()->session()->has('id')){
            session()->forget('id');
            request()->session()->put(['id'=>$id]);
        }else{
            request()->session()->put(['id'=>$id]);
        }
        return view('admin.users.single', ['user'=>$id, 'user_details'=>customer_details($id->username)]);
    }

    public function diplayUserDetail(User $id)
    {
        return view('admin.users.view', ['user'=>$id, 'user_details'=>customer_details($id->username)]);
    }

    public function uploadAvatar(){
        $data = Validator::make(request()->all(), [
            'avatar' => 'required|mimes:jpeg,jpg,png,gif|max:3072',
        ]);
        
        if ($data->fails()) 
        {
            return response()->json(['avatar' => $data->errors()->all()]);
        } 
        else
        {
            $user = request()->session()->get('id');
            $all = $data->validated();
            $file = $all['avatar'];
            $user_image = $user->id.'-'.$file->getClientOriginalName();
            if (File::exists($user_image)) 
            {
                File::delete($user_image);
                $path = $file->move('avatars', $user->id.'-'.$file->getClientOriginalName());
                UserDetail::firstWhere(['username' => $user->username])->update(['profile_image'=>asset($path)]);
                return response()->json(['avatar' => 'File Uploaded Successfully']);
            }
            else
            {
                $path = $file->move('avatars', $user->id.'-'.$file->getClientOriginalName());
                UserDetail::firstWhere(['username' => $user->username])->update(['profile_image'=>asset($path)]);
                return response()->json(['avatar' => 'File Uploaded Successfully']);
            }
        }
    }

    public function updateBasicInfo(Request $request)
    {
        $user = request()->session()->get('id');
        $basic_info = Validator::make($request->all(), [
            'fullname' => 'required|min:2|max:255',
            'phone_number' => 'required|numeric|min:10unique:users,phone_number,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'country' => 'required',
            'address' => 'required',
        ], [
            'phone_number.min' => "The phone number must be at least 10 digits",
        ]);

        if($basic_info->fails())
        {
            return response()->json([
                'errors'=> $basic_info->errors()->all(),
            ]);
        }
        else
        {
            $basic_info = $basic_info->validated();
            $currentUser = User::firstWhere('username', $user->username);

            $currentUser->update([
                'name' => $basic_info['fullname'],
                'phone_number' => $basic_info['phone_number'],
                'email' => $basic_info['email'],
            ]);

            UserDetail::firstWhere(['username' => $user->username])->update([
            'address'=>$basic_info['address'], 
            'country' => $basic_info['country'],
            ]);
            $current_user = $currentUser;
            if(request('send_mail')){
            Mail::to($current_user->email)->send(new ProfileMail($user));
            }
            return response()->json(['success'=> 'Profile Updated Sucessfully']);
        }
    }

    public function updatePassword(){
        $password_details = Validator::make(request()->all(),[
            'currentPassword' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        if($password_details->fails())
        {
            return response()->json([
                'errors'=> $password_details->errors()->all(),
            ]);
        }
        $user = request()->session()->get('id');
        $password_details = $password_details->validated();
        $user = User::firstWhere('username', $user->username);
        if (Hash::check($password_details['currentPassword'], $user->password)) 
        {   
            $user->update([
                'password' => Hash::make($password_details['password']),
            ]);

            Mail::to($user->email)->send(new ProfileMail($user));
            return response()->json(['password_changed'=>'Password changed']);
        }
        else
        {
            return response()->json(['errors'=>['Incorrect Password']]);
        }
    }

    public function creditOrDebit(){
        $details = Validator::make(request()->all(), [
            'cred_deb' => 'required',
            'currency' => 'required',
            'amount' =>  ['required','numeric'],
            'note' => ['required'],
        ]);
        if ($details->fails()) {
            return response()->json(['errors'=>$details->errors()->all()]);
        }
        $user = request()->session()->get('id');
        $user_detail = customer_details($user->username);

        $details = $details->validated();
        $details['receiver_account_number'] = $user->account_number;
        $details['username'] = $user->username;        
        $details['sender'] = 'Administrator';
        $currency = $details['currency'].'_balance'; 

        if ($details['cred_deb']=="Debit") 
        {
            if($user_detail->$currency < $details['amount'])
            {
                return response()->json(['errors'=>['Amount to be debited is greater than Account Balance']]);
            }
            else
            {
                //Decrement User
                $user_detail->decrement($currency, $details['amount']);
                TransactionLog::create([
                    'username' => $user->username,
                    'type' => 'Local Transfer',
                    'cred_deb' => 'Debit',
                    'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                    'status' => 1,
                    'amount'=> $details['amount'] ,
                    'currency'=>$details['currency'],
                    'reason' => $details['note'],
                    'local_details' => $details,
                    'transaction_id' => rand(100000000, 999999999),
                ]);
                if(request('send_email')){
                    Mail::to($user->email)->send(new AdminTransferMail('Debit', $details, $user, $user_detail->$currency));
                }
                return response()->json(['success'=>'User Debited Successfully']);
            }
        }
        if($details['cred_deb']=="Credit") 
        {
            //Increment User
            $user_detail->increment($currency, $details['amount']);
            TransactionLog::create([
                'username' => $user->username,
                'type' => 'Local Transfer',
                'cred_deb' => 'Credit',
                'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                'status' => 1,
                'amount'=> $details['amount'] ,
                'currency'=>$details['currency'],
                'reason' => $details['note'],
                'local_details' => $details,
                'transaction_id' => rand(100000000, 999999999),
            ]);
            if(request('send_email')){
                Mail::to($user->email)->send(new AdminTransferMail('Credit', $details, $user, $user_detail->$currency));
            }
            return response()->json(['success'=>'User Credited Successfully']);
        }
    }

    public function activateDeactivateUsers()
    {
        $user = request()->session()->get('id');
        $user_detail = User::where('username', $user->username);
        
        if(request()->deactivateAccount == 1)
        {
            $user_detail->update([
                'is_active' => 0
            ]);
            return back()->with(['account_success'=> 'User Deactivated Successfully']);
        }
        else
        {
            $user_detail->update([
                'is_active' => 1
            ]);
            return back()->with(['account_success'=> 'User Activated Successfully']);
        }
    }

    public function displayUserRegistrationPage()
    {
        return view('admin.users.create');
    }

    public function createUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number'=>['required', 'numeric', 'min:15', 'unique:users'],
            'username'=>['required', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'account_type' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);

        $now = Carbon::now();
        $account_number = $now->year.$now->month.$now->day.random_int(100, 999);
        UserDetail::create([
            'username'=> $data['username'],
            'profile_image' => asset('assets\uploads\default.jpg'),
            'tac'=> random_int(1000, 9999),
            'tax'=> random_int(1000, 9999),
            'imf'=> random_int(1000, 9999),
            'pound_balance'=> 0.00,
            'dollar_balance'=>0.00,
            'euro_balance'=>0.00,
            'account_number'=>$account_number,
            'account_type'=> $data['account_type'],
            'gender' => $data['gender'],
        ]);
        $user = UserDetail::firstWhere('username', $data['username']);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'username'=>$data['username'],
            'password' => Hash::make($data['password']),
            'account_number' => $user->account_number,
        ]);
        $userDetails = User::firstWhere('email', $data['email']);
        if($request->verifyUser==1)
        {
            $userDetails->markEmailAsVerified();
        }
        Mail::to($data['email'])->send(new SignupMail($data));
        return back()->with('success', 'User Registered Successfully, Login Details Sent to Email');
    }
}

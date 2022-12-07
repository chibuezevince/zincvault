<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ProfileMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function displayProfilePage()
    {
        return view('dashboard.profile');
    }

    //Upload Avatar
    public function uploadAvatar(Request $request)
    {
        $data = Validator::make($request->all(), [
            'avatar' => 'required|mimes:jpeg,jpg,png,gif|max:3072',
        ]);
        
        if ($data->fails()) 
        {
            return response()->json(['avatar' => $data->errors()->all()]);
        } 
        else
        {
            $all = $data->validated();
            $file = $all['avatar'];
            $user_image = user()->id.'-'.$file->getClientOriginalName();
            if (File::exists($user_image)) 
            {
                File::delete($user_image);
                $path = $file->move('avatars', user()->id.'-'.$file->getClientOriginalName());
                UserDetail::firstWhere(['username' => user()->username])->update(['profile_image'=>asset($path)]);
                return response()->json(['avatar' => 'File Uploaded Successfully']);
            }
            else
            {
                $path = $file->move('avatars', user()->id.'-'.$file->getClientOriginalName());
                UserDetail::firstWhere(['username' => user()->username])->update(['profile_image'=>asset($path)]);
                return response()->json(['avatar' => 'File Uploaded Successfully']);
            }
        }
        
    }

    //Update Basic Information
    public function updateBasicInformation(Request $request)
    {
        $basic_info = Validator::make($request->all(), [
            'fullname' => 'required|min:2|max:255',
            'phone_number' => 'required|numeric|min:10|unique:users,phone_number,'.user()->id,
            'email' => 'required|unique:users,email,'.user()->id,
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
            $currentUser = User::firstWhere('username', user()->username);

            $currentUser->update([
                'name' => $basic_info['fullname'],
                'phone_number' => $basic_info['phone_number'],
                'email' => $basic_info['email'],
            ]);

            UserDetail::firstWhere(['username' => user()->username])->update([
            'address'=>$basic_info['address'], 
            'country' => $basic_info['country'],
            ]);
            $current_user = $currentUser;
            Mail::to(user()->email)->send(new ProfileMail($current_user));
            return response()->json(['success'=> 'Profile Updated Sucessfully']);
        }
    }

    public function updatePassword(Request $request)
    {
        $password_details = Validator::make($request->all(),[
            'currentPassword' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        if($password_details->fails())
        {
            return response()->json([
                'errors'=> $password_details->errors()->all(),
            ]);
        }
        $password_details = $password_details->validated();
        $user = User::firstWhere('username', user()->username);
        if (Hash::check($password_details['currentPassword'], user()->password)) 
        {   
            $user->update([
                'password' => Hash::make($password_details['password']),
            ]);

            Mail::to(user()->email)->send(new ProfileMail($user));
            return response()->json(['password_changed'=>'Password changed']);
        }
        else
        {
            return response()->json(['incorrect_password'=>'Incorrect Password']);
        }
    }
}

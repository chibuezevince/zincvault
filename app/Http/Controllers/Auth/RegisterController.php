<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SignupMail;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required', 'numeric', 'min:15', 'unique:users'],
            'username'=>['required', 'max:255', 'unique:users','alpha_dash',],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'account_type' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
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
         $registerUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'username'=>$data['username'],
            'password' => Hash::make($data['password']),
            'account_number' => $user->account_number,
            'email_verified_at'=> Carbon::now(),
        ]);
     
        $userDetails = User::firstWhere('email', $data['email']);
        //Mail::to($data['email'])->send(new SignupMail($userDetails));
        return $registerUser;
    }
}

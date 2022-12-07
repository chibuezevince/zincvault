<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Mail\AdminTransferMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LocalTransferController extends Controller
{
    public function displayLocalTransferPage()
    {
        return view("admin.transfer");
    }

    public function sendAdminLocalTransaction()
    {
        $data = Validator::make(request()->all(), [
            'amount' => 'required|numeric',
            'receiver_account_number' => 'required|numeric',
            'note' => 'required|max:255',
            'currency'=>'required',
            'cred_deb' => 'required'
        ]);
        if ($data->fails()) {
            return response()->json(['errors'=>$data->errors()->all()]);
        }
        $data = $data->validated();
        $user = User::firstWhere('account_number', $data['receiver_account_number']);
        $user_detail = customer_details($user->username);
        $data['username'] = $user->username;
        $data['sender'] = 'Administrator';

        $currency = $data['currency'].'_balance'; 
        
        if ($data['cred_deb']=="Debit") 
        {
            if($user_detail->$currency < $data['amount'])
            {
                return response()->json(['errors'=>['Amount to be debited is greater than Account Balance']]);
            }
            else
            {
                //Decrement User
                $user_detail->decrement($currency, $data['amount']);
                TransactionLog::create([
                    'username' => $user->username,
                    'type' => 'Local Transfer',
                    'cred_deb' => 'Debit',
                    'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                    'status' => 1,
                    'amount'=> $data['amount'] ,
                    'currency'=>$data['currency'],
                    'reason' => $data['note'],
                    'local_details' => $data,
                    'transaction_id' => rand(100000000, 999999999),
                ]);
                if(request('send_email')){
                    Mail::to($user->email)->send(new AdminTransferMail('Debit', $data, $user, $user_detail->$currency));
                }
                return response()->json(['success'=>'User Debited Successfully']);
            }
        }
        if($data['cred_deb']=="Credit") 
        {
            //Increment User
            $user_detail->increment($currency, $data['amount']);
            TransactionLog::create([
                'username' => $user->username,
                'type' => 'Local Transfer',
                'cred_deb' => 'Credit',
                'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                'status' => 1,
                'amount'=> $data['amount'] ,
                'currency'=>$data['currency'],
                'reason' => $data['note'],
                'local_details' => $data,
                'transaction_id' => rand(100000000, 999999999),
            ]);
            if(request('send_email')){
                Mail::to($user->email)->send(new AdminTransferMail('Credit', $data, $user, $user_detail->$currency));
            }
            return response()->json(['success'=>'User Credited Successfully']);
        }
    }
}

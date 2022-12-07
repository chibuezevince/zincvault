<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use App\Mail\LocalTransfer;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\Mail;

class LocalTransferController extends Controller
{

    public function displayLocalTransferPage()  {
        return view('dashboard.transfer.local', ['now'=>Carbon::now('Africa/Lagos')->format('l, d F, Y')]);
    }

    public function validateTransferInput(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'receiver_account_number' => 'required|numeric',
            'reason' => 'required|max:255',
            'currency'=>'required',
        ], [
            'reason.required' => "This field is required",
        ]);

        $data['username'] = user()->username;
        $user_details = UserDetail::firstWhere('id', user()->id);
        $user = User::firstWhere('id', user()->id);
        $receiver_details = UserDetail::firstWhere('account_number', $data['receiver_account_number']);
        $receiver = User::firstWhere('account_number', $data['receiver_account_number']);


        if ($receiver_details === null)
        {
            return back()->withErrors(['receiver_account_number'=> 'User account not found'])->withInput();
        }
        
        if($data['currency']=="dollar")
        {
            if(user_details()->dollar_balance < chargedAmount($data['amount']))
            {
                return back()->withErrors(['amount'=> 'Insufficient '.$data['currency'].' Balance'])->withInput();
            }
        }
        elseif($data['currency']=="pound")
        {
            if(user_details()->pound_balance < chargedAmount($data['amount']))
            {
                return back()->withErrors(['amount'=> 'Insufficient '.$data['currency'].' Balance'])->withInput();
            }
        }
        elseif($data['currency']=="euro")
        {
            if(user_details()->euro_balance < chargedAmount($data['amount']))
            {
                return back()->withErrors(['amount'=> 'Insufficient '.$data['currency'].' Balance'])->withInput();
            }
        }
        if( $data['amount'] == 0)
        {
            return back()->withErrors(['amount'=> 'Invalid Amount'])->withInput();
        }
        // elseif(user_details()->account_number == $data['receiver_account_number'])
        // {
        //     return back()->withErrors(['receiver_account_number'=> 'Invalid Account Number'])->withInput();
        // }
        else
        {
            //Increment and Decrement Users
            $receiver_details->increment($data['currency'].'_balance', $data['amount']);
            $user_details->decrement($data['currency'].'_balance', chargedAmount($data['amount']));

           //Debit Alert
           Mail::to($user->email)->send(new LocalTransfer('Debit Alert', "Debit", $receiver, $receiver_details, $data));
           //Credit Alert
           Mail::to($receiver->email)->send(new LocalTransfer('Credit Alert', "Credit", $receiver, $receiver_details, $data));
           
           //Debit Log
           TransactionLog::create([
            'username'=>$data['username'],
            'type'=>'Local Transfer',
            'cred_deb'=>'Debit',
            'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
            'status' => 1,
            'amount'=>chargedAmount($data['amount']),
            'currency'=>$data['currency'],
            'reason' => $data['reason'],
            'local_details' => $data,
            'transaction_id' => rand(100000000, 999999999),
        ]);

        //Credit Log
        TransactionLog::create([
            'username'=>$receiver_details->username,
            'type'=>'Local Transfer',
            'cred_deb'=>'Credit',
            'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
            'status' => 1,
            'amount'=>$data['amount'],
            'currency'=>$data['currency'],
            'reason' => $data['reason'],
            'local_details' => $data,
            'transaction_id' => rand(100000000, 999999999),
        ]);

            $latest = TransactionLog::firstWhere(['username'=> $data['username'], 'cred_deb' => 'Debit']);
            return redirect()->route('dashboard.local_transfer')->with([
                'success'=>'Money Transferrred Successfully', 'view'=>'view receipt', 'transaction_pdf' => $latest->transaction_id
            ]);           
        }
    }

    public function showReceiverName(Request $request)
    {
        $receiver_account_number = $request->data;
        $receiver_details = User::firstWhere('account_number', $receiver_account_number);
        if ($receiver_details != null)
        {
            return response()->json(['test'=>$receiver_details->name]);   
        }
        else
        {
            return response()->json(['test'=>'User does not exist', ]);
        }
    }


    public function displayLocalConfirmPage()
    {
        if(request()->session()->has(['user','chargedAmount']))
        {
            return view('dashboard.transfer.localconfirm');
        }
        else
        {
            return redirect(route('dashboard.local_transfer'));
        }
    }


    public function displayProfilePage()
    {
        return view('dashboard.profile');
    }
}
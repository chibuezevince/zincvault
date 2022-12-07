<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Http\Controllers\Controller;
use App\Mail\InternationalTransferMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InternationalTransferController extends Controller
{
    //Display International Transfer Page
    public function displayInternationaTransferPage()
    {
        return view('dashboard.transfer.international');
    }

    public function processInternationaTransfer(Request $request)
    {
    $international_info = Validator::make($request->all(), 
    [
        'beneficiary_name' => 'required',
        'beneficiary_acc_num' => 'required|numeric',
        'beneficiary_bank' => 'required',
        'beneficiary_swiftcode' => 'required',
        'routing_transit_no' => 'required',
        'currency' => 'required',
        'amount' => 'required|numeric',
        'note' => 'required',
    ]
    );

        if($international_info->fails())
        {
            return response()->json(['errors'=>$international_info->errors()->all()]);
        }
        $info = $international_info->validated();
        $balance = $info['currency'].'_balance';
        if(user_details()->$balance < InternationalAmount($info['amount']))
        {
            return response()->json(['insufficient_amount'=>'Insufficient Amount']);
        }
        else
        {
            user_db()->decrement($balance, InternationalAmount($info['amount']));
            TransactionLog::create([
                'username' => user()->username,
                'type' => 'International Transfer',
                'cred_deb' => 'Debit',
                'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                'status' => 2,
                'amount'=>InternationalAmount($info['amount']),
                'currency'=>$info['currency'],
                'reason' => $info['note'],
                'inter_details' => $info,
                'transaction_id' => rand(100000000, 999999999),
            ]);
            Mail::to(user()->email)->send(new InternationalTransferMail($info, 'user'));
            Mail::to(settings('site_email'))->send(new InternationalTransferMail($info, 'admin'));
            return response()->json(['success'=>'Transaction Processed, Awaiting Confirmation']);
        }

    }
}

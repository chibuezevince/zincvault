<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\TransactionLog;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\ExchangeAlert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    //Show Exchange Page

    public function showExchangePage()
    {
        return view('dashboard.exchange');
    }
    public function showExchangedAmount(Request $request)
    {
        $exchanged_amount = exchangedAmount($request->exchange_amount);
        if ($request->currency_to == $request->currency_from) {
            return response()->json(['exchanged_amount'=>$request->exchange_amount]);
        }
        else
        {
            return response()->json(['exchanged_amount'=>$exchanged_amount]);
        }      
    }
    public function processExchangeTransaction(Request $request)
    {
        $exchange_info = Validator::make($request->all(), [
            'currency_from' => 'required',
            'currency_to' => 'required',
            'exchange_amount' => 'required|numeric',
            'exchanged_amount'=> 'required',
            'note' => 'required',
        ]);
        if ($exchange_info->fails()) {
            return response()->json(['errors'=>$exchange_info->errors()->all()]);
        }

        $validated_info = $exchange_info->validated();
        $exchanged_amount = exchangedAmount($validated_info['exchange_amount']);
        $exchange_to = $validated_info['currency_from'].'_balance';
        if(user_details()->$exchange_to < exchangedAmount($validated_info['exchange_amount']))
        {
            return response()->json(['insufficient_amount'=>'Insufficient Amount']);
        }
        else{
            {
                //Decrement & Increment User
                user_details()->increment($validated_info['currency_to'].'_balance', $validated_info['exchange_amount']);
                user_details()->decrement($validated_info['currency_from'].'_balance', exchangedAmount($validated_info['exchange_amount']));
                
                //Credit Log
                TransactionLog::create([
                    'username' => user()->username,
                    'type' => 'Exchange',
                    'cred_deb' => 'Credit',
                    'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                    'status' => 1,
                    'amount'=>$validated_info['exchange_amount'],
                    'currency'=>$validated_info['currency_to'],
                    'reason' => $validated_info['note'],
                    'transaction_id' => rand(100000000, 999999999),
                ]);

                //Debit Log
                TransactionLog::create([
                    'username' => user()->username,
                    'type' => 'Exchange',
                    'cred_deb' => 'Debit',
                    'time'=> Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'),
                    'status' => 1,
                    'amount'=>$exchanged_amount,
                    'currency'=>$validated_info['currency_from'],
                    'reason' => $validated_info['note'],
                    'transaction_id' => rand(100000000, 999999999),
                ]);
                $amount = ['exchanged_amount'=>$exchanged_amount, 'exchange_amount'=>$validated_info['exchange_amount']];
                //Debit Alert
                Mail::to(user()->email)->send(new ExchangeAlert($amount, Carbon::now('Africa/Lagos')->format('l, d F, Y g:i A'), $validated_info));
                return response()->json(['success'=>'Transaction Processed Successfully']);
            }
        }
    }
}

<?php

use App\Models\User;
use App\Models\Setting;
use App\Models\UserDetail;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\Auth;
 
function user()
{
    return Auth::user();
}

function customer_details($username)
{
    return UserDetail::firstWhere('username', $username);
}

function user_details()
{
    return UserDetail::firstWhere('username', user()->username);
}

function settings($column_name)
{
    if ($column_name == 'local_transfer_charge' || $column_name == 'international_transfer_charge'|| $column_name == "exchange_fee") 
    {
        return Setting::firstWhere('name', $column_name)->value*100;
    }
    else
    {
        return Setting::firstWhere('name', $column_name)->value;
    }   
}
function chargedAmount($amount)
{
    $charge_percent = settings('local_transfer_charge');
    $def_value = $amount * ($charge_percent/100);
    $chargedAmount = $amount + $def_value;
    return $chargedAmount;
}
function transaction_log($cred_deb, $currency)
{
    $log_details = TransactionLog::where(['username'=> user()->username, 'cred_deb'=>$cred_deb, 'currency'=>$currency, 'status'=>1])->latest()->first();
    if(!$log_details===null)
    {
        return $log_details;
    }
}

function transactionLogs($username)
{
    return TransactionLog::where('username', $username)->orderByDesc('created_at')->limit(5)->get();
}

function exchangedAmount($amount)
{
    $charge_percent = settings('exchange_fee');
    $def_value = $amount * ($charge_percent/100);
    $exchangedAmount = $amount + $def_value;
    return $exchangedAmount;
}

function InternationalAmount($amount)
{
    $charge_percent = settings('international_transfer_charge');
    $def_value = $amount * ($charge_percent/100);
    $internationalAmount = $amount + $def_value;
    return $internationalAmount;
}

function currencyLogo($currency)
{
    if ($currency=="dollar") {
        return '$';
    }
    elseif($currency=='pound'){
        return '£';
    }
    elseif($currency='euro'){
        return '€';
    }
}
function status($status){
    if($status==1)
    {
        return "Completed";
    }
    elseif($status==2)
    {
        return "Pending";
    }
    else
    {
        return "Cancelled";
    }
}
function user_db(){
    return UserDetail::firstWhere('username', user()->username);
}

function getReceiverDetail($account_number)
{
    return User::firstWhere('account_number', $account_number);
}

function getSenderDetail($username)
{
    return User::firstWhere('username', $username);
}

function is_active($bool){
    return User::where(['is_active'=>$bool,'type'=>2])->get();
}

function wireTransferRequests(){
    return TransactionLog::where(['status'=>2, 'type'=> 'International Transfer'])->latest()->get();
}

function allTransactions()
{
    return TransactionLog::latest()->get();
}

function getUser($username){
    return User::firstWhere('username', $username);
}

function userStatus($status){
    if($status==1){
        return "Active";
    }else{
        return "Inactive";
    }
}
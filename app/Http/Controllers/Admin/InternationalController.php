<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Http\Controllers\Controller;
use App\Mail\InternationalStatusMail;
use Illuminate\Support\Facades\Mail;

class InternationalController extends Controller
{
    public function displayAllTransferRequests()
    {
        $all = TransactionLog::where('type', 'International Transfer')->latest()->paginate(10);
        return view('admin.international.all', ['transactions' => $all]);
    }

    public function changeTransferStatus()
    {
        $details = request()->session()->get('details');
        if(request('reject'))
        {
            TransactionLog::where('transaction_id', $details->transaction_id)->update([
                'status' => 0,
            ]);
            Mail::to(getUser($details->username)->email)->send(new InternationalStatusMail('rejected', $details));
            return back()->with(['success'=>'Transaction Rejected']);
        }
        elseif(request('approve'))
        {
            TransactionLog::where('transaction_id', $details->transaction_id)->update([
                'status' => 1,
            ]);
            Mail::to(getUser($details->username)->email)->send(new InternationalStatusMail('approved', $details));
            return back()->with(['success'=>'Transaction Approved']);
        }
        elseif(request('pend'))
        {
            TransactionLog::where('transaction_id', $details->transaction_id)->update([
                'status' => 2,
            ]);
            Mail::to(getUser($details->username)->email)->send(new InternationalStatusMail('pended', $details));
            return back()->with(['success'=>'Transaction set to pending']);
        }
    }
}

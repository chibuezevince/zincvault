<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Models\UserDetail;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function displayTransactionDetail(TransactionLog $id)
    {
        request()->session()->put('details', $id);
        return view('dashboard.transactions.single', ['transaction' => $id]); 
    }

    public function showAllTransactions()
    {
        $all = TransactionLog::where('username', user()->username)->latest()->paginate(10);
        return view('dashboard.transactions.all', ['transactions' => $all]);
    }
    public function generatePDF(TransactionLog $id)
    {
        $pdf = Pdf::loadView('dashboard.transactions.generate_single', ['transaction'=>$id]);
        return $pdf->download($id->transaction_id.'.pdf');
    }

    public function printTransaction(TransactionLog $id)
    {
        return view('dashboard.transactions.generate_single', ['transaction' => $id]); 
    }
}

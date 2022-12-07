<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function displayAllTransactions()
    {
        $all = TransactionLog::latest()->paginate(10);
        return view('admin.transactions.all', ['transactions' => $all]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController as UserTransactionController;
use App\Http\Controllers\LocalTransferController as UserLocalTransferController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ExchangeController;
use App\Http\Controllers\Dashboard\InternationalTransferController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified', 'is_active']);
});

//Local Transfer Routes
Route::post('/dashboard/transfer/local', [UserLocalTransferController::class, 'validateTransferInput'])->middleware(['auth', 'verified']);
Route::get('/dashboard/transfer/local', [UserLocalTransferController::class, 'displayLocalTransferPage'])->middleware(['auth', 'verified'])->name('dashboard.local_transfer');
Route::post('/dashboard/receiver/details', [UserLocalTransferController::class, 'getReceiverDetails']);
Route::get('/dashboard/local_transfer/confirm/', [UserLocalTransferController::class, 'displayLocalConfirmPage'])->middleware(['auth', 'verified'])->name('localtransfer.confirm');
Route::post('/dashboard/local_transfer/confirm/', [UserLocalTransferController::class, 'sendLocalTransaction'])->middleware(['auth', 'verified']);
Route::get("/dashboard/retrieve", [UserLocalTransferController::class, 'showReceiverName']);

//Dasboard Profile Routes
Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::get('/dashboard/profile/', [ProfileController::class, 'displayProfilePage'])->name('dashboard.profile');
    Route::post('/dashboard/profile/avatar', [ProfileController::class, 'uploadAvatar']);
    Route::post('/dashboard/profile/basic_info', [ProfileController::class, 'updateBasicInformation'])->name('profile.basic_info');
    Route::post('/dashboard/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

//Exchange Routes
Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::get('/dashboard/exchange', [ExchangeController::class, 'showExchangePage'])->name('dashboard.exchange');
    Route::post('/dashboard/exchange', [ExchangeController::class, 'processExchangeTransaction'])->name('profile.exchange');
    Route::get('/dashboard/exchange/exchangeamount', [ExchangeController::class, 'showExchangedAmount']);
}
);

//International Transfer Routes
Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::get('/dashboard/transfer/international', [InternationalTransferController::class, 'displayInternationaTransferPage'])->name('dashboard.international_transfer');
    Route::post('/dashboard/transfer/international',[InternationalTransferController::class, 'processInternationaTransfer'])->name('transfer.international');
}
);

//Transacion Log Routes
Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::get('/dashboard/transaction/view/{id:transaction_id}', [UserTransactionController::class, 'printTransaction']);
    Route::get('/dashboard/transaction/pdf/{id:transaction_id}', [UserTransactionController::class, 'generatePDF']);
    Route::get('/dashboard/transaction/{id:transaction_id}', [UserTransactionController::class, 'displayTransactionDetail']); 
    Route::get('/dashboard/transactions', [UserTransactionController::class, 'showAllTransactions'])->name('transactions.all');
}
);
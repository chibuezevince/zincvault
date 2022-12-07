<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InternationalController;
use App\Http\Controllers\Admin\LocalTransferController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UsersController;

Route::middleware(['auth','verified', 'is_admin'])->group(function () {
    //Users Route
    Route::get('/admin/users', [UsersController::class, 'diplayAllUsers'])->name('admin.allusers');
    Route::get('/admin/users/view/{id}', [UsersController::class, 'diplayUserDetail'])->name('admin.user');
    Route::get('/admin/users/edit/{id}', [UsersController::class, 'displayUserPage']);
    Route::post('/admin/user/avatar', [UsersController::class, 'uploadAvatar'])->name('admin.avatar');
    Route::post('/admin/user/basic_info', [UsersController::class, 'updateBasicInfo'])->name('admin.basic_info');
    Route::post('/admin/user/password', [UsersController::class, 'updatePassword'])->name('admin.password');
    Route::post('/admin/user/cred_deb', [UsersController::class, 'creditOrDebit'])->name('admin.cred_deb');
    Route::post('/admin/users/deactivate', [UsersController::class, 'activateDeactivateUsers'] )->name('admin.activate_deactivate');
    Route::get('admin/user/create', [UsersController::class, 'displayUserRegistrationPage'])->name('admin.user_signup');
    Route::post('admin/user/create', [UsersController::class, 'createUser'])->name('admin.user_create');

    //Transactions Log Route
    Route::get('/admin/transactions', [TransactionController::class, 'displayAllTransactions'])->name('admin.all_transactions');

    //International Request Routes
    Route::get('/admin/international_requests', [InternationalController::class, 'displayAllTransferRequests'])->name('admin.all_requests');
    Route::post('/admin/international_request/change_status', [InternationalController::class, 'changeTransferStatus'])->name('admin.update_requests');

    //Site Settings Routes
    Route::get('/admin/site_settings', [SiteSettingsController::class, 'displaySettingsPage'])->name('admin.site_settings');
    Route::post('/admin/site_settings/update', [SiteSettingsController::class, 'updateSiteSettings'])->name('admin.update_settings');

    //Admin Local Transfer Route
    Route::get('/admin/transfer/local', [LocalTransferController::class, 'displayLocalTransferPage'])->name('admin.local_transfer');
    Route::post('/admin/transfer/local', [LocalTransferController::class, 'sendAdminLocalTransaction'])->name('admin.send_transaction');
});
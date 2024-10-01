<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\LoanRepaymentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\LoanController;

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('Home');
    Route::get('/about', 'about')->name('About');
    Route::get('/resource', 'resource')->name('Resource');
    Route::get('register', 'showRegisterForm')->name('registerForm');
    Route::post('register', 'register')->name('register');
    Route::get('login', 'showLoginForm')->name('loginForm');
    Route::post('login', 'login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware('role:admin|customer')->group(function () {
        Route::get('/customer/request-account', [AccountController::class, 'showRequestForm'])
            ->name('customer.request-account-form');
        Route::post('/customer/request-account', [AccountController::class, 'requestAccountCreation'])
            ->name('customer.request-account');
        Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
        Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('accounts.show');
        Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
        Route::patch('/accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');
        Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');
        Route::get('/account/{accountId}', [AccountController::class, 'view'])
            ->name('accounts.requestDetail');
        Route::post('/accounts/{id}/activate', [AccountController::class, 'activate'])
            ->name('accounts.activate');
        Route::post('/accounts/{id}/deactivate', [AccountController::class, 'reject'])
            ->name('accounts.deactivate');

        Route::resource('transactions', TransactionController::class);
        Route::get('/transaction/request', [TransactionController::class, 'createRequest'])
            ->name('transaction.request.create');
        Route::post('/transaction/store', [TransactionController::class, 'storeRequest'])
            ->name('transaction.request.store');
        Route::get('/transaction/details/{id}', [TransactionController::class, 'showRequestDetails'])
            ->name('transaction.details');
//        Route::get('/transactions/{id}/download', [TransactionController::class, 'downloadPDF'])
//            ->name('transactions.downloadPDF');
        Route::prefix('transactions')->group(function () {
            Route::post('/accept/{id}', [TransactionController::class, 'accept'])
                ->name('transactions.accept');
            Route::post('/reject/{id}', [TransactionController::class, 'reject'])
                ->name('transactions.reject');
        });

        Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
        Route::get('/loans/{loan}', [LoanController::class, 'show'])->name('loans.show');
        Route::get('/loans/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
        Route::patch('/loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
        Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
        Route::get('/loan/request', [LoanController::class, 'loanForm'])
            ->name('loan.request.create');
        Route::post('/request-loan', [LoanController::class, 'requestLoan'])
            ->name('loan.request');
        Route::get('/loan/{loanId}', [LoanController::class, 'view'])->name('loan.view');

        Route::resource('loan-repayments', LoanRepaymentController::class);

        Route::get('/rate', [ExchangeRateController::class, 'index'])->name('Rate');
//        Route::resource('exchange_rates', ExchangeRateController::class);
        Route::get('/table', [UserController::class, 'table'])->name('Table');
//        Route::get('/upgrade', [UserController::class, 'upgrade'])->name('Upgrade');

        Route::post('/notifications', [NotificationController::class, 'store']);
        Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications']);

        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('Dashboard');
        Route::get('/bank-accounts', [BankAccountController::class, 'index'])->name('BankAccount');
    });

});

//Route::post('/notifications', [NotificationController::class, 'store']);
//Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
//Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications']);

Route::get('test', [TransactionController::class, 'downloadPdf'])->name('test');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgotPasswordForm');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('sendOtp');
Route::get('verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('verifyOtpForm');
Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('resetPasswordForm');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');


<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/', function () {
    return view('welcome');
});*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Verifyotpcontroller;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\Profilecontroller;
use App\Http\Controllers\Withdrawcontroller;
use App\Http\Controllers\Walletcontroller;
use App\Http\Controllers\Auth\RegisterController;


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('layouts.authwelcome');
});
Route::get('login-phone', function () {
    return view('layouts.login');
});
Route::get('deposit', function () {
    return view('deposit.deposit');
});
Route::get('invite-code', function () {
    return view('invite.invite-code');
});
Route::get('setting', function () {
    return view('setting.setting');
});
Route::get('support', function () {
    return view('support.support');
});


//Sell Crypto 
Route::get('sellcrypto', [PurchaseController::class, 'sellcrypto']);
Route::post('sellrequest', [PurchaseController::class, 'doSellcrypto']);

//Transaction Password
Route::get('transaction-password', [WalletController::class, 'transactionPassword']);
Route::post('add-transactionpassword', [WalletController::class, 'addTransactionPassword']);

//Wallet 
Route::get('deposit-inner/{coin}', [Walletcontroller::class, 'deposit'])->name('deposit-inner');

//Withdraw
Route::get('walletlist', [Withdrawcontroller::class, 'addreslist']);
Route::get('add-address', [Withdrawcontroller::class, 'addwithdrawaddress'])->name('add-address');
Route::post('set-primary-address', [Withdrawcontroller::class, 'setprimaryaddress']);
Route::get('withdraw', [Withdrawcontroller::class, 'withdraw'])->name('withdraw');
Route::get('/withdrawconform', [WalletController::class, 'withdraw_otp'])->name('withdrawotp');
Route::get('/approvewithdraw/{email}/{toaddress}', [WalletController::class, 'approvewithdraw'])->name('approvewithdraw');
Route::post('/verifywithdraw', [WalletController::class, 'cryptoWithdraw'])->name('validatecryptoWithdraw');

Route::post('doadd-address', [Withdrawcontroller::class, 'dowithdrawAddress']);
Route::get('wallet-address-generate', [Withdrawcontroller::class, 'walletaddressgenerate'])->name('wallet-address-generate');

Route::get('history', [WalletController::class, 'history']);
Route::post('sendotp', [WalletController::class, 'sendOTP']);

//bank add 
Route::get('add-bank', [Profilecontroller::class, 'addbank']);
Route::post('doadd-bank', [Profilecontroller::class, 'doaddBank']);
Route::get('bank-history', [Profilecontroller::class, 'bankList']);
Route::post('set-primary-account', [Profilecontroller::class, 'setprimaryAccount']);

Route::get('reset-transaction-password', function () {
    return view('passwords.reset-transaction-password');
});

// Route::get('dashboard', [Dashboardcontroller::class, 'index'])->name('dashboard');
Route::post('create-user', [RegisterController::class, 'Cretenewuser'])->name('create-user');
Route::get('profile', [Profilecontroller::class, 'index'])->name('profile');
Route::post('reset-password', [Profilecontroller::class, 'Resetpassword'])->name('reset-password');
Route::get('referral-rewards', [Profilecontroller::class, 'Referralreward'])->name('referral-rewards');

//Purchase
Route::get('exchange', [PurchaseController::class, 'exchange']);
Route::post('matchseller', [PurchaseController::class, 'CompleteSell'])->name('matchseller');
Route::get('payment/{code}', [PurchaseController::class, 'paymentdetails'])->name('payment');
Route::post('slipupload', [PurchaseController::class, 'slipupload']);
Route::get('exchange-history', [PurchaseController::class, 'purchaseHistory'])->name('exchange-history');

Route::get('exchange-history-deposit', [Profilecontroller::class, 'Exchangehistorydeposit'])->name('exchange-history-deposit');
Route::get('exchange-history-withdraw', [Profilecontroller::class, 'Exchangehistorywithdraw'])->name('exchange-history-withdraw');

Route::get('invite-friends', [Profilecontroller::class, 'Invitefriendsreferral'])->name('invite-friends');
Route::get('referral/{referral_code}', [RegisterController::class, 'res'])->name('referral');
Route::post('form_referral', [Dashboardcontroller::class, 'form_referral'])->name('form_referral');
Route::get('statement', [Profilecontroller::class, 'Statement'])->name('statement');
Route::get('verify-code/{email}', [Verifyotpcontroller::class, 'otpindex'])->name('verify-code');
Route::get('verify-email/', [Verifyotpcontroller::class, 'otpform'])->name('verifyEmail');
Route::post('verify-otp-num', [Verifyotpcontroller::class, 'VerifyOtp'])->name('verify-otp-num');
Route::get('/verify/{email}', [EmailVerifyController::class, 'sendEmailDone'])->name('sendEmailDone');
Route::get('/reconfirm_account/{email}', [LoginController::class, 'reconfirm_account'])->name('reconfirm_account');
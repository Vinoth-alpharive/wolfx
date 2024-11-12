<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@signup');
Route::get('country', 'API\AuthController@countryList');
Route::get('osversion','API\AuthController@osVersion');
Route::post('resetpassword', 'API\AuthController@resetPassword');
Route::post('changeresetpassword', 'API\AuthController@changeResetPassword');

Route::post('reconfirm-account','API\AuthController@ReconfirmAccount'); 

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('send-otp', 'API\UserController@sendOTP');
    Route::post('verify-otp', 'API\UserController@verifyOTP');
    Route::get('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refreshToken');
    Route::post('userdetails', 'API\UserController@details');
    Route::post('deactivateaccount', 'API\UserController@userblock');
    Route::post('userdetails-update', 'API\UserController@profileUpdate');
    Route::post('proof-upload', 'API\UserController@proofUpload');
    Route::post('profile-upload', 'API\UserController@profileImage');
    Route::post('change-password', 'API\UserController@changePassword');
    
    //Twofa
    Route::post('enable-twofa','API\UserController@enableTwofactor');
    Route::post('disable-twofa','API\UserController@diableTwoFactor');
    Route::post('validate-otp','API\UserController@validateOTP');
    Route::post('resend-email','API\UserController@reSendEmail');
    //after login otp check
    Route::post('validate-twofa','API\UserController@validateTwofa');

    //Bank
    Route::post('list-bank', 'API\UserController@bankView');
    Route::post('add-bank', 'API\UserController@addBank');
    Route::post('update-bank','API\UserController@updateBankDetails');
    Route::post('delete-bank', 'API\UserController@deleteBank');
    
    //KYC
    Route::post('add-kyc', 'API\UserController@addKYC');
    Route::post('update-kyc','API\UserController@update_kyc');
    Route::post('front-upload','API\UserController@front_upload_id');
    Route::post('back-upload','API\UserController@back_upload_id');

    //Trade
    Route::post('posttrade','API\TradeController@postTrade');
    Route::post('assets','API\TradeController@assetslist');
    Route::post('tradepairlist','API\TradeController@tradePairList');
    Route::post('assetsdetails','API\TradeController@assetDetails');
    Route::post('trade','API\TradeController@index');
    Route::post('openorders','API\TradeController@Update_Openorder');
    Route::post('orderhistory','API\TradeController@Update_Orderhistory');
    Route::post('tradehistoryajax','API\TradeController@Update_tradehistory');
    Route::post('market','API\TradeController@market');
    Route::post('cancelorder', 'API\TradeController@cancelTrade');
    //TradeLimit
    Route::post('buylimit','TradeLimitController@buylimit');
    Route::post('selllimit','TradeLimitController@selllimit');
    Route::post('updatebuyerbalance','TradeLimitController@updateBuyerbalance');
    //TradeMarket
    Route::post('trade/buymarket', 'API\TradeMarketController@buymarket');
    Route::post('trade/sellmarket', 'API\TradeMarketController@sellmarket');

    //withdraw
    Route::post('withdraw','API\WalletController@validatecryptoWithdraw');
    Route::post('withdrawotp','API\WalletController@withdrawotp');

    //supportticket
    Route::post('ticket-view','API\SupportController@SupportTicketView');
    Route::post('create-ticket','API\SupportController@CreateTicket');
    Route::post('get-message','API\SupportController@GetMessage');
    Route::post('send-message','API\SupportController@CreateMessage');

    //instantswap
    Route::post('/swaplist','API\SwapController@swaplist');
    Route::post('/listcoin','API\SwapController@pairlist');
    Route::post('/getbalance','API\SwapController@getbalance');
    Route::post('/swapsubmit','API\SwapController@SwapTrade');
    Route::post('/swap-history', 'API\SwapController@SwapHistory');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, Please check given url'], 404);
});

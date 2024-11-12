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

Route::get('/', function () {
	return view('welcome');
});

Route::post('login', 'AdminLoginController@login');
Route::get('logout', 'AdminLoginController@logout');
Route::get('Bdru_adress_create', 'CronController@Bdru_adress_create');

//2fa
Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	//google 2FA 
	Route::get('/googe2faenable', 'TwofaController@enableGoogleTwoFactor')->name('googe2faenable');
	Route::post('/google_admin_verfiy', 'TwofaController@google_admin_verfiy')->name('google_admin_verfiy');

});

Route::group(['middleware' => ['admin', 'twofa'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

	Route::get('adminwallet', 'AdminWalletController@index')->name('adminwallet');
	Route::get('dashboard', 'DashboardController@index');
	Route::get('mobile_security', 'DashboardController@mobile_security');
	Route::post('update_security', 'DashboardController@update_security');

	Route::get('category', 'PendingController@categoryList');
	Route::get('addcategory', 'PendingController@addCategoryForm');
	Route::post('addCategory', 'PendingController@addCategory');
	Route::get('editcategory/{id}', 'PendingController@editPage');
	Route::post('editCategory', 'PendingController@editCategory');

	//Pending Purchase 
	Route::get('pendingpurchase', 'PendingController@getPendingPurchase');
	Route::get('purchasehistory', 'PendingController@purchaseHistory');
	Route::get('view-purchase-completed/{id}', 'PendingController@viewpurchaseHistory')->name('viewpurchasecompleted');
	Route::Post('completePurchase', 'PendingController@completePurchase');
	Route::get('viewPendingpurchase/{id}', 'PendingController@viewPendingpurchase');

	//Users
	Route::get('users', 'UserController@index');
	Route::get('buyer', 'UserController@buyer');
	Route::get('addbuyer', 'UserController@addbuyer');
	Route::post('doaddBuyer', 'UserController@doaddBuyer');
	Route::get('seller', 'UserController@seller');

	Route::get('users-export', 'UserController@export')->name('userexport');
	Route::get('buyers-export', 'UserController@buyerExport')->name('buyerexport');
	Route::get('users_edit/{id}', 'UserController@edit');
	Route::get('users_block/{id}', 'UserController@users_block');
	Route::post('update_user', 'UserController@update');
	Route::get('users_wallet/{id}', 'UserController@userWallet');
	Route::get('users/search', 'UserController@usersearch');
	Route::get('trade/search', 'TradepairController@tradesearch');


	Route::get('users_address/{uid}/{coin}', 'UserController@users_address');
	Route::post('update_bank', 'UserController@update_bank');
	Route::post('update_withdraw_address', 'UserController@update_withdraw_address');
	Route::get('users_referral/{id}', 'UserController@UsersReferral');

	Route::get('userdeposit/{id}', 'UserController@userdeposit');
	Route::get('userkyc/{id}', 'UserController@userkyc');

	Route::get('userfiatdeposit/{id}', 'UserController@userfiatdeposit');
	Route::get('user_fiatdeposit_edit/{id}', 'UserController@user_fiatdeposit_edit');
	Route::post('user_fiatdeposit_update', 'UserController@user_fiatdeposit_update');


	Route::get('user_withdraw/{id}', 'UserController@UserWithdrawList');
	Route::get('user_crypto_withdraw_edit/{id}', 'UserController@WithdrawCryptoEdit');
	Route::post('user_update_cryptowithdraw', 'UserController@updateCryptoWithdraw');

	Route::post('Balance_update', 'UserController@Balance_update');

	Route::get('adminwallet', 'UserController@Adminwallet');
	Route::get('walletview/{id}', 'UserController@Walletview');
	Route::post('walletupdate', 'UserController@Walletupdate');
	Route::get('transactionall/{id}/{coin}', 'UserController@Transactionall');


	Route::get('user_fiat_withdraw/{id}', 'UserController@user_fiat_withdraw');
	Route::get('fiat_withdraw_edit/{id}', 'UserController@fiat_withdraw_edit');
	Route::post('fiat_withdraw_update', 'UserController@fiat_withdraw_update');
	Route::get('user_buy_tradehistory/{id}', 'UserController@user_buy_tradehistory');
	Route::get('user_sell_tradehistory/{id}', 'UserController@user_sell_tradehistory');

	Route::get('users/loginhistory', 'UserController@userLoginDetails');
	Route::post('loginactivity/search', 'UserController@loginActivitySearch');
	Route::get('users/currentlogin', 'UserController@currentLoginDetails');

	//Trade
	Route::get('buy_tradehistory', 'TradesController@buyTradeHistory');
	Route::get('sell_tradehistory', 'TradesController@sellTradeHistory');

	Route::get('pending_tradehistory/{pair}', 'TradesController@pendingTradeHistory');
	Route::get('pending_tradehistory/{pair}/{otype}', 'TradesController@pendingTradeHistory');
	Route::get('/cancelbuyorder/{id}', 'TradesController@cancelbuyorder')->name('cancelbuyorder');
	Route::get('/cancelsellorder/{id}', 'TradesController@cancelsellorder')->name('cancelsellorder');

	//Exports
	Route::get('limitdepositexport', 'HistroyController@depositexport');
	Route::get('withdrawexport', 'HistroyController@withdrawexport');
	Route::get('deposit-export/{key}', 'HistroyController@exportDeposit')->name('depositexport');
	Route::get('deposit-search/{key}', 'HistroyController@depositsearch')->name('depositsearch');
	Route::get('withdrawal-export/{key}', 'HistroyController@exportWithdraw')->name('withdrawalexport');
	Route::get('withdrawal-search/{key}', 'HistroyController@withdrawsearch')->name('withdrawalsearch');

	//Deposit
	Route::get('deposits/{coin}', 'HistroyController@DepositList');
	Route::get('deposit/search', 'HistroyController@DepositSearchList');
	Route::get('cryptodeposit/{id}', 'HistroyController@CryptoDepositEdit');
	Route::post('cryptodeposit_update', 'HistroyController@CryptoDepositUpdate');
	Route::get('fiatdeposit_edit/{id}', 'HistroyController@FiatDepositEdit');
	Route::post('fiatdeposit_update', 'HistroyController@FiatDepositUpdate');

	Route::get('instant/{type}', 'HistroyController@InstantList');

	//Withdraw
	Route::get('withdraw/{coin}', 'HistroyController@WithdrawList');
	Route::get('withdrawal/search', 'HistroyController@WithdrawSearchList');
	Route::get('crypto_withdraw_edit/{id}', 'HistroyController@WithdrawCryptoEdit');

	Route::post('update_cryptowithdraw', 'HistroyController@updateCryptoWithdraw');
	Route::get('withdraw_edit/{id}', 'HistroyController@withdrawFiatEdit');
	Route::post('withdraw_update', 'HistroyController@withdrawFiatUpdate');

	//Kyc
	Route::get('kyc', 'KycController@index');
	Route::get('kycview/{id}', 'KycController@kycview');
	Route::post('kycupdate', 'KycController@kycUpdate');

	//Liveprice
	Route::get('liveprice', 'LivepriceController@index');
	Route::get('addliveprice', 'LivepriceController@Addliveprice');
	Route::get('livepriceedit/{id}', 'LivepriceController@edit');
	Route::post('livepriceadd', 'LivepriceController@Livepriceadd');
	Route::post('livepriceupdate', 'LivepriceController@Livepriceupdate');

	//Commission
	Route::get('commission', 'CommissionController@index');
	Route::get('addtoken', 'CommissionController@addtoken');
	Route::post('addtokeninsert', 'CommissionController@addtokeninsert');
	Route::get('commissionsettings/{id}', 'CommissionController@edit');
	Route::post('commissionupdate', 'CommissionController@commissionUpdate');
	Route::get('commissionhistory/{pair}', 'CommissionController@commissionhistory');

	//InstantCommission
	Route::get('instant_commission', 'InstantCommissionController@index');
	Route::get('instant_commissionsettings/{id}', 'InstantCommissionController@edit');
	Route::post('instant_commissionupdate', 'InstantCommissionController@commissionUpdate');

	Route::get('admininstant_transaction/', 'TradesController@Admininstanttransaction');

	//swap pair
	Route::get('swappair', 'SwapController@swappairlist');
	Route::get('deletedswap/{id}', 'SwapController@swapDelete');
	Route::get('swapedit/{id}', 'SwapController@pairedit');
	Route::post('swapupdate', 'SwapController@doedit');
	Route::get('addswap', 'SwapController@addswap');
	Route::post('addswapinsert', 'SwapController@insertswap');

	Route::get('swaphistory', 'SwapController@swaphistory');

	//Trade pair
	Route::get('coinlist', 'TradepairController@index');
	Route::get('deletedcoin/{id}', 'TradepairController@coinDelete');
	Route::get('coinsettings/{id}', 'TradepairController@edit');
	Route::post('coinupdate', 'TradepairController@Update');
	Route::get('addcoin', 'TradepairController@addcoin');
	Route::post('addcoininsert', 'TradepairController@addcoininsert');


	Route::get('tradepairlist', 'TradepairController@tradepairlist');
	Route::get('pairedit/{id}', 'TradepairController@pairedit');
	Route::get('pairdelete/{id}', 'TradepairController@tradepairDelete');

	Route::get('addpair', 'TradepairController@addpair');
	Route::post('addpairinsert', 'TradepairController@addpairinsert');

	Route::post('pairupdate', 'TradepairController@pairupdate');

	//Leverage commission
	Route::get('leverage_add_view', 'CommissionController@leverage_add_view');
	Route::get('leverage_commission', 'CommissionController@leverage_commission');
	Route::get('leverage_commissionsettings/{id}', 'CommissionController@leverage_edit');
	Route::post('le_commissionUpdate', 'CommissionController@le_commissionUpdate');
	Route::post('le_commissionAdd', 'CommissionController@le_commissionadd');
	Route::get('leverage_delete/{id}', 'CommissionController@leverage_delete');



	//AffliateCommission
	Route::get('aff_commission', 'AffilateCommissionController@index');
	Route::get('add_commission', 'AffilateCommissionController@add');
	Route::post('store_affcommission', 'AffilateCommissionController@store');
	Route::get('aff_commissionsettings/{id}', 'AffilateCommissionController@edit');
	Route::post('aff_commissionupdate', 'AffilateCommissionController@commissionUpdate');

	Route::get('affliatetransaction/', 'TradesController@affliatetransaction');

	//Support
	Route::get('support', 'SupportController@index');
	Route::get('reply/{id}', 'SupportController@reply');
	Route::post('tickets/adminsavechat', 'SupportController@adminsavechat');
	Route::post('tickets/adminajaxchat', 'SupportController@userajaxchat');

	//Group Chat
	Route::get('grpchat', 'GroupChatController@index');
	Route::post('sendGrpMsg', 'GroupChatController@GrpMsg');
	Route::post('delgrpchat', 'GroupChatController@delgrpchat');
	Route::get('grpchatstatus/{id}/{status}', 'GroupChatController@grpchatstatus');
	Route::get('subscriber', 'SupportController@subscriber');
	Route::get('subscriberdelete/{id}', 'SupportController@subscriberdelete');
	Route::get('contactus', 'SupportController@contactus');
	Route::get('contactremove/{id}', 'SupportController@contactremove');

	//Bank
	Route::get('bank/{fiat}', 'BankController@index');
	Route::get('addbank/{fiat}', 'BankController@addbank');
	Route::post('bankadd', 'BankController@bankadd');
	Route::post('paymentadd', 'BankController@paymentadd');
	Route::get('edit_bank/{id}/{fiat}', 'BankController@editBank');
	Route::post('updateBank', 'BankController@updateBank');
	Route::get('view_payment/{id}/{fiat}', 'BankController@ViewPayment');
	Route::post('updatePayment', 'BankController@updatePayment');

	//Site Settings
	Route::get('logo', 'SettingsController@logo');
	Route::post('update_logo', 'SettingsController@updateLogo');
	Route::get('tc', 'SettingsController@tc');
	Route::post('update_terms', 'SettingsController@update_terms');
	Route::get('privacy', 'SettingsController@privacy');
	Route::post('update_privacy', 'SettingsController@updatePrivacy');
	Route::get('aboutus', 'SettingsController@aboutus');
	Route::post('update_about', 'SettingsController@updateAbout');
	Route::get('aboutus', 'SettingsController@aboutus');
	Route::post('update_about', 'SettingsController@updateAbout');
	Route::get('features', 'SettingsController@features');
	Route::post('features_update', 'SettingsController@features_settings');
	Route::get('howitworks', 'SettingsController@howitworks');
	Route::post('howitworks_update', 'SettingsController@howitworks_update');
	Route::get('aml', 'SettingsController@AML');
	Route::post('update_aml', 'SettingsController@update_aml');
	Route::get('faq', 'SettingsController@faq');
	Route::get('/faq_add', 'SettingsController@faq_add');
	Route::post('/faq_save', 'SettingsController@faq_save');
	Route::get('/faq_edit/{id}', 'SettingsController@faq_edit');
	Route::post('/faq_update', 'SettingsController@faq_update');
	Route::get('/faq_remove/{id}', 'SettingsController@faq_remove');
	Route::get('socialmedia', 'SettingsController@socialmedia');
	Route::post('save_social_media', 'SettingsController@saveSocialMedia');
	Route::get('termsservices', 'SettingsController@termServices');
	Route::post('save_termsservices', 'SettingsController@saveTermServices');
	Route::get('homepage', 'SettingsController@homePage');
	Route::post('save_homepage', 'SettingsController@saveHomepage');
	Route::get('liveprice', 'SettingsController@livepriceview');
	Route::post('view_liveprice', 'SettingsController@viewLiveprice');
	Route::get('securityview', 'SettingsController@securityview');
	Route::post('securityupdate', 'SettingsController@update_kyc');
	Route::get('partner', 'SettingsController@partner');
	Route::get('addpartner', 'SettingsController@addpartner');
	Route::post('update_partner', 'SettingsController@update_partner');
	Route::get('/partner_remove/{id}', 'SettingsController@partner_remove');


	//Security
	Route::get('security', 'DashboardController@security');
	Route::post('changeusername', 'DashboardController@updateUsername');
	Route::post('changepassword', 'DashboardController@changepassword');


	//developer api
	//Category
	// Route::get('category', 'DevelpapiController@index');
	Route::get('addcat', 'DevelpapiController@addforum');
	Route::post('addcategory', 'DevelpapiController@addcategory');
	Route::get('viewcategory/{id}', 'DevelpapiController@viewcategory');
	Route::post('updatecategory', 'DevelpapiController@updatecategory');
	Route::get('cat_delete/{id}', 'DevelpapiController@cat_rem');


	Route::get('subcategory', 'DevelpapiController@subcategory');
	Route::get('subaddcat', 'DevelpapiController@subaddcat');
	Route::post('subaddcategory', 'DevelpapiController@subaddcategory');
	Route::get('subviewcategory/{id}', 'DevelpapiController@subviewcategory');
	Route::post('subupdatecategory', 'DevelpapiController@subupdatecategory');
	Route::get('subcat_delete/{id}', 'DevelpapiController@subcat_delete');

	Route::get('news', 'SettingsController@NewsPage');
	Route::get('newsadd', 'SettingsController@Newsadd');
	Route::post('addnews', 'SettingsController@Addnews');
	Route::get('newsedit/{id}', 'SettingsController@NewsPageEdit');
	Route::get('newsdelete/{id}', 'SettingsController@Newsdelete');
	Route::post('updatenews', 'SettingsController@UpdateNews');

	Route::get('feewallet/{coin}/{type}', 'AdminAddressController@feeWallet');
	Route::get('feewalletedit/{id}','AdminAddressController@feeWalletedit');
	Route::post('feewalletupdate','AdminAddressController@feewalletupdate');
	
	Route::post('cryptosendamount', 'AdminAddressController@cryptoSendAmount');

	//instant Trade
	Route::get('instantbuytradehistory/{pair}', 'HistroyController@instantbuytradehistory');
	Route::get('instantselltradehistory/{pair}', 'HistroyController@instantselltradehistory');

	//subadmin
	Route::get('/subadminlist', 'SubAdminController@index');
	Route::get('/subadminform', 'SubAdminController@create');
	Route::post('/subadmincreated', 'SubAdminController@store');
	Route::get('/subadminedit/{id}', 'SubAdminController@show');
	Route::post('/subadminupdate/{id}', 'SubAdminController@update');
	Route::get('/subadminremove/{id}', 'SubAdminController@destroy');
	Route::get('/subadminsearch', 'SubAdminController@subadminsearch');

	Route::get('/subadminchangepassword/{id}', 'SubAdminController@subadminchangepassword');
	Route::post('/subadminpassupdate/{id}', 'SubAdminController@subadminpassupdate');
	Route::post('/changetwofa', 'SubAdminController@changetwofaupdate');
	Route::get('/resettwofa', 'SubAdminController@resettwofa');


	//P2p
	Route::get('/buyhistory', 'TradesController@buyHistory');
	Route::get('/buyhistoryview/{id}', 'TradesController@buyhistoryview');
	Route::get('/sellhistory', 'TradesController@sellHistory');
	Route::get('/sellhistoryview/{id}', 'TradesController@sellhistoryview');
	Route::get('/pendinghistory', 'TradesController@pendingHistory');
	Route::get('/p2pviewtrade/{id}', 'TradesController@p2pViewTrade');
	Route::post('/p2ptradeupdate', 'TradesController@p2ptradeupdate');

	//Cms
	Route::get('/cmscontentedit/{key}', 'CmsController@edit');
	Route::post('/cmscontentupdate', 'CmsController@update');

	Route::get('/featurelist/{key}', 'Featurecontroller@index');
	Route::get('/featuresadd', 'Featurecontroller@add');
	Route::post('/featuresinsert/{key}', 'Featurecontroller@insert');
	Route::get('/featuresedit/{key}/{id}', 'Featurecontroller@edit');
	Route::post('/featureupdate', 'Featurecontroller@update');
	Route::get('/featuredelete/{id}', 'Featurecontroller@delete');

	Route::get('/platformadvantage/{key}', 'PlatformController@index');
	Route::get('/platformadvantageadd', 'PlatformController@add');
	Route::post('/platformadvantageinsert/{key}', 'PlatformController@insert');
	Route::get('/platformadvantageedit/{key}/{id}', 'PlatformController@edit');
	Route::post('/platformupdate', 'PlatformController@update');
	Route::get('/platformdelete/{id}', 'PlatformController@delete');

	//Countries
	Route::get('/countrieslist', 'UserController@Countrieslist');
	Route::get('/countryedit/{id}', 'UserController@Countryedit');
	Route::post('/countryupdate', 'UserController@Countryupdate');
	Route::get('/addcountryform', 'UserController@AddCountryForm');
	Route::post('/storecountry', 'UserController@StoreCountry');
	Route::get('/deletecountry/{id}', 'UserController@DeleteCountry');

	Route::get('adminfees', 'DashboardController@feescollected');
	Route::get('adminfeestransaction', 'DashboardController@transactionhistory');

	Route::get('referalcommission', 'CommissionController@Referalcommission');
	Route::get('referalcommissionedit/{id}', 'CommissionController@Editreferalcommission');
	Route::post('referalcommissionupdate', 'CommissionController@Updatereferalcommission');

	//Support
	Route::post('support-msg', 'SupportController@newMsg')->name('sendmsg');

	//margin
	Route::get('/marginlist', 'MarginController@marginlist');
	Route::get('/marginborrow', 'MarginController@margindborrow');

	//reward
	Route::get('/offer', 'RewardController@index');
	Route::get('/newoffer', 'RewardController@newoffer');
	Route::post('/offer', 'RewardController@create');
	Route::get('/viewoffer/{id}', 'RewardController@viewoffer');
	Route::post('/updateoffer/{id}', 'RewardController@updateoffer');
	Route::get('/deleteoffer/{id}', 'RewardController@destroy');

	//welcome reward
	Route::get('/welcomereward', 'WelcomeRewardController@index');
	Route::get('/newreward', 'WelcomeRewardController@newreward');
	Route::post('/addwelcomereward', 'WelcomeRewardController@create');
	Route::get('/viewreward/{id}', 'WelcomeRewardController@viewreward');
	Route::post('/updatereward/{id}', 'WelcomeRewardController@updatereward');
	Route::get('/deletereward/{id}', 'WelcomeRewardController@destroy');

	//Commission History 
	Route::get('commission_wallet_history', 'HistroyController@commissionwallethistory');
	Route::get('commission_history', 'HistroyController@commissionhistory');

	Route::get('user_commissions/{id}', 'UserController@user_commissions');
	Route::post('update_user_commission', 'UserController@updateusercommission');



});

Route::get('Btc_balance', 'CronController@Btc_balance_update');
Route::get('testxrp', 'CronController@Xrptest');
Route::get('sendtest', 'CronController@sendtest');

//Clear Cache facade value:
Route::get('/clear-cache', function () {
	$exitCode = Artisan::call('cache:clear');
	return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
	$exitCode = Artisan::call('optimize');
	return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
	$exitCode = Artisan::call('route:cache');
	return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
	$exitCode = Artisan::call('route:clear');
	return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
	$exitCode = Artisan::call('view:clear');
	return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
	$exitCode = Artisan::call('config:cache');
	return '<h1>Clear Config cleared</h1>';
});
Route::get('setlocale/{locale}', function ($locale) {
	if (in_array($locale, \Config::get('app.locales'))) {
		Session::put('locale', $locale);
	}
	return redirect()->back();
});
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

//Payment IPN
Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');


Route::post('/ipnpaytm', 'PaymentController@ipnPayTm')->name('ipn.paytm');
Route::post('/ipnpayeer', 'PaymentController@ipnPayEer')->name('ipn.payeer');
Route::post('/ipnpaystack', 'PaymentController@ipnPayStack')->name('ipn.paystack');
Route::post('/ipnvoguepay', 'PaymentController@ipnVoguePay')->name('ipn.voguepay');
//Payment IPN

Route::get('/',['as'=>'home','uses'=>'HomeController@getHome']);
Route::get('about',['as'=>'about','uses'=>'HomeController@getAbout']);
Route::get('faqs',['as'=>'faqs','uses'=>'HomeController@getFaqs']);
Route::get('contact',['as'=>'contact','uses'=>'HomeController@getContact']);
Route::post('contact',['as'=>'contact-submit','uses'=>'HomeController@submitContact']);
Route::get('/menu/{id}/{name}','HomeController@menu');

/*============== Start Admin Authentication Route List =========================*/

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login')->name('admin.login.post');
Route::post('admin', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('admin-logout', 'Admin\LoginController@logout')->name('admin.logout');

/*============== Admin Password Reset Route list ===========================*/

Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');

/*===================== Admin Dashboard Redirected ====================*/

Route::get('admin-dashboard',['as'=>'dashboard','uses'=>'DashboardController@getDashboard']);
Route::get('admin-edit-profile',['as'=>'edit-profile','uses'=>'DashboardController@editProfile']);
Route::post('edit-profile',['as'=>'update-profile','uses'=>'DashboardController@updateProfile']);

/*============= Admin Password Change =====================*/

Route::get('admin-change-password', ['as'=>'admin-change-password', 'uses'=>'BasicSettingController@getChangePass']);
Route::post('admin-change-password', ['as'=>'admin-change-password', 'uses'=>'BasicSettingController@postChangePass']);

/*============ Basic Setting Controller ========================*/

Route::get('cron',['as'=>'repeat-generate','uses'=>'HomeController@repeatGenerate']);

Route::group(['prefix' => 'admin'], function () {

    Route::get('basic-setting', ['as'=>'basic-setting', 'uses'=>'BasicSettingController@getBasicSetting']);
    Route::put('basic-general/{id}', ['as'=>'basic-update', 'uses'=>'BasicSettingController@putBasicSetting']);

    Route::get('contact-setting',['as'=>'contact-setting','uses'=>'BasicSettingController@getContact']);
    Route::put('contact-setting/{id}', ['as'=>'contact-setting-update', 'uses'=>'BasicSettingController@putContactSetting']);

    Route::get('email-setting',['as'=>'email-setting','uses'=>'BasicSettingController@emailSetting']);
    Route::post('email-setting',['as'=>'email-setting','uses'=>'BasicSettingController@updateEmailSetting']);

    Route::get('sms-setting',['as'=>'sms-setting','uses'=>'BasicSettingController@smsSetting']);
    Route::post('sms-setting',['as'=>'sms-setting','uses'=>'BasicSettingController@updateSmsSetting']);

    Route::get('manage-logo',['as'=>'manage-logo','uses'=>'WebSettingController@manageLogo']);
    Route::post('manage-logo',['as'=>'manage-logo','uses'=>'WebSettingController@updateLogo']);

    Route::get('manage-footer',['as'=>'manage-footer','uses'=>'WebSettingController@manageFooter']);
    Route::put('manage-footer/{id}',['as'=>'manage-footer-update','uses'=>'WebSettingController@updateFooter']);

    Route::get('/slider', 'SliderController@index')->name('slider');
    Route::post('/slider/update', 'SliderController@update')->name('slider.update');


    Route::get('/feature', 'FeatureController@index')->name('feature');
    Route::get('/feature/create', 'FeatureController@create')->name('feature.create');
    Route::post('/feature', 'FeatureController@store')->name('feature.store');
    Route::get('/feature/{feature}/edit', 'FeatureController@edit')->name('feature.edit');
    Route::put('/feature/{feature}', 'FeatureController@update')->name('feature.update');
    Route::get('/feature/{feature}/delete', 'FeatureController@destroy')->name('feature.destroy');



    Route::get('manage-social',['as'=>'manage-social','uses'=>'WebSettingController@manageSocial']);
    Route::post('manage-social',['as'=>'manage-social','uses'=>'WebSettingController@storeSocial']);
    Route::get('manage-social/{product_id?}',['as'=>'social-edit','uses'=>'WebSettingController@editSocial']);
    Route::put('manage-social/{product_id?}',['as'=>'social-edit','uses'=>'WebSettingController@updateSocial']);
    Route::delete('manage-social/{product_id?}',['as'=>'social-delete','uses'=>'WebSettingController@deleteSocial']);

    Route::get('manage-service',['as'=>'manage-service','uses'=>'WebSettingController@manageService']);
    Route::post('manage-service',['as'=>'manage-service','uses'=>'WebSettingController@storeService']);
    Route::get('manage-service/{product_id?}',['as'=>'service-edit','uses'=>'WebSettingController@editService']);
    Route::put('manage-service/{product_id?}',['as'=>'service-edit','uses'=>'WebSettingController@updateService']);
    Route::delete('manage-service/{product_id?}',['as'=>'service-delete','uses'=>'WebSettingController@deleteService']);

    Route::get('testimonial-create',['as'=>'testimonial-create','uses'=>'WebSettingController@createTestimonial']);
    Route::post('testimonial-create',['as'=>'testimonial-create','uses'=>'WebSettingController@submitTestimonial']);
    Route::get('testimonial-all',['as'=>'testimonial-all','uses'=>'WebSettingController@allTestimonial']);
    Route::get('testimonial-edit/{id}',['as'=>'testimonial-edit','uses'=>'WebSettingController@editTestimonial']);
    Route::put('testimonial-edit/{id}',['as'=>'testimonial-update','uses'=>'WebSettingController@updateTestimonial']);
    Route::delete('testimonial-delete',['as'=>'testimonial-delete','uses'=>'WebSettingController@deleteTestimonial']);

    Route::get('menu-create',['as'=>'menu-create','uses'=>'WebSettingController@createMenu']);
    Route::post('menu-create',['as'=>'menu-create','uses'=>'WebSettingController@storeMenu']);
    Route::get('menu-control',['as'=>'menu-control','uses'=>'WebSettingController@manageMenu']);
    Route::get('menu-edit/{id}',['as'=>'menu-edit','uses'=>'WebSettingController@editMenu']);
    Route::post('menu-update/{id}',['as'=>'menu-update','uses'=>'WebSettingController@updateMenu']);
    Route::delete('menu-delete',['as'=>'menu-delete','uses'=>'WebSettingController@deleteMenu']);

    Route::get('manage-breadcrumb',['as'=>'manage-breadcrumb','uses'=>'WebSettingController@mangeBreadcrumb']);
    Route::post('manage-breadcrumb',['as'=>'manage-breadcrumb','uses'=>'WebSettingController@updateBreadcrumb']);

    Route::get('manage-about',['as'=>'manage-about','uses'=>'WebSettingController@manageAbout']);
    Route::post('manage-about',['as'=>'manage-about','uses'=>'WebSettingController@updateAbout']);

    Route::get('manage-about-text',['as'=>'manage-about-text','uses'=>'WebSettingController@manageAboutText']);
    Route::put('manage-about-text/{id}',['as'=>'update-about-text','uses'=>'WebSettingController@updateAboutText']);

    Route::get('manage-map',['as'=>'manage-map','uses'=>'WebSettingController@manageMap']);
    Route::post('manage-map',['as'=>'manage-map','uses'=>'WebSettingController@updateMap']);

    Route::get('manage-subtitle',['as'=>'manage-subtitle','uses'=>'WebSettingController@manageSubtitle']);
    Route::put('manage-subtitle/{id}',['as'=>'update-subtitle','uses'=>'WebSettingController@updateSubtitle']);


    Route::get('manage-compound',['as'=>'manage-compound','uses'=>'DashboardController@manageCompound']);
    Route::post('manage-compound',['as'=>'manage-compound','uses'=>'DashboardController@storeCompound']);
    Route::get('manage-compound/{product_id?}',['as'=>'compound-edit','uses'=>'DashboardController@editCompound']);
    Route::put('manage-compound/{product_id?}',['as'=>'compound-edit','uses'=>'DashboardController@updateCompound']);

    Route::get('faqs-create',['as'=>'faqs-create','uses'=>'WebSettingController@createFaqs']);
    Route::post('faqs-create',['as'=>'faqs-create','uses'=>'WebSettingController@storeFaqs']);
    Route::get('faqs-all',['as'=>'faqs-all','uses'=>'WebSettingController@allFaqs']);
    Route::get('faqs-edit/{id}',['as'=>'faqs-edit','uses'=>'WebSettingController@editFaqs']);
    Route::put('faqs-edit/{id}',['as'=>'faqs-update','uses'=>'WebSettingController@updateFaqs']);
    Route::delete('faqs-delete',['as'=>'faqs-delete','uses'=>'WebSettingController@deleteFaqs']);

    Route::get('plan-create',['as'=>'plan-create','uses'=>'DashboardController@createPlan']);
    Route::post('plan-create',['as'=>'plan-create','uses'=>'DashboardController@storePlan']);
    Route::get('plan-show',['as'=>'plan-show','uses'=>'DashboardController@showPlan']);
    Route::get('plan-edit/{id}',['as'=>'plan-edit','uses'=>'DashboardController@editPlan']);
    Route::put('plan-edit/{id}',['as'=>'plan-update','uses'=>'DashboardController@updatePlan']);

    Route::get('deposit-method',['as'=>'deposit-method','uses'=>'DashboardController@depositMethod']);
    Route::put('deposit-method/{id}', ['as' => 'update-deposit-method', 'uses' => 'DashboardController@updateDepositMethod']);
//    Route::post('deposit-method',['as'=>'deposit-method','uses'=>'DashboardController@updateDepositMethod']);

    Route::get('manual-method',['as'=>'bank-method','uses'=>'DashboardController@bankDeposit']);
    Route::get('btc-manual-show',['as'=>'btc-manual-show','uses'=>'DashboardController@showBitcoinManualDeposit']);
    Route::get('btc-manual/edit/{id}',['as'=>'btc-manual-method-edit','uses'=>'DashboardController@editBitcoinManualDeposit']);
    Route::put('btc-manual/edit/{id}',['as'=>'btc-manual-method-update','uses'=>'DashboardController@updateBitcoinManual']);

//    Route::post('bitcoin-manual-method',['as'=>'bitcoin-manual-method','uses'=>'DashboardController@editBitcoinManualDeposit']);
    Route::post('manual-method',['as'=>'bank-method','uses'=>'DashboardController@submitBankDeposit']);
    Route::get('manual-show',['as'=>'bank-show','uses'=>'DashboardController@showBank']);
    Route::get('manual-edit/{id}',['as'=>'bank-edit','uses'=>'DashboardController@editBank']);
    Route::put('manual-edit/{id}',['as'=>'bank-update','uses'=>'DashboardController@updateBank']);
    Route::get('pending-deposit',['as'=>'pending-deposit','uses'=>'DashboardController@pendingDeposit']);
    Route::post('manual-deposit-approve',['as'=>'manual-deposit-approve','uses'=>'DashboardController@approveManualRequest']);
    Route::post('manual-deposit-cancel',['as'=>'manual-deposit-cancel','uses'=>'DashboardController@cancelManualRequest']);
    Route::get('request-deposit',['as'=>'request-deposit','uses'=>'DashboardController@requestDeposit']);

    Route::get('deposit-history',['as'=>'user-deposit-history','uses'=>'DashboardController@userDepositHistory']);
    Route::get('fund-send-history',['as'=>'fund-send-history','uses'=>'DashboardController@fundSendHistory']);
    Route::get('user-send-fund-preview/{id}',['as'=>'user-send-fund-preview','uses'=>'DashboardController@fundSendHistoryPreview']);

    Route::get('withdraw-method',['as'=>'withdraw-method','uses'=>'DashboardController@withdrawMethod']);
    Route::post('withdraw-method',['as'=>'withdraw-method','uses'=>'DashboardController@storeWithdrawMethod']);
    Route::get('withdraw-show',['as'=>'withdraw-show','uses'=>'DashboardController@showWithdrawMethod']);
    Route::get('withdraw-edit/{id}',['as'=>'withdraw-edit','uses'=>'DashboardController@editWithdrawMethod']);
    Route::put('withdraw-edit/{id}',['as'=>'withdraw-update','uses'=>'DashboardController@updateWithdrawMethod']);

    Route::get('request-view/{id}',['as'=>'request-view','uses'=>'DashboardController@viewRequest']);

    Route::get('withdraw-request-all',['as'=>'withdraw-request-all','uses'=>'DashboardController@allWithdrawRequest']);
    Route::post('withdraw-confirm',['as'=>'withdraw-confirm','uses'=>'DashboardController@confirmWithdraw']);
    Route::post('withdraw-refund',['as'=>'withdraw-refund','uses'=>'DashboardController@refundWithdraw']);
    Route::get('withdraw-confirm-show',['as'=>'withdraw-confirm-show','uses'=>'DashboardController@withdrawConfirm']);
    Route::get('withdraw-pending',['as'=>'withdraw-pending','uses'=>'DashboardController@withdrawPending']);
    Route::get('withdraw-refund-show',['as'=>'withdraw-refund-show','uses'=>'DashboardController@withdrawRefund']);
    Route::get('single-withdraw-view/{id}',['as'=>'single-withdraw-view','uses'=>'DashboardController@singleWithdrawView']);

    Route::get('repeat-history',['as'=>'repeat-history','uses'=>'DashboardController@repeatHistory']);

    Route::get('admin-support',['as'=>'admin-support','uses'=>'DashboardController@adminSupport']);
    Route::get('admin-support-pending',['as'=>'admin-support-pending','uses'=>'DashboardController@adminSupportPending']);
    Route::get('admin-support-mess/{id}',['as'=>'admin-support-mess','uses'=>'DashboardController@adminSupportMessage']);
    Route::post('admin-support-message',['as'=>'admin-support-message','uses'=>'DashboardController@adminSupportMessageSubmit']);
    Route::post('admin-support-close',['as'=>'admin-support-close','uses'=>'DashboardController@adminSupportClose']);

    Route::get('manage-user',['as'=>'manage-user','uses'=>'DashboardController@manageUser']);
    Route::post('block-user',['as'=>'block-user','uses'=>'DashboardController@blockUser']);
    Route::post('unblock-user',['as'=>'unblock-user','uses'=>'DashboardController@unblockUser']);

    Route::get('user-details/{id}',['as'=>'user-details','uses'=>'DashboardController@userDetails']);
    Route::get('user-send-mail/{id}',['as'=>'user-send-mail','uses'=>'DashboardController@userSendMail']);
    Route::post('user-email-submit',['as'=>'user-email-submit','uses'=>'DashboardController@userSendMailSubmit']);
    Route::get('user-money/{id}',['as'=>'user-money','uses'=>'DashboardController@userMoney']);
    Route::post('user-money-submit',['as'=>'user-money-submit','uses'=>'DashboardController@userMoneySubmit']);

    Route::post('user-details-update',['as'=>'user-details-update','uses'=>'DashboardController@userDetailsUpdate']);
    Route::get('show-block-user',['as'=>'show-block-user','uses'=>'DashboardController@showBlockUser']);
    Route::get('all-verify-user',['as'=>'all-verify-user','uses'=>'DashboardController@allVerifyUser']);
    Route::get('phone-unverified-user',['as'=>'phone-unverified-user','uses'=>'DashboardController@phoneUnVerifyUser']);
    Route::get('email-unverified-user',['as'=>'email-unverified-user','uses'=>'DashboardController@emailUnVerifyUser']);

    Route::get('user-repeat-all/{id}',['as'=>'user-repeat-all','uses'=>'DashboardController@userRepeatAll']);
    Route::get('user-deposit-all/{id}',['as'=>'user-deposit-all','uses'=>'DashboardController@userDepositAll']);
    Route::get('user-withdraw-all/{id}',['as'=>'user-withdraw-all','uses'=>'DashboardController@userWithdrawAll']);
    Route::get('user-login-all/{id}',['as'=>'user-login-all','uses'=>'DashboardController@userLogInAll']);

    Route::get('admin-activity',['as'=>'admin-activity','uses'=>'DashboardController@adminActivity']);

    Route::get('automatic-pending-deposit',['as'=>'admin-payment-activity','uses'=>'DashboardController@depositRequest']);

    Route::get('pending-deposit-automatic-change',['as'=>'admin-payment-request-change','uses'=>'DashboardController@depositRequestCancel']);

});

Auth::routes();

Route::get('register/{id}', 'Auth\RegisterController@showReferenceLoginForm')->name('auth.reference-register');

Route::get('email-verify',['as'=>'email-verify','uses'=>'Auth\VerifyController@getEmailVerification']);
Route::post('email-verify-submit',['as'=>'email-verify-submit','uses'=>'Auth\VerifyController@emailVerifySubmit']);
Route::post('resend-verify-submit',['as'=>'resend-verify-submit','uses'=>'Auth\VerifyController@resendEmail']);

Route::get('phone-verify',['as'=>'phone-verify','uses'=>'Auth\VerifyController@getPhoneVerification']);
Route::post('phone-verify-submit',['as'=>'phone-verify-submit','uses'=>'Auth\VerifyController@phoneVerifySubmit']);
Route::post('resend-phone-verify-submit',['as'=>'resend-phone-verify-submit','uses'=>'Auth\VerifyController@resendPhone']);

Route::get('change-phone',['as'=>'change-phone','uses'=>'Auth\VerifyController@changePhone']);
Route::post('change-phone',['as'=>'phone-change-submit','uses'=>'Auth\VerifyController@submitChangePhone']);


Route::group(['prefix' => 'user'], function () {

    Route::get('dashboard',['as'=>'user-dashboard','uses'=>'UserController@getDashboard']);

    Route::get('change-password',['as'=>'change-password','uses'=>'UserController@changePassword']);
    Route::post('change-password',['as'=>'change-password','uses'=>'UserController@submitPassword']);

    Route::get('edit-profile',['as'=>'edit-profile','uses'=>'UserController@editProfile']);
    Route::post('edit-profile',['as'=>'edit-profile','uses'=>'UserController@submitProfile']);

    Route::get('deposit-fund',['as'=>'deposit-fund','uses'=>'UserController@depositMethod']);
    Route::post('deposit-fund',['as'=>'deposit-fund','uses'=>'UserController@submitDepositFund']);
    Route::get('deposit-preview',['as'=>'deposit-preview','uses'=>'UserController@depositPreview']);
    Route::get('deposit-confirm',['as'=>'deposit-confirm','uses'=>'PaymentController@depositConfirm']);
    Route::get('deposit-history',['as'=>'deposit-history','uses'=>'UserController@historyDepositFund']);
    Route::post('manual-deposit-submit',['as'=>'manual-deposit-submit','uses'=>'UserController@manualDepositSubmit']);

    Route::get('transaction-log',['as'=>'user-activity','uses'=>'UserController@userActivity']);
     Route::get('gateway-redirect',['as'=>'gateway-redirect','uses'=>'UserController@gatewayRedirect']);

    Route::get('withdraw-request',['as'=>'withdraw-request','uses'=>'UserController@withdrawRequest']);
    Route::post('withdraw-request',['as'=>'withdraw-request','uses'=>'UserController@submitWithdrawRequest']);
    Route::get('withdraw-preview/{id}',['as'=>'withdraw-preview','uses'=>'UserController@previewWithdraw']);
    Route::post('withdraw-submit',['as'=>'withdraw-submit','uses'=>'UserController@submitWithdraw']);
    Route::get('withdraw-log',['as'=>'withdraw-log','uses'=>'UserController@withdrawLog']);

    Route::get('support-open',['as'=>'support-open','uses'=>'UserController@openSupport']);
    Route::post('support-open',['as'=>'support-open','uses'=>'UserController@submitSupport']);
    Route::get('support-all',['as'=>'support-all','uses'=>'UserController@allSupport']);
    Route::get('support-message/{id}',['as'=>'support-message','uses'=>'UserController@supportMessage']);
    Route::post('user-support-message',['as'=>'user-support-message','uses'=>'UserController@userSupportMessage']);
    Route::post('user-support-close',['as'=>'user-support-close','uses'=>'UserController@supportClose']);

    Route::get('investment-new',['as'=>'investment-new','uses'=>'UserController@newInvest']);
    Route::post('investment-new',['as'=>'investment-post','uses'=>'UserController@postInvest']);
    Route::post('invest-amount-chk',['as'=>'invest-amount-chk','uses'=>'UserController@chkInvestAmount']);
    Route::post('investment-submit',['as'=>'investment-submit','uses'=>'UserController@submitInvest']);
    Route::get('investment-history',['as'=>'investment-history','uses'=>'UserController@historyInvestment']);
    Route::post('invest-amount-review',['as'=>'invest-amount-review','uses'=>'UserController@investAmountReview']);

    Route::get('user-repeat-history',['as'=>'user-repeat-history','uses'=>'UserController@repeatLog']);

//    Route::get('reference-user',['as'=>'reference-user','uses'=>'UserController@userReference']);

});



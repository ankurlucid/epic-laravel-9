<?php

use Illuminate\Support\Facades\Route;
use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Random;
use phpseclib3\Crypt\PublicKeyLoader;
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


Route::post('result', function()
{
	try {
	    \Log::info('Sending XML response');

	    $kReq = random_bytes(32); // 256-bit key
		$ivReq = random_bytes(12); // 96-bit IV

	    $timezoneOffset = '+08:00'; // Change this to your desired timezone offset
		$current_time = new \DateTime('now', new \DateTimeZone('UTC')); // Create a DateTime object in UTC timezone
		$current_time->setTimezone(new \DateTimeZone($timezoneOffset)); // Set the desired timezone

		$signKprivPg = file_get_contents(public_path('Rovertech-selfsigned.key.txt'));
		$oosPubKey = file_get_contents(public_path('OOS Transaction Web API (Testing) v5.crt.pem'));

		// Format the DateTime object to match the specified format
		$formatted_time = $current_time->format('Y-m-d\TH:i:s.vP');

		$gatewayRef = bin2hex(random_bytes(10));
		$pgWsKeyver = "5";

		$reciptId = 'A';
	    $requestXmlBody = '<paymentResult xmlns="http://namespace.oos.online.octopus.com.hk/transaction/" documentTime="'.$formatted_time.'"><amount>10</amount><gatewayId>196956</gatewayId><gatewayRef>'.$gatewayRef.'</gatewayRef><status code="SUCCESS"></status><receiptId>'.$reciptId.'</receiptId><transactionTime>'.$formatted_time.'</transactionTime></paymentResult>';

	    $rsa = PublicKeyLoader::loadPrivateKey($signKprivPg, $password = false);
		$rsa->withHash('sha256');
		$rsa->withMGFHash('sha256');
		$rsa->withPadding(RSA::SIGNATURE_PSS);
		$rsa->withSaltLength(32);
		$signature = $rsa->sign($requestXmlBody);

		$rsa = PublicKeyLoader::loadPublicKey($oosPubKey, $password = false);
		$rsa->withHash('sha256');
		$rsa->withMGFHash('sha256');

		$signedContent = '<signedContent xmlns="http://namespace.oos.online.octopus.com.hk/mls/"><content>' . base64_encode($requestXmlBody) . '</content><signature signerId="196956" keyId="1">' . base64_encode($signature) . '</signature></signedContent>';

		$aes = new AES('gcm');
		$aes->setKey($kReq);   // 256-bit key
		$aes->setNonce($ivReq);  // 96-bit IV
		$cipherText = $aes->encrypt($signedContent, 'gcm');

		// Construct the final encrypted content
		$finalEncryptedContent = '<encryptedContent xmlns="http://namespace.oos.online.octopus.com.hk/mls/"><iv>' . base64_encode($ivReq) . '</iv><ciphertext>' . base64_encode($cipherText) . '</ciphertext><authenticationTag>' . base64_encode($aes->getTag()) . '</authenticationTag><encryptedKey keyId="' . $pgWsKeyver . '">' . base64_encode($rsa->encrypt($kReq)) . '</encryptedKey></encryptedContent>';


	    return response($finalEncryptedContent)->header('Content-Type', 'text/xml');
	} catch (\Exception $e) {
	    \Log::error('Error sending XML response: ' . $e->getMessage());
	    return response('Internal Server Error', 500);
}
});

Route::redirect("/", "/tc");
Route::redirect("/admin", "/en/admin");
Route::redirect("/rovertech", "/en/rovertech");
Route::get('/dashborad_chart1', [App\Http\Controllers\ChartController::class, 'dashborad_chart1']);
Route::get('/dashborad_chart2', [App\Http\Controllers\ChartController::class, 'dashborad_chart2']);
Route::get('/download-mobile-recepit/{donaction_id}/{donaction_token}/{lang}', [App\Http\Controllers\ChartController::class, 'download_mobile_recepit'])->name('download_mobile_recepit');
Route::get('/test-list', [App\Http\Controllers\ChartController::class, 'testlist']);
Route::get('/deeplinkurl', [App\Http\Controllers\ChartController::class, 'deeplinkurl'])->name('front.deeplinkurl');
Route::get('/paymertest/', [App\Http\Controllers\ChartController::class, 'paymertest'])->name('front.paymertest');
Route::get('/appoprn/apple-app-site-association/', [App\Http\Controllers\ChartController::class, 'paymertest'])->name('front.paymertest');
Route::get('/openapp/', [App\Http\Controllers\ChartController::class, 'paymertest'])->name('front.paymertest');



Route::get('/paywithpaypal', [App\Http\Controllers\PayPalController::class, 'payWithPaypal'])->name('paywithpaypal');
Route::post('/paypal', [App\Http\Controllers\PayPalController::class, 'postPaymentWithpaypal'])->name('paypal');
Route::get('/paypalstatus', [App\Http\Controllers\PayPalController::class, 'getPaymentStatus'])->name('status');
Route::get('/fpsPayment', [App\Http\Controllers\FpsPaymentController::class, 'fpsPayment'])->name('fpsPayment');
Route::get('/testapiVal', [App\Http\Controllers\ApiController::class, 'testapiVal']);
Route::get('/privacy-policies', [App\Http\Controllers\PagesController::class, 'privacypolicys'])->name('front.privacypolicys');

// new testing route 

Route::get('/octopuspaymentnew', [App\Http\Controllers\GlobalController::class, 'octopuspaymentnew']);
Route::get('/octopuspayment', [App\Http\Controllers\GlobalController::class, 'octopuspayment']);

Route::get('/octopuspaymentrequest', [App\Http\Controllers\GlobalController::class, 'octopuspayment']);
Route::get('/octopusnotification/', [App\Http\Controllers\AsiaPaymentController::class, 'octopusnotification'])->name('front.octopusnotification');

// new testing route end

Route::group(['prefix' => '{language}', 'middleware' => ['lang']], function () {

	Route::get('/donation-alert', [App\Http\Controllers\NotificationController::class, 'index']);
	Route::post('/checksession', [App\Http\Controllers\GlobalController::class, 'checksession'])->name('front.checksession');
	// Route::get('/view-recepit/{id}', [App\Http\Controllers\GlobalController::class, 'view_recepit'])->name('front.view_recepit');

	Route::get('/view-recepit/{id}', [App\Http\Controllers\GlobalController::class, 'view_recepit_new'])->name('front.view_recepit_new');
	Route::get('/export-file/{token}', [App\Http\Controllers\GlobalController::class, 'export_file'])->name('front.export_file');

	Auth::routes();
	Route::get('/testmessage', [App\Http\Controllers\FrontController::class, 'testmessage'])->name('front.testmessage');
	Route::get('/testemail', [App\Http\Controllers\FrontController::class, 'testemail'])->name('front.testemail');

	Route::get('/paymePaymeny', [App\Http\Controllers\FrontController::class, 'testpayment'])->name('front.testpayment');


	Route::get('/test-invoice', [App\Http\Controllers\InvoiceController::class, 'invoice'])->name('donwload-invoice');
	Route::get('/test-recepit', [App\Http\Controllers\InvoiceController::class, 'recepit'])->name('donwload-recepit');
	Route::get('/test-email', [App\Http\Controllers\InvoiceController::class, 'test_email'])->name('donwload-email');

	Route::get('/download-invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('donwload-invoice');
	Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('front');
	Route::post('/load_slider', [App\Http\Controllers\FrontController::class, 'load_slider'])->name('load_slider');

	Route::get('/churchs', [App\Http\Controllers\ChurchsController::class, 'index'])->name('front.churchs');
	Route::get('/churchs/{id}', [App\Http\Controllers\ChurchsController::class, 'view'])->name('front.churchs.view');


	Route::get('/institution/{type}/', [App\Http\Controllers\InstitutionsController::class, 'index'])->name('front.institutions');
	Route::get('/institutions/{cat}/{id}', [App\Http\Controllers\InstitutionsController::class, 'view'])->name('front.institutions.view');

	Route::get('/events', [App\Http\Controllers\EventsController::class, 'index'])->name('front.events');
	Route::get('/events/{id}', [App\Http\Controllers\EventsController::class, 'view'])->name('front.events.view');
	Route::get('/donation/{id}', [App\Http\Controllers\DonationController::class, 'step1'])->name('front.donation');
	Route::post('/make-donations/', [App\Http\Controllers\DonationController::class, 'donations_save'])->name('front.donations.save');
	Route::get('/thanks-you/{token}', [App\Http\Controllers\DonationController::class, 'thanks_you'])->name('front.thanks_you');

	Route::get('/makepayment/{token}', [App\Http\Controllers\DonationController::class, 'makepayment'])->name('front.donations.makepayment');
	Route::post('/makepayment', [App\Http\Controllers\DonationController::class, 'makepaymentpost'])->name('front.donations.makepaymentpost');


	// Route::get('/history', [App\Http\Controllers\PagesController::class, 'history'])->name('front.history');
	Route::get('/mission', [App\Http\Controllers\PagesController::class, 'mission'])->name('front.mission');
	Route::get('/privacy-policy', [App\Http\Controllers\PagesController::class, 'privacypolicy'])->name('front.privacypolicy');

	Route::get('/privacy-policies', [App\Http\Controllers\PagesController::class, 'privacypolicys'])->name('front.privacypolicys');
	Route::get('/faq', [App\Http\Controllers\PagesController::class, 'faq'])->name('front.faq');
	Route::get('/about-us', [App\Http\Controllers\PagesController::class, 'about_us'])->name('front.about_us');
	Route::get('/contact-us', [App\Http\Controllers\ContactusController::class, 'contact_us'])->name('front.contact_us');

	Route::post('/check-phone', [App\Http\Controllers\GlobalController::class, 'check_phone'])->name('front.check-phone');
	Route::post('/verify-otp', [App\Http\Controllers\GlobalController::class, 'verify_otp'])->name('front.verify_otp');
	Route::post('/verify-completed', [App\Http\Controllers\GlobalController::class, 'regi_completed'])->name('front.completed');

	Route::post('/newsletter', [App\Http\Controllers\GlobalController::class, 'update_newsletter'])->name('front.update_newsletter');


	Route::post('/front-completed', [App\Http\Controllers\GlobalController::class, 'newslatter'])->name('front.newslatter');
	Route::get('/confirmation', [App\Http\Controllers\GlobalController::class, 'confirmation'])->name('front.confirmation');
	Route::get('/registercompleted', [App\Http\Controllers\GlobalController::class, 'registercompleted'])->name('front.registercompleted');

	Route::get('/verifyemail/{token}', [App\Http\Controllers\GlobalController::class, 'verifyemail'])->name('front.verifyemail');
	Route::get('/editverifyemail/{token}', [App\Http\Controllers\GlobalController::class, 'editverifyemail'])->name('front.editverifyemail');

	Route::post('/forget/', [App\Http\Controllers\GlobalController::class, 'forget'])->name('front.forget');
	Route::post('/forget/confirm', [App\Http\Controllers\GlobalController::class, 'forget_cofirm'])->name('front.forget.confirm');
	Route::get('/forget/update/', [App\Http\Controllers\GlobalController::class, 'forget_update'])->name('front.forget.update');
	Route::post('/forget/update/', [App\Http\Controllers\GlobalController::class, 'forget_update_change'])->name('front.forget.change');

	Route::post('/donationOtp/', [App\Http\Controllers\GlobalController::class, 'donationOtp'])->name('front.donationOtp');
	
	Route::get('/donationOtp2/', [App\Http\Controllers\GlobalController::class, 'donationOtp2'])->name('front.donationOtp2');

	Route::get('/payment-submit/{id}', [App\Http\Controllers\AsiaPaymentController::class, 'payment_submit'])->name('front.payment_submit');
	Route::get('/payme-submit/{id}', [App\Http\Controllers\AsiaPaymentController::class, 'payme_submit'])->name('front.payme_submit');
	Route::get('/fps-submit/{id}', [App\Http\Controllers\AsiaPaymentController::class, 'fps_submit'])->name('front.fps_submit');
	Route::get('/fps-submit/{id}', [App\Http\Controllers\AsiaPaymentController::class, 'fps_submit'])->name('front.fps_submit');
	Route::get('/octopus-submit/{id}', [App\Http\Controllers\AsiaPaymentController::class, 'octopus_submit'])->name('front.octopus_submit');
	Route::get('/payment-succfully/', [App\Http\Controllers\AsiaPaymentController::class, 'payment_succfully'])->name('front.payment_succfully');
	Route::get('/paypal-succfully/', [App\Http\Controllers\PayPalController::class, 'paypal_paymentsucess'])->name('front.paypal_succfully');
	Route::get('/paypal-cancel/', [App\Http\Controllers\PayPalController::class, 'chanelgetPaymentStatus'])->name('front.paypal_cancel');

	Route::get('/payme-succfully/', [App\Http\Controllers\AsiaPaymentController::class, 'paymeconfirmation'])->name('front.payme_succfully');
	Route::get('/payme-fail/', [App\Http\Controllers\AsiaPaymentController::class, 'payme_fail'])->name('front.payme_fail');

	Route::get('/payment-cancel/', [App\Http\Controllers\AsiaPaymentController::class, 'payment_cancel'])->name('front.payment_cancel');
	Route::get('/payment-fail/', [App\Http\Controllers\AsiaPaymentController::class, 'payment_fail'])->name('front.payment_fail');
	Route::post('/getnotification', [App\Http\Controllers\AsiaPaymentController::class, 'getnotification'])->name('front.getnotification');
	Route::post('/finalgetnotification', [App\Http\Controllers\AsiaPaymentController::class, 'finalgetnotification'])->name('front.finalgetnotification');

	Route::get('/notificationstatus/', [App\Http\Controllers\AsiaPaymentController::class, 'notificationstatusV'])->name('front.notificationstatusV');
	Route::post('/fpsnotification/', [App\Http\Controllers\AsiaPaymentController::class, 'fpsnotification'])->name('front.fpsnotification');



	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::prefix('member')->group(function () {
		Route::get('/', [App\Http\Controllers\Member\MemberDashboardController::class, 'index'])->name('member.dashboard.index');
		Route::get('/profile-edit', [App\Http\Controllers\Member\MemberDashboardController::class, 'profileedit'])->name('member.dashboard.profileedit');
		Route::get('/my-profile', [App\Http\Controllers\Member\MemberDashboardController::class, 'myprofile'])->name('member.dashboard.myprofile');
		Route::get('/my-account', [App\Http\Controllers\Member\MemberDashboardController::class, 'myacccount'])->name('member.dashboard.myacccount');
		Route::post('/my-account', [App\Http\Controllers\Member\MemberDashboardController::class, 'myacccountUpdate'])->name('member.dashboard.myacccountUpdate');

		Route::get('/force-update', [App\Http\Controllers\Member\MemberDashboardController::class, 'forceupdate'])->name('member.dashboard.forceupdate');
		Route::post('/force-update', [App\Http\Controllers\Member\MemberDashboardController::class, 'forceupdateidpate'])->name('member.dashboard.forceupdate');

		Route::get('/update-phone', [App\Http\Controllers\Member\MemberDashboardController::class, 'updatephone'])->name('member.dashboard.updatephone');
		Route::post('/update-phone', [App\Http\Controllers\Member\MemberDashboardController::class, 'sendupdatephone'])->name('member.dashboard.sendupdatephone');
		Route::get('/update-email', [App\Http\Controllers\Member\MemberDashboardController::class, 'updateemail'])->name('member.dashboard.updateemail');
		Route::post('/update-email', [App\Http\Controllers\Member\MemberDashboardController::class, 'sendupdateemail'])->name('member.dashboard.sendupdateemail');
		Route::post('/chart1update', [App\Http\Controllers\Member\MemberDashboardController::class, 'chart1update'])->name('member.dashboard.chart1update');
		Route::post('/chart2update', [App\Http\Controllers\Member\MemberDashboardController::class, 'chart2update'])->name('member.dashboard.chart2update');
		Route::get('/delete-user', [App\Http\Controllers\Member\MemberDashboardController::class, 'deleteuser'])->name('member.dashboard.deleteuser');
		Route::post('/delete-user', [App\Http\Controllers\Member\MemberDashboardController::class, 'deleteuserupdate'])->name('member.dashboard.deleteuserupdate');
		Route::post('/chart11update', [App\Http\Controllers\Member\MemberDashboardController::class, 'chart11update'])->name('member.dashboard.chart11update');


		Route::get('/donation-history', [App\Http\Controllers\Member\MemberDashboardController::class, 'donationhistory'])->name('member.dashboard.donationhistory');
		Route::get('/donation-details/{id}', [App\Http\Controllers\Member\MemberDashboardController::class, 'donationdetails'])->name('member.dashboard.donationdetails');
		Route::post('/donation-details/cancel', [App\Http\Controllers\Member\MemberDashboardController::class, 'cancel_donation'])->name('member.dashboard.cancel_donation');
		Route::get('/donation-details/{id}/refund', [App\Http\Controllers\Member\MemberDashboardController::class, 'refund_donation'])->name('member.dashboard.refund');
		Route::post('/filter-history', [App\Http\Controllers\Member\MemberDashboardController::class, 'filterhistory'])->name('member.dashboard.filterdata');

		Route::post('/filter-export', [App\Http\Controllers\Member\MemberDashboardController::class, 'filterexport'])->name('member.dashboard.filterexport');

		Route::get('/newsletter', [App\Http\Controllers\Member\MemberDashboardController::class, 'newsletter'])->name('member.dashboard.newsletter');
		//Route::get('/view-recepit/{id}', [App\Http\Controllers\Member\MemberDashboardController::class, 'view_recepit'])->name('member.view_recepit');
		Route::get('/view-recepit/{id}', [App\Http\Controllers\Member\MemberDashboardController::class, 'view_recepit_new'])->name('member.view_recepit');
	});


	Route::post('/loginsubmit', [App\Http\Controllers\Auth\LoginController::class, 'loginsubmit'])->name('loginsubmit');

	Route::prefix('rovertech')->group(function () {
		Route::get('/', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
		Route::post('/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');
		Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
		Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
	});
	Route::prefix('admin')->group(function () {

		Route::get('/login', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.login2');
		Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
		Route::post('/checksession', [App\Http\Controllers\Admin\AdminDashboardController::class, 'checksession'])->name('admin.checksession');
		Route::get('/post/preview', [App\Http\Controllers\Admin\AdminDashboardController::class, 'preview'])->name('admin.preview');

		Route::get('/chrushs', [App\Http\Controllers\Admin\AdminChrushsController::class, 'index'])->name('admin.chrushs');
		Route::get('/chrushs/create', [App\Http\Controllers\Admin\AdminChrushsController::class, 'create'])->name('admin.chrushs.create');
		Route::post('/chrushs/create', [App\Http\Controllers\Admin\AdminChrushsController::class, 'store'])->name('admin.chrushs.save');
		Route::get('/chrushs/edit/{id}', [App\Http\Controllers\Admin\AdminChrushsController::class, 'edit'])->name('admin.chrushs.edit');
		Route::post('/chrushs/edit/{id}', [App\Http\Controllers\Admin\AdminChrushsController::class, 'update'])->name('admin.chrushs.update');
		Route::post('/chrushs/view/{id}', [App\Http\Controllers\Admin\AdminChrushsController::class, 'view'])->name('admin.chrushs.view');
		Route::post('/chrushs/delete', [App\Http\Controllers\Admin\AdminChrushsController::class, 'delete'])->name('admin.chrushs.delete');
		Route::get('/chrushs/bulkaction/', [App\Http\Controllers\Admin\AdminChrushsController::class, 'bulkaction'])->name('admin.chrushs.bulkaction');


		Route::get('/donateitem', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'index'])->name('admin.donateitem');
		Route::get('/donateitem/create', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'create'])->name('admin.donateitem.create');
		Route::post('/donateitem/create', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'store'])->name('admin.donateitem.save');
		Route::get('/donateitem/edit/{id}', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'edit'])->name('admin.donateitem.edit');
		Route::post('/donateitem/edit/{id}', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'update'])->name('admin.donateitem.update');
		Route::post('/donateitem/view/{id}', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'view'])->name('admin.donateitem.view');
		Route::post('/donateitem/delete', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'delete'])->name('admin.donateitem.delete');
		Route::get('/donateitem/bulkaction/', [App\Http\Controllers\Admin\AdminDonateItemController::class, 'bulkaction'])->name('admin.donateitem.bulkaction');




		Route::get('/notifications', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'index'])->name('admin.notifications');
		Route::get('/notifications/create', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'create'])->name('admin.notifications.create');
		Route::post('/notifications/create', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'store'])->name('admin.notifications.save');
		Route::get('/notifications/edit/{id}', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'edit'])->name('admin.notifications.edit');
		Route::post('/notifications/edit/{id}', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'update'])->name('admin.notifications.update');
		Route::get('/notifications/view/{id}', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'view'])->name('admin.notifications.view');
		Route::post('/notifications/delete', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'delete'])->name('admin.notifications.delete');
		Route::get('/notifications/bulkaction/', [App\Http\Controllers\Admin\AdminNotificationsController::class, 'bulkaction'])->name('admin.notifications.bulkaction');



		Route::get('/institutions', [App\Http\Controllers\Admin\AdminInstitutionsController::class, 'index'])->name('admin.institutions');
		Route::get('/institutions/create', [App\Http\Controllers\Admin\AdminInstitutionsController::class, 'create'])->name('admin.institutions.create');
		Route::post('/institutions/create', [App\Http\Controllers\Admin\AdminInstitutionsController::class, 'store'])->name('admin.institutions.save');
		Route::get('/institutions/edit/{id}', [App\Http\Controllers\Admin\AdminInstitutionsController::class, 'edit'])->name('admin.institutions.edit');
		Route::post('/institutions/edit/{id}', [App\Http\Controllers\Admin\AdminInstitutionsController::class, 'update'])->name('admin.institutions.update');
		Route::get('/institutions/bulkaction/', [App\Http\Controllers\Admin\AdminInstitutionsController::class, 'bulkaction'])->name('admin.institutions.bulkaction');

		Route::get('/events', [App\Http\Controllers\Admin\AdminEventsController::class, 'index'])->name('admin.events');
		Route::get('/events/create', [App\Http\Controllers\Admin\AdminEventsController::class, 'create'])->name('admin.events.create');
		Route::post('/events/create', [App\Http\Controllers\Admin\AdminEventsController::class, 'store'])->name('admin.events.save');
		Route::get('/events/edit/{id}', [App\Http\Controllers\Admin\AdminEventsController::class, 'edit'])->name('admin.events.edit');
		Route::post('/events/edit/{id}', [App\Http\Controllers\Admin\AdminEventsController::class, 'update'])->name('admin.events.update');
		Route::get('/events/bulkaction/', [App\Http\Controllers\Admin\AdminEventsController::class, 'bulkaction'])->name('admin.events.bulkaction');

		Route::get('/my-account', [App\Http\Controllers\Admin\AdminDashboardController::class, 'myaccount'])->name('admin.myaccount');
		Route::post('/my-account', [App\Http\Controllers\Admin\AdminDashboardController::class, 'myaccountupdate'])->name('admin.myaccount.update');

		Route::get('/force-update', [App\Http\Controllers\Admin\AdminDashboardController::class, 'forceupdate'])->name('admin.forceupdate');
		Route::post('/force-update', [App\Http\Controllers\Admin\AdminDashboardController::class, 'forceupdateaction'])->name('admin.forceupdate.update');


		Route::get('/members', [App\Http\Controllers\Admin\AdminMembersController::class, 'index'])->name('admin.members');
		Route::get('/members/create', [App\Http\Controllers\Admin\AdminMembersController::class, 'create'])->name('admin.members.create');
		Route::post('/members/create', [App\Http\Controllers\Admin\AdminMembersController::class, 'store'])->name('admin.members.save');
		Route::get('/members/edit/{id}', [App\Http\Controllers\Admin\AdminMembersController::class, 'edit'])->name('admin.members.edit');
		Route::post('/members/edit', [App\Http\Controllers\Admin\AdminMembersController::class, 'update'])->name('admin.members.update');
		Route::get('/members/view/{id}', [App\Http\Controllers\Admin\AdminMembersController::class, 'view'])->name('admin.members.view');
		Route::post('/members/delete', [App\Http\Controllers\Admin\AdminMembersController::class, 'delete'])->name('admin.members.delete');
		Route::get('/members/bulkaction/', [App\Http\Controllers\Admin\AdminMembersController::class, 'bulkaction'])->name('admin.members.bulkaction');

		Route::post('/searchuser', [App\Http\Controllers\Admin\AdminMembersController::class, 'searchuser'])->name('admin.searchuser');
		Route::post('/adminverifyemail', [App\Http\Controllers\Admin\AdminMembersController::class, 'adminverifyemail'])->name('admin.adminverifyemail');
		Route::post('/adminverifyemailOTP', [App\Http\Controllers\Admin\AdminMembersController::class, 'adminverifyemailOTP'])->name('admin.adminverifyemailOTP');
		Route::post('/adminsendactivationemail', [App\Http\Controllers\Admin\AdminMembersController::class, 'adminsendactivationemail'])->name('admin.adminsendactivationemail');
		Route::post('/newadminsendactivationemail', [App\Http\Controllers\Admin\AdminMembersController::class, 'newadminsendactivationemail'])->name('admin.newadminsendactivationemail');

		Route::post('/adminverifyphone', [App\Http\Controllers\Admin\AdminMembersController::class, 'adminverifyphone'])->name('admin.adminverifyphone');
		Route::post('/adminverifyphoneconfirm', [App\Http\Controllers\Admin\AdminMembersController::class, 'adminverifyphoneconfirm'])->name('admin.adminverifyphoneconfirm');


		Route::get('/adminusers', [App\Http\Controllers\Admin\AdminUsersController::class, 'index'])->name('admin.adminusers');
		Route::get('/adminusers/create', [App\Http\Controllers\Admin\AdminUsersController::class, 'create'])->name('admin.adminusers.create');
		Route::post('/adminusers/create', [App\Http\Controllers\Admin\AdminUsersController::class, 'store'])->name('admin.adminusers.save');
		Route::get('/adminusers/edit/{id}', [App\Http\Controllers\Admin\AdminUsersController::class, 'edit'])->name('admin.adminusers.edit');
		Route::post('/adminusers/edit/{id}', [App\Http\Controllers\Admin\AdminUsersController::class, 'update'])->name('admin.adminusers.update');
		Route::post('/adminusers/view/{id}', [App\Http\Controllers\Admin\AdminUsersController::class, 'view'])->name('admin.adminusers.view');
		Route::post('/adminusers/delete', [App\Http\Controllers\Admin\AdminUsersController::class, 'delete'])->name('admin.adminusers.delete');
		Route::get('/adminusers/bulkaction/', [App\Http\Controllers\Admin\AdminUsersController::class, 'bulkaction'])->name('admin.adminusers.bulkaction');

		Route::get('/role-permission', [App\Http\Controllers\Admin\AdminUsersController::class, 'role_permission'])->name('admin.role_permission');
		Route::get('/role-permission/bulkaction', [App\Http\Controllers\Admin\AdminUsersController::class, 'role_permission_update'])->name('admin.role_permission_update');


		Route::get('/pages', [App\Http\Controllers\Admin\AdminPagesController::class, 'index'])->name('admin.pages');
		Route::get('/pages/edit/{id}', [App\Http\Controllers\Admin\AdminPagesController::class, 'edit'])->name('admin.pages.edit');
		Route::post('/pages/edit/{id}', [App\Http\Controllers\Admin\AdminPagesController::class, 'update'])->name('admin.pages.update');
		Route::get('/pages/bulkaction/', [App\Http\Controllers\Admin\AdminPagesController::class, 'bulkaction'])->name('admin.pages.bulkaction');



		Route::get('/contact-us/edit', [App\Http\Controllers\Admin\AdminSettingController::class, 'edit'])->name('admin.contact.edit');
		Route::post('/contact-us/edit/{id}/update', [App\Http\Controllers\Admin\AdminSettingController::class, 'update'])->name('admin.contact.update');

		Route::get('/logo-setting/edit', [App\Http\Controllers\Admin\AdminSettingController::class, 'logo_edit'])->name('admin.logo.edit');
		Route::post('/logo-setting/edit/{id}/update', [App\Http\Controllers\Admin\AdminSettingController::class, 'logo_update'])->name('admin.logo.update');

		Route::get('/user-guide/edit', [App\Http\Controllers\Admin\AdminSettingController::class, 'user_guide'])->name('admin.user_guide.edit');
		Route::post('/user-guide/edit/{id}/update', [App\Http\Controllers\Admin\AdminSettingController::class, 'user_guide_update'])->name('admin.user_guide.update');


		Route::get('/social-setting/edit', [App\Http\Controllers\Admin\AdminSettingController::class, 'social_edit'])->name('admin.social.edit');
		Route::post('/social-setting/edit/{id}/update', [App\Http\Controllers\Admin\AdminSettingController::class, 'social_update'])->name('admin.social.update');

		Route::get('/service-charge/edit', [App\Http\Controllers\Admin\AdminSettingController::class, 'fees_edit'])->name('admin.fees_charges.edit');
		Route::post('/service-charge/edit/{id}/update', [App\Http\Controllers\Admin\AdminSettingController::class, 'fees_update'])->name('admin.fees_charges.update');

		Route::get('/app-version/edit', [App\Http\Controllers\Admin\AdminSettingController::class, 'version_edit'])->name('admin.app_version.edit');
		Route::post('/app-version/edit/{id}/update', [App\Http\Controllers\Admin\AdminSettingController::class, 'version_update'])->name('admin.app_version.update');

		Route::get('/version', [App\Http\Controllers\Admin\AdminAapversionController::class, 'index'])->name('admin.version');
		Route::get('/version/create', [App\Http\Controllers\Admin\AdminAapversionController::class, 'create'])->name('admin.version.create');
		Route::post('/version/create', [App\Http\Controllers\Admin\AdminAapversionController::class, 'store'])->name('admin.version.save');
		Route::get('/version/edit/{id}', [App\Http\Controllers\Admin\AdminAapversionController::class, 'edit'])->name('admin.version.edit');
		Route::post('/version/edit/{id}', [App\Http\Controllers\Admin\AdminAapversionController::class, 'update'])->name('admin.version.update');
		Route::get('/version/view/{id}', [App\Http\Controllers\Admin\AdminAapversionController::class, 'view'])->name('admin.version.view');
		Route::post('/version/delete', [App\Http\Controllers\Admin\AdminAapversionController::class, 'delete'])->name('admin.version.delete');
		Route::get('/version/bulkaction/', [App\Http\Controllers\Admin\AdminAapversionController::class, 'bulkaction'])->name('admin.version.bulkaction');

		Route::get('/slider', [App\Http\Controllers\Admin\AdminSliderController::class, 'index'])->name('admin.slider');
		Route::get('/slider/create', [App\Http\Controllers\Admin\AdminSliderController::class, 'create'])->name('admin.slider.create');
		Route::post('/slider/create', [App\Http\Controllers\Admin\AdminSliderController::class, 'store'])->name('admin.slider.save');
		Route::get('/slider/edit/{id}', [App\Http\Controllers\Admin\AdminSliderController::class, 'edit'])->name('admin.slider.edit');
		Route::post('/slider/edit/{id}', [App\Http\Controllers\Admin\AdminSliderController::class, 'update'])->name('admin.slider.update');
		Route::get('/slider/view/{id}', [App\Http\Controllers\Admin\AdminSliderController::class, 'view'])->name('admin.slider.view');
		Route::post('/slider/delete', [App\Http\Controllers\Admin\AdminSliderController::class, 'delete'])->name('admin.slider.delete');
		Route::get('/slider/bulkaction/', [App\Http\Controllers\Admin\AdminSliderController::class, 'bulkaction'])->name('admin.slider.bulkaction');

		Route::get('/application-slider', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'index'])->name('admin.application.slider');
		Route::get('/application-slider/create', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'create'])->name('admin.application.slider.create');
		Route::post('/application-slider/create', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'store'])->name('admin.application.slider.save');
		Route::get('/application-slider/edit/{id}', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'edit'])->name('admin.application.slider.edit');
		Route::post('/application-slider/edit/{id}', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'update'])->name('admin.application.slider.update');
		Route::get('/application-slider/view/{id}', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'view'])->name('admin.application.slider.view');
		Route::post('/application-slider/delete', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'delete'])->name('admin.application.slider.delete');
		Route::get('/application-slider/bulkaction/', [App\Http\Controllers\Admin\ApplicationSliderController::class, 'bulkaction'])->name('admin.application.slider.bulkaction');

		Route::get('/newslatter', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'index'])->name('admin.newslatter');
		Route::get('/newslatter/create', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'create'])->name('admin.newslatter.create');
		Route::post('/newslatter/create', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'store'])->name('admin.newslatter.save');
		Route::get('/newslatter/edit/{id}', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'edit'])->name('admin.newslatter.edit');
		Route::post('/newslatter/edit/{id}', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'update'])->name('admin.newslatter.update');
		Route::get('/newslatter/view/{id}', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'view'])->name('admin.newslatter.view');
		Route::post('/newslatter/delete', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'delete'])->name('admin.newslatter.delete');
		Route::get('/newslatter/bulkaction/', [App\Http\Controllers\Admin\AdminNewslatterController::class, 'bulkaction'])->name('admin.newslatter.bulkaction');

		Route::get('/countries', [App\Http\Controllers\Admin\AdminCountriesController::class, 'index'])->name('admin.countries');
		Route::get('/countries/create', [App\Http\Controllers\Admin\AdminCountriesController::class, 'create'])->name('admin.countries.create');
		Route::post('/countries/create', [App\Http\Controllers\Admin\AdminCountriesController::class, 'store'])->name('admin.countries.save');
		Route::get('/countries/edit/{id}', [App\Http\Controllers\Admin\AdminCountriesController::class, 'edit'])->name('admin.countries.edit');
		Route::post('/countries/edit/{id}', [App\Http\Controllers\Admin\AdminCountriesController::class, 'update'])->name('admin.countries.update');
		Route::post('/countries/view/{id}', [App\Http\Controllers\Admin\AdminCountriesController::class, 'view'])->name('admin.countries.view');
		Route::post('/countries/delete', [App\Http\Controllers\Admin\AdminCountriesController::class, 'delete'])->name('admin.countries.delete');
		Route::get('/countries/bulkaction/', [App\Http\Controllers\Admin\AdminCountriesController::class, 'bulkaction'])->name('admin.countries.bulkaction');

		Route::get('/languages', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'index'])->name('admin.languages');
		Route::get('/languages/create', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'create'])->name('admin.languages.create');
		Route::post('/languages/create', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'store'])->name('admin.languages.save');
		Route::get('/languages/edit/{id}', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'edit'])->name('admin.languages.edit');
		Route::post('/languages/edit/{id}', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'update'])->name('admin.languages.update');
		Route::post('/languages/view/{id}', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'view'])->name('admin.languages.view');
		Route::post('/languages/delete', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'delete'])->name('admin.languages.delete');
		Route::get('/languages/bulkaction/', [App\Http\Controllers\Admin\AdminLanguagesController::class, 'bulkaction'])->name('admin.languages.bulkaction');


		Route::get('/donations', [App\Http\Controllers\Admin\DonationsAdminController::class, 'index'])->name('admin.donations');
		Route::get('/donations/create', [App\Http\Controllers\Admin\DonationsAdminController::class, 'create'])->name('admin.donations.create');
		Route::post('/donations/create', [App\Http\Controllers\Admin\DonationsAdminController::class, 'store'])->name('admin.donations.save');
		Route::get('/donations/edit/{id}', [App\Http\Controllers\Admin\DonationsAdminController::class, 'edit'])->name('admin.donations.edit');
		Route::post('/donations/edit/{id}', [App\Http\Controllers\Admin\DonationsAdminController::class, 'update'])->name('admin.donations.update');
		Route::get('/donations/view/{id}', [App\Http\Controllers\Admin\DonationsAdminController::class, 'view'])->name('admin.donations.view');
		Route::get('/donations/view-invoice/{id}', [App\Http\Controllers\Admin\DonationsAdminController::class, 'view_invoice'])->name('admin.donations.view_invoice');
		Route::get('/donations/view-recepit/{id}', [App\Http\Controllers\Admin\DonationsAdminController::class, 'view_recepit'])->name('admin.donations.view_recepit');
		Route::post('/get_donateditem', [App\Http\Controllers\Admin\DonationsAdminController::class, 'getonatiomitem'])->name('admin.donations.getonatiomitem');


		Route::post('/donations/delete', [App\Http\Controllers\Admin\DonationsAdminController::class, 'delete'])->name('admin.donations.delete');
		Route::get('/donations/bulkaction/', [App\Http\Controllers\Admin\DonationsAdminController::class, 'bulkaction'])->name('admin.donations.bulkaction');

		Route::get('/payment-settigs', [App\Http\Controllers\Admin\DonationsAdminController::class, 'paymentsettigs'])->name('payment-settigs');
		Route::post('/payment-settigs', [App\Http\Controllers\Admin\DonationsAdminController::class, 'updatepaymentsettigs'])->name('update-payment-settigs');
		Route::get('/export-csv', [App\Http\Controllers\Admin\DonationsAdminController::class, 'export_csv'])->name('export_csv');
		Route::get('/memberexport-csv', [App\Http\Controllers\Admin\AdminMembersController::class, 'memberexport_csv'])->name('memberexport_csv');
		Route::get('/logs', [App\Http\Controllers\Admin\logsController::class, 'index'])->name('admin.logs');
		Route::get('/logs/bulkaction/', [App\Http\Controllers\Admin\logsController::class, 'bulkaction'])->name('admin.logs.bulkaction');
	});
});

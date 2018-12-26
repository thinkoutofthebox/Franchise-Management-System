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
Route::get('/lead-form', 'Common\LeadController@leadForm')->name('lead-form');
Route::post('/save-lead', 'Common\LeadController@saveLead');
Route::get('/test', 'TestController@index');

Auth::routes();

//Get City By State Ajax Request
	Route::post('/get-city-state', 'AjaxController@getCityState');
	Route::post('/get-product-batches', 'AjaxController@getProductBatches');
	Route::post('/verify-otp', 'AjaxController@verifyOtp');
	Route::post('/resend-otp', 'AjaxController@resendOtp');
	Route::post('/get-product-elc', 'AjaxController@getProductElc');

/**
 * Franchise Routes
 */
Route::group(['middleware' => 'Franchise'], function()
{
	Route::get('/franchise', 'DashboardController@index')->name('franchise');
	Route::get('/profile', 'DashboardController@profile')->name('profile');
	//Capture Franchise Information Routes
	Route::get('/franchise-info-form', 'DashboardController@franchiseInfoForm')->name('/franchise-info-form');
	Route::post('/save-franchise-info', 'DashboardController@saveFranchiseInfo');

	//Student URL
	Route::get('/check-registered-phone/{phone_number}', 'StudentController@checkRegisteredPhone');
	Route::get('/student-registration-form', 'StudentController@showRegistrationForm')->name('student-registration-form');
	Route::get('/student-enquiry', 'StudentController@showRegistrationForm')->name('student-enquiry');
	Route::get('/student-request-demo', 'StudentController@showRegistrationForm')->name('student-request-demo');
	Route::get('/student-fee-form/{student_id}/{product_id}', 'StudentController@studentFeeForm')->name('student-fee-form');
	Route::post('/register-student', 'StudentController@registerStudent');
	Route::post('/update-student-details', 'StudentController@updateStudentDetails');
	Route::post('/save-student-fee', 'StudentController@saveStudentFee');
	Route::post('/save-balance-fee', 'StudentController@saveBalanceFee');

	Route::get('/students-list', 'StudentController@studentsList')->name('students-list');
	Route::get('/load-students-list', 'StudentController@loadStudentsList');

	Route::get('/students-lead-list', 'StudentController@studentsLeadList')->name('students-lead-list');
	Route::get('/load-students-lead-list', 'StudentController@loadStudentLeadsList');

	Route::get('/student-details/{id}', 'StudentController@studentDetails');
	Route::get('/edit-student-profile/{student_id}', 'StudentController@studentEditProfile');
	Route::get('/demo-class-form/{student_id}/{product_id}', 'StudentController@demoClassForm')->name('demo-class-form');
	Route::post('/schedule-demo-class', 'StudentController@scheduleDemoClass');
	Route::post('/course-left', 'StudentController@courseLeft');

	Route::get('/new-product-form/{student_id}', 'StudentController@newProductForm')->name('new-product-form');
	Route::post('/load-form', 'StudentController@loadForm');
	Route::post('/schedule-new-demo', 'StudentController@scheduleNewDemo')->name('schedule-new-demo');
	Route::post('/register-new-paid-product', 'StudentController@registerNewPaidProduct')->name('register-new-paid-product');


	Route::get('/request-batch', 'FranchiseController@requestBatchForm')->name('request-batch');
	Route::post('/request-batch', 'FranchiseController@requestBatch');

	Route::get('/batch-list', 'FranchiseController@batchList')->name('batch-list');
	Route::post('/load-batch-list', 'FranchiseController@loadbatchList');

	Route::get('/report-form', 'ReportController@reportForm')->name('report-form');
	Route::post('/generate-report', 'ReportController@generateReport');
	/**
	 * Payu Payment Routes
	 */
	# Call Route
	Route::get('payment', ['as' => 'payment', 'uses' => 'Payu\PaymentController@payment']);

	# Status Route
	Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'Payu\PaymentController@status']);
});

/**
 * Admin Routes
 */
Route::group(['middleware' => 'Admin'], function()
{
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

	//Batch Creation
	Route::get('approve-batch-form/{batch_id}', 'Admin\BatchController@approveBatchForm');
	Route::post('approve-batch', 'Admin\BatchController@approveBatch');
	Route::get('admin-batch-list', 'Admin\BatchController@adminBatchList')->name('batch-list');
	Route::post('admin-load-batch-list', 'Admin\BatchController@adminLoadBatchList');
	//Product Creation
	Route::get('create-product-form', 'Admin\ProductController@createProductForm')->name('create-product-form');
	Route::post('create-product', 'Admin\ProductController@createProduct');

	Route::get('/franchise-list', 'Admin\FranchiseController@franchiseList')->name('franchise-list');
	Route::get('/load-franchise-list', 'Admin\FranchiseController@loadFranchiseList');
	Route::get('/franchise-details/{id}', 'Admin\FranchiseController@franchiseDetails');
	Route::get('/edit-franchise-profile/{id}', 'Admin\FranchiseController@franchiseEditProfile');
	Route::post('/update-franchise-details', 'Admin\FranchiseController@updateFranchiseDetails');

});
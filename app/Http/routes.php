<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\User;



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

/*Route::group(['middleware' => 'web'], function () {
   

    Route::get('/home', 'HomeController@index');


});*/

Route::group(['middleware' => 'web'],function() { 
	Route::auth();
	
	Route::get('/', function () {
	    return view('welcome');
	});

	//Route::get('one_time_payment', 'SubscriptionController@one_time_payment');


	
	Route::get('user/{id}', 'UserController@show');
	//not basic user access
	Route::get('user/', 'UserController@all');
	Route::get('user/create', 'UserController@create');

	//no custom plans that aren't assigned to user
	Route::get('plans/', 'PlanController@index');
	
	Route::get('plan/{id}','PlanController@show');
	
	//no basic user access
	Route::get('plan/edit/{id}', 'PlanController@edit');
	Route::post('plan/create', 'PlanController@create');
	Route::post('plan/update', 'PlanController@update');
	Route::post('plan/delete/{id}', 'PlanController@destroy');
	Route::post('plan/subscribers/{id}', 'PlanController@subscribers');

	//Route::get('plan/check_stripe_id/{id}', 'PlanController@check_id_available');


	Route::get('subscription/', 'SubscriptionController@index');
	Route::get('subscription/{id}', 'SubscriptionController@show');
	Route::post('subscription/create', 'SubscriptionController@create');
	Route::post('subscription/update', 'SubscriptionController@update');
	Route::post('subscription/cancel', 'SubscriptionController@delete');

	//basic users shouldn't be able to charge other users
	Route::get('charge/', 'ChargeController@index');
	Route::get('charge/{id}', 'ChargeController@show');
	Route::get('charge/create', 'ChargeController@create');
	//admin only
	Route::get('charge/refund', 'ChargeController@delete');


	Route::get('payment/', 'PaymentController@index');
	Route::get('payment/{id}', 'PaymentController@show');
	Route::get('payment/refund', 'PaymentController@refund');


	//Route::get('plan/import', 'PlanController@import');
});

/*Route::get('/freetrialday', function(){
		return View::make('payment');
});*/


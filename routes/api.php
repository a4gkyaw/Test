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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/', function () {
   
//     if(Auth::check() && Auth::user()->role=='admin') {
//         return redirect('/home');

//     }elseif (Auth::check() && Auth::user()->role=='user') {
//     	return redirect('/create');
//     }else {
//         return view('welcome');
//     }
// });


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/create','CustomerController@create');
// Route::post('/store','CustomerController@store');
// Route::get('/approve','CustomerController@need_to_approve');
// Route::post('user/{user}/approved', 'CustomerController@approved');
// Route::get('edit/{user}','CustomerController@edit');
// Route::post('update/{user}','CustomerController@update');
// Route::delete('user/{user}', 'CustomerController@customer_destroy');
// Route::delete('pendinguser/{user}', 'CustomerController@reject_approve');

// if (Request::has('download')) {
//      Route::get('/search', 'CustomerController@download');
//  }elseif(Request::has('search')) {
//      Route::get('/search', 'CustomerController@search');
//  }

// Route::get('getTownship', 'HomeController@getTownship');

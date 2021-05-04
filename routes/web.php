<?php

use Illuminate\Support\Facades\Route;
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

Route::group(['namespace' => 'App\Http\Controllers'], function(){
	Route::get('/', 'EmployeeController@registerForm');
	Route::post('register', 'EmployeeController@register');
	Route::get('login', 'AuthController@loginForm');
	Route::post('admin-verify', 'AuthController@authentication')->name('is_admin');
	Route::group(['middleware' => 'is.admin'], function(){
		Route::get('ajax-data', 'EmployeeController@dataTable');
		Route::get('employees', 'EmployeeController@employees');
		Route::get('report', 'EmployeeController@report')->name('report');
		Route::get('logout', 'AuthController@logout')->name('logout');
	});

});

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
//Landing page route
Route::get('/', function () {
    return view('46728.welcome');
});
//Student routes
Route::resource('students', 'StudentController');
//Fees routes
Route::resource('fees', 'FeeController');
//Extra route to handle direct payment from Students index i.e. /students
Route::get('/directpay/{student}', 'FeeController@directPay')->name('fees.directpay');
//Search route
Route::get('search/students/{student}','StudentController@search')->name('students.search');


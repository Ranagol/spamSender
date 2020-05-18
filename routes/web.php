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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/emailsending', function () {
    return view('/emailLaunching.send-email');
});

// Route::patch('/emails/{id}', function () {
//     return 'route is working';
// });

Route::patch('/emails/{id}', 'EmailController@update');
Route::patch('/emails/updateActive/{id}', 'EmailController@updateActive');
Route::get('/emails/index', 'EmailController@index');//two different requests are activating the same method
Route::post('/emails/index', 'EmailController@index');//two different requests are activating the same method
Route::get('/add-email', 'EmailController@create');
Route::post('/emails', 'EmailController@store');
Route::post('/multiple-emails', 'EmailController@storeMultiple');
Route::get('/send-email', 'EmailSendingController@sendMail');
Route::get('/send-multiple-emails', 'EmailSendingController@sendMultipleMails');
Route::get('/getExcel', 'EmailController@getExcel');
Route::post('/uploadExcel', 'EmailController@uploadExcel');
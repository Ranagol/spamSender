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


Route::put('/emails/{id}', 'EmailController@update');
Route::patch('/emails/{id}', 'EmailController@updateActive');
Route::get('/emails', 'EmailController@index');
Route::get('/add-email', 'EmailController@create');
Route::post('/emails', 'EmailController@store');
Route::post('/multiple-emails', 'EmailController@storeMultiple');
Route::get('/send-email', 'EmailSendingController@sendMail');
Route::get('/send-multiple-emails', 'EmailSendingController@sendMultipleMails');
Route::get('/getExcel', 'EmailController@getExcel');
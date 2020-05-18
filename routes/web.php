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


//UPDATE METHODS
Route::patch('/emails/updateEmail/{id}', 'EmailController@updateEmail');
Route::patch('/emails/updateCustomer/{id}', 'EmailController@updateCustomer');
Route::patch('/emails/updateActive/{id}', 'EmailController@updateActive');

//SEARCH AND INDEX
Route::get('/emails/index', 'EmailController@index');//two different requests are activating the same method
Route::post('/emails/index', 'EmailController@index');//two different requests are activating the same method

//ADDING NEW EMAILS
Route::get('/add-email', 'EmailController@create');
Route::post('/emails', 'EmailController@store');
Route::post('/multiple-emails', 'EmailController@storeMultiple');

//EMAIL SENDING
Route::get('/send-email', 'EmailSendingController@sendMail');
Route::get('/send-multiple-emails', 'EmailSendingController@sendMultipleMails');

//EXCEL MANIPULATION
Route::get('/getExcel', 'EmailController@getExcel');
Route::post('/uploadExcel', 'EmailController@uploadExcel');
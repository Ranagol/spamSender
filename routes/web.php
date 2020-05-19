<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
Route::get('/emailsending', function () {
    return view('/emails.send-email');
});
Route::get('/send-multiple-emails', 'EmailSendingController@sendMultipleMails');

//EXCEL MANIPULATION
Route::get('/backup', function () {
    return view('/emails.backup');
});
Route::get('/getExcel', 'EmailController@getExcel');
Route::post('/uploadExcel', 'EmailController@uploadExcel');
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
Route::get('/ ', function () {
  return redirect('/register');
});

Route::get('/dashboard', 'DashboardController@show');

Route::get('/register', 'RegisterController@create');
Route::post('/register', 'RegisterController@store');

Route::get('/mailer/steps', 'MailController@sendSteps');
Route::get('/mailer/ticket', 'MailController@sendTicket');

Route::get('/upload', 'UploadController@create');
Route::post('/upload', 'UploadController@store');

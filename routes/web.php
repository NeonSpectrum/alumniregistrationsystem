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
use App\Admin;

Route::get('/ ', function () {
  return redirect('/register');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', 'DashboardController@show')->name('dashboard');
});

Route::get('/login', 'LoginController@show')->name('login');
Route::post('/login', 'LoginController@process');

Route::get('logout', 'LoginController@logout');

Route::get('/register', 'RegisterController@create')->name('register');
Route::post('/register', 'RegisterController@store');

Route::get('/mailer/steps', 'MailController@sendSteps');
Route::get('/mailer/ticket', 'MailController@sendTicket');
Route::get('/mailer', 'MailController@display');

Route::get('/upload', 'UploadController@create');
Route::post('/upload', 'UploadController@store');

Route::get('/registerhere', function () {
  Admin::create(['username' => 'rnd', 'password' => 'ueccssrnd']);
});

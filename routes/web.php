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

Route::get('/', function () {
    return view('landingpage.index');
})->name('welcome');

Route::get('/faq', function() {
    return view('landingpage.faq');
})->name('faq');

Route::get('/contact-us', function() {
    return view('landingpage.contactus');
})->name('contactus');

Route::get('test', function() {
    return view('test');
});

Route::group(['namespace' => 'auth'],function(){
    Route::post('/login','LoginController@login')->name('login');
    Route::get('/logout',function(){
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify/{token}', 'VerifyUserController@index')->name('verifyUser');

Route::middleware(['auth'])->prefix('setting')->group(function() {
    Route::get('profile','ProfileController@index')->name('profileIndex');
    Route::post('profile/full-name-save-edit', 'ProfileController@update')->name('profileUpdate');
    Route::post('profile/change-password-save', 'ProfileController@updatePassword')->name('profileUpdatePassword');
});


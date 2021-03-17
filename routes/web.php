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

Route::get('/', 'CoreController@index')->name('home');

Route::get('docs', function() {
    return view('docs');
})->name('docs');

Route::get('contact', 'ContactController@create')->name('contact');
Route::post('contact', 'ContactController@store')->name('contact.store');

Route::get('privacy', function() {
    return view('privacy');
})->name('privacy');

Route::get('terms', function() {
    return view('terms');
})->name('terms');

Route::get('report', 'ReportController@create')->name('report');
Route::post('report', 'ReportController@store')->name('report.store');

Route::get('{slug}', 'CoreController@show');

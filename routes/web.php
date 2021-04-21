<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UrlController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', [CoreController::class, 'index'])->name('home');

Route::get('docs', function() {
    return view('docs');
})->name('docs');

Route::get('contact', [ContactController::class, 'create'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('privacy', function() {
    return view('privacy');
})->name('privacy');

Route::get('terms', function() {
    return view('terms');
})->name('terms');

Route::get('report', [ReportController::class, 'create'])->name('report');
Route::post('report', [ReportController::class, 'store'])->name('report.store');

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/urls', [UrlController::class, 'index'])->name('urls');
    
    Route::get('/stats', function () {
        return 'list stats';
    })->name('stats');

    Route::get('/contacts', function () {
        return 'list contacts';
    })->name('contacts');

    Route::get('/reports', function () {
        return 'list reports';
    })->name('reports');
});

Route::get('{slug}', [CoreController::class, 'show']);

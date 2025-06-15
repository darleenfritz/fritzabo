<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediatypeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FeedbackController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/subscriptions', SubscriptionController::class );

Route::resource('/mediatypes', MediatypeController::class );

Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])
    ->name('subscriptions.destroy');

Route::get('/subscriptions/search-suggestions', [SubscriptionController::class, 'searchSuggestions']);

Route::get('/mediatypes/{mediatype}/export', [App\Http\Controllers\MediatypeController::class, 'export'])->name('mediatypes.export');

Route::resource('mediatypes', MediatypeController::class);

Route::post('/subscriptions/{subscription}/extend', [SubscriptionController::class, 'extend'])->name('subscriptions.extend');

Route::view('/impressum', 'pages.impressum')->name('impressum');

Route::view('/datenschutz', 'pages.datenschutz')->name('datenschutz');

Route::view('/kontakt', 'pages.kontakt')->name('kontakt');

Route::view('/profil', 'pages.profil')->name('profil');

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/', function () {
    return view('pages.start');
})->name('start');

Route::view('/kontakt', 'pages.kontakt')->name('kontakt');



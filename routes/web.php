<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediatypeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BillingcycleController;

// Startseite
Route::get('/', function () {
    return view('pages.start');
})->name('start');

// Auth
Auth::routes();

// Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Subscriptions
Route::resource('subscriptions', SubscriptionController::class);
Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy'); // Optional – wird durch resource schon abgedeckt
Route::post('/subscriptions/{subscription}/extend', [SubscriptionController::class, 'extend'])->name('subscriptions.extend');
Route::get('/subscriptions/search-suggestions', [SubscriptionController::class, 'searchSuggestions']);

// Mediatypes
Route::resource('mediatypes', MediatypeController::class);
Route::get('/mediatypes/{mediatype}/export', [MediatypeController::class, 'export'])->name('mediatypes.export');
Route::get('/billingcycles/{billingcycle}/export', [\App\Http\Controllers\BillingcycleController::class, 'export'])->name('billingcycles.export');

// Billingcycles
Route::resource('billingcycles', BillingcycleController::class);

// Statische Seiten
Route::view('/impressum', 'pages.impressum')->name('impressum');
Route::view('/datenschutz', 'pages.datenschutz')->name('datenschutz');
Route::view('/kontakt', 'pages.kontakt')->name('kontakt');
Route::view('/profil', 'pages.profil')->name('profil');

// Feedback
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
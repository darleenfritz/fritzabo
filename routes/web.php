<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediatypeController;
use App\Http\Controllers\SubscriptionController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/subscriptions', SubscriptionController::class );

Route::resource('/mediatypes', MediatypeController::class );

Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])
    ->name('subscriptions.destroy');

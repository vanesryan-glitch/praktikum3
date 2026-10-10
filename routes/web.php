<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/calendar', 'calendar')->name('calendar');
    Route::get('/cloud', 'cloud')->name('cloud');
    Route::get('/collaboration', 'collaboration')->name('collaboration');
    Route::get('/scan-handwriting', 'scan')->name('scan');
});
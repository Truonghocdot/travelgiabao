<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/tin-tuc', [PageController::class, 'tinTuc'])->name('tin-tuc');
Route::get('/tin-tuc/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/schedule', [PageController::class, 'schedule'])->name('schedule');
Route::post('/booking', [PageController::class, 'booking'])->name('booking.store');

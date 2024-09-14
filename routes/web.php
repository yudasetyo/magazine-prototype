<?php

use App\Http\Controllers\FrontController;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{articleNews:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/author/{author:slug}', [FrontController::class, 'author'])->name('front.author');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
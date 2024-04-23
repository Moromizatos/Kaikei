<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\CashflowHistoryController;


Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/revenue', [RevenueController::class, 'index']);
Route::post('/revenue', [RevenueController::class, 'store']);
Route::get('/revenue/{id}', [RevenueController::class, 'show']);
Route::put('/revenue/{id}', [RevenueController::class, 'update']);
Route::delete('/revenue/{id}', [RevenueController::class, 'destroy']);

Route::get('/cashflow', [CashflowController::class, 'index']);
Route::post('/cashflow', [CashflowController::class, 'store']);
Route::get('/cashflow/{id}', [CashflowController::class, 'show']);
Route::put('/cashflow/{id}', [CashflowController::class, 'update']);
Route::delete('/cashflow/{id}', [CashflowController::class, 'destroy']);

Route::get('/cashflowHistory', [CashflowHistoryController::class, 'index']);
Route::post('/cashflowHistory', [CashflowHistoryController::class, 'store']);
Route::get('/cashflowHistory/{id}', [CashflowHistoryController::class, 'show']);
Route::put('/cashflowHistory/{id}', [CashflowHistoryController::class, 'update']);
Route::delete('/cashflowHistory/{id}', [CashflowHistoryController::class, 'destroy']);

Route::get('/accounts', [AccountsController::class, 'index']);
Route::post('/accounts', [AccountsController::class, 'store']);
Route::get('/accounts/{id}', [AccountsController::class, 'show']);
Route::put('/accounts/{id}', [AccountsController::class, 'update']);
Route::delete('/accounts/{id}', [AccountsController::class, 'destroy']);






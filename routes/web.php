<?php

use App\Http\Controllers\KontenSosmedController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('konten-sosmed.index');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/akun', [AuthController::class, 'account'])->middleware('auth')->name('account');
Route::post('/akun/update', [AuthController::class, 'updateAccount'])->middleware('auth')->name('account.update');
Route::post('/akun/password', [AuthController::class, 'updatePassword'])->middleware('auth')->name('account.password');

Route::middleware('auth')->group(function () {
    Route::get('konten-sosmed/export/pdf', [KontenSosmedController::class, 'exportPdf'])->name('konten-sosmed.export.pdf');
    Route::get('konten-sosmed/export/excel', [KontenSosmedController::class, 'exportExcel'])->name('konten-sosmed.export.excel');
    Route::get('konten-sosmed/export/word', [KontenSosmedController::class, 'exportWord'])->name('konten-sosmed.export.word');

    Route::resource('konten-sosmed', KontenSosmedController::class);
});

<?php

use App\Http\Controllers\accountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\loginController;

Route::get('/', function () {
    return view('login.login');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [loginController::class, 'index'])->name('login.index');
    Route::post('/login', [loginController::class, 'process'])->name('login.process');
});



Route::middleware(['auth'])->group(function(){

    Route::post('/logout', [loginController::class, 'destroy'])->name('login.destroy');

    Route::middleware(['level:admin'])->group(function(){
        Route::get('/admin', [accountController::class, 'index'])->name('account.index');
        Route::get('/admin/tambah', [accountController::class, 'create'])->name('account.create');
        Route::post('/admin/tambah', [accountController::class, 'store'])->name('account.store');
        Route::get('admin/edit/{id}', [accountController::class, 'edit'])->name('account.edit');
        Route::put('admin/edit/{id}', [accountController::class, 'update'])->name('account.update');
        Route::delete('/admin/{id}', [accountController::class, 'destroy'])->name('account.destroy');

        Route::get('family/edit/{id}', [FamilyController::class, 'edit'])->name('family.edit');
        Route::put('family/update/{id}', [FamilyController::class, 'update'])->name('family.update');
        Route::delete('/family/{id}', [FamilyController::class, 'destroy'])->name('family.destroy');
        Route::get('/family/tambah', [FamilyController::class, 'create'])->name('family.create');
        Route::post('/family/tambah', [FamilyController::class, 'store'])->name('family.store');
    });

    Route::middleware(['level:admin,user'])->group(function(){
        Route::get('/family-graph', [FamilyController::class, 'index'])->name('family.index');
        Route::get('/family-table', [FamilyController::class, 'show'])->name('family.show');
    });
});

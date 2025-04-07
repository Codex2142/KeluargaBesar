<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/family-graph', [FamilyController::class, 'index'])->name('family.index');
Route::get('/family-table', [FamilyController::class, 'show'])->name('family.show');

Route::get('family/edit/{id}', [FamilyController::class, 'edit'])->name('family.edit');
Route::put('family/update/{id}', [FamilyController::class, 'update'])->name('family.update');


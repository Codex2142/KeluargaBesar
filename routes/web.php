<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;

Route::get('/', function () {
    return view('component.modal');
});

Route::get('/family-graph', [FamilyController::class, 'index'])->name('family.index');
Route::get('/family-table', [FamilyController::class, 'show'])->name('family.show');

Route::get('family/edit/{id}', [FamilyController::class, 'edit'])->name('family.edit');
Route::put('family/update/{id}', [FamilyController::class, 'update'])->name('family.update');

Route::delete('/family/{id}', [FamilyController::class, 'destroy'])->name('family.destroy');

Route::get('/family/tambah', [FamilyController::class, 'create'])->name('family.create');
Route::post('/family/tambah', [FamilyController::class, 'store'])->name('family.store');


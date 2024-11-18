<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormBuilderController;


Route::get('/', [FormBuilderController::class, 'index'])->name('index');


Route::get('create', [FormBuilderController::class, 'create'])->name('create-form');

Route::post('create', [FormBuilderController::class, 'store'])->name('store.form');

Route::delete('delete-form/{form}', [FormBuilderController::class, 'destroy'])->name('delete.form');

Route::get('edit-form-builder/{id}', [FormBuilderController::class, 'editData'])->name('edit-form-builder');






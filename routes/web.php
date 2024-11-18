<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormBuilderController;


Route::get('/', [FormBuilderController::class, 'index'])->name('index');


Route::get('create', [FormBuilderController::class, 'create'])->name('create-form');

Route::post('create', [FormBuilderController::class, 'store'])->name('store.form');

Route::delete('delete-form/{form}', [FormBuilderController::class, 'destroy'])->name('delete.form');

Route::get('get-form-builder-edit', [FormBuilderController::class, 'edit'])->name('get.form-builder-edit');

Route::view('edit-form-builder/{id}', 'edit');

Route::post('update-form-builder', [FormBuilderController::class, 'update']);



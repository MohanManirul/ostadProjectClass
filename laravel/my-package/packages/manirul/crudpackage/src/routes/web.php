<?php

use Illuminate\Support\Facades\Route;
use Manirul\CrudPackage\Http\Controllers\PostController;

Route::middleware(['web'])->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/create', [PostController::class, 'create']);
    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts/{id}/edit', [PostController::class, 'edit']);
    Route::post('posts/{id}', [PostController::class, 'update']);
    Route::get('posts/{id}/delete', [PostController::class, 'destroy']);
});


Route::get('/crudpackage-test', function () {
    return "CRUD Package working!";
});
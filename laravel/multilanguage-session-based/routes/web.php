<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/example', function () {
    return view('example');
});
 
Route::get('lang/{lang}', function ($lang) {
    if (in_array($lang, ['en','bn','ar'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
});



<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::get('/contacts', function () {
    $data = [
        "phone" => 89165437303,
        "email" => 'SergeyReunin1@gmail.com',
        "telegram" => 'reuzer12'
    ];
    return view('main.contacts', ['data' => $data]);
});

Route::get('/about',  function () {
    return view('main.about');
});

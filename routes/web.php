<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

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


//auth

Route::get('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::get('/', [MainController::class, 'index']);

Route::get('/gallery/{img}', function($img) {
    return view('main.galery', ['img' => $img]);
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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
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

Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/signup', [AuthController::class, 'signup']);

//Article

Route::resource('/articles', ArticleController::class);

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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
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

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/signup', [AuthController::class, 'signup']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

//Article

Route::resource('/articles', ArticleController::class);

//Comment

Route::controller(CommentController::class)->prefix('/comment')->middleware('auth:sanctum')->group(function(){
    Route::post('','store');
    Route::get('/{id}/edit', 'edit');
    Route::post('/{comment}/update', 'update');
    Route::get('/{id}/delete', 'delete');
    Route::get('/index', 'index')->name('comment.index');
    Route::get('/{comment}/accept', 'accept');
    Route::get('/{comment}/reject', 'reject');
});

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

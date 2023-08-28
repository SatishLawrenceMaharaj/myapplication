<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
    $myposts = [];
    $posts = [];
    $posts = Post::all();
    if (auth()->check()) {
        $myposts = auth()->user()->usersPosts()->latest()->get();
    }
    return view('home', ['posts' => $posts], ['myposts' => $myposts]);
});

//user routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//post routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::delete('/delete/post/{post}', [PostController::class, 'deletePost']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

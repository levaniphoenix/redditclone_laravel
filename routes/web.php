<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/post',[App\Http\Controllers\PostsController::class, 'store']);
Route::get('/post/create',[App\Http\Controllers\PostsController::class, 'create']);

Route::post('/subreddit',[App\Http\Controllers\SubredditController::class, 'store']);
Route::get('/r/{name}',[App\Http\Controllers\SubredditController::class, 'show']);
Route::get('/subreddit/create',[App\Http\Controllers\SubredditController::class, 'create']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
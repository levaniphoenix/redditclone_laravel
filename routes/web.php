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

Route::post('/upvote/{postId}',[App\Http\Controllers\VotesController::class, 'storeUpvote']);
Route::post('/downvote/{postId}',[App\Http\Controllers\VotesController::class, 'storeDownvote']);

Route::post('/join/{subReddit}',[App\Http\Controllers\JoinsController::class, 'store']);

Route::post('/post',[App\Http\Controllers\PostsController::class, 'store']);
Route::get('/post/create',[App\Http\Controllers\PostsController::class, 'create']);
Route::get('/post/{post}',[App\Http\Controllers\PostsController::class, 'show'])->name('post.show');
Route::get('/user/{user}',[App\Http\Controllers\PostsController::class, 'index'])->name('user.index');

Route::post('/subreddit',[App\Http\Controllers\SubredditController::class, 'store']);
Route::get('/r/{name}',[App\Http\Controllers\SubredditController::class, 'show'])->name('reddit.show');
Route::get('/subreddit/create',[App\Http\Controllers\SubredditController::class, 'create']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
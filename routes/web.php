<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('post', PostController::class);
Route::resource('users.comments', UserCommentController::class)->only(['store']);
Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);


Route::get('mailable', function () {
    $comment = App\Models\Comment::find(1);
    return new App\Mail\CommentPostedMarkdown($comment);
});

Route::resource('posts.comments', PostCommentController::class)->only(['store']);

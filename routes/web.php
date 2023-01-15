<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@home')->name('home');

/* Route::get('/', function () {
    return view('welcome');

})->name('home.index'); */

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});


Route::get('/contact', function () {  //function() is anonymus function, often this is controller
    return 'contact';
    /* return 'Home page'; string home page in browser
     */
})->name('home.contact');

Route::resource('posts', PostController::class);/* ->only(['index', 'show', 'create', 'store', 'edit', 'update']); */  /* ->except(['index', 'show']) */

Route::get('/recent-posts/{days_ago?}' , function($daysAgo=20){
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index');

Route::get('/', function () {
    return view('home.index', []);  //home is template namein views folder, dot(.) means that there is nested folder structure, and index is file...optional there is a array which can acces data
})->name('home.index');

Route::get('/contact' , function(){
   return view('home.contact');
})->name('home.contact');

$posts =
    [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel',
            'is_new' => true
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP',
            'is_new' => false,
            'has_comments' => true
    ]
    ];

/*
Route::get('/posts/{id}', function ($id) use($posts) {

 $posts =
    [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel',
            'is_new' => true
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP',
            'is_new' => false,
            'has_comments' => true
    ]
    ];

    return view('posts.show', ['post' => $posts[$id]]);

    abort_if(!isset($posts['id']), 404);

})->name('posts.show'); */

Route::get('/',[ HomeController::class, 'home' ])->name('home.index');
Route::get('/contact',[ HomeController::class, 'contact' ])->name('home.contact');

Route::get('/single',[ AboutController::class, 'home' ]);

Route::resource('/posts', PostController::class);






Route::get('/fun/response', function() use($posts) {
     return response($posts, 201)
     ->header('Content-type', 'application/json')
     ->cookie('MY_COOKIE', 'dinko', 3600); /* show response for user */
});

Route::get('/fun/redirect', function(){
   return redirect('/content')->middleware('auth'); /* in kernel.php there are aliases, 'auth' etc */
});

Route::get('/fun/back', function(){
    return back();
 });

 Route::get('/fun/named-route', function(){
    return redirect()->route('posts-show', ['id' => 1]);
 });

 Route::get('/fun/away', function(){
    return redirect()->away('google.com');
 });


 Route::get('/fun/JSON', function() use($posts){
    return response()->json($posts);
 });

 Route::get('/fun/download', function() use($posts){
    return response()->download(public_path('/mvc.jpg'), 'face.jpg');  /*  download file */
 });

 Route::prefix('fun')->name('fun.')->group(function() use($posts){



    Route::get('/fun/response', function() use($posts) {
        return response($posts, 201)
        ->header('Content-type', 'application/json')
        ->cookie('MY_COOKIE', 'dinko', 3600); /* show response for user */
   });

   Route::get('/fun/redirect', function(){
      return redirect('/content');
   });

   Route::get('/fun/back', function(){
       return back();
    });

    Route::get('/fun/named-route', function(){
       return redirect()->route('posts-show', ['id' => 1]);
    });

    Route::get('/fun/away', function(){
       return redirect()->away('google.com');
    });


    Route::get('/fun/JSON', function() use($posts){
       return response()->json($posts);
    });

    Route::get('/fun/download', function() use($posts){
       return response()->download(public_path('/mvc.jpg'), 'face.jpg');  /*  download file */
    });
 });
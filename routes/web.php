<?php

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

Route::get('/', function () {  //function() is anonymus function, often this is controller
    return view('welcome');
    /* return 'Home page'; string hrmr psgr in browser
     */
})->name('home.index');


Route::get('/contact', function () {  //function() is anonymus function, often this is controller
    return 'contact';
    /* return 'Home page'; string home page in browser
     */
})->name('home.contact');

Route::get('/posts/{id}', function ($id) {  
    return 'Blog post' . $id;
})/* ->where([
    'id'=> '[0-9] +'
]) */
->name('posts.show');

Route::get('/recent-posts/{days_ago?}' , function($daysAgo=20){
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index');

Route::get('/', function () { 
    return view('home.index', []);  //home is template namein views folder, dot(.) means that there is nested folder structure, and index is file...optional there is a array which can acces data
})->name('home.index');

Route::get('/contact' , function(){
   return view('home.contact');
})->name('home.contact');


Route::get('/posts/{id}', function ($id) {  

$posts = 
    [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel'
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP'
    ]
    ];

    return view('posts.show', ['post' => $posts[$id]]);

    abort_if(!isset($posts['id']), 404);

})->name('posts.show');
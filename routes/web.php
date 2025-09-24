<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/explore', function(){
    return view('explore');
});

Route::get('/notifications', function(){
    return view('notifications');
});

Route::get('/messages', function(){
    return view('messages');
});

Route::get('/bookmarks', function () {
    return view('bookmarks');
})->name('bookmarks');

Route::get('/profile', function(){
    return view('profile');
});

Route::get('/settings', function(){
    return view('settings');
});
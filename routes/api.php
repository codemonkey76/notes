<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->group(function () {
    Route::resource('notes', 'NoteController');
    Route::get('status', 'StatusController@index');
//    Route::post('/notes', 'NoteController@store');
//    Route::get('/notes', 'NoteController@index');
//    Route::patch('/notes/{note}', 'NoteController@update');
//    Route::get('/notes/{note}', 'NoteController@show');
//    Route::delete('/notes/{note}', 'NoteController@destroy');


});





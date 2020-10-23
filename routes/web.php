<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entries/create', 'EntryController@create')->name('entires.create');
Route::post('/entries', 'EntryController@store')->name('entires.store');
//Para que todos los usuarios puedan ver los post :)
Route::get('/entries/{entryBySlug}', 'GuestController@show')->name('entires.show');

Route::get('/entries/{entry}/edit', 'EntryController@edit')->name('entires.edit');
Route::put('/entries/{entry}', 'EntryController@update')->name('entires.update');

//Rutas de university.
Route::get('/universities/create', 'UniversityController@create')->name('universities.create');
Route::post('/universities', 'UniversityController@store')->name('universities.store');
//Para que todos los usuarios puedan ver los post :)
Route::get('/universities/{entryBySlug}', 'GuestController@show')->name('universities.show');

Route::get('/universities/{entry}/edit', 'UniversityController@edit')->name('universities.edit');
Route::put('/universities/{entry}', 'UniversityController@update')->name('universities.update');

//Funcionalidad para obtener la información del usuario :)
//Route::get('/users/{user}', 'UserController@show')->name('users.show');
//Creando rutas amigables para los usuarios con las expuestas en twitter :)
Route::get('@{user}', 'UserController@show')->name('users.show');


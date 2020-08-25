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

//La edicion debe estar protegida por lo cual se envia al controlador Entry :)
//Se puede realiza middleware para definir verificación de permisos :)
/*Route::get('/entries/{entry}/edit', 'EntryController@edit')
	->middleware('can:update,entry');
	->name('entires.edit');
Route::put('/entries/{entry}', 'EntryController@update')
	->middleware('can:update,entry');
	->name('entires.update');*/

Route::get('/entries/{entry}/edit', 'EntryController@edit')->name('entires.edit');
Route::put('/entries/{entry}', 'EntryController@update')->name('entires.update');

//Funcionalidad para obtener la información del usuario :)
Route::get('/users/{user}', 'UserController@show')->name('users.show');


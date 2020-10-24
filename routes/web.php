<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Rutas de university.
Route::get('/universities/create', 'UniversityController@create')->name('universities.create');
Route::post('/universities', 'UniversityController@store')->name('universities.store');
//Para que todos los usuarios puedan ver los post :)
Route::get('/universities/{universityBySlug}', 'GuestController@show')->name('universities.show');

Route::get('/universities/{university}/edit', 'UniversityController@edit')->name('universities.edit');
Route::put('/universities/{university}', 'UniversityController@update')->name('universities.update');

//Rutas de course.
Route::get('/courses', 'CourseController@index')->name('courses.index');
Route::get('/courses/create', 'CourseController@create')->name('courses.create');
Route::post('/courses', 'CourseController@store')->name('courses.store');
Route::get('/courses/{course}/edit', 'CourseController@edit')->name('courses.edit');
Route::put('/courses/{course}', 'CourseController@update')->name('courses.update');

//Funcionalidad para obtener la información del usuario :)
//Route::get('/users/{user}', 'UserController@show')->name('users.show');
//Creando rutas amigables para los usuarios con las expuestas en twitter :)
Route::get('@{user}', 'UserController@show')->name('users.show');


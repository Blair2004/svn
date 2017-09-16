<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get( '/errors/{code}', 'ErrorsController@index' )->name( 'errors' );

Route::get( '/softwares', 'SoftwareController@index' )->name( 'software.index' );
Route::get( '/softwares/add', 'SoftwareController@post' )->name( 'software.add' );
Route::get( '/softwares/add-release', 'SoftwareController@postRelease' )->name( 'software.addRelease' );

Route::post( '/softwares/submit', 'SoftwareController@submit' )->name( 'software.submit' );
Route::get( '/software/delete/{id}', 'SoftwareController@delete' )->name( 'software.delete' );
Route::get( '/software/expose/{id}', 'SoftwareController@expose' )->name( 'software.expose' );
Route::get( '/svn/app/{namespace}', 'SvnController@app' )->name( 'svn.app' );
Route::post( '/software/submitRelease', 'SoftwareController@submitRelease' )->name( 'software.submitRelease' );
Route::resource( 'tasks', 'TaskController' );
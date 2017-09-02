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



Route::get('/admin',function (){

    return  view('admin.index');

});

Route::group(['middleware'=>'admin'],function (){   //we included the Admin controle into route group to make sure only admin can get into here

    Route::resource('admin/users','AdminUsersController');
    Route::resource('admin/posts','AdminPostsController'); // after the Route make a controller php artisan make:controller --resource AdminPostsController

});


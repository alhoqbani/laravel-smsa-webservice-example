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

/** @var \Illuminate\Routing\Router $router */

$router->get('/', function () {
    return view('welcome');
});

Auth::routes();

$router->get('/home', 'HomeController@index')->name('home');

$router->get('home/{any}', 'HomeController@index')->where('any', '.*');

$router->redirect('/register', '/login');
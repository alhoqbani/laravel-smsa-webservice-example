<?php

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/** @var Router $router */

$router->group(['middleware' => 'auth:api'], function (Router $router) {

    $router->get('cities', 'Api\CityController@index');


});
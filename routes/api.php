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

    $router->get('retails/{city?}', 'Api\RetailsController@index');

    $router->get('tracking/status', 'Api\TrackingController@status');

    $router->get('tracking/track', 'Api\TrackingController@track');

    // Shipments
    $router->post('shipments', 'Api\ShipmentsController@store');
    
    $router->get('shipments/pdf', 'Api\PdfsController@show');

    $router->delete('shipments/{awb}', 'Api\ShipmentsController@destroy');

});
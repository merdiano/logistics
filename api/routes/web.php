<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'v1'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');
    $router->post('login','AuthController@login');
    $router->get('list_apps','ApplicationController@getApplications');
    $router->get('get_app/{app_id}','ApplicationController@get');
    $router->get('get_bids/{app_id}','BidController@get_bids');
    $router->get('locations','LocationController@index');
    $router->group(['middleware' => 'auth'], function() use ($router) {
        $router->post('store','ApplictaionController@store');
        $router->post('cancel/{id}','ApplictaionController@remove');
        $router->post('bid','BidController@make_bid');
        $router->get('list_mine','ApplicationController@getMyApplications');
    });

});
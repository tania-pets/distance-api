<?php

/**
 * Define api routes
 */

$router->group(['prefix' => 'api/v1', 'middleware' => 'auth_api'], function () use ($router) {
        $router->post('/journey', 'JourneyController@create');
        $router->get('/journey[/{type}]', 'JourneyController@index');

});

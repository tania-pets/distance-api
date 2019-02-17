<?php

/**
 * Define api routes
 */

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->post('/journey', 'JourneyController@create');
});

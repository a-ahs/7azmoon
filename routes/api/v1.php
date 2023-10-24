<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->group(['prefix' => 'api/v1'], function() use ($router) {
    $router->group(['prefix' => 'users'], function() use ($router) {
        $router->post('', 'API\V1\usersController@store');
    });
});

$router->get('/api/v1', function () use ($router) {
    return $router->app->version();
});

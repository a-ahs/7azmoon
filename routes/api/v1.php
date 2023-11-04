<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->group(['prefix' => 'api/v1'], function() use ($router) {
    $router->group(['prefix' => 'users'], function() use ($router) {
        $router->post('', 'API\V1\usersController@store');
        $router->put('', 'API\V1\usersController@update');
        $router->put('change-pass', 'API\V1\usersController@updatePassword');
        $router->delete('', 'API\V1\usersController@delete');
        $router->get('', 'API\V1\usersController@index');
    });

    $router->group(['prefix' => 'categories'], function() use ($router) {
        $router->post('', 'API\V1\categoryController@store');
        $router->delete('', 'API\V1\categoryController@delete');
        $router->put('', 'API\V1\categoryController@update');
        $router->get('', 'API\V1\categoryController@index');
    });

    $router->group(['prefix' => 'quizes'], function() use ($router) {
        $router->post('', 'API\V1\quizesController@store');
        // $router->delete('', 'API\V1\categoryController@delete');
        // $router->put('', 'API\V1\categoryController@update');
        // $router->get('', 'API\V1\categoryController@index');
    });

});

$router->get('/api/v1', function () use ($router) {
    return $router->app->version();
});

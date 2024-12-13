<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/authors', 'AuthorController@index');
$router->post('/authors', 'AuthorController@store');
$router->get('/authors/{authorId}', 'AuthorController@show');
$router->put('/authors/{authorId}', 'AuthorController@update');
$router->delete('/authors/{authorId}', 'AuthorController@destroy');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

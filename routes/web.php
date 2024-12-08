<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/authors', 'AuthorController@index');
$router->get('/authors/{authorId}', 'AuthorController@show');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

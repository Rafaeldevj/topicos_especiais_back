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
    return str_random(32);
});

$router->group(['prefix' => '/api/usuario'], function () use ($router) {

    $router->get('', "UsuarioController@findAll");
    $router->get('/teste', "UsuarioController@teste");
    $router->post('', "UsuarioController@save");
    $router->get('/{id}', "UsuarioController@findById");
    $router->put('/{id}', "UsuarioController@update");
    $router->get('/ativar/{id}', "UsuarioController@active");
    $router->post('/login', "UsuarioController@login");

});

$router->group(['prefix' => '/api/grupo'], function () use ($router) {

    $router->get('', "GrupoController@findAll");
    $router->get('/{id}', "GrupoController@findById");
    $router->post('', "GrupoController@save");
    $router->put('/{id}', "GrupoController@update");
    $router->delete('/{id}', "GrupoController@delete");

});

$router->group(['prefix' => '/api/usuario_grupo'], function () use ($router) {

    $router->get('', "UsuarioGrupoController@findAll");
    $router->get('/{id}', "UsuarioGrupoController@findById");
    $router->post('', "UsuarioGrupoController@save");
    $router->put('/{id}', "UsuarioGrupoController@update");
    $router->delete('/{id}', "UsuarioGrupoController@delete");

});

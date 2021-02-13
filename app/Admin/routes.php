<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/images', ImageController::class)->names([
        'index' => 'list'
    ]);
    $router->get('/images/{id}/detail', 'ImageController@detail')->name('detail');
    $router->get('/images/{id}/redact', 'ImageController@redact')->name('redact');
    $router->post('/images/doRedact', 'ImageController@doRedact')->name('doRedact');
    $router->get('/register', 'ImageController@register')->name('register');
    $router->post('/doRegister', 'ImageController@doRegister')->name('doRegister');
    $router->get('/{id}/doDelete', 'ImageController@doDelete')->name('doDelete');
});

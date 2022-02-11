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

$router->get('/hello-mahdani/{name}', function ($name) { return "<h1>Lumen</h1><p>Hi <b>" . $name ."</b></p>"; });

// management user
$router->get('/tabel_user','Tabel_userController@index');

$router->post('/tabel_user/post','Tabel_userController@post');

$router->put('/tabel_user/update/{id}','Tabel_userController@update');

$router->delete('/tabel_user/delete/{id}','Tabel_userController@delete');


// managemen website
$router->get('/tabel_page','Tabel_pageController@index');

$router->post('/tabel_page/post','Tabel_pageController@post');

$router->put('/tabel_page/update/{id}','Tabel_pageController@update');

$router->delete('/tabel_page/delete/{id}','Tabel_pageController@delete');

// managemen blog post
$router->get('/tabel_blog','Tabel_blogController@index');

$router->post('/tabel_blog/post','Tabel_blogController@post');

$router->put('/tabel_blog/update/{id}','Tabel_blogController@update');

$router->delete('/tabel_blog/delete/{id}','Tabel_blogController@delete');

// membuat komentar
$router->get('/tabel_comments','Tabel_commentsController@index');

$router->post('/tabel_comments/post','Tabel_commentsController@post');

// managemen category
$router->get('/tabel_category','Tabel_categoryController@index');

$router->post('/tabel_category/post','Tabel_categoryController@post');

$router->put('/tabel_category/update/{id}','Tabel_categoryController@update');

$router->delete('/tabel_category/delete/{id}','Tabel_categoryController@delete');
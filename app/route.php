<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/

$app->get('/', 'App\Controllers\HomeController:dispatch')->setName('homepage');

$app->get('/login', 'App\Controllers\UserController:login')->setName('login');

$app->get('/signup', 'App\Controllers\UserController:signup')->setName('signup') ;

$app->get('/search', 'App\Controllers\HomeController:search')->setName('search') ;


$app->post('/signup', 'App\Controllers\UserController:addMember');

$app->get('/about', 'App\Controllers\HomeController:about')->setName('about');
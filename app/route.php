<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/

$app->get('/', 'App\Controllers\HomeController:dispatch')->setName('homepage');

$app->get('/login', 'App\Controllers\UserController:login')->setName('login');

$app->get('/signin', 'App\Controllers\UserController:signin')->setName('signin');

$app->get('/about', 'App\Controllers\HomeController:about')->setName('about');
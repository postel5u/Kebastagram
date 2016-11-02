<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/

$app->get('/', 'App\Controllers\HomeController:dispatch')->setName('homepage');

$app->get('/login', 'App\Controllers\UserController:loginPage')->setName('login');

$app->post('/login', 'App\Controllers\UserController:login');

$app->get('/signup', 'App\Controllers\UserController:signup')->setName('signup') ;

$app->post('/signup', 'App\Controllers\UserController:addMember');

$app->get('/about', 'App\Controllers\HomeController:about')->setName('about');

$app->get('/profil', 'App\Controllers\UserController:profil')->setName('profil') ;
$app->get('/editprofil', 'App\Controllers\UserController:editProfil')->setName('editprofil') ;
$app->post('/acceptEdit', 'App\Controllers\UserController:acceptEdit')->setName('acceptEdit') ;
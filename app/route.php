<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/


$app->get('/', 'App\Controllers\HomeController:dispatch')->setName('homepage')->add($mw);

$app->get('/login', 'App\Controllers\UserController:loginPage')->setName('login');

$app->post('/login', 'App\Controllers\UserController:login');

$app->get('/logout', 'App\Controllers\UserController:logout')->setName('logout');

$app->get('/signup', 'App\Controllers\UserController:signup')->setName('signup') ;

$app->get('/search', 'App\Controllers\HomeController:search')->setName('search') ;


$app->post('/signup', 'App\Controllers\UserController:addMember');

$app->get('/postpic', 'App\Controllers\UserController:postpic')->setName('postpic');

$app->post('/validpic', 'App\Controllers\UserController:thepic')->setName("validpic");

$app->get('/about', 'App\Controllers\HomeController:about')->setName('about');

$app->get('/profil', 'App\Controllers\UserController:profil')->setName('profil') ;
$app->get('/editprofil', 'App\Controllers\UserController:editProfil')->setName('editprofil') ;
$app->post('/acceptEdit', 'App\Controllers\UserController:acceptEdit')->setName('acceptEdit') ;

$app->post('/comments', 'App\Controllers\AjaxController:comment');
$app->get('/comments/{id}', 'App\Controllers\HomeController:comments');
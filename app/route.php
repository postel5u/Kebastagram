<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/


$app->get('/', 'App\Controllers\HomeController:dispatch')->setName('homepage')->add($mw)->add($mw_route);

$app->get('/login', 'App\Controllers\UserController:loginPage')->setName('login');

$app->post('/login', 'App\Controllers\UserController:login');

$app->get('/logout', 'App\Controllers\UserController:logout')->setName('logout');

$app->get('/signup', 'App\Controllers\UserController:signup')->setName('signup');

$app->get('/search', 'App\Controllers\HomeController:search')->setName('search')->add($mw_route);

$app->post('/signup', 'App\Controllers\UserController:addMember');

$app->get('/about', 'App\Controllers\HomeController:about')->setName('about');

$app->get('/profil', 'App\Controllers\UserController:profil')->setName('profil')->add($mw_route);
$app->get('/editprofil', 'App\Controllers\UserController:editProfil')->setName('editprofil');
$app->post('/acceptEdit', 'App\Controllers\UserController:acceptEdit')->setName('acceptEdit');

$app->post('/like','App\Controllers\AjaxController:like');
$app->post('/unlike','App\Controllers\AjaxController:unlike');

$app->post('/comments', 'App\Controllers\AjaxController:comment');
$app->get('/show/comments/{id}', 'App\Controllers\HomeController:comments');
$app->get('/show/likes/{id}', 'App\Controllers\HomeController:likes');


$app->get('/profil/{username}','App\Controllers\UserController:profil_username')->setName('profil_username')->add($mw_route);

$app->get('/follow/{uniqid}', 'App\Controllers\UserController:follow');
$app->get('/unfollow/{uniqid}','App\Controllers\UserController:unfollow');

$app->get('/deletepic', 'App\Controllers\UserController:deletepic');

$app->get('/deletecom', 'App\Controllers\UserController:deletecom');

$app->get('/add','App\Controllers\UserController:add')->setName('add');

$app->post('/add','App\Controllers\UserController:add_post')->setName('add');

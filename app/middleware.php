<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(function ($request, $response, $next) {
    $this->view->offsetSet('flash', $this->flash);
    return $next($request, $response);
});

$app->add(function ($request, $response, $next) {
    if (isset($_SESSION['id'])){
        $this->view->render($response,'header.twig',['id'=>$_SESSION['id']]);
    }else{
        $this->view->render($response,'header.twig');
    }

    $response = $next($request, $response);

    return $response;
});
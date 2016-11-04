<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
use App\Models\User;

$app->add(function ($request, $response, $next) {
    $this->view->offsetSet('flash', $this->flash);
    return $next($request, $response);
});



$app->add(function ($request, $response, $next) {
    if (isset($_SESSION['uniqid'])){
        $u = User::where('uniqid',$_SESSION['uniqid'])->get()->first();
        $this->view->render($response,'header.twig',['user'=>$u]);
    }else{
        $this->view->render($response,'header.twig');
    }

    $response = $next($request, $response);
    $this->view->render($response,'footer.twig');

    return $response;
});

$mw = function ($request, $response, $next) {
    if (isset($_SESSION['uniqid'])){
        $u = User::where('uniqid',$_SESSION['uniqid'])->get()->first();
        $this->view->render($response,'homepage_co.twig',['user'=>$u]);
    }else{
        $this->view->render($response,'hello.twig');
    }

    return $response;
};
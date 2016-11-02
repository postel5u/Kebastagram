<?php

namespace App\Controllers;

use App\Models\User;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class HomeController
{
    private $view;
    private $logger;
	private $user;

    public function __construct($view, LoggerInterface $logger, $user)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->model = $user;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");
		
        $this->view->render($response, 'hello.twig');
		
        return $response;
    }

    public function search(Request $request, Response $response, $args){
        if (isset($_GET['recherche']) && $_GET['recherche'] != ""){
            $r = $_GET['recherche'];
            if (starts_with("#",$r)){
                $t = Picture::where('tag','LIKE',"%".$_GET['recherche']."%");
            }elseif (starts_with("@",$r)){
                $u = User::where('username','LIKE',$_GET['recherche']."%");
            }else{

            }
            $this->view->render($response, 'search.twig',array('recherche'=>$_GET['recherche']));
        }else{
            $this->view->render($response, 'hello.twig');
        }
    }
}
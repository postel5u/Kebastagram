<?php

namespace App\Controllers;

use App\Models\Comments;
use App\Models\User;
use App\Models\Pictures;
use Illuminate\Database\Capsule\Manager;
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
            if (starts_with($r,"#")){
                $r = substr($r, 1);
                $p = Pictures::where('tag','LIKE',"%".$r."%")->get();
                $this->view->render($response, 'search.twig',array('recherche'=>$r,'pics'=>$p));

            }elseif (starts_with($r,"@")){
                $r = substr($r, 1);
                $u = User::where('username','LIKE',$r."%")->orWhere('firstname','LIKE',$r."%")->orWhere('lastname','LIKE',$r."%")->get();
                $this->view->render($response, 'search.twig',array('recherche'=>$r,'users'=>$u));

            }else{
                $error ="Rechercher un utilisateur avec @ ou un tag avec #";
                $this->view->render($response, 'search.twig',array('erreur'=>$error));

            }
        }else{
            $this->view->render($response, 'hello.twig');
        }
    }

    public function comments(Request $request, Response $response, $args){
        $id = $args['id'];
        $p = Manager::select("select * from users, pictures where users.uniqid = pictures.user and pictures.id='$id'");
        $c = Manager::select("select * from users, comments where users.uniqid = comments.id_user and comments.id_picture='$id'");
        $this->view->render($response, 'comments.twig', array('picture' => $p[0], 'comments' => $c));
    }
}
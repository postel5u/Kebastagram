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
        if (isset($_SESSION['uniqid'])){
            $co = true;
        }else{
            $co = false;
        }
        if (isset($_GET['recherche']) && $_GET['recherche'] != ""){
            $co = false;
            if (isset($_SESSION['uniqid'])){
                $co = true;
            }
            $r = $_GET['recherche'];
            if (starts_with($r,"#")) {
                $r = substr($r, 1);
                $pic = \Illuminate\Database\Capsule\Manager::select("select * from users, pictures where users.uniqid=pictures.user and pictures.tag like '%$r%' ORDER BY date DESC ");
                $this->view->render($response, 'search.twig',array('recherche'=>$r,'pics'=>$pic,'co'=>$co));
            }elseif (starts_with($r,"@")){
                $r = substr($r, 1);
                $u = User::where('username','LIKE',$r."%")->orWhere('firstname','LIKE',$r."%")->orWhere('lastname','LIKE',$r."%")->get();
                $this->view->render($response, 'search.twig',array('recherche'=>$r,'users'=>$u,'co'=>$co));

            }else{
                $pic = \Illuminate\Database\Capsule\Manager::select("select * from users, pictures where users.uniqid=pictures.user and pictures.tag like '%$r%' ORDER BY date DESC ");
                $u = User::where('username','LIKE',$r."%")->orWhere('firstname','LIKE',$r."%")->orWhere('lastname','LIKE',$r."%")->get();
                $this->view->render($response, 'search.twig',array('recherche'=>$r,'users'=>$u,'pics'=>$pic,'co'=>$co));

            }
        }else{
            $this->view->render($response, 'hello.twig');
        }
    }

    public function comments(Request $request, Response $response, $args){
        if (!isset($_SESSION['uniqid'])){
            $uniqid ="";
        }else{
            $uniqid = $_SESSION['uniqid'];
        }
        $id = $args['id'];
        $c = Manager::select("select * from users, comments where users.uniqid = comments.id_user and comments.id_picture='$id'");
        foreach ($c as $com){
            $date = explode("-",$com->date);
            $com->date = "$date[2]/$date[1]/$date[0]";

        }
        $this->view->render($response, 'comments.twig', array('comments' => $c,'user'=>$uniqid));
    }

    public function likes(Request $request, Response $response, $args){
        $id = $args['id'];
        $like = \Illuminate\Database\Capsule\Manager::select("select * from users, users_pictures where users.uniqid = users_pictures.id_users and users_pictures.id_pictures='$id'");
        $this->view->render($response, 'likes.twig', array('likes' => $like));

    }
}
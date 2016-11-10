<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 08/11/16
<<<<<<< HEAD
 * Time: 10:48
=======
 * Time: 17:07
>>>>>>> master
 */

namespace App\Controllers;


use App\Models\Follows;
use App\Models\User;
use App\Models\Pictures;
use Illuminate\Contracts\Redis\Database;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use  PDO;
use App\Models\Comments;


final class AjaxController {

    private $view;
    private $logger;
    private $user;
    private $router;
    private $dbh;


    public function __construct($c)
    {
        $this->view = $c->get('view');
        $this->logger = $c->get('logger');
        $this->router = $c->get('router');


    }

    public function like(Request $request, Response $response, $args){

        try{
            $this->dbh = new PDO("mysql:dbname=kebabstagram; host=localhost","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        }catch(\Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        $p = \App\Models\Pictures::find($_POST['id']);

        $p->nbLike++;

        $u = \App\Models\User::find($_SESSION['uniqid']);
        $req = "insert into users_pictures (id_users,id_pictures) values ('$u->uniqid','$p->id')";
        $this->dbh->query($req);
        $p->save();


        echo json_encode('');
    }

    public function unlike(Request $request, Response $response, $args){

        try{
            $this->dbh = new PDO("mysql:dbname=kebabstagram; host=localhost","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        }catch(\Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        $p = \App\Models\Pictures::find($_POST['id']);

        $p->nbLike--;

        $u = \App\Models\User::find($_SESSION['uniqid']);
        $req = "delete from users_pictures where id_users='$u->uniqid' and id_pictures='$p->id'";
        $this->dbh->query($req);
        $p->save();


        echo json_encode('');
    }

    function comment(Request $request, Response $response, $args) {
        $p = $_POST['id'];
        $comments = $_POST['com'];
        $idc = uniqid("", 23);
        $idu = $_SESSION['uniqid'];

        $c = new Comments();
        $c->uniqid = $idc;
        $c->id_user = $idu;
        $c->id_picture = $p;
        $c->comment = $comments;
        $c->save();

        echo json_encode($c);
    }

    function follow(Request $request, Response $response, $args) {
        $u = $_SESSION['uniqid'];
        $user_follow = $_POST['id'];
        $f = new Follows();
        $f->id_user = $user_follow;
        $f->id_user_follow = $u ;
        $f->save();

        echo json_encode("");

    }

    function unfollow(Request $request, Response $response, $args) {
        $u = $_SESSION['uniqid'];
        $user_follow = $_POST['id'];
        Follows::where('id_user',$user_follow)->where('id_user_follow',$_SESSION['uniqid'])->delete();

        echo json_encode("");

    }
}

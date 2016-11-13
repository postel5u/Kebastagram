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



use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use  PDO;
use App\Models\Comments;
use Illuminate\Database\Capsule\Manager;



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

        $p = \App\Models\Pictures::find($_POST['id']);

        $p->nbLike++;
        $p->save();

        $u = \App\Models\User::find($_SESSION['uniqid']);
        Manager::table('users_pictures')->insert(
            ['id_users' => $u->uniqid, 'id_pictures' => $p->id]
        );



        echo json_encode('');
    }

    public function unlike(Request $request, Response $response, $args){


        $p = \App\Models\Pictures::find($_POST['id']);

        $p->nbLike--;

        $u = \App\Models\User::find($_SESSION['uniqid']);
        $p->save();
        Manager::table('users_pictures')->where('id_users', $u->uniqid)->where('id_pictures', $p->id)->delete();


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
        $c->date = date("Y-m-d");
        $c->save();

        echo json_encode($c);
    }
}

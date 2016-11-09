<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 08/11/16
 * Time: 17:07
 */

namespace App\Controllers;


use App\Models\Comments;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AjaxController
{

    private $view;
    private $logger;
    private $router;

    public function __construct($c)
    {
        $this->view = $c->get('view');
        $this->logger = $c->get('logger');
        $this->router = $c->get('router');
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
}
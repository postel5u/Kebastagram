<?php

namespace App\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class UserController
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
		
		$users = $this->model->show();

		return $this->view->render($response, 'users.twig', ["data" => $users]);
    }


    public function signup(Request $request, Response $response, $args){

        return $this->view->render($response,'signup.twig', array(   ));
    }



    public function addMember() {
        if (isset($_POST['submitInscription']) && ($_POST['submitInscription'] == 'subInscri')) {
            if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['password']) ) {
                $this->addUser($_POST['name'], $_POST['firstname'], $_POST['birthday'], $_POST['email'],$_POST['password']);
            }
        }
    }
    public function addUser($nom, $prenom, $dateNaiss, $email, $pass){
        $m = new \App\Models\User();

        $errors = array ();

        if ($nom != filter_var ( $nom, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Nom invalide, merci de corriger" );
        }
        if ($prenom != filter_var ( $prenom, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Prenom invalide, merci de corriger" );
        }
        if ($email != filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
            array_push ( $errors, "Adresse email invalide, merci de corriger" );
        } else {
            $emailVerif = \App\Models\User::where ( 'mail', $email )->get ();
            if (sizeof ( $emailVerif ) != 0) {
                array_push ( $errors, "Un compte a déjà été créé avec cette adresse email" );
            }
        }


        if ($pass != filter_var ( $pass, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Mot de passe invalide, merci de corriger" );
        }


        if (sizeof ( $errors ) == 0) {
            $nom = filter_var ( $nom, FILTER_SANITIZE_STRING );
            $prenom = filter_var ( $prenom, FILTER_SANITIZE_STRING );
            $email = filter_var ( $email, FILTER_SANITIZE_EMAIL );
            $pass = password_hash ( $pass, PASSWORD_DEFAULT, array (
                'cost' => 12
            ) );

            $date = explode('/', $dateNaiss);
            $dateFin = '';
            $i = sizeof($date);
            for($i; $i>0; $i--){
                $dateFin .= "-" . $date[$i-1];
            }
            $dateFin = substr($dateFin, 1);


            $m->nom = $nom;
            $m->prenom = $prenom;
            $m->anniv = $dateFin;
            $m->mail = $email;
            $m->mdp = $pass;
            $m->save ();

            $_SESSION['profile']= $m->prenom ." ".$m->nom;
            $_SESSION['email'] = $m->mail;
            $_SESSION['idMembre']= $m->id;

            $this->view->redirect($this->view->urlFor('homepage')) ;
        }


    }
}
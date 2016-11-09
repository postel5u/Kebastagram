<?php

namespace App\Controllers;

use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Arr;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class UserController
{
    private $view;
    private $logger;
    private $user;
    private $router;

    public function __construct($c)
    {
        $this->view = $c->get('view');
        $this->logger = $c->get('logger');
		$this->model = $c->get('App\Repositories\UserRepository');
        $this->router = $c->get('router');
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
    public function addMember(Request $request, Response $response, $args) {
        if (isset($_POST['action']) && ($_POST['action'] == 'subInscription')) {
            if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['address']) && isset($_POST['codepostal']) && isset($_POST['city']) )  {
                $this->addUser($_POST['name'], $_POST['firstname'], $_POST['birthday'], $_POST['email'],$_POST['password'], $_POST['username'],$_POST['address'], $_POST['codepostal'], $_POST['city'] );
                return $response->withRedirect($this->router->pathFor('homepage'));

            }
        }
    }
    public function addUser($nom, $prenom, $dateNaiss, $email, $pass, $username, $adress, $codepostal, $city ){
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
            $emailVerif = \App\Models\User::where ( 'email', $email )->get ();
            if (sizeof ( $emailVerif ) != 0) {
                array_push ( $errors, "Un compte a déjà été créé avec cette adresse email" );
            }
        }
        if ($adress != filter_var ( $adress, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Adresse invalide, merci de corriger" );
        }
        if ($codepostal != filter_var ( $codepostal, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Code postal invalide, merci de corriger" );
        }
        if ($city != filter_var ( $city, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Ville invalide, merci de corriger" );
        }


        if ($username != filter_var($username, FILTER_SANITIZE_STRING)){
            array_push ( $errors, "Username invalide, merci de corriger" );
        }
        if ($pass != filter_var ( $pass, FILTER_SANITIZE_STRING )) {
            array_push ( $errors, "Mot de passe invalide, merci de corriger" );
        }


        if (sizeof ( $errors ) == 0) {
            $nom = filter_var ( $nom, FILTER_SANITIZE_STRING );
            $prenom = filter_var ( $prenom, FILTER_SANITIZE_STRING );
            $email = filter_var ( $email, FILTER_SANITIZE_EMAIL );
            $adress = filter_var($adress, FILTER_SANITIZE_STRING );
            $codepostal = filter_var($codepostal, FILTER_SANITIZE_STRING );
            $city = filter_var($city, FILTER_SANITIZE_STRING );
            $username = filter_var($username, FILTER_SANITIZE_STRING );
            $pass = password_hash ( $pass, PASSWORD_DEFAULT, array (
                'cost' => 12,
            ) );

            $date = explode('/', $dateNaiss);
            $dateFin = '';
            $i = sizeof($date);
            for($i; $i>0; $i--){
                $dateFin .= "-" . $date[$i-1];
            }
            $dateFin = substr($dateFin, 1);

            $m->uniqid = uniqid();
            $m->lastname = $nom;
            $m->firstname = $prenom;
            $m->date_of_birth = $dateFin;
            $m->email = $email;
            $m->address = $adress;
            $m->postal_code = $codepostal;
            $m->city = $city;
            $m->password = $pass;
            $m->username = $username;
            $m->save ();


        }


    }

    public function profil(Request $request, Response $response, $args){
        $m = \App\Models\User::find('5819b4755d580');
        $val = ['username'=>$m->username,
                    'lastname' => $m->lastname,
                    'firstname'=> $m->firstname,
                    'date_of_birth'=>$m->date_of_birth,
                    'address'=>$m->address,
                    'email'=>$m->email
            ];

        return $this->view->render($response,'profil.twig', $val);
    }


    public function editProfil(Request $request, Response $response, $args){
        $m = \App\Models\User::find($_SESSION['uniqid']);
        $val = ['username'=>$m->username,
            'user'=>$m,
            'lastname' => $m->lastname,
            'firstname'=> $m->firstname,
            'date_of_birth'=>$m->date_of_birth,
            'address'=>$m->address,
            'email'=>$m->email,
            'password'=>$m->password,
            "city"=>$m->city,
            "postal_code"=>$m->postal_code,
            "profil_picture"=>$m->profil_picture,
            'salt'=>$m->salt
        ];
        return $this->view->render($response,'editProfil.twig', $val);
    }

    public function acceptEdit(Request $request, Response $response, $args)
    {
        $m = \App\Models\User::find('581c9cc0ddc41');
        if (password_verify($_POST["password"], $m->password)) {

            $nom = $_POST["lastname"];
            $prenom = $_POST["firstname"];
            $email = $_POST["email"];
            $adress = $_POST["adress"];
            $username = $_POST["username"];
            $pass = $_POST["password"];
            $city = $_POST["city"];
            $dateNaiss = $_POST["date_of_birth"];
            $postal_code = $_POST["postal_code"];
            $nom_pic = $_POST["image"];

            $data['file'] = $_FILES;

            //echo json_encode($data);

            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
            if ( in_array($extension_upload,$extensions_valides) ) {
              echo "Extension correcte";
              $n = $_FILES['image']['name'];
              $nom_pic = "pics/$n";

              $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom_pic);
              if ($resultat) {
                echo "Transfert réussi";

              }else{
                $nom_pic = "image/profil.png";
              }
            }

            if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Nom invalide, merci de corriger");
            }
            if ($prenom != filter_var($prenom, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Prenom invalide, merci de corriger");
            }
            if ($email != filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Adresse email invalide, merci de corriger");
            } else {
                $emailVerif = \App\Models\User::where('email', $email)->get();
                if (sizeof($emailVerif) != 0) {
                    array_push($errors, "Un compte a déjà été créé avec cette adresse email");
                }
            }
            if ($adress != filter_var($adress, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Adresse invalide, merci de corriger");
            }

            if ($city != filter_var($city, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Ville invalide, merci de corriger");
            }

            if ($postal_code != filter_var($postal_code, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Code postal invalide, merci de corriger");
            }

            if ($username != filter_var($username, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Username invalide, merci de corriger");
            }
            if ($pass != filter_var($pass, FILTER_SANITIZE_STRING)) {
                array_push($errors, "Mot de passe invalide, merci de corriger");
            }
            $pass = password_hash($pass, PASSWORD_DEFAULT, array(
                'cost' => 12,
            ));

            $date = explode('/', $dateNaiss);
            $dateFin = '';
            $i = sizeof($date);
            for ($i; $i > 0; $i--) {
                $dateFin .= "-" . $date[$i - 1];
            }
            $dateFin = substr($dateFin, 1);

            $m->lastname = $nom;
            $m->firstname = $prenom;
            $m->date_of_birth = $dateFin;
            $m->email = $email;
            $m->address = $adress;
            $m->postal_code = $postal_code;
            $m->city = $city;
            $m->password = $pass;
            $m->username = $username;
            $m->profil_picture = $nom_pic;
            $m->save();
            $val = ['username' => $m->username,
                'user' => $m,
                'lastname' => $m->lastname,
                'firstname' => $m->firstname,
                'date_of_birth' => $m->date_of_birth,
                'address' => $m->address,
                'email' => $m->email,
                'password' => $m->password,
                "city" => $m->city,
                "postal_code" => $m->postal_code,
                "profil_picture"=>$m->profil_picture,
                'salt' => $m->salt
            ];
            return $this->view->render($response, 'profil.twig', $val);

        } else {
            echo "failed";
            echo $_POST["image"];
            echo $m->password;
        }
    }

    public function loginPage(Request $request, Response $response, $args) {
        return $this->view->render($response, 'login.twig');
    }

    public function login(Request $request, Response $response, $args) {
        if(isset($_POST['action']) && $_POST['action'] == 'login') {
            if(isset($_POST["username"]) && isset($_POST["password"])) {
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                $m = User::where("username", $username)->orwhere("email", $username)->get()->first();
                if(isset($m->uniqid)) {
                    if (password_verify($password, $m->password)) {
                        $_SESSION["uniqid"] = $m->uniqid;
                        return $response->withRedirect($this->router->pathFor('homepage'));
                    }
                    else {
                        $this->view->render($response, 'login.twig', array('errors' => "error"));
                    }
                }
                else {
                    $this->view->render($response, 'login.twig', array('errors' => "error"));
                }
            }
            else {
                $this->view->render($response, 'login.twig', array('errors' => "error"));
            }
        }
        else {
            $this->view->render($response, 'login.twig', array('errors' => "error"));
        }
    }

    public function postpic(Request $request, Response $response, $args){
      return $this->view->render($response,'thepic.twig', array(   ));
    }

    public function thepic(Request $request, Response $response, $args){

      //die(var_dump($_FILES));
      $this->newpic();

      return $this->view->render($response,'hello.twig', array(   ));
    }

    public function newpic(){
      //var_dump($_FILES);
      $data['file'] = $_FILES;
      $data['text'] = $_POST;

      echo json_encode($data);

      $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
      $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
      if ( in_array($extension_upload,$extensions_valides) ) {
        echo "Extension correcte";
        $n = $_FILES['image']['name'];
        $nom = "pics/$n";
        $id = uniqid();
        $user = $_SESSION['id'];
        if (isset($_POST['content'])){
          $description = $_POST['content'];
        }else{
          $description = "L\'utilisateur n'a fourni aucune description.";
        }

        if (isset($_POST['title'])){
          $tag = $_POST['title'];
        }else{
          $tag = "";
        }

        $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
        if ($resultat) {
          echo "Transfert réussi";
          $pic = new \App\Models\Pictures();
          $pic->id = $id;
          $pic->link = $nom;
          $pic->description = $description;
          $pic->user = $user;
          $pic->tag = $tag;
          $pic->date = date("Y-m-d H:i:s");
          $pic->save();
        }
      }
    }

    public function logout(Request $request, Response $response, $args){
        unset($_SESSION['uniqid']);
        return $response->withRedirect($this->router->pathFor('homepage'));
    }

}

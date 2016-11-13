<?php

namespace App\Controllers;

use App\Models\Comments;
use App\Models\Follows;
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

    function resize_image($file,
                              $string             = null,
                              $width              = 0,
                              $height             = 0,
                              $proportional       = false,
                              $output             = 'file',
                              $delete_original    = true,
                              $use_linux_commands = false,
                              $quality            = 100,
                              $grayscale          = false
  		 ) {

    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;

	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }

    # Making the image grayscale, if needed
    if ($grayscale) {
      imagefilter($image, IMG_FILTER_GRAYSCALE);
    }

    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);


    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }

    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
    return true;
  }

    public function __construct($c)
    {
        $this->view = $c->get('view');
        $this->logger = $c->get('logger');
		$this->model = $c->get('App\Repositories\UserRepository');
        $this->router = $c->get('router');
    }

    public function signup(Request $request, Response $response, $args, $errors=null){

        return $this->view->render($response,'signup.twig', array('errors' => $errors));
    }
    public function addMember(Request $request, Response $response, $args) {
        if (isset($_POST['action']) && ($_POST['action'] == 'subInscription')) {
            if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['address']) && isset($_POST['codepostal']) && isset($_POST['city']) )  {

                $nom = $_POST['name'];
                $prenom = $_POST['firstname'];
                $dateNaiss = $_POST['birthday'];
                $username =  $_POST['username'];
                $email = $_POST['email'];
                $adress = $_POST['address'];
                $pass = $_POST['password'];
                $city = $_POST['city'];
                $codepostal = $_POST['codepostal'];

                $errors = array ();

                if ($nom != filter_var ( $nom, FILTER_SANITIZE_STRING )) {
                    array_push ( $errors, "Nom invalide, merci de corriger" );
                }
                if ($prenom != filter_var ( $prenom, FILTER_SANITIZE_STRING )) {
                    array_push ( $errors, "Prenom invalide, merci de corriger" );
                }
                if ($username != filter_var($username, FILTER_SANITIZE_STRING)){
                    array_push ( $errors, "Username invalide, merci de corriger" );
                }
                if ($email != filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
                    array_push ( $errors, "Adresse email invalide, merci de corriger" );
                } else {
                    $emailVerif = \App\Models\User::where ( 'email', $email )->orwhere('username', $username)->get ();
                    if (sizeof ( $emailVerif ) != 0) {
                        array_push ( $errors, "Un compte a déjà été créé avec cette adresse email ou ce pseudo" );
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
                    $m = new \App\Models\User();
                    $dateFin = $this->modifDate($dateNaiss);
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
                    return $response->withRedirect($this->router->pathFor('homepage'));

                }
                else {
                    return $this->view->render($response,'signup.twig', array('errors' => $errors));

                }
            }else{
                return $response->withRedirect($this->router->pathFor('homepage'));

            }
        }else{
            return $response->withRedirect($this->router->pathFor('homepage'));

        }
    }

    private function modifDate($date) {
        $jm = explode(' ', $date);
        $m = explode(',', $jm[1]);
        switch ($m[0]) {
            case "January":
                $m[0] = '01';
                break;
            case "February":
                $m[0] = '02';
                break;
            case "March":
                $m[0] = '03';
                break;
            case "April":
                $m[0] = '04';
                break;
            case "May":
                $m[0] = '05';
                break;
            case "June":
                $m[0] = '06';
                break;
            case "July":
                $m[0] = '07';
                break;
            case "August":
                $m[0] = '08';
                break;
            case "September":
                $m[0] = '09';
                break;
            case "October":
                $m[0] = '10';
                break;
            case "November":
                $m[0] = '11';
                break;
            case "December":
                $m[0] = '12';
                break;

        }
        return "$jm[2]-$m[0]-$jm[0]";
    }

    public function profil(Request $request, Response $response, $args){
        if (!isset($_SESSION['uniqid']))
            return $response->withRedirect($this->router->pathFor('homepage'));

        $m = \App\Models\User::where("uniqid","=",$_SESSION['uniqid'])->first();
        $pics = \Illuminate\Database\Capsule\Manager::select("select * from users, pictures where users.uniqid=pictures.user and pictures.user='$m->uniqid' ORDER BY date DESC ");
        $nb_follower = Follows::where('id_user',$m->uniqid)->count();
        $nb_follow = Follows::where('id_user_follow',$m->uniqid)->count();
        $nb_pics = 0;
        $follow = \Illuminate\Database\Capsule\Manager::select("select * from users, follows where users.uniqid=follows.id_user and follows.id_user_follow='$m->uniqid'");
        $follower = \Illuminate\Database\Capsule\Manager::select("select * from users, follows where users.uniqid=follows.id_user_follow and follows.id_user='$m->uniqid'");
        foreach ($pics as $pic){
            $nb_pics++;
            $d = abs(strtotime($pic->date)-time());
            if($d < 60){
                $pic->interval= "Il y a ".intval($d)." secondes";
            }
            elseif ($d/60 < 60) {
                $pic->interval= "Il y a ".intval($d/60)." minute(s)";
            }
            elseif ($d/3600 < 24) {
                $pic->interval= "Il y a ".intval($d/3600)." heure(s)";
            }
            elseif (($d/3600)/24 < 30){
                $pic->interval= "Il y a ".intval(($d/3600)/24)." jour(s)";
            }
            elseif ((($d/3600)/24)/30 < 12){
                $pic->interval= "Il y a ".intval((($d/3600)/24)/30) ." mois";
            }
            elseif ((($d/3600)/24)/30 > 12) {
                $pic->interval= "Il y a plus de ".intval(((($d/3600)/24)/30)/12) ." année(s)";
            }
        }
        $val = ['username'=>$m->username,
                    'lastname' => $m->lastname,
                    'firstname'=> $m->firstname,
                    "profil_picture"=>$m->profil_picture,
                    'pictures'=>$pics,
                    'nb_follow'=>$nb_follow,
                    'nb_follower'=>$nb_follower,
                    'nb_pics'=>$nb_pics,
                    'follow'=>$follow,
                    'follower'=>$follower
            ];
        return $this->view->render($response,'profil.twig', $val);
    }

    public function profil_username(Request $request, Response $response, $args){
        if (isset($_SESSION['uniqid'])){
            $co = true;
        }else{
            $co = false;
        }
        $u = User::where('username',$args["username"])->get();

        if ($u->isEmpty()){
            return $this->view->render($response, 'profil_username.twig', array('username' => $args['username'],'erreur'=>true));

        }else {
            $u = $u->first();
            if ($co) {
                if ($u->uniqid == $_SESSION['uniqid']) {
                    return $response->withRedirect($this->router->pathFor('profil'));

                }
            }
            $pics = \Illuminate\Database\Capsule\Manager::select("select * from users, pictures where users.uniqid=pictures.user and pictures.user='$u->uniqid' ORDER BY date DESC ");
            $nb_follower = Follows::where('id_user',$u->uniqid)->count();
            $nb_follow = Follows::where('id_user_follow',$u->uniqid)->count();
            $nb_pics = 0;
            $follow = \Illuminate\Database\Capsule\Manager::select("select * from users, follows where users.uniqid=follows.id_user and follows.id_user_follow='$u->uniqid'");
            $follower = \Illuminate\Database\Capsule\Manager::select("select * from users, follows where users.uniqid=follows.id_user_follow and follows.id_user='$u->uniqid'");
            $bool_follow = false;

            if($co){
                if (Follows::where('id_user',$u->uniqid)->where('id_user_follow',$_SESSION['uniqid'])->count() > 0){
                    $bool_follow = true;
                }else{
                    $bool_follow = false;

                }
            }
            foreach ($pics as $pic){
                $nb_pics++;
                $d = abs(strtotime($pic->date)-time());
                if($d < 60){
                    $pic->interval= "Il y a ".intval($d)." secondes";
                }
                elseif ($d/60 < 60) {
                    $pic->interval= "Il y a ".intval($d/60)." minute(s)";
                }
                elseif ($d/3600 < 24) {
                    $pic->interval= "Il y a ".intval($d/3600)." heure(s)";
                }
                elseif (($d/3600)/24 < 30){
                    $pic->interval= "Il y a ".intval(($d/3600)/24)." jour(s)";
                }
                elseif ((($d/3600)/24)/30 < 12){
                    $pic->interval= "Il y a ".intval((($d/3600)/24)/30) ." mois";
                }
                elseif ((($d/3600)/24)/30 > 12) {
                    $pic->interval= "Il y a plus de ".intval(((($d/3600)/24)/30)/12) ." année(s)";
                }
            }
            $val = ['uniqid'=>$u->uniqid,
                'username'=>$u->username,
                'lastname' => $u->lastname,
                'firstname'=> $u->firstname,
                "profil_picture"=>$u->profil_picture,
                'pictures'=>$pics,
                'nb_follow'=>$nb_follow,
                'nb_follower'=>$nb_follower,
                'nb_pics'=>$nb_pics,
                'follow'=>$follow,
                'follower'=>$follower,
                'erreur'=>false,
                'bool_follow'=>$bool_follow,
                'co'=>$co
            ];
            return $this->view->render($response,'profil_username.twig', $val);
        }

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
        ];
        return $this->view->render($response,'editProfil.twig', $val);
    }

    public function acceptEdit(Request $request, Response $response, $args)
    {
        $m = \App\Models\User::where("uniqid","=",$_SESSION['uniqid'])->first();
        if (password_verify($_POST["password"], $m->password)) {

            $nom = $_POST["lastname"];
            $prenom = $_POST["firstname"];
            $email = $_POST["email"];
            $adress = $_POST["address"];
            $username = $_POST["username"];
            $pass = $_POST["password"];
            $city = $_POST["city"];
            $dateNaiss = $_POST["date_of_birth"];
            $postal_code = $_POST["postal_code"];
            $nom_pic = $_POST["image"];
            if ($_FILES['image']['name'] != "") {
                $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
                $extension_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                if (in_array($extension_upload, $extensions_valides)) {
                    if ($_FILES['image']['size'] <= 67108864) {
                        $n = $_FILES['image']['name'];

                        $nom_pic = "pics/$n";

                        $pic_r = $_FILES['image']['tmp_name'];
                        $this->resize_image($pic_r, null, 200, 200);
                        $resultat = move_uploaded_file($pic_r, $nom_pic);

                        if ($resultat) {

                        } else {
                            return $this->view->render($response, 'editProfil.twig', ['erreur' => 'Erreur lors de l\'envoye du fichier, merci de recommencer.', 'username' => $m->username, 'user' => $m, 'lastname' => $m->lastname, 'firstname' => $m->firstname, 'date_of_birth' => $m->date_of_birth, 'address' => $m->address, 'email' => $m->email, 'password' => $m->password, "city" => $m->city, "postal_code" => $m->postal_code, "profil_picture" => $m->profil_picture]);
                        }
                    } else {
                        return $this->view->render($response, 'editProfil.twig', ['erreur' => 'Poids du fichier trop important.', 'username' => $m->username, 'user' => $m, 'lastname' => $m->lastname, 'firstname' => $m->firstname, 'date_of_birth' => $m->date_of_birth, 'address' => $m->address, 'email' => $m->email, 'password' => $m->password, "city" => $m->city, "postal_code" => $m->postal_code, "profil_picture" => $m->profil_picture]);

                    }
                } else {
                    return $this->view->render($response, 'editProfil.twig', ['erreur' => 'Format de fichier non pris en compte, utiliser un .jpg .png ou .gif.', 'username' => $m->username, 'user' => $m, 'lastname' => $m->lastname, 'firstname' => $m->firstname, 'date_of_birth' => $m->date_of_birth, 'address' => $m->address, 'email' => $m->email, 'password' => $m->password, "city" => $m->city, "postal_code" => $m->postal_code, "profil_picture" => $m->profil_picture]);

                }
            }
            $errors = [];
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
                if (sizeof($emailVerif) != 0 && $emailVerif->first()->email != $m->email) {
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

            if (sizeof($errors) > 0){
                return $this->view->render($response, 'editProfil.twig', ['erreur'=>$errors[0], 'username'=>$m->username, 'user'=>$m, 'lastname' => $m->lastname, 'firstname'=> $m->firstname, 'date_of_birth'=>$m->date_of_birth, 'address'=>$m->address, 'email'=>$m->email, 'password'=>$m->password, "city"=>$m->city, "postal_code"=>$m->postal_code, "profil_picture"=>$m->profil_picture]);
            }
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
                'succes'=>true
            ];
            return $this->view->render($response, 'editProfil.twig', $val);

        } else {
            return $this->view->render($response, 'editProfil.twig', ['erreur'=>'Mot de passe incorrect', 'username'=>$m->username, 'user'=>$m, 'lastname' => $m->lastname, 'firstname'=> $m->firstname, 'date_of_birth'=>$m->date_of_birth, 'address'=>$m->address, 'email'=>$m->email, 'password'=>$m->password, "city"=>$m->city, "postal_code"=>$m->postal_code, "profil_picture"=>$m->profil_picture]);

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

    public function logout(Request $request, Response $response, $args){
        unset($_SESSION['uniqid']);
        return $response->withRedirect($this->router->pathFor('homepage'));
    }

    function follow(Request $request, Response $response, $args) {
        $u = $_SESSION['uniqid'];
        $user_follow = $args['uniqid'];
        $username = User::where('uniqid',$user_follow)->first()->username;
        $f = new Follows();
        $f->id_user = $user_follow;
        $f->id_user_follow = $u ;
        $f->save();
        $url = $this->router->pathFor('profil_username',['username'=>$username]);
        return $response->withStatus(302)->withHeader('Location', $url);

    }

    function unfollow(Request $request, Response $response, $args) {
        $u = $_SESSION['uniqid'];
        $user_follow = $args['uniqid'];
        $username = User::where('uniqid',$user_follow)->first()->username;
        Follows::where('id_user',$user_follow)->where('id_user_follow',$_SESSION['uniqid'])->delete();
        $url = $this->router->pathFor('profil_username',['username'=>$username]);
        return $response->withStatus(302)->withHeader('Location', $url);

    }

    function deletepic(Request $request, Response $response, $args){
      \App\Models\Pictures::find($_GET['id'])->delete();
        return $response->withRedirect($this->router->pathFor('profil'));
    }

    function deletecom (Request $request, Response $response, $args){
        Comments::find($_GET['id'])->delete();
        return $response->withRedirect($this->router->pathFor('homepage'));

    }

    function add(Request $request, Response $response, $args){
        if (!isset($_SESSION['uniqid']))
            return $response->withRedirect($this->router->pathFor('homepage'));
        $u = User::find($_SESSION['uniqid']);
        return $this->view->render($response, 'add.twig',['p'=>$u]);

    }

    function add_post (Request $request, Response $response, $args){

        if (isset($_POST['action'])&& $_POST['action']=='send'){
            $data['file'] = $_FILES;
            $data['text'] = $_POST;
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
            if ( in_array($extension_upload,$extensions_valides) ) {
                if($_FILES['image']['size'] <= 67108864){
                    $n = $_FILES['image']['name'];
                    $nom = "pics/$n";
                    $id = uniqid();
                    $user = $_SESSION['uniqid'];
                    $description = $_POST['content'];
                    $tag = $_POST['title'];
                    $pic_r = $_FILES['image']['tmp_name'];
                    $this->resize_image($pic_r,null,300,300);
                    $resultat = move_uploaded_file($pic_r,$nom);
                    if ($resultat) {
                        $pic = new \App\Models\Pictures();
                        $pic->id = $id;
                        $pic->link = $nom;
                        $pic->description = $description;
                        $pic->user = $user;
                        $pic->tag = $tag;
                        $pic->date = date("Y-m-d H:i:s");
                        $pic->save();
                        return $response->withRedirect($this->router->pathFor('profil'));
                    }else{
                        return $this->view->render($response, 'add.twig',['erreur'=>'Erreur lors de l\'ajout de la photo, merci de recommencer.']);

                    }
                }else{
                    return $this->view->render($response, 'add.twig',['erreur'=>'Poids du fichier trop important.']);

                }
            }else{
                return $this->view->render($response, 'add.twig',['erreur'=>'Format de fichier non pris en compte, utiliser un .jpg .png ou .gif.']);

            }
        }else{
            return $this->view->render($response, 'add.twig',['erreur'=>'Erreur lors de l\'ajout de la photo, merci de recommencer.']);

        }

    }
}

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
        $id = $_SESSION['uniqid'];
        $u = User::where('uniqid',$id)->get()->first();
        $f = \App\Models\Follows::where('id_user',$id)->get();
        $p = array();
        $user_follow = array();
        foreach ($f as $follow){
            $user_follow = User::where('uniqid',$follow->id_user_follow)->get();
            $p = \Illuminate\Database\Capsule\Manager::select("select * from users, pictures where users.uniqid=pictures.user and pictures.user='$follow->id_user_follow' ORDER BY date DESC ");
        }
        foreach ($p as $pics){
            $d = abs(strtotime($pics->date)-time());
            if($d < 60){
                $pics->interval= "Il y a ".intval($d)." secondes";
            }
            elseif ($d/60 < 60) {
                $pics->interval= "Il y a ".intval($d/60)." minute(s)";
            }
            elseif ($d/3600 < 24) {
                $pics->interval= "Il y a ".intval($d/3600)." heure(s)";
            }
            elseif (($d/3600)/24 < 30){
                $pics->interval= "Il y a ".intval(($d/3600)/24)." jour(s)";
            }
            elseif ((($d/3600)/24)/30 < 12){
                $pics->interval= "Il y a ".intval((($d/3600)/24)/30) ." mois";
            }
            elseif ((($d/3600)/24)/30 > 12) {
                $pics->interval= "Il y a plus de ".intval(((($d/3600)/24)/30)/12) ." année(s)";
            }
        }
        $this->view->render($response,'homepage_co.twig',['user'=>$u,'follows'=>$user_follow,'pictures'=>$p]);
    }else{
        $this->view->render($response,'hello.twig');
    }

    return $response;
};
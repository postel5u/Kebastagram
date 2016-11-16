<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
use App\Models\User;

$app->add(function ($request, $response, $next) {
    $this->view->offsetSet('flash', $this->flash);
    return $next($request, $response);
});



$app->add(function ($request, $response, $next) {
    if (!(starts_with($request->getUri()->getPath(),'/show'))){
        if (isset($_SESSION['uniqid'])){
            $u = User::where('uniqid',$_SESSION['uniqid'])->get()->first();
            $this->view->render($response,'header.twig',['user'=>$u]);
        }else{
            $this->view->render($response,'header.twig');
        }
        $response = $next($request, $response);
        $this->view->render($response,'footer.twig');

        return $response;
    }else{
        $response = $next($request, $response);
        return $response;
    }
});

$mw = function ($request, $response, $next) {
    if (isset($_SESSION['uniqid'])){
        $id = $_SESSION['uniqid'];
        $u = User::where('uniqid',$id)->get()->first();
        $f = \App\Models\Follows::where('id_user_follow',$id)->get();
        $p =array();
        $user_follow = array();
        foreach ($f as $follow){
            $pic = \Illuminate\Database\Capsule\Manager::select("select * from users, pictures where users.uniqid=pictures.user and pictures.user='$follow->id_user' ORDER BY date DESC ");
            $p = array_merge($p,$pic);
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
            if(sizeof(\Illuminate\Database\Capsule\Manager::select("select * from users_pictures where users_pictures.id_users='$u->uniqid' and users_pictures.id_pictures='$pics->id'"))== 1){
                $pics->aime = true;
            }else{
                $pics->aime = false;
            }
        }
        $this->view->render($response,'homepage_co.twig',['user'=>$u,'pictures'=>$p]);
    }else{
        $this->view->render($response,'hello.twig');
    }

    return $response;
};

$mw_route =function ($request, $response, $next) {
    $_SESSION['route'] = $request->getUri();
    $response = $next($request, $response);
    return $response;

};

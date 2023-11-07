<?php

namespace App\controllers;

function call($controller, $action){
    switch($controller){
        case "pages":
            $controller = new PagesController();
            break;
        case "admin":
            $controller = new AdminController();
            break;
        case "articles":
            $controller = new ArticlesController();
            break;
        case "user":
            $controller = new UserController();
            break;
    }
    $controller->{ $action }();
}

$controllers = array(
    'pages'=>['index','association','rejoindre','festival','galerie','news','partenaires','error'],
    'admin'=>['connexion','dashboard','artistes','createArtiste','updateArtiste','partenaires','restauration','bureau','createMembre','news','plan','galerie','utilisateurs'],
    'articles'=>['create','update','delete'],
    'user'=>['connexion','deconnexion','create','update','delete']
);


if(array_key_exists($controller, $controllers)){
    if(in_array($action, $controllers[$controller])){
        
        call($controller, $action);
    }else{
        call("pages", "error");
    }
}else{
    call("pages", "error");
}

?>

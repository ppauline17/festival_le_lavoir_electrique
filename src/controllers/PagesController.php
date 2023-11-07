<?php

namespace App\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\models\ArticleManager;


class PagesController {
    private $twig;

    public function __construct() {
        $loader = new FilesystemLoader('templates');
        $this->twig = new Environment($loader);
    }

    public function index(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $artistes= ArticleManager :: getArticleByCategorie('Artistes');
        echo $this->twig->render('pages/index.html.twig',[
            'artistes'=>$artistes,
            'session'=>$session
        ]);
    }

    public function association(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $membres= ArticleManager :: getArticleByCategorie('Bureau');
        echo $this->twig->render('pages/association.html.twig',[
            'membres'=>$membres,
            'session'=>$session
        ]);

    }

    public function rejoindre(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        echo $this->twig->render('pages/rejoindre.html.twig',[
            'session'=>$session
        ]);

    }

    public function festival(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $artistes= ArticleManager :: getArticleByCategorie('Artistes');
        $restauration = ArticleManager :: getArticleByCategorie('Restauration');
        $plan = ArticleManager :: getArticleByCategorie('Plan');
        echo $this->twig->render('pages/festival.html.twig',[
            'plan'=>$plan,
            'artistes'=>$artistes,
            'restauration'=>$restauration,
            'session'=>$session
        ]);

    }

    public function galerie(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $images= ArticleManager :: getArticleByCategorie('Galerie');
        echo $this->twig->render('pages/galerie.html.twig',[
            'images'=>$images,
            'session'=>$session
        ]);
    }

    public function news(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $news= ArticleManager :: getArticleByCategorie('News');
        echo $this->twig->render('pages/news.html.twig',[
            'news'=>$news,
            'session'=>$session
        ]);

    }

    public function partenaires(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $partenaires= ArticleManager :: getArticleByCategorie('Partenaires');
        echo $this->twig->render('pages/partenaires.html.twig',[
            'partenaires'=>$partenaires,
            'session'=>$session
        ]);
    }

    public function error(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        echo $this->twig->render('pages/error.html.twig',[
            'session'=>$session
        ]);
    }
}
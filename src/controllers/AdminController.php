<?php

namespace App\controllers;

use Twig\Environment;
use App\models\UserManager;
use App\models\ArticleManager;
use Twig\Loader\FilesystemLoader;


class AdminController {
    private $twig;

    public function __construct() {
        $loader = new FilesystemLoader('templates');
        $this->twig = new Environment($loader);
    }

    public function connexion(){
        echo $this->twig->render('admin/connexion.html.twig');
    }

    public function dashboard(){
        echo $this->twig->render('admin/dashboard.html.twig');
    }

    public function artistes(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $artistes= ArticleManager :: getArticleByCategorie('Artistes');
        echo $this->twig->render('admin/artistes/artistes.html.twig',[
            'artistes'=>$artistes,
            'session'=>$session
        ]);
    }

    public function createArtiste(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        echo $this->twig->render('admin/artistes/create.html.twig',[
            'session'=>$session
        ]);
    }

    public function updateArtiste(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $id_artiste=$_GET['id_artiste'];
        $artiste=ArticleManager :: getOneArticle($id_artiste);
        echo $this->twig->render('admin/artistes/update.html.twig',[
            'artiste'=>$artiste,
            'session'=>$session
        ]);
    }

    public function restauration(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $restauration= ArticleManager :: getArticleByCategorie('Restauration');
        echo $this->twig->render('admin/restauration/restauration.html.twig',[
            'restauration'=>$restauration,
            'session'=>$session
        ]);
    }

    public function bureau(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $membres= ArticleManager :: getArticleByCategorie('Bureau');
        echo $this->twig->render('admin/bureau/bureau.html.twig',[
            'membres'=>$membres,
            'session'=>$session
        ]);
    }

    public function createMembre(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        echo $this->twig->render('admin/bureau/create.html.twig',[
            'session'=>$session
        ]);
    }

    public function news(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $news= ArticleManager :: getArticleByCategorie('News');
        echo $this->twig->render('admin/news/news.html.twig',[
            'news'=>$news,
            'session'=>$session
        ]);
    }

    public function plan(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $plan= ArticleManager :: getArticleByCategorie('Plan');
        echo $this->twig->render('admin/plan/plan.html.twig',[
            'plan'=>$plan,
            'session'=>$session
        ]);
    }

    public function galerie(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $galerie= ArticleManager :: getArticleByCategorie('Galerie');
        echo $this->twig->render('admin/galerie/galerie.html.twig',[
            'galerie'=>$galerie,
            'session'=>$session
        ]);
    }

    public function partenaires(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $partenaires= ArticleManager :: getArticleByCategorie('Partenaires');
        echo $this->twig->render('admin/partenaires/partenaires.html.twig',[
            'partenaires'=>$partenaires,
            'session'=>$session
        ]);
    }

    public function utilisateurs(){
        $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
        $utilisateurs= UserManager :: getUsers();
        echo $this->twig->render('admin/utilisateurs/utilisateurs.html.twig',[
            'utilisateurs'=>$utilisateurs,
            'session'=>$session
        ]);
    }
}
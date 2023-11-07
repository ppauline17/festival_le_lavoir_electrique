<?php

namespace App\controllers;

use Twig\Environment;
use App\entities\Article;
use App\models\ArticleManager;
use Twig\Loader\FilesystemLoader;


class ArticlesController {
    private $twig;

    public function __construct() {
        $loader = new FilesystemLoader('templates');
        $this->twig = new Environment($loader);
    }

    public function create(){
        $champs = ['titre','contenu','date_evenement','date_publication','id_categorie','instagram','facebook','youtube','spotify','site_internet'];
        foreach($champs as $valeur){
            if (isset($_POST[$valeur])){
                ${$valeur} = !empty($_POST[$valeur]) ? $_POST[$valeur] : NULL;
            }else{
                ${$valeur} = NULL;
            }
        }

        if ($_FILES['image']['name']!=""){
            $image = $this->uploadFile($id_categorie);
        }else{
            $image = NULL;
        }

        var_dump($image);

        $article = new Article();
        $article->setTitre($titre)
                ->setContenu($contenu)
                ->setDate_evenement($date_evenement)
                ->setDate_publication($date_publication)
                ->setImage($image)
                ->setId_categorie($id_categorie)
                ->setInstagram($instagram)
                ->setFacebook($facebook)
                ->setYoutube($youtube)
                ->setSpotify($spotify)
                ->setSiteInternet($site_internet);

        ArticleManager :: addArticle($article);

        $this->redirect($id_categorie);
    }

    

    public function update(){
        $champs = ['id_article','titre','contenu','date_evenement','date_publication','id_categorie','instagram','facebook','youtube','spotify','site_internet'];
        foreach($champs as $valeur){
            if (isset($_POST[$valeur])){
                ${$valeur} = !empty($_POST[$valeur]) ? $_POST[$valeur] : NULL;
            }else{
                ${$valeur} = NULL;
            }
        }

        if ($_FILES['image']['name']!=""){
            $image = $this->uploadFile($id_categorie);
        }else{
            $image = $_POST['old_image'];
        }

        $article = new Article();
        $article->setId_article($id_article)
                ->setTitre($titre)
                ->setContenu($contenu)
                ->setDate_evenement($date_evenement)
                ->setDate_publication($date_publication)
                ->setImage($image)
                ->setId_categorie($id_categorie)
                ->setInstagram($instagram)
                ->setFacebook($facebook)
                ->setYoutube($youtube)
                ->setSpotify($spotify)
                ->setSiteInternet($site_internet);

        ArticleManager :: updateArticle($article);

        $this->redirect($id_categorie);
    }

    public function delete(){
        $id_article=$_GET['id_article'];

        $article = ArticleManager :: getOneArticle($id_article);
        $id_categorie = $article->getId_categorie();
        $image = $article->getImage();
        if (file_exists($image)) {
            unlink($image);
        }

        ArticleManager :: deleteArticle($id_article);

        $this->redirect($id_categorie);
    }

    public function redirect($id_categorie){
        switch($id_categorie){
            case 1:
                header('location: admin/partenaires');
                break;
            case 2:
                header('location: admin/restauration');
                break;
            case 3:
                header('location: admin/bureau');
                break;
            case 4:
                header('location: admin/news');
                break;
            case 5:
                header('location: admin/artistes');
                break;
            case 6:
                header('location: admin/plan');
                break;
            case 7:
                header('location: admin/galerie');
                break;
        }
    }

    public function uploadFile($id_categorie){
        switch($id_categorie){
            case 1:
                $category = 'partenaires';
                break;
            case 3:
                $category = 'bureau';
                break;
            case 4:
                $category = 'news';
                break;
            case 5:
                $category = 'artistes';
                break;
            case 7:
                $category = 'galerie';
                break;
        }
        // on modifie le nom de l'image
        $fileName = $_FILES['image']['name'];
        $fileNameArray = explode(".",$fileName);
        $extension = end($fileNameArray);
        $newFileName = $category.time().".".$extension;
        $fileToUpload = 'uploads/'.$category.'/'.$newFileName; 
        
        move_uploaded_file($_FILES['image']['tmp_name'], $fileToUpload);
        $imageName = $fileToUpload;

        return $imageName;
    }
}
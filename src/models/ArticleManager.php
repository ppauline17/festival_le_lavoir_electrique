<?php

namespace App\models;

use PDO;
use App\entities\Article;

class ArticleManager{
    public static function getArticleByCategorie($categorie){
        $articles=[];
        $sql = "SELECT * FROM articles NATURAL JOIN categories WHERE nom_categorie = :nom_categorie ORDER BY titre" ;
        $db = DbConnect::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array(':nom_categorie' => $categorie));
        
        foreach($req as $values){
            $articles[] = new Article($values);
        }
        
        return $articles;
    }

    public static function getYearByCategorie($categorie){
        $annees = [];
        $sql = "SELECT YEAR(date_evenement) as annee FROM articles WHERE nom_categorie = :nom_categorie GROUP BY YEAR(date_evenement)";
        $db = DbConnect::getInstance();
        $req = $db->prepare($sql);
        $req->execute([
            ':nom_categorie' => $categorie
        ]);

        $annees = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $annees;
    }

    public static function getArticleByCategorieAndYear($categorie,$year){
        $articles=[];
        $sql = "SELECT * FROM articles NATURAL JOIN categories WHERE nom_categorie = :nom_categorie AND YEAR(date_evenement) = :year ORDER BY titre" ;
        $db = DbConnect::getInstance();
        $req = $db->prepare($sql);
        $req->execute([
            ':nom_categorie' => $categorie,
            ':year' => $year
        ]);
        
        foreach($req as $values){
            $articles[] = new Article($values);
        }
        
        return $articles;
    }

    
    public static function getOneArticle($id_article){
        $sql = "SELECT * FROM articles NATURAL JOIN categories WHERE id_article = :id_article" ;
        $db = DbConnect::getInstance();
        $req = $db->prepare($sql);
        $req->bindValue(':id_article', $id_article, PDO::PARAM_INT);
        $req->execute();
        $reponse = $req->fetch(PDO::FETCH_ASSOC);
        
        $article = new Article($reponse);
        
        return $article;
    }

    public static function addArticle(Article $obj){
        $db = DbConnect::getInstance();
        $sql = "INSERT INTO articles (titre, contenu, date_evenement, date_publication, image, id_categorie, annee, instagram, facebook, youtube, spotify, site_internet) VALUES (:titre, :contenu, :date_evenement, :date_publication, :image, :id_categorie, :annee, :instagram, :facebook, :youtube, :spotify, :site_internet)";
        $req = $db->prepare($sql);
        $req->bindValue(':titre', $obj->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $obj->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':date_evenement', $obj->getDate_evenement(), PDO::PARAM_STR);
        $req->bindValue(':date_publication', $obj->getDate_publication(), PDO::PARAM_STR);
        $req->bindValue(':image', $obj->getImage(), PDO::PARAM_STR);
        $req->bindValue(':id_categorie', $obj->getId_categorie(), PDO::PARAM_INT);
        $req->bindValue(':annee', $obj->getAnnee(), PDO::PARAM_INT);
        $req->bindValue(':instagram', $obj->getInstagram(), PDO::PARAM_STR);
        $req->bindValue(':facebook', $obj->getFacebook(), PDO::PARAM_STR);
        $req->bindValue(':youtube', $obj->getYoutube(), PDO::PARAM_STR);
        $req->bindValue(':spotify', $obj->getSpotify(), PDO::PARAM_STR);
        $req->bindValue(':site_internet', $obj->getSiteInternet(), PDO::PARAM_STR);
        $req->execute();

        // return $db->lastInsertId();
    }

    public static function updateArticle(Article $obj){
        $db = DbConnect::getInstance();

        $sql = "UPDATE articles SET titre=:titre, contenu=:contenu, date_evenement=:date_evenement, date_publication=:date_publication, annee=:annee, image=:image, instagram=:instagram, facebook=:facebook, youtube=:youtube, spotify=:spotify, site_internet=:site_internet WHERE id_article=:id_article";
        $req = $db->prepare($sql);
        $req->bindValue(':id_article', $obj->getId_article(), PDO::PARAM_INT);
        $req->bindValue(':titre', $obj->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':contenu', $obj->getContenu(), PDO::PARAM_STR);
        $req->bindValue(':date_evenement', $obj->getDate_evenement(), PDO::PARAM_STR);
        $req->bindValue(':date_publication', $obj->getDate_publication(), PDO::PARAM_STR);
        $req->bindValue(':annee', $obj->getAnnee(), PDO::PARAM_INT);
        $req->bindValue(':image', $obj->getImage(), PDO::PARAM_STR);
        $req->bindValue(':instagram', $obj->getInstagram(), PDO::PARAM_STR);
        $req->bindValue(':facebook', $obj->getFacebook(), PDO::PARAM_STR);
        $req->bindValue(':youtube', $obj->getYoutube(), PDO::PARAM_STR);
        $req->bindValue(':spotify', $obj->getSpotify(), PDO::PARAM_STR);
        $req->bindValue(':site_internet', $obj->getSiteInternet(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function deleteArticle($id_article){
        $db = DbConnect::getInstance();
        $sqldelete = "DELETE FROM articles WHERE id_article = :id_article";
        $req = $db->prepare($sqldelete);
        $req->bindValue(':id_article', $id_article, PDO::PARAM_INT);
        $req->execute();
    }
    
}
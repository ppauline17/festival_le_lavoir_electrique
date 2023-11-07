<?php

namespace App\entities;

class Article{
    private $id_article;
    private $titre;
    private $contenu;
    private $date_evenement;
    private $date_publication;
    private $image;
    private $id_categorie;
    private $annee;
    private $instagram;
    private $facebook;
    private $youtube;
    private $spotify;
    private $site_internet;

    public function __construct($data = array()){
        if(!empty($data)){
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data) {
        foreach($data as $key => $value){
            $method='set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function getId_article(){
        return $this->id_article;
    }

    public function setId_article($id_article){
        $this->id_article=$id_article;
        return $this;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre=$titre;
        return $this;
    }

    public function getContenu(){
        return $this->contenu;
    }

    public function setContenu($contenu){
        $this->contenu=$contenu;
        return $this;
    }

    public function getDate_evenement(){
        return $this->date_evenement;
    }

    public function setDate_evenement($date_evenement){
        $this->date_evenement=$date_evenement;
        return $this;
    }

    public function getDate_publication(){
        return $this->date_publication;
    }

    public function setDate_publication($date_publication){
        $this->date_publication=$date_publication;
        return $this;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image=$image;
        return $this;
    }

    public function getId_categorie(){
        return $this->id_categorie;
    }

    public function setId_categorie($id_categorie){
        $this->id_categorie=$id_categorie;
        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    public function getInstagram()
    {
        return $this->instagram;
    }

    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getYoutube()
    {
        return $this->youtube;
    }

    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getSpotify()
    {
        return $this->spotify;
    }

    public function setSpotify($spotify)
    {
        $this->spotify = $spotify;

        return $this;
    }

    public function getSiteInternet()
    {
        return $this->site_internet;
    }

    public function setSiteInternet($site_internet)
    {
        $this->site_internet = $site_internet;

        return $this;
    }
}
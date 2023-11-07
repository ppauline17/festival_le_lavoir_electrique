<?php

namespace App\entities;

class User{
    private $id_user;
    private $login;
    private $password;
    private $role;


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

    public function getId_user(){
        return $this->id_user;
    }

    public function setId_user($id_user){
        $this->id_user=$id_user;
        return $this;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login){
        $this->login=$login;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password=$password;
        return $this;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role=$role;
        return $this;
    }
}
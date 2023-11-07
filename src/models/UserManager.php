<?php

namespace App\models;

use PDO;
use App\entities\User;

class userManager{
    public static function getUser($login){
        $sql = "SELECT * FROM users WHERE login = :login" ;
        $db = DbConnect::getInstance();
        $req = $db->prepare($sql);
        $req->execute([
            ':login' => $login
        ]);
        $reponse = $req->fetch(PDO::FETCH_ASSOC);
        
        if($reponse){
            $user = new User($reponse);
            return $user;
        }else{
            return false;
        }
    }

    public static function getUsers(){
        $utilisateurs = [];
        $sql = "SELECT * FROM users" ;
        $db = DbConnect::getInstance();
        $req = $db->prepare($sql);
        $req->execute();
        
        foreach($req as $values){
            $utilisateurs[] = new User($values);
        }
        
        return $utilisateurs;
    }

    public static function addUser(User $obj){
        $db = DbConnect::getInstance();
        $sql = "INSERT INTO users (login, password, role) VALUES (:login, :password, :role)";
        $req = $db->prepare($sql);
        $req->bindValue(':login', $obj->getLogin(), PDO::PARAM_STR);
        $req->bindValue(':password', $obj->getPassword(), PDO::PARAM_STR);
        $req->bindValue(':role', $obj->getRole(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function updateUser(User $obj){
        $db = DbConnect::getInstance();

        $sql = "UPDATE users SET login=:login, password=:password WHERE id_user=:id_user";
        $req = $db->prepare($sql);
        $req->bindValue(':id_user', $obj->getId_user(), PDO::PARAM_INT);
        $req->bindValue(':login', $obj->getLogin(), PDO::PARAM_STR);
        $req->bindValue(':password', $obj->getPassword(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function deleteUser($id_user){
        $db = DbConnect::getInstance();
        $sql = "DELETE FROM users WHERE id_user = :id_user";
        $req = $db->prepare($sql);
        $req->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
    }

}
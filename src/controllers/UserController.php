<?php

namespace App\controllers;

use Twig\Environment;
use App\entities\User;
use App\models\UserManager;
use Twig\Loader\FilesystemLoader;


class UserController {
    private $twig;

    public function __construct() {
        $loader = new FilesystemLoader('templates');
        $this->twig = new Environment($loader);
    }

    public function connexion(){
        if(!empty($_POST['login'])&&!empty($_POST['password'])){
            $login=$_POST['login'];
            $user = UserManager::getUser($login);
        // si l'utilisateur existe
            if($user){
        // on vérifie le mot de passe saisi
                $password=$_POST['password'];
                $password_hash=$user->getPassword();
                if(password_verify($password, $password_hash)){
                    $_SESSION['user']=$user->getRole();
                    header('location: admin/artistes');
        // si une condition n'est pas bonne, on affiche un message d'erreur
                }else{
                    $message="Identifiants invalides";
                    echo $this->twig->render('admin/connexion.html.twig',['message'=>$message]);
                }
            }else{
                $message="Identifiants invalides";
                echo $this->twig->render('admin/connexion.html.twig',['message'=>$message]);
            }
        }else{
            $message="Identifiants invalides";
            echo $this->twig->render('admin/connexion.html.twig',['message'=>$message]);
        }
    }

    public function deconnexion(){
        unset($_SESSION['user']);
        header("location: ?controller=pages&action=index");
    }

    public function create(){
        $champs = ['login','role'];
        foreach($champs as $valeur){
            if (isset($_POST[$valeur])){
                ${$valeur} = !empty($_POST[$valeur]) ? $_POST[$valeur] : NULL;
            }else{
                ${$valeur} = NULL;
            }
        }

        // on cherche si le login est déjà présent dans la bd
        $userExist = UserManager :: getUser($login);

        if ($userExist){
            $message="Login déjà existant";
            $session=isset($_SESSION['user'])?$_SESSION['user']:NULL;
            $utilisateurs= UserManager :: getUsers();
            echo $this->twig->render('admin/utilisateurs/utilisateurs.html.twig',[
                'utilisateurs'=>$utilisateurs,
                'session'=>$session,
                'error'=>$message
            ]);
        }else{
            $password=password_hash($_POST['password'], PASSWORD_BCRYPT);

            $user = new User();
            $user->setLogin($login)
                    ->setPassword($password)
                    ->setRole($role);
    
            UserManager :: addUser($user);
    
            header("location: admin/utilisateurs");
        }
    }

    public function update(){
        $id_user=$_POST['id_user'];
        $login = !empty($_POST['login']) ? $_POST['login'] : NULL;
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : NULL;

        $user = new User();
        $user->setId_user($id_user)
                ->setLogin($login)
                ->setPassword($password);

        UserManager :: updateUser($user);

        header("location: admin/utilisateurs");
    }

    public function delete(){
        $id_user=$_GET['id_user'];

        UserManager :: deleteUser($id_user);

        header("location: admin/utilisateurs");
    }

}
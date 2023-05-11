<?php
namespace App\controller;

use App\model\User;

require("../autoloader.php");

class UserController{

    //je crée la fonction all qui sera appelé par le routeur
    public static function All(){
       //j'appel la fonction static findall de la class user qui renvois tout les users de la bdd
       //j'enregistre mes user dans la variable $users
       $users = User::findAll();
       //j'appel la vue read all user
       //la variable $users dans le foreach est égale à la variable $users qui recupere le findall
       require("../View/admin/readAllUser.php");

    }

    //je crée la fonction findbyid qui sera appelé par le routeur et qui prend en paramétre l'id reçu par le routeur
    public static function findById($id_user){
         //j'appel la fonction static findById de la class user qui renvois un utilisateur selon l'id reçu
       //j'enregistre mon user dans la variable $user
       $user= User::findById($id_user);
       //j'appel la vue read user
       //la variable $user dans la vue est égale à la variable $users qui recupere le findById
       
       require("../View/admin/readUser.php");

    }

    //je crée la fonction insert qui sera appelé par le routeur et qui prend en paramétre le formulaire  reçu par le routeur
    public static function insert($post){
        //je crée un objet User, en envoyant chaque valeur du form dans le constructeur
        $user = new User($post["lastname"],$post["firstname"],$post["email"],$post["password"],$post["birthday"],false);
    
        //j'appelle la méthode create de l'objet user qui enverra en base de données les valeur reçu du form
        $user->create();
        //j'appelle la fonction static all qui se trouve dans UserController
        //pour pouvoir revenir dans la vue readAllUser
        self::All();
    }
    //je crée la fonction delete qui sera appelé par le routeur et et qui prend en paramétre l'id reçu par le routeur
    public static function delete($id_user){
         //j'appel la fonction static delete de la class user qui supprime un utilisateur selon l'id reçu
       $delete= User::delete($id_user);
       //j'appelle la fonction static all qui se trouve dans UserController
       //pour pouvoir revenir dans la vue readAllUser
       self::All();
    }

    //je crée la fonction formupdate qui sera appelé par le routeur et et qui prend en paramétre l'id reçu par le routeur
    public static function formUpdate($id_user){
        //j'appel la fonction static findById de la class user qui renvois un utilisateur selon l'id reçu
       //j'enregistre mon user dans la variable $user
        $user= User::findById($id_user);
          //j'appel la vue formUpdate 
       //la variable $user dans la vue est égale à la variable $user qui recupere le findById
       
        require("../View/admin/formUpdate.php");
    }

    //je crée la fonction update qui sera appelé par le routeur et qui prend en paramétre le formulaire  reçu par le routeur
    public static function update($post){
         //je crée un objet User, en envoyant chaque valeur du form dans le constructeur
        $user = new User($post["lastname"],$post["firstname"],$post["email"],$post["password"],$post["birthday"],false);
        //j'appelle la méthode create de l'objet user qui modifira en base de données les valeur reçu du form
        //selon l'id_user reçu
        $user->update($post["id_user"]);

         //j'appelle la fonction static all qui se trouve dans UserController
       //pour pouvoir revenir dans la vue readAllUser
        self::all();

         //j'appelle la fonction static findById qui se trouve dans UserController
       //pour pouvoir revenir dans la vue readuser
       // self::findById($post["id_user"])
    }
        
    //je crée la fonction register qui sera appelé par le routeur et qui prend en paramétre le formulaire  reçu par le routeur
    public static function register($post){
        //je crée un tableau vide qui prendra en compte mes erreurs
        $erreurs = [];
        //je déclare mes variables et les inities à null pour les valeurs qui peuvent être null
        $lastname = null;
        $firstname = null;
        //je verifie que les champs qui sont obligatoires ne sont pas vide
        if(empty($post["email"]) || empty($post["password"]) || empty($post["birthday"])){
            //si ils sont vides j'ajoute une erreur au tableau erreurs
            $erreurs += ["incomplet" => "veuillez completer le formulaire correctement"];
        }

        //si lastname n'est pas vide 
        if(!empty($post["lastname"])){
            //j'enléve les eventuels balise reçu du formulaire
            $lastname = strip_tags($post["lastname"]);
        }
        //si firstname n'est pas vide 
        if(!empty($post["firstname"])){
            //j'enléve les eventuels balise reçu du formulaire
            $firstname = strip_tags($post["firstname"]);
        }
        //je hash le mot de passe reçu du formulaire
        $password = password_hash($post["password"], PASSWORD_ARGON2ID);

        //je verifie que le format du mail est valide
        $email = filter_var($post["email"], FILTER_VALIDATE_EMAIL);
        //si le format du mail est faux on remplie le tableau d'erreur
        if($email == false){
            $erreurs += ["emailI" => "Format email invalide"];
        }
        //on verifie si l'email existe
        $check = User::findByEmail($email);
        //si il existe deja on remplie le tableau d'erreur
        if($check != false){
            $erreurs += ["emailE" => "Ce mail existe deja"];
        }

        //si mon tableau d'erreur est vide
        if(empty($erreurs)){
            
            //je crée un objet User, en envoyant chaque valeur du form dans le constructeur
            $user = new User($lastname,$firstname,$email,$password,$post["birthday"],false);
            //j'appelle la méthode create de l'objet user qui enverra en base de données les valeur reçu du form
            $user->create();
            //je renvois vers la page login
            header("Location: ../View/public/login.php");
        //sinon
        }else{
            //j'appelle la vue register avec les erreurs
            require("../View/public/register.php");
        }
       

        
    }
    //je crée la fonction login qui sera appelé par le routeur et qui prend en paramétre le formulaire  reçu par le routeur
    public static function login($post){
         //je crée un tableau vide qui prendra en compte mes erreurs
         $erreurs = [];
          //je verifie que les champs qui sont obligatoires ne sont pas vide
        if(empty($post["email"]) || empty($post["password"]) ){
            //si ils sont vides j'ajoute une erreur au tableau erreurs
            $erreurs += ["incomplet" => "veuillez completer le formulaire correctement"];
        }
        //je verifie que le format du mail est valide
        $email = filter_var($post["email"], FILTER_VALIDATE_EMAIL);
        //si le format du mail est faux on remplie le tableau d'erreur
        if($email == false){
            $erreurs += ["emailI" => "Format email invalide"];
        }
        //on verifie si l'email existe
        $user = User::findByEmail($email);
        //si il n'existe pas alors on remplie le tableau d'erreur
        if ($user == false) {
            $erreurs += ["emailE" => "ce compte n'existe pas"];
        }
        //on verifie que le mot de passe reçu du form ($post["password"]) correspond au mot de passe reçu de la bdd ($user["password"])
        if(password_verify($post["password"], $user["password"]) == true){
            //on démarre la session pour pouvoir utiliser le tableau $_SESSION
             session_start();
             //je crée une clé lastname dans le tableau $_SESSION qui a comme valeur le lastname du user reçu en bdd
             $_SESSION["lastname"] = $user["lastname"];
            //je crée une clé role dans le tableau $_SESSION qui a comme valeur admin du user reçu en bdd
             $_SESSION["role"]= $user["admin"];
            //j'appelle la vue profil.php
             require("../View/public/profil.php");
        }

    }
}
<?php


use App\controller\UserController;
require_once("../autoloader.php");
//je verifie que je reçois le param action dans l'url donc en get
if($_GET["action"]){
    //si le param action est égal à all
    if($_GET["action"] == "all"){
        //alors j'appelle la fonction static all de Usercontroller
        UserController::All();
        
    }//si le param action est égal à create
    elseif($_GET["action"] == "create"){
        //alors j'appelle la fonction static insert de Usercontroller en passant le form reçu dans $_POST
        UserController::insert($_POST);
        
    }//si le param action est égal à read
    elseif($_GET["action"] == "read"){
    //alors j'appelle la fonction static findById de Usercontroller en passant le id user reçu en get dans l'url
            UserController::findById($_GET["id_user"]);
    }//si le param action est égal à delete
    elseif($_GET["action"] == "delete"){
        //alors j'appelle la fonction static delete de Usercontroller en passant le id user reçu en get dans l'url
        UserController::delete($_GET["id_user"]);
    }//si le param action est égal à formupdate
    elseif($_GET["action"] == "formUpdate"){
    //alors j'appelle la fonction static formUpdate de Usercontroller en passant le id user reçu en get dans l'url
        UserController::formUpdate($_GET["id_user"]);
    }//si le param action est égal à update
    elseif($_GET["action"] == "update"){
    //alors j'appelle la fonction static update de Usercontroller en passant le form reçu dans $_POST
        UserController::update($_POST);
    }//si le param action est égal à register
    elseif($_GET["action"] == "register"){
    //alors j'appelle la fonction static register de Usercontroller en passant le form reçu dans $_POST
        UserController::register($_POST);
    }//si le param action est égal à login
    elseif($_GET["action"] == "login"){
    //alors j'appelle la fonction static login de Usercontroller en passant le form reçu dans $_POST
        UserController::login($_POST);
    }
}
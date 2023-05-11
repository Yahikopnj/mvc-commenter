<?php
//ici je dis que je suis dans mon app dans model
namespace App\model;

//on indique qu'on va utiliser la class PDO
use \PDO;
//je crée ma class DB
class DB{

    //host ici on est en local
    private $host="localhost";
    //la nom de la base de donnée
    private $dbname="blog";
    //le numero du port de ma base de donnée
    private $port="3306";
    //l'attribut qui va contenir ma relation avec la bdd
    private $dbh;

    //quand j'instancie la class db 
    function __construct()
    {  //je crée le dsn
        $dsn= "mysql:host=".$this->host.";dbname=".$this->dbname.";port=".$this->port.";charset=UTF8";
        //je lance ma connexion à la bdd
        $this->dbh= new PDO($dsn, "root", "");
       
        
    }

    //method get (getter) pour récuper l'attribut dbh qui contient ma connexion à la bdd
    public function getDbh(){
        return $this->dbh;
    }
}


?>
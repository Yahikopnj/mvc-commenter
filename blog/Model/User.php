<?php

namespace App\model;
//je vais utiliser la class DB
use App\model\DB;
//pour utiliser l'exception pdo
use \PDOException;

//l'autoloader requi le bon fichier
require("../autoloader.php");
class User{

    private $lastname;
    private $firstname;
    private $email;
    private $password;
    private $birthday;
    private $admin;

    //fonction constructeur qui se lance quand on instancie la class
    function __construct($lastname, $firstname,$email, $password, $birthday, $admin)
    {

        //lastname de la class prend la valeur du lastname passé en paramétre du contructeur
        $this->lastname = $lastname;
        //firstname de la class prend la valeur du firstname passé en paramétre du contructeur
        $this->firstname = $firstname;
        //email de la class prend la valeur du email passé en paramétre du contructeur
        $this->email = $email;
        //password de la class prend la valeur du password passé en paramétre du contructeur
        $this->password = $password;
        //birthday de la class prend la valeur du birthday passé en paramétre du contructeur
        $this->birthday = $birthday;
        //admin de la class prend la valeur du admin passé en paramétre du contructeur
        $this->admin = $admin;

    }

    //les getters renvois la valeur un attribut avec possibilité de modifier la valeur avant le return

    //les setters permette de modifier ou donner une valeur à un attribut avec la possibilité de modifier la valeur reçu


    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of birthday
     */ 
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @return  self
     */ 
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of admin
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */ 
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }



    public static function findAll()
    {
        try {

            //j'instancie ma class DB ce qui lance sa fonction construc
            $db = new DB();

            //je récupere la valeur de l'attribut dbh de la class db qui s'est connecté à la bdd
            $dbh = $db->getDbh();
            //j'utilise la methode query de pdo qui permet d'executer directement la requete sql qu'on lui passe
            $stmt = $dbh->query(" SELECT * FROM `user`");

            //je retourne tout les utilisateurs de la bdd dans un tableau associatif
            return $stmt->fetchAll();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }



    public static function findById($id_user)
    {
        try {

            //j'instancie ma class DB ce qui lance sa fonction construc
            $db = new DB();

            //je récupere la valeur de l'attribut dbh de la class db qui s'est connecté à la bdd
            $dbh = $db->getDbh();
            //je prepare ma requete sql pour inserer une valeur par la suite
            $stmt = $dbh->prepare("SELECT * FROM user WHERE id_user=?");
            //je remplace via bindvalue le ? dans la requete par la valeur de la variable $id_user
            $stmt->bindValue(1, $id_user);
            //j'execute ma requete
            $stmt->execute();
            //je retounrne l'utilisateur trouvé par ma requete
            return $stmt->fetch();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }


    public static function delete($id_user)
    {
        try {


            //j'instancie ma class DB ce qui lance sa fonction construc
            $db = new DB();

            //je récupere la valeur de l'attribut dbh de la class db qui s'est connecté à la bdd
            $dbh = $db->getDbh();
            //je prepare ma requete sql pour inserer une valeur par la suite
            $stmt = $dbh->prepare("DELETE FROM user WHERE id_user=?");
            //je remplace via bindvalue le ? dans la requete par la valeur de la variable $id_user reçu en parametre
            $stmt->bindValue(1, $id_user);
            //j'execute ma requete qui renverra true si ça fonctionne sinon ce sera false

            return $stmt->execute();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }


    public function create()
    {
        try {


            //j'instancie ma class DB ce qui lance sa fonction construc
            $db = new DB();

            //je récupere la valeur de l'attribut dbh de la class db qui s'est connecté à la bdd
            $dbh = $db->getDbh();
            //je prepare ma requete sql pour inserer les valeurs par la suite

            $stmt = $dbh->prepare("INSERT INTO `user` (`lastname`,`firstname`,`email`,`password`,`birthday`,`admin`) 
            VALUES (?,?,?,?,?,?)");

            //comme ma methode n'est pas static je peux utiliser les attribut de la class
            //qui recevrons une valeur quand on creera un objet user via le constructeur

            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut lastname
            $stmt->bindValue(1, $this->lastname);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut firstname
            $stmt->bindValue(2, $this->firstname);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut email
            $stmt->bindValue(3, $this->email);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut password
            $stmt->bindValue(4, $this->password);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut birthday
            $stmt->bindValue(5, $this->birthday);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut admin
            $stmt->bindValue(6, $this->admin);

            //j'execute ma requete qui renverra true si ça fonctionne sinon ce sera false
            return $stmt->execute();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }



    public function update($id_user)
    {
        try {

            //j'instancie ma class DB ce qui lance sa fonction construc
            $db = new DB();

            //je récupere la valeur de l'attribut dbh de la class db qui s'est connecté à la bdd
            $dbh = $db->getDbh();
            //je prepare ma requete sql pour inserer les valeurs par la suite

            $stmt = $dbh->prepare(" UPDATE user SET `lastname`=?, `firstname`=?, 
            `email`=?, `password`=?, `birthday`=? WHERE id_user=?");

            //comme ma methode n'est pas static je peux utiliser les attribut de la class
            //qui recevrons une valeur quand on creera un objet user via le constructeur

            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut lastname
            $stmt->bindValue(1, $this->lastname);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut firstname
            $stmt->bindValue(2, $this->firstname);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut email
            $stmt->bindValue(3, $this->email);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut password
            $stmt->bindValue(4, $this->password);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut birthday
            $stmt->bindValue(5, $this->birthday);
            //je remplace via bindvalue le ? dans la requete par la valeur de l'attribut admin
            $stmt->bindValue(6, $this->admin);
            //je remplace via bindvalue le ? dans la requete par la valeur de la variable $id_user reçu en parametre
            $stmt->bindValue(7, $id_user);
            //j'execute ma requete qui renverra true si ça fonctionne sinon ce sera false
            return $stmt->execute();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }

   
    public static function findByEmail($email){
        try{
            //j'instancie ma class DB ce qui lance sa fonction construc
            $db = new DB();

            //je récupere la valeur de l'attribut dbh de la class db qui s'est connecté à la bdd
            $dbh = $db->getDbh();
            //je prepare ma requete sql pour inserer les valeurs par la suite
            $stmt = $dbh->prepare("SELECT * FROM user WHERE email=?");
            //je remplace via bindvalue le ? dans la requete par la valeur de la variable $emaile reçu en parametre
            $stmt->bindValue(1, $email);

            //j'execute ma requete
            $stmt->execute();
            //je retounrne l'utilisateur trouvé par ma requete
            return $stmt->fetch();
            
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }
}



?>
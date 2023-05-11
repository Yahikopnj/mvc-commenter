<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //je compare le role du user enregistré dans la session au moment du login dans le controller

    //si il est égale à false il n'aura accès qu'à l'accueil 
    if($_SESSION["role"] == 0): ?>

        <a href="../../index.php">accueil</a>

    <?php
     //si il est égale à true il peut avoir accès au dashboard
     elseif($_SESSION["role"] == 1): ?>

        <a href="../../Controller/Router.php?action=all">voir les utilisateurs</a>

    <?php endif; ?>
    
</body>
</html>
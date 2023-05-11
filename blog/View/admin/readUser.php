<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <ul>
            <li><?= $user["lastname"]?></li>
            <li><?= $user["firstname"]?></li>
            <li><?= $user["email"]?></li>
            <li><?= $user["birthday"]?></li>
            <li><?= $user["password"]?></li>
        </ul>
        <a href="../Controller/Router.php?action=read&id_user=<?=$user["id_user"]?>">Voir details</a>
        <a href="../Controller/Router.php?action=formUpdate&id_user=<?=$user["id_user"]?>">Modif</a>
        <a href="../Controller/Router.php?action=delete&id_user=<?=$user["id_user"]?>">Supprimer</a>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../Controller/Router.php?action=update" method="post">
        <input type="hidden" name="id_user" id="id_user" value="<?= $user["id_user"]; ?>">

        <div class="divForm">
            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname" value="<?= $user["lastname"]; ?>">
        </div>

        <div class="divForm">
            <label for="firstname">firstname</label>
            <input type="text" name="firstname" id="firstname" value="<?= $user["firstname"]; ?>">
        </div>

        <div class="divForm">
            <label for="email">e-mail</label>
            <input type="email" name="email" id="email" required value="<?= $user["email"]; ?>">
        </div>

        <div class="divForm">
            <label for="password">password</label>
            <input type="password" name="password" id="password" required value="<?= $user["password"]; ?>">
        </div>

        <div class="divForm">
            <label for="birthday">age</label>
            <input type="number" name="birthday" id="birthday" required value="<?= $user["birthday"]; ?>">
        </div>

        <div class="divForm">
            <input type="submit" name="submit" value="Modifier">
        </div>
    </form>
</body>

</html>
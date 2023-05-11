<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../Controller/Router.php?action=create" method="post">


        <div class="divForm">
            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname">
        </div>

        <div class="divForm">
            <label for="firstname">firstname</label>
            <input type="text" name="firstname" id="firstname">
        </div>

        <div class="divForm">
            <label for="email">e-mail</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="divForm">
            <label for="password">password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="divForm">
            <label for="birthday">age</label>
            <input type="number" name="birthday" id="birthday" required>
        </div>

       
        <div class="divForm">
            <input type="submit" name="submit" value="Envoyer">
        </div>

        

    </form>
</body>

</html>
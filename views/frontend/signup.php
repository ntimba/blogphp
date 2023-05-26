<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="errors">

    <?php 
        foreach( $this->getErrors() as $error ) {
            echo $error . '<br>';
        }
    ?>

    </div>

    <form action="?action=signup" method="post">
        <input type="text" name="firstname" placeholder="Prénom"> <br>
        <input type="text" name="lastname" placeholder="Nom de famille"> <br>
        <input type="email" name="email" placeholder="Email"> <br>
        <input type="password" name="password" placeholder="Mot de passe"> <br>
        <input type="password" name="repeat_password" placeholder="Répéter le mot de passe"> <br>
        <button type="submit" name="submit">S'enregistrer</button> <br>
    </form>
</body>
</html>


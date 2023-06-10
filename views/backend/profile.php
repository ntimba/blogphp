<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <div class="center">
    <!-- Afficher si un compte est activé ou pas -->
    <!-- Afficher si un compte n'est pas vérifié -->
        <form action="?action=updateprofile" method="POST" enctype="multipart/form-data">
            <img src="" alt=""> <br>
            
            <!-- <a href="">Modifier l'adresse mail</a> <br> -->
            <!-- <a href="">Modifier le mot de passe</a> <br><br> -->

            <input name="profile_image" type="file" placeholder="Nom d'utilisateur" ><br>
    
            <!-- <input name="username" type="text" value="" placeholder="Nom d'utilisateur" readonly><br> -->
            <input name="firstname" type="text" value="<?= $userDetails['firstname']; ?>" placeholder="Prénom" ><br>
            <input name="lastname" type="text" value="<?= $userDetails['lastname']; ?>" placeholder="Nom de famille" ><br>
    
            <input name="email" type="text" value="<?= $userDetails['email']; ?>" placeholder="Adresse e-mail" ><br>

            <!-- Modifier le mot de passe -->
            <input name="old_password" type="password" value="" placeholder="Ancien mot de passe" ><br>
            <input name="new_password" type="password" value="" placeholder="Nouveau mot de passe" ><br>
            <input name="repeat_new_password" type="password" value="" placeholder="Repeter le Nouveau mot de passe" ><br>

            <textarea name="biography" id="" cols="30" rows="10"><?= $userDetails['biography']; ?></textarea> <br>
            <button type="submit">Mettre à jour mon profile</button>
        </form>

    </div>
</body>
</html>



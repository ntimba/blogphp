<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article </title>
</head>
<body>

    <div class="center">

        <!-- Afficher l'article -->
        <h1><?= $post->getTitle(); ?></h1> <br>
        <p>Date : <?= $post->getCreationDate(); ?> </p> 
        <p>Dernier mis à jour : <?= "à définir" ?></p> 
        <p>La catégorie : <?= $category->getName(); ?> </p>
        <p>Écrit par : <?= $user->getFirstname() . " " . $user->getLastname(); ?></p>
        <p><img src="<?= $post->getFeaturedImagePath(); ?>" alt=""></p>
        <p> <?= $post->getContent(); ?></p> <br>

        <!-- Afficher les commentaires -->
        <div class="comment">
            <form action="#" method="POST">
                <textarea name="post_comment" id="" cols="40" rows="4"></textarea> <br>
                <button type="submit" name="submit">Commenter</button>
            </form>

            <div class="list-comments">

            </div>
            
        </div>

    </div>
    
</body>
</html>


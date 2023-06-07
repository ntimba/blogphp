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
            <form action="?action=addcomment" method="POST">
                <textarea name="post_comment" id="" cols="40" rows="4"></textarea> <br>
                <input type="text" name="post_id" value="<?= $post->getId(); ?>" hidden>
                <button type="submit" name="submit">Commenter</button>
            </form>

            <br><br>
            <div class="list-comments">
            <?php foreach($allComments as $comment): ?>
                <div class="comment">
                    <img src="<?= $comment['userProfilePicture']; ?>" alt="#">
                    <div class="name">
                        <?= $comment['firstname'] . ' ' .$comment['lastname']; ?>
                    </div>
                    <div class="comment_content">
                        <?= $comment['commentContent']; ?>
                    </div>
                </div>
            <?php endforeach; ?>  

            </div>
            
        </div>

    </div>
    
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un article</title>
</head>
<body>
    <div class="center">

        <div class="errors">
            <!-- Affiche les messages d'erreurs -->
        </div>
        
        <!-- ajouter l'élément pour envoyer les fichiers  -->
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="post_title">Titre de l'article:</label> <br>
        <input type="text" id="post_title" name="post_title" placeholder="Titre de l'article"> <br><br>
        
        <label for="post_content">Contenu de l'article:</label> <br>
        <textarea id="post_content" name="post_content" cols="30" rows="10"></textarea> <br>
        
        <label for="featured_image">Image mise en avant:</label> <br>
        <input type="file" id="featured_image" name="featured_image"> <br><br>
        
        <label for="post_category_id">Catégorie</label> <br>
        <select name="post_category_id" id="post_category_id">                
            <?php foreach($categories as $category): ?>
                <option value="<?= $category->getId() ?>"><?= $stringUtil->capitalLetter( $category->getName() ) ?></option>
            <?php endforeach; ?>
        </select> <br><br>

        <a href="?action=addcategory">Ajouter une catégorie</a> <br><br>
        
        <button type="submit">Publier l'article</button>
    </form>

        
    </div>
</body>
</html>



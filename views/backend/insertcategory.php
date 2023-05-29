<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new category</title>
</head>
<body>
    <div class="center">
        <form action="" method="POST">
            <label for="category_name">Nom de la catégorie</label><br>
            <input id="category_name" type="text" name="category_name" placeholder="nom de la category"> <br><br>

            <label for="category_description">Description de la catégorie</label> <br>
            <textarea id="category_description" name="category_description" id="category_description" cols="30" rows="10"></textarea> <br><br>

            <label for="category_parent_id">Choisissez une catégorie parent</label><br>
            <select name="category_parent_id" id="category_parent_id">
                <option value="">Pas de catégorie parent</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category->getId() ?>"><?= $stringUtil->capitalLetter( $category->getName() ) ?></option>
                <?php endforeach; ?>
            </select> <br><br>

            
            

            <button type="submit" name="submit" >Enregistrer</button> <br><br>

        </form>
    </div>
</body>
</html>


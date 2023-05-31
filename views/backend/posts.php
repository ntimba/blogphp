<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, tr,td,th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="center">

        <h1>Articles</h1>
        
        <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Catégorie</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <?php foreach($posts as $post): ?>
            <tr>
                <td><?= $post->getTitle(); ?></td>
                <td><?= $post->getUserId(); ?></td>
                <td><?= $post->getCategoryId(); ?></td>
                <td><?= $post->getCreationDate(); ?></td>
                <td> <a href="?action=toupdate&id=<?= $post->getId(); ?>">Modifier</a> <a href="?action=delete&id=<?= $post->getId(); ?>">Supprimer</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>



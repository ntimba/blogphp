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

        <h1>Commentaires</h1>
        
        <table>
            <tr>
                <th>Auteur</th>
                <th>Titre Article</th>
                <th>Commentaire</th>
                <th>date</th>
                <th>Vérifié</th>                
            </tr>
            <?php foreach($comments as $comment): ?>
            <tr>
                <td><?= $comment->getUserId(); ?></td>
                <td><?= $comment->getPostId(); ?></td>
                <td><?= $comment->getContent(); ?></td>
                <td><?= $comment->getCommentedDate(); ?></td>
                <td><?= $comment->getCommentVerify(); ?></td>
                <td> <a href="?action=verifycomment&id=<?= $comment->getId(); ?>">Vérifier</a> <a href="?action=delete&id=<?= $comment->getId(); ?>">Supprimer</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>



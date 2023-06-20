<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
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

        <h1>Utilisateurs</h1>
        
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>membre depuis</th>
                <th>Statut</th>
                <th>Actions</th>                
            </tr>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user->getFirstname(); ?></td>
                <td><?= $user->getLastname(); ?></td>
                <td><?= $user->getEmail(); ?></td>
                <td><?= $user->getRegistrationDate(); ?></td>
                <td><?= $user->getStatut(); ?></td>
                <td> <a href="?action=activateuser&id=<?= $user->getId(); ?>">Activer</a> <a href="?action=restrictuser&id=<?= $user->getId(); ?>">Restreindre</a> <a href="?action=deleteuser&id=<?= $user->getId(); ?>">Supprimer</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>



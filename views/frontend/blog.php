<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 300px;
        }
    </style>
</head>
<body>
    <div class="center">
        <h1>Blog Ntimba</h1>

        <div class="posts">
        <!-- $posts -->
            <?php foreach($posts as $post): ?>
            
            <div class="post">
                <div class="img">
                    <img src="<?= $post->getFeaturedImagePath(); ?>" alt="">
                </div>

                <h2><?= $post->getTitle(); ?></h2>
                <p>
                    <?= $post->getContent(); ?>
                </p>
                <a href="?action=post&id=<?= $post->getId(); ?>">Lire la suite</a>
            </div>
            <?php endforeach; ?>


        </div>
    </div>
</body>
</html>


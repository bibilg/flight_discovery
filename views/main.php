<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/reset.css" />
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <title>My first API</title>
</head>
<body>

    <?php
        foreach($books as $book){
    ?>

        <h1> <?= $book->title?> </h1>
            <img src="<?= $book->cover?>" alt="<?= $book->slug?>" /> 

            
            <h2> Ecrit par :</h2>
                <p><?= $book->author?> </p>
            <h2>Année de parution :</h2>
                <p><?= $book->year?> </p>

    <?php
    }
    ?>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bonjour</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>


<?php

    $message = "

    <p>
    <br /><br />
        Bienvenue l'application<br /><br />
        
        Voici l'accueil, pour afficher une liste publique cliquer sur 'Affichage' sinon créez une liste en cliquant sur 'XXX'.<br /><br />
        
        Une fois la liste créée vous pouvez partager le lien 'XXX' pour que ces derniers puissent réserver des items.<br /><br />
        
        Connectez-vous en cliquant sur 'Espace personnel' pour retrouver plus facilement vos listes.
    </p>";


?>

<p>
    <?php echo $message; ?>
</p>

</body>
</html>

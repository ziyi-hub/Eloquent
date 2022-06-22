<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>compteur</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>

<?php

session_start();

$count = 0;

if(!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;
}else{
    $_SESSION['count']++;
}

echo "<strong>Le nombre de requêtes vers ce fichier est : <strong>".$_SESSION['count'].
    "<br >" ."<a href='resetCompteur.php'>Cliquez ici pour réinitialiser le compteur</a>";

?>


</body>
</html>

<!--<a href='compteur.php'>Retourner à la page précédente</a>-->

<?php

session_start();

if(isset($_SESSION['count'])){
    unset($_SESSION['count']);
}

header("Location:compteur.php");
exit;
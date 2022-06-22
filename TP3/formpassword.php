<?php
session_start();


if ($_SESSION['profile']['login'] ?? ''){
    $html = <<<END
<h1>Changer le mot de passe</h1>
<form method="post" action="changepassword.php" >
    <div class="div-bor">
        <input type="password" name="mdp" id="mdp" placeholder="Nouveau mot de passe" required><br>
    </div>
    <div class="div-bor">
        <input type="password" name="cmdp" id="cmdp" placeholder="Confirmer le nouveau mot de passe" required><br>
    </div>
    <button type="submit" class="but" id="submit">Modifier</button>
	<a href='welcome.php'>Retourne à l'accueil</a>
</form>
<div class="message">
END;


    if (isset($_SESSION['messageFormPass']) && !empty($_SESSION['messageFormPass'])) {
        echo $_SESSION['messageFormPass'];
    }

    $html .= <<< END
</div>
END;

    echo $html;

}else{
    header("Location:signin.php");
}
?>
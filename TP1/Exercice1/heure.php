<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>heure</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
    <div class="card mt-4">
        <div class="card-body">
            <div id="login">
                <h2>Formulaire<h2>
                <form method="post" action="./heure.php" >
                    <div class="upload_container">
                        <input type="text" id="nom" name="nom" class="form-control" required="required" placeholder="Identifiant"><br>
                    </div>
                    <div class="upload_container">
                        <input type="password" id="mdp" name="mdp" class="form-control" required="required" placeholder="Mot de passe"><br>
                    </div>
                    <div class="upload_container">
                        <input type="text" id="commentaire" name="commentaire" class="form-control" required="required" placeholder="Contenu du commentaire"><br>
                    </div>
                    <button class="btn btn-lg btn-success" type="submit" style="width: 313px">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

<?php

if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    $commentaire = $_POST['commentaire'];
    ?>

    <p>
    <h5>Bienvenue  <?php echo $nom; ?><br />
        votre mot de passe est : <?php echo $mdp; ?>  <br />
        <em>Contenu du commentaire : <?php echo $commentaire; ?> </em>
    </h5>
    </p>

    <?php
}else{
    echo "<h5>Veuillez remplir le formulaire! <h5>";
    $nom = null;
    $age = null;
    $commentaire = null;
}
?>

</body>
</html>


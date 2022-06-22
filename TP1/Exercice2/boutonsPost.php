<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>formulaireBonjour</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card mt-4">
        <div class="card-body">
            <div id="login">
                <h2>Formulaire<h2>
                <form method="post" action="./boutonsPost.php?nb=<?php echo $_POST['nb'];?>">
                    <div class="upload_container">
                        <input type="text" id="nb" name="nb" class="form-control" required="required" placeholder="nombre"><br>
                    </div>
                    <button class="btn btn-lg btn-success" type="submit" style="width: 313px">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php


if (isset($_POST['nb']) && $_POST['nb']>0) {

    for ($i = 0; $i < $_POST['nb']; $i++) {
        echo "<button type='submit' name='$i'>$i</button>";
    }
}









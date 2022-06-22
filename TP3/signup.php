<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign up</title>
	</head>
	<body>
		<h1>Sign up</h1>
		<form method="POST" action="adduser.php">
            <div class="upload_container">
                <input type="text" id="nom" name="login" class="form-control" required="required" placeholder="Nom d'utilisateur"><br>
            </div>
            <div class="upload_container">
                <input type="password" id="mdp" name="password" class="form-control" required="required" placeholder="Mot de passe"><br>
            </div>
            <div class="upload_container">
                <input type="password" id="mdp2" name="password2" class="form-control" required="required" placeholder="Confirmer le mot de passe"><br>
            </div>
			<input type="submit" class="btn btn-lg btn-success" value="Inscription">
            <a href='signin.php'> Sign in </a>
		</form>
        <div class="message">
            <?php

            session_start();

            if (isset($_SESSION['messageAdd']) && !empty($_SESSION['messageAdd'])){
                echo $_SESSION['messageAdd'];
            }
            ?>
        </div>
	</body>
</html>
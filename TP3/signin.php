<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign in</title>
	</head>
	<body>
		<h1>Sign in</h1>
		<form method="POST" action="authenticate.php">
            <div class="upload_container">
                <input type="text" id="nom" name="login" class="form-control" required="required" placeholder="Identifiant"><br>
            </div>
            <div class="upload_container">
                <input type="password" id="mdp" name="password" class="form-control" required="required" placeholder="Mot de passe"><br>
            </div>
			<input type="submit" class="btn btn-lg btn-success" value="Connect me">
            <a href='signup.php'> Sign up </a>
		</form>
        <div class="message">
            <?php

            session_start();

            if (isset($_SESSION['message']) && !empty($_SESSION['message'])){
                echo $_SESSION['message'];
            }
            ?>
        </div>
	</body>
</html>






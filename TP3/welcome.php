<?php
	session_start();

	// Si la requête arrive avec un autre type que GET
	// ou que le client n'est pas considéré comme connecté,
    // renvoi vers le formulaire de connexion

	// sinon, on affiche la page de bienvenue

	if ($_SESSION['profile']['login'] ?? ''){
		$html = <<<END
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<title>My account</title>
			</head>
			<body>
					<h2><p>Bienvenue<p> 
		END;

		$html .= $_SESSION['profile']['login'];
		$html .=
			<<<END
					! <h2>
					<p>Welcome on your account.<p>	
					<a href='signout.php'>Déconnexion</a>
					<form method="GET" action="deleteuser.php" >
						<button type="submit" class="but" id="submit">Suppression d'utilisateur</button>
					</form>	
					<form method="GET" action="formpassword.php" >
						<button type="submit" class="but" id="submit">Changer le mot de passe</button>
					</form>	
			</body>
		</html>
	END;

	}else{
		header("Location:signin.php");
	}

	echo $html;
?>


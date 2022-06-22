<?php

session_start();

define("usrename","PWeb");
define("dsn", "mysql:host=localhost;dbname=PWeb");
define("password","1Zhongguo");

try {
    $dbh = new PDO(dsn,usrename, password);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


if ($_SESSION['profile']['login'] ?? '') {
    $html = <<< END
<h2>Suppression compte</h2>
<form method="POST" action="deleteuser.php" >
<input type="text" required="required" placeholder="IDUtilisateur" name="id" id="id">
<button class="but" type="submit">Valider</button>
</form>
END;

    if (isset($_POST['id'])) {
        $IDUtilisateur = htmlentities($_POST['id']);
        $reponse = $dbh->query("SELECT * FROM Users WHERE IDUtilisateur='$IDUtilisateur'")->fetch();
        $reponse2 = $dbh->query("SELECT * FROM Users WHERE IDUtilisateur='$IDUtilisateur'");

        if (!empty($reponse)){
            while ($donnees = $reponse2->fetch()){
                if (!empty($donnees['IDUtilisateur'])){
                    $reponse = $dbh->query("DELETE FROM Users WHERE IDUtilisateur='$IDUtilisateur'");
                    if(isset($_SESSION['profile']['id']))
                    {
                        session_unset();
                    }
                    $_SESSION['messageDele'] = "";
                    header("Location:signin.php");
                }
            }
        }else{
            $_SESSION['messageDele'] = "ID n’existe pas";
            header("Location:deleteuser.php");
        }
    }

    if (isset($_SESSION['messageDele'])) {
        $html.=$_SESSION['messageDele'];
    }

    echo $html;

}else{
    header("Location:signin.php");
}
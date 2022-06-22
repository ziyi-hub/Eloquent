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

if ( isset($_POST['login']) && isset($_POST['password']) )
{
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);

    $reponse = $dbh->query("select * from PWeb.Users where NomUtilisateur = '$login'")->fetch();
    $reponse2 = $dbh->query("select * from PWeb.Users where NomUtilisateur = '$login' and MotDePasse = '$password'")->fetch();

        if (!empty($reponse) && !empty($reponse2)){
            if(empty($_SESSION['profile'])){

                /**
                 * Il permet de faire la distinction entre le même nom d'utilisateur
                 */
                $_SESSION['profile'] = array(
                    'login'         => $login,
                    'mdp'        => $password,
                );
            }
            if(isset($_SESSION['message'])){
                unset($_SESSION['message']);
            }
            header("Location:welcome.php");
        }elseif (!empty($reponse) && empty($reponse2)){
            $_SESSION['message'] = "Le mot de passe est incorrect";
            header("Location:signin.php");
        }else{
            $_SESSION['message'] = "L'identifiant n’existe pas";
            header("Location:signin.php");
        }

}else{
    header("Location:signin.php");
}

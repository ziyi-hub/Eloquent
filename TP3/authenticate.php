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
    $reponse = $dbh->query("select * from PWeb.Users where NomUtilisateur = '$login'");
    $reponse2 = $dbh->query("select * from PWeb.Users where NomUtilisateur = '$login'")->fetch();

    if (!empty($reponse2)){
        while ($donnees = $reponse->fetch()){
            if (password_verify($password, $donnees['MotDePasse']) === true){
                if(empty($_SESSION['profile'])){

                    $_SESSION['profile'] = array(
                        'login'         => $login,
                        'mdp'        => $password,
                    );
                }
                $_SESSION['message'] = "";
                header("Location:welcome.php");
            }else{
                $_SESSION['message'] = "Le mot de passe est incorrect";
                header("Location:signin.php");
            }
        }
    }else{
        $_SESSION['message'] = "L'identifiant n’existe pas";
        header("Location:signin.php");
    }

}else{
    header("Location:signin.php");
}

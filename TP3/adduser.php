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

    if ( isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2']) ) {
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['password']);
        $password2 = htmlentities($_POST['password2']);

        if (($password === $password2) && (strpos($login, ' ') === false)){
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            $reponse = $dbh->query("INSERT INTO Users (IDUtilisateur, NomUtilisateur, MotDePasse) VALUES (null, '$login', '$hashpass')");
            $_SESSION['messageAdd'] = "";
            header("Location:signin.php");
        }elseif (($password !== $password2) && (strpos($login, ' ') === false)){
            $_SESSION['messageAdd'] = "Les deux mots de passe doivent être identiques";
            header("Location:signup.php");
        }else{
            $_SESSION['messageAdd'] = "Erreur inconnu";
            header("Location:signup.php");
        }
    }
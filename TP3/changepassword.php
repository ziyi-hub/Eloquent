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


    if ($_SESSION['profile']['login'] ?? ''){

        if ( isset($_POST['mdp']) && isset($_POST['cmdp']) ) {
            $mdp = htmlentities($_POST['mdp']);
            $cmdp = htmlentities($_POST['cmdp']);

            if ($mdp !== $cmdp){
                $_SESSION['messageFormPass'] = "Les deux mots de passe doivent être identiques";
                header("Location:formpassword.php");
            }else{
                $usr = $_SESSION['profile']['login'];
                $hashmdp = password_hash($mdp, PASSWORD_DEFAULT);
                $reponse = $dbh->query("UPDATE Users SET MotDePasse='$hashmdp' WHERE NomUtilisateur='$usr'");
                $_SESSION['messageFormPass'] = "";
                header("Location:welcome.php");
            }
        }else{
            header("Location:formpassword.php");
        }
    }else{
        header("Location:formpassword.php");
    }
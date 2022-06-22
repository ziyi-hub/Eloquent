<?php

    session_start();

    $array = include("users.php");

    if ( isset($_POST['login']) && isset($_POST['password']) )
    {
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['password']);

        if(array_key_exists($login, $array)){
            $pass = $array[$login];
            if ($pass === $password){
                if(empty($_SESSION['profile'])){

                    /**
                     * @login identifiant
                     * @mdp mot de passe
                     * Il permet de faire la distinction entre le même nom d'utilisateur
                     */
                    $_SESSION['profile'] = array(
                        'login'         => $login,
                        'mdp'        => $password,
                    );
                }

                /**
                 * il permet de initialiser le message
                 */
                if(isset($_SESSION['message'])){
                    unset($_SESSION['message']);
                }
                header("Location:welcome.php");
            }else{
                $_SESSION['message'] = "Le mot de passe est incorrect";
                header("Location:signin.php");
            }
        }else{
            $_SESSION['message'] = "L'identifiant n’existe pas";
            header("Location:signin.php");
        }
    }else{
        header("Location:signin.php");
    }



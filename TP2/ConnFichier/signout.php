<?php
    session_start();

    if(isset($_SESSION['message'])&&!is_null($_SESSION['message'])){
        unset($_SESSION['message']);
    }

    if(isset($_SESSION['profile'])&&!is_null($_SESSION['profile'])){
        unset($_SESSION['profile']);
    }

    header("Location:signin.php");

    exit;

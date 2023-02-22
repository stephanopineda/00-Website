<?php
    session_start();
    $_SESSION["email"] = NULL;
    $_SESSION["first_name"] = "Guest";
    $_SESSION["user_type"] = NULL;
    header('Location: index.php');
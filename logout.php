<?php
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION["email"] = NULL;
    $_SESSION["first_name"] = "Guest";
    $_SESSION["user_type"] = NULL;
    header('Location: index.php');
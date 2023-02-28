<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

// SKIP ADMIN PAGES
// USER REDIRECT
if (isset($_SESSION["user_type"])) {
    $first_name = $_SESSION["first_name"];
    
    if ($_SESSION["user_type"] === "user"){
        header('Location: ../index.php');
        exit;
    }
}
else {
    if(!isset($first_name)) {
        header('Location: ../index.php');
        exit;
        $first_name = "Guest";
    }
}

<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

// SKIP NON-SUPERADMIN PAGES
// ADMIN REDIRECT
if (isset($_SESSION["user_type"])) {
    $first_name = $_SESSION["first_name"];
    if ($_SESSION["user_type"] === "admin"){
        header('Location: adminDashboard.php');
    }
}

else {
    if(!isset($first_name)) {
        $first_name = "Guest";
    }
}
    
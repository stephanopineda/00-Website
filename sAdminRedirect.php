<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

// SKIP NON-SUPERADMIN PAGES
// SUPERADMIN REDIRECT
if (isset($_SESSION["user_type"])) {
    $user_id = $_SESSION["user_id"];
    $first_name = $_SESSION["first_name"];
    if ($_SESSION["user_type"] === "sAdmin"){
        header('Location: sAdminDashboard.php');
    }
}
else {
    if(!isset($first_name)) {
        $first_name = "Guest";
    }
}
    
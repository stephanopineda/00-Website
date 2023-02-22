<?php
session_start();
if ($_SESSION["user_type"] != "sAdmin"){
    header('Location: index.php');
}
if ($_SESSION["email"]) {
    $first_name = $_SESSION["first_name"];
}
else {
    $first_name = "Guest";
}

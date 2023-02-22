<?php
session_start();
if ($_SESSION["email"]) {
    $first_name = $_SESSION["first_name"];
    if ($_SESSION["user_type"] === "user"){
        header('Location: index.php');
    }
}
else {
    $first_name = "Guest";
}

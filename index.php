<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Epiphany</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background: url("images/bg1.jpg") no-repeat fixed center;
        }
    </style>    

    </head>
    <body>
        <div>
            Signed in as: <?php echo $first_name; ?>
        </div>

        <div>
            <?php 
            if (isset($_SESSION["user_type"])){
                echo "<a href = 'logout.php'> Logout  </a>";
            }
            else
            {
                echo "<a href = 'signin.php'> Login   </a>
                      <a href = 'signup.php'> Sign up </a>";
            }
            ?>
        </div>
    </body>
</html>
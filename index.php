<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
?>

<html>
    <head>
        <title>Epiphany</title>
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
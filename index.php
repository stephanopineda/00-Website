<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sessions.php';
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
            if ($first_name === 'Guest'){
                echo "<a href = 'signin.php'> Login   </a>
                      <a href = 'signup.php'> Sign up </a>";
            }
            else
            {
                echo "<a href = 'logout.php'> Logout  </a>";
            }
            ?>
        </div>
    </body>
</html>
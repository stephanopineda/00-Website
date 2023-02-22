<!DOCTYPE html>
<?php
    include 'connections.php';
?>

<html>
    <head>
        <title>Epiphany</title>
    </head>
    <body>
        <div>
            Signed in as: <?php echo 'test'; ?>
        </div>

        <div>
            <form>
                <input type = 'button' name = 'login' value="Login">
                <a href="signin.php">Login</a>
                <br>
                <input type = 'button' name = 'signup' value="Sign up">
                <a href="signup.php">Sign up</a>
            </form>
        </div>
    </body>
</html>
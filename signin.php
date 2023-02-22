<!DOCTYPE html>
<?php
    include 'connections.php';
?>

<html>
    <head>
        <title>Sign in to Epiphany</title>
    </head>
    <body>
        <div>
            <form method = 'POST'>
                <input type = 'text' name = 'user' placeholder="Email address or Username">    <br>
                <input type = 'text' name = 'password' placeholder="Password">      <br>
                <input type = 'submit' name = 'login' value="Login">                <br>
                <a href="recover.php">Forget your password?</a>                     <br>
                <a href="signup.php">Sign up</a>
            </form>
        </div>

        <?php
            if(isset($_POST["login"])) {
                $user =  $_POST['user'];
                $password = $_POST['password'];
                $userExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE email = '".$user."' OR username = '".$user."'");

                if(mysqli_num_rows($userExists)) {
                    $sql = "SELECT email, password FROM registeredUsers WHERE (email = '".$user."' OR username = '".$user."') AND password = '".$password."';";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "
                        <script>
                            alert('Login Successful');
                            document.location='index.php'
                        </script>
                        ";
                    }

                    else {
                        echo "Check your password.";
                    }
                }

                else {
                    echo "Email or username not found.";
                }
                mysqli_close($conn);
            }
        ?>
    </body>
</html>
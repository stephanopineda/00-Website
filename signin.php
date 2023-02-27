<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'userRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Sign in to Epiphany</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div>
            <form method = 'POST'>
                <input type = 'text' name = 'user' placeholder="Email address or Username"> <br>
                <input type = 'password' name = 'password' placeholder="Password">          <br>
                <input type = 'submit' name = 'login' value="Login">                        <br>
                <a href="recover.php">Forget your password?</a>                             <br>
                <a href="signup.php">Sign up</a>
            </form>
        </div>

        <!------------------------------------- Scripts ----------------------------------------->
        <script>
            
        </script>

        <?php
            if(isset($_POST["login"])) {
                $user =  mysqli_real_escape_string($conn, $_POST['user']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $userExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE email = '".$user."' OR username = '".$user."'");

                if(mysqli_num_rows($userExists)) {
                    $sql = "SELECT email, first_name, user_type FROM registeredUsers WHERE (email = '".$user."' OR username = '".$user."') AND password = '".$password."'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $_SESSION["email"] = $row['email'];
                        $_SESSION["first_name"] = $row['first_name'];
                        $_SESSION["user_type"] = $row['user_type'];
                        header('Location: index.php');
                        exit;
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
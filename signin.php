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

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-image: url("images/bg2.png");

            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .container{
            position: absolute;
            text-align: center;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: white;
            opacity: .80;
            font-size: 25px;
            border-radius: 25px;
        }

        div{
            margin: 5px;
        }

        input[type="text"], input[type="password"]{
            margin-top:10px;
            border:solid 1px #564635;
            border-radius: 15px;
            height: 25px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            width: 250px;
        }

        a{
            text-decoration:none;
            color: brown;
            background-color: white;
        }


    </style>

    </head>
    <body>
        <div class="container">
            <div>
                <form method = 'POST'>
                    <h1>LOGIN</h1>
                    We're thrilled to have you back!<br>
                    Let's get you logged in.
                    <input type = 'text' name = 'user' placeholder="Email address or Username"> <br>
                    <input type = 'password' name = 'password' placeholder="Password">          <br>
                    <input type = 'submit' name = 'login' value="Login">                        <br>
                    <a href="recover.php">Forgot your password?</a>                   <br>
                    <a href="signup.php">Don't have an account? <b>Sign up!<b></a>
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
                        $sql = "SELECT id, email, first_name, user_type FROM registeredUsers WHERE (email = '".$user."' OR username = '".$user."') AND password = '".$password."'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $_SESSION["user_id"] = $row['id'];
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
        </div>
    </body>
</html>
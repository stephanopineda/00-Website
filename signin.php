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
            background-color: #c1a98d;
        }

        .container{
            position: absolute;
            text-align: center;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            background-color: white;
            opacity: .86;
            font-size: 20px;
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
            color: blue;
            background-color: white;
        }

    </style>

    </head>
    <body>
        <div class="container">
            <div>
                <form method = 'POST'>
                    We're thrilled to have you back!<br>
                    Let's get you logged in.
                    <input type = 'text' name = 'user' placeholder="Email address or Username"> <br>
                    <input type = 'password' name = 'password' placeholder="Password">          <br>
                    <input type = 'submit' name = 'login' value="Login">                        <br>
                    <a href="recover.php">Forget your password?</a>                             <br>
                    <a href="signup.php">Don't have an account? <b>Sign up!<B></a>
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
        </div>
    </body>
</html>
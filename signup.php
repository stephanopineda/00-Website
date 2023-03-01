<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'userRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Sign up to Epiphany</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #c1a98d;
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
            font-size: 20px;
            border-radius: 25px;
        }

        div{
            margin: 5px;
        }

        input[type="text"], input[type="email"], input[type="password"],input[type="tel"]{
            margin-top:10px;
            border:solid 1px #564635;
            border-radius: 15px;
            height: 25px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            width: 250px;
        }

        #btn{
            height: 50px;
            font-size: 20px;
        }

        .tc,.already{
            color:#564635;
        }

    </style>

    </head>
    <body>
        <div class="container">
            <h1>SIGN UP</h1>
            <div>Welcome to Epiphany Scents <br> We are happy to meet you! </div>
            
            <div>
                <form method = 'POST'>
                        <input type = 'text' name = 'first_name' placeholder="First Name" required>                     <br>
                        <input type = 'text' name = 'last_name' placeholder="Last Name" required>                       <br>
                        <input type = 'text' name = 'username' placeholder="Username" required>                         <br>
                        <input type = 'email' name = 'email' placeholder="Email Address" required>                      <br>
                        <label for = "phone_num"></label>
                            <input type="tel" name="phone_num" pattern="[9]{1}[0-9]{9}" placeholder= "Phone Number">    <br>
                        <input type = 'password' name = 'password' placeholder="Password" required><br>
                        <input type = 'password' name = 'conpassword' placeholder="Confirm Password" required><br>
                    
                    <!--
                        <input type = 'date' name = 'birthday' placeholder="Birthday">
                        <br> 
                        <input type = 'text' name = 'address' placeholder="Address">
                        <br>
                    -->

                        <div><input type = 'checkbox' name = 'termsandcond' id = 'termsandcond'  />
                            I have read and accepted the <a href="terms.php" class="tc">Terms and Conditions</a>.
                            My personal details will be used carefully on purchase purposes only.
                        </div>

                        <input type = 'submit' name = 'signup' value="SIGN UP" id=btn>                                         <br>
                        <a href="signin.php" class="already">Already have an account?</a>
                    </form> <br>
                
                
                <div> <i>your best scent awaits you...</i> </div>
            </div>
            
            <!------------------------------------- Scripts ----------------------------------------->
            <script>
                document.getElementById('termsandcond').required = true;
                // validate password while typing
            </script>

            <?php
                if(isset($_POST["signup"]))
                {
                    $first_name =  $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $email =  $_POST['email'];
                    $phone_num = $_POST['phone_num'];
                    $password = $_POST['password'];
                    $date_registered = date("Y-m-d H:i:s");
                    $user_type = "user";

                    $emailExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE email = '".$email."'");
                    $usernameExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE username = '".$username."'");
                    
                    if((mysqli_num_rows($emailExists) === 0) && (mysqli_num_rows($usernameExists) === 0)) { 
                        $sql = "INSERT INTO registeredUsers(first_name, last_name, username, email, phone_num, password, date_registered, user_type)
                            VALUES ('$first_name',
                            '$last_name',
                            '$username',
                            '$email',
                            '$phone_num',
                            '$password',
                            CURRENT_TIMESTAMP(),
                            '$user_type')";

                        if(mysqli_query($conn, $sql)){
                            echo "
                                <script>
                                    alert('Registration Successful');
                                    document.location='index.php'
                                </script>";
                        } else
                        {
                            echo "ERROR: $sql. "
                                . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    }

                    elseif((mysqli_num_rows($emailExists) > 0) && (mysqli_num_rows($usernameExists) === 0)){
                        echo "Email already exists. You may Login instead.";
                    }
                    elseif((mysqli_num_rows($emailExists) === 0) && (mysqli_num_rows($usernameExists) > 0)){
                        echo "Username already exists. You may Login instead.";
                    }
                    else {
                        echo "Username and Email already exists. You may Login instead.";
                    }
                }
            ?>
        </div>
    </body>
</html>
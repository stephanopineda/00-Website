<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'userRedirect.php';
?>

<html>
    <head>
        <title>Sign up to Epiphany</title>
    </head>
    <body>
        <div>Welcome to Epiphany Scents <br> We are happy to meet you! </div>
        
        <div>
            <form method = 'POST'>
                <input type = 'text' name = 'first_name' placeholder="First Name" required>                     <br>
                <input type = 'text' name = 'last_name' placeholder="Last Name" required>                       <br>
                <input type = 'text' name = 'username' placeholder="Username" required>                         <br>
                <input type = 'email' name = 'email' placeholder="Email Address" required>                      <br>
                <label for = "phone_num">+63</label>
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
                    I have read and accepted the <a href="terms.php">Terms and Conditions</a>.
                    My personal details will be used carefully on purchase purposes only.
                </div>

                <input type = 'submit' name = 'signup' value="Sign up">                                         <br>
                <a href="signin.php">Already have an account?</a>
            </form>
            
            <div> YOUR BEST SCENT AWAITS YOU.... </div>
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
                $username = $_POST['username'];
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
    </body>
</html>
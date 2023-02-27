<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Add Admin Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div>Add Admin Account</div>
        <br><br>
        <div>
            <form method = 'POST'>
                <input type = 'text'     name = 'first_name'  placeholder = "First Name"       required><br>
                <input type = 'text'     name = 'last_name'   placeholder = "Last Name"        required><br>
                <input type = 'text'     name = 'username'    placeholder = "Username"         required><br>
                <input type = 'email'    name = 'email'       placeholder = "Email Address"    required><br>
                <input type = 'password' name = 'password'    placeholder = "Password"         required><br>
                <input type = 'password' name = 'conpassword' placeholder = "Confirm Password" required><br>
                <input type = 'submit'   name = 'create' value = "Create">                                          
                <a href="sAdminDashboard.php">Cancel</a>
            </form>
        </div>
        
        <!------------------------------------- Scripts ----------------------------------------->
        <script>
            // validate password while typing
        </script>

        <?php
            if(isset($_POST["create"])) {
                if($_SESSION["user_type"] === "sAdmin") {
                    $first_name =  $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $date_registered = date("Y-m-d H:i:s");
                    $user_type = "admin";
    
                    $emailExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE email = '".$email."'");
                    $usernameExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE username = '".$username."'");
                    
                    if((mysqli_num_rows($emailExists) === 0) && (mysqli_num_rows($usernameExists) === 0)) { 
                        $sql = "INSERT INTO registeredUsers(first_name, last_name, username, email, password, date_registered, user_type)
                            VALUES ('$first_name',
                            '$last_name',
                            '$username',
                            '$email',
                            '$password',
                            CURRENT_TIMESTAMP(),
                            '$user_type')";
    
                        if(mysqli_query($conn, $sql)){
                            echo "
                                <script>
                                    alert('Registration Successful');
                                    document.location='sAdminDashboard.php'
                                </script>";
                        }
                        else {
                            echo "ERROR: $sql. " . mysqli_error($conn);
                        }
                    }
    
                    elseif((mysqli_num_rows($emailExists) > 0) && (mysqli_num_rows($usernameExists) === 0)) {
                        echo "Email already exists.";
                    }
                    elseif((mysqli_num_rows($emailExists) === 0) && (mysqli_num_rows($usernameExists) > 0)) {
                        echo "Username already exists.";
                    }
                    else {
                        echo "Username and Email already exists.";
                    }
                    mysqli_close($conn);
                }
                else {
                    echo "
                        <script>
                            alert('You must login first.');
                            document.location='signin.php'
                        </script>
                    ";
                }
            }
        ?>
    </body>
</html>
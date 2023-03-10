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

        <style>
        html,body{
            margin: 0;
            font-size: 25px;
            line-height: 1.5em;
            border-radius: 25px;
            width: 500px;
            background-color: #c0bfb7;
        }

        .container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            border-radius: 25px;
            border: 2pt solid black;
            width: 30%;
            background-color: white;
    
        }

        #cancel{
            font-size: 18px;
            margin-right: 30px;
            text-decoration: none;
            color :blue;
        }
        
    </style>

    </head>
    <body>
        <div class="container">
            <h1>Add Admin Account</h1>
            <div>
                <form id = 'create' method = 'POST'>
                    <input type = 'text'     name = 'first_name'  placeholder = "First Name"       required><br>
                    <input type = 'text'     name = 'last_name'   placeholder = "Last Name"        required><br>
                    <input type = 'text'     name = 'username'    placeholder = "Username"         required><br>
                    <input type = 'email'    name = 'email'       placeholder = "Email Address"    required><br>
                    <input type = 'password' name = 'password'    id = 'password'    placeholder = "Password"         required><br>
                    <input type = 'password' name = 'conpassword' id = 'conpassword' placeholder = "Confirm Password" required><br>
                    <a href="sAdminDashboard.php" id="cancel">Cancel</a>
                    <input type = 'submit'   name = 'create' value = "Create">                                             
                </form>
            </div>
            
            <!------------------------------------- Scripts ----------------------------------------->
            <script>
                const form = document.getElementById('create');
                const passwordInput = document.getElementById('password');
                const confirmPasswordInput = document.getElementById('conpassword');

                form.addEventListener('submit', (event) => {
                    if (passwordInput.value !== confirmPasswordInput.value) {
                    event.preventDefault();
                    alert('Passwords do not match');
                    }
                });
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
                                        alert('Creation Successful');
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
        </div>
    </body>
</html>
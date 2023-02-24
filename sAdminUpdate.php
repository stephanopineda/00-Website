<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
?>

<html>
    <head>
        <title>Update Admin Account</title>
    </head>
    <body>
        <div>Update Admin Account</div>
        <br><br>
        <div>
            <form method = 'POST'>
                <label for= "email">Enter account email: </label>
                    <input type = 'email' name = 'email' placeholder="Email Address" required>
                <input type = 'submit' name = 'load' value="Load">                                  <br><br>
            </form>

            <form method = 'POST'>
                <div>Update Form</div>
                <label for= "email">Email: </label>
                    <input type = 'email' name = 'email' id = 'email' placeholder = "Email Address" readonly>             <br>
                <label for= "first_name"> First Name: </label>
                    <input type = 'text'     name = 'first_name'  id = 'first_name' placeholder = "First Name"       required><br>
                <label for= "last_name">  Last Name: </label>
                    <input type = 'text'     name = 'last_name'   id = 'last_name'  placeholder = "Last Name"        required><br>
                <label for= "username">   Username: </label>
                    <input type = 'text'     name = 'username'    id = 'username'   placeholder = "Username"         required><br>
                <label for= "password">   Password: </label>
                    <input type = 'password' name = 'password'                      placeholder = "Password"         required><br>
                <label for= "conpassword">Confirm Password: </label>
                    <input type = 'password' name = 'conpassword'                   placeholder = "Confirm Password" required><br>
                    <input type = 'submit'   name = 'update' value="Update Account">                                          
                <a href="sAdminDashboard.php">Cancel</a>
            </form>
        </div>
        
        <!------------------------------------- Scripts ----------------------------------------->
        <script>
            // validate password while typing
        </script>

        <?php
            if($_SESSION["user_type"] === "sAdmin") {
                if(isset($_POST["load"])) {
                    $email =  $_POST['email'];
                    $emailExists = mysqli_query($conn, "SELECT * FROM registeredUsers 
                                                        WHERE email = '".$email."' AND user_type = 'admin'");
                    
                    if(mysqli_num_rows($emailExists)){
                        $query = "SELECT * FROM registeredUsers WHERE email = '".$email."'";
                        $result = mysqli_query($conn, $query);
                        $row = $result->fetch_assoc();
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $username = $row['username'];
                        echo "<script>document.getElementById('email').value='$email';</script>";
                        echo "<script>document.getElementById('first_name').value='$first_name';</script>";
                        echo "<script>document.getElementById('last_name').value='$last_name';</script>";
                        echo "<script>document.getElementById('username').value='$username';</script>";
                    }
                    else {
                        echo "Email not in database.";
                    }
                }

                if(isset($_POST["update"])) {
                    $email =  $_POST['email'];
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    $usernExists = mysqli_query($conn, "SELECT * FROM registeredUsers 
                                                        WHERE email != '".$email."' && username = '".$username."'");
                    
                    if(mysqli_num_rows($usernExists) === 0) {
                        $sql = "UPDATE registeredUsers 
                                SET first_name = '$first_name',
                                    last_name = '$last_name',
                                    username = '$username',
                                    password = '$password'
                                WHERE email = '$email'";
 
                        if(mysqli_query($conn, $sql)){
                            echo "
                                <script>
                                    alert('Update Successful');
                                    document.location='sAdminDashboard.php'
                                </script>";
                        }
                        else {
                            echo "ERROR: $sql. " . mysqli_error($conn);
                        }
                    }
                    else {
                        echo "Username already exists.";
                    }
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
        ?>
    </body>
</html>
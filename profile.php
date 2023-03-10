<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
    include 'userNavBar.php';
?>

<html>
    <head>
        <title>Hello <?php echo $_SESSION['first_name']; ?>!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #c0bfb7;
            text-align: center;
        }

        .container{
            width: 30%;
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            background-color: white;
            border-radius: 25px;
            opacity: .90;
            padding-bottom: 15px;
        }

        .bg3{
            position: relative;
            background-image: url("images/bg3.png");
            height: 100%; 
            background-size: 100% 100%;
        }

        #name{
            color: #564635;
        }

        label:not(#pass_input){
            float: left;
            margin-left: 15px;
        }

        input:not(#pass_input,#submit,input[type="date"]){
            float:right;
            width: 60%;
            margin-right: 15px;
        }

        input[type="date"]{
            float:right;
            width: 60.5%;
            margin-right: 15px;
         }
         
    </style>
    </head>
    <body>
        <div class="bg3">
            <?php
                $id = intval($_GET['id']);
                
                $query = "SELECT * FROM registeredUsers WHERE id = $id";
                $result = mysqli_query($conn, $query);
                $row = $result->fetch_assoc();

                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $username = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
                $phoneNum = $row['phone_num'];
                $address = $row['address'];
                $birthdate = $row['birthdate'];
            ?>
            
            <div class="container">
            <h1>Hello <span id="name"><?php echo $_SESSION['first_name']; ?>!</span></h1>                              <br>
                <form method="POST" enctype="multipart/form-data">
                    <label for = 'firstName'> First Name: </label>
                        <input type = 'text'   name = 'firstName' value = '<?php echo $firstName; ?>' required><br>

                    <label for = 'lastName'> Last Name: </label>
                        <input type = 'text'   name = 'lastName' value = '<?php echo $lastName; ?>' required><br>

                    <label for = 'username'> Username: </label>
                        <input type = 'text'   name = 'username' value = '<?php echo $username; ?>' required><br>

                    <label for = 'email'> Email: </label>
                        <input type = 'text'   name = 'email' value = '<?php echo $email; ?>' required><br>

                    <label for = "phoneNum"> Phone Number: </label>
                        <input type="tel" name="phoneNum" pattern="[9]{1}[0-9]{9}" value = '<?php echo $phoneNum; ?>'><br>

                    <label for = "address"> Address: </label>
                        <input type="text" name="address" value = '<?php echo $address; ?>'><br>

                    <label for = "birthdate"> Birthdate: </label>
                        <input type="date" name="birthdate" value = '<?php echo $birthdate; ?>'><br><br><br>

                    <label for = "password" id="enterpass"> Enter your password to continue: </label>
                        <input type="password" name="password" placeholder="Password" required id="pass_input"><br>
                    
                    <a href="index.php">Cancel</a>
                    <input type = 'submit' name = 'edit' value = "Edit Profile" id="submit">                                          
                    
                </form>
            </div>
        </div>
        
        <!------------------------------------- Scripts ----------------------------------------->
        <script>
            // 
        </script>

        <?php
            if(isset($_POST["edit"])) {
                if($password === $_POST['password']) {
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $phoneNum = $_POST['phoneNum'];
                    $address = $_POST['address'];
                    $birthdate = $_POST['birthdate'];

                    $emailExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE email = '".$email."' AND id != '".$id."'");
                    $usernameExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE username = '".$username."'AND id != '".$id."'");
                        
                    if((mysqli_num_rows($emailExists) === 0) || (mysqli_num_rows($usernameExists) === 0)) {
                        $sql = "UPDATE registeredUsers 
                                   SET first_name = '$firstName',
                                       last_name = '$lastName',
                                       username = '$username',
                                       email = '$email',
                                       password = '$password',
                                       phone_num = '$phoneNum',
                                       address = '$address',
                                       birthdate = '$birthdate'
                                 WHERE id = '$id'";

                        if(mysqli_query($conn, $sql)){
                            echo "
                                <script>
                                    alert('Update Successful');
                                    document.location='index.php'
                                </script>
                            ";
                        }
                        else {
                            echo "ERROR: $sql. " . mysqli_error($conn);
                        }
                    }

                    else{
                        echo "
                        <script>
                            alert('User does not exist.');
                            document.location='index.php'
                        </script>
                        ";
                    }
                }
                else {
                    echo "
                        <script>
                            alert('Please re-enter your password.');
                        </script>
                    ";
                }
            }
            
            mysqli_close($conn);
        ?>
    </body>
</html>
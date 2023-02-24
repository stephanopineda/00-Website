<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
?>

<html>
    <head>
        <title>Remove Admin Account</title>
    </head>
    <body>
        <div>Remove Admin Account</div>
        <br><br>
        <div>
            <form method = 'POST'>
                <label for = 'username'>Enter Username: </label>
                <input type = 'text' name = 'username' placeholder="Enter username" required>   <br>
                <input type = 'submit' name = 'remove' value="Remove">                          
                <a href="sAdminDashboard.php">Cancel</a>
            </form>
        </div>
        <br><br>
        <!------------------------------------- Scripts ----------------------------------------->
        <?php
            $query = "SELECT * FROM registeredUsers WHERE user_type = 'admin'";
            $result = mysqli_query($conn, $query);
            echo "<table>";
            echo "<tr>
            <td>" . 'first_name'        . "</td>
            <td>" . 'last_name'         . "</td>
            <td>" . 'username'          . "</td>
            <td>" . 'email'             . "</td>
            <td>" . 'date_registered'   . "</td>
            <td>" . 'user_type'         . "</td>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . htmlspecialchars($row['first_name'])        . "</td>
                <td>" . htmlspecialchars($row['last_name'])         . "</td>
                <td>" . htmlspecialchars($row['username'])          . "</td>
                <td>" . htmlspecialchars($row['email'])             . "</td>
                <td>" . htmlspecialchars($row['date_registered'])   . "</td>
                <td>" . htmlspecialchars($row['user_type'])         . "</td>
                </tr>";
            }
            echo "</table>";
            
            if(isset($_POST["remove"])) {
                if($_SESSION["user_type"] === "sAdmin") {
                    $username = $_POST['username'];
                    $usernameExists = mysqli_query($conn, "SELECT * FROM registeredUsers WHERE username = '".$username."'");
                    
                    if((mysqli_num_rows($usernameExists) != 0)) { 
                        $sql = "DELETE FROM registeredUsers WHERE username = '".$username."'";
    
                        if(mysqli_query($conn, $sql)) {
                            echo "
                                <script>
                                    alert('Removal Successful');
                                </script>
                            ";
                        }
                        else {
                            echo "ERROR: $sql. "
                                . mysqli_error($conn);
                        }
                    }
                    else {
                        echo "
                            <script>
                                alert('Username not found.');
                            </script>
                        ";
                    }
                    echo "
                            <script>
                                document.location='sAdminRemove.php'
                            </script>
                        ";
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
            mysqli_close($conn);
        ?>
    </body>
</html>
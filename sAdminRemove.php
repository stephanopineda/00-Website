<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Remove Admin Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin Accounts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        html,body{
            position: absolute;
            text-align: center;
            margin: 0;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            background-color: #c0bfb7;

        }

        .table{
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 8px;
            border: 1px solid black;
            background-color: beige;
        }

        th {
            background-color: #564635;
            color: white;
        }

    </style>

    </head>
    <body>
        <h1>Remove Admin Account</h1>
        <a href="sAdminDashboard.php">Go Back</a>
        <div> <br>
            <form method = 'POST'>
                <label for = 'username'>Enter Username: </label>
                <input type = 'text' name = 'username' placeholder="Enter username" required>
                <input type = 'submit' name = 'remove' value="Remove">                          
            </form>
        </div>
        <br><br>
        <!------------------------------------- Scripts ----------------------------------------->
        <?php
            $query = "SELECT * FROM registeredUsers WHERE user_type = 'admin'";
            $result = mysqli_query($conn, $query);
            echo "<table class=table>";
            echo "<tr>
            <th>" . 'FIRST'           . "</th>
            <th>" . 'LAST'            . "</th>
            <th>" . 'USERNAME'        . "</th>
            <th>" . 'EMAIL'           . "</th>
            <th>" . 'DATE REGISTERED' . "</th>
            <th>" . 'USER TYPE'       . "</th>
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
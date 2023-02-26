<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Admin Accounts</title>
    </head>
    <body>
        <div>
            Signed in as: <?php echo $_SESSION['first_name']; ?>
        </div>
        <div>
            <a href = 'logout.php'> Logout  </a><br><br><br>
        </div>
        <div>
            <a href = 'sAdminCreate.php'> Create admin account  </a><br>
            <a href = 'sAdminUpdate.php'> Update admin account  </a><br>
            <a href = 'sAdminRemove.php'> Remove admin account  </a><br>
        </div>
        <!------------------------------------- Scripts ----------------------------------------->
        <?php
            $query = "SELECT * FROM registeredUsers WHERE user_type = 'admin'";
            $result = mysqli_query($conn, $query);
            echo "<table>";
            echo "<tr>
            <th>" . 'first_name'        . "</th>
            <th>" . 'last_name'         . "</th>
            <th>" . 'username'          . "</th>
            <th>" . 'email'             . "</th>
            <th>" . 'date_registered'   . "</th>
            <th>" . 'user_type'         . "</th>
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

            mysqli_close($conn);
        ?>
    </body>
</html>
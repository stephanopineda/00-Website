<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sessionsAd.php';
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
            <a href = 'logout.php'> Logout  </a>
        </div>
        <!--
            Show admin table
            Create admin privileges
            Change admin password
            Remove admin privileges
        -->
        <a href = 'createAdmin.php'> Create Admin Account </a>
        <a href = 'removeAdmin.php'> Remove Admin Account </a>

        <?php
            $query = "SELECT * FROM registeredUsers WHERE user_type = 'admin'";
            $result = mysqli_query($conn, $query);
            echo "<table>";
            echo "<tr>
            <td>" . 'first_name'    . "</td>
            <td>" . 'last_name'     . "</td>
            <td>" . 'username'      . "</td>
            <td>" . 'email'         . "</td>
            <td>" . 'phone_num'     . "</td>
            <td>" . 'password'      . "</td>
            <td>" . 'date_registered' . "</td>
            <td>" . 'user_type'     . "</td>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . htmlspecialchars($row['first_name'])    . "</td>
                <td>" . htmlspecialchars($row['last_name'])     . "</td>
                <td>" . htmlspecialchars($row['username'])      . "</td>
                <td>" . htmlspecialchars($row['email'])         . "</td>
                <td>" . htmlspecialchars($row['phone_num'])     . "</td>
                <td>" . htmlspecialchars($row['password'])      . "</td>
                <td>" . htmlspecialchars($row['date_registered']) . "</td>
                <td>" . htmlspecialchars($row['user_type'])     . "</td>
                </tr>";
            }
            echo "</table>";

            mysqli_close($conn);
        ?>

    </body>
</html>
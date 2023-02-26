<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'userRedirect.php';
?>

<html>
    <head>
        <title>Hello <?php echo $_SESSION['first_name']; ?>!</title>
    </head>
    <body>
        <div>
            Signed in as: <?php echo $_SESSION['first_name']; ?>
        </div>
        <div>
            <a href = 'logout.php'> Logout  </a><br><br><br>
        </div>
        <div>
            <a href = 'adminAddProduct.php'> Add Product </a><br>
        </div>

        <?php
            $query = "SELECT * FROM storeContent";
            $result = mysqli_query($conn, $query);
            
            echo "<table>";
            echo "<tr>
            <td>" . 'file_name'   . "</td>
            <td>" . 'product_name'. "</td>
            <td>" . 'stock'       . "</td>
            <td>" . 'price'       . "</td>
            <td>" . 'description' . "</td>
            <td>" . 'action'      . "</td>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td><img src='./images/" . $row['file_name']     . "' width = '100px'></td>
                <td>"  .  htmlspecialchars($row['product_name']) . "</td>
                <td>"  .  htmlspecialchars($row['stock'])        . "</td>
                <td>"  .  htmlspecialchars($row['price'])        . "</td>
                <td>"  .  htmlspecialchars($row['description'])  . "</td>
                <td><a href = edit.php> Edit </a></td>
                </tr>";
            }
            
            echo "</table>";

            mysqli_close($conn);
        ?>
        
    </body>
</html>
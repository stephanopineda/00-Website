<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>My Cart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <div class="container">
            <div>
                Signed in as: <?php echo $_SESSION['first_name']; ?>
            </div>
            <div>
                <a href = 'logout.php'> Logout  </a><br><br><br>
            </div>
            <br> <br>

            <?php
                $query = "SELECT * FROM shopping_cart WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);


                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Picture'. "</th>
                <th>" . 'Name'. "</th>
                <th>" . 'Quantity'       . "</th>
                <th>" . 'Date Added'       . "</th>
                </tr>";

                while($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $storeQuery = "SELECT * FROM storeContent WHERE id = '$product_id'";
                    $storeRes = mysqli_query($conn, $storeQuery);
                    $prodRow = $storeRes->fetch_assoc();

                    echo "<tr>
                    <td><img src='./uploads/" . $prodRow['file_name']     . "' width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($row['quantity'])        . "</td>
                    <td>"  .  htmlspecialchars($row['date_added'])        . "</td>
                    ";
                }
                
                echo "</table>";

                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>
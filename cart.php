<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
    include 'userNavBar.php';
    if ($_SESSION["user_type"] != 'user'){
        echo "
            <script>
                alert('Login so you can use the cart.');
                document.location='signin.php'
            </script>
        ";
    }
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
            <br>
            <div> Cart </div>
            <?php
                // Cart
                $sqlCart = "SELECT * FROM shopping_cart WHERE user_id = '$user_id'";
                $cart = mysqli_query($conn, $sqlCart);

                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Picture'         . "</th>
                <th>" . 'Name'            . "</th>
                <th>" . 'Quantity'        . "</th>
                <th>" . 'Available Stock' . "</th>
                <th>" . 'Price' . "</th>
                <th>" . 'Date Added'      . "</th>
                <th>" . 'Actions'      . "</th>
                </tr>";

                $total = 0;
                while($cartRow = $cart->fetch_assoc()) {
                    $product_id = $cartRow['product_id'];
                    $storeQuery = "SELECT * FROM storeContent WHERE id = '$product_id'";
                    $storeRes = mysqli_query($conn, $storeQuery);
                    $prodRow = $storeRes->fetch_assoc();
                    $quantity = $cartRow['quantity'];
                    $price = $prodRow['price'];
                    $total = $total + $quantity * $price;

                    echo "<tr>
                    <td><img src='./uploads/" . $prodRow['file_name']    . "' width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td><a href = 'quantityMinus.php?id=".$cartRow["id"]."'> - </a>"
                           .  htmlspecialchars($cartRow['quantity']). "
                        <a href = 'quantityAdd.php?id=".$cartRow["id"]."'  > + </a></td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])     . "</td>
                    <td>"  .  htmlspecialchars($prodRow['price'])     . "</td>
                    <td>"  .  htmlspecialchars($cartRow['date_added'])   . "</td>
                    <td><a href = 'removeProductFromCart.php?id=".$prodRow["id"]."' class='btnRemove'>Remove</td>
                    </tr>";
                }                
                echo "</table>";
                echo "<div> Total Price: $total </div><br>"
            ?>
            <a href ="placeOrder.php" class='order'>Place Order</a><br><br>

            <br><br>
            <div> Orders </div>
            <?php
                // Place Order with Status
                $sqlOrder = "SELECT * FROM orders WHERE user_id = '$user_id' && order_status != 'received'";
                $order = mysqli_query($conn, $sqlOrder);

                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Picture'      . "</th>
                <th>" . 'Name'         . "</th>
                <th>" . 'Quantity'     . "</th>
                <th>" . 'Date Added'   . "</th>
                <th>" . 'Order Status' . "</th>
                <th>" . 'Actions'      . "</th>
                </tr>";

                while($orderRow = $order->fetch_assoc()) {
                    $product_id = $orderRow['product_id'];
                    $storeQuery = "SELECT * FROM storeContent WHERE id = '$product_id'";
                    $storeRes = mysqli_query($conn, $storeQuery);
                    $prodRow = $storeRes->fetch_assoc();

                    if ($orderRow['order_status'] == 'Pending'){
                        $action = "<a href = 'orderCancel.php?id=".$orderRow["id"]."'class='btnCancel'>Cancel</a>";
                    }
                    else if ($orderRow['order_status'] == 'To be delivered'){
                        $action =  "<a href = 'orderReceived.php?id=".$orderRow["id"]."'class='btnReceive'>Receive</a>";
                    }
                    else{
                        $action = "";
                    }

                    echo "<tr>
                    <td><img src='./uploads/" . $prodRow['file_name']   . "' width = '100px'></td>
                    <td>" . htmlspecialchars($prodRow['product_name'])  . "</td>
                    <td>" . htmlspecialchars($orderRow['quantity'])     . "</td>
                    <td>" . htmlspecialchars($orderRow['date_added'])   . "</td>
                    <td>" . htmlspecialchars($orderRow['order_status']) . "</td>
                    <td>" . $action                                     . "</td>
                    </tr>";
                    
                }                
                echo "</table>";
            ?>
            
            <br><br>
            <div> Transaction History </div>
            <?php
                // Transaction history or paid 
                $sqlOrder = "SELECT * FROM orders WHERE user_id = '$user_id' && order_status = 'received'";
                $order = mysqli_query($conn, $sqlOrder);

                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Picture'      . "</th>
                <th>" . 'Name'         . "</th>
                <th>" . 'Quantity'     . "</th>
                <th>" . 'Date Received'   . "</th>
                </tr>";

                while($orderRow = $order->fetch_assoc()) {
                    $product_id = $orderRow['product_id'];
                    $storeQuery = "SELECT * FROM storeContent WHERE id = '$product_id'";
                    $storeRes = mysqli_query($conn, $storeQuery);
                    $prodRow = $storeRes->fetch_assoc();

                    echo "<tr>
                    <td><img src='./uploads/" . $prodRow['file_name']     . "' width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($orderRow['quantity'])        . "</td>
                    <td>"  .  htmlspecialchars($orderRow['date_received'])        . "</td>
                    </tr>";
                }                
                echo "</table>";
                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>
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

        <style>
            html,body{
                height: 100%;
                margin: 0;
                background-color: #c0bfb7;
                text-align: center;
            }

            table{
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

            .plus,.minus,.order,.logout{
                display: inline-block;
                padding: 10px 20px;
                font-size: 25px;
                font-weight: bold;
                text-decoration: none;
                color: black;
                border-radius: 4px;
                border: none;
                cursor: pointer;
            }

            .logout{
                background-color: white;
            }
            
            .plus:hover,.minus:hover{
                background-color: white;
            }

            .order{
                background-color: white;
            }

            .order:hover, .logout:hover{
                background-color: beige;
                border: 2pt solid black;
            }

            .user_container{
                float: right;
            }

            hr{
            padding-top: 10px;
            padding-bottom: 10px;
            }


        </style>
    </head>
    <body>
        <div class="container">
            <div class="user_container">
                <div>Signed in as: <?php echo $_SESSION['first_name']; ?></div>
                <a href = 'logout.php' class="logout"> Logout  </a>
            </div>
            <br><br><br>
            <h1> My Cart </h1>
            <?php
                // Cart
                $sqlCart = "SELECT * FROM shopping_cart WHERE user_id = '$user_id'";
                $cart = mysqli_query($conn, $sqlCart);

                echo "<table class=table>";
                echo "<tr>
                <th>" . 'PICTURE'         . "</th>
                <th>" . 'NAME'            . "</th>
                <th>" . 'QUANTITY'        . "</th>
                <th>" . 'AVAILABLE STOCK' . "</th>
                <th>" . 'PRICE'           . "</th>
                <th>" . 'DATE ADDED'      . "</th>
                <th>" . 'ACTIONS    '     . "</th>
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
                    <td><a href = 'quantityMinus.php?id=".$cartRow["id"]."' class=minus> - </a>"
                           .  htmlspecialchars($cartRow['quantity']). "
                        <a href = 'quantityAdd.php?id=".$cartRow["id"]."' class=plus > + </a></td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])     . "</td>
                    <td>"  .  htmlspecialchars($prodRow['price'])     . "</td>
                    <td>"  .  htmlspecialchars($cartRow['date_added'])   . "</td>
                    <td><a href = 'removeProductFromCart.php?id=".$prodRow["id"]."' class='btnRemove'>Remove</td>
                    </tr>";
                }                
                echo "</table>";
                echo "<h2> Total Price: $total </h2><br>"
            ?>
            
            <a href ="placeOrder.php" class='order'>Place Order</a><br><br><hr>

            <h1> Orders </h1>
            <?php
                // Place Order with Status
                $sqlOrder = "SELECT * FROM orders WHERE user_id = '$user_id' && order_status != 'received'";
                $order = mysqli_query($conn, $sqlOrder);

                echo "<table class=table>";
                echo "<tr>
                <th>" . 'PICTURE'      . "</th>
                <th>" . 'NAME'         . "</th>
                <th>" . 'QUANTITY'     . "</th>
                <th>" . 'DATE ADDED'   . "</th>
                <th>" . 'ORDER STATUS' . "</th>
                <th>" . 'ACTIONS'      . "</th>
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

        </div>
    </body>
</html>
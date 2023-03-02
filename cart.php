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
            }

            .cart_container{
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


        </style>
    </head>
    <body>
        <div class="cart_container">
            
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
                echo "<h2> Total Price: $total </h2>"
            ?>
            
            <a href ="placeOrder.php" class='order'>Place Order</a><br><br>

        </div>
    </body>
</html>
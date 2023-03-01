<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';
?>

<html>
    <head>
        <title>Hello <?php echo $_SESSION['first_name']; ?>!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        html,body{
            height: 100%;
            margin: 0;
            background-color: #c0bfb7;
        }

        .container{
            text-align: center;
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

        #add{
            text-decoration: none;
            color: black;
            padding: 10px;
            margin-top:10px;
            border:solid 1px #564635;
            border-radius: 15px;
            height: 25px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            width: 250px;
            background-color: white;
        }

        #add:hover{
            background-color: beige;
        }

        hr{
            padding: 10px;
        }
        
    </style>

    </head>
    <body>
        <div class="container">
            <div>
                Signed in as: <?php echo $_SESSION['first_name']; ?> [ADM]
            </div>
            <div>
                <a href = 'logout.php'> Logout  </a><br><br><br>
            </div>
            <div>
                <a href = 'adminAddProduct.php' id="add"> Add Product </a> 

            </div> <br> <br>
            <h1> Products Available on Site</h1>
            <?php
                $sqlProd = "SELECT * FROM storeContent";
                $prod = mysqli_query($conn, $sqlProd);
                
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'PICTURE'     . "</th>
                <th>" . 'PRODUCT NAME'. "</th>
                <th>" . 'STOCK'       . "</th>
                <th>" . 'PRICE'       . "</th>
                <th>" . 'DESCRIPTION' . "</th>
                <th>" . 'ACTION'      . "</th>
                </tr>";

                while($prodRow = $prod->fetch_assoc()) {
                    echo "<tr>
                    <td><img src='./uploads/" . $prodRow['file_name']     . "' width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])        . "</td>
                    <td>"  .  htmlspecialchars($prodRow['price'])        . "</td>
                    <td>"  .  htmlspecialchars($prodRow['description'])  . "</td>
                    <td><a href = 'adminEditProduct.php?id=".$prodRow["id"]."' class='btnEdit'>Edit
                    <a href = 'adminRemoveProduct.php?id=".$prodRow["id"]."' class='btnRemove'>Remove</td>
                    </tr>";
                }
                echo "</table>";
            ?>

            <!-- View and Accept Orders -->
            <br><br><hr><br> 
            <h1> Customer Pending Orders </h1>
            <?php
                $sqlOrders = "SELECT * FROM orders WHERE order_status = 'Pending'";
                $orders = mysqli_query($conn, $sqlOrders);
                
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Customer Username'    . "</th>
                <th>" . 'Picture'          . "</th>
                <th>" . 'Product Name'     . "</th>
                <th>" . 'Current Stock'            . "</th>
                <th>" . 'Quantity Ordered' . "</th>
                <th>" . 'Action'           . "</th>
                </tr>";

                while($orderRow = $orders->fetch_assoc()) {
                    $user_id = $orderRow['user_id'];
                    $product_id = $orderRow['product_id'];
                        $sqlUsers = "SELECT username FROM registeredUsers WHERE id = $user_id";
                        $sqlProd = "SELECT product_name, stock, file_name FROM storeContent WHERE id = $product_id";
                    $users = mysqli_query($conn, $sqlUsers);
                    $prod = mysqli_query($conn, $sqlProd);
                    $userRow = $users->fetch_assoc();
                    $prodRow = $prod->fetch_assoc();

                    echo "<tr>
                    <td>"  .  htmlspecialchars($userRow['username']) . "</td>
                    <td><img src='./uploads/" . $prodRow['file_name']    . "'width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])        . "</td>
                    <td>"  .  htmlspecialchars($orderRow['quantity'])        . "</td>
                    <td><a href = 'adminOrderAccept.php?id=".$orderRow["id"]."' class='btnAccept'>Accept</td>";
                }
                
                echo "</table>";
            ?>

            <br><br><br>
            <div> To be Shipped </div>
            <?php
                $sqlOrders = "SELECT * FROM orders WHERE order_status = 'To be shipped'";
                $orders = mysqli_query($conn, $sqlOrders);
                
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Customer Username'    . "</th>
                <th>" . 'Picture'          . "</th>
                <th>" . 'Product Name'     . "</th>
                <th>" . 'Current Stock'            . "</th>
                <th>" . 'Quantity Ordered' . "</th>
                <th>" . 'Action'           . "</th>
                </tr>";

                while($orderRow = $orders->fetch_assoc()) {
                    $user_id = $orderRow['user_id'];
                    $product_id = $orderRow['product_id'];
                        $sqlUsers = "SELECT username FROM registeredUsers WHERE id = $user_id";
                        $sqlProd = "SELECT product_name, stock, file_name FROM storeContent WHERE id = $product_id";
                    $users = mysqli_query($conn, $sqlUsers);
                    $prod = mysqli_query($conn, $sqlProd);
                    $userRow = $users->fetch_assoc();
                    $prodRow = $prod->fetch_assoc();

                    echo "<tr>
                    <td>"  .  htmlspecialchars($userRow['username']) . "</td>
                    <td><img src='./uploads/" . $prodRow['file_name']    . "'width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])        . "</td>
                    <td>"  .  htmlspecialchars($orderRow['quantity'])        . "</td>
                    <td><a href = 'adminOrderShipped.php?id=".$orderRow["id"]."' class='btnAccept'>Shipped</td>
                    </tr>";
                }
                
                echo "</table>";
            ?>

            <br><br><br>
            <div> To be Delivered </div>
            <?php
                $sqlOrders = "SELECT * FROM orders WHERE order_status = 'To be delivered'";
                $orders = mysqli_query($conn, $sqlOrders);
                
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Customer Username'    . "</th>
                <th>" . 'Picture'          . "</th>
                <th>" . 'Product Name'     . "</th>
                <th>" . 'Current Stock'            . "</th>
                <th>" . 'Quantity Ordered' . "</th>
                </tr>";

                while($orderRow = $orders->fetch_assoc()) {
                    $user_id = $orderRow['user_id'];
                    $product_id = $orderRow['product_id'];
                        $sqlUsers = "SELECT username FROM registeredUsers WHERE id = $user_id";
                        $sqlProd = "SELECT product_name, stock, file_name FROM storeContent WHERE id = $product_id";
                    $users = mysqli_query($conn, $sqlUsers);
                    $prod = mysqli_query($conn, $sqlProd);
                    $userRow = $users->fetch_assoc();
                    $prodRow = $prod->fetch_assoc();

                    echo "<tr>
                    <td>"  .  htmlspecialchars($userRow['username']) . "</td>
                    <td><img src='./uploads/" . $prodRow['file_name']    . "'width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])        . "</td>
                    <td>"  .  htmlspecialchars($orderRow['quantity'])        . "</td>
                    </tr>";
                }
                
                echo "</table>";
            ?>
        
            <br><br><br>
            <div> Successful Orders </div>
            <?php
                $sqlOrders = "SELECT * FROM orders WHERE order_status = 'Received'";
                $orders = mysqli_query($conn, $sqlOrders);
                
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'Customer Username'. "</th>
                <th>" . 'Picture'          . "</th>
                <th>" . 'Product Name'     . "</th>
                <th>" . 'Current Stock'    . "</th>
                <th>" . 'Quantity Ordered' . "</th>
                <th>" . 'Date Received'    . "</th>
                </tr>";

                while($orderRow = $orders->fetch_assoc()) {
                    $user_id = $orderRow['user_id'];
                    $product_id = $orderRow['product_id'];
                        $sqlUsers = "SELECT username FROM registeredUsers WHERE id = $user_id";
                        $sqlProd = "SELECT product_name, stock, file_name FROM storeContent WHERE id = $product_id";
                    $users = mysqli_query($conn, $sqlUsers);
                    $prod = mysqli_query($conn, $sqlProd);
                    $userRow = $users->fetch_assoc();
                    $prodRow = $prod->fetch_assoc();

                    echo "<tr>
                    <td>"  .  htmlspecialchars($userRow['username'])     . "</td>
                    <td><img src='./uploads/" . $prodRow['file_name']    . "'width = '100px'></td>
                    <td>"  .  htmlspecialchars($prodRow['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($prodRow['stock'])        . "</td>
                    <td>"  .  htmlspecialchars($orderRow['quantity'])    . "</td>
                    <td>"  .  htmlspecialchars($orderRow['date_received'])    . "</td>
                    </tr>";
                }
                
                echo "</table>";

                mysqli_close($conn);
            ?>
            </div>
        </div>
    </body>
</html>
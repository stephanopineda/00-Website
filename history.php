<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
    include 'userNavBar.php';
    if ($_SESSION["user_type"] != 'user'){
        echo "
            <script>
                alert('Login so you can use view your history.');
                document.location='signin.php'
            </script>
        ";
    }
?>

<html>
    <head>
        <title>History</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            html,body{
                height: 100%;
                margin: 0;
                background-color: #c0bfb7;
            }

            .history_container{
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

        </style>
    </head>

    <body>
        <div class="history_container">
            <h1> Transaction History </h1>
            <?php
                // Transaction history or paid 
                $sqlOrder = "SELECT * FROM orders WHERE user_id = '$user_id' && order_status = 'received'";
                $order = mysqli_query($conn, $sqlOrder);

                echo "<table class=table>";
                echo "<tr>
                <th>" . 'PICTURE'      . "</th>
                <th>" . 'NAME'         . "</th>
                <th>" . 'QUANTITY'     . "</th>
                <th>" . 'DATE RECEIVED'   . "</th>
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
        
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';

    $orderId = intval($_GET['id']);
    $sqlOrder = "SELECT quantity, product_id FROM orders WHERE id = $orderId";
    $order = mysqli_query($conn, $sqlOrder);
    $orderRow = $order->fetch_assoc();
    $orderQuantity = $orderRow['quantity'];
    $product_id = $orderRow['product_id'];

    $sqlProd = "SELECT stock FROM storeContent WHERE id = $product_id";
    $prod = mysqli_query($conn, $sqlProd);
    $prodRow = $prod->fetch_assoc();
    $stock = $prodRow['stock'];

    if ($stock >= $orderQuantity){
        $sql = "UPDATE orders 
            SET order_status = 'To be shipped'
            WHERE id = $orderId";
        if(mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert('Order Accepted.');
                    document.location='adminDashboard.php'
                </script>
            ";
        }
        else {
            echo "ERROR: $sql. "
                . mysqli_error($conn);
        }
    }
    else{
        echo "
                <script>
                    alert('Check current stock');
                    document.location='adminDashboard.php'
                </script>
            ";
    }

    
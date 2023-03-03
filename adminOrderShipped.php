<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';

    $orderId = intval($_GET['id']);
    $sqlOrder = "SELECT product_id, quantity FROM orders WHERE id = $orderId";
    $order = mysqli_query($conn, $sqlOrder);
    $orderRow = $order->fetch_assoc();
    $product_id = $orderRow['product_id'];
    $orderQuantity = $orderRow['quantity'];

    $sqlProd = "SELECT stock FROM storeContent WHERE id = $product_id";
    $prod = mysqli_query($conn, $sqlProd);
    $prodRow = $prod->fetch_assoc();
    $prevStock = $prodRow['stock'];
    $newStock = $prevStock - $orderQuantity;

    $sql = "UPDATE orders 
            SET order_status = 'To be delivered'
            WHERE id = $orderId";
            
    if(mysqli_query($conn, $sql)) {
        $sqlUpdateQuantity = "UPDATE storeContent 
                            SET stock = $newStock
                            WHERE id = $product_id";
        mysqli_query($conn, $sqlUpdateQuantity);
        echo "
            <script>
                alert('Order Shipped.');
                document.location='adminDashboard.php'
            </script>
        ";
    }
    else {
        echo "ERROR: $sql. "
            . mysqli_error($conn);
    }

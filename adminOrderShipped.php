<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';

    $id = intval($_GET['id']);

    $sql = "UPDATE orders 
            SET order_status = 'To be delivered'
            WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
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

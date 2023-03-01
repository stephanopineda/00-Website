<?php
    include 'connections.php';
    include 'adminRedirect.php';
    include 'sAdminRedirect.php';

    $id = intval($_GET['id']);

    $sql = "UPDATE orders 
            SET order_status = 'Received',
                date_received = CURRENT_TIMESTAMP()
            WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Order Received.');
                document.location='cart.php'
            </script>
        ";
    }
    else {
        echo "ERROR: $sql. "
            . mysqli_error($conn);
    }
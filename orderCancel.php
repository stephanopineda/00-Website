<?php
    include 'connections.php';
    include 'adminRedirect.php';
    include 'sAdminRedirect.php';

    $id = intval($_GET['id']);

    $sql = "DELETE FROM orders WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Order Cancelled.');
                document.location='orders.php'
            </script>
        ";
    }
    else {
        echo "ERROR: $sql. "
            . mysqli_error($conn);
    }
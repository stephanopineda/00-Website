<?php
    include 'connections.php';
    include 'adminRedirect.php';
    include 'sAdminRedirect.php';

    $id = intval($_GET['id']);
    $sqlItem = "SELECT quantity FROM shopping_cart WHERE id = $id";
    $item = mysqli_query($conn, $sqlItem);
    $itemRow = $item->fetch_assoc();
    $subtractedQuantity = $itemRow['quantity'] - 1;

    if ($subtractedQuantity == 0){
        $sql = "DELETE FROM shopping_cart WHERE id = $id";
    }
    else{
        $sql = "UPDATE shopping_cart 
            SET quantity = $subtractedQuantity
            WHERE id = $id";
    }
    
    if(mysqli_query($conn, $sql)) {
        echo "
            <script>
                document.location='cart.php'
            </script>
        ";
    }
    else {
        echo "ERROR: $sql. "
            . mysqli_error($conn);
    }
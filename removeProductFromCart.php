<?php
    include 'connections.php';
    include 'adminRedirect.php';
    include 'sAdminRedirect.php';

    $id = intval($_GET['id']);
    $productExists = mysqli_query($conn, "SELECT * FROM shopping_cart WHERE product_id = $id && user_id = $user_id");

    if($_SESSION["user_type"] === "user") {
        if((mysqli_num_rows($productExists) != 0)) { 
            $sql = "DELETE FROM shopping_cart WHERE product_id = $id && user_id = $user_id";

            if(mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Product Removed.');
                        document.location='cart.php'
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
                alert('Product does not exist.');
                document.location='cart.php'
            </script>
        ";
        }
    }
    else {
        echo "
            <script>
                alert('You must login first.');
                document.location='signin.php'
            </script>
        ";
    }
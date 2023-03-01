<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';

    $product_id = intval($_GET['id']);
    $user_id = $_SESSION["user_id"];

    $productExists = mysqli_query($conn, "SELECT * FROM storeContent WHERE id = $product_id");
    $productAlreadyInCart = mysqli_query($conn, "SELECT * FROM shopping_cart WHERE user_id = $user_id && product_id = $product_id");

    if($_SESSION["user_type"] === "user") {
        if((mysqli_num_rows($productExists) != 0)) { 
            if((mysqli_num_rows($productAlreadyInCart) != 0)) {
                $row = $productAlreadyInCart->fetch_assoc();
                $quantity = $row['quantity'] + 1;
                $id = $row['id'];

                $sql = "UPDATE shopping_cart 
                SET user_id = '$user_id',
                    product_id = '$product_id',
                    quantity = '$quantity',
                    date_added = CURRENT_TIMESTAMP()
                WHERE id = '$id'";

                if(mysqli_query($conn, $sql)) {
                    echo "
                        <script>
                            alert('Cart Updated.');
                            document.location='cart.php'
                        </script>
                    ";
                }
                else {
                    echo "ERROR: $sql. "
                        . mysqli_error($conn);
                }
            }
            else {
                $sql = "INSERT INTO shopping_cart(user_id, product_id, quantity, date_added)
                        VALUES ('$user_id', $product_id, 1, CURRENT_TIMESTAMP())" ;

                if(mysqli_query($conn, $sql)) {
                    echo "
                        <script>
                            alert('Added Successfully.');
                            document.location='cart.php'
                        </script>
                    ";
                }
                else {
                    echo "ERROR: $sql. "
                        . mysqli_error($conn);
                }
            }        
        }
        
        else{
            echo "
            <script>
                alert('Product does not exist.');
                document.location='products.php'
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
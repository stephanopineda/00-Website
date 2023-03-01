<?php
    include 'connections.php';
    include 'adminRedirect.php';
    include 'sAdminRedirect.php';

    // $user_id
    $sqlUserCart = "SELECT * FROM shopping_cart WHERE user_id = $user_id";
    $userCart = mysqli_query($conn, $sqlUserCart);

    if($_SESSION["user_type"] === "user") {
        if((mysqli_num_rows($userCart) != 0)) {
            while($userCartRow = $userCart->fetch_assoc()) {
                $user_id = $userCartRow['user_id'];
                $product_id = $userCartRow['product_id'];
                $quantity = $userCartRow['quantity'];
                $order_status = 'Pending';
                
                $sql = "INSERT INTO orders(user_id, product_id, quantity, date_added, order_status)
                                      VALUES ('$user_id', '$product_id', '$quantity', CURRENT_TIMESTAMP(), '$order_status')";
    
                if(mysqli_query($conn, $sql)) {
                    $sqlRemove = "DELETE FROM shopping_cart WHERE product_id = $product_id && user_id = $user_id";
                    mysqli_query($conn, $sqlRemove);
                    echo "
                        <script>
                            alert('Order Placed.');
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
                alert('Cart is empty.');
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
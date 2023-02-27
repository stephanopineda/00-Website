<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';

    $id = intval($_GET['id']);
    $productExists = mysqli_query($conn, "SELECT * FROM storeContent WHERE id = '".$id."'");

    if($_SESSION["user_type"] === "admin") {
        if((mysqli_num_rows($productExists) != 0)) { 
            $sql = "DELETE FROM storeContent WHERE id = '".$id."'";

            if(mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Product Removed.');
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
                alert('Product does not exist.');
                document.location='adminDashboard.php'
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
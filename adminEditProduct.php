<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';
?>

<html>
    <head>
        <title>Edit Product Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div>Edit Product Details</div>
        <br><br>
        <div>
            <?php
                $id = intval($_GET['id']);
                
                $query = "SELECT * FROM storeContent WHERE id = $id";
                $result = mysqli_query($conn, $query);

                $row = $result->fetch_assoc();
                $productName = $row['product_name'];
                $description = $row['description'];
                $stock = $row['stock'];
                $price = $row['price'];
                $file_name = $row['file_name'];
            ?>
            
            <form method="POST" enctype="multipart/form-data">
                id: <?php echo $id; ?><br>
                <label for = 'productName'> Product Name: </label>
                    <input type = 'text'   name = 'productName' value = '<?php echo $productName; ?>' required><br>

                <label for = 'description'> Description: </label>
                    <input type = 'text'   name = 'description' value = '<?php echo $description; ?>' required><br>

                <label for = 'stock'> Stock: </label>
                    <input type = 'text'   name = 'stock' value = '<?php echo $stock; ?>' required><br>

                <label for = 'price'> Price: </label>
                    <input type = 'text'   name = 'price' value = '<?php echo $price; ?>' required><br>

                Current Product Picture:
                    <?php echo "<img src='./images/" . $row['file_name'] . "' width = '100px'>";?><br>

                <label for = 'picture'> Change Product Picture </label>
                    <input type = 'file'   name = "image"     accept=".jpg, .jpeg, .png" /> <br>

                <input type = 'submit' name = 'edit' value = "Edit Product">                                          
                <a href="adminDashboard.php">Cancel</a>
            </form>
        </div>
        
        <!------------------------------------- Scripts ----------------------------------------->
        <script>
            // disable characters in numeric type only data
        </script>

        <?php
            if(isset($_POST["edit"])) {
                if($_SESSION["user_type"] === "admin") {
                    // Image Upload
                    if(!empty($_FILES['image']['name'])) {
                        if(isset($_FILES['image'])){
                            $errors= array();
                            $file_name = $_FILES['image']['name'];
                            $file_size =$_FILES['image']['size'];
                            $file_tmp =$_FILES['image']['tmp_name'];
                            $file_type=$_FILES['image']['type'];
                            $arrayVar = explode('.',$_FILES['image']['name']);
                            $text = end($arrayVar);
                            $file_ext=strtolower($text);
                            $extensions= array("jpeg","jpg","png");
                    
                            if(in_array($file_ext,$extensions)=== false){
                                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                            }
                    
                            if($file_size > 2097152){
                                $errors[]='File size must be excately 2 MB';
                            }
                    
                            if(empty($errors)==true){
                                move_uploaded_file($file_tmp,"images/".$file_name);
                                echo "Success";
                            }
                            else{
                                print_r($errors);
                            }
                        }
                    }

                    //SQL
                    $productName =  $_POST['productName'];
                    $stock = $_POST['stock'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];

                    $productExists = mysqli_query($conn, "SELECT * FROM storeContent WHERE id = '".$id."'");

                    if(mysqli_num_rows($productExists) >= 0) {
                        $sql = "UPDATE storeContent 
                                SET product_name = '$productName',
                                    stock = '$stock',
                                    price = '$price',
                                    description = '$description',
                                    file_name = '$file_name'
                                WHERE id = '$id'";

                        if(mysqli_query($conn, $sql)){
                            echo "
                                <script>
                                    alert('Edit Successful');
                                    document.location='adminDashboard.php'
                                </script>";
                        }
                        else {
                            echo "ERROR: $sql. " . mysqli_error($conn);
                        }
                    }
                    else{
                        echo 'Product does not exist.';
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
            }
            
            mysqli_close($conn);
        ?>
    </body>
</html>
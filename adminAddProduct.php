<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';
?>

<html>
    <head>
        <title>Add Product</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        html,body{
            position: absolute;
            text-align: center;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            border-radius: 25px;
        }

        .container{
            text-align: center;
        }
    </style>

    </head>
    <body>
        <div class="container">
            <div>Add Product</div>
            <br>
            <div>
                <form method="POST" enctype="multipart/form-data">
                    <input type = 'text'   name = 'productName' placeholder = "Product Name" required><br>
                    <input type = 'text'   name = 'stock'       placeholder = "Stock"        required><br>
                    <input type = 'text'   name = 'price'       placeholder = "Price"        required><br>
                    <input type = 'text'   name = 'description' placeholder = "Description"  required><br>
                    <label for = 'picture'> Product Picture </label>
                    <input type = 'file'   name = "image"     accept=".jpg, .jpeg, .png" />         <br>
                    <input type = 'submit' name = 'add' value = "Add Product">                                          
                    <a href="sAdminDashboard.php">Cancel</a>
                </form>
            </div>
            
            <!------------------------------------- Scripts ----------------------------------------->
            <script>
                // validate password while typing
            </script>

            <?php
                if(isset($_POST["add"])) {
                    if($_SESSION["user_type"] === "admin") {
                        // Image Upload
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
                        
                        //SQL
                        $productName =  $_POST['productName'];
                        $stock = $_POST['stock'];
                        $price = $_POST['price'];
                        $description = $_POST['description'];
                        
                        $productNameExists = mysqli_query($conn, "SELECT * FROM storeContent WHERE product_name = '".$productName."'");
                        
                        if((mysqli_num_rows($productNameExists) === 0)) { 
                            $sql = "INSERT INTO storeContent(product_name, stock, price, description, file_name)
                                VALUES ('$productName',
                                '$stock',
                                '$price',
                                '$description',
                                '$file_name')";
        
                            if(mysqli_query($conn, $sql)){
                                echo "
                                    <script>
                                        alert('Product added.');
                                        document.location='adminAddProduct.php'
                                    </script>";
                            }
                            else {
                                echo "ERROR: $sql. " . mysqli_error($conn);
                            }
                        }
                        else {
                            echo "Product already exists.";
                        }
                        mysqli_close($conn);
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
            ?>
        </div>
    </body>
</html>
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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            background-color: #c0bfb7;
        }

        .container{
            width:100%;
            border: 2pt solid black;
            padding: 15px;
            background-color: white;
        }

    </style>
    </head>
    
    <body>
        <div class="container">
            <h1>Add Product</h1>
            <div>
                <form method="POST" enctype="multipart/form-data">
                    <input type = 'text'   name = 'productName' placeholder = "Product Name" required>  <br>
                    <input type = 'text'   name = 'stock'       placeholder = "Stock"        required>  <br>
                    <input type = 'text'   name = 'price'       placeholder = "Price"        required>  <br>
                    <input type = 'text'   name = 'description' placeholder = "Description"  required>  <br>
                    <label for = 'picture'> Product Picture </label>                                    <br>
                    <input type = 'file'   name = "image"     accept=".jpg, .jpeg, .png" />             <br>
                    <a href="adminDashboard.php">Cancel</a>
                    <input type = 'submit' name = 'add' value = "Add Product">                                          
                </form>
            </div>
            
            <!------------------------------------- Scripts ----------------------------------------->
            <script>
                // disable characters in numeric type only data
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
                                move_uploaded_file($file_tmp,"uploads/".$file_name);
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
                                        document.location='adminDashboard.php'
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
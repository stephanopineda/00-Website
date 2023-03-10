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

        <style>
            html,body{
            position: absolute;
            text-align: center;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-45%, -50%);
            font-size: 25px;
            background-color: #c0bfb7;
        }

        .container{
            width:130%;
            border: 2pt solid black;
            padding: 15px;
            background-color: white;
        }
        
        label:not(#change_pic){
            float: left;
        }

        .input{
            float: right;
            width: 50%;
        }

        </style>
    </head>
    <body>
        <div class="container">
            <h1>Edit Product Details</h1>
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
                        <input type = 'text'   name = 'productName' value = '<?php echo $productName; ?>' required class="input"><br>

                    <label for = 'description'> Description: </label>
                        <input type = 'text'   name = 'description' value = '<?php echo $description; ?>' required class="input"><br>

                    <label for = 'stock'> Stock: </label>
                        <input type = 'number'   name = 'stock' value = '<?php echo $stock; ?>' required class="input"><br>

                    <label for = 'price'> Price: </label>
                        <input type = 'number'   name = 'price' value = '<?php echo $price; ?>' required class="input"><br>

                    <div>Current Product Picture:</div>
                        <?php echo "<img src='./uploads/" . $row['file_name'] . "' width = '100px'>";?><br>

                    <label for = 'picture' id="change_pic"> Change Product Picture </label>
                        <input type = 'file'   name = "image"     accept=".jpg, .jpeg, .png" /> <br>

                    <a href="adminDashboard.php">Cancel</a>
                    <input type = 'submit' name = 'edit' value = "Edit Product">                                          
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
                                    move_uploaded_file($file_tmp,"uploads/".$file_name);
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

                        if(mysqli_num_rows($productExists) != 0) {
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
        </div>
    </body>
</html>
<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'sAdminRedirect.php';
?>

<html>
    <head>
        <title>Hello <?php echo $_SESSION['first_name']; ?>!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        html,body{
            height: 100%;
            margin: 0;
        }

        .container{
            text-align: center;
        }

        .table{
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;

        }

        th, td {
            text-align: center;
            padding: 8px;
            border: 1px solid black;
            background-color: beige;
        }

        th {
            background-color: #564635;
            color: white;
        }

        #add{
            text-decoration: none;
            color: black;
            padding: 10px;
            margin-top:10px;
            border:solid 1px #564635;
            border-radius: 15px;
            height: 25px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            width: 250px;
        }

        #add:hover{
            background-color: yellow;
        }
        
    </style>

    </head>
    <body>
        <div class="container">
            <div>
                Signed in as: <?php echo $_SESSION['first_name']; ?> [ADM]
            </div>
            <div>
                <a href = 'logout.php'> Logout  </a><br><br><br>
            </div>
            <div>
                <a href = 'adminAddProduct.php' id="add"> Add Product </a> 

                <!-- View and Accept Orders -->
            </div> <br> <br>

            <?php
                $query = "SELECT * FROM storeContent";
                $result = mysqli_query($conn, $query);
                
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'PICTURE'     . "</th>
                <th>" . 'PRODUCT NAME'. "</th>
                <th>" . 'STOCK'       . "</th>
                <th>" . 'PRICE'       . "</th>
                <th>" . 'DESCRIPTION' . "</th>
                <th>" . 'ACTION'      . "</th>
                </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td><img src='./uploads/" . $row['file_name']     . "' width = '100px'></td>
                    <td>"  .  htmlspecialchars($row['product_name']) . "</td>
                    <td>"  .  htmlspecialchars($row['stock'])        . "</td>
                    <td>"  .  htmlspecialchars($row['price'])        . "</td>
                    <td>"  .  htmlspecialchars($row['description'])  . "</td>
                    <td><a href = 'adminEditProduct.php?id=".$row["id"]."' class='btnEdit'>Edit
                    <a href = 'adminRemoveProduct.php?id=".$row["id"]."' class='btnRemove'>Remove</td>";
                }
                
                echo "</table>";

                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>
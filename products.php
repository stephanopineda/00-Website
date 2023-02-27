<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Hello <?php echo $first_name; ?>!</title>
    </head>
    <body>
        <div>
            Signed in as: <?php echo $first_name; ?>
        </div>
        <div>
            <?php 
                if (isset($_SESSION["user_type"])){
                    echo "<a href = 'logout.php'> Logout  </a>";
                }
                else{
                    echo "<a href = 'signin.php'> Login   </a>
                          <a href = 'signup.php'> Sign up </a>";
                }
            ?>
        </div>
        <div>
            
        </div>

        <?php
            $query = "SELECT * FROM storeContent";
            $result = mysqli_query($conn, $query);
            $counter = 0;
            echo "<div class='grid'>";
            while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<div class='cell picture'><img src='./images/" . $row['file_name'] . "' width = '200px'></div>";
                    echo "<div class='cell name'>" . $row['product_name'] . "</div>";
                    echo "<div class='cell description'>" . $row['description'] . "</div>";
                    //echo "<div class='cell'>" . $row['stock'] . "</div>";
                    //echo "<div class='cell'>" . $row['price'] . "</div>";
                    echo "<div class='cell cart'><a href = 'toCart.php?id=".$row["id"]."' class='toCart'>Add to Cart</a></div>";
                    $counter++;
                    if ($counter % 3 == 0) {
                        echo '<div class="clearfix"></div>';
                    }
                    echo "</div>";
            }
            echo "</div>";
        ?>

        <style>
            .grid {
                display: grid;
                grid-template-rows: repeat(2, auto);
                grid-template-columns: repeat(3, 1fr);
                grid-column-gap: 10px;
                max-width: 80%;
                background-color: #eee;
                padding: 0px;
                box-sizing: border-box;
            }
            .product{
                display: grid;
                padding: 2%;
                width: 100%;
            }
            .cell {
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                background-color: #fff;
                border: 1px solid #ddd;
                padding: 5px;
                box-sizing: border-box;
                width: 100%;
            }
            .picture {
            grid-row: 1 / 2;
            }

            .name {
            grid-row: 2 / 3;
            }

            .description {
            grid-row: 3 / 4;
            }

            .clearfix {
                clear: both;
            }
        </style>
    </body>
</html>
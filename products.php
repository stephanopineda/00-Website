<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
    include 'userNavBar.php';
?>

<html>
    <head>
        <title>Hello <?php echo $first_name; ?>!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #c0bfb7;
        }

        .container_prod{
            text-align: center;
            border: 2px solid black;
        }

        #header_img{
            position: relative;
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        #signed_as{
            font-size: 15px;
            text-decoration:none;
            padding: 8px;
            background-color: #564635;
            border-radius: 25px;
            color: white;
            z-index: 1;
        }

        .name{
            color: #c1a98d;
        }

        .in_txt_container{
            position: absolute;
            right: 400px;
            top: 200px;
            padding: 10px;
            width: 250px;
        }

        #logout{
            text-decoration: none;
        }

        p{
            margin-left: 350px;
            margin-right: 350px;
            font-family: 'Gabriola',cursive;
            font-size: 25px;
        }

        .grid {
                display: grid;
                grid-template-rows: repeat(2, auto);
                grid-template-columns: repeat(3, 1fr);
                grid-column-gap: 10px;
                max-width: 80%;
                background-color: #c0bfb7;
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

    </head>
    <body>
        <div class="container_prod">                                                                     <br>
            <div id="header_img">
                <img src="images/header_img.jpg" alt="header_img">
                <div class="in_txt_container">

                    <div id="signed_as">
                        SIGNED IN AS: <span class="name"><?php echo $first_name; ?></span>
                    </div>     

                    <div>
                    <?php 
                        if (isset($_SESSION["user_type"])){
                            echo "<a href = 'logout.php' id=logout> Logout  </a>";
                        }
                        else{
                            echo "<a href = 'signin.php'> Login   </a>
                                <a href = 'signup.php'> Sign up </a>";
                        }
                    ?>  
                    </div>

                </div>
            </div>
            <div class="heading_container">
                <h1>Epiphany Scents</h1>
                    <p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
                        Nowadays, consumers can buy online via websites, applications, and more with the aid
                        of the internet. The client wants his business to maximize online transactions before investing in a
                        physical shop. Products can now be promoted and advertised using good visuals and various
                        compelling features that help the business persuade its consumers effectively. 
                    <p>
                
            </div>
            <h1>New Arrival<h1>

            <?php
                $query = "SELECT * FROM storeContent";
                $result = mysqli_query($conn, $query);
                $counter = 0;
                echo "<div class='grid'>";
                while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<div class='cell picture'><img src='./uploads/" . $row['file_name'] . "' width = '200px'></div>";
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
        </div>
    </body>
</html>
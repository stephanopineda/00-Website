<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
    include 'userNavBar.php';
?>

<html>
    <head>
        <title>Products</title>
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
            border-top:none;
        }

        #header_img{
            position: relative;
        }

        #signed_as{
            font-size: 15px;
            padding: 8px;
            background-color: #564635;
            border-radius: 25px;
            color: white;
        }

        .name{
            color: #c1a98d;
        }

        .in_txt_container{
            position: absolute;
            right: 27%;
            top: 73%;
            width: 18%;
        }

        .heading_btns{
            text-decoration: none;
            color:#fff;
        }

        .heading_btns:hover{
            text-decoration: underline;
        }
        
        #signin{
            float:left;
            margin-left: 25%;
        }

        #signup{
            float: right;
            margin-right: 25%;
        }

        p{
            margin-left: 350px;
            margin-right: 350px;
            font-family: 'Gabriola',cursive;
            font-size: 25px;
        }

        #new{
            width: 100%;
            background-color: #564635;
            color: white;
            padding-top: 10px;
            padding-bottom: 10px;
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
            margin-left: auto;
            margin-right: auto;
            }

        .product{
            display: grid;
            padding: 2%;
            width: 100%;
            transition: transform .1s;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }

        .product:hover{
            transform: scale(1.2);
        }

        #desc{
            font-style: italic;
        }
        
        #prodname{
            text-transform: uppercase;
            color: #564635;
        }

        #addtocart{
            color: #c1a98d;
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

        .footer{
            width: 100%;
            height: 30%;
        }

        @media only screen and (max-width: 700px) {
            #header_img{
                position: absolute;
                top:0;
            }
            .container_prod{
                border: none;
            }
            .head{
                margin-top: 38%;
            }
            p{
                margin: 0;
            }
            .grid {
                display: grid;
                grid-template-rows: repeat(2, auto);
                grid-template-columns: repeat(1, 1fr);
            }
            #img{
                width: 100%;
            }
            .in_txt_container{
            position: absolute;
            right: 20%;
            top: 70%;
            width: 18%;
        }
        }

    </style>

    </head>
    <body>
        <div class="container_prod">                                                                     <br>
            <div id="header_img">
                <img src="images/header_img.jpg" alt="header_img" id="img">
                <div class="in_txt_container">
                    <div id="signed_as">
                        SIGNED IN AS: <span class="name"><?php echo $first_name; ?></span>
                    </div>     

                    <div>
                    <?php 
                        if (isset($_SESSION["user_type"])){
                            echo "<a href = 'logout.php' class=heading_btns id=logout>  LOGOUT  </a>";
                        }
                        else{
                            echo "<a href = 'signin.php' class=heading_btns id=signin>  LOGIN   </a>
                                  <a href = 'signup.php' class=heading_btns id=signup>  SIGN UP </a>";
                        }
                    ?>  
                    </div>

                </div>
            </div>
            <div class="heading_container">
                <h1 class="head">Epiphany Scents</h1>
                    <p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
                        Nowadays, consumers can buy online via websites, applications, and more with the aid
                        of the internet. The client wants his business to maximize online transactions before investing in a
                        physical shop. Products can now be promoted and advertised using good visuals and various
                        compelling features that help the business persuade its consumers effectively. 
                    <p>
                
            </div>
            <h1 id="new">NEW ARRIVAL<h1>

            <?php
                $query = "SELECT * FROM storeContent";
                $result = mysqli_query($conn, $query);
                $counter = 0;
                echo "<div class='grid'>";
                while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<div class='cell picture'><img src='./uploads/" . $row['file_name'] . "' width = '200px'></div>";
                        echo "<div class='cell name' id='prodname'>" . $row['product_name'] . "</div>";
                        echo "<div class='cell description' id='desc'>" . $row['description'] . "</div>";
                        echo "<div class='cell'>" . $row['stock'] . "</div>";
                        echo "<div class='cell'>" . $row['price'] . "</div>";
                        echo "<div class='cell cart'><a href = 'userAddToCart.php?id=".$row['id']."' class='cart'>Add to Cart</a></div>";
                        $counter++;
                        if ($counter % 3 == 0) {
                            echo '<div class="clearfix"></div>';
                        }
                        echo "</div>";
                }
                echo "</div>";
            ?>
        </div>
        <img src=images/footer.png alt=footer class="footer">
    </body>
</html>
<html>
    <head>
        <style>
            .container_nav{
                position: sticky;
                top:0;
                padding: 20px;
                background-color: #c1a98d;
                display: flex;
                justify-content: space-between;
                border: 2px solid black;
                opacity: .90;
                z-index: 500;
            }
            .container_nav a{
                text-decoration: none;
                color: black;
                width: 100%;
                text-align: center;
                font-size: 25px;
            }

            .container_nav a:hover{
                background-color: white;
                font-weight: bold;
            }

            #index,#products,#cart,#history{
                border-right: 2px solid black;
            }

            .mobile_nav button {
                margin: 15px;
                position: absolute;
                visibility: hidden;
                width: 35px;
                height: 35px;
                outline: none;
                border: none;
                background-image: url(images/menu.png);
                background-size: cover;
                background-repeat: no-repeat;
                background-color: transparent;
            }

            .mobile_nav button:hover{
                border: 2pt solid white;
                
                padding: 10px;
            }

            .overlay {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1000;
                top: 0;
                left: 0;
                background-color: gray;
                overflow-x: hidden;
                transition: 0.5s;
                opacity: .95;
            }

            .overlay a.closebtn {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 50px;
                height: 50px;
                border: 1px solid #fff;
                border-radius: 100%;
                background-color: #fff;
                font-size: 40px;
                color: #000;
                position: absolute;
                top: 20px;
                right: 20px;
            }

            .overlay-content {
                position: relative;
                top: 10%;
                width: 100%;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .overlay-content a {
                width: 40%;
                text-decoration: none;
                font-size: 22px;
                color: #f1f1f1;
                display: block;
                transition: 0.3s;
                padding: 10px 20px;
                margin: 15px 0;
                text-decoration: none;
                font-size: 22px;
                color: #313232;
                display: block;
                transition: 0.3s;
                border: 1px solid #fff;
                color: #fff;
                background-color: transparent;

                z-index: 99;
            }

            .overlay-content a:hover {
                background-color: #fff;
                border: 1px solid transparent;
            }

            
        @media only screen and (max-width: 700px) {
        .container_nav {
            display: none;
            }
        .mobile_nav button{
            visibility: visible;
            position: absolute;
            
            z-index: 100;
        }
        }
        </style>
    </head>

    <body>
        <div class="mobile_nav">
                <button onclick="openNav()"></button>					<!-- # menu overlay # -->
        </div>
        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
                <a href="index.php">HOME</a>
                <a href="products.php">PRODUCTS</a>
                <a href="cart.php">MY CART</a>
                <a href="orders.php">ORDERS</a>
                <a href="history.php">HISTORY</a>
                <a href="https://epiphany-scents.carrd.co/ target=_blank id=about_us">ABOUT US</a>					
            </div>
        </div>
    </body>
    <script>
        function openNav() {
        document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
        document.getElementById("myNav").style.width = "0%";
        }
  </script>
</html>

<?php
	echo "<div class=container_nav>
            <a href = 'index.php'    id=index>HOME     </a>
            <a href = 'products.php' id=products>PRODUCTS </a>
            <a href = 'cart.php'     id=cart>MY CART  </a>
            <a href = 'orders.php'   id=cart>ORDERS  </a>
            <a href = 'history.php'  id=history>HISTORY  </a>
            <a href = 'https://epiphany-scents.carrd.co/'  target=_blank id=about_us>ABOUT US </a>
            </div>";

    // if (isset($_SESSION["email"])){
    //     echo "<a href = 'profile.php'> Profile  </a>";
    // }
    
    
    
          
	
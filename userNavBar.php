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
                z-index: 100;
                opacity: .90;
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
        </style>
    </head>
</html>

<?php
	echo "<div class=container_nav>
            <a href = 'index.php'    id=index>Home     </a>
            <a href = 'products.php' id=products>Products </a>
            <a href = 'cart.php'     id=cart>My Cart  </a>
            <a href = 'history.php'  id=history>History  </a>
            <a href = 'https://epiphany-scents.carrd.co/'  target=_blank id=about_us>About Us </a>
            </div>";

    // if (isset($_SESSION["email"])){
    //     echo "<a href = 'profile.php'> Profile  </a>";
    // }
    
    
    
          
	
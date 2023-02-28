<html>
    <head>
        <style>
            .container{
                padding: 35px;
                background-color: #c1a98d;
                display: flex;
                justify-content: space-between;
            }
            .container a{
                background-color: #564635;
                color:white;
                font-size: 15px;
                
            }
        </style>
    </head>
</html>

<?php
	echo "<div class=container>
            <a href = 'index.php'   >Home     </a>
            <a href = 'products.php'>Products </a>
            <a href = 'cart.php'    >My Cart  </a>
            <a href = 'history.php' >History  </a>
            <a href = 'aboutUs.php' >About Us </a>
            </div>";

    // if (isset($_SESSION["email"])){
    //     echo "<a href = 'profile.php'> Profile  </a>";
    // }
    
    
    
          
	
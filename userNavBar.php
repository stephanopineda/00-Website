<?php
	echo "<a href = 'index.php'   >Home     </a>
          <a href = 'products.php'>Products </a>
          <a href = 'cart.php'    >My Cart  </a>
          <a href = 'history.php' >History  </a>
          <a href = 'aboutUs.php' >About Us </a>";

    if (isset($_SESSION["email"])){
        echo "<a href = 'profile.php'> Profile  </a>";
    }
    
          
	
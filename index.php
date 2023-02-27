<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
    include 'userNavBar.php';
?>

<html>
    <head>
        <title>Epiphany</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #c0bfb7;
        }

        .bg1{
            position: relative;
            background-image: url("images/bg1.jpg");
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .btn_container{
            font-size: 18px;
        }

        a{
            text-decoration:none;
            color: black;
            margin-right: 35px;
            padding: 6px;
            background-color: white;
            border-radius: 25px;
            border: 2px solid black;
        }

        a:hover{
            background-color: yellow;
        }

        .signed_as{
            color:white;
            font-size: 15px;
            margin-top:5px;
            margin-left: -25px;
        }

        .btn_and_signas_container{
            position: absolute;
            bottom:5px;
            right: 535px;
        }
    </style>    

    </head>
    <body>
        <div class="bg1">
            <div class=btn_and_signas_container>
                <div class=btn_container>
                    <?php 
                    if (isset($_SESSION["user_type"])){
                        echo "<a href = 'logout.php' class = logout> LOGOUT  </a>";
                    }
                    else
                    {
                        echo "<a href = 'signin.php' class = signin > LOGIN   </a>
                            <a href = 'signup.php' class = signup> SIGN UP </a>";
                    }
                    ?>
                    <div class="signed_as">
                        Signed in as: <u><?php echo $first_name; ?></u>
                    </div>
                </div>
        </div>
    </body>
</html>
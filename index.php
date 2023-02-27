<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'sAdminRedirect.php';
    include 'adminRedirect.php';
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
            background-image: url("images/bg1.jpg");
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .btn_container{
            position: fixed;
            display: inline-block;
            bottom: 30px;
            right: 550px;
            font-size: 18px;
        }

        a{
            text-decoration:none;
            color: black;
            margin-right: 35px;
            padding: 4px;
            background-color: white;
            border-radius: 25px;
            border: 2px solid black;
        }

        a:hover{
            background-color: #c1a98d;
        }

        .signed_as{
            position: fixed;
            color:white;
            font-size: 15px;
            margin-top:2px;
            margin-left: -15px;

        }
    </style>    

    </head>
    <body>
        <div class="bg1">
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
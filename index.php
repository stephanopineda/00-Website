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
            background-image: url("images/bg1.png");
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;

        }

        .btn_container{

        }

        a{
            text-decoration:none;
            color: black;
            
            padding: 20px;
            background-color: white;
            border-radius: 25px;
            border: 2px solid black;
        }

        a:hover{
            background-color: yellow;
        }

        .btn_and_signas_container{
            position: absolute;
            bottom:210px;
            right: 180px;
            width: 500px;
            height: 10%;

        }

        .signed_as{
            position: absolute;
            color:white;
            font-size: 20px;
            margin-left: 35%;
            margin-top: 120px;

        }

        .signin{
            float:right;
            margin-right: 100px;
        }
        
        .signup{
            float:left;
            margin-left: 100px;
        }

        .logout{
            position: absolute;
            right: 185px;
        }
    </style>    

    </head>
    <body>
        <div class="bg1">
            <div class=btn_and_signas_container>
                <div class=btn_container>
                    <?php
                    if (isset($_SESSION["user_type"])){
                        $email = $_SESSION["email"];
                        $query = "SELECT id FROM registeredUsers WHERE email = '".$email."'";
                        $result = mysqli_query($conn, $query);
                        $row = $result->fetch_assoc();

                        echo "<a href = 'logout.php' class = logout> LOGOUT  </a>";
                        echo "<div class='signed_as'>
                        Signed in as: <u><a href = 'profile.php?id=".$row["id"]."' class='profile'>".$first_name."</a></u>
                        </div>";
                    }
                    else
                    {
                        echo "<a href = 'signin.php' class = signin> LOGIN   </a>
                              <a href = 'signup.php' class = signup> SIGN UP </a>";
                    }
                    ?>
                    
                </div>
        </div>
    </body>
</html>
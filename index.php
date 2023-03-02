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
            background-size: 100% 100%;
            border: 2px solid black;
            border-top: none;
        }

        .logout,.signin,.signup{
            padding: 30px;
        }

        a:not(#name){
            text-decoration:none;
            color: black;
            background-color: #c1a98d;
        }

        a:hover:not(#name){
            background-color: white;
        }

        #name{
            text-decoration: none;
            font-size: 20px;
            color: white;
        }

        #name:hover{
            color: #564635;
        }

        .btn_and_signas_container{
            position: absolute;
            bottom:210px;
            right: 150px;
            width: 500px;
            height: 10%;
            font-size: 1.2em;
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
            border-radius: 25px;
            border: 2px solid #564635;
        }
        
        .signup{
            float:left;
            margin-left: 100px;
            border-radius: 25px;
            border: 2px solid #564635;
        }

        .logout{
            position: absolute;
            right: 185px;
            border-radius: 25px;
            border: 2px solid #564635;
        }

        .footer{
            width: 100%;
            height: 30%;
        }
    </style>    

    </head>
    <body>
        <div class="bg1">
            <div class=btn_and_signas_container>
                <div>
                    <?php
                    if (isset($_SESSION["user_type"])){
                        $email = $_SESSION["email"];
                        $query = "SELECT id FROM registeredUsers WHERE email = '".$email."'";
                        $result = mysqli_query($conn, $query);
                        $row = $result->fetch_assoc();

                        echo "<a href = 'logout.php' class = logout> LOGOUT  </a>";
                        echo "<div class='signed_as'>
                        Signed in as: <u><a href = 'profile.php? id=".$row["id"]."' class='profile' id=name>".$first_name."</a></u>
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
        </div>
        <img src=images/footer.png alt=footer class="footer">
    </body>
</html>
<!DOCTYPE html>
<?php
    include 'connections.php';
    include 'userRedirect.php';
    include 'adminRedirect.php';
?>

<html>
    <head>
        <title>Admin Accounts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
        html,body{
            height: 100%;
            margin: 0;

        }

        .container{
            text-align: center;
        }

        .table{
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;

        }

        th, td {
            text-align: center;
            padding: 8px;
            border: 1px solid black;
        }

        th {
            background-color: #dddddd;
        }

        #btn1,#btn2,#btn3{
            text-decoration: none;
            color: black;
            padding: 10px;
            border:solid 1px #564635;
            border-radius: 15px;
            height: 25px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }

        #btn1:hover,#btn2:hover,#btn3:hover{
            background-color: yellow;
        }
        
    </style>

    </head>
    <body>
        <div class="container">
            <div>
                Signed in as: <?php echo $_SESSION['first_name']; ?>
            </div>
            <div>
                <a href = 'logout.php'> Logout  </a><br><br><br>
            </div>
            <div>
                <a href = 'sAdminCreate.php' id="btn1"> Create admin account  </a><br><br><br>
                <a href = 'sAdminUpdate.php' id="btn2"> Update admin account  </a><br><br><br>
                <a href = 'sAdminRemove.php' id="btn3"> Remove admin account  </a><br><br><br>
            </div>
            <!------------------------------------- Scripts ----------------------------------------->
            <?php
                $query = "SELECT * FROM registeredUsers WHERE user_type = 'admin'";
                $result = mysqli_query($conn, $query);
                echo "<table class=table>";
                echo "<tr>
                <th>" . 'first_name'        . "</th>
                <th>" . 'last_name'         . "</th>
                <th>" . 'username'          . "</th>
                <th>" . 'email'             . "</th>
                <th>" . 'date_registered'   . "</th>
                <th>" . 'user_type'         . "</th>
                </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($row['first_name'])        . "</td>
                    <td>" . htmlspecialchars($row['last_name'])         . "</td>
                    <td>" . htmlspecialchars($row['username'])          . "</td>
                    <td>" . htmlspecialchars($row['email'])             . "</td>
                    <td>" . htmlspecialchars($row['date_registered'])   . "</td>
                    <td>" . htmlspecialchars($row['user_type'])         . "</td>
                    </tr>";
                }
                echo "</table>";

                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>
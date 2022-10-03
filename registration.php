<!DOCTYPE html>
<html>
    <head>
        <style>
            *{
                margin:0px;
                padding:0px;
            }
            #main{
                
                width:250px;
                margin:24px auto; 
                padding:10px;
            }
            
        </style>
    </head>
    <body>
        <?php 


            require_once("connection.php");

            if(isset($_POST['register'])){
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $user_name = $_POST['user_name'];
                $password = $_POST['password'];
                if($first_name != "" and $last_name != "" and $user_name = !"" and $password != ""){
                    $q = "INSERT INTO `user`(`id`,`first_name`,`last_name`,`user_name`,`password`)
                    VALUES('','".$first_name."','".$last_name."','".$user_name."','".$password."')
                    ";
                    if(mysqli_query($conn, $q)){
                        echo "<script>alert('You\'re successfully registered ')</script>";
                    }else{
                        echo $q;
                    }
                }else{
                    echo "<script>alert('Please fill all the boxes')</script>";
                }
            }
        ?>
        <div id = "main">
            <h2 align="center">Registration Form</h2>
            <hr><br><br>
            <form method="POST">
                First Name:<br>
                <input type="text" name="first_name" placeholder="First Name">
                <br><br>
                Last Name:<br>
                <input type="text" name="last_name" placeholder="Last Name">
                <br><br>
                User Name:<br>
                <input type="text" name="user_name" placeholder="User Name">
                <br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Password"><br><br>
                <input type="submit" name="register" value="Register">
            </form>
        </div>
    </body>
</html>
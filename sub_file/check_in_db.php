<?php

    require_once("../connection.php");  

    if(isset($_POST['user'])){

        $q = 'SELECT * FROM `users` WHERE `uidUsers` = "'.$_POST['user'].'"';
        $r = mysqli_query($conn, $q);

        if($r){
            if(mysqli_num_rows($r) > 0){
                //it means the user is in database
                while($row = mysqli_fetch_assoc($r)){
                    $user_name = $row['uidUsers'];  

                    //show users
                    echo '<option value = "'.$user_name.'">';
                }
             }else{
                echo '<option value = "no user">';
            }
        }else{
            echo $q;
        }
    }

?>
<?php
require_once ("../connection.php");
if(isset($_POST['user']) && !empty($_POST['user'])) {

    $q = 'SELECT * FROM `users` WHERE `uidUsers`= "'.$_POST['user'].'"';
    $r = mysqli_query($conn, $q);

    if($r){
        if(mysqli_num_rows($r) > 0){
            
            //user already exist
            echo '<p style="color:red">User already registered</p>';
        }else{
            echo '<p style="color:green">You can take this name</p>';
        }
    }else{
        echo $q;
    }
}
?>
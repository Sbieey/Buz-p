<?php

    session_start();
    require_once("../connection.php");
    if(isset($_SESSION['userUid']) and isset($_GET['user'])){
        if(isset($_POST['text'])){
            //now check for empty message
            if($_POST['text'] !=''){
            //now from here we can insert data into the database
                $sender_name = $_SESSION['userUid'];
                $receiver_name = $_GET['user'];
                $message = $_POST['text'];
                $date = date("Y-m-d :h:i:sa");

                $q  = 'INSERT INTO `messages`(`id`,`sender_name`,`receiver_name`,
                `message_text`,`date_time`)
                VALUES("","'.$sender_name.'","'.$receiver_name.'","'.$message.'","'.$date.'")';
                 $r = mysqli_query($conn, $q);

                if($r){
                    //message sent
                    ?>
                        <div class="grey-message">
                            <a href="#">Me</a>
                            <p><?php echo $message; ?></p>
                        </div>
                     <?php
                }else{
                    //problem in query
                    echo $q;
                }

            }else{
                echo 'Please write something first';
            }

        }else{
            echo 'Problem with text';
        }
    }else{
        echo 'Please login or select user to send message';
    }

?>
<div id="left-col-container">
<div onclick="document.getElementById('new-message').style.display='block'" class="white-back">
		<p align="center" style=" padding:10px; cursor:pointer;">New Message</p>
</div>


<?php

    $q= 'SELECT DISTINCT `receiver_name`, `sender_name`
    FROM `messages` WHERE
    `sender_name`="'.$_SESSION['userUid'].'" OR
    `receiver_name`="'.$_SESSION['userUid'].'"
    ORDER BY `date_time` DESC';

    $r = mysqli_query($conn,$q);
    if($r){
        if(mysqli_num_rows($r)>0){

            $counter = 0;
            $added_user = array();

            while($row = mysqli_fetch_assoc($r)){
                $sender_name = $row['sender_name'];
                $receiver_name = $row['receiver_name'];

                if($_SESSION['userUid'] == $sender_name){
                    // add the receiver but only once
                    //so to do that check the user in array
                    if(in_array($receiver_name, $added_user)){
                        //dont add receiver_name
                        //because its already existing
                    }else{
                        //add the receiver name
                        ?><div class="grey-back">
                        <img src="images/profile3.jpg" class="image">
                        <?php echo '<a href="?user='.$receiver_name.'">'.$receiver_name.'</a>';?>
                    </div>
                    <?php
                    //as the receiver name is added so
                    //add it to the as well
                    $added_user = array($counter => $receiver_name);
                        //increment the counter
                        $counter++;

                    }
                }elseif($_SESSION['userUid'] == $receiver_name){
                    // add the sender_name but only once
                    //so to do that check the user in array
                    if(in_array($sender_name, $added_user)){
                        //dont add the sender_name
                        //because its already existing
                    }else{
                        //add the sender_name name
                        ?><div class="grey-back">
                        <img src="images/profile.png" class="image">
                        <?php echo '<a href="?user='.$sender_name.'">'.$sender_name.'</a>';?>
                    </div>
                    <?php
                    //as the sender_name is added so
                    //add it to the as well
                    $added_user = array($counter => $sender_name);
                        //increment the counter
                        $counter++;

                    }
                }
            }
        }else{
            //no message sent
            echo 'no user';
        }
    }else{
        //query problem
        echo $q;
    }


?>





</div>

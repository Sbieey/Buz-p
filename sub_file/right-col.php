
<div id="right-col-container">
		<div id="messages-container">
        <?php

        $no_message = false;

        if(isset($_GET['user'])){
            $_GET['user'] = $_GET['user'];
        }else{
            //user var is not in the URL bar
            //so select the last user, ypu have sent messsage

            $q = 'SELECT `sender_name`, `receiver_name` FROM `messages`
            WHERE `sender_name` = "'.$_SESSION['userUid'].'"
            or `receiver_name` = "'.$_SESSION['userUid'].'"
            ORDER BY `date_time` DESC LIMIT 1';

            $r = mysqli_query($conn, $q);
            if($r){
                if(mysqli_num_rows($r) > 0){
                    while($row = mysqli_fetch_assoc($r)){
                        $sender_name = $row['sender_name'];
                        $receiver_name = $row['receiver_name'];

                        if($_SESSION['userUid'] == $sender_name){
                            $_GET['user'] = $receiver_name;
                        }else{
                            $_GET['user'] = $sender_name;
                        }
                    }
                }else{
                    //This user havnt send any message
                    echo 'No message from you';

                    $no_message = true;
                }
            }else{
                //query problem
                echo $q;
            }
        }

            if($no_message == false){
            $q = 'SELECT * FROM `messages` WHERE
                `sender_name` = "'.$_SESSION['userUid'].'"
                AND `receiver_name` = "'.$_GET['user'].'"
                OR
                `sender_name` = "'.$_GET['user'].'"
                AND `receiver_name` = "'.$_SESSION['userUid'].'" ';
            $r = mysqli_query($conn, $q);
            if($r){
                //query seccessful
                while($row = mysqli_fetch_assoc($r)){
                    $sender_name = $row['sender_name'];
                    $receiver_name = $row['receiver_name'];
                    $message = $row['message_text'];
                    //$date = $row['date_time']
                    //check who message
                    if($sender_name == $_SESSION['userUid']){
                        //show the message with grey background
                     ?>
                        <div class="grey-message">
							<img src="images/profile2.png" class="image">
                            <a href="#" style="font-size:15px; color:black;font:bold;"><i>Me</i></a>
                            <p style="color:black; padding:5px;font-size:15px;"><b><?php echo $message; ?></b></p>
                        </div>
                     <?php
                    }else{
                        //show the message with white background
                        ?>
                        <div class="white-message">
													<img src="images/profile3.jpg" class="image">
                            <a href="#" style="font-size:15px; color:white;"><i><?php echo $sender_name ; ?></i></a>
                            <p style="padding:5px; font-size:14px;"><?php echo $message ; ?></p>
                         </div>
                        <?php
                    }
                }
            }else{
                //query problem
                echo $q;
            }
            //end of no message
        }

        ?>
        <!--end of message-container-->
        </div>
        <form method="POST" id="message-form">
             <textarea class="textarea" id="message_text" placeholder="Write your messages here.."></textarea>
        </form>
        <!--end of right-col-container-->
        </div>

<script src="sub_file/jquery-3.4.1.min.js"></script>
<script>
function sendMsg(send){
			var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("container").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "sub_file/sending_process.php?q=" + send, true);
            xmlhttp.send();
        }
    $("document").ready(function(event){

        //now if the form is submitted
        $("#right-col-container").on('submit','#message-form',function sendMsg(send){
            //take data from textarea
            var message_text = $("#message_text").val();
            //send the data to sending_process.php file
            $.post("sub_file/sending_process.php?user=<?php echo $_GET['user'];?>",{
                 text : message_text,
            },
            //in return we'll get
            function(data,status){
                //firstly remove the text from message_text
                $("#message_text").val("");

                //now add the data inside the message container
                document.getElementById('messages-container').innerHTML += data;
            }

            );
        });

        //if any button is clicked inside
        //right-col-container
        $("#right-col-container").keypress(function(e){
            //as we will submt the form with enter button so
            if(e.keyCode == 13 && !e.shiftKey){
                //it means enter is clicked without shift key
                // so submit the form
                $("#message-form").submit();
            }
        });

    });
</script>

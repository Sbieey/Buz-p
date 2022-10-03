<div id="new-message">
    <p class="m-header">New Message</p>
    <p class="m-body">
      <form align="center" method="post">
        <input type="text" list="user" onkeyup="check_in_db()" class="message-input"
         placeholder="user_name" name="user_name" id="user_name" />
        <!--rhix datalist will show available user-->
        <datalist id="user"></datalist>
        <br><br>
        <textarea class="message-input" name="message" placeholder="write your message"></textarea><br><br>
        <input type="submit" value="send" id="send" name="send" />
        <button onclick="document.getElementById('new-message').style.display='none'">Cancel</button><br><br>
    </form>
    </p>
    <p class="m-footer">Click send to send</p>
<!-- end of new -message-->
</div>

<?php
     //error_reporting(E_ALL);
    require_once("connection.php");

    if(isset($_POST['send']) && $_SESSION['userUid'] !== $_POST['user_name']){
        $sender_name = $_SESSION['userUid'];
        $receiver_name = $_POST['user_name'];
        $message = $_POST['message'];
        $date = date("Y-m-d h:i:sa");

        $q  = 'INSERT INTO `messages`(`id`,`sender_name`,`receiver_name`,`message_text`,`date_time`)
        VALUES("","'.$sender_name.'","'.$receiver_name.'","'.$message.'","'.$date.'")';

        $r = mysqli_query($conn, $q);

        if($r){
            //message sent
            header("location:index.php?user=".$receiver_name);
        }else{
            //query problem
            echo $q;
        }
    }else{
        echo'';
    }
?>



<script src="sub_file/jquery-3.4.1.min.js"></script>
<script>
    //it will disable the send button as well
    //when the page refresh
    document.getElementById('send').disabled = true;

    function check_in_db(){
        var user_name = document.getElementById("user_name").value;
        //send this user_name to another file check_in_db.php
        $.post("sub_file/check_in_db.php",
        {
            user: user_name
        },
        //we'll receive this data from check_in_db.php file
        function(data,status){
            //alert(data);
            if(data == '<option value = "no user">'){
                document.getElementById('send').disabled = true;
            }else{
                document.getElementById('send').disabled = false;
            }
            document.getElementById('user').innerHTML = data;
        }
        );
    }
</script>
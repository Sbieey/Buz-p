<?php

if (isset($_POST['signup-submit'])) {
	
   require 'dbh.inc.php';

   $first = mysqli_real_escape_string($conn, $_POST['first']);
   $last = mysqli_real_escape_string($conn, $_POST['last']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $uid = mysqli_real_escape_string($conn, $_POST['uid']);
   $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
   $PasswordRepeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);


   //Error handlers
    //check 4 empty fields
       if (empty($first)  || empty($last) || empty($email) || empty($uid) || empty($pwd) || empty($PasswordRepeat)) {
   	       header("Location: ../signup.php?error=emptyfields&first".$first."&last".$last."&email".$email."&uid".$uid);
           exit();
        } 
       elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$uid)){
        header("Location: ../signup.php?error=invalid-EmailUid&first".$first."&last".$last);
        }
       else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //check if email is valid
          header("Location: ../signup.php?error=invalid-Email&first".$first."&last".$last."&uid".$uid);
          exit();
         } 
       else if(!preg_match("/^[a-zA-Z0-9]*$/",$uid)){
          header("Location: ../signup.php?error=inavliduid&first".$first."&last".$last."&email".$email);
         } 
       elseif($pwd !== $PasswordRepeat){
        header("Location: ../signup.php?error=passwordcheck&first".$first."&last".$last."&email".$email."&uid".$uid);
       }
       else {
   	   	 // verify if username exist
           $sql = "SELECT uidUsers FROM users WHERE uidUsers = ?";
           $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerrorrr");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
              header("Location: ../signup.php?error=usertaken&first".$first."&last".$last."&email".$email);
              exit();
              
            }
            else {
              $sql = "INSERT INTO `users` (firstname, lastname, uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
             
                header("Location: ../signup.php?error=sqlerror");
                exit();
  
              }
             else{
               	// hashing the passsword
           	$hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
             //Insert the user into the database

             
             mysqli_stmt_bind_param($stmt, "sssss", $first,$last,$uid,$email,$hashedPwd);
             mysqli_stmt_execute($stmt);
            
             header("Location: ../signup.php?signup=success");
             exit();

              }  
            } 
          }
         }
         
         mysqli_stmt_close($stmt);
         mysqli_close($conn);

        }

    else {
	    header("Location: ../signup.php");
	  exit();
}
?>
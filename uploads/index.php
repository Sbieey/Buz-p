<?php
    session_start();
    require('header.php');
    include_once 'dbh.php';
?>
	<section class="main-container">

<!DOCTYPE html>
<html>
<head>
	<style>
	<?php require_once("sub_file/style.css");	?>
	</style>
</head>
<body>
    <?php
    require "dbh.php";
    require "core.inc.php";

      $firstname = getuserfield('firstname');
      $lastname = getuserfield('lastname');
      $username = getuserfield('uidUsers');

      $query = "SELECT * FROM `users` WHERE `username` = '$username'";
      $query_run = mysqli_query($conn,$query);

      while($row = mysqli_fetch_assoc($query_run)){
          $firstname = $row['firstname'];
          $lastname= $row['lastname'];
          $email = $row['emailUsers'];
          $user = $row['uidUsers'];
          ?>
          <div id="middle">
          <div id="left">
              <div class="post">
                  <div class="title"><?php echo $firstname.' '.$lastname;?></div>
                  <div class="description">
                      <b>Firstnme</b> <?php echo $firstname.'<br><br>'; ?>
                      <b>Lastname</b> <?php echo $lastname'<br><br>'; ?>
                      <b>Username: </b><?php echo $user.'<br><br>'; ?>
                     <b>Email: </b><?php echo $email.'<br><br>';?>

                  </div>
              </div>
              <img> </img>
              <?php
      }

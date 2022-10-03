<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<meta name="description" connec>
	
	<style>
		
	</style>
</head>
<body> 
<header>
     <nav>
     	<div class="main-wrapper">
     		<ul>
     			<li><a href="index.php">Home</a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
     		</ul>
     		<div class="nav-login">	
				 <?php 
				 	if(isset($_SESSION['userId'])){
						echo '<form action="includes/logout.inc.php" method="POST" >	
						
						<button type="submit" name="logout-submit">Logout</button>
					</form>';	
					echo '<a href="upload.php">Profile</a>';	
					}else{
						if(isset($_GET['error'])){
							if($_GET['error'] =="emptyfields"){
							echo "<script>alert('Fill all the fields')</script>";
							}elseif ($_GET['error'] =="wrongpwd") {
								echo "<script>alert('Wrong password')</script>";
							}elseif($_GET['error'] =="userdontexist"){
								echo "<script>alert('Username not registered')</script>";
							}
						}
						echo '<form action="includes/login.inc.php" method="POST">
						<input type="text" name="mailuid" placeholder="Username/E-mail.....">
						<input type="password" name="pwd" placeholder="Password.....">
						<button type="submit" name="login-submit">Login</button>
					</form>
					<a href="signup.php">Sign up</a>';
					}
				 ?>
     		
     	</div>
     	</div>
     </nav>		
</header>
<?php
include_once 'header.php';
?>
	<section class="main-container">
		<div class="main-wrapper">
			<h2>Signup</h2>
			<?php 
				if(isset($_GET['error'])){
					if($_GET['error'] =="emptyfields"){
					echo "<script>alert('Fill all the fields')</script>";
					}elseif ($_GET['error'] =="invalid-EmailUid") {
						echo "<script>alert('Invalid username and e-mail')</script>";
					}elseif ($_GET['error'] =="invalid-Email"){
						echo "<script>alert('Invalid e-mail')</script>";
					}elseif ($_GET['error'] =="inavliduid"){
						echo "<script>alert('Invalid username')</script>";
					}elseif ($_GET['error'] =="passwordcheck"){
						echo "<script>alert('Your password do not match')</script>";
					}elseif ($_GET['error'] =="usertaken"){
						echo "<script>alert('Username is already taken')</script>";
					}
			
					}elseif (@$_GET['signup'] =="success"){
						echo "<script>alert('Signup successfull')</script>";
					}
			?>
			<form class="signup-form" action="includes/signup.inc.php" method="POST">
				<input type="text" name="first" placeholder="Firstname">
				<input type="text" name="last" placeholder="Lastname">
				<input type="text" name="email" placeholder="E-mail">
				<input type="text" name="uid" id="uid" onkeyup="check_user()" placeholder="Username">
				<div id="checking"></div>
				<input type="password" name="pwd" placeholder="Password">
				<input type="password" name="pwd-repeat" placeholder="Repeat Password">
				<button type="submit" id="submit" name="signup-submit">Sign up</button>
			</form>
		</div>
	</section>
	<script src="sub_file/jquery-3.4.1.min.js"></script>
	<script src="signup.js"></script>
<?php
include_once'footer.php';
?>
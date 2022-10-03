<?php
require('header.php');
?>
	<section class="main-container"> 
		<div class="main-wrapper">
			<?php
			if(isset($_SESSION['userId'])){
                
            ?>
<!DOCTYPE html>
<html>
<head>
	<script>
		
		}
	</script>
	<style>
	<?php require_once("sub_file/style.css");	?>
	</style>
</head>
<body>
	
		<?php require_once("sub_file/new-message.php");?>

	<div id="container">
		<div id="menu">
		<?php echo $_SESSION['userUid']; ?>
		</div>
		<div id="left-col">
			<?php require_once("sub_file/left-col.php") ?>
		</div>
		<div id="right-col">
			<?php require_once("sub_file/right-col.php") ?>
		
	</div>
	
</body>
</html>
			<?php
	
			}else{
				echo '<h1>Welcome to BuzzApp</h1>';
			}
			?>
		</div>
	</section>
<?php
require 'footer.php';
?>

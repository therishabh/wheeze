<?php 
include('header.php');

if(isset($_POST['submit-btn']))
{
	$old_password = md5($_POST['old_password']);
	if($_POST['new_password'] == $_POST['con_password'])
	{
		if($row_admin['password'] == $old_password)
		{
			$id = $row_admin['id'];
			$password = md5($_POST['new_password']);
			$update = mysql_query("UPDATE admin SET password = '$password' WHERE id = $id ");

			$success_msg = "Password Has Been Successfully Changed !";
		}
		else
		{
			$error_msg = "Please Enter Correct Password !";
		}
	}
	else
	{
		$error_msg = "Enter Password Does Not Match !";
	}
}
?>
 <div class="container-fluid">
 	<div class="row">
 	<form action="setting.php" method="post">
 		<div class="col-lg-4 col-centered setting-div">
 			<div>
 				Setting
 			</div>
	 			<div>
	 				<input type="text" class="form-control" name="old_password" placeholder="Old Password">
	 			</div>
	 			<div>
	 				<input type="text" class="form-control" name="new_password" placeholder="New Password">
	 			</div>
	 			<div>
	 				<input type="text" class="form-control" name="con_password" placeholder="Confirm Password">
	 			</div>
	 			<div>
	 				<input type="submit" value="Submit" name="submit-btn" class="submit-btn">
	 			</div>
 			<div>
 				<?php
 				if(isset($error_msg))
 				{
 					echo $error_msg;
 				} 
 				?>
 			</div>
 			<div>
 				<?php
 				if(isset($success_msg))
 				{
 					echo $success_msg;
 				}  
 				 ?>
 			</div>

 		</div>
	</form>
 	</div>
 </div>
 <div id="preloader">
	<div id="status">&nbsp;</div>
</div>
</body>
</html>
<script type="text/javascript">
$(window).load(function() { // makes sure the whole site is loaded
	$('#status').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({'overflow':'visible'});
});
</script>
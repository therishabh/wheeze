<?php 
include('include/db.php');
session_start();
//if user is already login..

if(isset($_SESSION['wheeze_username']) || !empty($_SESSION['wheeze_username']) )
{
	?>
	<script type="text/javascript">
	window.location = "home.php";
	</script>
	<?php
}
else
{
	if(isset($_POST['submit-btn']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(!empty($username) && !empty($password))
		{
			$sql = "SELECT password FROM admin WHERE username = '$username'";
			$query = mysql_query($sql);
			//if username is correct and fetch its password
			if(mysql_num_rows($query) > 0)
			{
				$row = mysql_fetch_array($query);
				if(md5($password) == $row['password'])
				{
					$_SESSION['wheeze_username'] = $username;
					header("location:home.php");
				}
				else
				{
					$error_msg = "Please Insert Corrent Password !";
				}
				
			}
			else
			{
				$error_msg = "Please Insert Correct Username !";
			}

		}
		else
		{
			$error_msg = "Please Insert Both Fields !";
		}
	}
}
?>

<html>
<head>
	<title>Wheeze</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<!-- user favicon -->
	<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
	<!-- // end user favicon -->
</head>
<body id="login">
<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-centered logo">
				<p>Wheeze</p>
			</div>
		</div>
	</div>
</header>

<!-- Login Panel Section -->
<section class="login-panel">
	<form action="" method="POST">
	<div class="container-fluid">

		<div class="row">
			<div class="col-lg-5 col-centered login-wrap">

				<div class="row">
					<div class="col-lg-5" id="lbl_username">Username</div>
					
					<div class="col-lg-7">
						<input type="text" name="username" placeholder="Demo User :: admin" autocomplete="off" required>
					</div>
				</div> <!-- /row -->

				<div class="row">
					<div class="col-lg-5" id="lbl_password">Password</div>

					<div class="col-lg-7">
						<input type="password" name="password" placeholder="Password :: admin" required>
					</div>
				</div> <!-- /row -->

				<div class="row">
					
					<div class="col-lg-12 login_error">
						<?php
						if(isset($error_msg))
						{
							echo $error_msg;
						}
						?>
					</div>
				</div> <!-- /row -->
				
				<div class="row">
					<div class="col-lg-7 col-centered  login-btn-wrap">
						<center>
							
							<input type="submit" name="submit-btn" value="Login" style="width:100%;">
						</center>
					</div> <!-- /login-btn-wrap -->
				</div> <!-- /row -->
				
				<div class="row">
					<div class="col-lg-5 col-centered copyright text-center"><a href="#">&copy; Wheeze</a></div>
				</div>

			</div> <!-- /login-wrap -->
		</div>
	</div>
	</form>
</section>
<!-- end Login Panel Section -->
	
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

<script type="text/javascript">
	jQuery(document).ready(function($) {
		<?php 
		if(isset($error_msg))
		{
		?>
		$(".login_error").delay(5000).slideUp(1000);
		<?php
		}
		 ?>
	});
</script>
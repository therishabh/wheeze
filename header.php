<?php 
include('include/db.php');
session_start();

if(!isset($_SESSION['wheeze_username']) || empty($_SESSION['wheeze_username']) )
{
	?>
	<script type="text/javascript">
	window.location = "index.php";
	</script>
	<?php
}
else
{
	$username = $_SESSION['wheeze_username'];

	//on page load all taxi is active and display into map..
	$sql_update = "UPDATE taxi_status SET display = '0'";
	$query_update = mysql_query($sql_update);

	//fetch admin information..
	$sql = "SELECT * FROM admin WHERE username = '$username'";
	$query = mysql_query($sql);
	$row_admin = mysql_fetch_array($query);
	$current_page_name = basename($_SERVER['REQUEST_URI']);

	


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
<body>

<div class="la-anim-10"></div>

<header class="main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-4">
						<a href="home.php">
						<div class="logo">
							Wheeze
						</div>
						</a>
					</div>
					<div class="col-lg-5">
						<div class="row">
							<div class="col-lg-6 display-div">
								<?php 
								if($current_page_name == "taxi-detail.php")
								{
									?>
									<a href="taxi-detail.php">
										<div>Add Taxi</div>
									</a>
									<?php
								}
								else
								{								
									?>
									<a href="taxi-detail.php">
										<div>Taxi Detail</div>
									</a>
									<?php	
								}
								 ?>
							</div>
							<div class="col-lg-6 display-div">
								<a href="record.php">
									<div>Taxi Record</div>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 admin-desc">
						<div>Welcome <?php echo ucfirst($row_admin['name']); ?></div>
						<div>Today is, 
							<?php 
							date_default_timezone_set('Asia/Calcutta');
							echo date("j, F");
							 ?>
						</div>
						<div>
							<ul>
								<a href="setting.php"><li>Setting</li></a>
								<a href="logout.php"><li>Logout</li></a>
							</ul>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
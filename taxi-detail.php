<?php 
include('header.php');
if(isset($_POST['submit-btn']))
{
	$taxi_code = $_POST['taxi_code'];
	$taxi_number = $_POST['taxi_number'];
	$driver_name = $_POST['driver_name'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$password = $_POST['password'];
	date_default_timezone_set('Asia/Calcutta');
	$created_date = date("y-m-d H:i:s");
	
	$query = mysql_query("INSERT INTO taxi_detail (taxi_id,password,taxi_number,driver_name,mobile,address,created_date) 
		VALUES ('$taxi_code','$password','$taxi_number','$driver_name','$mobile','$address','$created_date')");

	$query_insert = mysql_query("INSERT INTO taxi_status (taxi_id) VALUES ('$taxi_code')");
	
	$_SESSION['insert_success'] = "success";

	header("location:taxi-detail.php");
}
if(isset($_POST['update-btn']))
{
	$id = $_POST['id'];
	$taxi_code = $_POST['taxi_code'];
	$taxi_number = $_POST['taxi_number'];
	$driver_name = $_POST['driver_name'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$password = $_POST['password'];
	date_default_timezone_set('Asia/Calcutta');
	$modify_date = date("y-m-d H:i:s");

	$query = mysql_query("UPDATE taxi_detail SET taxi_number = '$taxi_number', password = '$password', driver_name = '$driver_name',
		mobile = '$mobile', address = '$address', modify_date = '$modify_date' WHERE id = $id") or die ("Error in query: $query. ".mysql_error());

	$_SESSION['update_success'] = $id;
	header("location:taxi-detail.php");
	
}
$search_sql = "SELECT * FROM taxi_detail ORDER BY id DESC";
$search_query = mysql_query($search_sql);

if(mysql_num_rows($search_query) > 0)
{
	$query = mysql_query("SELECT taxi_id FROM taxi_detail ORDER BY id DESC LIMIT 1");
	$row_last = mysql_fetch_array($query);
	$pattern = "/(\d+)/";
	$code = preg_split($pattern, $row_last['taxi_id'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	$codde = $code[1] + 1;
 	$taxi_code = "taxi".$codde;

}
else
{
	$taxi_code = "taxi1";
}

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 left-side">
			<div class="search-bar">
				<div class="row">
					<div class="col-lg-6" style="padding-right:0px;">
						<input type="text" class="search-input form-control taxi_id_search" placeholder="Type Taxi Id..">
					</div>
					<div class="col-lg-6" style="padding-left:0px;">
						<input type="text" class="search-input form-control taxi_driver_search" placeholder="Type Driver Name..">
					</div>
				</div>
			</div>
			<div class="result-div">
				<?php 
				if(mysql_num_rows($search_query) > 0)
				{
					$a = 1;
					while($row = mysql_fetch_array($search_query))
					{

					?>
				<div class="left-blog">
					
					<div class="row">
						<div class="col-lg-12 top-label">
							<div class="row">
								<div class="col-lg-6 taxi-code" title="Taxi Number">
									<?php echo $row['taxi_id']; ?>			
								</div>
								<div class="col-lg-6 taxi-number" title="Taxi Number" >
									<?php echo $row['taxi_number']; ?>				
								</div>
							</div>
						</div>
					</div>
					
					
					<!-- start bottom-label -->
					<div class="bottom-label <?php echo $a; ?>" id="<?php echo $row['id']; ?>">
						<div class="row">
							<div class="col-lg-4 driver-detail">
								<div><?php echo $row['driver_name']; ?></div>
								<div><?php echo $row['mobile']; ?></div>
							</div>
							<div class="col-lg-8 address">
								<div title="Address">
									<?php echo $row['address']; ?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
					<!-- // end bottom-label -->
				<?php
					$a++;
					}//end while loop
				}
				else
				{
					?>
					<div class="error-msg">
						There is No any Taxi..!
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<div class="col-lg-6 right-side">
			<div class="display-section">
				<div class="row" style="padding:6px 15px;">
					<div class="col-lg-12 taxi-heading">
						<div class="row">
							<!-- course form heading -->
							<div class="col-lg-4 right-heading">
								New Taxi
							</div>
							<!-- // end subject form heading -->
							<div class="col-lg-6">
								<div class="msg success-msg">
								<?php 
								if(isset($_SESSION['insert_success']))
								{
									echo "Taxi Has Been Successfully Insert";
								}
								else if(isset($_SESSION['update_success']))
								{
									echo "Taxi Has Been Successfully Update";
								}
								?>
								</div>
								
							</div><!-- end success msg -->
							<div class="col-lg-2 edit">
								<div class="current-taxi-id" style="display:none;"></div>
								<img src="img/edit-icon.png" alt="" class="edit-btn" title="Edit Taxi">
							</div>

						</div><!-- // end row -->
					</div><!-- // end col-lg-12 -->
				</div>
				<div class="taxi-right-div">
					<form action="taxi-detail.php" method="post" id='submit-form'>
					<div class="row">
						<div class="col-lg-10 col-centered">
							<div class="row">
								<div class="col-lg-4 label-text">Taxi Code</div>
								<div class="col-lg-8">
									<input type="text" class="form-control"  disabled value="<?php echo $taxi_code; ?>">
									<input type="hidden" name="taxi_code" value="<?php echo $taxi_code; ?>">
								</div>
							</div>

							<div class="row" style="margin-top:14px;">
								<div class="col-lg-4 label-text">Password</div>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="insert_taxi_password" name="password">
								</div>
							</div>
							
							<div class="row" style="margin-top:14px;">
								<div class="col-lg-4 label-text">Taxi Number</div>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="insert_taxi_number" name="taxi_number">
								</div>
							</div>
							
							<div class="row" style="margin-top:14px;">
								<div class="col-lg-4 label-text">Driver Name</div>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="insert_driver_name" name="driver_name">
								</div>
							</div>

							<div class="row" style="margin-top:14px;">
								<div class="col-lg-4 label-text">Mobile Number</div>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="insert_mobile" name="mobile">
								</div>
							</div>

							<div class="row" style="margin-top:14px;">
								<div class="col-lg-4 label-text">Address</div>
								<div class="col-lg-8">
									<textarea name="address" style="border-radius:0px; resize:none;" class="form-control" id="insert_address" rows="4"></textarea>
								</div>
							</div>

							<div class="row" style="margin-top:14px;">
								<div class="col-lg-6 col-centered">
									<input type="hidden" name="submit-btn" value="Submit">
									<div class="submit submit-btn">Submit</div>
								</div>
							</div>

						</div>
					</div>
					</form>

				</div>
			</div>
			
		</div>
	</div>
</div>
<div id="preloader">
	<div id="status">&nbsp;</div>
</div>
</body>
</html>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(window).load(function() { // makes sure the whole site is loaded
	$('#status').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({'overflow':'visible'});
});
jQuery(document).ready(function($) {
	$(".taxi_id_search").keyup(function() {
		$(".la-anim-10").addClass('la-animate');
		var id = $(".taxi_id_search").val();
		var driver = $(".taxi_driver_search").val();
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {id : id , driver : driver},
			success : function(result){
				$(".result-div").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$(".taxi_driver_search").keyup(function() {
		$(".la-anim-10").addClass('la-animate');
		var id = $(".taxi_id_search").val();
		var driver = $(".taxi_driver_search").val();
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {id : id , driver : driver},
			success : function(result){
				$(".result-div").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$(".result-div").on('click', '.bottom-label', function() {
		var id = $(this).attr("id");
		$(".current-taxi-id").text(id);
		$(".edit-btn").show();
		$(".right-side .edit").show();
		$(".taxi-right-div").html("");
		$(".right-heading").text("View Taxi");
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {viewid : id},
			success : function(result){
				$(".taxi-right-div").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
		
	});

	$(".edit-btn").click(function() {
		$(this).hide();
		$(".la-anim-10").addClass('la-animate');
		$(".right-heading").text("Update Taxi");
		var id = $(".current-taxi-id").text();
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {updateid : id},
			success : function(result){
				$(".taxi-right-div").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$(".taxi-right-div").on('click', '.submit-btn', function(event) {

		if( $("#insert_taxi_number").val() == "" )
		{
			$("#insert_taxi_number").parent().addClass('has-error');
			var flag_taxi_number = 0;
		}
		else
		{
			var flag_taxi_number = 1
		}

		if( $("#insert_taxi_password").val() == "" )
		{
			$("#insert_taxi_password").parent().addClass('has-error');
			var flag_taxi_password = 0;
		}
		else
		{
			var flag_taxi_password = 1
		}

		if($("#insert_driver_name").val() == "")
		{
			$("#insert_driver_name").parent().addClass('has-error');
			var flag_driver_name = 0

		}
		else
		{
			var flag_driver_name = 1
		}

		if($("#insert_mobile").val() == "")
		{
			$("#insert_mobile").parent().addClass('has-error');
			var flag_mobile = 0

		}
		else
		{
			var flag_mobile = 1
		}

		if($("#insert_address").val() == "")
		{
			$("#insert_address").parent().addClass('has-error');
			var flag_address = 0

		}
		else
		{
			var flag_address = 1
		}


		if(flag_taxi_number == "1" && flag_taxi_password == "1" && flag_driver_name == "1" && flag_mobile == "1" && flag_address == "1" )
		{
			$(this).removeClass('submit-btn');
			$("#submit-form").submit();
			$(".la-anim-10").addClass('la-animate');
		}
	});

	$(".taxi-right-div").on('focusin', '.form-control', function(event) {
		$(this).parent().removeClass('has-error');
	});

	<?php 
	if(isset($_SESSION['insert_success']))
	{
	?>
		$(".1").css({
			backgroundColor: 'rgb(142, 213, 114)'
		});
		$(".1").animate({
	    	backgroundColor:"#fff"
	  	},9000);
		$(".success-msg span").delay(5000).fadeOut(1000);
		
	<?php
	}
	else if(isset($_SESSION['update_success']))
	{
		?>
		var id = "<?php echo $_SESSION['update_success'] ?>";
		$("#"+id).css({
			backgroundColor: 'rgb(142, 213, 114)'
		});

		$("#"+id).animate({
	    	backgroundColor:"#fff"
	  	},9000);
		
		$(".success-msg").delay(5000).fadeOut(1000);
		var p = $( "#"+id );

		var offset = p.offset();
		var top_value = parseFloat(offset.top) - 200;
		$('.result-div').animate({scrollTop:top_value}, 'slow');
		<?php
	}
	 ?>
});
</script>
<?php 
// echo $_SESSION['update_success'];
// echo $_SESSION['insert_success'];
unset($_SESSION['insert_success']);
unset($_SESSION['update_success']);
?>
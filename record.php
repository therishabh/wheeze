<?php 
include('header.php');
if(isset($_POST['remove-btn']))
{
	$query_remove = mysql_query("DELETE FROM history");
}
$query = mysql_query("SELECT * FROM history ORDER BY id DESC");
?>

<div class="container-fluid record">
	<div class="row">
		<div class="col-lg-3 col-centered record-heading">
			Taxi Record
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10 col-centered">
		<div class="col-lg-3 display-div">
			<a href="pdf.php" target="_blank">
				<div class='download-pdf'>Download PDF</div>
			</a>
		</div>
		<div class="col-lg-4 col-lg-offset-1 search-bar">
			<input type="text" class="form-control search-taxi-id" placeholder="Type Taxi Id..">
		</div>
		<div class="col-lg-3 col-lg-offset-1 display-div">
			<form action="record.php" method="post" id="remove-record">
				<input type="hidden" value="success" name="remove-btn">
			</form>
			<div class="remove-record-btn">Remove History</div>
		</div>
		</div>
	</div>

	<div class="row" style="margin-top:20px;">
		<div class="col-lg-11 col-centered search-result">

		<?php 
		if(mysql_num_rows($query) > 0) 
		{
		?>
			<table>
				<thead>
					<tr>
						<td>S.No.</td>
						<td>Taxi Id</td>
						<td>Taxi Number</td>
						<td>Driver Name</td>
						<td>Status</td>
						<td>Time</td>
						<td style="width:29%;">Location</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$a = 1;
					while($row = mysql_fetch_array($query))
					{
						$taxi_id = $row['taxi_id'];
				   		$query_fetch = mysql_query("SELECT * FROM taxi_detail WHERE taxi_id = '$taxi_id'");
				   		$row_taxi = mysql_fetch_array($query_fetch);
				   		$time = date("jS, F Y h:i:s A",strtotime($row['time']));
					?>
						<tr>
							<td><?php echo $a; ?></td>
							<td><?php echo $row['taxi_id'] ?></td>
							<td><?php echo $row_taxi['taxi_number'] ?></td>
							<td><?php echo $row_taxi['driver_name'] ?></td>
							<td><?php echo $row['status']; ?></td>
							<td><?php echo $time; ?></td>
							<td><?php echo $row['location'];; ?></td>
						</tr>
					
					<?php
					$a++;
					} 
					?>
				</tbody>
			</table>
			
		<?php
		}
		else
		{
		?>
			<div class="error-msg">
				There is no any Update about Taxi..!
			</div>
		<?php
		}

		?>
		</div>
	</div>
</div>
</body>
</html>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.search-taxi-id').keyup(function() {
		var taxi_id = $(this).val();
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {taxi_id:taxi_id},
			success: function(result){
				$(".search-result").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$(".remove-record-btn").click(function() {
		var $confirm = confirm("Do You Want To Delete All Taxi History ?");
		if($confirm == true)
		{
			$("#remove-record").submit();
		}
	});

});
</script>
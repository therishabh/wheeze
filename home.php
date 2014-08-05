<?php 
include('header.php');
$sql_vacant = "SELECT * FROM taxi_status WHERE status = 'Vacant' AND display = 0 AND active = '1'";
$vacant_query = mysql_query($sql_vacant);
$number_of_vacant = mysql_num_rows($vacant_query);

$sql_occupied = "SELECT * FROM taxi_status WHERE status = 'Occupied' AND display = 0 AND active = '1'";
$occupied_query = mysql_query($sql_occupied);
$number_of_occupied = mysql_num_rows($occupied_query);


$sql_onduty = "SELECT * FROM taxi_status WHERE status = 'On Duty' AND display = 0 AND active = '1'";
$onduty_query = mysql_query($sql_onduty);
$number_of_onduty = mysql_num_rows($onduty_query);


$sql_offline = "SELECT * FROM taxi_status WHERE status = 'offline' AND display = 0 AND active = '1'";
$offline_query = mysql_query($sql_offline);
$number_of_offline = mysql_num_rows($offline_query);
 


 ?>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-9">
				<div class="map-section">
					<div class="map-show">
						<div id="map" style="width:100%; height: 500px;margin-top:35px;"></div>
					</div>
					
					<div class="refresh">
						<img src="img/refresh-blue.png" alt="Refresh Image">
					</div>
				</div>
			</div>
			<div class="col-lg-3 right-side">

				<div class="row">
					<div class="col-lg-6">
						<img src="img/vacant.png" alt="">
					</div>
					<div class="col-lg-6 display-right">
						<span class="total-vacant"><?php echo $number_of_vacant ?></span>
						<span class="noti-vacant noti"></span>
					</div>
				</div>

				<div class="row" style="margin-top:20px;">
					<div class="col-lg-6">
						<img src="img/occupied.png" alt="">
					</div>
					<div class="col-lg-6 display-right">
						<span class="total-occupied"><?php echo $number_of_occupied; ?></span>
						<span class="noti-occupied noti"></span>
					</div>
				</div>

				<div class="row" style="margin-top:20px;">
					<div class="col-lg-6">
						<img src="img/on-duty.png" alt="">
					</div>
					<div class="col-lg-6 display-right">
						<span class="total-onduty"><?php echo $number_of_onduty; ?></span>
						<span class="noti-onduty noti"></span>
					</div>
				</div>

				<div class="row" style="margin-top:20px;">
					<div class="col-lg-6">
						<img src="img/offline.png" alt="">
					</div>
					<div class="col-lg-6 display-right">
						<span class="total-offline"><?php echo $number_of_offline; ?></span>
						<span class="noti-offline noti"></span>
					</div>
				</div>
				
				</a>
			</div>
		</div>
	</div>
</section>
<div class="hidden" id="js-content"></div>
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

jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers

    var markers = [
    <?php
    $query = mysql_query("SELECT * FROM taxi_status WHERE display = 0 AND active = 1");
    while($row = mysql_fetch_array($query)) 
    {
    	echo "['".$row['taxi_id']."',".$row['lattitude'] . "," . $row['longitude']."],";
    }
    ?>
    ];
                        
    // Info Window Content
    var infoWindowContent = [
    <?php 
    $query = mysql_query("SELECT * FROM taxi_status WHERE display = 0 AND active = 1");
    while($row = mysql_fetch_array($query)) 
    {
   		$taxi_id = $row['taxi_id'];
   		$query_fetch = mysql_query("SELECT * FROM taxi_detail WHERE taxi_id = '$taxi_id'");
   		$row_taxi = mysql_fetch_array($query_fetch);
   		if($row['status'] == "Occupied")
    	{
	   	?>
	   	['<div class="info_content">' +
	        '<h3><?php echo $row_taxi["taxi_id"]." (".$row_taxi["taxi_number"].")"; ?></h3>' +
	        '<h4><?php echo $row_taxi["driver_name"] ?></h4>' +        
	        '<h5><?php echo $row_taxi["mobile"] ?></h5>' +        
	        '<h6>Taxi Occupied</h6>' +        
	     '</div>'],
	   	<?php
   		}
   		elseif($row['status'] == "Vacant")
    	{
	   	?>
	   	['<div class="info_content">' +
	        '<h3><?php echo $row_taxi["taxi_id"]." (".$row_taxi["taxi_number"].")"; ?></h3>' +
	        '<h4><?php echo $row_taxi["driver_name"] ?></h4>' +        
	        '<h5><?php echo $row_taxi["mobile"] ?></h5>' +        
	        '<h6>Taxi Vacant</h6>' +        
	     '</div>'],
	   	<?php
   		}
   		elseif($row['status'] == "On Duty")
    	{
	   	?>
	   	['<div class="info_content">' +
	        '<h3><?php echo $row_taxi["taxi_id"]." (".$row_taxi["taxi_number"].")"; ?></h3>' +
	        '<h4><?php echo $row_taxi["driver_name"] ?></h4>' +        
	        '<h5><?php echo $row_taxi["mobile"] ?></h5>' +        
	        '<h6>Taxi On Duty</h6>' +        
	     '</div>'],
	   	<?php
   		}
   		elseif($row['status'] == "Offline")
    	{
	   	?>
	   	['<div class="info_content">' +
	        '<h3><?php echo $row_taxi["taxi_id"]." (".$row_taxi["taxi_number"].")"; ?></h3>' +
	        '<h4><?php echo $row_taxi["driver_name"] ?></h4>' +        
	        '<h5><?php echo $row_taxi["mobile"] ?></h5>' +        
	        '<h6>Taxi Offline</h6>' +        
	     '</div>'],
	   	<?php
   		}
	}
    ?>
        
    ];

    // Setup the different icons and shadows
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
    <?php 
    $query = mysql_query("SELECT * FROM taxi_status WHERE display = 0 AND active = 1");
    while($row = mysql_fetch_array($query)) 
    {
    	if($row['status'] == "Occupied")
    	{
    		 echo "iconURLPrefix + 'red-dot.png',";
    	}
    	elseif($row['status'] == "Vacant")
    	{
    		 echo "iconURLPrefix + 'green-dot.png',";
    	}
    	elseif($row['status'] == "On Duty")
    	{
    		 echo "iconURLPrefix + 'yellow-dot.png',";
    	}
    	elseif($row['status'] == "Offline")
    	{
    		 echo "iconURLPrefix + 'blue-dot.png',";
    	}
    }
    ?>
    ]
    var icons_length = icons.length;
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
     var iconCounter = 0;

    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon : icons[iconCounter],
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
        iconCounter++;
        if(iconCounter >= icons_length){
	      	iconCounter = 0;
	      }
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(11);
        google.maps.event.removeListener(boundsListener);
    });
    
}
$(".noti").hide();
setInterval(function(){
	$.ajax({
		url: 'ajax.php',
		type: 'POST',
		data: {success: 'success'},
		success: function(result){
			$("#js-content").html(result);
			var vacant = $("#vacant-hidden").text();	
			var occupied = $("#occupied-hidden").text();
			var onduty = $("#onduty-hidden").text();
			var offline = $("#offline-hidden").text();
			if(vacant > 0 || occupied > 0 || onduty > 0 || offline > 0)
			{
				var refresh_img = '<img src="img/refresh-red.png" alt="Refresh Image">';
				$(".refresh").html(refresh_img);
					$(".total-vacant").text($("#va_hidden").text());
					$(".total-onduty").text($("#on_hidden").text());	
					$(".total-occupied").text($("#oc_hidden").text());	
					$(".total-offline").text($("#off_hidden").text());	
				if(vacant > 0)
				{
					$(".noti-vacant").text(vacant);
					$(".noti-vacant").fadeIn(1000);
				}
				if(occupied > 0)
				{
					$(".noti-occupied").text(occupied);
					$(".noti-occupied").fadeIn(1000);
				}
				if(onduty > 0)
				{
					$(".noti-onduty").text(onduty);
					$(".noti-onduty").fadeIn(1000);
				}
				if(offline > 0)
				{
					$(".noti-offline").text(offline);
					$(".noti-offline").fadeIn(1000);
				}
			}
			else
			{
				var refresh_img = '<img src="img/refresh-blue.png" alt="Refresh Image">';
				$(".refresh").html(refresh_img);
			}
		}
	});
}, 2000);

    $("body").on('click', '.refresh', function() {
    	$(this).children().addClass('rotate');

    	setInterval(function(){
    		$('.refresh').children().removeClass('rotate');
	    	var refresh_img = '<img src="img/refresh-blue.png" alt="Refresh Image">';
	    	$('.refresh').html(refresh_img);
    	},3000);

    	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {refresh: 'success'},
			success: function(result){
				$(".map-show").html(result);
				$('.noti').fadeOut(2000);
			}
		});

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {update_success: 'success'},
			success: function(result){
				$("#js-content").html(result);
				$(".total-vacant").text($("#va_hidden").text());
				$(".total-occupied").text($("#oc_hidden").text());	
				$(".total-onduty").text($("#on_hidden").text());	
				$(".total-offline").text($("#off_hidden").text());	
					
			}
		});
    });
 

</script>
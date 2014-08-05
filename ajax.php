<?php 
include('include/db.php');

if(isset($_POST['success']))
{
$sql_occupied = "SELECT * FROM taxi_status WHERE display = '1' AND status = 'Occupied' AND active = '1'";
$query_occupied = mysql_query($sql_occupied);
$sql_vacant = "SELECT * FROM taxi_status WHERE display = '1' AND status = 'Vacant' AND active = '1'";
$query_vacant = mysql_query($sql_vacant);
$sql_onduty = "SELECT * FROM taxi_status WHERE display = '1' AND status = 'On Duty' AND active = '1'";
$query_onduty = mysql_query($sql_onduty);
$sql_offline = "SELECT * FROM taxi_status WHERE display = '1' AND status = 'Offline' AND active = '1'";
$query_offline = mysql_query($sql_offline);
?>
<div class="hidden" id="occupied-hidden"><?php echo mysql_num_rows($query_occupied); ?></div>
<div class="hidden" id="vacant-hidden"><?php echo mysql_num_rows($query_vacant); ?></div>
<div class="hidden" id="onduty-hidden"><?php echo mysql_num_rows($query_onduty); ?></div>
<div class="hidden" id="offline-hidden"><?php echo mysql_num_rows($query_offline); ?></div>

<?php
$sql_occupied = "SELECT * FROM taxi_status WHERE status = 'Occupied' AND active = '1'";
$query_occupied = mysql_query($sql_occupied);
$sql_vacant = "SELECT * FROM taxi_status WHERE status = 'Vacant' AND active = '1'";
$query_vacant = mysql_query($sql_vacant);
$sql_onduty = "SELECT * FROM taxi_status WHERE status = 'On Duty' AND active = '1'";
$query_onduty = mysql_query($sql_onduty);
$sql_offline = "SELECT * FROM taxi_status WHERE status = 'Offline' AND active = '1'";
$query_offline = mysql_query($sql_offline);
?>
<div class="hidden" id="oc_hidden"><?php echo mysql_num_rows($query_occupied); ?></div>
<div class="hidden" id="va_hidden"><?php echo mysql_num_rows($query_vacant); ?></div>
<div class="hidden" id="on_hidden"><?php echo mysql_num_rows($query_onduty); ?></div>
<div class="hidden" id="off_hidden"><?php echo mysql_num_rows($query_offline); ?></div>
<?php
}
elseif(isset($_POST['update_success']))
{
$sql_occupied = "SELECT * FROM taxi_status WHERE status = 'Occupied' AND active = '1'";
$query_occupied = mysql_query($sql_occupied);
$sql_vacant = "SELECT * FROM taxi_status WHERE status = 'Vacant' AND active = '1'";
$query_vacant = mysql_query($sql_vacant);
$sql_onduty = "SELECT * FROM taxi_status WHERE status = 'On Duty' AND active = '1'";
$query_onduty = mysql_query($sql_onduty);
$sql_offline = "SELECT * FROM taxi_status WHERE status = 'Offline' AND active = '1'";
$query_offline = mysql_query($sql_offline);
?>
<div class="hidden" id="oc_hidden"><?php echo mysql_num_rows($query_occupied); ?></div>
<div class="hidden" id="va_hidden"><?php echo mysql_num_rows($query_vacant); ?></div>
<div class="hidden" id="on_hidden"><?php echo mysql_num_rows($query_onduty); ?></div>
<div class="hidden" id="off_hidden"><?php echo mysql_num_rows($query_offline); ?></div>
<?php
}
else if(isset($_POST['refresh']))
{
	//on page load all taxi is active and display into map..
	$sql_update = "UPDATE taxi_status SET display = '0'";
	$query_update = mysql_query($sql_update);
?>
<div id="map" style="width:100%; height: 500px;margin-top:35px;">
<script type="text/javascript">
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
</script>
<?php
}
if(isset($_POST['driver']))
{
    $id = $_POST['id'];
    $driver = $_POST['driver'];
    $search_query = mysql_query("SELECT * FROM taxi_detail WHERE taxi_id LIKE '%$id%' AND driver_name LIKE '%$driver%' ORDER BY id DESC");
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
            Search Result Not Found..!
        </div>
        <?php
    }
}
if(isset($_POST['viewid']))
{
    $id = $_POST['viewid'];
    $query = mysql_query("SELECT * FROM taxi_detail WHERE id = '$id'");
    $row = mysql_fetch_array($query);
    ?>
    <div class="row">
        <div class="col-lg-10 col-centered">
            <div class="row">
                <div class="col-lg-4 label-text">Taxi Code :</div>
                <div class="col-lg-8">
                    <?php echo $row['taxi_id']; ?>
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Password</div>
                <div class="col-lg-8">
                    <?php echo $row['password']; ?>
                </div>
            </div>
            
            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Taxi Number :</div>
                <div class="col-lg-8">
                    <?php echo $row['taxi_number']; ?>
                </div>
            </div>
            
            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Driver Name :</div>
                <div class="col-lg-8">
                    <?php echo $row['driver_name']; ?>
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Mobile Num :</div>
                <div class="col-lg-8">
                    <?php echo $row['mobile']; ?>
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Address :</div>
                <div class="col-lg-8">
                    <?php echo $row['address']; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if(isset($_POST['updateid']))
{
    $id = $_POST['updateid'];
    $query = mysql_query("SELECT * FROM taxi_detail WHERE id = '$id'");
    $row = mysql_fetch_array($query);
?>
<form action="taxi-detail.php" method="post" id='submit-form'>
    <div class="row">
        <div class="col-lg-10 col-centered">
            <div class="row">
                <div class="col-lg-4 label-text">Taxi Code</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control"  disabled value="<?php echo $row['taxi_id']; ?>">
                    <input type="hidden" name="taxi_code" value="<?php echo $row['taxi_id']; ?>">
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Password</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="insert_taxi_password" value="<?php echo $row['password']; ?>" name="password">
                </div>
            </div>
            
            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Taxi Number</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="insert_taxi_number" value="<?php echo $row['taxi_number']; ?>" name="taxi_number">
                </div>
            </div>
            
            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Driver Name</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="insert_driver_name" value="<?php echo $row['driver_name']; ?>" name="driver_name">
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Mobile Number</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="insert_mobile" value="<?php echo $row['mobile']; ?>" name="mobile">
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-4 label-text">Address</div>
                <div class="col-lg-8">
                    <textarea name="address" style="border-radius:0px; resize:none;" class="form-control" id="insert_address" rows="4"><?php echo $row['address']; ?></textarea>
                </div>
            </div>

            <div class="row" style="margin-top:14px;">
                <div class="col-lg-6 col-centered">
                    <input type="hidden" name="update-btn" value="Submit">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="submit submit-btn">Update</div>
                </div>
            </div>

        </div>
    </div>
    </form>
<?php
}
elseif(isset($_POST['taxi_id']))
{
    $taxi_id = $_POST['taxi_id'];
    $query = mysql_query("SELECT * FROM history WHERE taxi_id LIKE '%$taxi_id%' ORDER BY id DESC");
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
                        <td><?php echo $row['location'];  ?></td>
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
           Search Result Not Found !
        </div>
    <?php
    }
}
?>
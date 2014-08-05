<?php
// Connect to the database(host, username, password)
$con = mysqli_connect('localhost','WheezeDBAdmin','&EuT1.]qyRv1','DB');
if (!$con)
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}
// Select the database. Enter the name of your database (not the same as the table name)
$db = mysqli_select_db($con,DB);
if (!$db)
{
    echo "Failed to select db.";
    exit;
}
 
// $_POST['userName'] and $_POST['password'] are the param names we sent in our click event 
$taxi_id = $_POST['taxiID'];
$latitude = floatval($_POST['latitude']);
$longitude = floatval($_POST['longitude']);
$status = $_POST['status'];
date_default_timezone_set('Asia/Calcutta');
$time = date("y-m-d H:i:s");

function getaddress($lat,$lng)
{
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
    $json = @file_get_contents($url);
    $data=json_decode($json);
    $status = $data->status;
    if($status=="OK")
    return $data->results[0]->formatted_address;
    else
    return false;
}


if($latitude == 0 || $longitude == 0)
{

	$query = false;
}
else
{

$address= getaddress($latitude,$longitude);
if($address)
{
$location = $address;
}
else
{
$location = "Location Not Found";
}
// Select eveything from the users table where username field == the username we posted and password field == the password we posted
$sql="INSERT INTO history (taxi_id, lattitude, longitude,time,status,location)
VALUES ('$taxi_id', '$latitude', '$longitude','$time','$status','$location')";

$query = mysqli_query($con,$sql);

$sql="UPDATE taxi_status SET lattitude = '$latitude' , longitude = '$longitude' , status = '$status', display = '1' , active = '1' WHERE taxi_id = '$taxi_id'";

$query = mysqli_query($con,$sql);
	
}



 
// If we find a match, create an array of data, json_encode it and echo it out
if ($query)
{   
    $response=success;
    echo json_encode($response);

}
else
{
    // Else the username and/or password was invalid! Create an array, json_encode it and echo it out

    $response=failed;
    echo json_encode($response);
}
?>
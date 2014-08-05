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
 
// $_POST['userName'] and $_POST['password'] are the param names we sent in our click event in login.js
$username = $_POST['username'];
$password = md5($_POST['password']);
 
// Select eveything from the users table where username field == the username we posted and password field == the password we posted
$sql = "SELECT * FROM taxi_detail WHERE taxi_id= '" . $username . "' AND password = '" . $password . "'";
$query = mysqli_query($con,$sql);
 
// If we find a match, create an array of data, json_encode it and echo it out
if (mysqli_num_rows($query) > 0)
{
    $row = mysqli_fetch_array($query);
    $response=success;
    echo json_encode($response);
}
else
{
    // Else the username and/or password was invalid! Create an array, json_encode it and echo it out

    $response=failed;
    echo json_encode($username);
}
?>
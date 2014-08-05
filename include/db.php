<?php
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "wheeze";
$con = mysql_connect($mysql_host,$mysql_user,$mysql_password);
$db_con = mysql_select_db($mysql_database);
?>
<?php
include 'include/db.php';
session_start();

unset($_SESSION['wheeze_username']);
session_destroy();
header('location:index.php');

?>
<?php
require('./config.php');

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

if ($conn == false) {
    die('Not connected : ' . mysqli_error());
}
<?php
require_once('./config.php');

function dbconnect($host, $id, $pass, $db)  // connect to database
{
    $conn = mysqli_connect($host, $id, $pass, $db);

    if ($conn == false) {
        die('Not connected : ' . mysqli_error());
    }

    return $conn;
}
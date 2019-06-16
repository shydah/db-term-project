<?php
require_once('./utils.php');

$franchise_id = intval($_POST['franchise_id']);
$site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
$site_address = mysqli_real_escape_string($conn, $_POST['site_address']);
$site_website = mysqli_real_escape_string($conn, $_POST['site_website']);
$site_image = mysqli_real_escape_string($conn, $_POST['site_image']);
$site_desc = mysqli_real_escape_string($conn, $_POST['site_desc']);

$query = "INSERT INTO cinedb_site (site_name, site_address, site_website, site_image, site_desc) VALUES ('" . $site_name . "','" . $site_address . "','" . $site_website . "','" . $site_image . "','" . $site_desc . "');";

// use transaction
mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set transaction isolation level serializable");
mysqli_query($conn, "begin");

$result = mysqli_query($conn, $query);

if(!$result) {
	mysqli_query($conn, "rollback");
	echo('Query Error : ' . mysqli_error($conn));
}

mysqli_query($conn, "commit");
header("Location: /~2015120189/project/site_list.php");
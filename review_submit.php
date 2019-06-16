<?php
require('./utils.php');

$cinema_id = intval($_POST['cinema_id']);
$nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

$hashed_pass = md5($password);
// 원래는 password_hash를 써야 함

$query = "INSERT INTO cinedb_review (cinema_id, review_nick, review_password, review_contents) VALUES (" . $cinema_id . ",'" . $nickname . "','" . $hashed_pass . "','" . $content . "');";

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
header("Location: /~2015120189/project/cinema_detail.php?cinema_id=" . $cinema_id);
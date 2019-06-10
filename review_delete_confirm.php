<?php
require('./utils.php');

$review_id = intval($_POST['review_id']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT * FROM cinedb_review WHERE review_id = " . $review_id;
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);

$cinema_id = $row['cinema_id'];
$hashed_pass = md5($password); // 원래는 password_hash를 써야 함

// 비밀번호가 다른 경우 원래 페이지로 돌려보냄
if ($row['review_password'] != $hashed_pass) {
	echo "<script>window.alert('비밀번호가 다릅니다.');location.href='/~2015120189/project/cinema_detail.php?cinema_id=" . $cinema_id . "';</script>";
	exit();
}

// 리뷰 삭제
$query = "DELETE FROM cinedb_review WHERE review_id = " . $review_id;
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

header("Location: /~2015120189/project/cinema_detail.php?cinema_id=" . $cinema_id);
?>
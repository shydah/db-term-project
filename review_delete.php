<?php
require_once('./utils.php');
include('./header.php');

$review_id = intval($_GET['review_id']);

$query = "SELECT * FROM cinedb_review WHERE review_id = " . $review_id;
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);

if ( is_null($row) ) {
	echo "<script>window.alert('존재하지 않는 댓글입니다.');location.href='/~2015120189/project/';</script>";
}
?>
<div class="background">
	<div class="contents contents-width padding-32" style="text-align: center;">
		<h2>삭제하시겠습니까?</h2>
		<p>삭제하려면 비밀번호를 입력하세요.</p>
		<form method="POST" action="/~2015120189/project/review_delete_confirm.php">
			<input type="hidden" name="review_id" value="<?= $review_id ?>">
			<input type="password" name="password" class="form-control" style="margin-bottom: 24px;">
			<button type="submit" class="btn btn-primary">확인</button>
		</form>
	</div>
</div>
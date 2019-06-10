<?php
require_once('./utils.php');
include('./header.php');

$cinema_id = intval($_GET['cinema_id']);

$query = "SELECT * FROM cinedb_cinema NATURAL JOIN cinedb_site WHERE cinema_id = " . $cinema_id;
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);
?>
<div class="background">
	<div class="contents contents-width">
		<section class="cinema-info">
			<div class="padding-32">
				<h2 class="site-name"><a href="/~2015120189/project/site_detail.php?site_id=<?= $row['site_id'] ?>" target="_self"><?= $row['site_name'] ?></a></h2>
				<h1><?= $row['cinema_name'] ?></h1>
			</div>
		</section>
		<section class="cinema-basic padding-32">
			<h3>상영관 정보</h3>
			<p>- 좌석수: <?= $row['cinema_seats'] ?>석</p>
			<?php
			if ( is_null($row['cinema_screen_width']) || is_null($row['cinema_screen_height']) ) {
				$screen_size = "정보 없음";
			} else {
				$screen_size = $row['cinema_screen_width'] . " x " . $row['cinema_screen_height'];
			} ?>
			<p>- 스크린 크기: <?= $screen_size ?></p>

<?php
// 상영관 속성을 가져오는 부분
$query = "SELECT prop_name FROM cinedb_cinema_props_related NATURAL JOIN cinedb_cinema_props WHERE cinema_id = " . $cinema_id;
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)) { ?>

<p>- <?= $row['prop_name'] ?></p>

<?php } ?>
		</section>
		<section class="cinema-review padding-32">
			<h3>상영관 리뷰</h3>
<?php
// 리뷰를 가져오는 부분
$query = "SELECT * FROM cinedb_review WHERE cinema_id = " . $cinema_id;
$result = mysqli_query($conn, $query);

$review_count = 0;
while($row = mysqli_fetch_array($result)) {
	$review_count++; ?>
<div class="review-item">
	<strong class="review-nick"><?= $row['review_nick'] ?></strong>
	<p class="review-contents"><?= nl2br($row['review_contents']) ?></p>
	<a href="/~2015120189/project/review_delete.php?review_id=<?= $row['review_id'] ?>">삭제</a>
</div>

<?php }
// 리뷰 반복 종료
// 리뷰가 없는 경우 없다는 메시지 표시
if ($review_count == 0) { ?>
			<p style="text-align: center;" class="no-review">등록된 리뷰가 없습니다.</p>
<?php } ?>

			<div class="review-form">
				<form action="/~2015120189/project/review_submit.php" method="POST">
					<input type="hidden" name="cinema_id" value="<?= $cinema_id ?>">
					<div class="form-row">
						<div class="col">
							<input type="text" name="nickname" class="form-control" placeholder="별명">
						</div>
						<div class="col">
							<input type="password" name="password" class="form-control" placeholder="비밀번호">
						</div>
					</div>
					<div class="review-textarea form-group">
						<textarea name="content" class="form-control"></textarea>
					</div>
					<div class="form-group row">
						<div class="col" style="text-align: right;">
							<button type="submit" class="btn btn-primary">리뷰 남기기</button>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
<?php include('./footer.php'); ?>
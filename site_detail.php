<?php
require_once('./utils.php');
include('./header.php');

$site_id = intval($_GET['site_id']);

$query = "SELECT * FROM cinedb_site WHERE site_id = " . $site_id;
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);
?>

<div class="background">
	<div class="contents contents-width">
		<section class="theater-info">
			<div class="padding-32">
				<h1><?= $row['site_name'] ?></h1>
				<p class="h1-description"><?= $row['site_desc'] ?></p>
			</div>
			<?php if ( ! is_null($row['site_image']) ) { ?>
			<div class="theater-image" style="background-image: url(<?= $row['site_image'] ?>);">
			</div>
			<?php } ?>
			<div class="padding-32">
				<ul>
					<li>주소: <?= $row['site_address'] ?></li>
					<li>홈페이지: <a href="<?= $row['site_website'] ?>">바로가기</a></li>
				</ul>
			</div>
		</section>
		<section class="cinema-list padding-32">
			<h2>상영관 목록</h2>
			<ul>
<?php

$query = "SELECT * FROM cinedb_cinema WHERE site_id = " . $site_id;
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

$cinema_count = 0;
while($row = mysqli_fetch_array($result)) {
	$cinema_count++;
?>
				<a href="/~2015120189/project/cinema_detail.php?cinema_id=<?= $row['cinema_id']?>"><li><?= $row['cinema_name'] ?></li></a>
<?php }
if ($cinema_count == 0) { ?>
	등록된 상영관이 없습니다.
<?php } ?>
			</ul>
		</section>
	</div>
</div>
<?php
include('./footer.php');
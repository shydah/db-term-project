<?php
require_once('./utils.php');
include('./header.php');
?>
<div class="background">
	<div class="contents contents-width">
		<div class="padding-32 site-list">
			<h1>극장 목록</h1>
		
<?php
$query = "SELECT * FROM cinedb_site";
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

while($row = mysqli_fetch_array($result)) { ?>

	<a href="/~2015120189/project/site_detail.php?site_id=<?= $row['site_id'] ?>" target="_self">
		<div class="site-item">
			<h2><?= $row['site_name'] ?></h2>
			<p class="site-desc"><?= $row['site_desc'] ?></p>
		</div>
	</a>

<?php } ?>
</div>
<div style="text-align: center; margin-top: 32px;">
	<a href="/~2015120189/project/site_new.php" target="_self" class="btn btn-outline-primary">극장 등록하기</a>
</div>
<?php
include('./footer.php');
?>
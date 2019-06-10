<?php
require_once('./utils.php');
include('./header.php');
?>
<div class="background">
	<div class="contents contents-width">
		<div class="padding-32 site-list">
			<h1>등록된 체인 목록</h1>
		
<?php
$query = "SELECT * FROM cinedb_franchise";
$result = mysqli_query($conn, $query);

if(!$result) {
	echo('Query Error : ' . mysqli_error($conn));
}

while($row = mysqli_fetch_array($result)) { ?>
	<div class="site-item">
		<h2><?= $row['franchise_name'] ?></h2>
	</div>
<?php } ?>
</div>
<div style="text-align: center; margin-top: 32px;">
	<a href="javascript:alert('추후 오픈 예정입니다.')" target="_self" class="btn btn-outline-primary">체인 등록하기</a>
</div>
<?php
include('./footer.php');
?>
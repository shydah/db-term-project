<?php
require_once('./utils.php');
include('./header.php');
?>
<div class="background">
	<div class="contents contents-width">
		<div class="padding-32 site-list">
			<h1>극장 등록하기</h1>
			<form action="/~2015120189/project/site_submit.php" method="POST">
				<div class="form-group">
					<label for="siteChainSelect">체인 선택</label>
					<select class="form-control" name="franchise_id" id="siteChainSelect">
						<?php
						$query = "SELECT * FROM cinedb_franchise";
						$result = mysqli_query($conn, $query);

						if(!$result) {
							echo('Query Error : ' . mysqli_error($conn));
						}

						while($row = mysqli_fetch_array($result)) { ?>
							<option value="<?= $row['franchise_id']?>"><?= $row['franchise_name'] ?></option> 
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="siteNameInput">영화관명 (지점명)</label>
					<input type="text" class="form-control" id="siteNameInput" name="site_name" placeholder="예: CGV 왕십리" required>
				</div>
				<div class="form-group">
					<label for="siteAddressInput">영화관 주소</label>
					<input type="text" class="form-control" id="siteAddressInput" name="site_address">
				</div>
				<div class="form-group">
					<label for="siteWebsiteInput">영화관 홈페이지 주소</label>
					<input type="text" class="form-control" id="siteWebsiteInput" name="site_website">
				</div>
				<div class="form-group">
					<label for="siteImageAddressInput">영화관 이미지 주소</label>
					<input type="text" class="form-control" id="siteImageAddressInput" name="site_image">
				</div>
				<div class="form-group">
					<label for="siteDescriptonInput">지점 한줄 설명</label>
					<input type="text" class="form-control" id="siteDescriptonInput" name="site_desc">
				</div>
				<button type="submit" class="btn btn-primary">등록</button>
			</form>
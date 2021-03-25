<?php 
    require_once "db.php";

    $all_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from, prod_to,prod_description,username,cat_title,prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ? order by prod_id DESC", 3, 'i');
    
?>
<?php require "header.php"; ?>
	
	<main class="bg_gray">
			<div class="container margin_60_35 add_bottom_30">
				<div class="main_title">
					<h2>Rreth DealAim</h2>
					<p>Kur jemi krijuar, pse jemi krijuar e cili është qëllimi i krijimit tonë si kompani, përgjigjet i gjeni më poshtë.</p>
				</div>
				<?php 
					$select_whoarewe = prep_stmt("SELECT * FROM about WHERE about_layout = ? order by about_id desc limit 3", "kush_jemi_ne", "s");
					if(mysqli_num_rows($select_whoarewe) > 0){
						while($row_who = mysqli_fetch_array($select_whoarewe)){
							if($row_who['about_img_pos'] == "left"){ 
				?>
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-5 pr-lg-5 text-center d-none d-lg-block">
							<img src="img/<?php echo $row_who['about_img'] ?>" alt="" class="img-fluid" style="max-width:100%;">
					</div>
					<div class="col-lg-5">
						<div class="box_about">
							<h2><?php echo $row_who['about_title'] ?></h2>
							<p class="lead"><?php echo $row_who['about_desc_lead'] ?></p>
							<p><?php echo $row_who['about_desc'] ?></p>
						</div>
					</div>
				</div>
				<?php } else { ?>
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-5">
						<div class="box_about">
							<h2><?php echo $row_who['about_title'] ?></h2>
							<p class="lead"><?php echo $row_who['about_desc_lead'] ?></p>
							<p><?php echo $row_who['about_desc'] ?></p>
						</div>
					</div>
					<div class="col-lg-5 pr-lg-5 text-center d-none d-lg-block">
							<img src="img/<?php echo $row_who['about_img'] ?>" alt="" class="img-fluid" style="max-width:100%;">
					</div>
				</div>
				<?php } } } ?>
			</div>
			<!-- /container -->
		
			<div class="bg_white">
				<div class="container margin_60_35">
					<div class="main_title">
						<h2>Pse të zgjedhni DealAim</h2>
						<p>Mbi të gjitha si kompani jemi të pa konkurentë në vendin tonë.</p>
					</div>
					<div class="row">
						<?php 
							$select_whyus = prep_stmt("SELECT * FROM about WHERE about_layout = ? order by about_id desc", "pse_ne", "s");
							if(mysqli_num_rows($select_whyus) > 0){
								while($row_why = mysqli_fetch_array($select_whyus)){
						?>
						<div class="col-lg-4 col-md-6">
							<div class="box_feat">
								<i class="<?php echo $row_why['about_img']; ?>"></i>
								<h3><?php echo $row_why['about_title']; ?></h3>
								<p><?php echo $row_why['about_desc']; ?></p>
							</div>
						</div>
						<?php } } ?>
						
					</div>
					<!--/row-->
				</div>
			</div>
			<!-- /bg_white -->
		<!-- /container -->
	</main>
	<!--/main-->
	
<?php require "footer.php";?>
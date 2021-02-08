<?php 
    require_once("db.php");
	require "header.php";
	if(isset($_GET['sub_cat'])){
		$cat_id = $_GET['sub_cat'];
		//change isAPPROVED TO 1
		$select_all_prod = prep_stmt("SELECT * FROM products WHERE cat_id = ? AND prod_isApproved = ?", array($cat_id,0), "ii");
		// $select_all_prod_spec = prep_stmt("SELECT * FROM prod_specifications WHERE cat_id = ?", $cat_id,"i");
	}

?>	
	<main>
		<div class="top_banner">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
				<div class="container">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Category</a></li>
						</ul>
					</div>
					<h1>Shoes - Grid listing</h1>
				</div>
			</div>
			<img src="img/bg_cat_shoes.jpg" class="img-fluid" alt="">
		</div>
		<!-- /top_banner -->
		<div class="container margin_30">
			<div class="row small-gutters">
				<?php 
				if(mysqli_num_rows($select_all_prod)){
					while($row_prod =mysqli_fetch_array($select_all_prod)){
						$prod_pics = explode("|", $row_prod['prod_img']); 
				?>
						<div class="col-6 col-md-4 col-xl-3">
							<div class="grid_item">
								<figure>
									<span class="ribbon off"><!-- if it is from more than 2 days ago show old else show new --></span>
									<a href="details.php">
										<img class="img-fluid lazy" src="img/products/laptops/<?php echo $prod_pics[0]; ?>"  alt="">
									</a>
									<div data-countdown="<?php echo $row_prod['prod_to']; ?>" class="countdown"></div>
								</figure>
								<a href="details.php">
									<h3><?php echo $row_prod['prod_title'] ;?></h3>
								</a>
								<div class="price_box">
									<!-- <span>Çmimi aktual është:</span> -->
									<span class="new_price"><?php echo $row_prod['prod_price'] . " €"; ?></span>
								</div>
								<ul>
									<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
									<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
									<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
								</ul>
							</div>
							<!-- /grid_item -->
						</div>
				<?php } } ?>
				<!-- /col -->
				
				
			<!-- /row -->
				
			<div class="pagination__wrapper">
				<!-- <ul class="pagination">
					<li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
					<li>
						<a href="#0" class="active">1</a>
					</li>
					<li>
						<a href="#0">2</a>
					</li>
					<li>
						<a href="#0">3</a>
					</li>
					<li>
						<a href="#0">4</a>
					</li>
					<li><a href="#0" class="next" title="next page">&#10095;</a></li>
				</ul> -->
			</div>
				
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->
	
<?php
    require "footer.php";
?>  
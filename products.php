<?php 
    require_once("db.php");
	require "header.php";
	if(isset($_GET['sub_cat'])){
		$cat_id = $_GET['sub_cat'];
		//change isAPPROVED TO 1
		$today = date("Y-m-d h:i:s");
		$select_all_prod = prep_stmt("SELECT * FROM products WHERE cat_id = ? AND prod_isApproved = ? AND prod_from <= ?", array($cat_id,1,$today), "iis");
		// $select_all_prod_spec = prep_stmt("SELECT * FROM prod_specifications WHERE cat_id = ?", $cat_id,"i");

		$cat_ttl = prep_stmt("SELECT cat_title FROM categories WHERE cat_id = ?", $cat_id, "i");
		$cat_title = mysqli_fetch_array($cat_ttl);
	}

?>	
	<main>
		<div class="top_banner">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
				<div class="container">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">DealAIM</a></li>
							<?php  ?>
							<li><a href="#">Kategoria</a></li>
						</ul>
					</div>
					<h1><?php echo $cat_title['cat_title']; ?></h1>
				</div>
			</div>
			<?php if($cat_id == 2){ ?>
				<img src="img/products/laptops/random_1_bg.jpg" class="img-fluid" alt="">
			<?php } elseif($cat_id == 3){ ?>
				<img src="img/products/phones/random_1_bg.jpg" class="img-fluid" alt="">
			<?php } elseif($cat_id == 5){ ?>
				<img src="img/products/cars/random_1_bg.jpg" class="img-fluid" alt="">
			<?php } elseif($cat_id == 7){ ?>
				<img src="img/products/templates/random_1_bg.jpg" class="img-fluid" alt="">
			<?php } ?>
		</div>
		<!-- /top_banner -->
		<div class="container margin_30">
			<div class="row small-gutters ">
				<?php 
				if(mysqli_num_rows($select_all_prod))
				{
					while($row_prod =mysqli_fetch_array($select_all_prod)){
						$prod_pics = explode("|", $row_prod['prod_img']);
				?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<figure>
							<span class="ribbon off"><!-- if it is from more than 2 days ago show old else show new --></span>
							<a href="details.php?prod_details=<?php echo $row_prod['prod_id'];?>">
								<img class="img-fluid lazy" src="img/products/<?php if($cat_id == 2){echo "laptops";}else if($cat_id==3){echo "phones";}else if($cat_id == 5){ echo "cars";} ?>/<?php echo $prod_pics[0]; ?>"  alt="">
							</a>
							<div data-countdown="<?php echo $row_prod['prod_to']; ?>" class="countdown"></div>
						</figure>
						<a href="details.php?prod_details=<?php echo $row_prod['prod_id'];?>">
							<h3><?php echo $row_prod['prod_title'] ;?></h3>
						</a>
						<div class="price_box">
							<!-- <span>Çmimi aktual është:</span> -->
							<span class="new_price"><?php echo $row_prod['prod_price'] . " €"; ?></span>
						</div>
					</div>
					<!-- /grid_item -->
				</div>
				<?php } } else { ?> 
			</div>
			<div class="row justify-content-center">
					<div class="col-6 col-md-6 col-xl-6">
						<div class="grid_item">
							<div class="gabim" style="overflow-wrap:anywhere">
								<h4> NUK KA PRODUKTE </h4>
								<p> Fatkeqësisht nuk ka produkte të kësaj kategorie në ankand për momentin! </p>
							</div>
						</div>
					</div>
			</row>
				<?php } ?>
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
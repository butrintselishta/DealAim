<?php 
    require_once "db.php";

    $all_prod = prep_stmt("SELECT prod_id,prod_img,prod_title,prod_price,prod_from, prod_to,prod_description,username,cat_title,prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ? order by prod_id DESC", 3, 'i');
    
?>
<?php require "header.php"; ?>

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
					<h1>TË SHITURA</h1>
				</div>
			</div>
			<img src="img/products/random_1_closed.png" class="img-fluid" alt="">
		</div>
		<!-- /top_banner -->
		<div class="container margin_30">
			<div class="row small-gutters ">
				<?php 
				if(mysqli_num_rows($all_prod))
				{
					while($row_prod =mysqli_fetch_array($all_prod)){
						$prod_pics = explode("|", $row_prod['prod_img']);
                        $seller_username = $row_prod['username'];
                        $seller_u = substr($seller_username, 0, 1);
                        $username_n = substr($seller_username, -1);
                        $usname_str = str_repeat("*", strlen($seller_username)-2);
                        $seller = $seller_u . $usname_str . $username_n;

                        $sel_buyer = prep_stmt("SELECT username FROM prod_offers LEFT OUTER JOIN users ON prod_offers.user_id = users.user_id WHERE prod_id = ? order by offer_id desc limit 1", $row_prod['prod_id'], 'i');
                        $winner = "";
                        if(mysqli_num_rows($sel_buyer) > 0){
                            $row_buyer = mysqli_fetch_array($sel_buyer);
                            $buyer_username = $row_buyer['username'];
                            $buyer_u = substr($buyer_username, 0, 1);
                            $username_n = substr($buyer_username, -1);
                            $usname_str = str_repeat("*", strlen($buyer_username)-2);
                            $winner = $buyer_u . $usname_str . $username_n;
                        }
                        // else {
                        //     $winner = "<b style='color:red'>Nuk është shitur!</b>";
                        // }
						
				?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<figure>
                            <span class='ribbon closed'> E MBYLLUR </span>
							<a href="details.php?prod_details=<?php echo $row_prod['prod_id']; ?>">
                            <img class="img-fluid lazy" src="img/products/<?php if($row_prod['cat_title'] == "Laptop"){echo "laptops";}else if($row_prod['cat_title']=="Telefon"){echo "phones";}else if($row_prod['cat_title'] == "Vetura"){ echo "cars";}else if($row_prod['cat_title'] == "Template"){ echo "templates";} ?>/<?php echo $prod_pics[0]; ?>"  alt="">
							</a>
						</figure>
						<a href="details.php?prod_details=<?php echo $row_prod['prod_id'];?>">
							<small style="color:black;">Kategoria: </small><h3 style="color:darkslategray"><?php echo $row_prod['cat_title']; ?></h3><br/>
							<h3><?php echo $row_prod['prod_title'] ;?></h3>
						</a>
                        <div class="price_box" style="padding: .5rem 1.1rem .5rem 1.1rem;">
							<!-- <span>Çmimi aktual është:</span> -->
							<span class="seller" style="color:#d9534f; font-weight:500;">Shitësi: <a style="font-weight:750;"><?php  echo $seller;?></a></span><br/>
                            <?php if(mysqli_num_rows($sel_buyer) > 0){ ?>
                                <span class="seller" style="color:darkgreen; font-weight:500;">Fituesi: <a style="font-weight:750;"><?php  echo $winner;?> </a></span>
                                <?php } else {?>
                                    <span class="seller" style="color:red; font-weight:750;">Nuk ka pasur oferta për këtë produkt!</span>
                                <?php } ?>
						</div>
						<div class="price_box">
							<!-- <span>Çmimi aktual është:</span> -->
							<span class="new_price" style="font-weight:500 !important; font-size:.875rem;">Çmimi: <a style="font-weight:800; font-size:1rem;"><?php echo number_format($row_prod['prod_price'],2) . " €"; ?></a></span>
						</div>
                        <?php if(mysqli_num_rows($sel_buyer) > 0){ ?>
                            <a href="details.php?prod_details=<?php echo $row_prod['prod_id']; ?>"><span class="label label-success" style=" display: inline; padding: .3em 1em .3em; font-size: 75%; font-weight: 700; line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: .25em; background: #5cb85c; ">E SHITUR</span></a>
                        <?php } else {?>
                            <a href="details.php?prod_details=<?php echo $row_prod['prod_id']; ?>"><span class="label label-success" style=" display: inline; padding: .3em 1em .3em; font-size: 75%; font-weight: 700; line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: .25em; background: red; ">JO E SHITUR</span></a>
                        <?php } ?>
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
								<p> Ende nuk ka asnjë ankand të mbyllur deri në këtë moment! </p>
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

<?php require "footer.php"; ?>
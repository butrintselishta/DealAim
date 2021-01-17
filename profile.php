<?php 
    require "db.php";
    if(!isset($_SESSION['logged'])){
        header("location:index.php");
	}

	$stmt = "";
	if($_SESSION['logged'] == true){
		$stmt = prep_stmt("SELECT * FROM users WHERE username = ?", $_SESSION['user']['username'], "s");
		// $st = mysqli_num_rows($stmt); die(var_dump($st));
	}
	// if($_SESSION['user']['status'] == CONFIRMED){
	// 	$stmt = prep_stmt("SELECT * FROM users WHERE username = ?", $_SESSION['user']['username'], "s");
	// }elseif($_SESSION['user']['status'] == BUYER){
	// 	$stmt = prep_stmt("SELECT * FROM users WHERE username = ?", $_SESSION['user']['username'], "s");
	// }
?>
<?php require "header.php"; ?>

<main class="bg_gray">
    <div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
		</div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-6 col-md-8">
			<div class="box_account">
				<?php 
					if(mysqli_num_rows($stmt) > 0){
						while($row = mysqli_fetch_array($stmt)){
				?>
                <h3 class="new_client">Profili im</h3> 
                <!-- <small class="float-right pt-2" style="color:black;"><b style='font-size:15px; color:red;'>* </b> -> Fushat që duhet mbushur detyrimisht</small>
                 -->
                 
                <div class="form_container">
                <form action="" method="post">
					<div class="private box">
						<div class="row no-gutters">
							<div class="col-12 pr-1">
									<img src="img/blog-1.jpg" id="image" style="max-width:180px; border-radius: 50% !important; display: block; height:180px; margin:2% 0% 2% 42.5%;:center;">
									<input type="file" id="myfile" style="display: none;"/>
							</div>
						</div>
					</div>
					<div class="divider"><span style="background-color:#fff">Të dhënat hyrëse</span></div>
					<div class="private box" id="my_profile">
						<div class="row no-gutters">
							<div class="col-6 pr-1">
								<div class="form-group">
								<label>Përdoruesi </label>
								<input type="text" class="form-control" value="<?php echo $row['username'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<label>Fjalëkalimi </label>
									<input type="password" class="form-control"  value="password" disabled='disabled' style="text-align:center;">
								</div>
							</div>
						</div>
						<!-- /row -->
						<div class="divider"><span style="background-color:#fff">Të dhënat personale</span></div>
						<div class="row no-gutters">
							<div class="col-6 pr-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['first_name'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['last_name'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['email'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['tel_nr'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['city'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['postal_code'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
							<div class="col-12 pl-1">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row['address'] ?>" disabled="disabled" style="text-align:center;">
								</div>
							</div>
						</div>
					</div>


					<div class="private box formL" style="display:none">
						<div class="divider">
							<span style="background-color:#fff">Të dhënat bankare</span>
						</div>
						<center><div class="row no-gutters form-container active" id="">
							<div class="card-wrapper"></div>
							<form action="">
                                <div class="col-12 pl-1">
									<div class="form-group form-group1">
                                        <label> Numri i xhirollogarisë </label>
										<input type="text" name="number" id="number" class="form-control"  placeholder="xxxx xxxx xxxx xxxx" style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1">
									<div class="form-group form-group1">
                                        <label> Emri dhe Mbiemri </label>
										<input type="text" name="name" class="form-control"  placeholder="Emri dhe Mbiemri" style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1">
									<div class="form-group form-group1">
                                        <label> Data skadencës </label>
										<input type="tel" name="expiry" class="form-control" placeholder="MM/YY"  style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1">
									<div class="form-group form-group1">
                                         <label> CVV Kodi </label>
										<input type="number" name="cvc" class="form-control" placeholder="xxx"  style="text-align:center;">
									</div>
                                </div>
                                <div class="text-center btn_center"><input type="submit" name="signup" value="Vazhdo" class="btn_1 "></div>
							</form>
							</div>
                        </div>	</center>
                        
					</div>
					<hr>
					<!-- /form_container -->
					
                </form>
                </div>
				<!-- /box_account -->
				<?php } } ?>
			</div>			
        </div>
    </div>
  
    <script>
        $('form').card({
            ontainer: '.card-wrapper'
        });
        // Vanilla JavaScript
        new Card({
            form: document.querySelector('form'),
            container: '.card-wrapper'
        });

        $('form').card({
            formatting: true,
            formSelectors: {
                numberInput: 'input[name="number"]',
                expiryInput: 'input[name="expiry"]',
                cvcInput: 'input[name="cvc"]',
                nameInput: 'input[name="name"]'
            },
            cardSelectors: {
                cardContainer: '.jp-card-container',
                card: '.jp-card',
                numberDisplay: '.jp-card-number',
                expiryDisplay: '.jp-card-expiry',
                cvcDisplay: '.jp-card-cvc',
                nameDisplay: '.jp-card-name'
            },
            // custom message
            messages: {

                validDate: 'valid\nthru',
                monthYear: 'month/year'
            },

            placeholders: {
                number: '&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;',
                cvc: '&bull;&bull;&bull;',
                expiry: '&bull;&bull;/&bull;&bull;',
                name: 'Full Name'
            },
            masks: {
                cardNumber: false
            },
            classes: {
                valid: 'jp-card-valid',
                invalid: 'jp-card-invalid'
            },
            debug: false

        });
    </script>
     <script>
         //credit card max length
    </script>
</main>
<?php require "footer.php"; ?>
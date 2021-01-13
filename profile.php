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
					<div class="private box">
						<div class="row no-gutters">
							<div class="col-6 pr-1">
								<div class="form-group">
								<label>Përdoruesi </label>
								<input type="text" class="form-control" value="<?php echo $row['username'] ?>" id='username_disabled' style="text=align:center;">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<label>Fjalëkalimi </label>
									<input type="password" class="form-control"  value="password" disabled='disabled' style="text=align:center;">
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
						<!-- /row -->
						
						
						<!-- /row -->
						
					</div>
					<hr>
					<div class="text-center"><input type="submit" name="signup" value="Regjistrohu" class="btn_1 full-width"></div>
					<!-- /form_container -->
					
                </form>
                </div>
				<!-- /box_account -->
				<?php } } ?>
            </div>
        </div>
    </div>
    <script> 
        document.getElementById("username_disabled").disabled = true;
		document.getElementById("city_disabled").disabled = true;
    </script>
</main>
<?php require "footer.php"; ?>
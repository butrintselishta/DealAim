<?php 
	require "db.php";
    if($_SESSION['logged'] == false){
        header("location:signin.php");
	}

	$username = $_SESSION['user']['username']; //USERNAME I PERDORUESITTE KYCUR
	$stmt = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");

	// $stmt_fetch = mysqli_fetch_array($stmt);
	// $stmt_id = $stmt_fetch['user_id'];

	if(isset($_POST['bank_acc'])){
		$acc_number = str_replace(" ", "", $_POST['number']);
		$acc_full_name = $_POST['name'];
		$acc_expiry = $_POST['expiry'];
		$acc_cvc = $_POST['cvc'];
		$user_id = $_POST['user_id'];

		// //CREATING BANK ACCOUNT for the register user // 	//generating an account number // 	// $acc_number = array(); // 	// $acc_first_nr = rand(4,5); // 	// $acc_number[] .= $acc_first_nr; // 	// for($i = 0; $i < 15; $i++){ // 	// 	if($acc_number[0] == 5){ // 	// 		$acc_number[1] = 1; // 	// 		$acc_number[] .= rand(0,10); // 	// 	} // 	// 	else{ // 	// 		$acc_number[] .= rand(0,10); // 	// 	} // 	// } // 	// $acc_number = implode("", $acc_number); // 	// $acc_number1 = substr($acc_number,0,16); // 	// //getting the full name // 	// $acc_full_name = ucwords($fname . " " . $lname); // 	// //generating a random expiry date betwwen today and today after 10 years // 	// $todays_date = strtotime(date("Y-m-d")); // 	// $expires_at = strtotime(date("Y-m-d", strtotime("+10 years", $todays_date))); // 	// $get_date = rand($todays_date, $expires_at); // 	// $acc_expiry = date("m/Y",$get_date); // 	// //generating a cvv code // 	// $cvv = array(); // 	// for($j=0; $j<3; $j++){ // 	// 	$cvv[] = rand(0,9); // 	// } // 	// $cvv_implode = implode("", $cvv); // 	// $acc_cvv = (int)$cvv_implode; // 	
		//generating account balance // 	
		$euro = rand(10,2000); 
		$centa = rand(0,99); 
		$random = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
		$acc_balance_str = $euro . "." . $random; 
		$acc_balance = floatval($acc_balance_str); 
			 
		//inserting data (bank account)
		if(!prep_stmt("INSERT INTO bank_acc(acc_number,acc_full_name,acc_expiry, acc_cvc, acc_balance, user_id) VALUES(?,?,?,?,?,?)",array($acc_number, $acc_full_name, $acc_expiry, $acc_cvc, $acc_balance, $user_id), "sssisi")){ $_SESSION['insert_bank_acc_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ndodhi një gabim, ju lutem kthehuni më vonë dhe provoni përsëri!</p>"; header("location:profile.php"); die();}
		else{
			if(!prep_stmt("UPDATE users SET status=?,user_balance=? WHERE user_id = ?", array(BUYER,0,$user_id), "iii")){
				$_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
			}else { 
				$_SESSION['user']['status'] = BUYER;
				$_SESSION['insert_bank_acc_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi juaj është ndryshuar në <b style='color:#F0AC1A'> BLERËS </b>, bilanci juaj për momentin është <b style='color:#CF2928'>€0.00</b>. Për ta ndryshuar gjendjen e bilancit shikoni <a href='#'>udhëzimet</a> ose ndryshoni menjëher <b><a href='balance.php'>këtu</a></b></p>"; header("location:profile.php"); die();
			}
		}
	}

	//apply for seller
	if(isset($_POST['seller_apply'])){
		$id_number = $_POST['id_number'];
		$term_cond = intval($_POST['check_confirm']);//die(var_dump($check));

		if(!prep_stmt("UPDATE users SET pid_number = ?, terms_and_conditions =  ?, status=? WHERE username = ?", array($id_number,$term_cond,SELLER, $username), "iiis")){
			$_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
		}else{
			$_SESSION['user']['status'] = SELLER;
			$_SESSION['seller_status_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Statusi juaj është ndryshuar në <b style='color:#5ABC35; font-weight:900;'> SHITËS </b>, tani pos që mund të fitoni ankande si blerës, ju mund edhe të futni produkte tuaja në ankand për shitje. </p>"; header("location:profile.php"); die();
		}
	}
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
			if(mysqli_num_rows($stmt) > 0)
			{
				while($row = mysqli_fetch_array($stmt))
				{
				?>
				<h3 class="new_client">Profili im</h3> 
				<h3 class="float-right pt-2" style="font-size:15px; padding-right:.5em;">Statusi: <?php if($_SESSION['user']['status'] == CONFIRMED){ echo "<b style='color:#CF2928; font-size:15px'>I REGJISTRUAR</b></h3>"; } elseif ($_SESSION['user']['status'] == BUYER){echo "<b style='color:#F0AC1A; font-size:18px'>BLERËS</b></h3>";}else {echo "<b style='color:#5ABC35'>SHITËS</b></h3>"; } ?>
                <!-- <small class="float-right pt-2" style="color:black;"><b style='font-size:15px; color:red;'>* </b> -> Fushat që duhet mbushur detyrimisht</small>
                 -->
                <div class="form_container">
						<div class="private box">
							<div class="row no-gutters">
							<?php
								if(isset($_SESSION['prep_stmt_error'])){
									echo "<div class='gabim'>";
									echo $_SESSION['prep_stmt_error'];
									echo "</div>";
								}
								elseif(isset($_SESSION['insert_bank_acc_error'])){
									echo "<div class='gabim'>";
									echo $_SESSION['insert_bank_acc_error'];
									echo "</div>";
								}elseif(isset($_SESSION['insert_bank_acc_correct'])){
									echo "<div class='sukses'>";
									echo $_SESSION['insert_bank_acc_correct'];
									echo "</div>";
								}elseif(isset($_SESSION['seller_status_correct'])){
									echo "<div class='sukses'>";
									echo $_SESSION['seller_status_correct'];
									echo "</div>";
								};
								unset($_SESSION['prep_stmt_error']);
								unset($_SESSION['insert_bank_acc_error']);
								unset($_SESSION['insert_bank_acc_correct']);
								unset($_SESSION['seller_status_correct']);
							?>
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
								<div class="col-6 pr-1" id="formL">
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
								<div class="col-6 pl-1" >
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo $row['tel_nr'] ?>" disabled="disabled" style="text-align:center;">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo $row['city'] ?>" disabled="disabled" style="text-align:center;">
									</div>
								</div>
								<div class="col-6 pl-1" >
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo $row['postal_code'] ?>" disabled="disabled" style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1" >
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo $row['address'] ?>" disabled="disabled" style="text-align:center;">
									</div>
								</div>
							</div>
							<?php if($_SESSION['user']['status'] == BUYER || $_SESSION['user']['status'] == SELLER){
								$stmt_check_id = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
								$stmt_fetch = mysqli_fetch_array($stmt_check_id);
								$stmt_id = $stmt_fetch['user_id']; 
								$select_user_bank = prep_stmt("SELECT * FROM bank_acc WHERE user_id=?", $stmt_id, "i");  

								if(mysqli_num_rows($select_user_bank) > 0){
									while($row_bank = mysqli_fetch_array($select_user_bank)){
										$number = $row_bank['acc_number'];
										$name = $row_bank['acc_full_name'];
										$expiry = str_replace(" ", "", $row_bank['acc_expiry']);
										$cvc = $row_bank['acc_cvc']; 
										
									
										$acc_nr = substr($number, 0, 1);$acc_nr2 = substr($number, -1);
										$acc_bank_number = $acc_nr . "*** **** **** ***" . $acc_nr2;

										$name_substr1 = substr($name, 0, 1);
										$name_substr2 = substr($name, -1);
										$name_str = str_repeat("*", strlen($name)-2);
										$acc_bank_name = $name_substr1 . $name_str . $name_substr2;

										$expiry_substr1 = substr($expiry, 0, 1);
										$expiry_substr2 = substr($expiry, -1);
										$expiry_str = str_repeat("*", strlen($expiry)-2);
										$acc_bank_expiry = $expiry_substr1 . $expiry_str . $expiry_substr2;

										$cvc_substr = substr_replace($cvc, "***", 0, strlen($cvc));
									}
								}
									
							?>
								<div class="divider"><span style="background-color:#fff">Të dhënat bankare</span></div>
								<div class="private box" id="">
									<center>
									<div class="row no-gutters form-container active" id="">
										<form style="width:100%;">
											<div class="col-12 pl-1">
												<div class="form-group form-group1">
													<label> Numri i xhirollogarisë </label>
													<input type="text" name="number" placeholder="<?php echo $acc_bank_number; ?>" class="form-control" style="text-align:center;" disabled="disabled">
												</div>
											</div>
											<div class="col-12 pl-1">
												<div class="form-group form-group1">
													<label> Emri dhe Mbiemri </label>
													<input type="text" name="name" placeholder="<?php echo $acc_bank_name ?>" class="form-control"   style="text-align:center;" disabled="disabled">
												</div>
											</div>
											<div class="col-12 pl-1" id="formBuyer">
												<div class="form-group form-group1">
													<label> Data skadencës </label>
													<input type="tel" name="expiry" class="form-control"   style="text-align:center;" placeholder="<?php echo $acc_bank_expiry ?>" disabled="disabled">
												</div>
											</div>
											<div class="col-12 pl-1">
												<div class="form-group form-group1">
													<label> CVV Kodi </label>
													<input type="number" name="cvc" class="form-control"   style="text-align:center;" placeholder="<?php echo $cvc_substr ?>" disabled="disabled">
												</div>
											</div>
										</form>
									</div>	
									</center>
								</div>
							<?php }  ?>
							<?php if($_SESSION['user']['status'] == CONFIRMED){ ?>
							<div class="text-center" style="margin-bottom:15px;"><a href="#formL" onclick="showFormBuyer()" class="btn_1 ">Apliko për blerës</a></div> 
							<?php } elseif($_SESSION['user']['status'] == BUYER){ ?>
							<div class="text-center" style="margin-bottom:15px;"><a href="#formBuyer" onclick="showFormSeller()" id="showSellerForm" class="btn_1 ">Apliko për shitës</a></div> 
							<?php } ?>
						</div>

						<div class="private box" id="showForm" style="display:none">
							<div class="divider">
								<span style="background-color:#fff">Të dhënat bankare</span>
							</div>
							<center>
							<div class="row no-gutters form-container active" id="">
								<form method="POST" action="profile.php" id="acc_form" style="width:100%;">
							  		<div class="card-wrapper"></div>
									<div class="col-12 pl-1">
										<div class="form-group form-group1">
											<label> Numri i xhirollogarisë </label>
											<input type="text" name="number" id="number" class="form-control" placeholder="xxxx xxxx xxxx xxxx" style="text-align:center;">
										</div>
									</div>
									<div class="col-12 pl-1" >
										<div class="form-group form-group1">
											<label> Emri dhe Mbiemri </label>
											<input type="text" name="name" id="name" class="form-control"  placeholder="Emri dhe Mbiemri" style="text-align:center;">
										</div>
									</div>
									<div class="col-12 pl-1">
										<div class="form-group form-group1">
											<label> Data skadencës </label>
											<input type="tel" name="expiry" id="expiry" class="form-control" placeholder="MM/YY"  style="text-align:center;">
										</div>
									</div>
									<div class="col-12 pl-1">
										<div class="form-group form-group1">
											<label> CVV Kodi </label>
											<input type="number" name="cvc" id="cvc" class="form-control" placeholder="xxx"  style="text-align:center;">
										</div>
									</div>
									<div class="col-12 pl-1" >
										<div class="form-group form-group1" >
											<input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'] ?>" style="text-align:center;">
										</div>
									</div>
									<!-- <div class="col-12 pl-1" id="cashInput" style="display:none;">
										<div class="form-group form-group1">
											<label> Shuma </label> <small> (Shuma që dëshironi të nxjerrni) </small>
											<input type="number" name="shuma" id="shuma" class="form-control" placeholder="xxx"  style="text-align:center;">
										</div>
									</div> -->
									<div class="text-center btn_center" style="margin-bottom:15px;"><button type="submit" id="apply" name="bank_acc" value="Vazhdo" class="btn_1 ">APLIKO</button></div>
								</form>
							</div>	
							</center>
						</div>
						
						<!-- SELLER data -->
						<?php if($_SESSION['user']['status'] == SELLER){ ?>
							<div class="private box" margin-top:3em;>
							<div class="divider">
								<span style="background-color:#fff">Të dhënat shtesë</span>
							</div>
							<center>
							<div class="row no-gutters form-container active" id="">
								<form style="width:100%;">
									<div class="clearfix add_bottom_15 ">
										<?php 
										$stmt = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
										if(mysqli_num_rows($stmt) > 0){
											while($seller_sel = mysqli_fetch_array($stmt))
											{
										?>
										<div class="checkboxes float-center">
											<div class="form-group form-group1">
												<label style="font-weight:500;color:black;"> ID Identifikuese </label>
												<input type="text" class="form-control"  placeholder="<?php echo $seller_sel['pid_number']; ?>" style="text-align:center;" readonly>
											</div>
										</div>
										<?php } } ?>
									</div>
								</form>
							</div>	
							</center>
						</div>
						<?php } ?>

						<!-- SELLER application -->
						<div class="private box" id="showForm_seller" style="display; margin-top:3em;display:none;">
							<div class="divider">
								<span style="background-color:#fff">Aplikimi për shitës</span>
							</div>
							<center>
							<div class="row no-gutters form-container active" id="">
								<form method="POST" action="profile.php" id="form_seller" style="width:100%;">
									<div class="clearfix add_bottom_15" style="width:42.5%;overflow-wrap: anywhere; text-align:left; background-color:#f9f9f9">
										<div class="checkboxes float-center">
											<small style="color:red; font-weight:700;"><i class="ti-hand-point-right" style="color:black;"></i> Shënoni ID-në identifikuese tek fusha e parë, është e domosdoshme.</small><br/>
											<small style="color:red; font-weight:700;"><i class="ti-hand-point-right" style="color:black;"></i> Ju lutem lexoni me kujdes <a href="#" style="font-weight:900;"> Termet dhe Kushtet</a>, pas pranimit të tyre përgjegjësia është mbi ju. </small>
										</div>
									</div>
									<div class="clearfix add_bottom_15 ">
										<div class="checkboxes float-center">
											<div class="form-group form-group1">
												<input type="text" name="id_number" id="id_number" class="form-control"  placeholder="Numri pasaportes (ID identifikuese)" style="text-align:center;">
											</div>
										</div>
									</div>
									<div class="clearfix add_bottom_15">
										<div class="checkboxes float-center">
											<label class="container_check" style="color:black;">Duke klikuar këtu, unë i pranoj <a href="#" style="font-weight:900;"> Termet dhe Kushtet. <b style="color:red">*</b></a>
												<input type="checkbox" value="" name="check_confirm" id="check_confirm" onclick="calc()">
												<span class="checkmark" name="checkmark" id="checkmark" style="margin-left:34%;"></span>
											</label>
										</div>
									</div> 
									<div class="text-center btn_center" style="margin-bottom:15px;"><button type="submit" id="seller_apply" name="seller_apply" value="Vazhdo" class="btn_1 ">APLIKO</button></div>
								</form>
							</div>	
							</center>
						</div>
						<!-- /form_container -->
                </div>
				<!-- /box_account -->
	 <?php } 	} ?>
			</div>			
        </div>
	</div>
	<script>
		function showFormSeller() {
			var e = document.getElementById("showForm_seller");
    	   	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
        }
		var id_num = false; var is_check = false;
		function calc(){
			var isChecked = document.getElementById("check_confirm");
			if(isChecked.checked){
				isChecked.value = 1;
				is_check = true;
			}else{
				isChecked.value=0;
				is_check = false;
			}
		}
		
		document.getElementById("id_number").onkeyup = function() 
		{
			var id_number = document.getElementById('id_number');
			if(id_number.value.match('^\\d+$')){
				if(id_number.value.length >= 8 && id_number.value.length <= 15){
					id_number.style.borderColor = "green";
					id_number.style.color = "green";
					id_num = true;
				}else{
					id_number.style.borderColor = "red";
					id_number.style.color = "red";
					id_num = false;
				}
			}else{
				id_number.style.borderColor = "red";
				id_number.style.color = "red";
				id_num = false;
			}
		}

		document.querySelector("#seller_apply").addEventListener("click", function(event) {
			if(id_num == true && is_check == true){
				document.getElementById("form_seller").submit();
			}else{
				event.preventDefault();
			}
        });  
	</script>
	<script>

		var acc_nr_valid = false; var acc_name_valid = false; var acc_expiry_valid = false; var acc_cvc_valid = false;
		//CHECKING ACC NUMBER
		document.getElementById("number").onkeyup = function() 
		{
			var acc_number = document.getElementById('number');
			//check if first number is 4
			if(acc_number.value.substring(0,1) == 4 || acc_number.value.substring(0,1) == 5)
			{ 
				if(acc_number.value.length == 19){
					if(acc_number.value.substring(0,1) == 4){
						acc_nr_valid = true;
						document.getElementById("name").focus();
						acc_number.style.borderColor = "green";
						acc_number.style.color = "green";
					}
					else if(acc_number.value.substring(0,1) == 5 && acc_number.value.substring(1,2) == 1 || acc_number.value.substring(1,2) == 2 || acc_number.value.substring(1,2) == 3 || acc_number.value.substring(1,2) == 4 || acc_number.value.substring(1,2) == 5){
						acc_nr_valid = true;
						document.getElementById("name").focus();
						acc_number.style.borderColor = "green";
						acc_number.style.color = "green";
					}
					else {
						// swal("GABIM!", "Kjo xhirollogari nuk është valide!", "error");
						acc_number.style.borderColor = "red";
						acc_number.style.color = "red";
					}
				}
				else{
					// swal("GABIM!", "Kjo xhirollogari nuk është valide!", "error");
					acc_number.style.borderColor = "red";
					acc_number.style.color = "red";
				}
			}else {
				acc_number.style.borderColor = "red";
				acc_number.style.color = "red";
			}
		}
		//CHECKING NAME
		document.getElementById("name").onkeyup = function() 
		{
			var acc_name = document.getElementById('name');
			var letters = /^[a-zA-Z][a-zA-Z\s]*$/;
			//check if name is alphabetic
			if(acc_name.value.match(letters)){
				if(acc_name.value.length > 10){
					acc_name_valid = true;
					acc_name.style.borderColor = "green";
					acc_name.style.color = "green";
				}else{
					acc_name.style.borderColor = "red";
					acc_name.style.color = "red";
				}
			}else{
				acc_name.style.borderColor = "red";
				acc_name.style.color = "red";
			}
		}

		//CHECKING NAME
		document.getElementById("name").onkeyup = function() 
		{
			var acc_name = document.getElementById('name');
			var letters = /^[a-zA-Z][a-zA-Z\s]*$/;
			//check if name is alphabetic
			if(acc_name.value.match(letters)){
				if(acc_name.value.length > 10){
					acc_name_valid = true;
					acc_name.style.borderColor = "green";
					acc_name.style.color = "green";
				}else{
					acc_name.style.borderColor = "red";
					acc_name.style.color = "red";
				}
			}else{
				acc_name.style.borderColor = "red";
				acc_name.style.color = "red";
			}
		}

		//CHECKING DATE
		document.getElementById("expiry").onkeyup = function() 
		{
			var acc_expiry = document.getElementById('expiry');
			//check 
			if(acc_expiry.value.length == 9){
				if(acc_expiry.value.substring(5,9) == 2021 && acc_expiry.value.substring(0,2) >= 3 &&acc_expiry.value.substring(0,2) <= 12){
					acc_expiry_valid = true;
					document.getElementById("cvc").focus();
					acc_expiry.style.borderColor = "green";
					acc_expiry.style.color = "green";
				}
				else if(acc_expiry.value.substring(0,2) >= 01 && acc_expiry.value.substring(0,2) <= 12 && acc_expiry.value.substring(5,9) >= 2022 && acc_expiry.value.substring(5,9) <= 2031){
					acc_expiry_valid = true;
					document.getElementById("cvc").focus();
					acc_expiry.style.borderColor = "green";
					acc_expiry.style.color = "green";
				}
				else{
					acc_expiry.style.borderColor = "red";
					acc_expiry.style.color = "red";
				}
			}else{
				acc_expiry.style.borderColor = "red";
				acc_expiry.style.color = "red";
			}
		}

		//CHECKING CVC
		document.getElementById("cvc").onkeyup = function() 
		{
			var acc_cvc = document.getElementById('cvc');
			//check 
			if(acc_cvc.value.length == 3){
				acc_cvc_valid = true;
				document.getElementById("apply").focus();
				acc_cvc.style.borderColor = "green";
				acc_cvc.style.color = "green";
			}
			else{
				acc_cvc.style.borderColor = "red";
				acc_cvc.style.color = "red";
			}
		}
        document.querySelector("#apply").addEventListener("click", function(event) {
			if(acc_nr_valid == true && acc_name_valid == true && acc_expiry_valid == true && acc_cvc_valid == true){
				// document.getElementById('cashInput').style.display = "block";
				// event.preventDefault();
				document.getElementById("acc_form").submit();
			}else{
				event.preventDefault();
			}
        });  
    </script>
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
</main>
<?php require "footer.php"; ?>
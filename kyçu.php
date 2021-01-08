<?php
  header('Content-type: text/html; charset=utf-8');
  
  require_once("db.php");
  
	if(isset($_POST['signup'])){
		$user = $_POST['username']; $password_1 = $_POST['password_1']; $password_2 = $_POST['password_2']; $fname = $_POST['first_name']; $lname = $_POST['last_name']; $email = $_POST['email']; $phone = $_POST['phone']; $bday = $_POST['bday']; $city = $_POST['city']; $post = $_POST['postcode'];
		if(empty($user) || empty($password_1) || empty($password_2)){
			die ("Shkruaj fushat e nevojshme");
		}else {


			$to = 'butrintse@gmail.com';
			$subject = "My subject";
			$txt = "<html lang='en'>
      <head>
       <meta http-equiv='content-type' content='text/html; charset=utf-8'>
      
        <title>Email Confirmation</title>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
      
        <!--[if lt IE 9]>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js'></script>
        <![endif]-->
        
        <style>
          body {
            background-color: #ccc;
          }
          .card {
            width: 65%;
            background-color: #f1f1f1;
            margin:  50px auto;
            text-align: center;
            padding: 35px 15px;
            border-radius: 4px;   
          }
          .message {
            padding-bottom: 30px;
          }
          .button {
            color: #fff;
            background-color: #6435c9;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 4px;
          }
          .link-text {
            margin-top: 30px;
          }
          .footer {
            margin-top: 30px;
            text-align: center;
          }
        </style>
      </head>
      <body>
        <div class='card'>
          <h1 class='h1-font'>Konfirmimi i Emailit</h1>
          <p class='message'>
            Përshëndetje @USER, ju falemnderojmë që dëshironi të bashkoheni me <b>DealAim</b>.  
            Ju lutem klikoni në butonin e më poshtëm për të verifikuar emailin.
          </p>  
          <a class='button' href='#'>Verifiko emailin</a>
          <p class='link-text'>
            ose kopjojeni linkun e mëposhtem dhe vendoseni ne një nga browseret tuaj:<br />
            @LINK
          </p>
        </div>
        <p class='footer'>
          Email i dërguar nga DealAim <br />
          Copyright © 2021 DealAim. Të gjitha të drejtat e rezervuara
        </p>
      </body>
      </html>";
			$headers = "From: email_confirm@dealaim.com" . "\r\n" ;
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


			mail($to,$subject,$txt,$headers);
		}
	}
	require "header.php";
?>
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
		<h1>Kyçu ose krijo llogari të re</h1>
	</div>
	<!-- /page_header -->
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Tashmë përdorues?</h3>
					<div class="form_container">
					
						<div class="divider"><span>Kyçu këtu</span></div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password_in" id="password_in" value="" placeholder="Password*">
						</div>
						<div class="clearfix add_bottom_15">
							<div class="checkboxes float-left">
								<label class="container_check">Remember me
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="float-right"><a id="forgot" href="javascript:void(0);">Keni harruar fjalëkalimin?</a></div>
						</div>
						<div class="text-center"><input type="submit" name="signin" value="Log In" class="btn_1 full-width"></div>
						<div id="forgot_pw">
							<div class="form-group">
								<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Shkruaj e-mailin tuaj">
							</div>
							<div class="float-left" style="padding-left:5px;"><a id="forgot" href="kyçu.php">Kthehu prapa</a></div>
							<div class="float-right"><input type="submit" value="Ndrysho Fjalëkalimin" class="btn_1"></div>
							
						</div>
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
				<div class="row">
					<div class="col-md-6 d-none d-lg-block">
						<ul class="list_ok">
							<li>MBI 1000+ PRODUKTE</li>
							<li>MBI 3000+ KLIENT</li>
							<li>TE DHENA TE SIGURTA</li>
						</ul>
					</div>
					<div class="col-md-6 d-none d-lg-block">
						<ul class="list_ok">
							<li>PAGESA TE SIGURTA</li>
							<li>24h MBESHTETJE</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<form action="" method="post">
						<h3 class="new_client">Përdorues i ri</h3> <small class="float-right pt-2" style="color:red;">* - Fushat që duhet mbushur detyrimisht</small>
						<div class="form_container">
							<div class="form-group">
								<input type="text" class="form-control" name="username" id="email_2" placeholder="Nickname *">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password_1" id="password_in_2" value="" placeholder="Fjalëkalimi *">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password_2" id="password_in_2" value="" placeholder="Rishkruaj fjalëkalimin *">
							</div>
							<hr>
							
							<div class="private box">
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="text" class="form-control" name="first_name" placeholder="Emri *">
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<input type="text" class="form-control" name="last_name" placeholder="Mbiemri *">
										</div>
									</div>
									<!-- <div class="col-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Full Address*">
										</div>
									</div> -->
								</div>
								<!-- /row -->
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="text" class="form-control" name="email" placeholder="Email *">
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<input type="text" class="form-control" name="phone" placeholder="Nr.Tel ">
										</div>
									</div>
									
									<div class="col-12 pr-1">
										<div class="form-group">
											<label style="padding-left:.2em;">Datëlindja *</label>
											<input type="text" class="form-control datepicker-3"  id="datelindja" name="bday" value="dd/mm/yy" placeholder="             Datëlindja *">
										</div>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="text" class="form-control" name="city" placeholder="Qyteti *">
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<input type="text" class="form-control" name="postcode" placeholder="Kodi Postar *">
										</div>
									</div>
								</div>
								
								<!-- /row -->
								
								<div class="row no-gutters">
									<div class="col-12 pr-1">
										<div class="form-group">
											<input type="text" class="form-control" name="address" placeholder="Adresa, Nr." >
										</div>
									</div>
								</div>
								<!-- /row -->
							</div>
							<!-- /private -->
							<!-- <div class="company box" style="display: none;">
								<div class="row no-gutters">
									<div class="col-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Company Name*">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Full Address">
										</div>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="City*">
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Postal Code*">
										</div>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<div class="custom-select-form">
												<select class="wide add_bottom_10" name="country" id="country_2">
														<option value="" selected="">Country*</option>
														<option value="Europe">Europe</option>
														<option value="United states">United states</option>
														<option value="Asia">Asia</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Telephone *">
										</div>
									</div>
								</div>
							</div> -->
							<!-- /company -->
							<hr>
							<div class="text-center"><input type="submit" name="signup" value="Regjistrohu" class="btn_1 full-width"></div>
					</form>
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->

	    <!-- Js Plugins per DATEPICKER -->
		<script src="js/datepicker/jquery-3.3.1.min.js"></script>
		<script src="js/datepicker/jquery-ui.min.js"></script>
		<script src="js/datepicker/jquery.slicknav.js"></script>
		<script src="js/datepicker/main.js"></script>	
	</main>
	<!--/main-->
	
<?php require "footer.php"; ?>
<?php
	require_once("db.php");
	if(isset($_POST['signup'])){
		$user = $_POST['username']; $password_1 = $_POST['password_1']; $password_2 = $_POST['password_2']; $fname = $_POST['first_name']; $lname = $_POST['last_name']; $email = $_POST['email']; $phone = $_POST['phone']; $bday = $_POST['bday']; $city = $_POST['city']; $post = $_POST['postcode'];
		if(empty($user) || empty($password_1) || empty($password_2)){
			die ("Shkruaj fushat e nevojshme");
		}else {


			$to = 'butrintse@gmail.com';
			$subject = "My subject";
			$txt = "<head>

  <meta charset='utf-8'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <title>Email Confirmation</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <style type='text/css'>
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*='margin: 16px 0;'] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style='background-color: #e9ecef;'>

  <!-- start preheader -->
  <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
    A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <!-- start logo -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' valign='top' style='padding: 36px 24px;'>
              <a href='https://sendgrid.com' target='_blank' style='display: inline-block;'>
                <img src='css/facebook_icon.png' alt='Logo' border='0' width='48' style='display: block; width: 48px; max-width: 48px; min-width: 48px;'>
              </a>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
              <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Confirm Your Email Address</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>Tap the button below to confirm your email address. If you didn't create an account with <a href='https://sendgrid.com'>Paste</a>, you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align='left' bgcolor='#ffffff'>
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td align='center' bgcolor='#1a82e2' style='border-radius: 6px;'>
                          <a href='https://sendgrid.com' target='_blank' style='display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;'>Do Something Sweet</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>If that doesn't work, copy and paste the following link in your browser:</p>
              <p style='margin: 0;'><a href='https://sendgrid.com' target='_blank'>https://same-link-as-button.url/xxx-xxx-xxxx</a></p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
              <p style='margin: 0;'>Cheers,<br> Paste</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start permission -->
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'>You received this email because we received a request for [type_of_action] for your account. If you didn't request [type_of_action] you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'>To stop receiving these emails, you can <a href='https://sendgrid.com' target='_blank'>unsubscribe</a> at any time.</p>
              <p style='margin: 0;'>Paste 1234 S. Broadway St. City, State 12345</p>
            </td>
          </tr>
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>";
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
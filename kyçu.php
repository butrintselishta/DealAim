<?php
  header('Content-type: text/html; charset=utf-8');
  
  require_once("db.php");
  
	if(isset($_POST['signup'])){
		$user = trim($_POST['username']); $password_1 = $_POST['password_1']; $password_2 = $_POST['password_2']; trim($fname = $_POST['first_name']); $lname = trim($_POST['last_name']); trim($email = $_POST['email']); $phone = trim($_POST['phone']); $bday = $_POST['bday']; $city = trim($_POST['city']); $post = trim($_POST['postcode']); $address = $_POST['address'];
		
	$userError = false; $passwordError = false; $fnameError = false; $lnameError = false; $emailError = false; $phoneError = false; $cityError=false; $postnrError = false; $addressError = false; $bdayError = false;
	$_SESSION['signup_errors'] = array();
  
	//USERNAME ERRORS
	if (empty($user)) { $userError = true; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["userError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'> Kjo fushë nuk mund të jetë e zbrazët </small>"]; } elseif(strlen($user) < 5) { $userError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["userError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Nofka është shumë e shkurtë (minimumi është 5 karaktere)</small>"]; } elseif(strlen($user) > 20) { $userError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["userError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Nofka është shumë e gjatë (maksimumi është 20 karaktere)</small>"]; }

	//PASSWORD ERRORS
	if ($password_1 !== 'a') { if (empty($password_1)) { $passwordError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazet</small>"]; } elseif(strlen($password_1) < 8) { $passwordError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Fjalëkalimi duhet ti ketë të pakten 8 karaktere</small>"]; } elseif(strlen($password_1) > 50) { $passwordError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'>Fjalëkalimi mund ti ketë më së shumti 50 karaktere</small>"]; } elseif(!preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+#', $password_1)) { $passwordError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["passwordError" => "<small style='color:red; font-weight:bold; text-align:left;'> Fjalëkalimi duhet të përmbaj së paku: <div style='text-align:left;'><ul> <li>Një shkronjë të madhe (A-Z)</li><li>Një shkronjë të vogel (a-z)</li><li>Një numer (1-9)</li><li>Një simbol (!-#$^?>)</li> </ul></div></small>"]; } elseif($password_1 !== $password_2) { $passwordError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["passwordError" => "<small class='form-text text-muted' style='font-weight:bold; color:red !important;'> Fjalëkalimet nuk përputhen </small>"]; } }

	//FIRST NAME ERRORS
	if (empty($fname)) { $fnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(strlen($fname) < 2) { $fnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Emri është shumë i shkurtë</small>"]; } elseif(strlen($fname) > 15) { $fnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Emri është shumë i gjatë</small>"]; } elseif(!ctype_alpha($fname) && !((strpos($fname, 'ë')) || (strpos($fname, 'Ë')) || (strpos($fname, 'ç')) || (strpos($fname, 'Ç')))) { $fnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["fnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Emri duhet të jetë në rangun A-ZH</small>"]; }

	//LAST NAME ERRORS
	if (empty($lname)) { $lnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(strlen($lname) < 2) { $lnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Mbiemri është shumë i shkurtë</small>"]; } elseif(strlen($lname) > 15) { $lnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Mbiemri është shumë i gjatë</small>"]; } elseif(!ctype_alpha($lname) && !((strpos($lname, 'ë')) || (strpos($lname, 'Ë')) || (strpos($lname, 'ç')) || (strpos($lname, 'Ç')))) { $lnameError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["lnameError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Mbiemri duhet të jetë në rangun A-ZH</small>"]; }

	//EMAIL ERRORS
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $emailError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["emailError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Email nuk është shkruar në formatin e duhur</small>"]; }

	//TEL NUMBER ERROR
	if (!is_numeric($phone) && !((strpos($phone, '+')) || (strpos($phone, '-')))) { $phoneError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_email'] = $email; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["phoneError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë lejon vetëm +, - dhe numra 0 deri 9</small>"]; } elseif((strlen($phone) < 8) || (strlen($phone) > 16)) { $phoneError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_email'] = $email; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["phoneError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen 8 deri 16 numra</small>"]; }

	//CITY ERRORS
	if (empty($city)) { $cityError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["cityError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; } elseif(!ctype_alpha($city)) { $cityError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["cityError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Qyteti duhet të jetë në rangun A-ZH</small>"]; } elseif((strlen($city) < 4) || (strlen($city) > 15)) { $cityError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["cityError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen 4 deri në 15 shkronja</small>"]; }
	
	//POSTAL CODE ERROR
	if (empty($post)) { $postnrError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["postnrError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; }elseif(!is_numeric($post)) { $postnrError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email;$_SESSION['save_city'] = $city; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["postnrError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen vetëm numra</small>"]; }elseif(strlen($post) !== 5) { $postnrError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city;$_SESSION['save_postnr'] = $post; $_SESSION['save_address'] = $address; $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["postnrError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Lejohen vetëm 5 numra</small>"]; } if (empty($address)) { $addressError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email; $_SESSION['save_city'] = $city; $_SESSION['save_postnr'] = $post;  $_SESSION['save_bday'] = $bday; $_SESSION['signup_errors'] += ["addressError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Kjo fushë nuk mund të jetë e zbrazët</small>"]; }

	//BDAY ERRORS
	if(!is_numeric($bday)) { $bdayError = true; $_SESSION['save_user'] = $user; $_SESSION['save_fname'] = $fname; $_SESSION['save_lname'] = $lname; $_SESSION['save_phone'] = $phone; $_SESSION['save_email'] = $email;$_SESSION['save_city'] = $city; $_SESSION['save_address'] = $address; $_SESSION['signup_errors'] += ["bdayError" => "<small id='emailHelp' class='form-text text-muted' style='font-weight:bold; color:red !important;'>Datëlindja nuk është në formatin e duhur</small>"]; }

	if($userError || $passwordError || $fnameError || $lnameError || $emailError || $phoneError || $cityError || $postnrError || $bdayError){
		header('location: kyçu.php'); die();
	}
	
	else {

			// PAPERCUT email confirmation
			$to = 'butrintse@gmail.com';
			$subject = "My subject";
			$txt = "<head> <style type='text/css'> /* CLIENT-SPECIFIC STYLES */ body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } /* RESET STYLES */ img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } /* iOS BLUE LINKS */ a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } /* MOBILE STYLES */ @media screen and (max-width:600px) { h1 { font-size: 32px !important; line-height: 32px !important; } } /* ANDROID CENTER FIX */ div[style*='margin: 16px 0;'] { margin: 0 !important; } </style> </head> <body> <!-- HIDDEN PREHEADER TEXT --> <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'> This email was sent automatically. </div> <table border='0' cellpadding='0' cellspacing='0' width='100%'> <!-- LOGO --> <tr> <td bgcolor='#2C4EDA' align='center'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> <tr> <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> <a href='#' target='_blank'> <img alt='Logo' src='https://i.ibb.co/KjK19sr/logo.png' width='200' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'> </a> </td> </tr> </table> </td> </tr> <!-- HERO --> <tr> <td bgcolor='#2C4EDA' border='0' align='center' style='padding: 0px 10px 0px 10px;'> <table cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px; margin-bottom: -3px;'> <tr> <td bgcolor='#ffffff' align='left' valign='top' style='padding: 40px 30px 20px 30px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;'> <h1 style='font-size: 30px; font-weight: 400; margin: 0; text-align:center;'>Konfirmo Emailin</h1> </td> </tr> </table> </td> </tr> <!-- COPY BLOCK --> <tr> <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> <!-- COPY --> <tr> <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;'> <p style='margin: 0; text-align:left;'>Tap the button below to reset your customer account password. If you didn't request a new password, you can safely delete this email.</p> </td> </tr> <!-- BULLETPROOF BUTTON --> <tr> <td bgcolor='#ffffff' align='left'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td bgcolor='#ffffff' align='center' style='padding: 15px 30px 15px px;'> <table border='0' cellspacing='0' cellpadding='0'> <tr> <td align='center' style='border-radius: 3px;' bgcolor='#1a82e2'><a href='#' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; display: inline-block;'>KONFIRMO</a></td> </tr> </table> </td> </tr> <tr> <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;'> <p style='margin: 0; text-align:left;'>Nese butoni nuk funksionon atehere mereni linkun e meposhtem dhe vendoseni ne browser:<br> <a href='#'>http//127.0.0.1/dealaim/xxxxx-xxxx-xxxx</a> </p> </td> </tr> <tr> <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;'> <p style='margin: 0; text-align:left;'>Ju faleminderit,<br> <strong>DEALAIM</strong> </p> </td> </tr> </table> </td> </tr> </table> </td> </tr> <!-- FOOTER --> <tr> <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> <!-- ADDRESS --> <tr> <td bgcolor='#f4f4f4' align='left' style='padding: 0px 30px 30px 30px; color: #666666; font-family:  Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;'> <p style='margin-top: 20px;text-align:center;'>You received this email because we received a request for reseting the password for your account. If you didn't request that, you can safely delete this email.</p> </td> </tr> <tr> <td bgcolor='#f4f4f4' align='left' style='padding: 0px 30px 30px 30px; color: #666666; font-family:  Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;'> <p style='margin-top: 20px;text-align:center;'>To stop receiving these emails, you can unsuscribe at anytime.<br> Colven - Ruta 11 Km 814 - (S3574XAB) Guadalupe Norte - Santa Fe, Argentina <br> Teléfono: (+54 3482) 498800 - colven@colven.com.ar </p> </td> </tr> </table> </td> </tr> </table> </body> </html>";
			$headers = "From: email_confirm@dealaim.com" . "\r\n" ;
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


			mail($to,$subject,$txt,$headers);
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
						<h3 class="new_client">Përdorues i ri</h3> <small class="float-right pt-2" style="color:black;"><b style='font-size:15px; color:red;'>* </b> -> Fushat që duhet mbushur detyrimisht</small>
						<div class="form_container">
							<div class="form-group">
								<?php if(isset($_SESSION['signup_errors'])){
										if(array_key_exists('userError', $_SESSION['signup_errors'])){
											echo $_SESSION['signup_errors']['userError'];
										}
									} 
								?>
								<input type="text" class="form-control" name="username" id="email_2" placeholder="Nofka *" value="<?php if(isset($_SESSION['save_user'])){echo $_SESSION['save_user']; } unset($_SESSION['save_user']);?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('userError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
							</div>
							
							<div class="form-group">
								<?php if(isset($_SESSION['signup_errors'])){
										if(array_key_exists('passwordError', $_SESSION['signup_errors'])){
											echo $_SESSION['signup_errors']['passwordError'];
										}
									} 
								?>
								<input type="password" class="form-control" name="password_1" id="password_in_2" value="" placeholder="Fjalëkalimi *" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('passwordError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ;?>>
							</div>

							<div class="form-group">
								<input type="password" class="form-control" name="password_2" id="password_in_2" value="" placeholder="Rishkruaj fjalëkalimin *" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('passwordError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } }?>>
							</div>
							<hr>
							
							<div class="private box">
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
										
											<?php if(isset($_SESSION['signup_errors'])){
											if(array_key_exists('fnameError', $_SESSION['signup_errors'])){
															echo $_SESSION['signup_errors']['fnameError'];
													}
												}
												?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('fnameError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Emri *</label>
											<input type="text" class="form-control" name="first_name" placeholder="Emri..." value="<?php if(isset($_SESSION['save_fname'])){ echo $_SESSION['save_fname'];} unset($_SESSION['save_fname']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('fnameError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<?php if(isset($_SESSION['signup_errors'])){
												if(array_key_exists('lnameError', $_SESSION['signup_errors'])){
															echo $_SESSION['signup_errors']['lnameError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('lnameError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Mbiemri *</label>
											<input type="text" class="form-control" name="last_name" placeholder="Mbiemri..."value="<?php if(isset($_SESSION['save_lname'])){ echo $_SESSION['save_lname'];} unset($_SESSION['save_lname']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('lnameError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>
								</div>
								<!-- /row -->
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<?php
												if(isset($_SESSION['signup_errors'])){
													if(array_key_exists('emailError', $_SESSION['signup_errors'])){
														echo $_SESSION['signup_errors']['emailError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('emailError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Email *</label>
											<input type="email" class="form-control" name="email" placeholder="filanfisteku@xxxxxx.xxx" value="<?php if(isset($_SESSION['save_email'])){ echo $_SESSION['save_email'];} unset($_SESSION['save_email']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('emailError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>

									<div class="col-6 pl-1">
										<div class="form-group">
											<?php
												if(isset($_SESSION['signup_errors'])){
													if(array_key_exists('phoneError', $_SESSION['signup_errors'])){
														echo $_SESSION['signup_errors']['phoneError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('phoneError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Nr. Telefonit</label>
											<input type="text" class="form-control" name="phone" placeholder="+383 xx xxx xxx " value="<?php if(isset($_SESSION['save_phone'])){ echo $_SESSION['save_phone'];} unset($_SESSION['save_phone']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('phoneError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>
									
									<div class="col-12 pr-1">
										<div class="form-group">
											<?php
												if(isset($_SESSION['signup_errors'])){
													if(array_key_exists('bdayError', $_SESSION['signup_errors'])){
														echo $_SESSION['signup_errors']['bdayError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('bdayError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Datëlindja</label>
											<input type="text" class="form-control datepicker-3"  id="datelindja" name="bday" value="<?php if(isset($_SESSION['save_bday'])){ echo $_SESSION['save_bday'];} else{ ?> dd/mm/yy<?php } unset($_SESSION['save_bday']);?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('bdayError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>
								</div>
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<?php
												if(isset($_SESSION['signup_errors'])){
													if(array_key_exists('cityError', $_SESSION['signup_errors'])){
														echo $_SESSION['signup_errors']['cityError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('cityError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Qyteti *</label>
											<input type="text" class="form-control" name="city" placeholder="Qyteti..." value="<?php if(isset($_SESSION['save_city'])){ echo $_SESSION['save_city'];} unset($_SESSION['save_city']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('cityError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>
									<div class="col-6 pl-1">
										<div class="form-group">
											<?php
												if(isset($_SESSION['signup_errors'])){
													if(array_key_exists('postnrError', $_SESSION['signup_errors'])){
														echo $_SESSION['signup_errors']['postnrError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('postnrError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Kodi Postar *</label>
											<input type="text" class="form-control" name="postcode" placeholder="00000" value="<?php if(isset($_SESSION['save_postnr'])){ echo $_SESSION['save_postnr'];} unset($_SESSION['save_postnr']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('postnrError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
										</div>
									</div>
								</div>
								
								<!-- /row -->
								
								<div class="row no-gutters">
									<div class="col-12 pr-1">
										<div class="form-group">
											<?php
												if(isset($_SESSION['signup_errors'])){
													if(array_key_exists('addressError', $_SESSION['signup_errors'])){
														echo $_SESSION['signup_errors']['addressError'];
													}
												}
											?>
											<label style='padding-left:.3em; <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('addressError', $_SESSION['signup_errors'])){ echo "display:none"; } } ?>'>Adresa e plotë *</label>
											<input type="text" class="form-control" name="address" placeholder="Adresa, Nr." value="<?php if(isset($_SESSION['save_address'])){ echo $_SESSION['save_address'];} unset($_SESSION['save_address']); ?>" <?php if(isset($_SESSION['signup_errors'])){ if(array_key_exists('addressError', $_SESSION['signup_errors'])){ echo "style='border-color:red'"; } } ?>>
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
	<?php unset($_SESSION['signup_errors']); ?>
<?php  require "footer.php"; ?>
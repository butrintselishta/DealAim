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


					<div class="private box formL" style="display">
						<div class="divider">
							<span style="background-color:#fff">Të dhënat bankare</span>
						</div>
						<center><div class="row no-gutters form-container active" id="">
							<div class="card-wrapper"></div>
							<form action="">
								<div class="col-12 pr-1">
									<div class="form-group">
										<input type="text" name='number' class="form-control" placeholder="numri gjirollogarise" style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1">
									<div class="form-group">
										<input type="text" name="name" class="form-control"  style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1">
									<div class="form-group">
										<input type="tel" name="expiry" class="form-control"  style="text-align:center;">
									</div>
								</div>
								<div class="col-12 pl-1">
									<div class="form-group">
										<input type="number" name="cvc" class="form-control"  style="text-align:center;">
									</div>
								</div>
							</form>
							</div>
						</div>	</center>
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
        var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
        var elements = stripe.elements();

        var style = {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                lineHeight: '40px',
                fontWeight: 300,
                fontFamily: 'Helvetica Neue',
                fontSize: '15px',

                '::placeholder': {
                    color: '#CFD7E0',
                },
            },
        };

        var cardNumberElement = elements.create('cardNumber', {
            style: style
        });
        cardNumberElement.mount('#card-number-element');

        var cardExpiryElement = elements.create('cardExpiry', {
            style: style
        });
        cardExpiryElement.mount('#card-expiry-element');

        var cardCvcElement = elements.create('cardCvc', {
            style: style
        });
        cardCvcElement.mount('#card-cvc-element');


        function setOutcome(result) {
            var successElement = document.querySelector('.success');
            var errorElement = document.querySelector('.error');
            successElement.classList.remove('visible');
            errorElement.classList.remove('visible');

            if (result.token) {
                // In this example, we're simply displaying the token
                successElement.querySelector('.token').textContent = result.token.id;
                successElement.classList.add('visible');

                // In a real integration, you'd submit the form with the token to your backend server
                //var form = document.querySelector('form');
                //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
                //form.submit();
            } else if (result.error) {
                errorElement.textContent = result.error.message;
                errorElement.classList.add('visible');
            }
        }

        var cardBrandToPfClass = {
            'visa': 'pf-visa',
            'mastercard': 'pf-mastercard',
            'amex': 'pf-american-express',
            'discover': 'pf-discover',
            'diners': 'pf-diners',
            'jcb': 'pf-jcb',
            'unknown': 'pf-credit-card',
        }

        function setBrandIcon(brand) {
            var brandIconElement = document.getElementById('brand-icon');
            var pfClass = 'pf-credit-card';
            if (brand in cardBrandToPfClass) {
                pfClass = cardBrandToPfClass[brand];
            }
            for (var i = brandIconElement.classList.length - 1; i >= 0; i--) {
                brandIconElement.classList.remove(brandIconElement.classList[i]);
            }
            brandIconElement.classList.add('pf');
            brandIconElement.classList.add(pfClass);
        }

        cardNumberElement.on('change', function(event) {
            // Switch brand logo
            if (event.brand) {
                setBrandIcon(event.brand);
            }

            setOutcome(event);
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            var options = {
                address_zip: document.getElementById('postal-code').value,
            };
            stripe.createToken(cardNumberElement, options).then(setOutcome);
        });

    </script>
</main>
<?php require "footer.php"; ?>
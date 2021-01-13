<?php 
    require "db.php";
    if(!isset($_SESSION['logged'])){
        header("location:index.php");
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
                <h3 class="new_client">Profili im</h3> 
                <!-- <small class="float-right pt-2" style="color:black;"><b style='font-size:15px; color:red;'>* </b> -> Fushat që duhet mbushur detyrimisht</small>
                 -->
                 <div class="divider"><span style="background-color:#f8f8f8">Të dhënat e mija.</span></div>
                <div class="form_container">
                    <form action="" method="post">
                        <div class="private box">
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
									<input type="text" class="form-control" value="Username" id='disabled'>
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="password" class="form-control" value="Password*" id='disabled'>
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" value="City*" id='disabled'>
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" value="Postal Code*" id='disabled'>
									</div>
                                </div>
                                
							</div>
							<!-- /row -->
							
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<div class="custom-select-form">
											<select class="wide add_bottom_10" name="country" id="country">
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
										<input type="text" class="form-control" placeholder="Telephone *" >
									</div>
                                </div>
                                <div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" value="Full Address*">
									</div>
								</div>
							</div>
							<!-- /row -->
							
						</div>
                        <hr>
                        <div class="text-center"><input type="submit" name="signup" value="Regjistrohu" class="btn_1 full-width"></div>
                        <!-- /form_container -->
                    </form>
                </div>
				<!-- /box_account -->
            </div>
        </div>
    </div>
    <script> 
        document.getElementById("disabled").disabled = true;
    </script>
</main>
<?php require "footer.php"; ?>
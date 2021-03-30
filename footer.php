<?php 
   require_once 'db.php';
?>
<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_1">Linqe</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                    <?php 
                        $sel_foot_links = prep_stmt("SELECT * FROM footer WHERE footer_layout = ? order by footer_id desc limit 5","links","s");
                        if(mysqli_num_rows($sel_foot_links) > 0){
                            while($row_foot_links = mysqli_fetch_array($sel_foot_links)){
                    ?>
                            <li><a href="<?php echo $row_foot_links['footer_link'] ?>"><?php echo $row_foot_links['footer_title'] ?></a></li>
                    <?php } }?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_2">Kategorite</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                    <?php 
                        $sel_cat_footer = prep_stmt("SELECT * FROM categories WHERE parent_id != ? order by cat_id limit 5", 0, "i");
                        while($row_cat_footer = mysqli_fetch_array($sel_cat_footer)){
                    ?>
                        <li><a href="<?php echo $row_cat_footer['cat_link']?>?sub_cat=<?php echo $row_cat_footer['cat_id']?>"><?php echo $row_cat_footer['cat_title']; ?></a></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3">Kontaktet</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                    <?php 
                        $sel_foot_contacts = prep_stmt("SELECT * FROM footer WHERE footer_layout = ? order by footer_id desc limit 5","contacts","s");
                        if(mysqli_num_rows($sel_foot_contacts) > 0){
                            while($row_foot_contacts = mysqli_fetch_array($sel_foot_contacts)){
                    ?>
                        <li><?php echo $row_foot_contacts['footer_link'] ?><?php echo $row_foot_contacts['footer_title'] ?></li>
                    <?php } }?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_4">Na ndiqni</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <!-- <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div> -->
                    <div class="follow_us">
                        <ul>
                        <?php 
                            $sel_foot_icons = prep_stmt("SELECT * FROM footer WHERE footer_layout = ? order by footer_id desc limit 5","icons","s");
                            if(mysqli_num_rows($sel_foot_icons) > 0){
                                while($row_foot_icons = mysqli_fetch_array($sel_foot_icons)){
                        ?>
                            <li>
                                <a href="<?php echo $row_foot_icons['footer_link'] ?>" target="_blank" style="font-size:1.5rem"><?php echo $row_foot_icons['footer_title'] ?></a>
                            </li>
                        <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="terms_and_conditions.php">Termet dhe Kushtet e përdorimit</a></li>
                    <li><a href="privacy.php">Politikat e Privatësisë</a></li>
                    <li><span>© 2020 DealAim</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div>
<!-- Back to top button -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Kyçu</h3>
		</div>
			<div class="sign-in-wrapper">
                <form action="signin.php" method="post">
                    <div class="form-group">
                        <label> Përdoruesi ose Email * </label>
                        <input type="text" class="form-control" name="username" placeholder="përdoruesi ose emaili..." <?php if(isset($_SESSION['user_exist_false'])){ echo "style='border-color:red;'";} ?>>
                    </div>
                    <div class="form-group">
                    <label> Fjalëkalimi * </label>
                        <input type="password" class="form-control" name="password" placeholder="********" <?php if(isset($_SESSION['user_exist_false'])){ echo "style='border-color:red;'";} ?>>
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-left">
                        </div>
                        <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Keni harruar fjalëkalimin?</a></div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Kyçu" name="signin" class="btn_1 full-width">
                        Nuk keni llogari? <a href="signin.php">Regjistrohuni</a>
                    </div>
                    <div id="forgot_pw">
                        <div class="form-group">
                            <label>Ju lutemi konfirmojeni emailin tuaj!</label>
                            <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                            <i class="ti-email"></i>
                        </div>
                        <p>Ju do e pranoni një email që përmban një link ku i'u mundësohet ndryshimi i fjalkalimit në një të ri të dëshiruar.</p>
                        <div class="text-center"><input type="submit" name="change_pass" value="Ndrysho fjalëkalimin" class="btn_1"></div>
                    </div>
                </form>
            </div>
		<!--form -->
	</div>
<!-- COMMON SCRIPTS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/common_scripts.min.js"></script>
<script src="js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/carousel-home.min.js"></script> <!-- INDEX -->
<script src="js/carousel_with_thumbs.js"></script> <!-- DETAJET -->
<script src="js/sticky_sidebar.min.js"></script>
<script src="js/specific_listing.js"></script> <!-- PRODUKTET ||| e dyta per --->
    <script>
    	// Client type Panel
		$('input[name="client_type"]').on("click", function() {
		    var inputValue = $(this).attr("value");
		    var targetBox = $("." + inputValue);
		    $(".box").not(targetBox).hide();
		    $(targetBox).show();
		});

		$('#image').click(function(){
            $('#myfile').click();
        });

        

        function showFormBuyer() {
            var e = document.getElementById("showForm");
    	   	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
        }

        
    </script>

</body>

</html>

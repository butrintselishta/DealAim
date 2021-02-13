<?php 
   require_once 'db.php';

   $_SESSION['isVisited'] = false;
   $i = 0;
   if(isset($_SESSION['isVisited'])){
       $_SESSION['isVisited'] = true;
       $i++;
       $user_ip = $_SERVER['REMOTE_ADDR'];
       $st = prep_stmt("INSERT INTO user_visits(visit_nr, user_ip) VALUES (?,?)", array($i, $user_ip), "is");
   }
?>
<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_1">Linqe</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="about.html">Ballina</a></li>
                        <li><a href="help.html">Të shitura</a></li>
                        <li><a href="help.html">Rreth Nesh</a></li>
                        <li><a href="account.html">Si funksionon?</a></li>
                        <li><a href="blog.html">Kontakti</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_2">Kategorite</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="listing-grid-1-full.html">Vetura</a></li>
                        <li><a href="listing-grid-2-full.html">Motoçikleta (mbi 50cc)</a></li>
                        <li><a href="listing-grid-1-full.html">Moped (nën 50cc)</a></li>
                        <li><a href="listing-grid-3.html">Kompjuterë</a></li>
                        <li><a href="listing-grid-1-full.html">Telefonë</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3">Kontaktet</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="ti-headphone-alt"></i>+94 423-23-221</li>
                        <li><i class="ti-email"></i><a href="#0">info@dealaim.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_4">ssssssss</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div>
                    <div class="follow_us">
                        <h5>Na ndiqni</h5>
                        <ul>
                            <li>
                                <a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.png" alt="" class="lazy"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.png" alt="" class="lazy"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.png" alt="" class="lazy"style="width:40px;"></a>
                            </li>
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
                    <li><a href="#0">Kushtet e përdorimit</a></li>
                    <li><a href="#0">Privatësia</a></li>
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

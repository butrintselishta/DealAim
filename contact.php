<?php   
    require_once "db.php";

    $usr_fname = ""; $usr_lname = ""; $usr_email = ""; $usr_phone = "";
    if(isset($_SESSION['logged']) && $_SESSION['logged'] === true){
        $sel_user_data = prep_stmt("SELECT * FROM users WHERE user_id=?", user_id(), "i");
        if(mysqli_num_rows($sel_user_data) > 0){
            while($row = mysqli_fetch_array($sel_user_data)){
                $usr_fname= $row['first_name'];
                $usr_lname = $row['last_name'];
                $usr_email = $row['email'];
                $usr_phone = $row['tel_nr'];
            }
        }
    }
    // die(var_dump(!empty(user_id())));
    
    if(isset($_POST['send'])){
        $fname = $_POST['fname'];
        $lname= $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $fnameErr = false; $lnameErr = false; $emailErr = false; $messageErr = false;
        if(empty($fname)){
            $fnameErr = true;
            $_SESSION['fnameError'] = "<small style='color:red'> Kjo fushë duhet të mbushet! </small>";
        }elseif(!ctype_alpha($fname)){
            $fnameErr = true;
            $_SESSION['fnameError'] = "<small style='color:red'> Kjo fushë pranon vetëm shkronja! </small>";
        }elseif(strlen($fname) > 20 ){
            $fnameErr = true;
            $_SESSION['fnameError'] = "<small style='color:red'> Kjo fushë pranon max. 20 shkronja! </small>";
        }elseif(strlen($fname) < 2 ){
            $fnameErr = true;
            $_SESSION['fnameError'] = "<small style='color:red'> Kjo fushë pranon min. 2 shkronja! </small>";
        }
        if(empty($lname)){
            $lnameErr = true;
            $_SESSION['lnameError'] = "<small style='color:red'> Kjo fushë duhet të mbushet! </small>";
        }elseif(!ctype_alpha($lname)){
            $lnameErr = true;
            $_SESSION['lnameError'] = "<small style='color:red'> Kjo fushë pranon vetëm shkronja! </small>";
        }elseif(strlen($lname) > 20 ){
            $lnameErr = true;
            $_SESSION['lnameError'] =  "<small style='color:red'> Kjo fushë pranon max. 20 shkronja! </small>";
        }elseif(strlen($lname) < 2 ){
            $lnameErr = true;
            $_SESSION['lnameError'] = "<small style='color:red'> Kjo fushë pranon min. 2 shkronja! </small>";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = true;
            $_SESSION['emailError'] = "<small style='color:red'> Email nuk është shkruar në formatin e duhur! </small>";
        }
        if(empty($message)){
            $messageErr = true;
            $_SESSION['messageError'] = "<small style='color:red'> Kjo fushë duhet të mbushet! </small>";
        }elseif(strlen($message) < 50){
            $messageErr= true;
            $_SESSION['messageError'] = "<small style='color:red'> Kjo fushë duhet ti ketë të paktën 50 karaktere! </small>";
        }elseif(strlen($message) > 5000){
            $messageErr = true;
            $_SESSION['messageError'] = "<small style='color:red'> Kjo fushë pranon max. 5000 karaktere! </small>";
        }
        if($fnameErr || $lnameErr || $emailErr || $messageErr){
            header("location:contact.php");die();
        }
        else{
            $fullname = $fname . " " . $lname;
            if(!empty(user_id())){
                if(!prep_stmt("INSERT INTO messages(full_name,email,phone,message,user_id) VALUES (?,?,?,?,?)", array($fullname, $email, $phone, $message, user_id()), "ssssi")){
                    $_SESSION['error_message'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ndodhi një gabim, ju lutem kthehuni më vonë.</p>";
                    header("location:contact.php");die();
                }else{
                    $_SESSION['success_message'] = "<h4 style='color:#265725; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#265725;'> Mesazhi juaj është dërguar me sukses. Shumë shpejt do të ju kontaktojmë!</p>";
                    header("location:contact.php");die();
                }
            }else{
                if(!prep_stmt("INSERT INTO messages(full_name,email,phone,message) VALUES (?,?,?,?)", array($fullname, $email, $phone, $message), "ssss")){
                    $_SESSION['error_message'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ndodhi një gabim, ju lutem kthehuni më vonë.</p>";
                    header("location:contact.php");die();
                }else{
                    $_SESSION['success_message'] = "<h4 style='color:#265725; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#265725;'> Mesazhi juaj është dërguar me sukses. Shumë shpejt do të ju kontaktojmë!</p>";
                    header("location:contact.php");die();;
                }
            }
        }
    }

?>
<?php require "header.php"; ?>
<main class="bg_gray">
    <div class="container margin_60">
        <div class="main_title">
            <h2>Kontakto me DealAim</h2>
            <p>Për çdo pyetje në lidhje me faqen tonë mund të na kontaktoni duke mbushur formën në vazhdim ose përmes metodave tjera të cekura më poshtë.</p>
        </div>
    </div>  
    <div class="bg_white">
        <div class="container margin_60_35">
            <h4 class="pb-3" style="width:65%">Mos hezitoni të na shkruani! <small class="float-right pt-2" style="font-size:12px;color:#252525">* - Fushat e domosdoshme</small></h4>
            <div class="row justify-content-center">    
                <div class="col-lg-8 col-sm-12 add_bottom_25">
                    <?php 
                        if(isset($_SESSION['success_message'])){
                            echo "<div class='sukses'>";
                            echo $_SESSION['success_message'];
                            echo "</div>";
                        }
                        elseif(isset($_SESSION['error_message'])){
                            echo "<div class='gabim'>";
                            echo $_SESSION['error_message'];
                            echo "</div>";
                        }
                    ?>
                    <?php unset($_SESSION['success_message']); unset($_SESSION['error_message']);?>
                    <div class="private box" id="boxForm">
                        <form method="post" action="" id="sendForm" style="margin:2px 2px 2px 2px;">
                            <div class="row no-gutters">
                                <div class="col-md-6 col-sm-6 pr-1">
                                    <div class="form-group">
                                        <input type="text" name="fname" id="firstname" class="form-control" placeholder="Emri*" <?php if(!empty($usr_fname)){echo "value='$usr_fname' readonly";}?> <?php if(isset($_SESSION['fnameError'])){ echo "style='border-color:red;'";} ?>>
                                        <?php if(isset($_SESSION['fnameError'])){ echo $_SESSION['fnameError'];} ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 pr-1">
                                    <div class="form-group">
                                        <input type="text" name="lname" id="lastname" class="form-control" placeholder="Mbiemri*" <?php if(!empty($usr_lname)){echo "value='$usr_lname' readonly";} ?> <?php if(isset($_SESSION['lnameError'])){ echo "style='border-color:red;'";} ?>>
                                        <?php if(isset($_SESSION['lnameError'])){ echo $_SESSION['lnameError'];} ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 pr-1">
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email*" <?php if(!empty($usr_email)){echo "value='$usr_email' readonly";} ?> <?php if(isset($_SESSION['emailError'])){ echo "style='border-color:red;'";} ?>>
                                        <?php if(isset($_SESSION['emailError'])){ echo $_SESSION['emailError'];} ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 pr-1">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control" placeholder="Numri telefonit" <?php if(!empty($usr_phone)){echo "value='$usr_phone' readonly";} ?>>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 pr-1">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" style="height: 150px; <?php if(isset($_SESSION['messageError'])){ echo "border-color:red;";} ?>" placeholder="Message *" ></textarea>
                                        <?php if(isset($_SESSION['messageError'])){ echo $_SESSION['messageError'];} ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 pr-1">
                                    <div class="form-group">
                                        <input class="btn_1 full-width" id="send" name="send" type="submit" value="Dërgo">
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['fnameError']);unset($_SESSION['lnameError']); unset($_SESSION['emailError']); unset($_SESSION['messageError']);?>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 add_bottom_25">
                    <div style="margin-bottom:20px;">
                        <p>Mund të na kontaktoni edhe duke na shkruar në emailin <a style="text-decoration: underline;" href="mailto:info@dealaim.com">info@dealaim.com</a>, do të ju përgjigjemi sa më parë që është e mundur!</p>
                    </div>
                    <hr>
                    <div style="margin-bottom:20px;">
                        <p>Ose mund të na kontaktoni edhe përmes numrit të telefonit: <a href="tel:0038344991411" style="font-size: 12pt; color: blue;">00 383
                         44 991 411</a></p>
                    </div>
                    <hr>
                    <div style="margin-bottom:20px;">
                        <p style="margin:0;">Pos tjerash mund të na vizitoni edhe në zyrat tona në: <address style="color:blue;">Madeleine Albright, AFËRDITA, 76 - <b>GJILAN</b></address></p>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <script>
        var fnameE = true; var lnameE = true; var emailE = true; var messageE = true;
        document.getElementById("firstname").onkeyup = function () {
            var fname = document.getElementById("firstname");
            var letters = /^[a-zA-Z\s]*$/;

            if(fname.value.length < 2){
                fname.style.borderColor  = "red";
                fnameE = true
            }else if(fname.value.length > 50){
                fname.style.borderColor  = "red";
                fnameE = true;
            }else{
                if(fname.value.match(letters)){
                    fname.style.borderColor = "green";
                    fnameE = false;
                }else{
                    fnameE = true;
                    fname.style.borderColor  = "red";
                }
            }
        }
        document.getElementById("lastname").onkeyup = function () {
            var lname = document.getElementById("lastname");
            var letters = /^[a-zA-Z\s]*$/;
            
            if(lname.value.length < 2){
                lname.style.borderColor  = "red";
                lnameE = true;
            }else if(lname.value.length > 50){
                lname.style.borderColor  = "red";
                lnameE = true;
            }else{
                if(lname.value.match(letters)){
                    lname.style.borderColor = "green";
                    lnameE = false;
                }else{
                    lnameE = true;
                    lname.style.borderColor  = "red";
                }
            }
        }
        document.getElementById("email").onkeyup = function () {
            var email = document.getElementById("email");
            var filter = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            
            if(email.value.match(filter)){
                email.style.borderColor  = "green";
                emailE = false;
            }else{
                emailE = true;
                email.style.borderColor  = "red";
            }
        }
        document.getElementById("message").onkeyup = function () {
            var message = document.getElementById("message");

            if(message.value.length < 50 || message.value.length > 5000){
                message.style.borderColor = "red";
                messageE = true;
                
            }else{
                messageE = false;
                message.style.borderColor  = "green";
            }
        }
        document.querySelector("#send").addEventListener("click", function (event) {
            console.log(emailE);console.log(lnameE);console.log(fnameE);console.log(messageE)
            if (fnameE == true && lnameE == true && emailE == true && messageE == true) {
                event.preventDefault();
            } else{
                document.getElementById("sendForm").submit();
            }
        });
    </script>
    <!-- /bg-white -->
</main>

<?php require "footer.php"; ?>
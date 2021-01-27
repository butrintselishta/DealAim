<?php 
	require "db.php";
    if($_SESSION['logged'] == false){
        header("location:signin.php");
    }
    //GET the USER ID of the LOGGED USER
    $user = prep_stmt("SELECT user_id FROM users WHERE username=?", $_SESSION['user']['username'],"s");
    if(mysqli_num_rows($user) > 0){
        $user_id = mysqli_fetch_array($user);
    }
    else{
        $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
    }

    
    //TERHIQ
    if(isset($_POST['terheq_btn'])){
        $ter = $_POST['ter_shuma']; 
        $ter_shuma = number_format($ter, 2,'.', '');//die(var_dump($ter_shuma));

        $balance = prep_stmt("SELECT acc_balance FROM bank_acc WHERE user_id=?", $user_id['user_id'],'i');
        if(mysqli_num_rows($balance) > 0){
            $user_balance = mysqli_fetch_array($balance);
        }else{
            $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
        }
        
        if($ter_shuma > $user_balance['acc_balance']){
            $_SESSION['user_balance_low'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ju lutem kontrolloni llogarinë tuaj bankare, nuk keni bilanc të mjaftueshëm! </p>"; header("location:balance.php"); die();
        }
        else{
            $sel_curr_balance = prep_stmt("SELECT user_balance FROM users WHERE user_id=?", $user_id['user_id'],"i");
            if(mysqli_num_rows($user) > 0){
                $curr_balance = mysqli_fetch_array($sel_curr_balance); //die(var_dump($curr_balance['user_balance']));
            }else{
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
            }

            $deal_user_balance = 0;
            $bank_user_balance = 0; //die(var_dump($bank_user_balance));

            $bank_user_balance = $user_balance['acc_balance'] - $ter_shuma;
            $deal_user_balance = $curr_balance['user_balance'] + $ter_shuma;// die(var_dump($deal_user_balance));
            if(!prep_stmt("UPDATE users SET user_balance=? WHERE user_id=?", array($deal_user_balance, $user_id['user_id']), "di")){
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
            }else{
              if(!prep_stmt("UPDATE bank_acc SET acc_balance = ? WHERE user_id=?", array($bank_user_balance, $user_id['user_id']), "di")){ 
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
               }
               else{
                $_SESSION['user_balance_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> <b style='color:#F0AC1A;font-size:17px;'>". $ter_shuma ."€ </b> janë transferuar në llogarinë tuaj. Bilanci juaj aktual është: <b style='color:#F0AC1A;font-size:17px;'>". number_format($deal_user_balance,2,'.','') ."€ </b></p>"; header("location:balance.php"); die();
               }
            }
        }
    }

    //DEPOZITO
    if(isset($_POST['depozite_btn'])){
        $dep = $_POST['dep_shuma'];
        $dep_shuma = number_format($dep, 2,'.', '');//die(var_dump($dep_shuma));
        $sel_current_balance = prep_stmt("SELECT user_balance FROM users WHERE user_id=?", $user_id['user_id'],"i");
        if(mysqli_num_rows($sel_current_balance) > 0){
            $current_balance = mysqli_fetch_array($sel_current_balance); //die(var_dump($current_balance['user_balance']));
        }else{
            $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
        }
        if($dep_shuma > $current_balance['user_balance']){
            $_SESSION['user_balance_low'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Ju lutem kontrolloni bilancin në llogarinë tuaj, nuk keni bilanc të mjaftueshëm! </p>"; header("location:balance.php"); die();
        }else{
            $balance_us = prep_stmt("SELECT acc_balance FROM bank_acc WHERE user_id=?", $user_id['user_id'],'i');
            if(mysqli_num_rows($balance_us) > 0){
                $balance_us_fetch = mysqli_fetch_array($balance_us); //die(var_dump($balance_us_fetch['acc_balance']));
            }else{
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
            }
            $tot_balance_bank = 0;
            $tot_balance_user = 0;

            $tot_balance_bank = $balance_us_fetch['acc_balance'] + $dep_shuma;//die(var_dump($tot_balance));
            $tot_balance_user =  $current_balance['user_balance'] - $dep_shuma;//die(var_dump($tot_balance_user));

            if(!prep_stmt("UPDATE users SET user_balance=? WHERE user_id=?", array($tot_balance_user, $user_id['user_id']), "di")){
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
            }else{
              if(!prep_stmt("UPDATE bank_acc SET acc_balance = ? WHERE user_id=?", array($tot_balance_bank, $user_id['user_id']), "di")){ 
                $_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:balance.php"); die();
               }
               else{
                $_SESSION['user_balance_correct'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> <b style='color:#F0AC1A;font-size:17px;'>". $dep_shuma ."€ </b> janë depozituar në llogarinë tuaj bankare. Bilanci juaj aktual është: <b style='color:#F0AC1A;font-size:17px;'>". $tot_balance_user ."€ </b></p>"; header("location:balance.php"); die();
               }
            }
        }
    }
?>

<?php require 'header.php'; ?>
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
        <div class="col-xl-7 col-lg-6 col-md-8">
			<div class="box_account" style="background-color:#fff;">
                <ul style="list-style: '\00BB'; padding-right:10px; padding-top:10px;">
                    <li style="font-weight: 500; padding: 10px 0px 5px 0px;">
                        <i style="padding-left:8px; font-size:13px;">Këtu mund ta ndryshoni gjendjen e bilancit tuaj duke nxjerrë para nga llogaria juaj në këtë web aplikacion ose duke i tërhequr paratë prapa në llogarinë tuaj bankare.</i>
                    </li>
                    <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                        <i style="padding-left:8px; font-size:13px;">Së pari zgjedheni shërbimin që dëshironi ta kryeni në inputin e më poshtëm, pastaj ju hapet forma varësisht prej opsionit të zgjedhur</i>
                    </li>
                </ul>
                <div class="form_container" style="box-shadow:none;">
                    <div class="private box" >
                        <center>
                            <div class="row no-gutters">
                                <?php
                                     if(isset($_SESSION['prep_stmt_error'])){
                                        echo "<div class='gabim'>";
                                        echo $_SESSION['prep_stmt_error'];
                                        echo "</div>";
                                    }
                                    elseif(isset($_SESSION['user_balance_low'])){
                                        echo "<div class='gabim'>";
                                        echo $_SESSION['user_balance_low'];
                                        echo "</div>";
                                    }elseif(isset($_SESSION['user_balance_correct'])){
                                        echo "<div class='sukses'>";
                                        echo $_SESSION['user_balance_correct'];
                                        echo "</div>";
                                    } unset($_SESSION['user_balance_low']);unset($_SESSION['prep_stmt_error']);unset($_SESSION['user_balance_correct']);
                                ?>
                                <form style="width:100%; float:right;" >
                                    <div class="custom-select-form" style="width:50%">
                                         <label> Zgjedhni shërbmin </label>
                                        <select class="wide add_bottom_10" name="country" id="sherbimi"  onchange="showSherbimin()" >
                                            <option value="0" selected="">Zgjedhni...</option>
                                            <option value="1">Tërheqje</option>
                                            <option value="2">Depozitë</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
                <!-- TERHEQ div -->
                <div class="form_container" id="terheqje_div" style="box-shadow:none; display:none;" >
                <div class="divider" style="margin-bottom:2em;"><span style="background-color:#fff">Shërbimi zgjedhur: <b style="color:#5ABC35;font-size:17px; font-weight:900; "> TËRHEQJE </b></span></div>
                    <div class="private box" style="background:#F8F8F8;">
                        <center>
                            <div class="row no-gutters">
                                <form style="width:100%; float:right;" method="POST" action="" id="ter_form">
                                    <div style="width:100%">
                                        <ul style="list-style: '\00BB'; color:#5ABC35; text-align:left; ">
                                            <li style="font-weight: 500; padding: 10px 0px 5px 0px; ">
                                                <i style="font-size:14px;"><b>TËRHEQJE PARASH</b> => Paratë që dëshironi t'i fusni në llogarinë tuaj këtu (në DEAL AIM) <b>nga llogaria juaj bankare</b></i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:14px;">Shuma minimale për tërheqje është <b style="color: #CF2928; font-size:16px;">5 euro</b>, ndërsa ajo maksimale është <b style="color: #CF2928; font-size:16px;"> 2000 euro </b> </i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:14px;">Shuma duhet të jetë fikse (p.sh: <b style="color: #2C4EDA; font-size:16px;">5 euro, 7 euro, 10 euro, 100 euro 1000 euro... </b>) </i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group form-group1" style="width:30%;">
                                        <label> Shëno shumën </label>
                                        <input type="text" name="ter_shuma" id="ter_shuma" class="form-control" style="text-align:center;">
                                    </div>
                                    <div class="text-center btn_center" style="margin-bottom:20px;"><button type="submit" id="balance_btn_ter" name="terheq_btn" value="Vazhdo" class="btn_1 ">TËRHIQ</button></div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
                
                <!-- DEPOZITE div -->
                <div class="form_container" id="depozite_div" style="box-shadow:none; display:none;" >
                <div class="divider" style="margin-bottom:2em;"><span style="background-color:#fff">Shërbimi zgjedhur: <b style="color:#2C4EDA;font-size:17px; font-weight:900;"> DEPOZITË </b></span></div>
                    <div class="private box" style="background:#F8F8F8;">
                        <center>
                            <div class="row no-gutters">
                                <form style="width:100%; float:right;" method="POST" action="" id="dep_form">
                                    <div style="width:100%">
                                        <ul style="list-style: '\00BB'; color:#2C4EDA; text-align:left; ">
                                            <li style="font-weight: 500; padding: 10px 0px 5px 0px; ">
                                                <i style="font-size:14px;"><b>DEPOZITË PARASH</b> => Paratë që dëshironi t'i ktheni(depozitoni) në llogarinë tuaj bankare <b>nga llogaria juaj këtu (në DEAL AIM)</b></i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:14px;">Shuma minimale për depozitë është <b style="color: #CF2928; font-size:16px;">5 euro</b>, ndërsa ajo maksimale është <b style="color: #CF2928; font-size:16px;"> 2000 euro </b> </i>
                                            </li>
                                            <li style="font-weight: 500; padding: 5px 0px 10px 0px;">
                                                <i style="font-size:14px;">Shuma duhet të jetë fikse (p.sh: <b style="color: #5ABC35; font-size:16px;">5 euro, 7 euro, 10 euro, 100 euro, 1000 euro... </b>) </i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group form-group1" style="width:30%;">
                                        <label> Shëno shumën </label>
                                        <input type="text" name="dep_shuma" id="dep_shuma" class="form-control" style="text-align:center;">
                                    </div>
                                    <div class="text-center btn_center" style="margin-bottom:20px;"><button type="submit" id="balance_btn_dep" name="depozite_btn" value="Vazhdo" class="btn_1 ">DEPOZITO</button></div>
                                </form>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      function showSherbimin(){
            //nese zgjidhet terhejqe, SHOW DIV per terheqje
            var sherbimi = document.getElementById("sherbimi");
            console.log(sherbimi.value);
            if(sherbimi.value == 1){
                document.getElementById("terheqje_div").style.display = "block";
                document.getElementById("depozite_div").style.display = "none";
            }else if(sherbimi.value == 2){
                document.getElementById("terheqje_div").style.display = "none";
                document.getElementById("depozite_div").style.display = "block";
            }else{
                document.getElementById("terheqje_div").style.display = "none";
                document.getElementById("depozite_div").style.display = "none";
            }
        } 
    </script>
    <script type="text/javascript">
        var sh_terheq = false; 
        var sh_depozite = false;
        document.getElementById("ter_shuma").onkeyup = function() 
		{ 
            var terheq_shuma = document.getElementById("ter_shuma");
            if(terheq_shuma.value.match(/^\d+$/))
            {
                if(terheq_shuma.value < 5 || terheq_shuma.value > 2000){
                    sh_terheq = false;
                    terheq_shuma.style.border = "2px solid red";
                }else{
                    terheq_shuma.style.border = "2px solid green";
                    sh_terheq = true; 
                }
            }else{
                terheq_shuma.style.border = "2px solid red";
                sh_terheq = false;
            }
        }

        document.getElementById("dep_shuma").onkeyup = function() 
		{ 
            var depozite_shuma = document.getElementById("dep_shuma");
            if(depozite_shuma.value.match(/^\d+$/))
            {
                if(depozite_shuma.value < 5 || depozite_shuma.value > 2000){
                    sh_depozite = false;
                    depozite_shuma.style.border = "2px solid red";
                }else{
                    depozite_shuma.style.border = "2px solid green";
                    sh_depozite = true;
                }
            }else{
                depozite_shuma.style.border = "2px solid red";
                sh_depozite = false;
            }
        }

        //TERHEQ
        document.querySelector("#balance_btn_ter").addEventListener("click", function(event) {
            if(sh_terheq == true){
                console.log("123");
                document.getElementById("ter_form").submit();
            }else{
                event.preventDefault();
                document.getElementById("ter_shuma").style.border = "2px solid red";
            }
        });

        //DEPOZITO 
        document.querySelector("#balance_btn_dep").addEventListener("click", function(event) {
            if(sh_depozite == true){
                document.getElementById("dep_form").submit();
            }else{ 
                event.preventDefault();
                document.getElementById("dep_shuma").style.border = "2px solid red";
            }
        });
    </script>
</main>



<?php require 'footer.php'; ?>
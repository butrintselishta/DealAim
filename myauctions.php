<?php 
    require_once("db.php");
    if($_SESSION['logged']==false){
        header("location:signin.php");
    }
    if($_SESSION['user']['status'] != SELLER){
        header("index.php");
    }
    
    $sel_user_id = prep_stmt("SELECT user_id FROM users WHERE username = ?", $_SESSION['user']['username'], "s");
    $sel_user = mysqli_fetch_array($sel_user_id);
    $user_id = $sel_user['user_id'];

    if(isset($_POST['btn_add_prod'])){
        $auc_category = $_POST['auc_category'];//die(var_dump($category));
        $auc_title = $_POST['auc_title'];
        $auc_price = str_replace(" ", "",$_POST['auc_price']);//die(var_dump($auc_price));
        $auc_start = $_POST['auc_start'];
        $auc_end = $_POST['auc_end']; 
        $auc_desc = $_POST['auc_description'];
        $auc_photo1 = $_POST['auc_photo1']; $auc_photo2 = $_POST['auc_photo2']; $auc_photo3 = $_POST['auc_photo3']; $auc_photo4 = $_POST['auc_photo4']; $auc_photo5 = $_POST['auc_photo5'];
       
        //getting todays,tomorrows,one week later day from tomorrow date like epoch for comparing
        $start_at = strtotime($auc_start);
        $day_after_today = strtotime(date("d-m-Y", strtotime("+1 days")));//tomorrow date
        $day_after_sevendays = strtotime(date("d-m-Y", strtotime("+1 week")));//7 days from today

        //GENERATING AN UNIQUE ID for every Product
        $unique_id = uniqid($_SESSION['user']['username']."_");
        $select_cat_id = prep_stmt("SELECT cat_id FROM categories WHERE cat_title = ?", $auc_category, "s");
        $selected_cat_id = mysqli_fetch_array($select_cat_id);
        $selected_cat_id = $selected_cat_id['cat_id'];

        $titleError = false; $priceError = false; $startError = false; $endError = false; $descError = false;$photo1Error = false;$photo2Error = false;$photo3Error = false; 
        //laptop ERRORS
        $lapManError = false; $lapModError = false; $lapConError = false; $lapDisError = false; $lapColError = false; $lapProcError = false; $lapRamError = false; $lapIntMemError = false; $lapIntMemSpaceError = false; $lapGrapError = false;
        //phone Errors
        $telManError = false;
        $_SESSION['add_prod_errors'] = array();

        if(strlen($auc_title) < 6){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $titleError = true;
            $_SESSION['add_prod_errors'] += ['titleError' => "asdasf"];
        }
        if(empty($auc_price)){
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $priceError = true;
            $_SESSION['add_prod_errors'] += ['priceError' => "asdasf"];
        }
        else if(!is_numeric($auc_price) && !(strpos($auc_price, ".") || strpos($auc_price, ","))){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $priceError = true;
           $_SESSION['add_prod_errors'] += ['priceError'];
        }else if(!filter_var($auc_price, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $priceError = true;
            $_SESSION['add_prod_errors'] += ['priceError' => "asdasf"];
        }
        if(empty($start_at)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $startError = true;
            $_SESSION['add_prod_errors'] += ['startError' => "asdasf"];
        }
        elseif($start_at < $day_after_today || $start_at > $day_after_sevendays){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $startError = true;
            $_SESSION['add_prod_errors'] += ['startError' => "asdasf"];
        }
        if(empty($auc_end)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_desc'] = $auc_desc;
            $endError = true;
            $_SESSION['add_prod_errors'] += ['endError' => "asdasf"];
        }else if($auc_end > 7){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_desc'] = $auc_desc;
            $endError = true;
            $_SESSION['add_prod_errors'] += ['endError' => "asdasf"];
        }
        if(empty($auc_desc)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $descError = true;
            $_SESSION['add_prod_errors'] += ['descError' => "asdasf"];
        }else if(strlen($auc_desc) < 50){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $descError = true;
            $_SESSION['add_prod_errors'] += ['descError' => "asdasf"];
        }
        if(empty($auc_photo1)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photo1Error = true;
            $_SESSION['add_prod_errors'] += ['photo1Error' => "asdasf"];
        }if(empty($auc_photo2)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photo2Error = true;
            $_SESSION['add_prod_errors'] += ['photo2Error' => "asdasf"];
        }if(empty($auc_photo3)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photo3Error = true;
            $_SESSION['add_prod_errors'] += ['photo3Error' => "asdasf"];
        }
        if(is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
            $pic = $_FILES['auc_photo1'];
            $picname = "photo1_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename_1   = $picname . "." . $imageFileType; 
            $target_dir = "img/products/{$basename_1}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $photo1Error = true;
                $_SESSION['add_prod_errors'] += ['photo1Error' => "asdasf"];
            }
            if ($pic['size'] > 3000000) {
                $photo1Error = true;
                $_SESSION['add_prod_errors'] += ['photo1Error' => "asdasf"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $photo1Error = true;
                $_SESSION['add_prod_errors'] += ['photo1Error' => "asdasf"];
            }
            $source = $pic["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
            $pic = $_FILES['auc_photo2'];
            $picname = "photo2_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename_2   = $picname . "." . $imageFileType . " | "; 
            $target_dir = "../img/products/{$basename_2}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $photo2Error = true;
                $_SESSION['add_prod_errors'] += ['photo2Error' => "asdasf"];
            }
            if ($pic['size'] > 3000000) {
                $photo2Error = true;
                $_SESSION['add_prod_errors'] += ['photo2Error' => "asdasf"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $photo2Error = true;
                $_SESSION['add_prod_errors'] += ['photo2Error' => "asdasf"];
            }
            $source = $pic["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
            $pic = $_FILES['auc_photo3'];
            $picname = "photo3_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename_3   = $picname . "." . $imageFileType . " | "; 
            $target_dir = "../img/products/{$basename_3}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $photo3Error = true;
                $_SESSION['add_prod_errors'] += ['photo3Error' => "asdasf"];
            }
            if ($pic['size'] > 3000000) {
                $photo3Error = true;
                $_SESSION['add_prod_errors'] += ['photo3Error' => "asdasf"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $photo3Error = true;
                $_SESSION['add_prod_errors'] += ['photo3Error' => "asdasf"];
            }
            $source = $pic["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
            $pic = $_FILES['auc_photo4'];
            $picname = "photo4_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename_4   = $picname . "." . $imageFileType . " | "; 
            $target_dir = "../img/products/{$basename_4}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $photo4Error = true;
                $_SESSION['add_prod_errors'] += ['photo4Error' => "asdasf"];
            }
            if ($pic['size'] > 3000000) {
                $photo4Error = true;
                $_SESSION['add_prod_errors'] += ['photo4Error' => "asdasf"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $photo4Error = true;
                $_SESSION['add_prod_errors'] += ['photo4Error' => "asdasf"];
            }
            $source = $pic["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
            $pic = $_FILES['auc_photo5'];
            $picname = "photo5_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $basename_5   = $picname . "." . $imageFileType . " | "; 
            $target_dir = "../img/products/{$basename_5}"; //lokacioni, folderi ku me i bo move fotot
            $check = getimagesize($pic["tmp_name"]);

            if ($check == false) {
                $photo5Error = true;
                $_SESSION['add_prod_errors'] += ['photo5Error' => "asdasf"];
            }
            if ($pic['size'] > 3000000) {
                $photo5Error = true;
                $_SESSION['add_prod_errors'] += ['photo5Error' => "asdasf"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $photo5Error = true;
                $_SESSION['add_prod_errors'] += ['photo5Error' => "asdasf"];
            }
            $source = $pic["tmp_name"];
        }

        $cat_exist = false;
        $sel_cat_tit = prep_stmt("SELECT cat_title FROM categories WHERE parent_id != ?", 0, 'i');
        while($sel_cat_title = mysqli_fetch_array($sel_cat_tit)){
            // die($sel_cat_title['cat_title']);
            if($sel_cat_title['cat_title'] == $auc_category){
                $cat_exist = true;
            }
        }
        if($cat_exist == true){
            if($_POST['auc_category'] == "Laptop"){
                $lap_man = $_POST['lap_manufacturer'];//die(var_dump($lap_man));
                $lap_mod = $_POST['lap_model'];
                $lap_condition = $_POST['lap_condition'];
                $lap_display = $_POST['lap_display'];
                $lap_col = $_POST['lap_color'];
                $lap_proc = $_POST['lap_procesor'];    
                $lap_ram = $_POST['lap_ram'];
                $lap_intmem = $_POST['lap_internal_memory'];
                $lap_intmem_space = $_POST['lap_internal_memory_space'];
                $lap_grap =$_POST['lap_graphic_card'];
                // die($lap_man.$lap_mod." ".$lap_condition." ".$lap_display." ".$lap_col." ".$lap_proc." ".$lap_ram." ".$lap_intmem." ".$lap_intmem_space." ".$lap_grap);
                $sel_lap_man = prep_stmt("SELECT prod_manufacturer FROM prod_manufacturers WHERE cat_id = ?", 2, 'i');
                $lap_manufacturers = array();
                while($row_sel_lap_man = mysqli_fetch_array($sel_lap_man)){
                    $lap_manufacturers[] = $row_sel_lap_man['prod_manufacturer'];
                }
                $sel_lap_man = prep_stmt("SELECT prod_manufacturer FROM prod_manufacturers WHERE cat_id = ?", 2, 'i');
                $lap_manufacturers = array();
                while($row_sel_lap_man = mysqli_fetch_array($sel_lap_man)){
                    $lap_manufacturers[] = $row_sel_lap_man['prod_manufacturer'];
                }

                if(empty($lap_man)){
                    $_SESSION['save_price'] = $auc_price; $_SESSION['save_title'] = $auc_title; $_SESSION['save_end'] = $auc_end; $_SESSION['save_desc'] = $auc_desc; $_SESSION['save_lapMod'] = $lap_mod; $_SESSION['save_lapCon'] = $lap_condition; $_SESSION['save_lapDis'] = $lap_display; $_SESSION['save_lapCol'] = $lap_col; $_SESSION['save_lapProc'] = $lap_proc; $_SESSION['save_lapRam'] = $lap_ram; $_SESSION['save_lapIntMem'] = $lap_intmem; $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space; $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapManError = true;
                    $_SESSION['add_prod_errors'] += ['lapManError' => "asdasf"];
                }
                else if(array_search($lap_man, $lap_manufacturers) === false){
                    $_SESSION['save_price'] = $auc_price; $_SESSION['save_title'] = $auc_title; $_SESSION['save_end'] = $auc_end; $_SESSION['save_desc'] = $auc_desc; $_SESSION['save_lapMod'] = $lap_mod; $_SESSION['save_lapCon'] = $lap_condition; $_SESSION['save_lapDis'] = $lap_display; $_SESSION['save_lapCol'] = $lap_col; $_SESSION['save_lapProc'] = $lap_proc; $_SESSION['save_lapRam'] = $lap_ram; $_SESSION['save_lapIntMem'] = $lap_intmem; $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space; $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapManError = true;
                    $_SESSION['add_prod_errors'] += ['lapManError' => "asdasf"];
                }
                if(empty($lap_mod)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapModError = true;
                    $_SESSION['add_prod_errors'] += ['lapModError' => "asdasf"];
                }
                if(empty($lap_condition)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMMod'] = $lap_mod;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapConError = true;
                    $_SESSION['add_prod_errors'] += ['lapConError' => "asdasf"];
                }
                if(empty($lap_display)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapDisError = true;
                    $_SESSION['add_prod_errors'] += ['lapDisError' => "asdasf"];
                }
                if(empty($lap_col)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapColError = true;
                    $_SESSION['add_prod_errors'] += ['lapColError' => "asdasf"];
                }else if(!ctype_alpha($lap_col) && !((strpos($lap_col, 'ë')) || (strpos($lap_col, 'Ë')) || (strpos($lap_col, 'ç')) || (strpos($lap_col, 'Ç')))){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapColError = true;
                    $_SESSION['add_prod_errors'] += ['lapColError' => "asdasf"];
                }
                if(empty($lap_proc)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapProcError = true;
                    $_SESSION['add_prod_errors'] += ['lapProcError' => "asdasf"];
                }
                if(empty($lap_ram)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    //
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapRamError = true;
                    $_SESSION['add_prod_errors'] += ['lapRamError' => "asdasf"];
                }else if(!is_numeric($lap_ram)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapRamError = true;
                    $_SESSION['add_prod_errors'] += ['lapRamError' => "asdasf"];
                }
                if(empty($lap_intmem)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapIntMemError = true;
                    $_SESSION['add_prod_errors'] += ['lapIntMemError' => "asdasf"];
                }
                if(empty($lap_intmem_space)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    //
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapIntMemSpaceError = true;
                    $_SESSION['add_prod_errors'] += ['lapIntMemSpaceError' => "asdasf"];
                }else if(!is_numeric($lap_intmem_space)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    //
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapIntMemSpaceError = true;
                    $_SESSION['add_prod_errors'] += ['lapIntMemSpaceError' => "asdasf"];
                }
                if(empty($lap_grap)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_lapMan'] = $lap_man;
                    $_SESSION['save_lapMod'] = $lap_mod;
                    $_SESSION['save_lapCon'] = $lap_condition;
                    $_SESSION['save_lapDis'] = $lap_display;
                    $_SESSION['save_lapCol'] = $lap_col;
                    //
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $lapGrapError = true;
                    $_SESSION['add_prod_errors'] += ['lapGrapError' => "asdasf"];
                }

                if($lapManError || $lapModError || $lapModError || $lapConError || $lapDisError || $lapColError || $lapProcError || $lapRamError || $lapIntMemError || $lapIntMemSpaceError || $lapGrapError || $telManError){
                    header("location:myauctions.php"); die();
                }
                else{
                    if (is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
                        move_uploaded_file($source, $target_dir); die(var_dump(move_uploaded_file($source, $target_dir)));//nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    }if (is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
                        move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    } if (is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
                        move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    } if (is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
                        move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    } if (is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
                        move_uploaded_file($source, $target_dir); //nese po ngarkon per her te par, veq bone move ne folderin e specifikum
                    }
                    $prod_img = $basename_1 . $basename_2 . $basename_3 . $basename_4 . $basename_5;
                    //die(var_dump($prod_img));
                    
                    //start from 12PM of the GIVEN AUCTION START DAY
                    $hourstoadd = 12;
                    $secondstoadd = $hourstoadd * (60*60);
                    $auc_start_time = $day_after_today + $secondstoadd;
                    $start_time = date("Y-m-d h:i", $auc_start_time);

                    $daystoadd = $auc_end . " days";
                    $auc_end_time = date('Y-m-d', $auc_start_time);
                    $end_time = date("Y-m-d h:i", strtotime($auc_end_time . $daystoadd));
                    
                    $isApproved = 0;
                    //INSERT PRODUKTIN pastaj SPECIFIKAT
                    $insert_lap_prod = prep_stmt("INSERT INTO products(prod_unique_id, prod_img, prod_title, prod_cmimi, prod_from, prod_to, prod_pershkrimi,cat_id,user_id,prod_isApproved) VALUES(?,?,?,?,?,?,?,?,?,?)", array($unique_id,$basename_1,$auc_title, $auc_price, $start_time, $end_time,$auc_desc,$selected_cat_id,$user_id,$isApproved), "sssssssiii");
                    if($insert_lap_prod){
                        die("good");
                    }else {die ("keq");}
                }

            }
            // else if($_POST['auc_category'] == "Telefon"){
            //     $tel_man = $_POST['phone_manufacturer'];
                
            //     if($tel_man != "Apple"){
            //         $_SESSION['save_price'] = $auc_price;
            //         $_SESSION['save_title'] = $auc_title;
            //         $_SESSION['save_end'] = $auc_end;
            //         $_SESSION['save_desc'] = $auc_desc;
            //         $telManError = true;
            //         $_SESSION['add_prod_errors'] += ['telManError' => "asdasf"];
            //     }
            // }
        }else{
            die("keqqqq");
        }


        if($titleError || $priceError || $startError || $endError || $descError || $photo1Error || $photo2Error || $photo3Error){
            header("location:myauctions.php"); die();
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
        <div class="row justify-content-center" style="background:#fff; box-shadow:0px 0px 10px 0px rgb(0 0 0 / 10%);">
            <div class="col-xl-12 col-lg-6 col-md-8">
                <div class="box_account">
                    <div class="form_container" style="box-shadow:none;">
                        <div class="private box" >
                            <center>
                                <div class="divider">
                                    <span style="background-color:#fff">Vendose produktin tënd në ankand</span>
                                </div>

                                <div class="row no-gutters">
                                    <form  method="post" action="" enctype="multipart/form-data">
                                        <h3 style="text-decoration:underline;"> Te dhenat e produktit </h3>
                                        <div class="form-group row">
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style="">Kategoria</label> 
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" id="choosed_cat" name="auc_category" onchange="cat_choose();">
                                                    <?php 
                                                    $sel_cat = prep_stmt("SELECT * FROM categories WHERE parent_id != ?", 0, 'i');
                                                    echo "<option value=''> Zgjedh kategorinë </option>";
                                                    while($row_cat = mysqli_fetch_array($sel_cat)){
                                                        echo "<option value='".$row_cat['cat_title']."'>".$row_cat['cat_title']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Titulli ankandit</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="auc_title" placeholder="Titulli ankandit" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("titleError", $_SESSION['add_prod_errors'])){ echo "border-color:red;";}} ?>" value="<?php if(isset($_SESSION['save_title'])){echo $_SESSION['save_title'];} unset($_SESSION['save_title']); ?>" >
                                                </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style="margin-top:.5em;">Cmimi fillestar</label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control float-left" name="auc_price" placeholder="Çmimi fllestar" style="width:40%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("priceError", $_SESSION['add_prod_errors'])){ echo "border-color:red;";}} ?>"  value="<?php if(isset($_SESSION['save_price'])){echo $_SESSION['save_price'];} unset($_SESSION['save_price']); ?>">
                                                <div class="input-group-prepend" style="padding:0 !important;">
                                                    <div class="input-group-text" style="padding: .375rem .475rem">€</div>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style="">Ankandi fillon nga: </label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="auc_start" class="form-control datepicker-2" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("startError", $_SESSION['add_prod_errors'])){ echo "border-color:red;";}} ?>" value="<?php if(isset($_SESSION['save_start'])){echo $_SESSION['save_start'];}else{ echo date("d-m-Y",strtotime("+1day"));} unset($_SESSION['save_start']); ?>">
                                            </div>
                                            <p id="demooo"></p>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label class="float-right" style="">Sa ditë dëshironi që produkti juaj të qëndroj në ankand: </label> 
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" name="auc_end" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("endError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" value="<?php if(isset($_SESSION['save_end'])){echo $_SESSION['save_end'];} ?>">
                                                    <option value=""> Zgjidh  sa ditë dëshiron të qëndroj në ankand produkti juaj... </option>
                                                    <option value="1" <?php if(isset($_SESSION['save_end'])){ echo "selected"; unset($_SESSION['save_end']); }  ?>> 1 </option>
                                                    <option value="2"> 2 </option>
                                                    <option value="3"> 3 </option>
                                                    <option value="4"> 4 </option>
                                                    <option value="5"> 5 </option>
                                                    <option value="6"> 6 </option>
                                                    <option value="7"> 7 </option>
                                                </select>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" name="auc_description" class="float-right" style="">Përshkrimi </label> 
                                            </div>
                                            <div class="col-6" style="padding-bottom:5px;">
                                            <textarea rows="4" name="auc_description" class="form-control" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("descError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" ><?php if(isset($_SESSION['save_desc'])){ echo $_SESSION['save_desc']; } unset($_SESSION['save_desc']);?></textarea>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style="">Fotot </label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="auc_photo1" class="form-control" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo1Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style=""></label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="auc_photo2" class="form-control"  style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo2Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" >
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style=""> </label> 
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-6">
                                                <input type="file"  name="auc_photo3"  class="form-control"style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo3Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" >
                                            </div>
                                            <div class="col-4 col-form-label">
                                                <label for=""  class="float-right" style=""></label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="auc_photo4" class="form-control"  >
                                            </div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style=""> </label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="auc_photo5"  class="form-control"  >
                                            </div>
                                        </div>
                                        <?php unset($_SESSION['add_prod_errors']['titleError']);unset($_SESSION['add_prod_errors']['priceError']);unset($_SESSION['add_prod_errors']['startError']); unset($_SESSION['add_prod_errors']['endError']);unset($_SESSION['add_prod_errors']['descError']);unset($_SESSION['add_prod_errors']['photo1Error']);unset($_SESSION['add_prod_errors']['photo2Error']);unset($_SESSION['add_prod_errors']['photo3Error']);?>
                                        <!--- SPECIIFIKAT -->
                                        <h3 style="text-decoration:underline;" id="spec_h3" > Specifikat </h3>
                                        <!--- SPECIIFIKAT e laptopit-->
                                        <div id="spec_laptop" >
                                            <div class="form-group row" >
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Prodhuesi:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" id="lap_manufacturer" name="lap_manufacturer" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapManError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } } unset($_SESSION['add_prod_errors']['lapManError']); ?>" <?php if(isset($_SESSION['save_lapMan'])){ echo "value='".$_SESSION['save_lapMan']."'"; } ?>>
                                                        <?php 
                                                        $sel_man_lap = prep_stmt("SELECT * FROM prod_manufacturers WHERE cat_id = ? ORDER BY prod_manufacturer ASC", 2, 'i');
                                                        echo "<option value=''> Zgjedh prodhuesin </option>";
                                                        while($row_man_lap = mysqli_fetch_array($sel_man_lap)){
                                                            echo "<option value='".$row_man_lap['prod_manufacturer']."'>".$row_man_lap['prod_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right">Modeli:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_model" id="lap_model" class="form-control"   placeholder="Modeli laptopit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapModError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>" <?php if(isset($_SESSION['save_lapMod'])){ echo "value='".$_SESSION['save_lapMod']."'"; } ?>>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Gjendja:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="lap_condition"   placeholder="Gjendja e laptopit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapConError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>">
                                                    <option value=""> Gjendja laptopit </option>
                                                    <option value="I ri"> I ri </option>
                                                    <option value="I përdorur"> I përdorur </option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Diagonalja ekranit (inch):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_display" class="form-control"   placeholder="Diagonalja ekranit (e shprehur me inch).." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapDisError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>" <?php if(isset($_SESSION['save_lapDis'])){ echo "value='".$_SESSION['save_lapDis']."'"; } ?>>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Ngjyra:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_color" class="form-control"   placeholder="Ngjyra.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapColError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapCol'])){ echo "value='".$_SESSION['save_lapCol']."'"; } ?>>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label class="float-right" style="">Procesori:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_procesor" class="form-control"   placeholder="Procesori.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapProcError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapProc'])){ echo "value='".$_SESSION['save_lapProc']."'"; } ?>>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Memorja RAM (GB):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_ram" class="form-control"   placeholder="Hapsira e RAM memorjes (e shprehur në GB)..." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapRamError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapRam'])){ echo "value='".$_SESSION['save_lapRam']."'"; } ?>>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Memorja e mbrendshme:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="lap_internal_memory"  style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapIntMemError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>">
                                                    <option value=""> Memorja e mbrendshme.. </option>
                                                    <option value="HDD"> HDD </option>
                                                    <option value="SSD"> SSD </option>
                                                    <option value="Hybrid"> Hybrid </option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Hapsira e memorjes se mbrendshme (GB):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_internal_memory_space" class="form-control"   placeholder="Hapsira e memorjes së mbrendshme..." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapIntMemSpaceError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapIntMemSpace'])){ echo "value='".$_SESSION['save_lapIntMemSpace']."'"; } ?>>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Kartela Grafike:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_graphic_card" class="form-control"   placeholder="Kartela Grafike.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapGrapError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>" <?php if(isset($_SESSION['save_lapGrap'])){ echo "value='".$_SESSION['save_lapGrap']."'"; } ?>>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION['add_prod_errors']['lapManError']);unset($_SESSION['add_prod_errors']['lapModError']);unset($_SESSION['add_prod_errors']['lapConError']); unset($_SESSION['add_prod_errors']['lapDisError']);unset($_SESSION['add_prod_errors']['lapColError']);unset($_SESSION['add_prod_errors']['lapProcError']);unset($_SESSION['add_prod_errors']['lapRamError']);unset($_SESSION['add_prod_errors']['lapIntMemError']);unset($_SESSION['add_prod_errors']['lapIntMemSpaceError']); unset($_SESSION['add_prod_errors']['lapGrapError']);?>
                                            <?php unset($_SESSION['save_lapMod']); unset($_SESSION['save_lapDis']); unset($_SESSION['save_lapCol']); unset($_SESSION['save_lapProc']); unset($_SESSION['save_lapRam']);unset($_SESSION['save_lapIntMemSpace']); unset($_SESSION['save_lapGrap']); ?>
                                        </div>
                                        <!--- SPECIIFIKAT e telefonit-->
                                        <div id="spec_phone" >
                                            <div class="form-group row" >
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Prodhuesi:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="phone_manufacturer"   placeholder="Zgjedh prodhuesin" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("telManError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } } unset($_SESSION['add_prod_errors']['telManError']); ?>">
                                                        <?php 
                                                        $sel_man_lap = prep_stmt("SELECT * FROM prod_manufacturers WHERE cat_id = ? ORDER BY prod_manufacturer ASC", 3, 'i');
                                                        echo "<option value=''> Zgjedh prodhuesin </option>";
                                                        while($row_man_lap = mysqli_fetch_array($sel_man_lap)){
                                                            echo "<option value='".$row_man_lap['prod_manufacturer']."'>".$row_man_lap['prod_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Modeli:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="phone_model" class="form-control"   placeholder="Modeli telefonit..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Gjendja:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="phone_condition"   placeholder="Gjendja e laptopit..">
                                                    <option value=""> Gjendja telefonit </option>
                                                    <option value="I ri"> I ri </option>
                                                    <option value="I përdorur"> I përdorur </option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Ngjyra:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="phone_color" class="form-control"   placeholder="Ngjyra">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Sistemi operativ:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="phone_operating_system"   placeholder="Lloji i memorjes së mbrendshme..">
                                                    <option value=""> Sistemi operativ.. </option>
                                                    <option value="ios"> IOS </option>
                                                    <option value="android"> Android </option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Memorja RAM (GB):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="phone_ram" class="form-control"   placeholder="Memorja RAM (e shprehur ne GB)..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Memorja e mbrendshme (GB):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="phone_internal_memory_space" class="form-control"   placeholder="Hapsira e memorjes së mbrendshme (e shprehur me GB):..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label class="float-right" style="">Numri i SIM kartelave:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="phone_sim" class="form-control"   placeholder="Numri i SIM kartelave..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label class="float-right" style="">Vendi i prodhimit:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="phone_origin_of_production" class="form-control"   placeholder="Vendi i prodhimit">
                                                </div>
                                            </div>
                                            <?php unset($_SESSION['add_prod_errors']['telManError']);?>
                                        </div>
                                        <!--- SPECIIFIKAT e veturave-->
                                        <div id="spec_cars" >
                                            <div class="form-group row" >
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Prodhuesi</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="man_lap"   placeholder="Zgjedh prodhuesin">
                                                        <?php 
                                                        $sel_man_lap = prep_stmt("SELECT * FROM prod_manufacturers WHERE cat_id = ? ORDER BY prod_manufacturer ASC", 5, 'i');
                                                        echo "<option value=''> Zgjedh prodhuesin </option>";
                                                        while($row_man_lap = mysqli_fetch_array($sel_man_lap)){
                                                            echo "<option value='".$row_man_lap['prod_manufacturer']."'>".$row_man_lap['prod_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Modeli:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="car_model" class="form-control"   placeholder="Modeli veturës..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Kilometrazha:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="car_km" class="form-control"   placeholder="Kilometrat e kaluara..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Viti prodhimit:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="car_year_of_production" class="form-control"   placeholder="Viti i prodhimit..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Tipi i veturës:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="car_type"  >
                                                        <option value=""> Tipi i veturës </option>
                                                        <option value="Veturë e vogël"> Veturë e vogël (2 ulëse) </option>
                                                        <option value="Sedan"> Sedan</option>
                                                        <option value="Kupe"> Kupe</option>
                                                        <option value="Hatchback"> Hatchback</option>
                                                        <option value="Universal"> Universal</option>
                                                        <option value="Kabriolet"> Kabriolet</option>
                                                        <option value="Kabriolet"> SUV</option>
                                                        <option value="Kabriolet"> Minivan</option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Ngjyra veturës:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="car_color" class="form-control"   placeholder="Ngjyra veturës..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Transmisioneri:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="car_transmission"  >
                                                        <option value=""> Transmisioneri.. </option>
                                                        <option value="Manual"> Manual</option>
                                                        <option value="Automatik"> Automatik</option>
                                                        <option value="Gjysmë-automatik"> Gjysmë-automatik</option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Karburanti:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="car_fuel"  >
                                                        <option value=""> Karburanti.. </option>
                                                        <option value="Benzinë"> Benzinë</option>
                                                        <option value="Naftë"> Naftë</option>
                                                        <option value="Rrymë elektrike"> Rrymë elektrike</option>
                                                        <option value="Gaz natyror i kompresuar"> Gaz natyror i kompresuar (CNG)</option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Kubikazha:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="car_cubics" class="form-control"   placeholder="Kubikazha e veturës..">
                                                </div>
                                            </div>
                                        </div>
                                        <!--- SPECIIFIKAT e templates-->
                                        <div id="spec_template" >
                                            <div class="form-group row" >
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Kategoria e templates..</label> 
                                                </div>
                                                <div class="col-6">
                                                <input type="text" class="form-control" name="template_category"   placeholder="Kategoria e templates..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Teknologjitë e përdorura:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="template_used_tech" class="form-control"   placeholder="Teknologjitë e përdorura..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Layouti:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="template_layout"  >
                                                        <option value=""> Layotui.. </option>
                                                        <option value="Responsivë"> Responsivë</option>
                                                        <option value="Jo resposivë"> Jo resposivë</option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="" class="float-right" style="">Dokumentimi:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="template_documented"  >
                                                        <option value=""> Dokumentimi.. </option>
                                                        <option value="I dokumentuar"> I dokumentuar</option>
                                                        <option value="Jo i dokumentuar"> Jo i dokumentuar</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pl-1" id="btn_spec" style="display:none;">
                                            <div class="text-center btn_center" style="margin-bottom:15px;">
                                                <button type="submit" id="btn_add_prod" name="btn_add_prod" value="" class="btn_1 ">Shto produktin</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOW SHERBIMIN -->
    <script type="text/javascript">
        function cat_choose(){
            var cat = document.getElementById("choosed_cat"); //merre prej selektit vleren e zgjedhur
            if(cat.value == ""){
                cat.style.borderColor ="red";
                var cat_bool = false;
            }
            else if(cat.value == "Laptop"){
                cat_bool = true;
                document.getElementById("btn_spec").style.display = "block";
                document.getElementById("spec_h3").style.display = "block";
                document.getElementById("spec_laptop").style.display="block";  
                document.getElementById("spec_phone").style.display="none"; 
                document.getElementById("spec_cars").style.display="none"; 
                document.getElementById("spec_template").style.display="none"; 
                cat.style.borderColor ="green";
                document.getElementById("auc_title").focus();
                if(document.getElementById("lap_manufacturer").value == ""){
                    document.getElementById("lap_manufacturer").style.border = "1px solid red";
                }
            }else if(cat.value == "Telefon"){
                cat_bool = true;
                document.getElementById("btn_spec").style.display = "block";
                document.getElementById("spec_h3").style.display = "block";
                document.getElementById("spec_laptop").style.display="none";  
                document.getElementById("spec_phone").style.display="block"; 
                document.getElementById("spec_cars").style.display="none"; 
                document.getElementById("spec_template").style.display="none"; 
                cat.style.borderColor ="green";
                document.getElementById("auc_title").focus();
            }else if(cat.value == "Vetura"){
                cat_bool = true;
                document.getElementById("btn_spec").style.display = "block";
                document.getElementById("spec_h3").style.display = "block";
                document.getElementById("spec_laptop").style.display="none";  
                document.getElementById("spec_phone").style.display="none"; 
                document.getElementById("spec_cars").style.display="block"; 
                document.getElementById("spec_template").style.display="none"; 
                cat.style.borderColor ="green";
                document.getElementById("auc_title").focus();
            }else if(cat.value == "Template"){
                cat_bool = true;
                document.getElementById("btn_spec").style.display = "block";
                document.getElementById("spec_h3").style.display = "block";
                document.getElementById("spec_laptop").style.display="none";  
                document.getElementById("spec_phone").style.display="none"; 
                document.getElementById("spec_cars").style.display="none"; 
                document.getElementById("spec_template").style.display="block";
                cat.style.borderColor ="green";
                document.getElementById("auc_title").focus(); 
            }else {
                cat_bool = false;
                document.getElementById("btn_spec").style.display = "none";
                document.getElementById("spec_h3").style.display = "none";
                document.getElementById("spec_laptop").style.display="none";  
                document.getElementById("spec_phone").style.display="none"; 
                document.getElementById("spec_cars").style.display="none"; 
                document.getElementById("spec_template").style.display="none"; 
                cat.style.borderColor ="red";
            }
        }
    </script>
    <!-- checkin errors -->
    <!-- <script>
        document.getElementById("auc_title").onkeyup = function () {
            var auc_titulli = document.getElementById("auc_title").value;
            
            if(auc_titulli.length < 5){
                document.getElementById("auc_title").style.border = "1px solid red";
            }else{
                document.getElementById("auc_title").style.border = "1px solid green";
            }
        }
        document.getElementById("auc_price").onkeyup = function () {
            var auc_cmimi = document.getElementById("auc_price").value;
            if(auc_cmimi.match(/^\d+$/)) 
                if(auc_cmimi < 1 || auc_cmimi > 10000){
                    document.getElementById("auc_price").style.border = "1px solid red";
                }else{
                    document.getElementById("auc_price").style.border = "1px solid green";
                }
            else{
                document.getElementById("auc_price").style.border = "1px solid red";
            }
        }
         function auc_end() {
            var auc_perfundimi = document.getElementById("auc_end").value;
            if(auc_perfundimi != "" && auc_perfundimi == 1 || auc_perfundimi == 2|| auc_perfundimi ==3 ||  auc_perfundimi == 4 ||  auc_perfundimi == 5 ||  auc_perfundimi == 6 ||  auc_perfundimi == 7){
                document.getElementById("auc_end").style.border = "1px solid green";
            }else {
               document.getElementById("auc_end").style.border = "1px solid red";
            }
        }
    </script> -->
    <script src="js/datepicker/jquery-3.3.1.min.js"></script>
    <script src="js/datepicker/jquery-ui.min.js"></script>
    <script src="js/datepicker/jquery.slicknav.js"></script>
    <script src="js/datepicker/main.js"></script>
</main>
<?php require 'footer.php'; ?>
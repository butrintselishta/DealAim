<?php 
    
    require_once("db.php");
    if($_SESSION['logged']==false){
        header("location:signin.php");
    }
    if($_SESSION['user']['status'] != SELLER){
        header("index.php");
    }
   
    // $dir = "img/products/templates/";
    // $allFiles = scandir($dir);
    // $files = array_diff($allFiles, array('.', '..')); //die(var_dump($files)); 
    // foreach($files as $file){
    //     $fl = $file;
    // }
    // $exp = explode(".", $fl);//die(var_dump($exp[1]));
    // if($exp[1] == "zip"){
    //     $path = $dir . $fl;
    //     public ZipArchive::open ( );
    //     if(is_resource($zip)){
    //         $zip->extractTo($dir); die(var_dump($zip));die($zip);
    //     }else{
    //         die("zip keq");
    //     }
    // }else{die("keq");}
    // if($res == true){
    //     $path = dirname(__FILE__)."/img/products/templates/";
    //     $zip->extractTo($path);die(var_dump($res));
    //     $zip->close();die(var_dump($zip));
    // }else{
    //     die("keq");
    // }
    if(isset($_POST['btn_add_prod'])){
        $auc_category = $_POST['auc_category'];//die(var_dump($category));
        $auc_title = ucfirst($_POST['auc_title']); 
        $auc_price = str_replace(" ", "",$_POST['auc_price']);//die(var_dump($auc_price));
        $auc_start = $_POST['auc_start'];
        $auc_end = $_POST['auc_end']; 
        $auc_desc = ucfirst($_POST['auc_description']);

        $start_at = strtotime($auc_start);
        $day_after_today = strtotime(date("d-m-Y", strtotime("+1 days")));//tomorrow date
        $day_after_sevendays = strtotime(date("d-m-Y", strtotime("+1 week")));//7 days from today

        //GENERATING AN UNIQUE ID for every Product
        $unique_id = uniqid($_SESSION['user']['username']."_", true);
        //SELECTING CAT_ID
        $select_cat_id = prep_stmt("SELECT cat_id FROM categories WHERE cat_title = ?", $auc_category, "s");
        $selected_cat_id = mysqli_fetch_array($select_cat_id);
        $selected_cat_id = $selected_cat_id['cat_id'];

        $titleError = false; $priceError = false; $startError = false; $endError = false; $descError = false;$photo1Error = false;$photo2Error = false;$photo3Error = false; $photo4Error = false; $photo5Error = false; 
        //laptop ERRORS
        $lapManError = false; $lapModError = false; $lapConError = false; $lapDisError = false; $lapColError = false; $lapProcError = false; $lapRamError = false; $lapIntMemError = false; $lapIntMemSpaceError = false; $lapGrapError = false;
        //phone Errors
        $phoneManError = false; $phoneModError=false; $phoneColError = false; $phoneConError = false; $phoneOsError = false; $phoneRamError = false; $phoneIntMemSpaceError = false; $phoneSimError = false; $phoneOriginError = false;
        //cars Errors
        $carManError = false; $carModError = false;  $carKmError = false; $carYopError = false; $carTypeError = false; $carColError = false; $carTransError = false; $carFuelsError = false; $carCubError = false;
        //template Errors
        $tempZipError = false; $tempCatError = false; $tempUtError = false; $tempLayoutError = false; $tempDocError = false;
        $_SESSION['add_prod_errors'] = array();
        //error MESAZHI
        $error_msg = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D; font-weight:600;'> Fushat me të kuqe janë të zbrazëta ose nuk janë të shënuara në formatin e duhur. Ju lutem mbushini fushat sipas kërkesave! </p>";

        if(strlen($auc_title) < 6 || strlen($auc_title) > 100){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $titleError = true;
            $_SESSION['add_prod_errors'] += ['titleError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë pranon 6 deri 100 karaktere.</li>
            </ul>"];
        }
        
        if(empty($auc_price)){
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $priceError = true;
            $_SESSION['add_prod_errors'] += ['priceError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -222px; '>Kjo fushë nuk mund të jetë e zbrazet.</li>
            </ul>"];
        }
        else if(!filter_var($auc_price, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $priceError = true;
            $_SESSION['add_prod_errors'] += ['priceError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -222px; '>Cmimi dhënë nuk është në formatin e duhur.</li>
            </ul>"];
        }
        if(empty($start_at)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $startError = true;
            $_SESSION['add_prod_errors'] += ['startError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
            </ul>"];
        }
        elseif($start_at < $day_after_today || $start_at > $day_after_sevendays){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $startError = true;
            $_SESSION['add_prod_errors'] += ['startError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem datën e fillimit ta zgjedhni vetëm nga nesër deri në 7 ditë pas saj.</li>
            </ul>"];
        }
        if(empty($auc_end)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_desc'] = $auc_desc;
            $endError = true;
            $_SESSION['add_prod_errors'] += ['endError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
            </ul>"];
        }else if($auc_end > 7){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_desc'] = $auc_desc;
            $endError = true;
            $_SESSION['add_prod_errors'] += ['endError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ankandi lejohet të mbyllet maksimumi deri në 7 ditë prej ditës së daljes.</li>
            </ul>"];
        }
        if(empty($auc_desc)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $descError = true;
            $_SESSION['add_prod_errors'] += ['descError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
            </ul>"];
        }else if(strlen($auc_desc) < 50){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $descError = true;
            $_SESSION['add_prod_errors'] += ['descError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë duhet ti ketë minimum 50 karaktere.</li>
            </ul>"];
        }
        if(!is_uploaded_file($_FILES['auc_photo1']['tmp_name'])){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photo1Error = true;
            $_SESSION['add_prod_errors'] += ['photo1Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
            </ul>"];
        }
        if(!is_uploaded_file($_FILES['auc_photo2']['tmp_name'])){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photo2Error = true;
            $_SESSION['add_prod_errors'] += ['photo2Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
            </ul>"];
        }
        if(!is_uploaded_file($_FILES['auc_photo3']['tmp_name'])){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photo1Error = true;
            $_SESSION['add_prod_errors'] += ['photo3Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
            <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
            </ul>"];
        }
        
        //nese jon bo uploat filet check
        $basename_4 = ""; $basename_5="";
        if(is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
            $pic_1 = $_FILES['auc_photo1'];
            $picname = "photo1_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic_1["name"], PATHINFO_EXTENSION));
            $basename_1   = $picname . "." . $imageFileType ;
            $check = getimagesize($pic_1["tmp_name"]);

            if($check == false) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo1Error = true;
                $_SESSION['add_prod_errors'] += ['photo1Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto nuk është në formatin e duhur.</li>
                </ul>"];
            }
            if ($pic_1['size'] > 3000000) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo1Error = true;
                $_SESSION['add_prod_errors'] += ['photo1Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto është shumë e madhe.</li>
                </ul>"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo1Error = true;
                $_SESSION['add_prod_errors'] += ['photo1Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto duhet të jetë e formatit JPG,JPEG apo PNG</li>
                </ul>"];
            }
            $source_1 = $pic_1["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
            $pic_2 = $_FILES['auc_photo2'];
            $picname = "photo2_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic_2["name"], PATHINFO_EXTENSION));
            $basename_2   = $picname . "." . $imageFileType; 
            $check = getimagesize($pic_2["tmp_name"]);

            if ($check == false) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo2Error = true;
                $_SESSION['add_prod_errors'] += ['photo2Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto nuk është në formatin e duhur.</li>
                </ul>"];
            }
            if ($pic_2['size'] > 3000000) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo2Error = true;
                $_SESSION['add_prod_errors'] += ['photo2Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto është shumë e madhe.</li>
                </ul>"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo2Error = true;
                $_SESSION['add_prod_errors'] += ['photo2Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto duhet të jetë e formatit JPG,JPEG apo PNG</li>
                </ul>"];
            }
            $source_2 = $pic_2["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
            $pic_3 = $_FILES['auc_photo3'];
            $picname = "photo3_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic_3["name"], PATHINFO_EXTENSION));
            $basename_3   = $picname . "." . $imageFileType; 
            $check = getimagesize($pic_3["tmp_name"]);

            if ($check == false) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo3Error = true;
                $_SESSION['add_prod_errors'] += ['photo3Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto nuk është në formatin e duhur.</li>
                </ul>"];
            }
            if ($pic_3['size'] > 3000000) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo3Error = true;
                $_SESSION['add_prod_errors'] += ['photo3Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto është shumë e madhe.</li>
                </ul>"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo3Error = true;
                $_SESSION['add_prod_errors'] += ['photo3Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto duhet të jetë e formatit JPG,JPEG apo PNG</li>
                </ul>"];
            }
            $source_3 = $pic_3["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
            $pic_4 = $_FILES['auc_photo4'];
            $picname = "photo4_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic_4["name"], PATHINFO_EXTENSION));
            $basename_4   = $picname . "." . $imageFileType; 
            $check = getimagesize($pic_4["tmp_name"]);

            if ($check == false) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo4Error = true;
                $_SESSION['add_prod_errors'] += ['photo4Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto nuk është në formatin e duhur.</li>
                </ul>"];
            }
            if ($pic_4['size'] > 3000000) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo4Error = true;
                $_SESSION['add_prod_errors'] += ['photo4Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto është shumë e madhe.</li>
                </ul>"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo4Error = true;
                $_SESSION['add_prod_errors'] += ['photo4Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto duhet të jetë e formatit JPG,JPEG apo PNG</li>
                </ul>"];
            }
            $source_4 = $pic_4["tmp_name"];
        }
        if(is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
            $pic_5 = $_FILES['auc_photo5'];
            $picname = "photo5_" . $unique_id; //emri i produktit: lea_1 psh
            $imageFileType = strtolower(pathinfo($pic_5["name"], PATHINFO_EXTENSION));
            $basename_5   = $picname . "." . $imageFileType; 
            $check = getimagesize($pic_5["tmp_name"]);

            if ($check == false) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo5Error = true;
                $_SESSION['add_prod_errors'] += ['photo5Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto nuk është në formatin e duhur.</li>
                </ul>"];
            }
            if ($pic_5['size'] > 3000000) {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo5Error = true;
                $_SESSION['add_prod_errors'] += ['photo5Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto është shumë e madhe.</li>
                </ul>"];
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['save_price'] = $auc_price;
                $_SESSION['save_title'] = $auc_title;
                $_SESSION['save_start'] = $auc_start;
                $_SESSION['save_end'] = $auc_end;
                $_SESSION['save_desc'] = $auc_desc;
                $photo5Error = true;
                $_SESSION['add_prod_errors'] += ['photo5Error' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Foto duhet të jetë e formatit JPG,JPEG apo PNG</li>
                </ul>"];
            }
            $source_5 = $pic_5["tmp_name"];
        }

        //start from 12PM of the GIVEN AUCTION START DAY
        $hourstoadd = 12;
        $secondstoadd = $hourstoadd * (60*60);
        $auc_start_time = $day_after_today + $secondstoadd;
        $start_time = date("Y-m-d h:i", $auc_start_time);

        $daystoadd = $auc_end . " days";
        $auc_end_time = date('Y-m-d', $auc_start_time);
        $end_time = date("Y-m-d h:i", strtotime($auc_end_time . $daystoadd));
        $isApproved = 0;

        //me  marre specifikat varesisht prej kategorive
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
                ucfirst($lap_mod = $_POST['lap_model']);
                $lap_condition = $_POST['lap_condition'];
                $lap_display = $_POST['lap_display'];
                $lap_col = ucfirst($_POST['lap_color']); 
                $lap_proc = $_POST['lap_procesor'];    
                $lap_ram = $_POST['lap_ram'];
                $lap_intmem = $_POST['lap_internal_memory'];
                $lap_intmem_space = $_POST['lap_internal_memory_space'];
                $lap_grap = ucfirst($_POST['lap_graphic_card']);
                // die($lap_man.$lap_mod." ".$lap_condition." ".$lap_display." ".$lap_col." ".$lap_proc." ".$lap_ram." ".$lap_intmem." ".$lap_intmem_space." ".$lap_grap);
              
                $sel_lap_man = prep_stmt("SELECT prod_manufacturer FROM prod_manufacturers WHERE cat_id = ?", 2, 'i');
                $lap_manufacturers = array();
                while($row_sel_lap_man = mysqli_fetch_array($sel_lap_man)){
                    $lap_manufacturers[] = $row_sel_lap_man['prod_manufacturer'];
                }

                if(empty($lap_man)){
                    $_SESSION['save_price'] = $auc_price; $_SESSION['save_title'] = $auc_title; $_SESSION['save_end'] = $auc_end; $_SESSION['save_desc'] = $auc_desc; $_SESSION['save_lapMod'] = $lap_mod; $_SESSION['save_lapCon'] = $lap_condition; $_SESSION['save_lapDis'] = $lap_display; $_SESSION['save_lapCol'] = $lap_col; $_SESSION['save_lapProc'] = $lap_proc; $_SESSION['save_lapRam'] = $lap_ram; $_SESSION['save_lapIntMem'] = $lap_intmem; $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space; $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapManError = true;
                    $_SESSION['add_prod_errors'] += ['lapManError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                else if(array_search($lap_man, $lap_manufacturers) === false){
                    $_SESSION['save_price'] = $auc_price; $_SESSION['save_title'] = $auc_title; $_SESSION['save_end'] = $auc_end; $_SESSION['save_desc'] = $auc_desc; $_SESSION['save_lapMod'] = $lap_mod; $_SESSION['save_lapCon'] = $lap_condition; $_SESSION['save_lapDis'] = $lap_display; $_SESSION['save_lapCol'] = $lap_col; $_SESSION['save_lapProc'] = $lap_proc; $_SESSION['save_lapRam'] = $lap_ram; $_SESSION['save_lapIntMem'] = $lap_intmem; $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space; $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapManError = true;
                    $_SESSION['add_prod_errors'] += ['lapManError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem zgjedhni vetëm nga prodhuesit që gjenden në listë.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapModError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapConError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapDisError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!is_numeric($lap_display)){
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
                    $_SESSION['add_prod_errors'] += ['lapDisError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shkruani horizontalen e ekranit vetëm përmes numrit, pa karaktere tjera.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapColError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapColError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë pranon vetëm shkronja në rangun A-ZH.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapProcError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapRamError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapRamError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni hapsirën e RAM (në GB) vetëm përmes numrave.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapIntMemError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapIntMemSpaceError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
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
                    $_SESSION['save_lapProc'] = $lap_proc;
                    $_SESSION['save_lapRam'] = $lap_ram;
                    $_SESSION['save_lapIntMem'] = $lap_intmem;
                    $_SESSION['save_lapIntMemSpace'] = $lap_intmem_space;
                    $_SESSION['save_lapGrap'] = $lap_grap;
                    $lapIntMemSpaceError = true;
                    $_SESSION['add_prod_errors'] += ['lapIntMemSpaceError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni hapsirën e RAM (në GB) vetëm përmes numrave.</li>
                    </ul>"];
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
                    $_SESSION['add_prod_errors'] += ['lapGrapError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }

                if($titleError || $priceError || $startError || $endError || $descError || $photo1Error || $photo2Error || $photo3Error || $photo4Error || $photo5Error || $lapManError || $lapModError || $lapModError || $lapConError || $lapDisError || $lapColError || $lapProcError || $lapRamError || $lapIntMemError || $lapIntMemSpaceError || $lapGrapError){
                    header("location:myauctions.php"); die();
                }
                else{
                    // $i = 1;
                    // $targett = "target_dir_".$i;die(var_dump($targett));
                    // for($i=1; $i <= 3; $i++){
                    //     if(is_uploaded_file($_FILES['auc_photo'.$i]['tmp_name'])) {
                    //         $target_dir_.$i = "img/products/laptops/$basename_$i";
                    //         move_uploaded_file($source_.$i, $target_dir_.$i); 
                    //     }
                    // }
                    if (is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
                        $target_dir_1 = "img/products/laptops/$basename_1";
                        move_uploaded_file($source_1, $target_dir_1);
                    }
                    if(is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
                        $target_dir_2 = "img/products/laptops/$basename_2";
                        move_uploaded_file($source_2, $target_dir_2);
                    }
                    if (is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
                        $target_dir_3 = "img/products/laptops/$basename_3";
                        move_uploaded_file($source_3, $target_dir_3);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
                        $target_dir_4 = "img/products/laptops/$basename_4";
                        move_uploaded_file($source_4, $target_dir_4);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
                        $target_dir_5 = "img/products/laptops/$basename_5";
                        move_uploaded_file($source_5, $target_dir_5);
                    } 
                    $photo_1_base = $basename_1; $photo_2_base = "|" . $basename_2; $photo_3_base = "|" . $basename_3; $photo_4_base = "|" . $basename_4; $photo_5_base = "|" . $basename_5;

                    $prod_img = "";
                    if(empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base;
                    }elseif(!empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base;
                    }elseif(empty($basename_4) && !empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_5_base;
                    }else { $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base . $photo_5_base;
                    }

                    //INSERT PRODUKTIN 
                    $insert_lap_prod = prep_stmt("INSERT INTO products(prod_unique_id, prod_img, prod_title, prod_price, prod_from, prod_to, prod_description,cat_id,user_id,prod_isApproved) VALUES(?,?,?,?,?,?,?,?,?,?)", array($unique_id,$prod_img,$auc_title, $auc_price, $start_time, $end_time,$auc_desc,$selected_cat_id,user_id(),$isApproved), "sssssssiii");
                    //INSERT SPECIFIKAT
                    $insert_lap_spec = prep_stmt("INSERT INTO prod_specifications(lap_man, lap_mod, lap_con, lap_dia,lap_col,lap_proc, lap_ram, lap_im, lap_ims, lap_gc,prod_unique_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)", array($lap_man,$lap_mod, $lap_condition,$lap_display, $lap_col, $lap_proc, $lap_ram,$lap_intmem,$lap_intmem_space,$lap_grap, $unique_id), "sssssssssss");

                    if($insert_lap_prod && $insert_lap_spec){
                        $_SESSION['insertion_success'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Produkti juaj është shtuar në databaz tonë. Mbrenda 24 orësh njëri nga administratorët tonë e rishikon dhe nëse gjithçka është në rregull e aprovon atë.<br>
                        <i style='color:#F0AC1A'><b>LAJMËRIM:</b> Ne rast se produkti nuk pranohet para kohës së dhënë per dalje në ankand, ai do të dal një ditë më vone e që natyrisht përfundon një ditë më vonë se që është parashikuar!</i><br><b> JU FALEMINDERIT! </b></p>"; header("location:myauctions.php"); die();
                    }else {
                        $_SESSION['insertion_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni dhe provoni më vonë! </p>"; header("location:myauctions.php"); die();
                    }
                }

            }
            else if($_POST['auc_category'] == "Telefon"){
                $phone_man = $_POST['phone_manufacturer'];
                $phone_mod = ucfirst($_POST['phone_model']);
                $phone_con = $_POST['phone_condition'];
                $phone_col = ucfirst($_POST['phone_color']);
                $phone_os = $_POST['phone_operating_system'];
                $phone_ram = $_POST['phone_ram'];
                $phone_int_mem_space = $_POST['phone_internal_memory_space'];
                $phone_sim = $_POST['phone_sim'];
                $phone_origin = strtoupper($_POST['phone_origin_of_production']);
                //select lap maunfacturers
                $sel_phone_man = prep_stmt("SELECT prod_manufacturer FROM prod_manufacturers WHERE cat_id = ?", 3, 'i');
                $phone_manufacturers = array();
                while($row_sel_phone_man = mysqli_fetch_array($sel_phone_man)){
                    $phone_manufacturers[] = $row_sel_phone_man['prod_manufacturer'];
                }

                if(empty($phone_man)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneManError = true;
                    $_SESSION['add_prod_errors'] += ["phoneManError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(array_search($phone_man, $phone_manufacturers) === false){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneManError = true;
                    $_SESSION['add_prod_errors'] += ["phoneManError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem zgjedhni vetëm nga prodhuesit që gjenden në listë.</li>
                    </ul>"];
                }
                if(empty($phone_mod)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneModError = true;
                    $_SESSION['add_prod_errors'] += ["phoneModError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($phone_con)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneConError = true;
                    $_SESSION['add_prod_errors'] += ["phoneConError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($phone_col)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneColError = true;
                    $_SESSION['add_prod_errors'] += ["phoneColError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!ctype_alpha($phone_col) && !((strpos($phone_col, 'ë')) || (strpos($phone_col, 'Ë')) || (strpos($phone_col, 'ç')) || (strpos($phone_col, 'Ç')))){
                    $_SESSION['save_price'] = $auc_price; //die(var_dump($phone_col ));
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneColError = true;
                    $_SESSION['add_prod_errors'] += ["phoneColError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë pranon vetëm shkronja në rangun A-ZH.</li>
                    </ul>"];
                }
                if(empty($phone_os)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneOsError = true;
                    $_SESSION['add_prod_errors'] += ["phoneOsError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($phone_ram)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneRamError = true;
                    $_SESSION['add_prod_errors'] += ["phoneRamError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!is_numeric($phone_ram)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneIntMemSpaceError = true;
                    $_SESSION['add_prod_errors'] += ["phoneIntMemSpaceError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni hapsirën e RAM (në GB) vetëm përmes numrave.</li>
                    </ul>"];
                }
                if(empty($phone_int_mem_space)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneIntMemSpaceError = true;
                    $_SESSION['add_prod_errors'] += ["phoneIntMemSpaceError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!is_numeric($phone_int_mem_space)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneIntMemSpaceError = true;
                    $_SESSION['add_prod_errors'] += ["phoneIntMemSpaceError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni hapsirën e mbrendshme (në GB) vetëm përmes numrave.</li>
                    </ul>"];
                }
                if(empty($phone_sim)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneSimError = true;
                    $_SESSION['add_prod_errors'] += ["phoneSimError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!is_numeric($phone_sim)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneOrigin'] = $phone_origin;
                    $phoneSimError = true;
                    $_SESSION['add_prod_errors'] += ["phoneSimError"=> "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni numrin e SIM kartelave vetëm përmes numrave.</li>
                    </ul>"];
                }
                if(empty($phone_origin)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_phoneMan'] = $phone_man;
                    $_SESSION['save_phoneMod'] = $phone_mod;
                    $_SESSION['save_phoneCon'] = $phone_con;
                    $_SESSION['save_phoneCol'] = $phone_col;
                    $_SESSION['save_phoneOs'] = $phone_os;
                    $_SESSION['save_phoneRam'] = $phone_ram;
                    $_SESSION['save_phoneIntMemSpace'] = $phone_int_mem_space;
                    $_SESSION['save_phoneSim'] = $phone_sim;
                    $phoneOriginError = true;
                    $_SESSION['add_prod_errors'] += ["phoneOriginError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                
                if($titleError || $priceError || $startError || $endError || $descError || $photo1Error || $photo2Error || $photo3Error || $photo4Error || $photo5Error || $phoneManError || $phoneModError || $phoneConError || $phoneColError || $phoneOsError || $phoneRamError || $phoneIntMemSpaceError || $phoneSimError || $lapIntMemSpaceError || $phoneOriginError){
                    header("location:myauctions.php"); die();
                }
                else{
                    if (is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
                        $target_dir_1 = "img/products/phones/$basename_1";
                        move_uploaded_file($source_1, $target_dir_1);
                    }
                    if(is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
                        $target_dir_2 = "img/products/phones/$basename_2";
                        move_uploaded_file($source_2, $target_dir_2);
                    }
                    if (is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
                        $target_dir_3 = "img/products/phones/$basename_3";
                        move_uploaded_file($source_3, $target_dir_3);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
                        $target_dir_4 = "img/products/phones/$basename_4";
                        move_uploaded_file($source_4, $target_dir_4);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
                        $target_dir_5 = "img/products/phones/$basename_5";
                        move_uploaded_file($source_5, $target_dir_5);
                    } 
                    $photo_1_base = $basename_1; $photo_2_base = "|" . $basename_2; $photo_3_base = "|" . $basename_3; $photo_4_base = "|" . $basename_4; $photo_5_base = "|" . $basename_5;

                    $prod_img = "";
                    if(empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base;
                    }elseif(!empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base;
                    }elseif(empty($basename_4) && !empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_5_base;
                    }else { $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base . $photo_5_base;
                    }

                    //INSERT PRODUKTIN
                    $insert_phone_prod = prep_stmt("INSERT INTO products(prod_unique_id, prod_img, prod_title, prod_price, prod_from, prod_to, prod_description,cat_id,user_id,prod_isApproved) VALUES(?,?,?,?,?,?,?,?,?,?)", array($unique_id,$prod_img,$auc_title, $auc_price, $start_time, $end_time,$auc_desc,$selected_cat_id,user_id(),$isApproved), "sssssssiii");
                    //INSERT SPECIFIKAT E PRODUKTIT
                    $insert_phone_spec = prep_stmt("INSERT INTO prod_specifications(tel_man, tel_mod,tel_cond, tel_col, tel_im,tel_ram,tel_scn,tel_os, tel_op, prod_unique_id) VALUES(?,?,?,?,?,?,?,?,?,?)", array($phone_man, $phone_mod, $phone_con, $phone_col, $phone_int_mem_space, $phone_ram, $phone_sim, $phone_os, $phone_origin,$unique_id), "ssssssssss");

                    if($insert_phone_prod && $insert_phone_spec){
                        $_SESSION['insertion_success'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Produkti juaj është shtuar në databaz tonë. Mbrenda 24 orësh njëri nga administratorët tonë e rishikon dhe nëse gjithçka është në rregull e aprovon atë.<br>
                        <i style='color:#F0AC1A'><b>LAJMËRIM:</b> Ne rast se produkti nuk pranohet para kohës së dhënë per dalje në ankand, ai do të dal një ditë më vone e që natyrisht përfundon një ditë më vonë se që është parashikuar!</i><br><b> JU FALEMINDERIT! </b></p>"; header("location:myauctions.php"); die();
                    }else {
                        $_SESSION['insertion_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni dhe provoni më vonë! </p>"; header("location:myauctions.php"); die();
                    }
                }
            }
            else if($_POST['auc_category'] == "Vetura"){
                $car_man = $_POST['car_man'];
                $car_mod = $_POST['car_model'];
                $car_km = $_POST['car_km'];//die(var_dump(filter_var($car_km, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_THOUSAND)));
                $car_yop = $_POST['car_year_of_production'];
                $car_type = $_POST['car_type'];
                $car_col = $_POST['car_color'];
                $car_trans = $_POST['car_transmission'];
                $car_fuels = $_POST['car_fuel'];
                $car_cub = $_POST['car_cubics'];

                //select lap maunfacturers
                $sel_cars_man = prep_stmt("SELECT prod_manufacturer FROM prod_manufacturers WHERE cat_id = ?", 5, 'i');
                $cars_manufacturers = array();
                while($row_sel_car_man = mysqli_fetch_array($sel_cars_man)){
                    $cars_manufacturers[] = $row_sel_car_man['prod_manufacturer'];
                }

                if(empty($car_man)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carManError = true;
                    $_SESSION['add_prod_errors'] += ["carManError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(array_search($car_man, $cars_manufacturers) === false){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carManError = true;
                    $_SESSION['add_prod_errors'] += ["carManError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem zgjedhni vetëm nga prodhuesit që gjenden në listë.</li>
                    </ul>"];
                }
                if(empty($car_mod)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carModError = true;
                    $_SESSION['add_prod_errors'] += ["carModError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($car_km)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carKmError = true;
                    $_SESSION['add_prod_errors'] += ["carKmError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!filter_var($car_km, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_THOUSAND)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carKmError = true;
                    $_SESSION['add_prod_errors'] += ["carKmError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni kilometrazhën e veturës vetëm përmes numrave.</li>
                    </ul>"];
                }
                if(empty($car_yop)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carYopError = true;
                    $_SESSION['add_prod_errors'] += ["carYopError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!is_numeric($car_yop)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carYopError = true;
                    $_SESSION['add_prod_errors'] += ["carYopError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni vitin e prodhimit në formatin e duhur.</li>
                    </ul>"];
                }
                if(empty($car_type)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carTypeError = true;
                    $_SESSION['add_prod_errors'] += ["carTypeError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($car_col)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carColError = true;
                    $_SESSION['add_prod_errors'] += ["carColError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!ctype_alpha($car_col) && !((strpos($car_col, 'ë')) || (strpos($car_col, 'Ë')) || (strpos($car_col, 'ç')) || (strpos($car_col, 'Ç')))){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carColError = true;
                    $_SESSION['add_prod_errors'] += ["carColError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë pranon vetëm shkronja në rangun A-ZH.</li>
                    </ul>"];
                }
                if(empty($car_trans)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carTransError = true;
                    $_SESSION['add_prod_errors'] += ["carTransError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($car_fuels)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carFuelsError = true;
                    $_SESSION['add_prod_errors'] += ["carFuelsError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($car_cub)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $carCubError = true;
                    $_SESSION['add_prod_errors'] += ["carCubError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }else if(!is_numeric($car_cub)){
                    $_SESSION['save_price'] = $auc_price;
                    $_SESSION['save_title'] = $auc_title;
                    $_SESSION['save_start'] = $auc_start;
                    $_SESSION['save_end'] = $auc_end;
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_carMan'] = $car_man;
                    $_SESSION['save_carMod'] = $car_mod;
                    $_SESSION['save_carKm'] = $car_km;
                    $_SESSION['save_carYop'] = $car_yop;
                    $_SESSION['save_carType'] = $car_type;
                    $_SESSION['save_carCol'] = $car_col;
                    $_SESSION['save_carTrans'] = $car_trans;
                    $_SESSION['save_carFuels'] = $car_fuels;
                    $_SESSION['save_carCub'] = $car_cub;
                    $carCubError = true;
                    $_SESSION['add_prod_errors'] += ["carCubError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Ju lutem shënoni kubikazhën e veturës vetëm përmes numrave.</li>
                    </ul>"];
                }

                if($titleError || $priceError || $startError || $endError || $descError || $photo1Error || $photo2Error || $photo3Error || $photo4Error || $photo5Error || $carManError || $carModError || $carKmError || $carYopError || $carTypeError || $carColError || $carTransError || $carFuelsError || $carCubError){
                    header("location:myauctions.php"); die();
                }
                else{
                    if (is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
                        $target_dir_1 = "img/products/cars/$basename_1";
                        move_uploaded_file($source_1, $target_dir_1);
                    }
                    if(is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
                        $target_dir_2 = "img/products/cars/$basename_2";
                        move_uploaded_file($source_2, $target_dir_2);
                    }
                    if (is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
                        $target_dir_3 = "img/products/cars/$basename_3";
                        move_uploaded_file($source_3, $target_dir_3);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
                        $target_dir_4 = "img/products/cars/$basename_4";
                        move_uploaded_file($source_4, $target_dir_4);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
                        $target_dir_5 = "img/products/cars/$basename_5";
                        move_uploaded_file($source_5, $target_dir_5);
                    } 
                    $photo_1_base = $basename_1; $photo_2_base = "|" . $basename_2; $photo_3_base = "|" . $basename_3; $photo_4_base = "|" . $basename_4; $photo_5_base = "|" . $basename_5;

                    $prod_img = "";
                    if(empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base;
                    }elseif(!empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base;
                    }elseif(empty($basename_4) && !empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_5_base;
                    }else { $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base . $photo_5_base;
                    }

                    //INSERT PRODUKTIN
                    $insert_car_prod = prep_stmt("INSERT INTO products(prod_unique_id, prod_img, prod_title, prod_price, prod_from, prod_to, prod_description,cat_id,user_id,prod_isApproved) VALUES(?,?,?,?,?,?,?,?,?,?)", array($unique_id,$prod_img,$auc_title, $auc_price, $start_time, $end_time,$auc_desc,$selected_cat_id,user_id(),$isApproved), "sssssssiii");
                    //INSERT SPECIFIKAT E PRODUKTIT
                    $insert_car_spec = prep_stmt("INSERT INTO prod_specifications(car_man, car_mod,car_km, car_py, car_type, car_col, car_tra, car_fu, car_cub, prod_unique_id) VALUES(?,?,?,?,?,?,?,?,?,?)", array($car_man, $car_mod, $car_km, $car_yop, $car_type, $car_col, $car_trans, $car_fuels, $car_cub,$unique_id), "ssssssssss");

                    if($insert_car_prod && $insert_car_spec){
                        $_SESSION['insertion_success'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Produkti juaj është shtuar në databaz tonë. Mbrenda 24 orësh njëri nga administratorët tonë e rishikon dhe nëse gjithçka është në rregull e aprovon atë.<br>
                        <i style='color:#F0AC1A'><b>LAJMËRIM:</b> Ne rast se produkti nuk pranohet para kohës së dhënë per dalje në ankand, ai do të dal një ditë më vone e që natyrisht përfundon një ditë më vonë se që është parashikuar!</i><br><b> JU FALEMINDERIT! </b></p>"; header("location:myauctions.php"); die();
                    }else {
                        $_SESSION['insertion_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni dhe provoni më vonë! </p>"; header("location:myauctions.php"); die();
                    }
                }
            }
            else if($_POST['auc_category'] == "Template"){
                $ZIP_ERROR = [
                    ZipArchive::ER_EXISTS => 'File already exists.',
                    ZipArchive::ER_INCONS => 'Zip archive inconsistent.',
                    ZipArchive::ER_INVAL => 'Invalid argument.',
                    ZipArchive::ER_MEMORY => 'Malloc failure.',
                    ZipArchive::ER_NOENT => 'No such file.',
                    ZipArchive::ER_NOZIP => 'Not a zip archive.',
                    ZipArchive::ER_OPEN => "Can't open file.",
                    ZipArchive::ER_READ => 'Read error.',
                    ZipArchive::ER_SEEK => 'Seek error.',
                  ];
                function openZip($file_to_open) {
                    $target = dirname(__FILE__) . "/templates/";
                    $zip = new ZipArchive();
                    $x = $zip->open($file_to_open);
                    if($x === true) {   
                        $zip->extractTo($target);
                        $zip->close();
                    } else {
                    $msg = isset($ZIP_ERROR[$zip])? $ZIP_ERROR[$zip] : 'Unknown error.';
                    return ['error'=>$msg];
                        die("Dicka shkoi gabim");
                    }
                }
                
                $temp_cat = $_POST['template_category'];
                $temp_ut = $_POST['template_used_tech'];
                $temp_layout = $_POST['template_layout'];
                $temp_doc = $_POST['template_documented'];

                if(empty($temp_cat)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_tempUt'] = $temp_ut;
                    $_SESSION['save_tempLayout'] = $temp_layout;
                    $_SESSION['save_tempDoc'] = $temp_doc;
                    $tempCatError = true;
                    $_SESSION['add_prod_errors'] += ["tempCatError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($temp_ut)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_tempCat'] = $temp_cat;
                    $_SESSION['save_tempLayout'] = $temp_layout;
                    $_SESSION['save_tempDoc'] = $temp_doc;
                    $tempUtError = true;
                    $_SESSION['add_prod_errors'] += ["tempUtError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($temp_layout)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_tempCat'] = $temp_cat;
                    $_SESSION['save_tempUt'] = $temp_ut;
                    $_SESSION['save_tempDoc'] = $temp_doc;
                    $tempLayoutError = true;
                    $_SESSION['add_prod_errors'] += ["tempLayoutError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(empty($temp_doc)){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_tempCat'] = $temp_cat;
                    $_SESSION['save_tempUt'] = $temp_ut;
                    $_SESSION['save_tempLayout'] = $temp_layout;
                    $tempDocError = true;
                    $_SESSION['add_prod_errors'] += ["tempDocError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }
                if(!is_uploaded_file($_FILES['template_zip']['tmp_name'])){
                    $_SESSION['save_price'] = $auc_price; 
                    $_SESSION['save_title'] = $auc_title; 
                    $_SESSION['save_end'] = $auc_end; 
                    $_SESSION['save_desc'] = $auc_desc;
                    $_SESSION['save_tempCat'] = $temp_cat;
                    $_SESSION['save_tempUt'] = $temp_ut;
                    $_SESSION['save_tempLayout'] = $temp_layout;
                    $_SESSION['save_tempDoc'] = $temp_doc;
                    $tempZipError = true;
                    $_SESSION['add_prod_errors'] += ["tempZipError"=>"<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                    <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Kjo fushë nuk mund jetë e zbrazet.</li>
                    </ul>"];
                }

                $temp_name = $_FILES['template_zip']['name'];
                if(is_uploaded_file($_FILES['template_zip']['tmp_name'])) {
                    $template_zip = $_FILES['template_zip'];
                    $picname = "template_" . $unique_id; //emri i produktit: lea_1 pshdie
                    $imageFileType = strtolower(pathinfo($template_zip["name"], PATHINFO_EXTENSION));
                    //die(var_dump($imageFileType));
                    $basename_temp = $picname . "." . $imageFileType;
                    $check = filesize($template_zip["tmp_name"]); 
        
                    if ($check == false) {
                        $_SESSION['save_price'] = $auc_price; 
                        $_SESSION['save_title'] = $auc_title; 
                        $_SESSION['save_end'] = $auc_end; 
                        $_SESSION['save_desc'] = $auc_desc;
                        $_SESSION['save_tempCat'] = $temp_cat;
                        $_SESSION['save_tempUt'] = $temp_ut;
                        $_SESSION['save_tempLayout'] = $temp_layout;
                        $_SESSION['save_tempDoc'] = $temp_doc;
                        $tempZipError = true;
                        $_SESSION['add_prod_errors'] += ['tempZipError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                        <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Template nuk është ngarkuar në formatin e duhur.</li>
                        </ul>"];
                    }
                    if ($template_zip['size'] > 300000000) {
                        $_SESSION['save_price'] = $auc_price; 
                        $_SESSION['save_title'] = $auc_title; 
                        $_SESSION['save_end'] = $auc_end; 
                        $_SESSION['save_desc'] = $auc_desc;
                        $_SESSION['save_tempCat'] = $temp_cat;
                        $_SESSION['save_tempUt'] = $temp_ut;
                        $_SESSION['save_tempLayout'] = $temp_layout;
                        $_SESSION['save_tempDoc'] = $temp_doc;
                        $tempZipError = true;
                        $_SESSION['add_prod_errors'] += ['tempZipError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                        <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Template është më e madhe se limiti i lejuar.</li>
                        </ul>"];
                    }
                    if ($imageFileType != "zip") {
                        
                        $_SESSION['save_price'] = $auc_price; 
                        $_SESSION['save_title'] = $auc_title; 
                        $_SESSION['save_end'] = $auc_end; 
                        $_SESSION['save_desc'] = $auc_desc;
                        $_SESSION['save_tempCat'] = $temp_cat;
                        $_SESSION['save_tempUt'] = $temp_ut;
                        $_SESSION['save_tempLayout'] = $temp_layout;
                        $_SESSION['save_tempDoc'] = $temp_doc;
                        $tempZipError = true;
                        $_SESSION['add_prod_errors'] += ['tempZipError' => "<ul class='parsley-errors-list filled' id='parsley-id-5' style=' margin: 0; text-align: left; color: #de4848; list-style-type: none;'>
                        <li class='parsley-required' style=' float: left; text-align: left; margin: 0 0px 5px -40px; '>Template duhet të jetë vetëm në formatin ZIP.</li>
                        </ul>"];
                    }
                    $source_temp = $template_zip["tmp_name"];
                }

                if($titleError || $priceError || $startError || $endError || $descError || $photo1Error || $photo2Error || $photo3Error || $photo4Error || $photo5Error || $tempCatError || $tempUtError || $tempLayoutError || $tempDocError || $tempZipError){
                    header("location:myauctions.php"); die();
                }else{
                    if(is_uploaded_file($_FILES['template_zip']['tmp_name'])) {
                        $target_dir_temp = "img/products/templates/$basename_temp";
                        if(move_uploaded_file($source_temp, $target_dir_temp) === true){
                            $trg = dirname(__FILE__) . "/img/products/templates/template_" . $unique_id.".zip"; 
                            $r = openZip($trg); 
                        }else{
                            $_SESSION['insertion_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim në ngarkimin e fajllit, ju lutem kthehuni dhe provoni më vonë! </p>"; 
                            header("location:myauctions.php"); die();
                        }
                    }
                    //get the name of the folder and the basename -> e 1-ra per preview e 2-ta per download
                    $imgt = explode(".", $temp_name);
                    $img_temp = $imgt[0] . "|" . $basename_temp;

                    if (is_uploaded_file($_FILES['auc_photo1']['tmp_name'])) {
                        $target_dir_1 = "img/products/templates/$basename_1";
                        move_uploaded_file($source_1, $target_dir_1);
                    }
                    if(is_uploaded_file($_FILES['auc_photo2']['tmp_name'])) {
                        $target_dir_2 = "img/products/templates/$basename_2";
                        move_uploaded_file($source_2, $target_dir_2);
                    }
                    if (is_uploaded_file($_FILES['auc_photo3']['tmp_name'])) {
                        $target_dir_3 = "img/products/templates/$basename_3";
                        move_uploaded_file($source_3, $target_dir_3);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo4']['tmp_name'])) {
                        $target_dir_4 = "img/products/templates/$basename_4";
                        move_uploaded_file($source_4, $target_dir_4);
                    } 
                    if (is_uploaded_file($_FILES['auc_photo5']['tmp_name'])) {
                        $target_dir_5 = "img/products/templates/$basename_5";
                        move_uploaded_file($source_5, $target_dir_5);
                    } 
                    $photo_1_base = $basename_1; $photo_2_base = "|" . $basename_2; $photo_3_base = "|" . $basename_3; $photo_4_base = "|" . $basename_4; $photo_5_base = "|" . $basename_5;

                    $prod_img = "";
                    if(empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base;
                    }elseif(!empty($basename_4) && empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base;
                    }elseif(empty($basename_4) && !empty($basename_5)){
                        $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_5_base;
                    }else { $prod_img = $photo_1_base . $photo_2_base . $photo_3_base . $photo_4_base . $photo_5_base;
                    }

                    //INSERT PRODUKTIN
                    $insert_temp_prod = prep_stmt("INSERT INTO products(prod_unique_id, prod_img, prod_title, prod_price, prod_from, prod_to, prod_description,cat_id,user_id,prod_isApproved) VALUES(?,?,?,?,?,?,?,?,?,?)", array($unique_id,$prod_img,$auc_title, $auc_price, $start_time, $end_time,$auc_desc,$selected_cat_id,user_id(),$isApproved), "sssssssiii");

                    $insert_temp_spec = prep_stmt("INSERT INTO prod_specifications(wt_template,wt_cat,wt_ut,wt_lo,wt_doc,prod_unique_id) VALUES(?,?,?,?,?,?)", array($img_temp,$temp_cat, $temp_ut, $temp_layout, $temp_doc, $unique_id), "ssssss");

                    if($insert_temp_prod && $insert_temp_spec){
                        $_SESSION['insertion_success'] = "<h4 style='color:#60CA0D; font-weight:bold; text-align:center;'> SUKSES! </h4><p style='color:#60CA0D;'> Produkti juaj është shtuar në databaz tonë. Mbrenda 24 orësh njëri nga administratorët tonë e rishikon dhe nëse gjithçka është në rregull e aprovon atë.<br>
                        <i style='color:#F0AC1A'><b>LAJMËRIM:</b> Ne rast se produkti nuk pranohet para kohës së dhënë per dalje në ankand, ai do të dal një ditë më vone e që natyrisht përfundon një ditë më vonë se që është parashikuar!</i><br><b> JU FALEMINDERIT! </b></p>"; header("location:myauctions.php"); die();
                    }else {
                        $_SESSION['insertion_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni dhe provoni më vonë! </p>"; header("location:myauctions.php"); die();
                    }
                }
            }
        }else{
            $_SESSION['insertion_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D; font-weight:600;'> Ju lutem zgjedhni vetëm nga kategoritë që janë në listë! </p>"; header("location:myauctions.php"); die();
        }

    }

?>
<?php require 'header.php'; ?>
<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">DealAIM</a></li>
                    <li><a href="#">Shto një produkt</a></li>
                    <li>Faqja aktive</li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center" style="background:#fff; box-shadow:0px 0px 10px 0px rgb(0 0 0 / 10%);">
            <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                <div class="box_account">
                    <div class="form_container" style="box-shadow:none;">
                        <div class="private box" >
                            <center>
                                <div class="divider">
                                    <span style="background-color:#fff">Vendose produktin tënd në ankand</span>
                                </div>
                                <?php
                                if(isset($_SESSION['insertion_success'])){
                                    echo "<div class='sukses'>";
                                    echo $_SESSION['insertion_success'];
                                    echo "</div>";
                                }else if(isset($_SESSION['insertion_error'])){
                                    echo "<div class='gabim'>";
                                    echo $_SESSION['insertion_error'];
                                    echo "</div>";
                                }
                                if(isset($_SESSION['add_prod_errors'])){
                                    if(array_key_exists("titleError", $_SESSION['add_prod_errors']) || array_key_exists("priceError", $_SESSION['add_prod_errors']) || array_key_exists("startError", $_SESSION['add_prod_errors']) || array_key_exists("endError", $_SESSION['add_prod_errors']) || array_key_exists("descError", $_SESSION['add_prod_errors']) || array_key_exists("photo1Error", $_SESSION['add_prod_errors']) || array_key_exists("photo2Error", $_SESSION['add_prod_errors']) || array_key_exists("photo3Error", $_SESSION['add_prod_errors'])){
                                        echo "<div class='gabim'>";
                                        echo "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;font-weight:600;'> Fushat me të kuqe janë të zbrazëta ose nuk janë të shënuara në formatin e duhur. Ju lutem mbushini fushat sipas kërkesave! </p>";
                                        echo "</div>";
                                    }else if(array_key_exists("lapManError", $_SESSION['add_prod_errors']) || array_key_exists("lapConError", $_SESSION['add_prod_errors']) || array_key_exists("lapModError", $_SESSION['add_prod_errors']) || array_key_exists("lapDisError", $_SESSION['add_prod_errors']) || array_key_exists("lapColError", $_SESSION['add_prod_errors']) || array_key_exists("lapProcError", $_SESSION['add_prod_errors']) ||array_key_exists("lapProcError", $_SESSION['add_prod_errors']) || array_key_exists("lapRamError", $_SESSION['add_prod_errors']) || array_key_exists("lapIntMemError", $_SESSION['add_prod_errors']) || array_key_exists("lapIntMemSpaceError", $_SESSION['add_prod_errors']) || array_key_exists("lapGrapError", $_SESSION['add_prod_errors'])){
                                        echo "<div class='gabim'>";
                                        echo "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;font-weight:600;'> Fushat me të kuqe janë të zbrazëta ose nuk janë të shënuara në formatin e duhur. Ju lutem mbushini fushat sipas kërkesave! </p>";
                                        echo "</div>";
                                    }else if(array_key_exists("phoneManError", $_SESSION['add_prod_errors']) || array_key_exists("phoneConError", $_SESSION['add_prod_errors']) || array_key_exists("phoneModError", $_SESSION['add_prod_errors']) || array_key_exists("phoneColError", $_SESSION['add_prod_errors']) || array_key_exists("phoneOsError", $_SESSION['add_prod_errors']) ||array_key_exists("phoneRamError", $_SESSION['add_prod_errors']) || array_key_exists("lapRamError", $_SESSION['add_prod_errors']) || array_key_exists("phoneIntMemSpaceError", $_SESSION['add_prod_errors']) || array_key_exists("phoneSimError", $_SESSION['add_prod_errors']) || array_key_exists("phoneOriginError", $_SESSION['add_prod_errors'])){
                                        echo "<div class='gabim'>";
                                        echo "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;font-weight:600;'> Fushat me të kuqe janë të zbrazëta ose nuk janë të shënuara në formatin e duhur. Ju lutem mbushini fushat sipas kërkesave! </p>";
                                        echo "</div>";
                                    }else if(array_key_exists("carManError", $_SESSION['add_prod_errors']) || array_key_exists("carModError", $_SESSION['add_prod_errors']) || array_key_exists("carKmError", $_SESSION['add_prod_errors']) || array_key_exists("carYopError", $_SESSION['add_prod_errors']) || array_key_exists("carTypeError", $_SESSION['add_prod_errors']) ||array_key_exists("carColError", $_SESSION['add_prod_errors']) || array_key_exists("carTransError", $_SESSION['add_prod_errors']) || array_key_exists("carFuelsError", $_SESSION['add_prod_errors']) || array_key_exists("carCubError", $_SESSION['add_prod_errors'])){
                                        echo "<div class='gabim'>";
                                        echo "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;font-weight:600;'> Fushat me të kuqe janë të zbrazëta ose nuk janë të shënuara në formatin e duhur. Ju lutem mbushini fushat sipas kërkesave! </p>";
                                        echo "</div>";
                                    }else if(array_key_exists("tempCatError", $_SESSION['add_prod_errors']) || array_key_exists("tempUtError", $_SESSION['add_prod_errors']) || array_key_exists("tempLayoutError", $_SESSION['add_prod_errors']) || array_key_exists("tempDocError", $_SESSION['add_prod_errors']) || array_key_exists("tempZipError", $_SESSION['add_prod_errors'])){
                                        echo "<div class='gabim'>";
                                        echo "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;font-weight:600;'> Fushat me të kuqe janë të zbrazëta ose nuk janë të shënuara në formatin e duhur. Ju lutem mbushini fushat sipas kërkesave! </p>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                                <?php 
                                unset($_SESSION['insertion_success']);
                                unset($_SESSION['insertion_error']); 
                                ?>
                                <div class="row no-gutters">
                                    <form  method="post" action="" enctype="multipart/form-data">
                                        <h3 style="text-decoration:underline;"> Të dhënat e produktit </h3>
                                        <div class="divider" style="background-color:#fff;"><span>(<b style="color:darkorange;">VËREJTJE:</b> Fushat me <b style="color:red">*</b> duhet mbushur detyrimisht!)</span></div>
                                        <div class="form-group row">
                                            <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                <label for="" class="float-right"  >Kategoria <b style='color:red'>*</b>:</label> 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
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
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Titulli ankandit <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" class="form-control" name="auc_title" placeholder="Titulli ankandit" style="<?php if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("titleError", $_SESSION['add_prod_errors'])){
                                                            echo "border-color:red";
                                                        }
                                                    }?>" value="<?php if(isset($_SESSION['save_title'])){echo $_SESSION['save_title'];} unset($_SESSION['save_title']); ?>" >
                                                    
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("titleError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['titleError'];
                                                        }
                                                    }?>
                                                </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                <label for="" class="float-right" style="margin-top:.5em;">Cmimi fillestar <b style='color:red'>*</b>:</label> 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                <input type="text" class="form-control float-left" name="auc_price" placeholder="Çmimi fllestar" style="width:40%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("priceError", $_SESSION['add_prod_errors'])){ echo "border-color:red;";}} ?>"  value="<?php if(isset($_SESSION['save_price'])){echo $_SESSION['save_price'];} unset($_SESSION['save_price']); ?>">
                                                <div class="input-group-prepend" style="padding:0 !important;">
                                                    <div class="input-group-text" style="padding: .375rem .475rem">€</div>
                                                </div>
                                                <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("priceError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['priceError'];
                                                        }
                                                    }?>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                <label for="" class="float-right"  >Ankandi fillon nga <b style='color:red'>*</b>:</label> 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                <input type="text" name="auc_start" class="form-control datepicker-2" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("startError", $_SESSION['add_prod_errors'])){ echo "border-color:red;";}} ?>" value="<?php if(isset($_SESSION['save_start'])){echo $_SESSION['save_start'];}else{ echo date("d-m-Y",strtotime("+1day"));} unset($_SESSION['save_start']); ?>">
                                                <?php 
                                                if(isset($_SESSION['add_prod_errors'])){
                                                    if(array_key_exists("startError", $_SESSION['add_prod_errors'])){
                                                        echo $_SESSION['add_prod_errors']['startError'];
                                                    }
                                                }?>
                                            </div>
                                            <p id="demooo"></p>
                                            <div class="divider"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                <label class="float-right"  >Sa ditë dëshironi që produkti juaj të qëndroj në ankand <b style='color:red'>*</b>: </label> 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                <select class="form-control" name="auc_end" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("endError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" value="<?php if(isset($_SESSION['save_end'])){echo $_SESSION['save_end'];} ?>">
                                                    <option value=""> Zgjidh  sa ditë dëshiron të qëndroj në ankand produkti juaj... </option>
                                                    <option value="1" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 1){ echo "selected";  }  ?>> 1 </option>
                                                    <option value="2" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 2){ echo "selected"; }  ?>> 2 </option>
                                                    <option value="3" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 3){ echo "selected";  }  ?>> 3 </option>
                                                    <option value="4" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 4){ echo "selected"; }  ?>> 4 </option>
                                                    <option value="5" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 5){ echo "selected"; }  ?>> 5 </option>
                                                    <option value="6" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 6){ echo "selected"; }  ?>> 6 </option>
                                                    <option value="7" <?php if(isset($_SESSION['save_end']) && $_SESSION['save_end'] == 7){ echo "selected";}  ?>> 7 </option>
                                                </select>
                                                <?php 
                                                if(isset($_SESSION['add_prod_errors'])){
                                                    if(array_key_exists("endError", $_SESSION['add_prod_errors'])){
                                                        echo $_SESSION['add_prod_errors']['endError'];
                                                    }
                                                }?>
                                                <?php  unset($_SESSION['save_end']);  ?>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                <label class="float-right"  >Përshkrimi <b style='color:red'>*</b>:</label> 
                                            </div>
                                            <div class="col-6" style="padding-bottom:5px;">
                                                <textarea rows="4" id="auc_description" name="auc_description" class="form-control" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("descError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" ><?php if(isset($_SESSION['save_desc'])){ echo $_SESSION['save_desc']; } unset($_SESSION['save_desc']);?></textarea>
                                                <?php 
                                                if(isset($_SESSION['add_prod_errors'])){
                                                    if(array_key_exists("descError", $_SESSION['add_prod_errors'])){
                                                        echo $_SESSION['add_prod_errors']['descError'];
                                                    }
                                                }?>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-bottom:5px;">
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label float-left">
                                                    <label for="" class="float-right" >Foto 1 (.jpg, .png) <b style='color:red'>*</b>: </label> 
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-7 col-7 float-right">
                                                    <input type="file" name="auc_photo1" class="form-control float-left" style="width:76%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo1Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("photo1Error", $_SESSION['add_prod_errors'])){
                                                            echo "<br/><br/>";
                                                            echo $_SESSION['add_prod_errors']['photo1Error'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-bottom:5px;">
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label float-left">
                                                    <label for="" class="float-right"  >Foto 2 (.jpg, .png) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-7 col-7 float-right">
                                                    <input type="file" name="auc_photo2" class="form-control float-left"  style="width:76%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo2Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("photo2Error", $_SESSION['add_prod_errors'])){
                                                            echo "<br/><br/>";
                                                            echo $_SESSION['add_prod_errors']['photo2Error'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-bottom:5px;">
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label float-left">
                                                    <label for="" class="float-right">Foto 3 (.jpg, .png) <b style='color:red'>*</b>: </label> 
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-7 col-7 float-right">
                                                    <input type="file"  name="auc_photo3"  class="form-control float-left" style="width:76%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo3Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("photo3Error", $_SESSION['add_prod_errors'])){
                                                            echo "<br/><br/>";
                                                            echo $_SESSION['add_prod_errors']['photo3Error'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-bottom:5px;">
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label float-left">
                                                    <label for=""  class="float-right">Foto 4 (.jpg, .png): &nbsp;</label> 
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-7 col-7 float-right">
                                                    <input type="file" name="auc_photo4" class="form-control float-left" style="width:76%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo4Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("photo4Error", $_SESSION['add_prod_errors'])){
                                                            echo "<br/><br/>";
                                                            echo $_SESSION['add_prod_errors']['photo4Error'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-bottom:5px;">
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label float-left">
                                                    <label for="" class="float-right"  > Foto 5 (.jpg, .png): &nbsp; </label> 
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-7 col-7 float-right">
                                                    <input type="file" name="auc_photo5"  class="form-control float-left" style="width:76%; <?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photo5Error", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("photo5Error", $_SESSION['add_prod_errors'])){
                                                            echo "<br/><br/>";
                                                            echo $_SESSION['add_prod_errors']['photo5Error'];
                                                        }
                                                    }?>
                                                </div> 
                                            </div>
                                        </div>
                                        <?php unset($_SESSION['add_prod_errors']['titleError']);unset($_SESSION['add_prod_errors']['priceError']);unset($_SESSION['add_prod_errors']['startError']); unset($_SESSION['add_prod_errors']['endError']);unset($_SESSION['add_prod_errors']['descError']);unset($_SESSION['add_prod_errors']['photo1Error']);unset($_SESSION['add_prod_errors']['photo2Error']);unset($_SESSION['add_prod_errors']['photo3Error']);unset($_SESSION['add_prod_errors']['photo4Error']);unset($_SESSION['add_prod_errors']['photo5Error']);?>
                                        <!--- SPECIIFIKAT -->
                                        <h3 style="text-decoration:underline;" id="spec_h3" > Specifikat </h3>
                                        <!--- SPECIIFIKAT e laptopit-->
                                        <div id="spec_laptop" >
                                            <div class="form-group row" >
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Prodhuesi <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" id="lap_manufacturer" name="lap_manufacturer" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapManError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } } ?>" <?php if(isset($_SESSION['save_lapMan'])){ echo "value='".$_SESSION['save_lapMan']."'"; } ?>>
                                                        <?php 
                                                        $sel_man_lap = prep_stmt("SELECT * FROM prod_manufacturers WHERE cat_id = ? ORDER BY prod_manufacturer ASC", 2, 'i');
                                                        echo "<option value=''> Zgjedh prodhuesin </option>";
                                                        while($row_man_lap = mysqli_fetch_array($sel_man_lap)){
                                                            echo "<option value='".$row_man_lap['prod_manufacturer']."'>".$row_man_lap['prod_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapManError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapManError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right">Modeli <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_model" id="lap_model" class="form-control"   placeholder="Modeli laptopit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapModError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>" <?php if(isset($_SESSION['save_lapMod'])){ echo "value='".$_SESSION['save_lapMod']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapModError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapModError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Gjendja <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="lap_condition"   placeholder="Gjendja e laptopit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapConError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>">
                                                    <option value=""> Gjendja laptopit </option>
                                                    <option value="I ri" <?php if(isset($_SESSION['save_lapCon']) && $_SESSION['save_lapCon'] == "I ri"){ echo "selected";} ?>> I ri </option>
                                                    <option value="I përdorur" <?php if(isset($_SESSION['save_lapCon']) && $_SESSION['save_lapCon'] == "I përdorur"){ echo "selected";} ?>> I përdorur </option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapConError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapConError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Diagonalja ekranit (inch) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_display" class="form-control"   placeholder="Diagonalja ekranit (e shprehur me inch).." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapDisError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>" <?php if(isset($_SESSION['save_lapDis'])){ echo "value='".$_SESSION['save_lapDis']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapDisError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapDisError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Ngjyra <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_color" class="form-control"   placeholder="Ngjyra.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapColError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapCol'])){ echo "value='".$_SESSION['save_lapCol']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapColError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapColError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label class="float-right"  >Procesori <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_procesor" class="form-control"   placeholder="Procesori.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapProcError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapProc'])){ echo "value='".$_SESSION['save_lapProc']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapProcError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapProcError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Memorja RAM (GB) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_ram" class="form-control"   placeholder="Hapsira e RAM memorjes (e shprehur në GB)..." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapRamError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapRam'])){ echo "value='".$_SESSION['save_lapRam']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapRamError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapRamError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Memorja e mbrendshme <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="lap_internal_memory"  style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapIntMemError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>">
                                                    <option value=""> Memorja e mbrendshme.. </option>
                                                    <option value="HDD" <?php if(isset($_SESSION['save_lapIntMem']) && $_SESSION['save_lapIntMem'] == "HDD"){ echo "selected";} ?>> HDD </option>
                                                    <option value="SSD" <?php if(isset($_SESSION['save_lapIntMem']) && $_SESSION['save_lapIntMem'] == "SSD"){ echo "selected";} ?>> SSD </option>
                                                    <option value="Hybrid" <?php if(isset($_SESSION['save_lapIntMem']) && $_SESSION['save_lapIntMem'] == "Hybrid"){ echo "selected";} ?>> Hybrid </option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapIntMemError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapIntMemError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Hapsira e memorjes se mbrendshme (GB) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_internal_memory_space" class="form-control"   placeholder="Hapsira e memorjes së mbrendshme..." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapIntMemSpaceError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>"  <?php if(isset($_SESSION['save_lapIntMemSpace'])){ echo "value='".$_SESSION['save_lapIntMemSpace']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapIntMemSpaceError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapIntMemSpaceError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Kartela Grafike <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="lap_graphic_card" class="form-control"   placeholder="Kartela Grafike.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("lapGrapError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red";}} ?>" <?php if(isset($_SESSION['save_lapGrap'])){ echo "value='".$_SESSION['save_lapGrap']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("lapGrapError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['lapGrapError'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION['add_prod_errors']['lapManError']);unset($_SESSION['add_prod_errors']['lapModError']);unset($_SESSION['add_prod_errors']['lapConError']); unset($_SESSION['add_prod_errors']['lapDisError']);unset($_SESSION['add_prod_errors']['lapColError']);unset($_SESSION['add_prod_errors']['lapProcError']);unset($_SESSION['add_prod_errors']['lapRamError']);unset($_SESSION['add_prod_errors']['lapIntMemError']);unset($_SESSION['add_prod_errors']['lapIntMemSpaceError']); unset($_SESSION['add_prod_errors']['lapGrapError']);?>
                                            <?php unset($_SESSION['save_lapMod']);unset($_SESSION['save_lapCon']); unset($_SESSION['save_lapDis']); unset($_SESSION['save_lapCol']); unset($_SESSION['save_lapProc']); unset($_SESSION['save_lapRam']);unset($_SESSION['save_lapIntMem']);unset($_SESSION['save_lapIntMemSpace']); unset($_SESSION['save_lapGrap']); ?>
                                        </div>
                                        <!--- SPECIIFIKAT e telefonit-->
                                        <div id="spec_phone" >
                                            <div class="form-group row" >
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Prodhuesi <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="phone_manufacturer"   placeholder="Zgjedh prodhuesin" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneManError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <?php 
                                                        $sel_man_lap = prep_stmt("SELECT * FROM prod_manufacturers WHERE cat_id = ? ORDER BY prod_manufacturer ASC", 3, 'i');
                                                        echo "<option value=''> Zgjedh prodhuesin </option>";
                                                        while($row_man_lap = mysqli_fetch_array($sel_man_lap)){
                                                            echo "<option value='".$row_man_lap['prod_manufacturer']."'>".$row_man_lap['prod_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneManError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneManError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Modeli <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="phone_model" class="form-control"   placeholder="Modeli telefonit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneModError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_phoneMod'])){echo "value='".$_SESSION['save_phoneMod']."'";} ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneModError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneModError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Gjendja <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="phone_condition"   placeholder="Gjendja e laptopit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneConError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                    <option value=""> Gjendja telefonit </option>
                                                    <option value="I ri" <?php if(isset($_SESSION['save_phoneCon'])){ if($_SESSION['save_phoneCon'] == "I ri"){echo "selected";}} ?>> I ri </option>
                                                    <option value="I përdorur"  <?php if(isset($_SESSION['save_phoneCon'])){ if($_SESSION['save_phoneCon'] == "I përdorur"){echo "selected";}} ?>> I përdorur </option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneConError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneConError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Ngjyra <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="phone_color" class="form-control"   placeholder="Ngjyra"  style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneColError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_phoneCol'])){echo "value='".$_SESSION['save_phoneCol']."'";} ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneColError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneColError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Sistemi operativ <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="phone_operating_system"   placeholder="Lloji i memorjes së mbrendshme.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneOsError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                    <option value=""> Sistemi operativ.. </option>
                                                    <option value="IOS" <?php if(isset($_SESSION['save_phoneOs'])){ if($_SESSION['save_phoneOs'] == "IOS"){echo "selected";}} ?>> IOS </option>
                                                    <option value="Android" <?php if(isset($_SESSION['save_phoneOs'])){ if($_SESSION['save_phoneOs'] == "Android"){echo "selected";}} ?>> Android </option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneOsError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneOsError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Memorja RAM (GB) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="phone_ram" class="form-control"   placeholder="Memorja RAM (e shprehur ne GB).." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneRamError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_phoneRam'])){echo "value='".$_SESSION['save_phoneRam']."'";} ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneRamError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneRamError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Memorja e mbrendshme (GB) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="phone_internal_memory_space" class="form-control"   placeholder="Hapsira e memorjes së mbrendshme (e shprehur me GB):.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneIntMemSpaceError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>"  <?php if(isset($_SESSION['save_phoneIntMemSpace'])){echo "value='".$_SESSION['save_phoneIntMemSpace']."'";} ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneIntMemSpaceError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneIntMemSpaceError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label class="float-right"  >Numri i SIM kartelave <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="phone_sim"   placeholder="Lloji i memorjes së mbrendshme.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneSimError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <option value=""> Numri i SIM kartelave... </option>
                                                        <option value="1" <?php if(isset($_SESSION['save_phoneSim'])){ if($_SESSION['save_phoneSim'] == "1"){echo "selected";}} ?>> 1 </option>
                                                        <option value="2" <?php if(isset($_SESSION['save_phoneSim'])){ if($_SESSION['save_phoneSim'] == "2"){echo "selected";}} ?>> 2 </option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneSimError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneSimError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label class="float-right"  >Vendi i prodhimit <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="phone_origin_of_production" class="form-control"   placeholder="Vendi i prodhimit" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("phoneOriginError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>"<?php if(isset($_SESSION['save_phoneOrigin'])){echo "value='".$_SESSION['save_phoneOrigin']."'";} ?> >
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("phoneOriginError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['phoneOriginError'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION['add_prod_errors']['phoneManError']);unset($_SESSION['add_prod_errors']['phoneModError']);unset($_SESSION['add_prod_errors']['phoneConError']);unset($_SESSION['add_prod_errors']['phoneColError']);unset($_SESSION['add_prod_errors']['phoneOsError']);unset($_SESSION['add_prod_errors']['phoneRamError']);unset($_SESSION['add_prod_errors']['phoneIntMemSpaceError']);unset($_SESSION['add_prod_errors']['phoneSimError']);unset($_SESSION['add_prod_errors']['phoneOriginError']);?>
                                            <?php unset($_SESSION['save_phoneMod']);unset($_SESSION['save_phoneCon']);unset($_SESSION['save_phoneCol']);unset($_SESSION['save_phoneOs']);unset($_SESSION['save_phoneRam']);unset($_SESSION['save_phoneIntMemSpace']);unset($_SESSION['save_phoneSim']);unset($_SESSION['save_phoneOrigin']); ?>
                                        </div>
                                        <!--- SPECIIFIKAT e veturave-->
                                        <div id="spec_cars" >
                                            <div class="form-group row" >
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="inputEmail3" class="float-right"  >Prodhuesi <b style='color:red'>*</b>: </label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="car_man"   placeholder="Zgjedh prodhuesin" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carManError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <?php 
                                                        $sel_man_lap = prep_stmt("SELECT * FROM prod_manufacturers WHERE cat_id = ? ORDER BY prod_manufacturer ASC", 5, 'i');
                                                        echo "<option value=''> Zgjedh prodhuesin </option>";
                                                        while($row_man_lap = mysqli_fetch_array($sel_man_lap)){
                                                            echo "<option value='".$row_man_lap['prod_manufacturer']."'>".$row_man_lap['prod_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carManError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carManError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right" >Modeli <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="car_model" class="form-control"   placeholder="Modeli veturës.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carModError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_carMod'])){ echo "value='".$_SESSION['save_carMod']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carModError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carModError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right">Kilometrazha (e shprehur me KM) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="car_km" class="form-control"   placeholder="Kilometrat e kaluara.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carKmError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_carKm'])){ echo "value='".$_SESSION['save_carKm']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carKmError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carKmError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Viti prodhimit <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="car_year_of_production" class="form-control"   placeholder="Viti i prodhimit.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carYopError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_carYop'])){ echo "value='".$_SESSION['save_carYop']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carYopError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carYopError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Tipi i veturës <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="car_type" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carTypeError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <option value=""> Tipi i veturës... </option>
                                                        <option value="Veturë e vogël" <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Veturë e vogël (2 ulëse)"){ echo "selected"; } } ?>> Veturë e vogël (2 ulëse) </option>
                                                        <option value="Sedan" <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Sedan"){ echo "selected"; } } ?>> Sedan</option>
                                                        <option value="Kupe" <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Kupe"){ echo "selected"; } } ?>> Kupe</option>
                                                        <option value="Hatchback" <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Hatchback"){ echo "selected"; } } ?>> Hatchback</option>
                                                        <option value="Universal"  <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Universal"){ echo "selected"; } } ?>> Universal</option>
                                                        <option value="Kabriolet"  <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Kabriolet"){ echo "selected"; } } ?>> Kabriolet</option>
                                                        <option value="Kabriolet" <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "SUV"){ echo "selected"; } } ?>> SUV</option>
                                                        <option value="Kabriolet" <?php if(isset($_SESSION['save_carType'])){ if($_SESSION['save_carType'] == "Minivan"){ echo "selected"; } } ?>> Minivan</option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carTypeError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carTypeError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Ngjyra veturës <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="car_color" class="form-control"   placeholder="Ngjyra veturës.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carColError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_carCol'])){ echo "value='".$_SESSION['save_carCol']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carColError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carColError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Transmisioneri <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="car_transmission"  style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carTransError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <option value=""> Transmisioneri.. </option>
                                                        <option value="Manual" <?php if(isset($_SESSION['save_carTrans'])){ if($_SESSION['save_carTrans'] == "MinManualvan"){ echo "selected"; } } ?>> Manual</option>
                                                        <option value="Automatik" <?php if(isset($_SESSION['save_carTrans'])){ if($_SESSION['save_carTrans'] == "Automatik"){ echo "selected"; } } ?>> Automatik</option>
                                                        <option value="Gjysmë-automatik" <?php if(isset($_SESSION['save_carTrans'])){ if($_SESSION['save_carTrans'] == "Gjysmë-automatik"){ echo "selected"; } } ?>> Gjysmë-automatik</option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carTransError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carTransError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Karburanti <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="car_fuel" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carFuelsError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <option value=""> Karburanti.. </option>
                                                        <option value="Benzinë" <?php if(isset($_SESSION['save_carFuels'])){ if($_SESSION['save_carFuels'] == "Benzinë"){ echo "selected"; } } ?>> Benzinë</option>
                                                        <option value="Naftë" <?php if(isset($_SESSION['save_carFuels'])){ if($_SESSION['save_carFuels'] == "Naftë"){ echo "selected"; } } ?>> Naftë</option>
                                                        <option value="Rrymë elektrike" <?php if(isset($_SESSION['save_carFuels'])){ if($_SESSION['save_carFuels'] == "Rrymë elektrike"){ echo "selected"; } } ?>> Rrymë elektrike</option>
                                                        <option value="Gaz natyror i kompresuar" <?php if(isset($_SESSION['save_carFuels'])){ if($_SESSION['save_carFuels'] == "Gaz natyror i kompresuar (CNG)"){ echo "selected"; } } ?>> Gaz natyror i kompresuar (CNG)</option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carFuelsError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carFuelsError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Kubikazha (e shprehur në kubik) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="car_cubics" class="form-control"   placeholder="Kubikazha e veturës.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("carCubError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_carCub'])){ echo "value='".$_SESSION['save_carCub']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("carCubError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['carCubError'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION['add_prod_errors']['carManError']);unset($_SESSION['add_prod_errors']['carModError']);unset($_SESSION['add_prod_errors']['carKmError']);unset($_SESSION['add_prod_errors']['carYopError']);unset($_SESSION['add_prod_errors']['capColError']);unset($_SESSION['add_prod_errors']['carTransError']);unset($_SESSION['add_prod_errors']['carFuelsError']);unset($_SESSION['add_prod_errors']['carCubError']);?>
                                            <?php unset($_SESSION['save_carMod']);unset($_SESSION['save_carKm']);unset($_SESSION['save_carYop']);unset($_SESSION['save_carType']);unset($_SESSION['save_carCol']);unset($_SESSION['save_carTrans']);unset($_SESSION['save_carFuels']);unset($_SESSION['save_carCub']); ?>
                                        </div>
                                        <!--- SPECIIFIKAT e templates-->
                                        <div id="spec_template" >
                                            <div class="form-group row" >
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Template (.zip) <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="file" name="template_zip"class="form-control" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("tempZipError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" >
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("tempZipError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['tempZipError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right">Kategoria e templates <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" class="form-control" name="template_category"   placeholder="Kategoria e templates.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("tempCatError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_tempCat'])){ echo "value='".$_SESSION['save_tempCat']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("tempCatError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['tempCatError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right">Teknologjitë e përdorura <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <input type="text" name="template_used_tech" class="form-control" placeholder="Teknologjitë e përdorura.." style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("tempUtError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>" <?php if(isset($_SESSION['save_tempUt'])){ echo "value='".$_SESSION['save_tempUt']."'"; } ?>>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("tempUtError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['tempUtError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right">Layouti <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="template_layout" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("tempLayoutError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <option value=""> Layotui.. </option>
                                                        <option value="Responsivë" <?php if(isset($_SESSION['save_tempLayout'])){ if($_SESSION['save_tempLayout'] == "Responsivë"){ echo "selected"; } } ?>> Responsivë</option>
                                                        <option value="Jo resposivë" <?php if(isset($_SESSION['save_tempLayout'])){ if($_SESSION['save_tempLayout'] == "Jo resposivë"){ echo "selected"; } } ?>> Jo resposivë</option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("tempLayoutError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['tempLayoutError'];
                                                        }
                                                    }?>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 col-form-label">
                                                    <label for="" class="float-right"  >Dokumentimi <b style='color:red'>*</b>:</label> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-7 col-7 ">
                                                    <select class="form-control" name="template_documented" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("tempDocError", $_SESSION['add_prod_errors'])){ echo "border: 1px solid red"; } }?>">
                                                        <option value=""> Dokumentimi.. </option>
                                                        <option value="I dokumentuar" <?php if(isset($_SESSION['save_tempDoc'])){ if($_SESSION['save_tempDoc'] == "I dokumentuar"){ echo "selected"; } } ?>> I dokumentuar</option>
                                                        <option value="Jo i dokumentuar"  <?php if(isset($_SESSION['save_tempDoc'])){ if($_SESSION['save_tempDoc'] == "Jo i dokumentuar"){ echo "selected"; } } ?>> Jo i dokumentuar</option>
                                                    </select>
                                                    <?php 
                                                    if(isset($_SESSION['add_prod_errors'])){
                                                        if(array_key_exists("tempDocError", $_SESSION['add_prod_errors'])){
                                                            echo $_SESSION['add_prod_errors']['tempDocError'];
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                            <?php unset($_SESSION['add_prod_errors']['tempCatError']);unset($_SESSION['add_prod_errors']['tempUtError']);unset($_SESSION['add_prod_errors']['tempLayoutError']);unset($_SESSION['add_prod_errors']['tempDocError']);unset($_SESSION['add_prod_errors']['tempZipError']);?>
                                            <?php unset($_SESSION['save_tempUt']);unset($_SESSION['save_tempDoc']);unset($_SESSION['save_tempLayout']);unset($_SESSION['save_tempCat']); ?>
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
     <script>
        document.getElementById("auc_description").onkeyup = function () {
            var auc_desc = document.getElementById("auc_description");
            console.log(auc_desc.value);
            if(auc_desc.value.length < 50 || auc_desc.value.length > 5000){
                document.getElementById("auc_description").style.border = "1px solid red";
            }else{
                document.getElementById("auc_description").style.border = "1px solid green";
            }
        }
    </script> 
    <script src="js/datepicker/jquery-3.3.1.min.js"></script>
    <script src="js/datepicker/jquery-ui.min.js"></script>
    <script src="js/datepicker/jquery.slicknav.js"></script>
    <script src="js/datepicker/main.js"></script>
</main>
<?php require 'footer.php'; ?>
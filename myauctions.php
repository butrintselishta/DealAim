<?php 
    require_once("db.php");
    if($_SESSION['logged']==false){
        header("location:signin.php");
    }
    if($_SESSION['user']['status'] != SELLER){
        header("index.php");
    }

    if(isset($_POST['btn_add_prod'])){
        $auc_category = $_POST['auc_category'];//die(var_dump($category));
        $auc_title = $_POST['auc_title'];
        $auc_price = str_replace(" ", "",$_POST['auc_price']);//die(var_dump($auc_price));
        $auc_start = $_POST['auc_start'];
        $auc_end = $_POST['auc_end'];
        $auc_desc = $_POST['auc_description'];
        $auc_photo1 = $_POST['auc_photo1']; $auc_photo2 = $_POST['auc_photo2']; $auc_photo3 = $_POST['auc_photo3']; $auc_photo4 = $_POST['auc_photo4']; $auc_photo5 = $_POST['auc_photo5'];

        $start_at = strtotime($auc_start);
        $day_after_today = strtotime(date("d/m/Y", strtotime("+1 day")));//tomorrow date
        $day_after_sevendays = strtotime(date("d/m/Y", strtotime("+7 day")));//7 days from today
        
        //GENERATING AN UNIQUE ID for every Product
        $unique_id = uniqid($_SESSION['user']['username']."_");

        //start from 12PM of the GIVEN AUCTION START DAY
        $hourstoadd = 12;
        $secondstoadd = $hourstoadd * (60*60);
        $auc_start_time = $auc_start + $secondstoadd;
        $start_time = date("d-m-Y h:i A", $auc_start_time);//die(var_dump($start_time));

        $titleError = false; $priceError = false; $startError = false; $endError = false; $descError = false;$photosError = false;
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
        if(empty($auc_photo1) || empty($auc_photo2) || empty($auc_photo3)){
            $_SESSION['save_price'] = $auc_price;
            $_SESSION['save_title'] = $auc_title;
            $_SESSION['save_start'] = $auc_start;
            $_SESSION['save_end'] = $auc_end;
            $_SESSION['save_desc'] = $auc_desc;
            $photosError = true;
            $_SESSION['add_prod_errors'] += ['photosError' => "asdasf"];
        }

        if($titleError || $priceError || $startError || $endError || $descError){
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
                                    <span style="background-color:#fff">Vendosë produktin tënd në ankand</span>
                                </div>
                                <div class="row no-gutters">
                                    <form class="add_prod_form" method="post" action="">
                                       
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
                                                <input type="text" name="auc_start" class="form-control datepicker-2" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("startError", $_SESSION['add_prod_errors'])){ echo "border-color:red;";}} ?>" value="<?php if(isset($_SESSION['save_start'])){echo $_SESSION['save_start'];}else{ echo "dd/mm/YY";} unset($_SESSION['save_start']); ?>">
                                            </div>
                                            <p id="demooo"></p>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label class="float-right" style="">Sa ditë dëshironi që produkti juaj të qëndroj në ankand: </label> 
                                            </div>
                                            <div class="col-6">
                                                <select class="form-control" name="auc_end" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("endError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" value="<?php if(isset($_SESSION['save_end'])){echo $_SESSION['save_end'];} unset($_SESSION['save_end']); ?>">
                                                    <option value=""> Zgjidh  sa ditë dëshiron të qëndroj në ankand produkti juaj... </option>
                                                    <option value="1"> 1 </option>
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
                                                <input type="file" name="auc_photo1" class="form-control" style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photosError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>">
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style=""></label> 
                                            </div>
                                            <div class="col-6">
                                                <input type="file" name="auc_photo2" class="form-control"  style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photosError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" >
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-4 col-form-label">
                                                <label for="" class="float-right" style=""> </label> 
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-6">
                                                <input type="file"  name="auc_photo3"  class="form-control"style="<?php if(isset($_SESSION['add_prod_errors'])){ if(array_key_exists("photosError", $_SESSION['add_prod_errors'])){ echo "border:1px solid red;";}} ?>" >
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
                                        <?php unset($_SESSION['add_prod_errors']['titleError']);unset($_SESSION['add_prod_errors']['priceError']);unset($_SESSION['add_prod_errors']['startError']); unset($_SESSION['add_prod_errors']['endError']);unset($_SESSION['add_prod_errors']['descError']);unset($_SESSION['add_prod_errors']['photosError']);?>
                                        <!--- SPECIIFIKAT -->
                                        <h3 style="text-decoration:underline;" id="spec_h3" > Specifikat </h3>
                                        <!--- SPECIIFIKAT e laptopit-->
                                        <div id="spec_laptop" >
                                            <div class="form-group row" >
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Prodhuesi:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" id="lap_manufacturer" name="lap_manufacturer" >
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
                                                    <label for="inputEmail3" class="float-right" style="">Modeli:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_model" id="lap_model" class="form-control"   placeholder="Modeli laptopit..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Gjendja:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="lap_condition"   placeholder="Gjendja e laptopit..">
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
                                                    <input type="text" name="lap_ekrani" class="form-control"   placeholder="Diagonalja ekranit (e shprehur me inch)..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Ngjyra:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_color" class="form-control"   placeholder="Ngjyra..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label class="float-right" style="">Procesori:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_processor" class="form-control"   placeholder="Procesori..">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Memorja RAM (GB):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="lap_ram"   placeholder="">
                                                    3<option value=""> Memorja RAM(GB).. </option>
                                                    <option value="2GB"> 2GB </option>
                                                    <option value="4GB"> 4GB </option>
                                                    <option value="6GB"> 6GB </option>
                                                    <option value="8GB"> 8GB </option>
                                                    <option value="16GB"> 16GB </option>
                                                    <option value="24GB"> 24GB </option>
                                                    <option value="32GB"> 32GB </option>
                                                    <option value="32GB"> 64GB </option>
                                                    <option value="32GB"> 128GB </option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Memorja e mbrendshme:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="lap_internal_memory"   placeholder="Lloji i memorjes së mbrendshme..">
                                                    <option value=""> Memorja e mbrendshme.. </option>
                                                    <option value="I ri"> HDD </option>
                                                    <option value="I përdorur"> SSD </option>
                                                    <option value="I përdorur"> Hybrid </option>
                                                    </select>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Hapsira e memorjes se mbrendshme (GB):</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_internal_emory_space" class="form-control"   placeholder="Hapsira e memorjes së mbrendshme...">
                                                </div>
                                                <div class="divider"></div>
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Kartela Grafike:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="lap_graphic_card" class="form-control"   placeholder="Kartela Grafike..">
                                                </div>
                                            </div>
                                        </div>
                                        <!--- SPECIIFIKAT e telefonit-->
                                        <div id="spec_phone" >
                                            <div class="form-group row" >
                                                <div class="col-4 col-form-label">
                                                    <label for="inputEmail3" class="float-right" style="">Prodhuesi:</label> 
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-control" name="phone_manufacturer"   placeholder="Zgjedh prodhuesin">
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
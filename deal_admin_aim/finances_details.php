<?php 
    require_once "../db.php";
     if(!isset($_SESSION['logged'])){
        header("location:../index.php");
    }else if($_SESSION['user']['status'] !== ADMIN){
        header("location:index.php");
    }

    
	$username = $_SESSION['user']['username']; 
	$stmt = prep_stmt("SELECT * FROM users WHERE username = ?",$username, "s");
	if(mysqli_num_rows($stmt) > 0){
		$row_adm = mysqli_fetch_array($stmt);

		$username = $row_adm['username'];
		$profile_pic = $row_adm['profile_pic'];
		$fname = $row_adm['first_name'];//die(var_dump($fname));
		$lname = $row_adm['last_name'];
		$email = $row_adm['email'];
		$tel = $row_adm['tel_nr'];
		$bday = date("d-M-Y", strtotime($row_adm['birthday']));    
		$city = $row_adm['city'];
		$post_code = $row_adm['postal_code'];
		$address = $row_adm['address'];
		$pid = $row_adm['pid_number'];
	}
	else{
		$_SESSION['prep_stmt_error'] = "<h4 style='color:#E62E2D; font-weight:bold; text-align:center;'> GABIM! </h4><p style='color:#E62E2D;'> Diçka shkoi gabim, ju lutem kthehuni më vonë! </p>"; header("location:index.php"); die();
	}

	$balance_dealaim = prep_stmt("SELECT * FROM bank_acc WHERE acc_full_name = ?", "DealAIM Company", "s");
	$balance_fetch = mysqli_fetch_array($balance_dealaim);
?>
<?php require "header.php"; ?>
<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
				<span class="sr-only">Toggle Fullwidth</span>
				<i class="fa fa-angle-left"></i>
			</button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="../img/profile_pictures/<?php echo $row_adm['profile_pic']; ?>" class="img-responsive img-circle user-photo" alt="User Profile Picture" style="width:80%; height:20rem;">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Përshëndetje, <strong><?php echo $row_adm['first_name'] . " ". $row_adm['last_name']; ?></strong> <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="myprofile.php"><i class="fa fa-user-circle"></i> Profili im</a></li>
                    <li><a href="messages.php"><i class="fa fa-envelope" style="color:black;"></i> Mesazhet</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Çkyçu</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class=""><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a href="myprofile.php"><i class="fa fa-user-circle"></i> <span>Profili im</span></a></li>
                <?php if($_SESSION['user']['status'] == ADMIN) { ?>
                    <li class="active"><a href="finances.php"><i class="lnr lnr-chart-bars"></i> <span>Financat</span></a></li>
                    <li><a href="users.php"><i class="lnr lnr-users"></i> <span>Përdoruesit</span></a></li>
                <?php } ?>
				<li class=""><a href="site_data.php"><i class="lnr lnr-database"></i> <span>Të dhënat</span></a></li>
            </ul>
        </nav>
    </div>
</div>

<div id="main-content">
    <div class="container-fluid">
        <!-- SALES SUMMARY -->
        <div class="dashboard-section">
            <div class="section-heading clearfix">
                <h2 class="section-title"><i class="fa fa-pie-chart"></i>Detajet e të ardhurave</h2>
            </div>
            <!-- DAILY PROFIT -->
            <?php 
                $thisDay = prep_stmt("SELECT * FROM income_ratio
                WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
                AND MONTH(date_time) = MONTH(CURRENT_DATE)
                AND WEEK(date_time) = WEEK(CURRENT_DATE)
                AND DAY(date_time) = DAY(CURRENT_DATE)");
                
                $lastDay = prep_stmt("SELECT * FROM income_ratio
                WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 DAY)
                AND MONTH(date_time) = MONTH(CURRENT_DATE - INTERVAL 1 DAY)
                AND WEEK(date_time) = WEEK(CURRENT_DATE - INTERVAL 1 DAY)
                AND DAY(date_time) = DAY(CURRENT_DATE - INTERVAL 1 DAY)");

                $thisDayProfit = 0;
                $lastDayProfit = 0;
                if(mysqli_num_rows($lastDay) > 0){
                    while($row = mysqli_fetch_array($lastDay)){
                        $lastDayProfit = $lastDayProfit + $row['profit'];
                    }
                }
                if(mysqli_num_rows($thisDay) > 0){
                    while($row = mysqli_fetch_array($thisDay)){
                        $thisDayProfit = $thisDayProfit + $row['profit'];
                    }
                }

                $dayProfitPerc = 0;
                if($thisDayProfit > $lastDayProfit){
                    $dayProfitPerc = ($thisDayProfit - $lastDayProfit) * 100 ;
                    $dayProfitPerc = number_format($dayProfitPerc,2) . " %";
                }else if($thisDayProfit < $lastDayProfit){
                    $dayProfitPerc = $thisDayProfit - $lastDayProfit;
                    $dayProfitPerc = ($dayProfitPerc / $lastDayProfit) * 100 ;
                    $dayProfitPerc = number_format($dayProfitPerc,2) . " %";
                }else{
                    $dayProfitPerc = 0 . " %";
                }
                
            ?>
            <div class="row">
                <div class="panel-content">
                    <div class="col-md-12 "  style="margin-bottom:-20%;">
                        <h2 class="heading margin-bottom-50"><i class="	fa fa-area-chart" style="color: #82b2f9;font-weight:bold;"></i> &nbsp; Performanca <b>(DJE krahasuar me SOT)</b></h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Dje</th>
                                            <th>Sot</th>
                                            <th>Performanca (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Të ardhurat</th>
                                            <td><span class="text-warning" style="font-weight:800;    font-size: 1.785rem;"><?php echo number_format($lastDayProfit,2) . "€" ?></span></td>
                                            <td><span class="text-info"  style="font-weight:800;    font-size: 1.785rem;"><?php echo number_format($thisDayProfit,2) . "€" ?></span></td>
                                            <?php if($dayProfitPerc < 0){ 
                                                echo "<td><span class='text-danger'  style='font-weight:800;font-size: 1.785rem;color:crimson'> $dayProfitPerc</span></td>";
                                            }elseif($dayProfitPerc > 0){ 
                                                echo "<td><span class='text-success'  style='font-weight:800;font-size: 1.785rem;color:#68d400'> +$dayProfitPerc</span></td>";
                                            }else{
                                                echo "<td><span class='text-success'  style='font-weight:800;font-size: 1.785rem;'> $dayProfitPerc</span></td>";
                                            } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel-content">
                        <div class="col-md-12 col-sm-12">
                            <?php if($thisDayProfit > 0){ ?>
                                <p class="metric-inline"><i class="fa fa-euro"  style="color:#68d400;"> <b style="font-size:4rem"><?php echo number_format($thisDayProfit,2) ?></b> </i><span style="font-size: 1.785rem;">TË ARDHURAT PËR SOT</span></p>
                            <?php } else{ ?>
                                <p class="metric-inline"><i class="fa fa-euro" style="color:crimson"> <b style="font-size:4rem"><?php echo number_format($thisDayProfit,2) ?> </b></i><span style="font-size: 1.785rem;">TË ARDHURAT PËR SOT</span></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="panel-content">
			<h2 class="heading margin-bottom-50"></h2>
		</div>
		
        <div class="row">
            <div class="panel-content">
                <div class="col-md-12 "  style="margin-bottom:-20%;">
                    <h2 class="heading margin-bottom-50"><i class="	fa fa-area-chart" style="color: #82b2f9;font-weight:bold;"></i> &nbsp; Performanca <b>(JAVA KALUAR krahasuar me KËTË JAVË)</b></h2>
                </div>
            </div>
            <?php 
                $thisWeek = prep_stmt("SELECT * FROM income_ratio
                WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
                AND MONTH(date_time) = MONTH(CURRENT_DATE)
                AND WEEK(date_time) = WEEK(CURRENT_DATE)");
                
                $lastWeek = prep_stmt("SELECT * FROM income_ratio
                WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 WEEK)
                AND MONTH(date_time) = MONTH(CURRENT_DATE - INTERVAL 1 WEEK)
                AND WEEK(date_time) = WEEK(CURRENT_DATE - INTERVAL 1 WEEK)");

                $thisWeekProfit = 0;
                $lastWeekProfit = 0;
                if(mysqli_num_rows($lastWeek) > 0){
                    while($row = mysqli_fetch_array($lastWeek)){
                        $lastWeekProfit = $lastWeekProfit + $row['profit'];
                    }
                }
                if(mysqli_num_rows($thisWeek) > 0){
                    while($row = mysqli_fetch_array($thisWeek)){
                        $thisWeekProfit = $thisWeekProfit + $row['profit'];
                    }
                }
                $mondayDate_weekprofit = date("l d-m");//die($monday_weekprofit);
                $todayDate_weekprofit = date("l");
                if(strpos($mondayDate_weekprofit, "Monday") !== FALSE){
                    $mondayDate_weekprofit = date("l",strtotime("this monday"));
                }else{
                    $mondayDate_weekprofit = date("l",strtotime("last monday"));
                }

                $weekProfitPerc = 0;
                if($thisWeekProfit > $lastWeekProfit){
                    $weekProfitPerc = ($thisWeekProfit - $lastWeekProfit) * 100 ;
                    $weekProfitPerc = number_format($weekProfitPerc,2) . " %";
                }else if($thisWeekProfit < $lastWeekProfit){
                    $weekProfitPerc = $thisWeekProfit - $lastWeekProfit;
                    $weekProfitPerc = ($weekProfitPerc / $lastWeekProfit) * 100 ;
                    $weekProfitPerc = number_format($weekProfitPerc,2) . " %";
                }else{
                    $weekProfitPerc = 0 . " %";
                }
                
            ?>
            <div class="col-md-8">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Java kaluar <br>(<?php if($todayDate_weekprofit == "Monday"){echo "MONDAY";}else{ echo $mondayDate_weekprofit . " - " . $todayDate_weekprofit; } ?>)</th>
                                        <th>Këtë javë <br>(<?php if($todayDate_weekprofit == "Monday"){echo "MONDAY";}else{ echo $mondayDate_weekprofit . " - " . $todayDate_weekprofit; } ?>)</th>
                                        <th>Performanca (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Të ardhurat</th>
                                        <td><span class="text-warning" style="font-weight:800;    font-size: 1.785rem;"><?php echo number_format($lastWeekProfit,2) . "€" ?></span></td>
                                        <td><span class="text-info"  style="font-weight:800;    font-size: 1.785rem;"><?php echo number_format($thisWeekProfit,2) . "€" ?></span></td>
                                        <?php if($weekProfitPerc < 0){ 
                                            echo "<td><span class='text-danger'  style='font-weight:800;font-size: 1.785rem;color:crimson'> $weekProfitPerc </span></td>";
                                        }elseif($weekProfitPerc > 0){ 
                                            echo "<td><span class='text-success'  style='font-weight:800;font-size: 1.785rem;color:#68d400'> +$weekProfitPerc</span></td>";
                                        }else{
                                            echo "<td><span class='text-success'  style='font-weight:800;font-size: 1.785rem;'> $weekProfitPerc </span></td>";
                                        } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel-content">
                    <div class="col-md-12 col-sm-12">
                        <?php if($thisWeekProfit > 0){ ?>
                            <p class="metric-inline"><i class="fa fa-euro"  style="color:#68d400;"> <b style="font-size:4rem"><?php echo number_format($thisWeekProfit,2) ?></b> </i><span style="font-size: 1.785rem;">TË ARDHURAT PËR KËTË JAVË</span></p>
                        <?php } else{ ?>
                            <p class="metric-inline"><i class="fa fa-euro" style="color:crimson"> <b style="font-size:4rem"><?php echo number_format($thisWeekProfit,2) ?> </b></i><span style="font-size: 1.785rem;">TË ARDHURAT PËR KËTË JAVË</span></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
			<?php 
				$this_week_pro = "";
				$last_week_pro = "";
				$this_today = date("l d-M");
				if(strpos($this_today, "Monday") !== FALSE)
				{ 
					$this_week_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt 
					FROM income_ratio 
					WHERE date(date_time) BETWEEN subdate(curdate(),dayofweek(curdate())+5)
					and CURRENT_DATE - INTERVAL 1 DAY
					GROUP BY date(date_time)");

					$last_week_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt
					FROM income_ratio 
					WHERE date(date_time) BETWEEN subdate(curdate(),dayofweek(curdate())+5) - INTERVAL 1 WEEK
					and CURRENT_DATE - INTERVAL 1 week - INTERVAL 1 DAY
					GROUP BY date(date_time)");
					$this_today = date("l d-M", strtotime("last monday"));
					// $this_weekDays = date("l",strtotime("this week Monday")); 
				}else{
					$this_week_pro = prep_stmt("SELECT sum(profit) as prof, DATE(date_time) as dt 
					FROM income_ratio
					WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
					AND MONTH(date_time) = MONTH(CURRENT_DATE)
					AND WEEK(date_time) = WEEK(CURRENT_DATE)
					GROUP BY DATE(date_time)");
					$this_today = date("l d-M", strtotime("last monday"));

					$last_week_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt 
					FROM income_ratio 
					WHERE date(date_time) BETWEEN subdate(curdate(),dayofweek(curdate())+5)
					and CURRENT_DATE - INTERVAL 1 week 
					GROUP BY date(date_time)");
				}
				
				$this_today = date("Y-m-d", strtotime($this_today)); 
				$tdy = date("Y-m-d");
				$date_diff = abs(strtotime(date("Y/m/d", strtotime($this_today))) - strtotime(date("Y/m/d", strtotime($tdy))));
				$numberDays = intval($date_diff/86400);

				$week_days_pro = array();
				for($i =0; $i < $numberDays; $i++){
					$week_days_pro[] .= date('l', strtotime($this_today));
					$this_today = date('l', strtotime("+1 day", strtotime($this_today)));
				}

				$this_week_pro_db = array();
				if(mysqli_num_rows($this_week_pro) > 0){
					while($row = mysqli_fetch_array($this_week_pro)){
						$data = date("l", strtotime($row['dt']));
						$this_week_pro_db[] = array("data" => $data, "profit" => number_format($row['prof'],2));
					}
				}
				$last_week_pro_db = array();
				if(mysqli_num_rows($last_week_pro) > 0){
					while($row = mysqli_fetch_array($last_week_pro)){
						$data = date("l", strtotime($row['dt']));
						$last_week_pro_db[] = array("data" => $data, "profit" => number_format($row['prof'],2));
					}
				}
				//var_dump($this_week_pro_db);die(var_dump($last_week_pro_db));

				$this_week_pro_alldays = array();
				$j = 0;
				for($i = 0; $i < count($week_days_pro); $i++){
					if(array_search($week_days_pro[$i],array_column($this_week_pro_db,"data")) === FALSE){
						$this_week_pro_alldays[] = array("data" => $week_days_pro[$i],"profit" => 0);
					}else{
						$this_week_pro_alldays[] = array("data" => $this_week_pro_db[$j]["data"], "profit" => $this_week_pro_db[$j]["profit"]);
						$j++;
					}
				}//die(var_dump($this_week_pro_alldays));

				$last_week_pro_alldays = array();
				$j = 0;
				for($i = 0; $i < count($week_days_pro); $i++){
					if(array_search($week_days_pro[$i],array_column($last_week_pro_db,"data")) === FALSE){
						$last_week_pro_alldays[] = array("data" => $week_days_pro[$i],"profit" => 0);
					}else{
						$last_week_pro_alldays[] = array("data" => $last_week_pro_db[$j]["data"], "profit" => $last_week_pro_db[$j]["profit"]);
						$j++;
					}
				}
				//var_dump($this_week_pro_alldays);die(var_dump($last_week_pro_alldays));
				
				$this_w_profit = "";
				$last_w_profit = "";
				$this_w_days = "";
				for($i = 0; $i < count($last_week_pro_alldays); $i++){
					$this_w_days .= "'".date("l", strtotime($this_week_pro_alldays[$i]["data"])) . "',";
					$this_w_profit .= $this_week_pro_alldays[$i]['profit'] . ",";
					$last_w_profit .= $last_week_pro_alldays[$i]['profit'] . ",";
				}
				$this_w_days = rtrim($this_w_days,",");
				$this_w_profit = rtrim($this_w_profit, ",");
				$last_w_profit = rtrim($last_w_profit, ",");
			?>
            <div class="col-md-12">
                <div class="panel-content">
                    <div id="demo-multiple-chart" class="ct-chart"></div>
                </div>
            </div>
		</div>

		<div class="panel-content">
			<h2 class="heading margin-bottom-50"></h2>
		</div>
		<!-- MONTHLY PROFIT -->
		<div class="row">
            <div class="panel-content">
                <div class="col-md-12 "  style="margin-bottom:-20%;">
                    <h2 class="heading margin-bottom-50"><i class="	fa fa-area-chart" style="color: #82b2f9;font-weight:bold;"></i> &nbsp; Performanca <b>(MUAJI KALUAR krahasuar me KËTË MUAJ)</b></h2>
                </div>
            </div>
            <?php 
                $thisMonth = prep_stmt("SELECT * FROM income_ratio
				WHERE YEAR(date_time) = YEAR(CURRENT_DATE)
				AND MONTH(date_time) = MONTH(CURRENT_DATE)");

				$lastMonth = prep_stmt("SELECT * FROM income_ratio
				WHERE YEAR(date_time) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
				AND MONTH(date_time) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)");

				$thisMonthProfit = 0;
				$lastMonthProfit = 0;
				if(mysqli_num_rows($lastMonth) > 0){
					while($row = mysqli_fetch_array($lastMonth)){
						$lastMonthProfit = $lastMonthProfit + $row['profit'];
					}
				}
				if(mysqli_num_rows($thisMonth) > 0){
					while($row = mysqli_fetch_array($thisMonth)){
						$thisMonthProfit = $thisMonthProfit + $row['profit'];
					}
				}
				//die($lastMonthProfit . " " . $thisMonthProfit);
				$profitPerc = 0;
				if($thisMonthProfit > $lastMonthProfit){
					$profitPerc = ($thisMonthProfit - $lastMonthProfit) * 100 ;
					$profitPerc = number_format($profitPerc,2) . " %";
				}else if($thisMonthProfit < $lastMonthProfit){
					$profitPerc = $thisMonthProfit - $lastMonthProfit;
					$profitPerc = ($profitPerc / $lastMonthProfit) * 100 ;
					$profitPerc = number_format($profitPerc,2) . " %";
				}else{
					$profitPerc = 0 . " %";
				}

				$firstDay_lastMonth = date("d-M", strtotime("first day of last month"));
				$lastDay_lastMonth = date("d-M", strtotime("last day of last month"));

				$firstDay_thisMonth = date("d-M", strtotime("first day of this month"));
				$lastDay_thisMonth = date("d-M");
                
            ?>
            <div class="col-md-8">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Muaji kaluar <br>(<?php echo $firstDay_lastMonth . " - " . $lastDay_lastMonth ?>)</th>
                                        <th>Ky muaj <br>(<?php if(strpos($lastDay_thisMonth, "01") !== FALSE){ echo $lastDay_thisMonth; }else { echo $firstDay_thisMonth . " - " . $lastDay_thisMonth; }?>)</th>
                                        <th>Performanca (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Të ardhurat</th>
                                        <td><span class="text-warning" style="font-weight:800;    font-size: 1.785rem;"><?php echo number_format($lastMonthProfit,2) . "€" ?></span></td>
                                        <td><span class="text-info"  style="font-weight:800;    font-size: 1.785rem;"><?php echo number_format($thisMonthProfit,2) . "€" ?></span></td>
                                        <?php if($profitPerc < 0){ 
                                            echo "<td><span class='text-danger'  style='font-weight:800;font-size: 1.785rem;color:crimson'> $profitPerc </span></td>";
                                        }elseif($profitPerc > 0){ 
                                            echo "<td><span class='text-success'  style='font-weight:800;font-size: 1.785rem;color:#68d400'> +$profitPerc</span></td>";
                                        }else{
                                            echo "<td><span class='text-success'  style='font-weight:800;font-size: 1.785rem;'> $profitPerc </span></td>";
                                        } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel-content">
                    <div class="col-md-12 col-sm-12">
                        <?php if($thisWeekProfit > 0){ ?>
                            <p class="metric-inline"><i class="fa fa-euro"  style="color:#68d400;"> <b style="font-size:4rem"><?php echo number_format($thisMonthProfit,2) ?></b> </i><span style="font-size: 1.785rem;">TË ARDHURAT PËR KËTË MUAJ</span></p>
                        <?php } else{ ?>
                            <p class="metric-inline"><i class="fa fa-euro" style="color:crimson"> <b style="font-size:4rem"><?php echo number_format($thisMonthProfit,2) ?> </b></i><span style="font-size: 1.785rem;">TË ARDHURAT PËR KËTË MUAJ</span></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
		<?php 
				$this_month_pro = "";
				$last_month_pro = "";
				$month_today = date("d-M");
				$today_m = date("d-M", strtotime("first day of this month"));
				if(strpos($month_today, "01") !== FALSE)
				{ 
					$this_month_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt 
					FROM income_ratio 
					WHERE date(date_time) 
                    BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH,'%Y-%m-01')
					and LAST_DAY(NOW() - INTERVAL 1 MONTH) 
					GROUP BY date(date_time)");

					$last_month_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt 
					FROM income_ratio 
					WHERE date(date_time) 
                    BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 2 MONTH,'%Y-%m-01')
					and LAST_DAY(NOW() - INTERVAL 2 MONTH) 
					GROUP BY date(date_time)");

					$month_today = date("d-M", strtotime("first day of last month"));
					$today_m = date("d-M", strtotime("last day of last month"));
					// $this_weekDays = date("l",strtotime("this week Monday")); 
				}else{
					$this_month_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt 
					FROM income_ratio 
					WHERE date(date_time) 
                    BETWEEN DATE_FORMAT(CURDATE(),'%Y-%m-01')
					and CURDATE()
					GROUP BY date(date_time)");

					$last_month_pro = prep_stmt("SELECT sum(profit) AS prof, DATE(date_time) as dt 
					FROM income_ratio 
					WHERE date(date_time) 
                    BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH,'%Y-%m-01')
					and LAST_DAY(NOW() - INTERVAL 1 MONTH) 
					GROUP BY date(date_time)");
				}
				
				$month_today = date("Y-m-d", strtotime($month_today));
				$today_m = date("Y-m-d", strtotime($today_m));
				$date_diff = abs(strtotime(date("Y/m/d", strtotime($month_today))) - strtotime(date("Y/m/d", strtotime($today_m))));
				$numberDays = intval($date_diff/86400);//die(var_dump($numberDays));

				$month_days_pro = array();
				for($i =0; $i < $numberDays; $i++){
					$today_ = explode("-", $today_m);
					$month_days_pro[] .= $today_[2];
					$today_m = date('Y-m-d', strtotime("+1 day", strtotime($today_m)));
				}//die(var_dump($month_days_pro));

				$this_month_pro_db = array();
				if(mysqli_num_rows($this_month_pro) > 0){
					while($row = mysqli_fetch_array($this_month_pro)){
						$data = date("d", strtotime($row['dt']));
						$this_month_pro_db[] = array("data" => $data, "profit" => number_format($row['prof'],2));
					}
				}
				$last_month_pro_db = array();
				if(mysqli_num_rows($last_month_pro) > 0){
					while($row = mysqli_fetch_array($last_month_pro)){
						$data = date("d", strtotime($row['dt']));
						$last_month_pro_db[] = array("data" => $data, "profit" => number_format($row['prof'],2));
					}
				}
				//var_dump($this_month_pro_db);die(var_dump($last_month_pro_db));

				$this_month_pro_alldays = array();
				$m = 0;
				for($i = 0; $i < count($month_days_pro); $i++){
					if(array_search($month_days_pro[$i],array_column($this_month_pro_db,"data")) === FALSE){
						$this_month_pro_alldays[] = array("data" => $month_days_pro[$i],"profit" => 0);
					}else{
						$this_month_pro_alldays[] = array("data" => $this_month_pro_db[$m]["data"], "profit" => $this_month_pro_db[$m]["profit"]);
						$m++;
					}
				}//die(var_dump($this_month_pro_alldays));

				$last_month_pro_alldays = array();
				$k = 0;
				for($i = 0; $i < count($month_days_pro); $i++){
					if(array_search($month_days_pro[$i],array_column($last_month_pro_db,"data")) === FALSE){
						$last_month_pro_alldays[] = array("data" => $month_days_pro[$i],"profit" => 0);
					}else{
						$last_month_pro_alldays[] = array("data" => $last_month_pro_db[$k]["data"], "profit" => $last_month_pro_db[$k]["profit"]);
						$k++;
					}
				}
				//die(var_dump($last_month_pro_alldays));
				
				$this_m_profit = "";
				$last_m_profit = "";
				$this_m_days = "";
				for($i = 0; $i < count($last_month_pro_alldays); $i++){
					$this_m_days .= "'".$this_month_pro_alldays[$i]["data"] . "',";
					$this_m_profit .= $this_month_pro_alldays[$i]['profit'] . ",";
					$last_m_profit .= $last_month_pro_alldays[$i]['profit'] . ",";
				}
				$this_m_days = rtrim($this_m_days,",");
				$this_m_profit = rtrim($this_m_profit, ",");
				$last_m_profit = rtrim($last_m_profit, ",");
				//die($this_m_days . "</br>" . $this_m_profit . "<br>". $last_m_profit);
			?>
            <div class="col-md-12">
                <div class="panel-content">
                    <div id="demo-multiple-chart2" class="ct-chart"></div>
                </div>
            </div>
		</div>
    </div>
</div>



<div class="clearfix"></div>
<footer>
    <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
</footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/metisMenu/metisMenu.js"></script>
<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/scripts/common.js"></script>
<script src="assets/vendor/chartist/js/chartist.min.js"></script>
<script src="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>
<script src="assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js"></script>
<script src="assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js"></script>
<script src="assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js"></script>
<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
<script src="assets/vendor/toastr/toastr.js"></script>
<script>
    $(function() {
        // photo upload
        $('#btn-upload-photo').on('click', function() {
            $(this).siblings('#filePhoto').trigger('click');
        });

        // plans
        $('.btn-choose-plan').on('click', function() {
            $('.plan').removeClass('selected-plan');
            $('.plan-title span').find('i').remove();

            $(this).parent().addClass('selected-plan');
            $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
        });
    });
</script>
<?php ?>
<script>
	$(function() {
		var options;
		var data = {
			labels: [],
			series: [
				[2,3,4],
			]
		};

		// line chart
		options = {
			height: "300px",
			showPoint: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		};

		new Chartist.Line('#demo-line-chart1', data, options);

		
		// sales performance chart
		var sparklineSalesPerformance = function() {

		var lastWeekData = [142, 164, 298, 384, 232, 269, 211];
		var currentWeekData = [352, 267, 373, 222, 533, 111, 60];

		$('#chart-sales-performance').sparkline(lastWeekData, {
			fillColor: 'rgba(90, 90, 90, 0.1)',
			lineColor: '#5A5A5A',
			width: '' + $('#chart-sales-performance').innerWidth() + '',
			height: '100px',
			lineWidth: '2',
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			chartRangeMin: 0,
			chartRangeMax: 1000
		});

		$('#chart-sales-performance').sparkline(currentWeekData, {
			composite: true,
			fillColor: 'rgba(60, 137, 218, 0.1)',
			lineColor: '#3C89DA',
			lineWidth: '2',
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			chartRangeMin: 0,
			chartRangeMax: 1000
		});
		}

		sparklineSalesPerformance();

		var sparkResize;
		$(window).on('resize', function() {
		clearTimeout(sparkResize);
		sparkResize = setTimeout(sparklineSalesPerformance, 200);
		});


		// bar chart
		options = {
			height: "300px",
			axisX: {
				showGrid: false
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		};

		new Chartist.Bar('#demo-bar-chart1', data, options);


		// area chart
		options = {
			height: "270px",
			showArea: true,
			showLine: false,
			showPoint: false,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#demo-area-chart', data, options);


		// multiple chart
		var dataMultiple = {
			labels: [<?php echo $this_w_days ?>],
			series: [{
				name: 'series-real',
				data: [<?php echo $last_w_profit ?>],
			}, {
				name: 'series-projection',
				data: [<?php echo $this_w_profit ?>],
			}]
		};

		options = {
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showPoint: false,
				},
			},
			plugins: [
				Chartist.plugins.legend({
					legendNames: ['Java e kaluar', 'Kjo javë']
				})
			]
		};

		new Chartist.Line('#demo-multiple-chart', dataMultiple, options);


		// pie chart
		var dataPie = {
			series: [0,0,2]
		};

		var labels = ['Tërheqje', 'Shitje'];
		var sum = function(a, b) {
			return a + b;
		};
		
		new Chartist.Pie('#demo-pie-chart', dataPie, {
			height: "270px",
			labelInterpolationFnc: function(value, idx) {
				var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
				console.log(value / dataPie.series.reduce(sum));
				return labels[idx] + ' (' + percentage + ')';
			}
		});


		// donut chart
		var dataDonut = {
			series: [20, 10, 30, 40]
		};

		new Chartist.Pie('#demo-donut-chart', dataDonut, {
			height: "270px",
			donut: true,
			donutWidth: 60,
			donutSolid: true,
			startAngle: 270,
			showLabel: true
		});


		// stacked bar chart
		var dataStackedBar = {
			labels: ['Q1', 'Q2', 'Q3', 'Q4'],
			series: [
				[800000, 1200000, 1400000, 1300000],
				[200000, 400000, 500000, 300000],
				[100000, 200000, 400000, 600000]
			]
		};

		new Chartist.Bar('#demo-stackedbar-chart', dataStackedBar, {
			height: "270px",
			stackBars: true,
			axisX: {
				showGrid: false
			},
			axisY: {
				labelInterpolationFnc: function(value) {
					return (value / 1000) + 'k';
				}
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		}).on('draw', function(data) {
			if (data.type === 'bar') {
				data.element.attr({
					style: 'stroke-width: 30px'
				});
			}
		});


		// horizontal bar chart
		var dataHorizontalBar = {
			labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
			series: [
				[5, 4, 3, 7, 5, 10, 3],
				[3, 2, 9, 5, 4, 6, 4]
			]
		};

		new Chartist.Bar('#demo-horizontalbar-chart', dataHorizontalBar, {
			height: "300px",
			seriesBarDistance: 15,
			reverseData: true,
			horizontalBars: true,
			axisY: {
				offset: 75
			}
		});

	});

	$(function() {

		var sparklineNumberChart = function() {

		var params = {
			width: '140px',
			height: '30px',
			lineWidth: '2',
			lineColor: '#20B2AA',
			fillColor: false,
			spotRadius: '2',
			spotColor: false,
			minSpotColor: false,
			maxSpotColor: false,
			disableInteraction: false
		};

		$('#number-chart1').sparkline('html', params);
		$('#number-chart2').sparkline('html', params);
		$('#number-chart3').sparkline('html', params);
		$('#number-chart4').sparkline('html', params);
		};

		sparklineNumberChart();




		// progress bars
		$('.progress .progress-bar').progressbar({
			display_text: 'none'
		});

		// line chart
		var data = {
		labels: [<?php echo $this_w_days ?>],
		series: [
			[<?php echo $this_w_profit ?>],
		]
		};
		var dataMultiple = {
			labels: [<?php echo $this_m_days ?>],
			series: [{
				name: 'series-real',
				data: [<?php echo $last_m_profit ?>],
			}, {
				name: 'series-projection',
				data: [<?php echo $this_m_profit ?>],
			}]
		};

		options = {
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showPoint: false,
				},
			},
			plugins: [
				Chartist.plugins.legend({
					legendNames: ['Muaji i kaluar', 'Ky muaj']
				})
			]
		};

		new Chartist.Line('#demo-multiple-chart2', dataMultiple, options);
		var options = {
		height: "200px",
		showPoint: true,
		showArea: true,
		axisX: {
			showGrid: false
		},
		lineSmooth: false,
		chartPadding: {
			top: 0,
			right: 0,
			bottom: 30,
			left: 30
		},
		plugins: [
			Chartist.plugins.tooltip({
				appendToBody: true
			}),
			Chartist.plugins.ctAxisTitle({
				axisX: {
					axisTitle: 'Data',
					axisClass: 'ct-axis-title',
					offset: {
						x: 0,
						y: 50
					},
					textAnchor: 'middle'
				},
				axisY: {
					axisTitle: 'Shuma',
					axisClass: 'ct-axis-title',
					offset: {
						x: 0,
						y: -10
					},
				}
			})
		]
		};

		new Chartist.Line('#demo-line-chart2', data, options);


		// sales performance chart
		options = {
			height: "300px",
			axisX: {
				showGrid: false
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
			]
		};

		new Chartist.Bar('#demo-bar-chart2', data, options);

		// top products
		var dataStackedBar = {
		labels: ['Q1', 'Q2', 'Q3'],
		series: [
			[800000, 1200000, 1400000],
			[200000, 400000, 500000],
			[100000, 200000, 400000]
		]
		};

		new Chartist.Bar('#chart-top-products', dataStackedBar, {
		height: "250px",
		stackBars: true,
		axisX: {
			showGrid: false
		},
		axisY: {
			labelInterpolationFnc: function(value) {
				return (value / 1000) + 'k';
			}
		},
		plugins: [
			Chartist.plugins.tooltip({
				appendToBody: true
			}),
			Chartist.plugins.legend({
				legendNames: ['Phone', 'Laptop', 'PC']
			})
		]
		}).on('draw', function(data) {
		if (data.type === 'bar') {
			data.element.attr({
				style: 'stroke-width: 30px'
			});
		}
		});
	});

	
	</script>
</body>

</html>
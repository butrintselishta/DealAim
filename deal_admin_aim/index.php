<?php 
require_once '../db.php'; 
    if(!isset($_SESSION['logged']) && $_SESSION['user']['status'] !== MODERATOR || $_SESSION['user']['status'] !== ADMIN){
        header("location:../index.php");
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

?>
<?php require "header.php"; ?>
<!-- LEFT SIDEBAR -->
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
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">Messages</a></li>
                    <li><a href="#">Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
				<li class="active"><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li class=""><a href="myprofile.php"><i class="lnr lnr-user"></i> <span>Profili im</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
<!-- MAIN CONTENT -->
<div id="main-content">
    <div class="container-fluid">
        <h1 class="sr-only">Dashboard</h1>
        <!-- WEBSITE ANALYTICS -->
        <div class="dashboard-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <?php if(isset($_SESSION['data_changed'])){ ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> Konfirmimi i produktit u krye me sukses. <?php if($_SESSION['data_changed'] == 1) { echo "<b style='text-transform:uppercase;'>Produkti doli në ankand! </b>";}else if($_SESSION['data_changed'] == 2){ echo "<b style='text-transform:uppercase;color:#9c1e08;'>Produkti nuk u lejua të dal në ankand! </b>";} ?>
							</div>
                         <?php } unset($_SESSION['data_changed']);?>
                        <h3 class="heading"><i class="fa fa-square"></i>Produkte në pritje!</h3>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        
                            <?php 
                                $sel_prod = prep_stmt("SELECT prod_id, username, cat_title,prod_title,prod_price, prod_from FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ?", 0, 'i');
                                if(mysqli_num_rows($sel_prod) > 0){
                                    while($row_prod = mysqli_fetch_array($sel_prod)){
                            ?>
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Shitësi </th>
                                        <th>Kategoria </th>
                                        <th>Titulli ankandit</th>
                                        <th>Çmimi fillestar</th>
                                        <th>Fillimi ankandit</th>
                                        <th>Statusi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row_prod['prod_id']; ?></td>
                                        <td><b style=' color:#f0ad4e;'><?php echo $row_prod['username']; ?></b></td>
                                        <td><?php echo $row_prod['cat_title']; ?></td>
                                        <td><?php echo $row_prod['prod_title']; ?></td>
                                        <td><?php echo $row_prod['prod_price'] . " €"; ?></td>
                                        <td><?php echo date("d-M-Y", strtotime($row_prod['prod_from'])); ?></td>
                                        <td><span class="label label-warning">Në pritje</span></td>
                                        <td><a class="btn btn-info btn-sm" href="prod_details.php?prod_det=<?php echo $row_prod['prod_id'];?>"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php } }
                                else { ?>
                                   <div class="alert alert-info alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <i class="fa fa-info-circle"></i> Për momentin nuk ka asnjë produkt në pritje.
                                    </div>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <h3 class="heading"><i class="fa fa-square"></i>Produktet të konfirmuara </h3>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                          <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="overflow:scroll;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Shitësi </th>
                                        <th>Kategoria </th>
                                        <th>Titulli ankandit</th>
                                        <th>Çmimi fillestar</th>
                                        <th>Statusi</th>
                                        <th>Administratori</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $sel_prod = prep_stmt("SELECT prod_id, username, cat_title,prod_title,prod_price, prod_isApproved FROM products LEFT OUTER JOIN users ON products.user_id = users.user_id LEFT OUTER JOIN categories ON products.cat_id = categories.cat_id WHERE prod_isApproved = ? or prod_isApproved = ? ORDER BY prod_id DESC", array(1,2) , 'ii');
                                    if(mysqli_num_rows($sel_prod) > 0){
                                        while($row_prod = mysqli_fetch_array($sel_prod)){
                                ?>
                                    <tr>
                                        <td><?php echo $row_prod['prod_id']; ?></td>
                                        <td><b style=' color:#f0ad4e;'><?php echo $row_prod['username']; ?></b></td>
                                        <td><?php echo $row_prod['cat_title']; ?></td>
                                        <td><?php echo $row_prod['prod_title']; ?></td>
                                        <td><?php echo $row_prod['prod_price'] . " €"; ?></td>
                                        <td><span class="label label-<?php if($row_prod['prod_isApproved'] == 1){echo "success";} elseif($row_prod['prod_isApproved'] == 2){echo "danger";} ?>"><?php if($row_prod['prod_isApproved'] == 1){echo "I pranuar";} elseif($row_prod['prod_isApproved'] == 2){echo "Jo i pranuar";} ?></span></td>
                                        <td><b><?php echo $username; ?></b></td>
                                        <td><a class="btn btn-info btn-sm" href="prod_details.php?prod_det=<?php echo $row_prod['prod_id'];?>"><i class="fa fa-file-text-o"></i>SHIKO DETAJET</a></td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- TRAFFIC SOURCES -->
                    <div class="panel-content">
                        <h2 class="heading"><i class="fa fa-square"></i> Traffic Sources</h2>
                        <div id="demo-pie-chart" class="ct-chart"></div>
                    </div>
                    <!-- END TRAFFIC SOURCES -->
                </div>
                <div class="col-md-4">
                    <!-- REFERRALS -->
                    <div class="panel-content">
                        <h2 class="heading"><i class="fa fa-square"></i> Referrals</h2>
                        <ul class="list-unstyled list-referrals">
                            <li>
                                <p><span class="value">3,454</span><span class="text-muted">visits from Facebook</span></p>
                                <div class="progress progress-xs progress-transparent custom-color-blue">
                                    <div class="progress-bar" data-transitiongoal="87"></div>
                                </div>
                            </li>
                            <li>
                                <p><span class="value">2,102</span><span class="text-muted">visits from Twitter</span></p>
                                <div class="progress progress-xs progress-transparent custom-color-purple">
                                    <div class="progress-bar" data-transitiongoal="34"></div>
                                </div>
                            </li>
                            <li>
                                <p><span class="value">2,874</span><span class="text-muted">visits from Affiliates</span></p>
                                <div class="progress progress-xs progress-transparent custom-color-green">
                                    <div class="progress-bar" data-transitiongoal="67"></div>
                                </div>
                            </li>
                            <li>
                                <p><span class="value">2,623</span><span class="text-muted">visits from Search</span></p>
                                <div class="progress progress-xs progress-transparent custom-color-yellow">
                                    <div class="progress-bar" data-transitiongoal="54"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- END REFERRALS -->
                </div>
                <div class="col-md-4">
                    <div class="panel-content">
                        <!-- BROWSERS -->
                        <h2 class="heading"><i class="fa fa-square"></i> Browsers</h2>
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Browsers</th>
                                        <th>Sessions</th>
                                        <th>% Sessions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chrome</td>
                                        <td>1,756</td>
                                        <td>23%</td>
                                    </tr>
                                    <tr>
                                        <td>Firefox</td>
                                        <td>1,379</td>
                                        <td>14%</td>
                                    </tr>
                                    <tr>
                                        <td>Safari</td>
                                        <td>1,100</td>
                                        <td>17%</td>
                                    </tr>
                                    <tr>
                                        <td>Edge</td>
                                        <td>982</td>
                                        <td>25%</td>
                                    </tr>
                                    <tr>
                                        <td>Opera</td>
                                        <td>967</td>
                                        <td>19%</td>
                                    </tr>
                                    <tr>
                                        <td>IE</td>
                                        <td>896</td>
                                        <td>12%</td>
                                    </tr>
                                    <tr>
                                        <td>Android Browser</td>
                                        <td>752</td>
                                        <td>27%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END BROWSERS -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END WEBSITE ANALYTICS -->
        <!-- SALES SUMMARY -->
        <div class="dashboard-section">
            <div class="section-heading clearfix">
                <h2 class="section-title"><i class="fa fa-shopping-basket"></i> Sales Summary</h2>
                <a href="#" class="right">View Sales Reports</a>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="panel-content">
                        <h3 class="heading"><i class="fa fa-square"></i> Today</h3>
                        <ul class="list-unstyled list-justify large-number">
                            <li class="clearfix">Earnings <span>$215</span></li>
                            <li class="clearfix">Sales <span>47</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel-content">
                        <h3 class="heading"><i class="fa fa-square"></i> Sales Performance</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Last Week</th>
                                            <th>This Week</th>
                                            <th>Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Earnings</th>
                                            <td>$2752</td>
                                            <td><span class="text-info">$3854</span></td>
                                            <td><span class="text-success">40.04%</span></td>
                                        </tr>
                                        <tr>
                                            <th>Sales</th>
                                            <td>243</td>
                                            <td>
                                                <div class="text-info">322</div>
                                            </td>
                                            <td><span class="text-success">32.51%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div id="chart-sales-performance">Loading ...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SALES SUMMARY -->
        <!-- CAMPAIGN -->
        <div class="dashboard-section">
            <div class="section-heading clearfix">
                <h2 class="section-title"><i class="fa fa-flag-checkered"></i> Campaign</h2>
                <a href="#" class="right">View All Campaigns</a>
            </div>
            <div class="panel-content">
                <div class="row margin-bottom-15">
                    <div class="col-md-8 col-sm-7 left">
                        <div id="demo-line-chart" class="ct-chart"></div>
                    </div>
                    <div class="col-md-4 col-sm-5 right">
                        <div class="row margin-bottom-30">
                            <div class="col-xs-4">
                                <p class="text-right text-larger"><span class="text-muted">Impression</span>
                                    <br><strong>32,743</strong></p>
                            </div>
                            <div class="col-xs-4">
                                <p class="text-right text-larger"><span class="text-muted">Clicks</span>
                                    <br><strong>1423</strong></p>
                            </div>
                            <div class="col-xs-4">
                                <p class="text-right text-larger"><span class="text-muted">CTR</span>
                                    <br><strong>4,34%</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <p class="text-right text-larger"><span class="text-muted">Cost</span>
                                    <br><strong>$42.69</strong></p>
                            </div>
                            <div class="col-xs-4">
                                <p class="text-right text-larger"><span class="text-muted">CPC</span>
                                    <br><strong>$0,03</strong></p>
                            </div>
                            <div class="col-xs-4">
                                <p class="text-right text-larger"><span class="text-muted">Budget</span>
                                    <br><strong>$200</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <a href="#" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Budget</a> <a href="#" class="btn btn-default"><i class="fa fa-file-text-o"></i> View Campaign Details</a>
                </div>
            </div>
        </div>
        <!-- END CAMPAIGN -->
        <!-- SOCIAL -->
        
    </div>
</div>
<!-- END MAIN CONTENT -->
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
<script src="assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js"></script>
<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
<script src="assets/vendor/chartist/js/chartist.min.js"></script>
<script src="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>
<script src="assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js"></script>
<script src="assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js"></script>
<script src="assets/vendor/toastr/toastr.js"></script>
<script src="assets/scripts/common.js"></script>
<!-- MDBootstrap Datatables  -->

<script>
    $(function() {

        // sparkline charts
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


        // traffic sources
        var dataPie = {
            series: [45, 25, 30]
        };

        var labels = ['Direct', 'Organic', 'Referral'];
        var sum = function(a, b) {
            return a + b;
        };

        new Chartist.Pie('#demo-pie-chart', dataPie, {
            height: "270px",
            labelInterpolationFnc: function(value, idx) {
                var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
                return labels[idx] + ' (' + percentage + ')';
            }
        });


        // progress bars
        $('.progress .progress-bar').progressbar({
            display_text: 'none'
        });

        // line chart
        var data = {
            labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            series: [
                [200, 380, 350, 480, 410, 450, 550],
            ]
        };

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
                        axisTitle: 'Day',
                        axisClass: 'ct-axis-title',
                        offset: {
                            x: 0,
                            y: 50
                        },
                        textAnchor: 'middle'
                    },
                    axisY: {
                        axisTitle: 'Reach',
                        axisClass: 'ct-axis-title',
                        offset: {
                            x: 0,
                            y: -10
                        },
                    }
                })
            ]
        };

        new Chartist.Line('#demo-line-chart', data, options);


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


        // notification popup
        // toastr.options.closeButton = true;
        // toastr.options.positionClass = 'toast-bottom-right';
        // toastr.options.showDuration = 1000;
        // toastr['info']('Hello, welcome to DiffDash, a unique admin dashboard.');

    });
</script>
</body>

</html>
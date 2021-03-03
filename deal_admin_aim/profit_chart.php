<?php
require_once('../db.php');
    $select_all = prep_stmt("SELECT * FROM income_ratio");
    $dataIncome = array();
    for($i = 1; $i <= mysqli_num_rows($select_all); $i++){
        $row = mysqli_fetch_array($select_all);
        //$data = date("d-M", strtotime($row['date_time']));
        $dataIncome[] = $row['profit'];
    }
    $profits = "";
    foreach($dataIncome as $price) {
        $profits .= $price.",";
    }
    $profits = rtrim($profits, ",");
$chartData = <<<JS
        var data = {
            labels: ["mon", "tues", "wed"],
            series: [
                [$profits],
            ]
        };
JS; 
echo $chartData;
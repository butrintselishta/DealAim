<?php
require "db.php";
if(session_destroy()){
    session_regenerate_id(); //veç per siguri, peace
    header("location:signin.php");
}
?>

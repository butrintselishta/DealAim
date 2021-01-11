<?php
require "db.php";
if(session_destroy()){
    header("location:index.php");
}
?>
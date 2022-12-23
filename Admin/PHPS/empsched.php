<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    ob_start();
    session_start();

$userid =  $_POST["userid"];
//sunday
    if (empty($_POST["sun1"]) and empty($_POST["sun2"])) {
        $sunday = "OFF";
    }else{
        $sunday = $_POST["sun1"]." - ".$_POST["sun2"];
    }
//monday
    if (empty($_POST["mon1"]) and empty($_POST["mon2"])) {
        $monday = "OFF";
    }else{
        $monday = $_POST["mon1"]." - ".$_POST["mon2"];
    }
//Tuesday
    if (empty($_POST["tue1"]) and empty($_POST["tue2"])) {
        $tuesday = "OFF";
    }else{
        $tuesday = $_POST["tue1"]." - ".$_POST["tue2"];
    }
//Wednesday
    if (empty($_POST["wed1"]) and empty($_POST["wed2"])) {
        $wednesday = "OFF";
    }else{
        $wednesday = $_POST["wed1"]." - ".$_POST["wed2"];
    }
//Thursday
    if (empty($_POST["thur1"]) and empty($_POST["thur2"])) {
        $thursday = "OFF";
    }else{
        $thursday = $_POST["thur1"]." - ".$_POST["thur2"];
    }
//Friday
    if (empty($_POST["fri1"]) and empty($_POST["fri2"])) {
        $friday = "OFF";
    }else{
        $friday = $_POST["fri1"]." - ".$_POST["fri2"];
    }
//Saturday
    if (empty($_POST["sat1"]) and empty($_POST["sat2"])) {
        $saturday = "OFF";
    }else{
        $saturday = $_POST["sat1"]." - ".$_POST["sat2"];
    }









// sqlcode
$sqlcode = "UPDATE `ochade_sched` SET `Sunday` = '$sunday', `Monday` = '$monday', `Tuesday` = '$tuesday', `Wednesday` = '$wednesday', `Thursday` = '$thursday', `Friday` = '$friday', `Saturday` = '$saturday' WHERE `Emp_id` = $userid;";
mysqli_query($con, $sqlcode);


$_SESSION["alert"] = "Updated Successfully";
header("Location:../Admin.php?refc=Empsched.php");
exit;
ob_end_flush();


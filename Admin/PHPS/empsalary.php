<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

$arrval = "";


if (isset($_POST['paid'])) {

    $arrval = explode(":", $_POST['magicthingy']);

    $pagibig = number_format((float)$arrval[2] * 0.02, 2, '.', '') ;
    $philhealth = number_format((float)$arrval[2] * 0.04, 2, '.', '');
    $sss = number_format((float)$arrval[2]  * 0.045, 2, '.', '');

    $deduction = number_format((float)$pagibig, 2, '.', '') + number_format((float)$philhealth, 2, '.', '') + number_format((float)$sss, 2, '.', ''); 
    $datearr = explode("/", $arrval[0]);
    $net = number_format((float)$arrval[2], 2, '.', '') - number_format((float)$deduction, 2, '.', ''); // need to find the deduction

    $sqlcode ="INSERT INTO `ochade_salary` (`Salary_id`, `Emp_id`, `Earning_amount`, `Deduction_total`, `Net_salary`, `Pay_date`, `Salarydrange`, `Year`, `Month` ) 
    VALUES (NULL, '".$arrval[1]."', '".$arrval[2]."', '$deduction', '$net', CURRENT_DATE() , '".$arrval[0]."', '".$datearr[0]."', '".$datearr[1]."');";
    mysqli_query($con, $sqlcode);

    $_SESSION["ALERTMSG"] = "Updated Successfully";

    header("Location:../Admin.php?refc=Empsalary.php");
    exit;
    ob_end_flush();


}else if (isset($_POST['print'])){
    $arrval = explode("||", $_POST['magicthingy']);
    print_r($arrval);

}



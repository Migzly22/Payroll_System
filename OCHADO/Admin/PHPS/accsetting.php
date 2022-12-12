<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
if(isset($_POST["updatinguser"])){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mname = $_POST["mname"];

    $sqlcode = "UPDATE `ochado_admin` SET `Admin_fname` = '$fname', `Admin_mname` = '$mname', `Admin_lname` = '$lname'  WHERE `Admin_id` = 1;";
    mysqli_query($con, $sqlcode);
    header("Location:../Admin.php?refc=AccountSetting1.php&alert=Updated Successfully");
    exit;
    ob_end_flush();
}

if(isset($_POST["UpdateEmail"])){
    $email = $_POST["email"];
    $nemail = $_POST["nemail"];

    if($email == $nemail){
        $sqlcode = "UPDATE `ochado_admin` SET `Admin_email` = '$email'  WHERE `Admin_id` = 1;";
        mysqli_query($con, $sqlcode);
        header("Location:../Admin.php?refc=AccountSetting1.php&alert=Updated Successfully");
        exit;
        ob_end_flush();
    }else{
        header("Location:../Admin.php?refc=AccountSetting1.php&alert=Wrong Input Please Try Again");
        exit;
        ob_end_flush();
    }
    

    

}else if(isset($_POST["UpdatePassword"])){
    $password = $_POST["password"];
    $npassword = $_POST["npassword"];

    if($password == $npassword){
        $sqlcode = "UPDATE `ochado_admin` SET `Admin_password` = '$password'  WHERE `Admin_id` = 1;";
        mysqli_query($con, $sqlcode);
        header("Location:../Admin.php?refc=AccountSetting1.php&alert=Updated Successfully");
        exit;
        ob_end_flush();
    }else{
        header("Location:../Admin.php?refc=AccountSetting1.php&alert=Wrong Input Please Try Again");
        exit;
        ob_end_flush();
    }
}
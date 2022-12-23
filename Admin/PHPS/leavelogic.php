<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    session_start();
    ob_start();

    if(isset($_POST["Addbtn"])){
        echo "hi";
        $empid = $_POST["empid"];
        $ldetails = $_POST["ldetails"];
        $ldate = $_POST["ldate"];
        $lduration = $_POST["lduration"];
        $lstatus = $_POST["lstatus"];

        $sqlcode = "INSERT INTO `ochade_leave` 
            ( `Emp_id`, `Leave_dates`, `Leave_type`, `Leave_status`, `Duration`) VALUES 
            ( '$empid', '$ldate', '$ldetails', '$lstatus', '$lduration');";

        mysqli_query($con, $sqlcode);
        

        $_SESSION["msgreques"] = "Added Successfully";
        header("Location:../Admin.php?refc=Leaverep.php");
        exit;
        ob_end_flush();
    }


    if (isset($_POST['del'])){
        $ids = $_POST['deletethisid'];
        $sqlcode = "DELETE FROM ochade_leave WHERE Leave_id = '$ids';";
        mysqli_query($con, $sqlcode);

        $_SESSION["msgreques"] = "Deleted Successfully";
        header("Location:../Admin.php?refc=Leaverep.php");
        exit;
        ob_end_flush();

    }



?>
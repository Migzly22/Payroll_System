<?php
    ob_start();
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

        
    if(isset($_POST["Addbtn"])){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mname = $_POST["mname"];

        $dob = $_POST["dob"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $ids = $_POST["ids"];
        $position = $_POST["position"];
        $gender = $_POST["gender"];

        if ($ids == "NONE") {
            # if the user has a none
            $sqlcode = "INSERT INTO `ochado_employees` (`Emp_id`, `First_name`, `Last_name`, `Middle_name`, `Dob`, `Gender`, `Address`, `Email`, `Mobile`, `DOE`, `Position`, `Created`) 
            VALUES (NULL, '$fname', '$lname', '$mname', '$dob', '$gender', '$address', '$email', '$phone', current_timestamp(), '$position', current_timestamp());";
            mysqli_query($con, $sqlcode);


            header("Location:../Admin.php?refc=Empinfo.php&alert=Created Successfully");
            exit;
            ob_end_flush();
        }else{
            $sqlcode = "UPDATE `ochado_employees` 
            SET `First_name` = '$fname', `Last_name` = '$lname', `Middle_name` = '$mname', `Dob` = '$dob',
            `Address` = '$address', `Email` = '$email', `Mobile` = '$phone', `Position` = '$position' 
            WHERE `ochado_employees`.`Emp_id` = $ids;";
            mysqli_query($con, $sqlcode);

            echo "<script>alert('Information Has been Successfully Updated')</script>";

            header("Location:../Admin.php?refc=Empinfo.php&alert=Information Has been Successfully Updated");
            exit;
            ob_end_flush();
        }
        


    }else if (isset($_POST["deleteemployee"])){
        $ids = $_POST["ids"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $sqlcode = "DELETE FROM ochado_employees WHERE `Emp_id` = $ids;";
        mysqli_query($con,$sqlcode);
        echo "<script>alert('Details about $fname $lname  has been deleted')</script>";

        header("Location:../Admin.php?refc=Empinfo.php&alert=Details about $fname $lname  has been deleted");
        exit;
        ob_end_flush();
    }
<?php
    ob_start();
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    session_start();

        
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
            $sqlcodecheck = "SELECT * FROM `ochado_employees` WHERE Email = '$email';";
            $resultcheck = mysqli_query($con, $sqlcodecheck);
            if (mysqli_num_rows($resultcheck) > 0) {
                $_SESSION["alert"] = "The Email is  Already Taken";
                $_SESSION["icon"] = "info";
                $_SESSION["Header"] = "";
                header("Location:../Admin.php?refc=Empinfo.php&alert=Created Successfully");
                exit;
                ob_end_flush();
            }

            
            $sqlcode = "INSERT INTO `ochado_employees` (`Emp_id`, `First_name`, `Last_name`, `Middle_name`, `Dob`, `Gender`, `Address`, `Email`, `Mobile`, `DOE`, `Position`, `Created`) 
            VALUES (NULL, '$fname', '$lname', '$mname', '$dob', '$gender', '$address', '$email', '$phone', current_timestamp(), '$position', current_timestamp());";
            mysqli_query($con, $sqlcode);

            $sqlcode = "SELECT Emp_id FROM `ochado_employees` WHERE First_name = '$fname' AND Last_name = '$lname' AND Middle_name = '$mname';";
            $result = mysqli_query($con, $sqlcode);
            $rowsql = mysqli_fetch_assoc($result);

            $sqlcode1 = "INSERT INTO `ochade_sched` (`Sched_id`, `Emp_id`, `Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) 
            VALUES (NULL, '".$rowsql["Emp_id"]."', '11:00 - 21:00', '11:00 - 21:00', '11:00 - 21:00', '11:00 - 21:00', '11:00 - 21:00', '11:00 - 21:00', '11:00 - 21:00');";
            mysqli_query($con, $sqlcode1);

            $_SESSION["alert"] = "Created Successfully";
            $_SESSION["icon"] = "success";
            $_SESSION["Header"] = "Success!";
            header("Location:../Admin.php?refc=Empinfo.php&alert=Created Successfully");
            exit;
            ob_end_flush();
            
        }else{
            $sqlcodecheck = "SELECT * FROM `ochado_employees` WHERE Email = '$email';";
            $resultcheck = mysqli_query($con, $sqlcodecheck);
            if (mysqli_num_rows($resultcheck) > 0) {
                $_SESSION["alert"] = "The Email is  Already Taken";
                $_SESSION["icon"] = "info";
                $_SESSION["Header"] = "";
                header("Location:../Admin.php?refc=Empinfo.php&alert=Created Successfully");
                exit;
                ob_end_flush();
            }


            $sqlcode = "UPDATE `ochado_employees` 
            SET `First_name` = '$fname', `Last_name` = '$lname', `Middle_name` = '$mname', `Dob` = '$dob',
            `Address` = '$address', `Email` = '$email', `Mobile` = '$phone', `Position` = '$position' 
            WHERE `ochado_employees`.`Emp_id` = $ids;";
            mysqli_query($con, $sqlcode);


            $_SESSION["alert"] = "Information Has been Successfully Updated";
            $_SESSION["icon"] = "success";
            $_SESSION["Header"] = "Success!";
            header("Location:../Admin.php?refc=Empinfo.php");
            exit;
            ob_end_flush();
        }
        


    }else if (isset($_POST["deleteemployee"])){
        $ids = $_POST["ids"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $sqlcode = "DELETE FROM ochado_employees WHERE `Emp_id` = $ids;";
        mysqli_query($con,$sqlcode);

        $_SESSION["alert"] = "Details about $fname $lname  has been deleted";
        $_SESSION["icon"] = "success";
        $_SESSION["Header"] = "Success!";
        header("Location:../Admin.php?refc=Empinfo.php");
        exit;
        ob_end_flush();
    }
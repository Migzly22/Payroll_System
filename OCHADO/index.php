<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ochado Attendance</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./CSS/attendance2.css">

    <script src="./JS/attendance.js" defer></script>
</head>
<body>
    <div class="container">
        <div class=" d-flex justify-content-center p-3">
<?php
    
    $message = null;
    $error = false;


    if(isset($_POST['punchin'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $sqlcode = "SELECT * FROM `ochado_employees` WHERE First_name = '$fname' AND Last_name = '$lname'";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){

            $empcode = mysqli_fetch_assoc($result)['Emp_id'];

            $sqlcode = "SELECT * FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE AND Emp_id = '$empcode'";
            $result = mysqli_query($con,$sqlcode);

            if (mysqli_num_rows($result) > 0) {

                $message = "The user has already logged in";
                $error = true;

            }else{

                $sqlcode = "INSERT INTO ochado_attendance VALUES (NULL,'$empcode',CURRENT_DATE,CURRENT_TIME,NULL, NULL,NULL);";
                mysqli_query($con,$sqlcode);
                $sqlcode = "UPDATE ochado_attendance
                            SET Daysofweek =  CASE
                                    WHEN WEEKDAY(CURRENT_DATE) >= 4  THEN 'WEEKENDS'
                                    ELSE 'WEEKDAYS'
                                END
                            WHERE Attendance_date = CURRENT_DATE;";
                mysqli_query($con,$sqlcode);

            }
        }else{
            $message = "Incorrect information";
            $error = true;
        }



    }elseif(isset($_POST['punchout'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $sqlcode = "SELECT * FROM `ochado_employees` WHERE First_name = '$fname' AND Last_name = '$lname'";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){

            $empcode = mysqli_fetch_assoc($result)['Emp_id'];

            $sqlcode = "SELECT * FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE AND Emp_id = '$empcode'";
            $result = mysqli_query($con,$sqlcode);

            if (mysqli_num_rows($result) <= 0) {

                $message = "The user haven't logged in yet";
                $error = true;

            }else{
                $VALUE = mysqli_fetch_assoc($result)['Time_out'];

                if(is_null($VALUE)){//check if the employee already punched-out

                    $sqlcode = "UPDATE ochado_attendance 
                    SET Time_out = CURRENT_TIME, 
                    TimeStatus = CASE
                        WHEN Daysofweek = 'WEEKDAYS'  THEN IF (TIMEDIFF(Time_out, Time_in) >= '09:00:00', 
                                                            IF (TIMEDIFF(Time_out, Time_in) >= '09:30:00', 'OT', 'REGULAR')
                                                            , 'UNDERTIME') 
                        ELSE IF (TIMEDIFF(Time_out, Time_in) >= '11:00:00', 
                                IF (TIMEDIFF(Time_out, Time_in) >= '11:30:00', 'OT', 'REGULAR')
                                , 'UNDERTIME') 
                        END
                    WHERE Attendance_date = CURRENT_DATE AND Emp_id = '$empcode';";
                    mysqli_query($con,$sqlcode);

                    


                }else{

                    $message = "The user  has already logged out";
                    $error = true;

                }
                
                
            }
            
        }else{
            $message = "Incorrect information";
            $error = true;
        }
    }
?> 
            <form action="" class="formbox col-lg-5 col-md-7 col-sm-12 p-4 shadow-lg " method="post">
                <h4 class="text-center mb-3">OCHADO Employee Attendance</h4>

                <div class="magicn  mb-3 text-center
<?php
    if($message != null){
        if ($error) {
            echo "magice";
        }else{
            echo "magicv";
        }
    }
?>
                
                ">
                    <span>
<?php
    if(isset($message)){
        echo $message;
    }
?>
                    </span>
                </div>

                <div class="form-floating mb-3 "> <!-- is-invalid-->
                    <input type="text" class="form-control <?php if ($error){echo "is-invalid";} ?>" id="lname" name="lastname" onkeypress="requiredpattern(event)" placeholder="name@example.com" autocomplete="off" required>
                    <label for="lname">Lastname</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?php if ($error){echo "is-invalid";} ?>" id="fname" name="firstname" onkeypress="requiredpattern(event)" placeholder="name@example.com"  autocomplete="off" required>
                    <label for="fname">First name</label>
                </div>
                <div class="d-flex justify-content-between ms-auto">
                    <div>

                    </div>
                    <div>
                        <input type="submit" class=" btn btn-primary" id="punchin" name="punchin" value="Punchin">
                        <input type="submit" class=" btn btn-primary" id="punchout" name="punchout" value="Punchout">
                    </div>
                   
                </div>
                
            </form> 




        </div>
    </div>

</body>
</html>
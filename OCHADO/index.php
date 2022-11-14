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

    <link rel="stylesheet" href="./CSS/attendance.css">
</head>
<body>
    <div class="container">
        <div class=" d-flex justify-content-center p-3"> 
            <form action="" class="formbox col-lg-5 col-md-7 col-sm-12 p-4 shadow-lg " method="post">
                <h4 class="text-center mb-3">OCHADO Employee Attendance</h4>

                <div class="form-floating mb-3"> <!-- is-invalid-->
                    <input type="text" class="form-control" id="lname" name="lastname" placeholder="name@example.com" autocomplete="off" pattern="[A-Za-z]+" required>
                    <label for="lname">Lastname</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="fname" name="firstname" placeholder="name@example.com"  autocomplete="off" pattern="[A-Za-z]+" required>
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

            <?php
            



                if(isset($_POST['punchin'])){
                    $fname = $_POST['firstname'];
                    $lname = $_POST['lastname'];
                    $sqlcode = "SELECT * FROM `ochado_employees` WHERE First_name = '$fname' AND Last_name = '$lname'";
                    $result = mysqli_query($con,$sqlcode);

                    if (mysqli_num_rows($result) == 1){

                        $empcode = mysqli_fetch_assoc($result)['Emp_code'];

                        $sqlcode = "SELECT * FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE AND Emp_code = '$empcode'";
                        $result = mysqli_query($con,$sqlcode);

                        if (mysqli_num_rows($result) > 0) {

                            echo "Already Exist";//ERROR MESSAGE

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
                    }



                }elseif(isset($_POST['punchout'])){
                    $fname = $_POST['firstname'];
                    $lname = $_POST['lastname'];
                    $sqlcode = "SELECT * FROM `ochado_employees` WHERE First_name = '$fname' AND Last_name = '$lname'";
                    $result = mysqli_query($con,$sqlcode);

                    if (mysqli_num_rows($result) == 1){

                        $empcode = mysqli_fetch_assoc($result)['Emp_code'];

                        $sqlcode = "SELECT * FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE AND Emp_code = '$empcode'";
                        $result = mysqli_query($con,$sqlcode);

                        if (mysqli_num_rows($result) <= 0) {

                            echo "Doesnt Exist";//ERROR MESSAGE

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
                                WHERE Attendance_date = CURRENT_DATE AND Emp_code = 'OCH001';";
                                mysqli_query($con,$sqlcode);

                                


                            }else{

                                echo "Already Punched-out";

                            }
                            
                            
                        }
                        
                    }
                }
            ?>


        </div>
    </div>


</body>
</html>
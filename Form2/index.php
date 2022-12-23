<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script
    src="https://kit.fontawesome.com/64d58efce2.js"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../CSS/form.css" />
  <link rel="stylesheet" href="./CSS/additional.css" />
  <title>Log in & Attendance Form</title>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../JS/form1.js" defer></script>
</head>
<body>
<?php
    if(isset( $_SESSION["ALERTMSG"])){
      echo "<script>
      Swal.fire(
          'Success!',
          '".$_SESSION["ALERTMSG"]."',
          'success'
      )
      </script>";
      unset($_SESSION["ALERTMSG"]);
    }


?>
    <div class="container <?php if(isset($_GET["mode"])){ echo $_GET["mode"];}?>">
      <div class="forms-container">
        <div class="signin-signup">
<!--Login Admin Logic-->
<?php
    if(isset($_POST['adminlogin'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sqlcode = "SELECT * FROM `ochado_admin` WHERE Admin_email = '$email' AND Admin_password = '$password'; ";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){
            $_SESSION["Login_Credits"] = "Admin";
            header("Location:../Admin/Admin.php");
        }else{
            echo "<script>
                          Swal.fire(
                              'Oops..',
                              'Incorrect information',
                              'error'
                          )
                          </script>";
        }
      }
?> 
          <!--Login Admin-->
          <form action="./index.php?" class="sign-in-form" method="post">
            <h2 class="title">Log in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <input type="submit" value="Login" class="btn solid" name="adminlogin"/>
            <!--Forgot Password-->
            <a href="./reset.php">Forgot Password?</a>
            <!--End Forgot Password-->
            <p class="social-text">A cup of tea is a cup of peace.</p>
          </form>
          <!--END Login Admin-->

<!--Attendance Logic-->
<?php
    $headermsg=  "";
    $message = "";
    $error = "";

    if(isset($_POST['punchin'])){
        $lname = $_POST['lastname'];
        $sqlcode = "SELECT * FROM `ochado_employees` WHERE Email = '$lname'";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){

            while($row =  mysqli_fetch_assoc($result)){
              $empcode = $row['Emp_id'];
              $name = $row["Last_name"].", ".$row["First_name"];

            }

            $sqlcode = "SELECT * FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE AND Emp_id = '$empcode'";
            $result = mysqli_query($con,$sqlcode);

            if (mysqli_num_rows($result) > 0) {

                $headermsg=  "Oops..";
                $message = "The user has already logged in";
                $error = "error";

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

                $headermsg=  "Success!";
                $message = $name." punched-in at ".date('h:i a', time());
                $error = "success";

            }
        }else{
            $headermsg=  "Oops..";
            $message = "Email Doesn't Exist";
            $error = "error";
        }

        echo "<script>
        Swal.fire(
            '$headermsg',
            '$message',
            '$error'
        )
        </script>";


    }elseif(isset($_POST['punchout'])){

        $lname = $_POST['lastname'];
        $sqlcode = "SELECT * FROM `ochado_employees` WHERE Email = '$lname'";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){

          while($row =  mysqli_fetch_assoc($result)){
            $empcode = $row['Emp_id'];
            $name = $row["Last_name"].", ".$row["First_name"];

          }

            $sqlcode = "SELECT * FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE AND Emp_id = '$empcode'";
            $result = mysqli_query($con,$sqlcode);

            if (mysqli_num_rows($result) <= 0) {
                $headermsg=  "Oops..";
                $message = "The user haven't logged in yet";
                $error = "error";

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

                  
                    $headermsg=  "Success!";
                    $message = $name." punched-out at ".date('h:i a', time());
                    $error = "success";

                }else{

                  $headermsg=  "Oops..";
                  $message = "The user  has already logged out";
                  $error = "error";

                }
            }
            
        }else{
          $headermsg=  "Oops..";
          $message = "Email Doesn't Exist";
          $error = "error";
        }

        echo "<script>
        Swal.fire(
            '$headermsg',
            '$message',
            '$error'
        )
        </script>";
    }


?> 
          <!--Attendance-->
          <form action="./index.php?mode=sign-up-mode" class="sign-up-form" method="post">
            <h2 class="title">Attendance</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="lastname" id="lname" required/>
            </div>

              <input type="submit" class="btn" value="Time-in"  name="punchin"/>
              <input type="submit" class="btn" value="Time-out" name="punchout"/>

            <p class="social-text">Step aside Monday… This is a job for tea.</p>
          </form>
          <!--END Attendance-->
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>OCHADO</h3>
            <p>
              From the two Japanese words, <span>OCHA</span> and <span>CHADO</span>, which mean <span>“Tea”</span> and <span>“Japanese way”</span>, this tea concept prides itself in brewing the best quality tea with the most natural and freshest ingredients which sets it apart from other bubble tea concepts.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Attendance
            </button>
          </div>
          <img src="img/register.jpg" class="image" alt="" /> <!--Login Ochado Logo-->
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>OCHADO</h3>
            <p>
              OCHADO started in <span>Singapore</span> in <span>2010</span> where the<br><span>“Japanese way”</span> of brewing tea has been popular<br>and loved by many tea-lovers.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Login 
            </button>
          </div>
          <img src="img/register.jpg" class="image" alt="" /> <!--Attendance Ochado Logo-->
        </div>
      </div>
    </div>


</body>
</html>

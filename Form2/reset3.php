<?php
  ob_start();
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./passwordcheck.js" defer></script>
  <link rel="stylesheet" href="./CSS/additional2.css" />
  <title>Log in & Attendance Form</title>
  <script src="../JS/form.js" defer></script>
</head>
<body>

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
<!--Login Admin Logic-->
<?php
    $Amessage = null;
    $Aerror = false;
    if(isset($_POST['resetpass'])){
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $email = $_SESSION["email"];
        
        if ($pass == $cpass) {
          $pass = md5($pass);
          $sqlcode = "UPDATE ochado_admin SET Admin_password = '$pass' WHERE Admin_email = '$email';";
          mysqli_query($con,$sqlcode);

          $_SESSION["ALERTMSG"] = "Updated Successfully";

          header("Location: ./index.php");
          exit;
          ob_end_flush();

        }else{
          echo "<script>
                  Swal.fire(
                      'Wrong Input!',
                      'Password Doesnt Match.',
                      'error'
                  )
                  </script>";
        }
        


  
      }
?> 
          <!--Login Admin-->
          <form action="#" class="sign-in-form" method="POST">
            <h2 class="title">Reset Password</h2>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="New Password" name="pass" id="password"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="cpass"/>
            </div>

            <input type="submit" value="Change Password" name="resetpass"  class="btn solid" id="changepasswordid"/>
            <!--Forgot Password-->
          </form>
          <!--END Login Admin-->
        </div>
      </div>

    </div>
</body>
</html>

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
  <link rel="stylesheet" href="./CSS/additional2.css" />
  <title>Log in & Attendance Form</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../JS/form.js" defer></script>
</head>
<body>
<?php
    $Amessage = null;
    $Aerror = false;
    if(isset($_POST['resetpass'])){
        
      if (isset($_POST['hiddengem']) && $_POST['hiddengem'] == "CorrectUTP") {
        # code...
        $utp = $_POST['hiddengem'];
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
      }else{
        echo "<script>
                  Swal.fire(
                      'Wrong Input!',
                      'Wrong UTP Code.',
                      'error'
                  )
                  </script>";
      }

    }
?> 
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

          <!--Login Admin-->
          <form action="#" class="sign-in-form" method="POST">
            <h2 class="title">Reset Password</h2>
            <small id="notifs">The UTP Code has been sent to your email. Please check your spam inbox</small>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="UTP CODE" name="utpcode" id="UTPid" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="New Password" name="pass" id="password" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="cpass" required/>
            </div>

            <input type="submit" value="Reset" name="resetpass" class="btn solid"/>
            <!--Forgot Password-->
          </form>
          <!--END Login Admin-->
        </div>
      </div>

    </div>


    <script type="text/javascript">
      $(document).ready(function(){
        $("#UTPid").on('change',function(){
            var value = $(this).val();
      
            $.ajax({
            url:"./ajaxnotif.php",
            type:"POST",
            data:'request=' + value,


            beforeSend:function(){
              $("#notifs").html("<span>Working ...</span>");
            },
            success:function(data){
              $("#notifs").html(data);
            }

                
            }); 
        });
    });
  </script>
</body>
</html>

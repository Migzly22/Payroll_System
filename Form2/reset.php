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
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        $email = $_POST['email'];
        $_SESSION["email"] = $email;
        
        $sqlcode = "SELECT * FROM `ochado_admin` WHERE Admin_email = '$email' ";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){
            $url = '../Message/Send.php';
            header('Location: '.$url);
            ob_flush();
          
        }else{
            $_SESSION["ALERTMSG"] = 'Email Doesnt Exist.';
            echo "<script>
                  Swal.fire(
                      'Wrong Input!',
                      'Email Doesnt Exist.',
                      'error'
                  )
                  </script>";
        }
      }
?> 

<!--Login Admin Logic-->
          <!--Login Admin-->
          <form action="#" class="sign-in-form" method="POST">
            <h2 class="title">Reset Password</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <input type="submit" value="Send UTP code" name="resetpass" class="btn solid"/>
            <!--Forgot Password-->
          </form>
          <!--END Login Admin-->
        </div>
      </div>

    </div>
</body>
</html>

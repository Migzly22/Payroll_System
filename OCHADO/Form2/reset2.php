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
        $code = $_POST['utpcode'];
        $email = $_SESSION["email"];
        
        $sqlcode = "SELECT * FROM `ochado_admin` WHERE Admin_email = '$email' AND UTP = '$code';";
        $result = mysqli_query($con,$sqlcode);

        if (mysqli_num_rows($result) == 1){
            $url = './reset3.php';
            header('Location: '.$url);
            ob_flush();
          
        }else{
            $Amessage = "Incorrect information";
            $Aerror = true;
        }

  
      }
?> 
          <!--Login Admin-->
          <form action="#" class="sign-in-form" method="POST">
            <h2 class="title">Reset Password</h2>
            <!--Error Notif-->
            <?php
                  if(isset($Amessage) && $Aerror == true){
                    echo "<div class='alert'>
                            <span class='closebtn' onclick='ex(this)'>&times;</span> 
                            <strong>".$Amessage."!</strong>
                          </div>";
                  }elseif(isset($Amessage) && $Aerror == false){
                    echo "<div class='alertgood'>
                      <span class='closebtn' onclick='ex(this)'>&times;</span> 
                      <strong>".$Amessage."</strong>
                    </div>";
                  }
            ?>  
            <!--Error Notif-->

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="UTP CODE" name="utpcode"/>
            </div>

            <input type="submit" value="Verify UTP code" name="resetpass" class="btn solid"/>
            <!--Forgot Password-->
          </form>
          <!--END Login Admin-->
        </div>
      </div>

    </div>
</body>
</html>

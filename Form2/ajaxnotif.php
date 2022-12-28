<?php
    ob_start();
    session_start();
    
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $utp = $_POST["request"];
    $email = $_SESSION["email"];

    $sqlcode = "SELECT * FROM `ochado_admin` WHERE Admin_email = '$email' AND UTP = '$utp';";
    $result = mysqli_query($con,$sqlcode);

    if (mysqli_num_rows($result) == 1){
        echo "<input type='hidden' name='hiddengem' value='CorrectUTP'>";
      
    }else{
      echo "<script>
            Swal.fire(
                'Wrong Input!',
                'Wrong UTP Code.',
                'error'
            )
            </script>";
    }
?>

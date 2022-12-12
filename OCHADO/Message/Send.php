<?php
ob_start();
session_start();

require("../DATABASE/db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$random = rand(10000,99999);
$email = $_SESSION['email'];

// updating ADMINS UTP
$sqlcode = "UPDATE ochado_admin SET UTP = '$random' WHERE Admin_email = '$email';";
mysqli_query($con,$sqlcode);





  $mail = new PHPMailer();
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls"; //ssl
  $mail->Host       = "smtp.gmail.com";
  $mail->Port       = 587;
  $mail->IsHTML(true);
  $mail->IsSMTP();
  $mail->SMTPDebug  = 0;  
  $mail->CharSet='UTF-8';
  $mail->Username   = "noncre123@gmail.com";//pinalitan ko
  $mail->Password   = "mgbjwrnkdjsocbdb";//pinalitan ko
  $mail->SetFrom('noncre123@gmail.com','OchadoITDept');
  $mail->SMTPOptions = array(
  'ssl' => [
  'verify_peer' => false,
  'verify_depth' => false,
  'allow_self_signed' => false,
  'verify_peer_name' => false,
  ]
  );
  $mail ->Subject = 'Ochado Admin Password Reset';
  $mail ->AddAddress("noncre123@gmail.com","testing");
  $timepers = "  <style>
  @import url('https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap');
a {
color: #3869D4;
}

a img {
border: none;
}

td {
word-break: break-word;
}

.preheader {
display: none !important;
visibility: hidden;
mso-hide: all;
font-size: 1px;
line-height: 1px;
max-height: 0;
max-width: 0;
opacity: 0;
overflow: hidden;
}
/* Type ------------------------------ */

body,
td,
th {
font-family: 'Nunito Sans', Helvetica, Arial, sans-serif;
}

h1 {
margin-top: 0;
color: #333333;
font-size: 22px;
font-weight: bold;
text-align: left;
}

h2 {
margin-top: 0;
color: #333333;
font-size: 16px;
font-weight: bold;
text-align: left;
}

h3 {
margin-top: 0;
color: #333333;
font-size: 14px;
font-weight: bold;
text-align: left;
}

td,
th {
font-size: 16px;
}

p,
ul,
ol,
blockquote {
margin: .4em 0 1.1875em;
font-size: 16px;
line-height: 1.625;
}

p.sub {
font-size: 13px;
}

body {
background-color: #F2F4F6;
color: #51545E;
}

p {
color: #51545E;
}

.email-wrapper {
width: 100%;
margin: 0;
padding: 0;
-premailer-width: 100%;
-premailer-cellpadding: 0;
-premailer-cellspacing: 0;
background-color: #F2F4F6;
}

.email-content {
width: 100%;
margin: 0;
padding: 0;
-premailer-width: 100%;
-premailer-cellpadding: 0;
-premailer-cellspacing: 0;
}
/* Masthead ----------------------- */

.email-masthead {
padding: 25px 0;
text-align: center;
}

.email-masthead_logo {
width: 94px;
}

.email-masthead_name {
font-size: 26px;
font-weight: bold;
color: #A8AAAF;
text-decoration: none;
text-shadow: 0 1px 0 white;
}
/* Body ------------------------------ */

.email-body {
width: 100%;
margin: 0;
padding: 0;
-premailer-width: 100%;
-premailer-cellpadding: 0;
-premailer-cellspacing: 0;
text-align: justify;
}

.email-body_inner {
width: 570px;
margin: 0 auto;
padding: 0;
-premailer-width: 570px;
-premailer-cellpadding: 0;
-premailer-cellspacing: 0;
background-color: #FFFFFF;
}

.email-footer {
width: 570px;
margin: 0 auto;
padding: 0;
-premailer-width: 570px;
-premailer-cellpadding: 0;
-premailer-cellspacing: 0;
text-align: center;
}

.email-footer p {
color: #A8AAAF;
text-align: center;
}

.body-action {
width: 100%;
margin: 30px auto;
padding: 0;
-premailer-width: 100%;
-premailer-cellpadding: 0;
-premailer-cellspacing: 0;
text-align: center;
}

.body-sub {
margin-top: 25px;
padding-top: 25px;
border-top: 1px solid #EAEAEC;
}

.content-cell {
padding: 45px;
}
.content-cell span{
font-weight: bold;
}
/*Media Queries ------------------------------ */

@media only screen and (max-width: 600px) {
.email-body_inner,
.email-footer {
  width: 100% !important;
}
}

@media (prefers-color-scheme: dark) {
body,
.email-body,
.email-body_inner,
.email-content,
.email-wrapper,
.email-masthead,
.email-footer {
  background-color: #333333 !important;
  color: #FFF !important;
}
p,
ul,
ol,
blockquote,
h1,
h2,
h3,
span,
.purchase_item {
  color: #FFF !important;
}
.attributes_content,
.discount {
  background-color: #222 !important;
}
.email-masthead_name {
  text-shadow: none !important;
}
}

:root {
color-scheme: light dark;
supported-color-schemes: light dark;
}
</style>
<span class='preheader'>Use this code to reset your password. The code is only valid for 24 hours.</span>
<table class='email-wrapper' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
<tr>
<td align ='center'>
  <table class='email-content' width='100%' cellpadding='0' cellspacing='0' role='presentation'>
    <!--Shop Name-->
    <tr>
      <td class='email-masthead'>
        <a href='' class='f-fallback email-masthead_name'>
        Ochado Bucandala
      </a>
      </td>
    </tr>
    <!--Shop Name End-->
    
    <!-- Email Body -->
    <tr>
      <td class='email-body' width='570' cellpadding='0' cellspacing='0'>
        <table class='email-body_inner' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
          <!-- Body content -->
          <tr>
            <td class='content-cell'>
              <div class='f-fallback'>
                <h1>Hello,</h1>
                <p >You recently <span>requested to reset your password</span> for your <span>Ochado Attendance</span> account. This password reset is only valid for the next <span>24 hours.</span></p>
                <!--Code-->
                <div class='shadow-none p-3 mb-5 bg-light rounded' style='background-color: black; color: white; text-align: center;'>Authentication Code : ".$random."</div>
                <!--End Code-->
           
                <p>For security, If you did not request a password reset, please ignore this email</p>
                <hr>
                <p>Thanks,
                  <br>The Ochado Bucandala Dev Team</p>
                <!-- Sub copy -->
              </div>
            </t d>
          </tr>
        </table>
      </td>
    </tr>
    <!--Email Body End-->

    <!--Footer-->
    <tr>
      <td>
        <table class='email-footer' align='center' width='570' cellpadding='0' cellspacing='0' role='presentation'>
          <tr>
            <td class='content-cell' align='center'>
              <p class='f-fallback sub align-center'>
                Ochado Bucandala,
                <br>Alapan 1C
                <br>Harvest Market
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!--End footer-->

  </table>
</td>
</tr>
</table>";
  $mail ->Body = $timepers;
  

  $mail ->send();
  $url = '../Form2/reset2.php';
  header('Location: '.$url);
  ob_flush();
?>

<?php

ob_start();

unset($_SESSION["Login_Credits"]);
header("Location:../Form2/index.php");
ob_end_flush();
exit;
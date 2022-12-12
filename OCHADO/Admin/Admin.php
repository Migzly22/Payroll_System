<?php
    ob_start();
    session_start();
    if (isset($_SESSION["Login_Credits"])) {
        if ($_SESSION["Login_Credits"] != "Admin") {
            header("Location:../Form2/index.php");
            ob_end_flush();
            exit;
        }
    }else{
        header("Location:../Form2/index.php");
        ob_end_flush();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7489440202.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7489440202.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../Admin/css/styles.css">
    <link rel="stylesheet" href="./css/admin2.css">


    
    <title>Employee Payroll</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <nav class="navbar navbar-expand-lg pt-3  px-4" style="background-color: #000">
                    <div class="d-flex align-items-center">
                        <a class="navbar-brand text-white" href="index.html">
                            <img src="logo.jpg" alt="" srcset="">

                        </a>
                    </div>
                </nav>
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <!--Dashboard-->
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="./Admin.php?refc=Dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <!--Employees-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Employees
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested ">
                                    <a class="nav-link" href="./Admin.php?refc=Empinfo.php">Employee Information</a>
                                    <a class="nav-link" href="./Admin.php?refc=Empsalary.php">Employee Salary</a>
                                    <a class="nav-link" href="./Admin.php?refc=Empattendance.php">Employee Attendance</a>
                                    <a class="nav-link" href="./Admin.php?refc=Empsched.php">Employee Schedule</a>
                                </nav>
                            </div>
                        
                            <!--Leave Report-->
                            <a class="nav-link collapsed" href="./Admin.php?refc=Leaverep.php" >
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                                Leave Report
                            </a>
                            
                            <!--User Setting-->
                            <a class="nav-link" href="Admin.php?refc=Costrep.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                                Cost Report
                            </a>
                            <a class="nav-link" href="./Admin.php?refc=AccountSetting1.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                                User Setting
                            </a>
                            <a class="nav-link" href="./Admin.php?refc=logout.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php
                if(isset($_GET["refc"])){
                    $reflink = $_GET["refc"];
                }else{
                    $reflink ="Dashboard.php";
                }
                
                include($reflink);
            ?>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>

</body>

</html>
<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    //session_start();

    $sqlcode = "SELECT COUNT(*) AS Present , CURRENT_DATE() AS Datenow FROM `ochado_attendance` WHERE Attendance_date = CURRENT_DATE();";
    $result  = mysqli_query($con, $sqlcode);

    $row = mysqli_fetch_assoc($result);

    $sqlcode = "SELECT COUNT(*) AS Late FROM `ochado_attendance` WHERE Time_in > '11:00:00' AND Attendance_date = CURRENT_DATE;";
    $result1  = mysqli_query($con, $sqlcode);
    $row1 = mysqli_fetch_assoc($result1);


    $sqlcode = "SELECT 
    CASE
        WHEN DAYOFWEEK(CURRENT_DATE()) = 1 THEN CURRENT_DATE() 
        ELSE CURRENT_DATE()-(DAYOFWEEK(CURRENT_DATE())-1)
    END AS SW,
    CASE
        WHEN DAYOFWEEK(CURRENT_DATE()) = 7 THEN CURRENT_DATE() 
        ELSE CURRENT_DATE() + (7- DAYOFWEEK(CURRENT_DATE()))
    END AS EW;";
    
    $result  = mysqli_query($con, $sqlcode);
    $dateval = mysqli_fetch_assoc($result);
    
    $starting =  $dateval["SW"];
    $end =  $dateval["EW"];

    $sqlcode = "SELECT DAYOFWEEK(Attendance_date) AS Keyday, COUNT(*) as Numbers FROM ochado_attendance WHERE Attendance_date >= '$starting' AND Attendance_date <= '$end' GROUP BY Attendance_date;";
    
    $result1  = mysqli_query($con, $sqlcode);
    $inputs = "";
    $i = 1; 

    if ($result1-> num_rows > 0) {
        while($rowspecial = $result1->fetch_assoc()) {
            for ($i; $i <= 7 ; $i++) { 
                if ($i == $rowspecial["Keyday"]) {
                    $inputs = $inputs.$rowspecial["Numbers"].",";
                    $i = $i+1;
                    break;
                }else{
                    $inputs = $inputs."0,";
                }
            }
        }
    } else {
        
    }
        
    

?>



<link rel="stylesheet" href="./css/dashboard1.css">
<link rel="stylesheet" href="./Tyler/dashboard1_up.css">

<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0 text-white" id="Title">Dashboard</h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<section class=" px-4 sect active" id="s1">
    <div class="row g-3 my-2">
        <div class="col-md-4">
            <div class="p-3 boxbox shadow-lg d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?php echo $row["Present"]; ?></h3>
                    <p class="fs-5">Present </p>
                </div>
                <i class="fa-solid fa-user-check fs-1 iboxbox   secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 boxbox shadow-lg d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?php echo $row1["Late"]; ?></h3>
                    <p class="fs-5">Late</p>
                </div>
                <i class="fas fa-user-xmark fs-1 iboxbox   secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 boxbox shadow-lg d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?php echo $row["Datenow"]; ?></h3>
                    <p class="fs-5">Date</p>
                </div>
                <i class="fas fa-calendar fs-1 iboxbox   secondary-bg p-3"></i>
            </div>
        </div>
    </div>
    <div>
        <input type="hidden" id="inputsdata" value="<?php echo $inputs?>">
        <div class="canvas container">
            <canvas id="myChart" class="px-5"></canvas>
        </div>
    </div>

</section>

<script>
        const valuesin = document.getElementById('inputsdata').value
        let myArray = valuesin.split(",");



        const ctx = document.getElementById('myChart');
        Chart.defaults.backgroundColor = 'pink';
        Chart.defaults.font.size = 18;
        Chart.defaults.color = '#000';
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: [ "Sun",'Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat'],
            datasets: [{
                label: '# of On-time-Employees',
                data: myArray,
                backgroundColor:'#1f7953'
            }]
            },
            options: {
                plugins: {
                title: {
                    display: true,
                    text: 'Weekly Attendance'
                }
            },
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
        </script>

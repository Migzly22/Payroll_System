<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong


    $magicsdate = date_create("12/05/2022");
    $datetoday = date("Y/m/d");
    $date2 = date_create($datetoday);
    
    //check the difference between the date today and the starting date
    $diff = date_diff($magicsdate,$date2)->format("%a");

    $diffmod = $diff / 15;
    $startingdatepay = "";
    $enddatepay = "";

    if ((int) $diffmod == 0) {
        $startingdatepay = $magicsdate;
        $testing = $startingdatepay->format('Y/m/d');
    }else{
        $startingdatepay =  date('Y/m/d',strtotime("+".((((int)$diffmod)*15))." day", strtotime('12/05/2022')));
        $testing = $startingdatepay;
    }

    $enddatepay = date('Y/m/d',strtotime("+15 day", strtotime($testing)));
    
    $todaydaterange = $testing." - ".$enddatepay;


    // for the arrays related in the range of date
    function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];
            
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
             
        for ($currentDate = $startDate; $currentDate <= $endDate; 
                                        $currentDate += (86400)) {
                                                
            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }
  
        return $rangArray;
    }
  
    $datearr = getBetweenDates($testing, $enddatepay);

    //print_r($datearr);
    
    $news =  $testing; // transform date into string



    //call if there is a alertmessage
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

<link rel="stylesheet" href="./css/empsalary1.css">
<link rel="stylesheet" href="./Tyler/empsalary _up.css">
<script src="./js/empsalary1.js" defer></script>

<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">Employee Salary Report</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <section class=" px-4 sect active" id="s1">
                <form class="toppart d-flex justify-content-between my-3" method="post">
                    <div class="d-flex">
                    <input class="form-control me-2" type="search" id="searching" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="button" id="searchingbtn"><i class="fas fa-magnifying-glass"></i></button>
                    </div>
                    <div class="d-flex">
                        <select class="form-select" aria-label="Default select example" id="selectiondate">
                            <option value="<?php echo $todaydaterange; ?>" selected><?php echo $todaydaterange; ?></option>
                        </select>
                    </div>
                </form>

                <form action="" class="lowerpart" method="post" id="formprint" target="">
                    <table class="table table-dark" id="specialtable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" class='text-center'>Working Hrs</th>
                                <th scope="col" class='text-center'>Payment Per Hour</th>
                                <th scope="col" class='text-center'>Deduction</th>
                                <th scope="col" class='text-center'>Total Salary</th>
                                <th scope="col" >Status</th>
                                <th scope="col">Payslip</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sqlcode = "SELECT CONCAT(b.Last_name, ', ', b.First_name) AS names, c.Salaryperhour ,a.Emp_id, 
                                HOUR(SEC_TO_TIME(
                                    SUM(
                                    TIME_TO_SEC(
                                        if (TIMEDIFF(a.Time_out, a.Time_in) < '01:00:00',TIMEDIFF(a.Time_out, a.Time_in),TIMEDIFF(TIMEDIFF(a.Time_out, a.Time_in), '01:00:00'))
                                    )))) AS Hours,
                                    MINUTE(SEC_TO_TIME(
                                        SUM(
                                        TIME_TO_SEC(
                                            if (TIMEDIFF(a.Time_out, a.Time_in) < '01:00:00',TIMEDIFF(a.Time_out, a.Time_in),TIMEDIFF(TIMEDIFF(a.Time_out, a.Time_in), '01:00:00'))
                                        )))) AS minutes  
                                FROM ochado_attendance a, ochado_employees b, ochado_earning c
                                WHERE Attendance_date >= '$news' AND Attendance_date <= '$enddatepay' AND b.Position = c.Position AND a.Emp_id = b.Emp_id AND Time_out != 'NULL' GROUP BY a.Emp_id ORDER BY a.Attendance_date ASC;";
                                $result = mysqli_query($con, $sqlcode);
                                $tr = "";
                                $i = 0;
                                           
                                if ( mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $i++;
                                        $num_padded = sprintf("%02d", $row["minutes"]);
                                        $workinghours = $row["Hours"].".".$num_padded;


                                        $totalsalary = number_format((float) $workinghours * (float)$row["Salaryperhour"], 2, '.', '') ;

                                        
                                        $pagibig = $totalsalary * 0.02;
                                        $philhealth = $totalsalary * 0.04;
                                        $sss = $totalsalary * 0.045;
                                    
                                        $deduction = number_format((float)$pagibig + (float)$philhealth + (float)$sss, 2, '.', '')  ; 

                                        $netsalary =number_format($totalsalary - $deduction, 2, '.', '') ;

                                        $tr .= "<tr>
                                                <th scope='row'>$i</th>
                                                <td>".$row["names"]."</td>
                                                <td class='text-center'>".$workinghours."</td>
                                                <td class='text-center'>".$row["Salaryperhour"]."</td>
                                                <td class='text-center'>".$deduction."</td>
                                                <td class='text-center'>".$netsalary."</td>";

                                        $disabledactive = "false";

                                        $sqlcode1 = "SELECT * FROM ochade_salary WHERE Emp_id = ".$row["Emp_id"]." AND Salarydrange = '$todaydaterange';";
                                        $result1 = mysqli_query($con, $sqlcode1);

                                        if (mysqli_num_rows($result1) > 0) {
                                            $disabledactive = "disabled";
                                        }


                                        $tr .=  "<td class='text-center'>
                                                    <input type='button'  value='Paid' id='".$todaydaterange.":".$row["Emp_id"].":".$totalsalary."' $disabledactive class='btn btn-success'>
                                                </td>
                                                <td class='text-center'>
                                                    <input type='hidden' name='printid' value='".$row["Emp_id"]."'>
                                                    <input type='button' name='print' id='".$todaydaterange."||".$row["Emp_id"]."||".$totalsalary."||".$row["names"]."||".$row["Salaryperhour"]."||$workinghours' value='Print'  class='btn btn-success'>
                                                </td>
                                            </tr>";


                                    }
                                    echo $tr;
                                }else{
                                    echo "<tr><td colspan = '8' class='text-center'>No Data</td></tr>";
                                }
                            ?>
                            <input type='hidden' name='magicthingy' id='magicthingyid' value = ''>   
                            <input type="submit" style="display: none;" name="paid" id="paidid">    
                            <input type="submit" style="display: none;" name='print' id="printid">        
                        </tbody>
                    </table>
                </form>
            </section>
</nav>

<script>
    const selectiond = document.querySelector("#selectiondate")
    let selectedd = document.getElementById("selectiondate").value;
    let datearr = selectedd.split(" - ");

    console.log(datearr);
    let testd = datearr[0]

    let a = [];
    for (let i = 0; i < 3; i++) {
        let d = new Date(testd);
        d.setDate(d.getDate() -15);

        let datezero = d.getDate() > 0 && d.getDate() <=9 ? "0"+d.getDate() : d.getDate()

        let val1 =  d.getFullYear()+ "/" + (d.getMonth()+1)+ "/" + datezero

        a[i] = [val1, testd]
        testd = val1
    }
    for (let j = 0; j < a.length; j++) {

        let option = new Option(a[j][0] + " - " + a[j][1],a[j][0] + " - " + a[j][1]);
        selectiond.add(option, undefined);
    }

    /*
        let d = new Date(testd);
        console.log('Today is: ' + d.toLocaleString());
        d.setDate(d.getDate() -15);
        console.log('3 days ago was: ' + d.toLocaleString().split(",")[0]);
    */
</script>


<script type="text/javascript">
      $(document).ready(function(){
        $("#selectiondate").on('change',function(){
            var value = $(this).val();
            var value1 = $("#searching").val();

            $.ajax({
            url:"./PHPS/empsalarysearch.php",
            type:"POST",
            data:'request=' + value +'&searchreq=' + value1,


            beforeSend:function(){
            $("#specialtable").html("<span>Working ...</span>");
                },
            success:function(data){
            $("#specialtable").html(data);
                }

                
            }); 
        });

        $("#searching").on('change',function(){
            var value = $(this).val();
            var value1 = $("#selectiondate").val();


            $.ajax({
            url:"./PHPS/empsalarysearch.php",
            type:"POST",
            data: 'request=' + value1 +'&searchreq=' + value,


            beforeSend:function(){
            $("#specialtable").html("<span>Working ...</span>");
                },
            success:function(data){
            $("#specialtable").html(data);
                }

            
            }); 
        });

        $("#searchingbtn").on('click',function(){
            var value = $("#searching").val();
            var value1 = $("#selectiondate").val();
            //alert(value);

            $.ajax({
            url:"./PHPS/empsalarysearch.php",
            type:"POST",
            data:'request=' + value1 +'&searchreq=' + value,


            beforeSend:function(){
            $("#specialtable").html("<span>Working ...</span>");
                },
            success:function(data){
            $("#specialtable").html(data);
                }

                
            }); 

        });


    });
</script>
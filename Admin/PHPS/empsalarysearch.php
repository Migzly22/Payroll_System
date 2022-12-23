<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $request = $_POST["request"];
    $requestarr = explode("-",$request);





    $magicsdate = date_create($requestarr[0]);
    $datetoday = date("Y/m/d");
    $date2 = date_create($datetoday);
    
    //check the difference between the date today and the starting date
    $diff = date_diff($magicsdate,$date2)->format("%a");

    if ($diff > 15 ) {
        $diff = 15;
    }


    $diffmod = $diff / 20;
    $startingdatepay = $requestarr[0];
    $enddatepay = $requestarr[1];

    $todaydaterange = strval($startingdatepay."-".$enddatepay);

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
  
    $datearr = getBetweenDates($startingdatepay,$enddatepay);

    #print_r($datearr)
    


?>

<table class="table table-hover" id="specialtable">
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
                                $sqlcode = "";
                                if(isset($_POST["searchreq"]) and $_POST['searchreq'] != ""){
                                    $searchreq = $_POST["searchreq"];
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
                                    WHERE Attendance_date >= '$startingdatepay' AND Attendance_date <= '$enddatepay' AND b.Position = c.Position AND a.Emp_id = b.Emp_id AND Time_out != 'NULL' AND (b.First_name LIKE '%$searchreq%' 
                                    OR b.Last_name LIKE '%$searchreq%' 
                                    OR b.Middle_name LIKE '%$searchreq%' )
                                    GROUP BY a.Emp_id ORDER BY a.Attendance_date ASC;";

                                }else{
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
                                    WHERE Attendance_date >= '$startingdatepay' AND Attendance_date <= '$enddatepay' AND b.Position = c.Position AND a.Emp_id = b.Emp_id AND Time_out != 'NULL' GROUP BY a.Emp_id ORDER BY a.Attendance_date ASC;";
                                }
                                

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

                                        $disabledactive = "1";
     


                                        $sqlcode2 = "SELECT * FROM ochade_salary WHERE Emp_id = ".$row['Emp_id']." AND Salarydrange = '$todaydaterange';";
                                        $result2 = mysqli_query($con, $sqlcode2);

                                        if (mysqli_num_rows($result2) > 0) {
                                            $disabledactive = "disabled";
                                        }


                                        $tr .=  "<td class='text-center'>
                                                    <input type='button'  value='Paid' id='".$todaydaterange.":".$row["Emp_id"].":".$totalsalary."' $disabledactive class='btn btn-success'>
                                                </td>
                                                <td class='text-center'>
                                                    <input type='hidden' name='printid' value='".$row["Emp_id"]."'>
                                                    <input type='button' name='print' id='".$todaydaterange."||".$row["Emp_id"]."||".$totalsalary."||".$row["names"]."||".$row["Salaryperhour"]."||workinghours' value='Print'  class='btn btn-success'>
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
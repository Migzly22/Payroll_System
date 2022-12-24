<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $request = $_POST["request"];
    $requestarr = explode("-",$request);





    $magicsdate = date_create($requestarr[0]);
    $datetoday = date("Y/m/d");

    $dateender = $requestarr[1];



    $date2 = date_create($datetoday);
    
    //check the difference between the date today and the starting date
    $diff = date_diff($magicsdate,$date2)->format("%a");

    if ($diff > 15 ) {
        $diff = 15;
    }


    $diffmod = $diff / 20;
    $startingdatepay = $requestarr[0];
    $enddatepay = $requestarr[1];

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

<table class="table" id="specialtable">
    <tr>
        <th>Employee Name</th>
        <div>
            <?php
                $ths = "";
                for ($j=0; $j < count($datearr) ; $j++) { 
                    $ths .= "<th>$datearr[$j]</th>";
                }
                echo $ths;
            ?>

        </div>

    </tr>
    <?php
        $sqlcode = "";
        if(isset($_POST["searchreq"])){
            $searchreq = $_POST["searchreq"];
            $sqlcode = "SELECT Emp_id, CONCAT(Last_name, ', ', First_name) AS Names  FROM ochado_employees WHERE First_name LIKE '%$searchreq%' 
                        OR Last_name LIKE '%$searchreq%' 
                        OR Middle_name LIKE '%$searchreq%' 
                        OR Dob LIKE '%$searchreq%' 
                        OR Gender LIKE '%$searchreq%' 
                        OR Address LIKE '%$searchreq%' 
                        OR Email LIKE '%$searchreq%' 
                        OR Mobile LIKE '%$searchreq%' 
                        OR DOE LIKE '%$searchreq%' 
                        OR Position LIKE '%$searchreq%';";
        }else{
            $sqlcode = "SELECT Emp_id, CONCAT(Last_name, ', ', First_name) AS Names FROM ochado_employees ORDER BY Last_name;";
        }


        
        $result = mysqli_query($con,$sqlcode);

        
        $trs = ""; // contains all of the tr tag
        if ($result-> num_rows > 0) {
            while($rowid = $result->fetch_assoc()) {
            //setting variables
                $temparr = $datearr;
                $id = $rowid['Emp_id'];
                $name = $rowid['Names'];

                $trs .= "<tr> <td>$name</td>";

                $sqlcode = "SELECT Attendance_date FROM ochado_attendance WHERE Attendance_date >= '$startingdatepay' AND Attendance_date <= '$enddatepay' AND Emp_id = '$id'  AND Time_out != 'NULL'
                ORDER BY `ochado_attendance`.`Attendance_date` ASC;";
                $result1 = mysqli_query($con,$sqlcode);                              
                

                if ($result1-> num_rows > 0) {
                    $i = 0;
                    $lastdate = ""; // tells the last date employee enters work
                    while($rowdate = $result1->fetch_assoc()) {

                        for ($i; $i < count($datearr) ; $i++) { 
                            if ($datearr[$i] == $rowdate["Attendance_date"]) {
                                $trs .="<td class='text-center present text-success'>✓</td>";
                                $i += 1;
                                break;
                            }else{
                                $trs .="<td class='text-center absent'>✗</td>";
                            }
                        }
                        $lastdate = $rowdate["Attendance_date"];
                    }
                    $maindiff = date_diff(date_create($lastdate),date_create($datetoday))->format("%a");

                    $boo = date_diff(date_create($startingdatepay),date_create($datetoday))->format("%a");
                    if ((int)($boo/15) == 0){
                        for ($i=0; $i <= $maindiff -1  ; $i++) { 
                            $trs .="<td class='text-center absent'>✗</td>";
                        }
                    }

                }else{
                    for ($i=0; $i < $diff +1 ; $i++) { 
                        $trs .="<td class='text-center absent'>✗</td>";
                    }
                }
                $trs .="</tr>";
            }   
            echo $trs;//print the $trs
        } else {
            echo "<tr><td colspan='17' class='text-center'>No Data </td></tr>";
        }
        
    ?>
</table>
<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $todayyear = $_POST['request'];


    $sqlcode = "SELECT SUM(Net_salary) AS MonthCost, Year, Month FROM `ochade_salary` WHERE Year = '$todayyear' GROUP BY Month ORDER BY Month DESC;";
    $result = mysqli_query($con, $sqlcode);
    $trs = "";
    $datagarm="";
    $monthgarm = array();
    $monthname = ["January","February","March","April","May","June","July","August","September","October", "November", "December"];
    if (mysqli_num_rows($result) > 0) {
        while ($row= mysqli_fetch_assoc($result)) {
            $trs .= "<tr class='text-center'>
                        <td>".$monthname[$row['Month']-1]."</td>
                        <td>".$row['MonthCost']."</td>
                        <td>
                            <input type='button' id='".$row['Year'].":".$row['Month']."' value='Print' class='btn btn-success'>
                        </td>
                    </tr>";
            
                    $monthgarm[$monthname[$row['Month']-1]] = $row['MonthCost'];


        }
        for ($i= 0; $i < count($monthname); $i++){
            if (array_key_exists($monthname[$i], $monthgarm)) {
                $datagarm .= $monthgarm[$monthname[$i]]." ";
            }else{
                $datagarm .= "0 ";
            }
        }


    }else{
        $datagarm = "0 0 0 0 0 0 0 0 0 0 0 0";
        $trs .= "<tr>
            <td colspan = '3' class='text-center'>No Data</td>
        </tr>";
    }
?>

<table class="table table-dark">
    <input type='hidden' id="inputsdata" name="secretitem" value= "<?php echo $datagarm; ?>">
    <thead>
        <tr class='text-center'>
            <th scope="col">Month</th>
            <th scope="col">Total Employee Cost</th>
            <th scope="col">Payslip</th>
        </tr>
    </thead>
    <tbody>
        <?php
            echo $trs;

        ?>

        
    </tbody>
    <input type='hidden' name='magicthingy' id='magicthingyid' value = ''> 
</table>




<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    
?>


<table class="table table-dark text-center" id="specialtable">
    <tr>
        <th>Employee Name</th>
        <th>Leave Details</th>
        <th>Leave Date</th>
        <th>Leave Duration (Days)</th>
        <th>Status</th>
        <th>Control</th>
    </tr>

    <?php
    $searchreq = $_POST["request"];
    $sqlcode = "SELECT a.*, CONCAT(b.Last_name,' ',b.First_name) AS Names FROM ochade_leave a, ochado_employees b WHERE a.Emp_id = b.Emp_id AND 
        (First_name LIKE '%$searchreq%' 
        OR Last_name LIKE '%$searchreq%' 
        OR Middle_name LIKE '%$searchreq%' 
        OR Dob LIKE '%$searchreq%' 
        OR Email LIKE '%$searchreq%' 
        OR Mobile LIKE '%$searchreq%'
        OR Position LIKE '%$searchreq%')
        GROUP BY a.Leave_dates ORDER BY a.Leave_dates DESC;";
    $result = mysqli_query($con, $sqlcode);

    
    if (mysqli_num_rows($result) > 0) {
        $trs = "";
        while ($rows = mysqli_fetch_assoc($result)) {
            $name = $rows["Names"];
            $empid = $rows["Emp_id"];
            $ldate = $rows["Leave_dates"];
            $ldetail = $rows["Leave_type"];
            $status = $rows["Leave_status"];
            $duration = $rows["Duration"];
            $id = $rows["Leave_id"];


            $trs .= "
            <tr>
                <td id='b'>$name</td>
                <td id='b'>$ldetail</td>
                <td id='b3'>$ldate</td>
                <td id='b3'>$duration</td>
                <td id='b4'>$status</td>
                <td class='text-center d-flex justify-content-center'>
                    <input type ='submit' class='btn btn-danger' value='Delete' name='del' id='$id'>
                </td>
            </tr>";
            
        }
        echo $trs;
    }else{
        $trs = "<tr>
                    <td class='text-center' colspan = '6'>No Data</td>
                </tr>";
        echo $trs;
    }
    ?>


    

</table>
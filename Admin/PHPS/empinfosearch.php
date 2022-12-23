<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $request = $_POST["request"];

    $sqlcode = "SELECT *  FROM ochado_employees WHERE First_name LIKE '%$request%' 
    OR Last_name LIKE '%$request%' 
    OR Middle_name LIKE '%$request%' 
    OR Dob LIKE '%$request%' 
    OR Gender LIKE '%$request%' 
    OR Address LIKE '%$request%' 
    OR Email LIKE '%$request%' 
    OR Mobile LIKE '%$request%' 
    OR DOE LIKE '%$request%' 
    OR Position LIKE '%$request%';";


    $result = mysqli_query($con, $sqlcode);

?>

<table class="table table-dark" id="specialtable">
                        <tr>
                            <th>Employee Name</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Full Address</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Position</th>
                            <th>Date of Employement</th>
                            <th class="text-center">Control</th>
                        </tr>
                        <?php
                            $tablerow = "";
                            $i = 0;
                            if ($result-> num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i = $i+1;
                                    $tablerow = $tablerow."
                                    <tr id='tr".$i."'>
                                        <td id='b1'>".$row["First_name"]." ".$row["Last_name"]."</td>
                                        <td id='b2'>".$row["Dob"]."</td>
                                        <td id='b3'>".$row["Gender"]."</td>
                                        <td id='b4'>".$row["Address"]."</td>
                                        <td id='b5'>".$row["Email"]."</td>
                                        <td id='b6'>".$row["Mobile"]."</td>
                                        <td id='b7'>".$row["Position"]."</td>
                                        <td class='text-center'>".$row["DOE"]."</td>
                                        <td class='text-center'>
                                                <button class='btn btn-success' id='".$i."' onclick= 'editting(this.id)'>
                                                    <i class='fa-solid fa-pen-to-square'></i>
                                                </button>
                                                <input type='hidden' value = '$i' name ='tablenum'>
                                        </td>
                                        <td class='tdhidden' style ='display:none'>".$row["First_name"]."</td>
                                        <td class='tdhidden' style ='display:none'>".$row["Last_name"]."</td>
                                        <td class='tdhidden' style ='display:none'>".$row["Middle_name"]."</td>
                                        <td class='tdhidden' style ='display:none'>".$row["Emp_id"]."</td>
                                    </tr>";
                                }
                                

                            }else{
                                $tablerow.= "<tr><td colspan='9' class='text-center'>No Data </td></tr>";
                            }
                            echo $tablerow;
                        ?>
                    </table>
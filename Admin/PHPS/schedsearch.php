<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $request = $_POST["request"];

    $sqlcode = "SELECT b.Last_name, a.* FROM ochade_sched a, ochado_employees b WHERE a.Emp_id = b.Emp_id AND (First_name LIKE '%$request%' 
    OR Last_name LIKE '%$request%' 
    OR Middle_name LIKE '%$request%')";
    $result = mysqli_query($con, $sqlcode);

?>

<table class="table" id="specialtable">
                        <tr class="text-center">
                            <th class="text-start">Employee</th>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Edit</th>
                        </tr>

                        <?php
                            if (mysqli_num_rows($result) > 0) {
                                
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    echo "<tr class='text-center ' id='".$rows["Emp_id"]."row"."'>
                                            <td>".$rows["Last_name"]."</td>
                                            <td>".$rows["Sunday"]."</td>
                                            <td>".$rows["Monday"]."</td>
                                            <td>".$rows["Tuesday"]."</td>
                                            <td>".$rows["Wednesday"]."</td>
                                            <td>".$rows["Thursday"]."</td>
                                            <td>".$rows["Friday"]."</td>
                                            <td>".$rows["Saturday"]."</td>
                                            <td>
                                                    <button class='btn btn-success' type='button' id='".$rows["Emp_id"]."'>
                                                        <i class='fa-solid fa-pen-to-square'></i>
                                                    </button>

                                            </td>
                                        </tr>";
                                }
                            }else{
                                echo "<tr><td colspan='9' class='text-center'>No Data</td></tr>";
                            }

                        ?>
                    </table>
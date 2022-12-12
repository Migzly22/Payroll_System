<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong


    $magicsdate = date_create("12/05/2022");
    $datetoday = date("Y/m/d");
    $date2 = date_create($datetoday);
    
    //check the difference between the date today and the starting date
    $diff = date_diff($magicsdate,$date2)->format("%a");

    $diffmod = $diff / 20;
    $startingdatepay = "";
    $enddatepay = "";

    // tell the month we are 
    if ((int) $diffmod == 0) {
        $startingdatepay = $magicsdate;
    }else{
        $startingdatepay =  date('Y-m-d',strtotime("+".(((int)$diff)*15)." day", strtotime('12/05/2022')));
    }

    $enddatepay = date('Y/m/d',strtotime("+15 day", strtotime($startingdatepay->format('Y/m/d'))));
    $todaydaterange = $startingdatepay->format('Y/m/d')." - ".$enddatepay;


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
  
    $datearr = getBetweenDates($startingdatepay->format('m/d/Y'), $enddatepay);

    #print_r($datearr)
    
    $news =  $startingdatepay->format('m/d/Y'); // transform date into string





?>
<link rel="stylesheet" href="./css/empattendance1.css">

<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">Employee Attendance</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <section class="container px-4 sect active" id="s1">
                <form class="toppart d-flex justify-content-between align-items-center my-3" method="post">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" id="searching" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="button" id="searchingbtn"><i class="fas fa-magnifying-glass"></i></button>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" id="selectiondate">
                            <option value="<?php echo $todaydaterange; ?>" selected><?php echo $todaydaterange; ?></option>
                        </select>
                    </div>
                </form>

                <form class="lowerpart d-flex container  p-4" method="post">
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
                 
                            $sqlcode = "SELECT Emp_id, CONCAT(Last_name, ', ', First_name) AS Names FROM ochado_employees ORDER BY Last_name;";
                            $result = mysqli_query($con,$sqlcode);

                            
                            $trs = ""; // contains all of the tr tag
                            if ($result-> num_rows > 0) {
                                while($rowid = $result->fetch_assoc()) {
                                //setting variables
                                    $temparr = $datearr;
                                    $id = $rowid['Emp_id'];
                                    $name = $rowid['Names'];

                                    $trs .= "<tr> <td>$name</td>";

                                    $sqlcode = "SELECT Attendance_date FROM ochado_attendance WHERE Attendance_date >= '$news' AND Attendance_date <= '$enddatepay' AND Emp_id = '$id'  AND Time_out != 'NULL'
                                    ORDER BY `ochado_attendance`.`Attendance_date` ASC;";
                                    $result1 = mysqli_query($con,$sqlcode);                              
                                    
                                    if ($result1-> num_rows > 0) {
                                        $i = 0;
                                        while($rowdate = $result1->fetch_assoc()) {
                                            for ($i; $i < count($datearr) ; $i++) { 
                                                if ($datearr[$i] == $rowdate["Attendance_date"]) {
                                                    $trs .="<td class='text-center present text-light'>Present</td>";
                                                    $i += 1;
                                                    break;
                                                }else{
                                                    $trs .="<td class='text-center absent text-light'>Absent</td>";
                                                }
                                            }
                                        }
                                    }else{
                                        for ($i=0; $i < $diff+1 ; $i++) { 
                                            $trs .="<td class='text-center absent text-light'>Absent</td>";
                                        }
                                    }



                                    

                                    $trs .="</tr>";
                                }   
                                echo $trs;//print the $trs
                            } else {
                                echo "<script>alert('No Data')</script>";
                            }
                            
                        ?>
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


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
        $("#selectiondate").on('change',function(){
            var value = $(this).val();
            var value1 = $("#searching").val();
            //alert(value);

            $.ajax({
            url:"./PHPS/empatt.php",
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
            //alert(value);

            $.ajax({
            url:"./PHPS/empatt.php",
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
            url:"./PHPS/empatt.php",
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
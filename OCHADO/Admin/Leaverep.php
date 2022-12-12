<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $sqlcode ="SELECT Emp_id,  CONCAT(Last_name,' ',First_name) AS Names FROM ochado_employees ORDER BY Last_name ASC";
    $optionsresult = mysqli_query($con, $sqlcode);

    if (isset($_SESSION["msgreques"])) {
        $msgreq = $_SESSION["msgreques"];
        echo "<script>alert('$msgreq')</script>";
        unset($_SESSION["msgreques"]);
    }



    $optionval = "";
    if (mysqli_num_rows($optionsresult) > 0) {
        while ($rows = mysqli_fetch_assoc($optionsresult)) {
            $names = $rows["Names"];
            $Emp_id = $rows["Emp_id"];
            $optionval.= "<option value='$Emp_id'>$names</option>";
        }
    }else{
        $optionval.= "<option value='0'>No Option</option>";
    }


?>

<link rel="stylesheet" href="./css/leaverep.css">
<link rel="stylesheet" href="./css/qweqwe.css">
<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">Leave Report</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <section class="container px-4 sect active" id="s1">
                <form class="toppart d-flex justify-content-between my-3" method="post">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" id="searching" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" id="searchingbtn" type="button"><i class="fas fa-magnifying-glass"></i></button>
                    </div>
                    <div class="d-flex gap-3 slidebtn">
                        <a class="btn" data-bs-toggle="offcanvas" id="Addemp" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                    

                </form>

                <form class="lowerpart d-flex container " method="post">
                    <table class="table table-dark text-center" id="specialtable">
                        <tr>
                            <th>Employee Name</th>
                            <th>Leave Details</th>
                            <th>Leave Date</th>
                            <th>Leave Duration (Days)</th>
                            <th>Status</th>
                        </tr>

                        <?php

                        $sqlcode = "SELECT a.*, CONCAT(b.Last_name,' ',b.First_name) AS Names FROM ochade_leave a, ochado_employees b WHERE a.Emp_id = b.Emp_id ORDER BY a.Leave_dates DESC;";
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


                                $trs .= "
                                <tr>
                                    <td id='b'>$name</td>
                                    <td id='b'>$ldetail</td>
                                    <td id='b3'>$ldate</td>
                                    <td id='b3'>$duration</td>
                                    <td id='b4'>$status</td>
                                </tr>";
                                
                            }
                            echo $trs;
                        }
                        ?>


                        
       
                    </table>
                </form>
            </section>
</nav>

<div class="magic_opener">
    <div class="mboxbox">
        <form action="./PHPS/leavelogic.php" method="POST">
            <div class="form-floating mb-3">
                <select class="form-select" id="empname" name="empid" required  aria-label="Floating label select example">
                    <?php
                        echo $optionval;
                    ?>
                </select>
                <label for="floatingSelect">Employee Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="ldetails" required id="leaved" placeholder="name@example.com">
                <label for="fname">Leave Details</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="ldate" required id="dol" placeholder="name@example.com">
                <label for="dob">Date of Leave</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="lduration"  required id="leavedur" placeholder="name@example.com">
                <label for="lname">Leave Duration (Days)</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="status" name="lstatus" aria-label="Floating label select example">
                    <option value="APPROVED" selected>Approve</option>
                    <option value="DENIED">Denied</option>
                </select>
                <label for="floatingSelect">Status</label>
            </div>
            <div class="d-flex justify-content-center slidebtn">
                <input type="submit" value="Save" name="Addbtn" class="btn">
                <input type="button" value="Cancel" name="Cancelbtn" id="cancel" class="btn ms-3 cancelbtn">
            </div>
        </form>
    </div>
</div>

<script src="./js/leave.js"></script>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){

        $("#searching").on('change',function(){
            var value = $(this).val();
            //alert(value);

            $.ajax({
            url:"./PHPS/leavesearch.php",
            type:"POST",
            data: 'request=' + value,


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
            //alert(value);

            $.ajax({
            url:"./PHPS/leavesearch.php",
            type:"POST",
            data: 'request=' + value,


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
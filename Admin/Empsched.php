<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    //session_start();

    if(isset($_SESSION["alert"])){
        echo "<script>
        Swal.fire(
            'Success!',
            '".$_SESSION["alert"]."',
            'success'
        )
        </script>";
        unset($_SESSION["alert"]);
    }
?>

<link rel="stylesheet" href="./css/sched.css">
<link rel="stylesheet" href="./Tyler/sched1.css">
<link rel="stylesheet" href="./css/qweqwe12.css">


<script src="./js/empsched.js" defer></script>


<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">Employee Schedules</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <section class=" px-4 sect active" id="s1">
                <div class="toppart d-flex justify-content-between my-3" >
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" id="searching" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" id="searchingbtn" type="button"><i class="fas fa-magnifying-glass"></i></button>
                    </div>
                    
                </div>

                <form action="" class="formt">
                    <table class="table table-dark" id="specialtable">
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
                            $sqlcode = "SELECT  b.Last_name, a.* FROM ochade_sched a, ochado_employees b WHERE a.Emp_id = b.Emp_id ORDER BY b.Last_name ASC;";
                            $result = mysqli_query($con, $sqlcode);
                
                            if (mysqli_num_rows($result) > 0) {
                                
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    echo "<tr class='text-center ' id='".$rows["Emp_id"]."row"."'>
                                            <td class='text-start'>".$rows["Last_name"]."</td>
                                            <td>".$rows["Sunday"]."</td>
                                            <td>".$rows["Monday"]."</td>
                                            <td>".$rows["Tuesday"]."</td>
                                            <td>".$rows["Wednesday"]."</td>
                                            <td>".$rows["Thursday"]."</td>
                                            <td>".$rows["Friday"]."</td>
                                            <td>".$rows["Saturday"]."</td>
                                            <td >
                                                    <button class='btn btn-success' type='button' id='".$rows["Emp_id"]."' >
                                                        <i class='fa-solid fa-pen-to-square'></i>
                                                    </button>
                                            </td>
                                        </tr>";
                                }
                            }else{
                                echo "<tr><td colspan='9' class='text-center'>No Data</td></tr>";
                            }

                        ?>


                        <!--
                            <tr>
                                <td>Employee Name</td>
                                <td>11:00 AM - 06:00 AM</td>
                                <td>11:00 AM - 06:00 AM</td>
                                <td>11:00 AM - 04:30 AM</td>
                                <td>11:00 AM - 06:00 AM </td>
                                <td>11:00 AM - 06:00 AM</td>
                                <td>11:00 AM - 06:00 AM</td>
                                <td>11:00 AM - 06:00 AM</td>
                                <td>
                                    <div class='d-flex align-item-center gap-3 slidebtn'>
                                        <button class='btn' type="button" id="testing1">
                                            <i class='fa-solid fa-pen-to-square'></i>
                                        </button>
                                        <input type='hidden' value = '$i' name ='tablenum'>
                                    </div>
                                </td>
                            </tr>
                        -->
                    </table>

                </form>

            </section>
</nav>

<div class="magic_opener">
    <div class="mboxbox">
        <form action="./PHPS/empsched.php" method="POST">
            <h3 class="text-center" id="headerbox">Name</h1>
            <input type="hidden" name="userid" id="empid">
            <div  class="d-flex gap-1 flex-wrap justify-content-between">
                <div class="daybox">
                    <div class="text-center mb-3">Sunday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="sun1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="sun2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
                <div class="daybox">
                    <div class="text-center mb-3">Monday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="mon1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="mon2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
                <div class="daybox">
                    <div class="text-center mb-3">Tuesday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="tue1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="tue2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
                <div class="daybox">
                    <div class="text-center mb-3">Wednesday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="wed1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="wed2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
                <div class="daybox">
                    <div class="text-center mb-3">Thursday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="thur1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="thur2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
                <div class="daybox">
                    <div class="text-center mb-3">Friday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="fri1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="fri2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
                <div class="daybox">
                    <div class="text-center mb-3">Saturday</div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control " name="sat1" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">Start</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" name="sat2" id="floatingInput" placeholder="name@example.com" >
                        <label for="floatingInput">End</label>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-center slidebtn">
                <div>
                    <input type="submit" value="Save" name="Addbtn" class="btn " id="saving">
                    <input type="submit" value="Cancel" name="Cancelbtn" id="cancel" class="btn cancelbtn">
                </div>
            </div>
        </form>
    </div>
</div>




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){

        $("#searching").on('change',function(){
            var value = $(this).val();

            $.ajax({
            url:"./PHPS/schedsearch.php",
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

            $.ajax({
            url:"./PHPS/schedsearch.php",
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


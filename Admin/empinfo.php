<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong
    //session_start();

    $sqlcode = "SELECT * FROM `ochado_employees`;";
    $result = mysqli_query($con, $sqlcode);

    if(isset($_SESSION["alert"])){
        echo "<script>
        Swal.fire(
            '".$_SESSION["Header"]."',
            '".$_SESSION["alert"]."',
            '".$_SESSION["icon"]."'
        )
        </script>";
        unset($_SESSION["alert"]);
    }

?>

<link rel="stylesheet" href="./css/empinfo.css">
<link rel="stylesheet" href="./Tyler/empinfo_up1.css">
<link rel="stylesheet" href="./css/qweqwe12.css">

<script src="./js/empinfo.js" defer></script>
<script src="./js/textuppercase1.js" defer></script>

<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">Employee Info</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <section class=" px-4 sect active" id="s1">
                <form class="toppart d-flex justify-content-between my-3" method="post">
                    <div class="d-flex search-btn">
                        <input class="form-control me-2" type="search" id="searching" placeholder="Search" aria-label="Search">
                        <button class="btn " id="searchingbtn" type="button"><i class="fas fa-magnifying-glass"></i></button>
                    </div>
                    <div class="d-flex gap-3 slidebtn">
                        <a class="btn" id="Addemp"  role="button" >
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>


                </form>

                <form action=""  method="POST" class="lowerpart d-flex ">
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
                </form>
            </section>
</nav>

<div class="magic_opener">
    <div class="mboxbox">
        <form action="./PHPS/empinfo.php" method="POST">
            <h3 class="text-center" id="headerbox"></h1>
            <div  class="d-flex gap-1">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" required id="fname" name="fname" placeholder="name@example.com">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" required id="mname" name="mname" placeholder="name@example.com">
                        <label for="mname">Middle Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" required required id="lname" name="lname" placeholder="name@example.com">
                        <label for="lname">Last Name</label>
                    </div>

                    <div class="form-floating">
                        <select class="form-select"  id="gender" name="gender"  aria-label="Floating label select example">
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                        <label for="floatingSelect">Gender</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" required id="dob" name="dob" placeholder="name@example.com">
                        <label for="dob">Date of Birth</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" required id="email" name="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" onkeypress="return /[0-9]/i.test(event.key)" minlength="11" maxlength="11" class="form-control" required id="phone" name="phone" placeholder="name@example.com">
                        <label for="phone">Phone number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="position" required name="position" aria-label="Floating label select example">
                            <option value="EMPLOYEE">Employee</option>
                            <option value="OIC">OIC</option>
                        </select>
                        <label for="floatingSelect">Position</label>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
                        <input type="text" class="form-control" required id="address" name="address" placeholder="name@example.com">
                        <label for="phone">Address</label>
                    </div>
                    <input type="hidden" name="ids" id="ids" value="1233">

            <div class="d-flex justify-content-center slidebtn">
                <div>
                    <input type="submit" value="Save" name="Addbtn" class="btn ">
                    <input type="submit" value="Cancel" name="Cancelbtn" id="cancel" class="btn cancelbtn">
                    <input type='submit' value='Delete' name='deleteemployee' class='btn btnremove' id="deleteid" disabled>
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
          url:"./PHPS/empinfosearch.php",
          type:"POST",
          data:'request=' + value,


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
          url:"./PHPS/empinfosearch.php",
          type:"POST",
          data:'request=' + value,


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
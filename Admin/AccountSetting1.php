<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $sqlcode = "SELECT * FROM `ochado_admin`;";
    $result  = mysqli_query($con, $sqlcode);

    $row = mysqli_fetch_assoc($result);

    
    if(isset($_SESSION["alert"]) && isset($_SESSION["sign"])){
        echo "<script>
        Swal.fire(
            'Success!',
            '".$_SESSION["alert"]."',
            '".$_SESSION["sign"]."'
        )
        </script>";
        unset($_SESSION['alert']);
    }

?>

<link rel="stylesheet" href="./css/accset.css">
<link rel="stylesheet" href="./css/accsetting2.css">
<script src="./js/useracc.js" defer></script>
<script src="./js/passwordcheck.js" defer></script>

<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">User Information & Setting</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <section class="px-4 sect active d-flex justify-content-between accset" id="s1">
                <form action="./PHPS/accsetting.php" class="leftside col-md-5 col-sm-12 px-3 py-3" method="POST">
                    <div class="rbox pb-3 shadow-lg">
                        <h5 class="mb-3">User Information</h5>
                        <div class="px-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    First name
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="fname"  value="<?php echo  $row["Admin_fname"]; ?>" class="form-control" disabled id="fname" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    Surname
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="lname"  value="<?php echo  $row["Admin_lname"]; ?>" class="form-control" disabled id="lname" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    Middle name
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="mname"  value="<?php echo  $row["Admin_mname"]; ?>" class="form-control" disabled id="mname" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <button type="button" class="btn btn-primary" id="updateuser">Change</button>
                                <input type="submit" class="btn btn-success" id="successbtn" disabled name="updatinguser" value="Update">
                                <button type="button" class="btn btn-danger" id="cancelbtn" disabled>Cancel</button>
                            </div>
                        </div>
                        
                    </div>
                    
                </form>
                <form action="./PHPS/accsetting.php"  class="rightside col-md-6 col-sm-12 px-3 py-3" method="POST">

                    <div class="rbox pb-3 shadow-lg mb-4">
                        <h5 class="mb-3">Change Email</h5>
                        <div class="px-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    Current Email
                                </div>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control"  id="email" name="email" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    New Email
                                </div>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control"  id="nemail" name="nemail" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <input type="submit" class="btn btn-success" name="UpdateEmail" value="Update Email">
                                <button type="button" class="btn btn-danger" id="cancelemail">Cancel</button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div  class="rbox pb-3 shadow-lg">
                        <h5 class="mb-3">Change Password</h5>
                        <div class="px-3 " >
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    Current Password
                                </div>
                                <div class="col-sm-7">
                                    <input type="password" minlength="8" class="form-control" id="password" name="password" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="col-sm-5">
                                    New Password
                                </div>
                                <div class="col-sm-7">
                                    <input type="password" minlength="8" class="form-control"  id="npassword"  name="npassword" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <input type="submit" class="btn btn-success" name="UpdatePassword" value="Update Password" id="changepasswordid">
                                <button type="button" class="btn btn-danger" id="cancelpass">Cancel</button>
                            </div>
                        </div>
                       
                    </div>

                 
                    
                    
                </form>
            </section>
</nav>
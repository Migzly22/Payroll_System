<link rel="stylesheet" href="./css/accset.css">
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

            <section class="container px-4 sect active d-flex justify-content-between accset" id="s1">
                <form class="leftside col-md-5 col-sm-12 px-3 py-3">
                    <h5 class="mb-3">User Information</h5>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            First name
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" disabled id="fname" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            Surname
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" disabled id="lname" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            Middle name
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" disabled id="mname" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <button type="button" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-success disabled">Success</button>
                        <button type="button" class="btn btn-danger disabled">Cancel</button>
                    </div>
                </form>
                <form class="rightside col-md-6 col-sm-12 px-3 py-3">
                    <h5 class="mb-3">Change Email</h5>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            Current Email
                        </div>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" disabled id="email" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            New Email
                        </div>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" disabled id="nemail" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <button type="button" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-success disabled">Success</button>
                        <button type="button" class="btn btn-danger disabled">Cancel</button>
                    </div>

                    <hr>
                    <h5 class="mb-3">Change Password</h5>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            Current Password
                        </div>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" disabled id="password" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="col-sm-5">
                            New Password
                        </div>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" disabled id="npassword" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <button type="button" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-success disabled">Success</button>
                        <button type="button" class="btn btn-danger disabled">Cancel</button>
                    </div>
                    
                </form>
            </section>
</nav>
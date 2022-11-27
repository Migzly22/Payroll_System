<link rel="stylesheet" href="./css/leaverep.css">

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
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit"><i class="fas fa-magnifying-glass"></i></button>
                    </div>
                    <div class="d-flex gap-3 slidebtn">
                        <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                    <!--ADD-->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Employee Leave</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form action="">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" placeholder="name@example.com">
                                    <label for="fname">Employee Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" placeholder="name@example.com">
                                    <label for="fname">Leave Details</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="dob" placeholder="name@example.com">
                                    <label for="dob">Date of Leave</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lname" placeholder="name@example.com">
                                    <label for="lname">Leave Duration</label>
                                </div>
                                <select class="form-select mb-3 form-select-lg" aria-label="Default select example">
                                    <option selected>Status</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Denied</option>
                                </select>
                                <div class="d-flex justify-content-center slidebtn">
                                    <a class="btn col-sm-8">
                                        Add
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                </form>

                <form class="lowerpart d-flex container " method="post">
                    <table class="table table-dark text-center">
                        <tr>
                            <th>Employee Name</th>
                            <th>Leave Details</th>
                            <th>Leave Date</th>
                            <th>Leave Duration (Days)</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td id="b1">Rolly Migrino</td>
                            <td id="b2">Sick Leave</td>
                            <td id="b3">12/12/2022</td>
                            <td id="b3">3</td>
                            <td id="b4">Approve</td>
                            
                        </tr>
       
                    </table>
                </form>
            </section>
</nav>
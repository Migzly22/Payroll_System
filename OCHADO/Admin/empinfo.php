<link rel="stylesheet" href="./css/empinfo1.css">

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
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Employee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form action="">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" placeholder="name@example.com">
                                    <label for="fname">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mname" placeholder="name@example.com">
                                    <label for="mname">Middle Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lname" placeholder="name@example.com">
                                    <label for="lname">Last Name</label>
                                </div>
                                <select class="form-select mb-3 form-select-lg" aria-label="Default select example">
                                    <option selected>Sex</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="dob" placeholder="name@example.com">
                                    <label for="dob">Date of Birth</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                    <label for="email">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phone" placeholder="name@example.com">
                                    <label for="phone">Phone number</label>
                                </div>
                                <select class="form-select mb-3 form-select-lg" aria-label="Default select example">
                                    <option selected>Position</option>
                                    <option value="1">Employee</option>
                                    <option value="2">OIC</option>
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
                    <table class="table table-dark">
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
                        <tr>
                            <td id="b1">Rolly Migrino</td>
                            <td id="b2">06/20/2022</td>
                            <td id="b3">Male</td>
                            <td id="b4">BLK 40 lot 99 Brgy. Hindimahanap Imus city, Cavite</td>
                            <td id="b5">rolly@gmail.com</td>
                            <td id="b6">0999999999999</td>
                            <td id="b7">Employee</td>
                            <td class="text-center">12/12/2022</td>
                            <td>
                                <div class="d-flex align-item-center gap-3 slidebtn">
                                    <a class="btn" id="b" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button" aria-controls="offcanvasExample1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btnremove" id="rb">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="b1">Rolly Migrino</td>
                            <td id="b2">06/20/2022</td>
                            <td id="b3">Male</td>
                            <td id="b4">BLK 40 lot 99 Brgy. Hindimahanap Imus city, Cavite</td>
                            <td id="b5">rolly@gmail.com</td>
                            <td id="b6">0999999999999</td>
                            <td id="b7">Employee</td>
                            <td class="text-center">12/12/2022</td>
                            <td>
                                <div class="d-flex align-item-center gap-3 slidebtn">
                                    <button class="btn" id="b">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btnremove" id="rb">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </section>
</nav>

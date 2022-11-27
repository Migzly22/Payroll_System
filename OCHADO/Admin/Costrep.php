<link rel="stylesheet" href="./css/costrep.css">
<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white" id="Title">Cost Report</h2>
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
                    <div class="d-flex">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Order by </option>
                            <option value="1">Start Date</option>
                            <option value="2">End Date</option>
                            <option value="2">Total Cost</option>
                        </select>
                    </div>
                </form>

                <form class="lowerpart" method="post">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">2</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Total Employee Cost</th>
                                <th scope="col">Payslip</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>8-05-2022</td>
                                <td>8-20-2022</td>
                                <td>10000</td>
                                <td>
                                    <input type="submit" value="Print" class="btn btn-success">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>8-05-2022</td>
                                <td>8-20-2022</td>
                                <td>10000</td>
                                <td>
                                    <input type="submit" value="Print" class="btn btn-success">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </section>
</nav>
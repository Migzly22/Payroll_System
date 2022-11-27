<link rel="stylesheet" href="./css/dashboard1.css">

<nav class="navbar navbar-expand-lg  py-4 px-4" style="background-color: #000">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0 text-white" id="Title">Dashboard</h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<section class="container px-4 sect active" id="s1">
    <div class="row g-3 my-2">
        <div class="col-md-4">
            <div class="p-3 boxbox shadow-lg d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">5</h3>
                    <p class="fs-5">Present </p>
                </div>
                <i class="fa-solid fa-user-check fs-1 iboxbox   secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 boxbox shadow-lg d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">1</h3>
                    <p class="fs-5">Late</p>
                </div>
                <i class="fas fa-user-xmark fs-1 iboxbox   secondary-bg p-3"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 boxbox shadow-lg d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2">12/12/2002</h3>
                    <p class="fs-5">Date</p>
                </div>
                <i class="fas fa-calendar fs-1 iboxbox   secondary-bg p-3"></i>
            </div>
        </div>
    </div>
    <div>
        <div class="canvap">
            <canvas id="myChart" class="px-5"></canvas>
        </div>
    </div>

</section>

<script>
        const ctx = document.getElementById('myChart');
        Chart.defaults.backgroundColor = 'pink';
        Chart.defaults.font.size = 18;
        Chart.defaults.color = '#000';
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat', "Sun"],
            datasets: [{
                label: '# of On-time-Employees',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor:'#1f7953'
            }]
            },
            options: {
                plugins: {
                title: {
                    display: true,
                    text: 'Weekly Attendance'
                }
            },
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
        </script>

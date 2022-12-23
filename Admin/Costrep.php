<?php
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    $todayyear = date("Y");


    $sqlcode = "SELECT SUM(Net_salary) AS MonthCost, Year, Month FROM `ochade_salary` WHERE Year = '$todayyear' GROUP BY Month ORDER BY Month DESC;";
    $result = mysqli_query($con, $sqlcode);
    $trs = "";
    $datagarm="";
    $monthgarm = array();
    $monthname = ["January","February","March","April","May","June","July","August","September","October", "November", "December"];
    if (mysqli_num_rows($result) > 0) {
        while ($row= mysqli_fetch_assoc($result)) {
            $trs .= "<tr class='text-center'>
                        <td>".$monthname[$row['Month']-1]."</td>
                        <td>".$row['MonthCost']."</td>
                        <td>
                            <input type='button' id='".$row['Year'].":".$row['Month']."' value='Print' class='btn btn-success'>
                        </td>
                    </tr>";
            $monthgarm[$monthname[$row['Month']-1]] = $row['MonthCost'];
            

        }
        for ($i= 0; $i < count($monthname); $i++){
            if (array_key_exists($monthname[$i], $monthgarm)) {
                $datagarm .= $monthgarm[$monthname[$i]]." ";
            }else{
                $datagarm .= "0 ";
            }
        }

    }else{
        $trs .= "<tr>
            <td colspan = '3' class='text-center'>No Data</td>
        </tr>";
    }
?>

<link rel="stylesheet" href="./css/costrep1.css">
<script src="./js/costrep1.js" defer></script>
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
            <section class=" px-4 sect active d-flex justify-content-between flex-wrap" id="s1">
                <div class=" col-md-6">
                    <div class="canvas mt-3" id="canvaoutline">
                        <canvas id="myChart" class="px-5"></canvas>
                    </div>
                </div>
                <div class=" col-md-6">
                    <form class="toppart d-flex justify-content-end my-3" method="post">
                        <div class="d-flex">
                            <select class="form-select" id="selectyear" name="selectedyear">
                                <option value="<?php echo $todayyear; ?>" selected><?php echo $todayyear; ?></option>
                            </select>
                        </div>
                    </form>

                    <form action="" class="lowerpart" method="post" id="formprint" target="_blank">

                        
                        <table class="table table-dark" id="specialtable">
                            <input type='hidden' id="inputsdata" name="secretitem" value= "<?php echo $datagarm; ?>">
                            <thead>
                                <tr class='text-center'>
                                    <th scope="col">Month</th>
                                    <th scope="col">Total Employee Cost</th>
                                    <th scope="col">Payslip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    echo $trs;

                                ?>

                                
                            </tbody>
                            <input type='hidden' name='magicthingy' id='magicthingyid' value = ''> 
                        </table>
                        <input type="submit" style="display: none;" name="costrepprint" id="costrepprintid">    
                    </form>
                </div>

            </section>
</nav>

<script>
    const selectiond = document.querySelector("#selectyear")
    let selectedd = document.getElementById("selectyear").value;

    let startingyear = 2020;
    

    for (let j = 0; j <  selectedd - startingyear ; j++) {

        let option = new Option(selectedd - (j+1));
        selectiond.add(option, undefined);
    }

</script>



<script type="text/javascript">


        let valuesin = document.getElementById("inputsdata").value
        let myArray = valuesin.split(" ");

        let date1 = document.getElementById('selectyear').value;

        let ctx = document.getElementById('myChart');
        Chart.defaults.backgroundColor = 'pink';
        Chart.defaults.elements.bar.borderWidth = 2;
        Chart.defaults.font.size = 18;
        Chart.defaults.color = '#000';


        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [ "Jan",'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                
                datasets: [{
                        label: date1,
                        data: myArray,
                        backgroundColor:'#1f7953',
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Yearly Employee Cost'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
        });



      $(document).ready(function(){
        $("#selectyear").on('change',function(){
            var value = $(this).val();

            

            $.ajax({
                url:"./PHPS/costrepyearchange.php",
                type:"POST",
                data:'request=' + value ,


                beforeSend:function(){
                $("#specialtable").html("<span>Working ...</span>");
                    },
                success:function(data){
                    $("#specialtable").html(data);



                    myArray = inputsdata.value.split(" ");
                    date1 = document.getElementById('selectyear').value;


                    chart.data.datasets.forEach((dataset) => {
                        dataset.label = date1
                        dataset.data = myArray
                    });
                    chart.update();

                }  
            }); 


        });



    });
</script>


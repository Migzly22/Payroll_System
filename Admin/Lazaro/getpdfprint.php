<?php
    require '../Lazaro/vendor/autoload.php';
    require($_SERVER['DOCUMENT_ROOT'].'/OCHADO/DATABASE/db.php');
    date_default_timezone_set('Asia/Hong_Kong');// to change the time to hongkong

    use Dompdf\Dompdf;
    use Dompdf\Options;

    /*
        $html = '<h1>Hello World</h1>';
        $html .= '<h5>Rolly</h5>';
        $html .= '<img src="./qwer.jpg">';//use jpg only
    */


    // using [] means placing multiple terms in one


    $options = new Options;
    $options ->setChroot(__DIR__);//file directory
    $options -> setIsRemoteEnabled(true);

    
    $dompdf = new Dompdf($options);
    $dompdf -> setPaper("A4", "landscape"); // change the paper properties to A4 and landscape
    

    if (isset($_POST['print'])){



        $arrval = explode("||", $_POST['magicthingy']);

        $pagibig = number_format((float)$arrval[2] * 0.02, 2, '.', '') ;
        $philhealth = number_format((float)$arrval[2] * 0.04, 2, '.', '');
        $sss = number_format((float)$arrval[2]  * 0.045, 2, '.', '');
    
        $deduction = number_format((float)$pagibig, 2, '.', '') + number_format((float)$philhealth, 2, '.', '') + number_format((float)$sss, 2, '.', ''); 
        $datearr = explode("/", $arrval[0]);
        $net = number_format((float)$arrval[2], 2, '.', '') - number_format((float)$deduction, 2, '.', ''); // need to find the deduction


        $html = file_get_contents("../Lazaro/payslip.html");
        $needtochange = [
            "{{EMPNAME}}",
            "{{BASICRATE}}", 
            "{{PAIDRANGE}}", 
            "{{PAYDAY}}", 
            "{{NETPAY}}",
            "{{EARNINGS}}",
            "{{SSS}}",
            "{{PAGIBIG}}",
            "{{PHILHEALTH}}",
            "{{TOTALEARNING}}",
            "{{TOTALDEDUCTION}}",
            "{{HOURS}}"
        ];
        $valuetochange = [
            $arrval[3],
            $arrval[4], 
            $arrval[0], 
            date("m/d/Y"), 
            $net,
            (float)$arrval[2],
            $sss,
            $pagibig,
            $philhealth,
            $arrval[2],
            $deduction,
            $arrval[5]
        
        ];

        $html = str_replace($needtochange, $valuetochange, $html);


        $dompdf -> loadHtml($html); // load the value that you pass in it
        //$dompdf -> load_html_file('htmltemplate.html'); // use to load another html file
        $dompdf -> render();

        $dompdf -> addInfo("Title", $arrval[3]); // Add additional info in the pdf
        $dompdf->stream($arrval[3].".pdf", ["Attachment" => 0]); //the text here represent the name of the pdf file
        // Attachment -> 0 means view of the pdf
        // while Attachment -> 1 means download the pdf but differ on the configuration of the borwser
    
    }

    else if (isset($_POST["costrepprint"])){
        $arrval = explode(":", $_POST['magicthingy']);
        $years = $arrval[0];
        $month = $arrval[1];
        $tds = "<tbody></tbody>";
        $sqlcode = "SELECT CONCAT(a.Last_name, ', ' , a.First_name) AS Names, 
                    SUM(b.Earning_amount) AS Earnings,
                     SUM(b.Deduction_total) AS Deductions, 
                    SUM(b.Net_salary) AS EmpNet 
                    FROM ochado_employees a, ochade_salary b 
                    WHERE a.Emp_id = b.Emp_id AND Year = '".$arrval[0]."' AND Month = '".$arrval[1]."' GROUP BY a.Emp_id ORDER BY a.Emp_id ASC;";
        $result = mysqli_query($con, $sqlcode);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $tds .= "
                        <tr>
                            <td>".$rows["Names"]."</td>
                            <td class='text-align'>".$rows["Earnings"]."</td>
                            <td class='text-align'>".$rows["Deductions"]."</td>
                            <td class='text-align'>".$rows["EmpNet"]."</td>
                        </tr>
                    </tbody>
                    ";
            }
            $tds .= "</tbody>";
        }else{
            $tds = "<tbody>
            <tr>
                <td colspan ='4' style='text-align:center'> NO DATA</td>
            </tr>
            </tbody>";
        }


        $html = file_get_contents("../Lazaro/tabledata.html");
        $html = str_replace(["{{TBODY}}", "{{YEAR}}","{{MONTH}}"], [$tds,$years,$month], $html);


        $dompdf -> loadHtml($html); // load the value that you pass in it
        //$dompdf -> load_html_file('htmltemplate.html'); // use to load another html file
        $dompdf -> render();

        $dompdf -> addInfo("Title", "Ochado Report"); // Add additional info in the pdf
        $dompdf->stream("Ochado-$years/$month.pdf", ["Attachment" => 0]); //the text here represent the name of the pdf file
        // Attachment -> 0 means view of the pdf
        // while Attachment -> 1 means download the pdf but differ on the configuration of the borwser

    }



    

?>
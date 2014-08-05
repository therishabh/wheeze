<?php
include('include/db.php');
session_start();
if(!isset($_SESSION['wheeze_username']) || empty($_SESSION['wheeze_username']) )
{
    ?>
    <script type="text/javascript">
    window.location = "index.php";
    </script>
    <?php
}
else{
    ob_start();
    $query = mysql_query("SELECT * FROM history ORDER BY id DESC");

?>
<style type="text/css">
table.page_header {width: 100%; border: none; background-color: #B0BDFD; border-bottom: solid 1mm #00478B; padding: 2mm }
table.page_footer {width: 100%; border: none; background-color: #B0BDFD; border-top: solid 1mm #00478B; padding: 2mm}
h1 {color: #000033}
h2 {color: #000055}
h3 {color: #000077}
table#display-record{
    width:100%;
}
table#display-record tr td{
    text-align: center;
    padding: 10px;
    font-size: 15px;
}
.error-msg{
    text-align: center;
    font-size:23px;
    color: rgb(207, 7, 7);
    padding-top: 38px; 
    font-weight: bold;
}
</style>

<!-- write your code here -->
<page orientation="paysage">
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width:50%; text-align:left">
                    <?php 
                    date_default_timezone_set('Asia/Calcutta');
                    echo date("d M, Y");
                    ?>
                </td>
                <td style="width: 50%; text-align: right;">
                    page [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    <div style="margin-top:20px; font-color:#000; font-size:32px; text-align:center; margin-bottom:20px; padding-bottom :4px; border-bottom:5px solid double;">
        Taxi Records
    </div>
    
    <?php 
    if(mysql_num_rows($query) > 0) 
    {
    ?>
        <table id="display-record">
            <tr style="background: #00478B;">
                <td style="padding:10px;color:#fff;font-weight: bold; width:25px; text-align:center;">S.No.</td>
                <td style="padding:10px;color:#fff;font-weight: bold; width:50px; text-align:center;">Taxi Id</td>
                <td style="padding:10px;color:#fff;font-weight: bold; width:100px; text-align:center;">Taxi Number</td>
                <td style="padding:10px;color:#fff;font-weight: bold; width:100px; text-align:center;">Driver Name</td>
                <td style="padding:10px;color:#fff;font-weight: bold; width:60px; text-align:center;">Status</td>
                <td style="padding:10px;color:#fff;font-weight: bold; width:160px; text-align:center;">Time</td>
                <td style="padding:10px;color:#fff;font-weight: bold; width:270px; text-align:center;">Location</td>
            </tr>
            <?php
            $a = 1;
            while($row = mysql_fetch_array($query))
            {
                $taxi_id = $row['taxi_id'];
                $query_fetch = mysql_query("SELECT * FROM taxi_detail WHERE taxi_id = '$taxi_id'");
                $row_taxi = mysql_fetch_array($query_fetch);
                $time = date("jS, F Y h:i A",strtotime($row['time']));
                if($a%2 == 0)
                {
                ?>
                    <tr style="background:#ddd;">
                        <td style="width:25px;"><?php echo $a; ?></td>
                        <td style="width:50px;"><?php echo $row['taxi_id'] ?></td>
                        <td style="width:100px;"><?php echo $row_taxi['taxi_number'] ?></td>
                        <td style="width:100px;"><?php echo $row_taxi['driver_name'] ?></td>
                        <td style="width:60px;"><?php echo $row['status']; ?></td>
                        <td style="width:160px;"><?php echo $time; ?></td>
                        <td style="width:270px;"><?php echo $row['location'];; ?></td>
                    </tr>
                <?php
                }
                else
                {
                ?>
                    <tr>
                       <td style="width:25px;"><?php echo $a; ?></td>
                        <td style="width:50px;"><?php echo $row['taxi_id'] ?></td>
                        <td style="width:100px;"><?php echo $row_taxi['taxi_number'] ?></td>
                        <td style="width:100px;"><?php echo $row_taxi['driver_name'] ?></td>
                        <td style="width:60px;"><?php echo $row['status']; ?></td>
                        <td style="width:160px;"><?php echo $time; ?></td>
                        <td style="width:270px;"><?php echo $row['location'];; ?></td>
                    </tr>
                <?php    
                }
            ?>
            
            <?php
            $a++;
            } 
            ?>            
        </table>
    <?php
    }
    else
    {
    ?>
        <div class="error-msg">
            There is no any Record..!
        </div>
    <?php
    }
    ?>
</page>
<!-- write your code here -->

<?php
        $content = ob_get_clean();
        require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->writeHTML($content);
            $html2pdf->Output("Taxi_record.pdf");
        ?>
        <head>
        <script>
        function ready() {
        window.close();
        }
        </script></head>
        <body onload="ready();">
        </body>
        <?php
            exit;
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
}//end else..
?>


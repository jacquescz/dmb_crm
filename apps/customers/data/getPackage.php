<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$packageid = $_POST['packageid'];


$mysqli = new mysqli("127.0.0.1", "root", "", "dmb_crm");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT
`tblcustomer_package_items`.`Id`,
  `tblcustomer_package_items`.`cuspackageid`,
  `tblcustomer_package_items`.`serviceid`,
  `tblcustomer_package_items`.`customerid`,
  `tblcustomer_package_items`.`calcMethod`,
  `tblcustomer_package_items`.`methodCap`,
  `tblcustomer_package_items`.`pckNote`,
  `tblservices`.`typeofservice`,
  `tblservices`.`service`,
  `tblservices`.`description`,
  `tblcustomers`.`Customer`,
  `tblcustomer_package`.`startDate`,
  `tblcustomer_package`.`endDate`,
  `tblcustomer_package`.`packageName`,
  ifnull((SELECT Sum(`tblservice_transactions`.`strValue`)
  FROM `tblservice_transactions`
  WHERE `tblservice_transactions`.`strPackageItemID` =
    `tblcustomer_package_items`.`Id` AND
    `tblservice_transactions`.`strDateTime` BETWEEN '2016-03-01' AND
    '2016-03-31'),0) AS `WorkCompleted`
  
FROM
  `tblcustomer_package_items`
  INNER JOIN `tblservices` ON `tblcustomer_package_items`.`serviceid` =
    `tblservices`.`Id`
  INNER JOIN `tblcustomers` ON `tblcustomer_package_items`.`customerid` =
    `tblcustomers`.`Id`
  INNER JOIN `tblcustomer_package` ON `tblcustomer_package_items`.`cuspackageid`
    = `tblcustomer_package`.`Id`
WHERE
  `tblcustomer_package_items`.`cuspackageid` = $packageid;";


$chartids = array();
if ($result = $mysqli->query($query)) {
    echo "<table class='table'>";
    echo "<theader>";
    echo "<th>Type</th>";
    echo "<th>Service</th>";
    echo "<th>Method</th>";
    echo "<th class='text-center'>CAP</th>";
    echo "<th class='text-center'>Done</th>";
    echo "<th class='text-center'>To Do</th>";
    echo "<th class='text-center'>Chart</th>";
    echo "<th></th>";
    echo "</theader>";
    echo "<tbody>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['typeofservice'] . "</td>";
        echo "<td >" . $row['service'] . "</td>";
        echo "<td>" . $row['calcMethod'] . "</td>";
        echo "<td class='text-center'>" . $row['methodCap'] . "</td>";
        echo "<td class='text-center'>" . $row['WorkCompleted'] . "</td>";
        
        $wd = $row['WorkCompleted'];
        $cap = $row['methodCap'] ;
        if ($wd > $cap ) {
            //$wdCalc =   $wd - $cap;
            //$capCalc =  $cap - $wd;
        } 
        if ($wd < $cap ) {
            $wdCalc =    $wd - 0;
            $capCalc =   $cap - $wd;
        }
        
        
        echo "<td class='text-center'>" . $capCalc . "</td>";
        $chartids[] = array($row['Id'],  $capCalc,$wdCalc);
        echo "<td class='text-center'><canvas id=\"chart-area-" . $row['Id'] . "\" width=\"30\" height=\"30\"/></td>";
        
        echo "<td>"
        . "<i class='fa fa-pencil btn btn-success'></i>"
                . " "
        . "<i class='btn fa fa-ban btn-danger'></i>"
        
        . "</td>";
        
        echo "</tr>";
    }

    /* free result set */
    $result->free();
}
echo "</tbody>";
echo "</table>";



/* close connection */
$mysqli->close();

$jsonChartIDs = json_encode($chartids);
var_dump($jsonChartIDs);
?>


<i class='fa fa-pencil btn btn-success '></i>



<script>
    var chartids = <?php echo $jsonChartIDs; ?>;
    for (i = 0; i < chartids.length; i++) {
        
        var c = chartids[i];
        drawPie(c[0],c[1],c[2]);
    }
    function drawPie(target, firstValue, secondValue) {

        var pieData = [
            {
                value: secondValue,
                color: "#46BFBD",
                highlight: "#5AD3D1",
               
                label: "Cap"
            },
            {
                value: firstValue,
                 color: "#F7464A",
                highlight: "#FF5A5E",
                label: "Done"
                
            }



        ];


        var ctx = document.getElementById("chart-area-" + target).getContext("2d");
        window.myPie = new Chart(ctx).Pie(pieData);
    }






</script>
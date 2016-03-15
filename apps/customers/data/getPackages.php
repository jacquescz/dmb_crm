<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
include_once  dirname(__FILE__) . './../../../config.php';

$c = new CRMConfig();

$customerid = $_POST['customerid'];

$mysqli = new mysqli($c->mysql_host, $c->mysql_username, $c->mysql_password, $c->mysql_database);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}


$query = "SELECT
  Count(`tblcustomer_package_items`.`Id`) AS `services`,
  `tblcustomer_package`.`Id` AS `itmID`,
  `tblcustomer_package`.`customerid`,
  `tblcustomer_package`.`domainid`,
  `tblcustomer_package`.`startDate` pckStartDate,
  `tblcustomer_package`.`endDate`,
  `tblcustomer_package`.`packageName`,
  `tbldomains`.`domainname`
FROM
  `tblcustomer_package_items`
  RIGHT JOIN `tblcustomer_package` ON `tblcustomer_package_items`.`cuspackageid`
    = `tblcustomer_package`.`Id`
  LEFT JOIN `tbldomains` ON `tblcustomer_package`.`domainid` = `tbldomains`.`Id`
WHERE
  `tblcustomer_package`.`customerid` = 1
GROUP BY
  `tblcustomer_package`.`Id`,
  `tbldomains`.`domainname`;";

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    $lastPackid = 0;
    echo "<table class='table'>";
    echo "<theader>";
    echo "<th>Package</th>";
    echo "<th>Domain</th>";
    echo "<th>Start</th>";
    echo "<th>End</th>";
    echo "<th>Service(s)</th>";
    echo "</theader>";
    echo "<tbody>";
    
    
    while ($row = $result->fetch_assoc()) {
        //printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        echo "<tr>";

        
         echo "<td><a href='#' onclick='navPackage(" . $row['itmID'] . ")'>" .  $row['packageName'] . "</a></td>";
         echo "<td>" . $row['domainname']  . "</td>";
         echo "<td>" . $row['pckStartDate']  . "</td>";
         echo "<td>" . $row['endDate']  . "</td>";
         echo "<td>" . $row['services']  . "</td>";
         
        
         
        
        
        echo "</tr>";
        
        
    }
    echo "</tbody>";
echo "</table>";
    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();
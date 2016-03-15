<?php

$packageid = $_POST['packageid'];



$mysqli = new mysqli("127.0.0.1", "root", "", "dmb_crm");



/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$query = "SELECT
  `tblcustomer_package`.*,
  `tblcustomers`.`Id` AS `Id1`,
  `tblcustomers`.`Customer` as Customer,
  `tblcustomers`.`PaymentMethod`,
  `tblcustomers`.`Agent`
FROM
  `tblcustomer_package`
  INNER JOIN `tblcustomers` ON `tblcustomer_package`.`customerid` =
    `tblcustomers`.`Id`
WHERE
  `tblcustomer_package`.`Id` = $packageid;";
if ($result = $mysqli->query($query)) { 
$row = $result->fetch_assoc();



echo "<div>"
        . "<label>Customer</label>"
        . "<span>" . $row['Customer']  . "<span>"
        . "</div>";
echo "<div>"
        . "<label>packageName</label>"
        . "<span>" . $row['packageName']  . "<span>"
        . "</div>";
echo "<div>"
        . "<label>Start</label>"
        . "<span>" . $row['startDate']  . "<span>"
        . "<label>End</label>"
        . "<span>" . $row['endDate']  . "<span>"
        . "</div>";




}
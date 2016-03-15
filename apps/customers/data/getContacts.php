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


$query = "SELECT `tblcustomer_contacts`.* FROM `tblcustomer_contacts` where conCustomerID=$customerid";

if ($result = $mysqli->query($query)) {
    echo "<table class='table'>";
    echo "<theader>";
    echo "<th>A</th>";
    echo "<th>Name</th>";
    echo "<th>Surname</th>";
    echo "<th>Phone</th>";
    echo "<th>Cell</th>";
    echo "<th>E-Mail</th>";
    echo "<th>Type</th>";
    echo "</theader>";
    echo "<tbody>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        echo "<tr>";
        echo "<td><img data-name=\"" .  $row['conName'] . " " . $row['conSurname'] . "\" class=\"lAvatar\" /></td>";
        echo "<td>" .  $row['conName'] . "</td>" ;
        echo "<td>" .  $row['conSurname'] . "</td>" ;
        echo "<td>" .  $row['conPHone'] . "</td>" ;
        echo "<td>" .  $row['conCell'] . "</td>" ;
        echo "<td>" .  $row['conEmail'] . "</td>" ;
        echo "<td>" .  $row['conType'] . "</td>" ;
        
        
        echo "</tr>";
        
        
    }
    echo "</tbody>";
    echo "</table>";
    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();
?>

<script >


$(document).ready(function(){
$('.lAvatar').initial({
name: 'Name', // Name of the user
charCount: 1, // Number of characherts to be shown in the picture.
textColor: '#ffffff', // Color of the text
seed: 1, // randomize background color
height: 20,
width: 20,
fontSize: 16,
fontWeight: 400,
fontFamily: 'HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica, Arial,Lucida Grande, sans-serif',
radius: 0
});
})
</script>
    
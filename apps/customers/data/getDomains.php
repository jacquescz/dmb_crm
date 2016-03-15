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


$query = "SELECT * FROM `tbldomains` where customerid=$customerid;";

if ($result = $mysqli->query($query)) {
    echo "<table class='table'>";
    echo "<theader>";
    echo "<th>Start</th>";
    echo "<th>Domain</th>";
    echo "<th>Link</th>";
    echo "<th>Hosting</th>";
    echo "</theader>";
    echo "<tbody>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        echo "<tr>";
        echo "<td>" .  $row['startDate'] . "</td>" ;
        echo "<td>" .  $row['domainname'] . "</td>" ;
        echo "<td><a href='" . $row['domainname']  .  "' target='_blank'>link</a></td>" ;
        echo "<td></td>" ; //Hosting
        echo "</tr>";
        
        
    }
    echo "</tbody>";
    echo "</table>";
    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();
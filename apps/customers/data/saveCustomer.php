<?php
include_once dirname(__FILE__) . './../obj/customer.incl.php';
$c = new customer();


if (isset($_POST['mydata'])) {
    $myArray = $_POST['mydata'];
    $cusArray = array();

    //var_dump($myArray);
    foreach ($myArray as $value) {
        $name = $value['name'];
        $inputValue = $value['value'];
        $cusArray[$name] = $inputValue;
    }
    
    $c->Id  = $cusArray['inputID'];
    $c->Customer = $cusArray['inputCustomer'];
    $c->PaymentMethod = "";
    $c->Agent = $cusArray['selectAgent'];
    $c->cusAddress_Street_No = $cusArray['inputAddressStreetNo'];
    $c->cusAddress_Street_Name = $cusArray['inputAddressStreetName'];
    $c->cusAddress_Unit_No = $cusArray['inputAddressUnitNo'];
    $c->cusAddress_BName = $cusArray['inputAddressBuildingName'];
    $c->cusAddress_suburb = $cusArray['inputAddressSuburb'];
    $c->cusAddress_town = $cusArray['inputAddressTown'];
    $c->cusAddress_zip = $cusArray['inputAddressZip'];
    $c->cusProvince = $cusArray['inputAddressProvince'] ;

    $c->saveCustomer();
    
    
}
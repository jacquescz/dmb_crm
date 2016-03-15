<?php
include_once dirname(__FILE__) . './../obj/domain.incl.php';
$d = new domain();


if (isset($_POST['mydata'])) {
    $myArray = $_POST['mydata'];
    $cusArray = array();
    
    
    //var_dump($myArray);
    foreach ($myArray as $value) {
        $name = $value['name'];
        $inputValue = $value['value'];
        $cusArray[$name] = $inputValue;
    }
    
    $d->Id  = $cusArray['inputID'];
    $d->customerID = $cusArray['inputCustomerID'];
    $d->domain = $cusArray['inputDomain'];
    $d->save();
    
    
}
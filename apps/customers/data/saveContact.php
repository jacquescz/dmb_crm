<?php
include_once dirname(__FILE__) . './../obj/contact.incl.php';
$c = new contact();


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
    $c->Name = $cusArray['inputName'];
    $c->Surname = $cusArray['inputSurname'];
    $c->Phone = $cusArray['inputPhone'];
    $c->Cell = $cusArray['inputCell'];
    $c->Email = $cusArray['inputEmail'];
    $c->Type = $cusArray['inputType'];
    $c->CustomerID = $cusArray['contactID'];
    
    
    try {
        $c->save();    
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    
    
}
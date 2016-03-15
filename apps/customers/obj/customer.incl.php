<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

 *  */

/**
 * Description of customer
 *
 * @author jacqu
 */
include_once dirname(__FILE__) . './../../../config.php';

class customer {

    //put your code here

    /*
     * Id,Customer,PaymentMethod,Agent,Ordering,DateStarted,cusAddress_Street_No,cusAddress_Street_Name,cusAddress_Unit_No,cusAddress_BName,cusAddress_suburb,cusAddress_town,cusAddress_zip,cusProvince
     */
    public $Id;
    public $Customer;
    public $PaymentMethod;
    public $Agent;
    public $Ordering;
    public $DateStarted;
    public $cusAddress_Street_No;
    public $cusAddress_Street_Name;
    public $cusAddress_Unit_No;
    public $cusAddress_BName;
    public $cusAddress_suburb;
    public $cusAddress_town;
    public $cusAddress_zip;
    public $cusProvince;
    public $config;
    public $db_connection;

    public function __construct() {
        $this->config = new CRMConfig();
        $this->Id = 0;


        $this->Ordering = 0;
    }

    public function loadCustomer($id) {
        $query = "SELECT `tblcustomers`.* FROM `tblcustomers` where Id = $id";
        $mysqli = new mysqli($this->config->mysql_host, $this->config->mysql_username, $this->config->mysql_password, $this->config->mysql_database);
        if ($result = $mysqli->query($query)) {

            $row = $result->fetch_assoc();
            $this->Id = $id;
            $this->Customer = $row['Customer'];
            $this->PaymentMethod = $row['Customer'];
            $this->Agent = $row['Agent'];
            $this->Ordering = $row['Ordering'];
            $this->DateStarted = $row['DateStarted'];
            $this->cusAddress_Street_No = $row['cusAddress_Street_No'];
            $this->cusAddress_Street_Name = $row['cusAddress_Street_Name'];
            $this->cusAddress_Unit_No = $row['cusAddress_Unit_No'];
            $this->cusAddress_BName = $row['cusAddress_BName'];
            $this->cusAddress_suburb = $row['cusAddress_suburb'];
            $this->cusAddress_town = $row['cusAddress_town'];
            $this->cusAddress_zip = $row['cusAddress_zip'];
            $this->cusProvince = $row['cusProvince'];
            $this->Customer = $row['Customer'];
        }
    }

    public function saveCustomer() {

        if ($this->Id==0) {
            $query = $this->getSaveInsert();
        } else {
            $query = $this->getSaveUpdate();
        }
        
        $mysqli = new mysqli($this->config->mysql_host, $this->config->mysql_username, $this->config->mysql_password, $this->config->mysql_database);
        if ($result = $mysqli->query($query)) {
            print_r($result);
        }
    }

    function getSaveInsert() {
        
            $iArray = array();
            $iArray['Customer'] = $this->Customer;
            $iArray['Agent'] = $this->Agent;
            $iArray['cusAddress_Street_No'] = $this->cusAddress_Street_No;
            $iArray['cusAddress_Street_Name'] = $this->cusAddress_Street_Name;
            $iArray['cusAddress_Unit_No'] = $this->cusAddress_Unit_No;
            $iArray['cusAddress_BName'] = $this->cusAddress_BName;
            $iArray['cusAddress_suburb'] = $this->cusAddress_suburb;
            $iArray['cusAddress_town'] = $this->cusAddress_town;
            $iArray['cusAddress_zip'] = $this->cusAddress_zip;
            $iArray['cusProvince'] = $this->cusProvince;
        
            $keyArray = array();
            $valueArray = array();
            foreach ($iArray as $key => $value) {
                $keyArray[] = "`" . $key . "`";
                $valueArray[] = "'" . $value . "'";
            }
            $keyString = join(",", $keyArray);
            $valuesString = join(",", $valueArray);

            $isql = "insert into tblcustomers ($keyString) values($valuesString) ";
            return $isql;
    }

    function getSaveUpdate() {
       
            $iArray = array();
            $iArray['Customer'] = $this->Customer;
            $iArray['Agent'] = $this->Agent;
            $iArray['cusAddress_Street_No'] = $this->cusAddress_Street_No;
            $iArray['cusAddress_Street_Name'] = $this->cusAddress_Street_Name;
            $iArray['cusAddress_Unit_No'] = $this->cusAddress_Unit_No;
            $iArray['cusAddress_BName'] = $this->cusAddress_BName;
            $iArray['cusAddress_suburb'] = $this->cusAddress_suburb;
            $iArray['cusAddress_town'] = $this->cusAddress_town;
            $iArray['cusAddress_zip'] = $this->cusAddress_zip;
            $iArray['cusProvince'] = $this->cusProvince;
        
            $updateArray = array();
            
            foreach ($iArray as $key => $value) {
                $updateArray[] = $key . "='" . $value . "'";
            }
            $updateString = join(",", $updateArray);
            $sql = "update tblcustomers  set $updateString where  ID = " . $this->Id;
            return $sql;
    }

    public function getMapAddressString() {
        $addressArrayMap = array();
        $addressArrayMap[] = $this->cusAddress_Street_No . " " . $this->cusAddress_Street_Name;
        $addressArrayMap[] = $this->cusAddress_suburb;
        $addressArrayMap[] = $this->cusAddress_town;
        $addressArrayMap[] = $this->cusAddress_zip;
        $addressArrayMap[] = $this->cusProvince;
        $addressArrayMap = $this->clearArray($addressArrayMap);
        $mapString = implode(",", $addressArrayMap);
        $mapStringEncoded = urlencode($mapString);
        return $mapStringEncoded;
    }

    public function getAddressString() {

        $addressArray = array();
        $addressArray[] = $this->cusAddress_Street_No . " " . $this->cusAddress_Street_Name;
        $addressArray[] = $this->cusAddress_Unit_No . " " . $this->cusAddress_BName;
        $addressArray[] = $this->cusAddress_suburb;
        $addressArray[] = $this->cusAddress_town;
        $addressArray[] = $this->cusAddress_zip;
        $addressArray[] = $this->cusProvince;

        $addressArray = $this->clearArray($addressArray);
        $addString = implode(", ", $addressArray);
        return $addString;
    }

    public function clearArray($array) {
        foreach ($array as $link) {
            if ($link == '') {
                unset($link);
            }
        }
        return $array;
    }

}

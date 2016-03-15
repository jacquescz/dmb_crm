<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once dirname(__FILE__) . './../../../config.php';

/**
 * Description of contact
 *
 * @author jacqu
 */
class contact {

    //put your code here
    public $Id;
    public $Name;
    public $Surname;
    public $Phone;
    public $Cell;
    public $Email;
    public $Type;
    public $CustomerID;
    

    public function __construct() {
        $this->config = new CRMConfig();
        $this->Id = 0;


        
    }
    
    
    
    public function loadContact($id) {
        $query = "SELECT * FROM tblcustomer_contacts where conID =$id";
        $mysqli = new mysqli($this->config->mysql_host, $this->config->mysql_username, $this->config->mysql_password, $this->config->mysql_database);
        if ($result = $mysqli->query($query)) {

            $row = $result->fetch_assoc();
            $this->Id = $id;
            $this->Name = $row['conName'];
            $this->Surname = $row['conSurname'];
            $this->Phone = $row['conPhone'];
            $this->Cell = $row['conCell'];
            $this->Email = $row['conEmail'];
            $this->Type = $row['conType'];
            $this->CustomerID = $row['conCustomerID'];

        }
    }

    public function save() {

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
            $iArray['conName'] = $this->Name;
            $iArray['conSurname'] = $this->Surname;
            $iArray['conPhone'] = $this->Phone;
            $iArray['conCell'] = $this->Cell;
            $iArray['conEmail'] = $this->Email;
            $iArray['conType'] = $this->Type;
            $iArray['conCustomerID'] = $this->CustomerID;
        
            $keyArray = array();
            $valueArray = array();
            foreach ($iArray as $key => $value) {
                $keyArray[] = "`" . $key . "`";
                $valueArray[] = "'" . $value . "'";
            }
            $keyString = join(",", $keyArray);
            $valuesString = join(",", $valueArray);

            $isql = "insert into tblcustomer_contacts ($keyString) values($valuesString) ";
            return $isql;
    }

    function getSaveUpdate() {
       
            $iArray = array();
            $iArray['conName'] = $this->Name;
            $iArray['conSurname'] = $this->Surname;
            $iArray['conPhone'] = $this->Phone;
            $iArray['conCell'] = $this->Cell;
            $iArray['conEmail'] = $this->Email;
            $iArray['conType'] = $this->Type;
            $iArray['conCustomerID'] = $this->CustomerID;
        
            $updateArray = array();
            
            foreach ($iArray as $key => $value) {
                $updateArray[] = $key . "='" . $value . "'";
            }
            $updateString = join(",", $updateArray);
            $sql = "update tblcustomer_contacts  set $updateString where  conId = " . $this->Id;
            return $sql;
    }

}

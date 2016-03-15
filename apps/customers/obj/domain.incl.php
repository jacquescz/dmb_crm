<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once dirname(__FILE__) . './../../../config.php';

/**
 * Description of domain
 *
 * @author jacqu
 */
class domain {

    public $customerID;
    public $id;
    public $domain;
    
    
    public function __construct() {
        $this->config = new CRMConfig();
        $this->Id = 0;
        

        
    }
    
    
   public function load($id) {
        $query = "SELECT `tbldomains`.* FROM `tbldomains` where Id= $id";
        $mysqli = new mysqli($this->config->mysql_host, $this->config->mysql_username, $this->config->mysql_password, $this->config->mysql_database);
        if ($result = $mysqli->query($query)) {

            $row = $result->fetch_assoc();
            $this->Id = $id;
            $this->customerID = $row['customerID'];
            $this->domain = $row['domainname'];

        }
    }

    
    public function save() {
        error_log("Savinng Doamin");
        if ($this->Id==0) {
            $query = $this->getSaveInsert();
        } else {
            $query = $this->getSaveUpdate();
        }
        
        $mysqli = new mysqli($this->config->mysql_host, $this->config->mysql_username, $this->config->mysql_password, $this->config->mysql_database);
        if ($result = $mysqli->query($query)) {
            print_r($result);
        }
        error_log("Savinng Done.");
    }

    function getSaveInsert() {
        
            $iArray = array();
            $iArray['customerid'] = $this->customerID;
            $iArray['domainname'] = $this->domain;
            
            
   
        
            $keyArray = array();
            $valueArray = array();
            foreach ($iArray as $key => $value) {
                $keyArray[] = "`" . $key . "`";
                $valueArray[] = "'" . $value . "'";
            }
            $keyString = join(",", $keyArray);
            $valuesString = join(",", $valueArray);

            $isql = "insert into tbldomains ($keyString) values($valuesString) ";
            return $isql;
    }

    function getSaveUpdate() {
       
            $iArray = array();
            $iArray['customerID'] = $this->customerID;
            $iArray['domainname'] = $this->domain;
        
            $updateArray = array();
            
            foreach ($iArray as $key => $value) {
                $updateArray[] = $key . "='" . $value . "'";
            }
            $updateString = join(",", $updateArray);
            $sql = "update tbldomains  set $updateString where  ID = " . $this->Id;
            return $sql;
    }

}

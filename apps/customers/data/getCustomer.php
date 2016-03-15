<?php
include_once dirname(__FILE__) . './../obj/customer.incl.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = $_POST['contactid'];


$c = new customer();
$c->loadCustomer($id);



$addressArray = array();
$addressArray[] = $c->cusAddress_Street_No . " " . $c->cusAddress_Street_Name;
$addressArray[] = $c->cusAddress_Unit_No . " " . $c->cusAddress_BName;
$addressArray[] = $c->cusAddress_suburb;
$addressArray[] = $c->cusAddress_town;
$addressArray[] = $c->cusAddress_zip;
$addressArray[] = $c->cusProvince;
$mapStringEncoded = $c->getMapAddressString();
$addressString = $c->getAddressString();
?>
<div>
    <h2><?php echo $c->Customer; ?></h2>
    <div class="customer-address panel panel-default">
        <div class="panel-body">

            <?php
            echo $addressString;
            ?>
            <a href="#customerMap"><span class="glyphicon glyphicon-map-marker"></span> map</a>

        </div>
    </div>
    <div>
        <div class="container">
            <a href="#secContacts" class="btn btn-link">Contact(s)</a> | 
            <a class="btn btn-link">Domain(s)</a> | 
            <a class="btn btn-link">Package(s)</a> | 
        </div>
        <hr/>
        <a id="secContacts"></a>
        <div class="customer-contacts panel panel-default ">
            <div class="panel-heading">Contact(s)</div>
            <p class="panel-body">
                <button class="btn btn-primary" onclick="addContact(<?php echo $c->Id; ?>)">Add Contact</button>
                <button onclick="getContacts(<?php echo $id ?>)" class="btn">Refresh</button>
            </p>
            <div id="customer-contacts" class="panel-body">
                <div class="alert-warning">
                    <div class="container">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        No Contact(s) found
                    </div>
                </div>    
            </div> 
        </div>        



        <div class="customer-domains panel panel-default">
            <div class="panel-heading">Domain(s)</div>
            <p class="panel-body">
                <button class="btn btn-primary" onclick="addDomain(<?php echo $id ?>)">Add Domain</button>
                <button onclick="getDomains(<?php echo $id ?>)" class="btn">Refresh</button>
            </p>
            <div id="customer-domains" class="panel-body">
                <span class="alert-warning">No domain(s) found</span>    
            </div> 
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Package(s)</div>
            <p class="panel-body">
                <button class="btn btn-primary">Add Package</button>
                <button onclick="getPackages(<?php echo $id ?>)" class="btn">Refresh</button>
            </p>
            <div id="customer-packages" class="panel-body">
                <span class="alert-warning">No package(s) found</span>    
            </div>             


        </div>


    </div>

    <a name="customerMap"></a>
    <div class='panel panel-default'>
        <div class='panel-heading'>Map</div>
        <div class='panel-body'>
            <div id="map-canvas" class="panel panel-default">
                <div style="width:100%;overflow:hidden;height:300px;max-width:100%;">
                    <div id="my-map-canvas" style="height:100%; width:100%;max-width:100%;">
                        <iframe style="height:100%;width:100%;border:0;" frameborder="0" 
                        src="https://www.google.com/maps/embed/v1/place?q=<?php echo $mapStringEncoded; ?>&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="code-for-google-map" href="https://www.interserver-coupons.com" id="enable-map-data">interserver-coupons.com</a><style>#my-map-canvas .text-marker{max-width:none!important;background:none!important;}img{max-width:none}</style></div><script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=45e6a10e-5326-173a-28e3-f22307172a91&c=code-for-google-map&u=1457299657" defer="defer" async="async"></script>
            </div>
        </div>
    </div>


    <script>
                    getDomains(<?php echo $id; ?>);
                    getPackages(<?php echo $id; ?>);
                    getContacts(<?php echo $id; ?>);


                    function getContacts(id) {
                        $("#customer-contacts").html("<span class='glyphicon glyphicon-refresh'></span>");
                        $.post('./apps/customers/data/getContacts.php', {customerid: id}, function (data) {
                            $("#customer-contacts").html(data);
                        });
                    }

                    function getDomains(id) {
                        $("#customer-domains").html("<span class='glyphicon glyphicon-refresh'></span>");
                        $.post('./apps/customers/data/getDomains.php', {customerid: id}, function (data) {
                            $("#customer-domains").html(data);
                        });
                    }

                    function getPackages(id) {
                        $("#customer-packages").html("Loading.");
                        $.post('./apps/customers/data/getPackages.php', {customerid: id}, function (data) {
                            $("#customer-packages").html(data);
                        });
                    }


                    function addDomain(id) {
                        alert(id);
                        $.post("./apps/customers/forms/formDomain.php", {customerid: id}, function (data) {
                            $("#modal-body").html(data);
                            $('#myModal').modal('show')
                        });




                    }
                    
                    
                    
                    
                    function addContact(id) {

                        $.post("./apps/customers/forms/formContact.php", {customerid: id}, function (data) {
                            $("#modal-body").html(data);
                            $('#myModal').modal('show')
                            getContacts(<?php echo $id; ?>);
                        });




                    }

                    function navPackage(id) {

                        $("#appTitle").html("Loading");
                        $.post("./apps/customers/package.php", {packageid: id}, function (data) {
                            $("#appTitle").html("Customer|package");
                            $("#appcontent").html(data);
                            //alert(data);
                        });
                    }


    </script>

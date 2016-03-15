<?php
include_once dirname(__FILE__) . './../obj/customer.incl.php';
$c = new customer();
$customerid = 0;



if (isset($_POST['customerid'])) {
    $customerid = $_POST['customerid'];
    $c->loadCustomer($customerid);
}
if ($customerid == 0) {
    $noticeMessage = "Enter the New Customer's Information below in the form";
} else {
    $noticeMessage = "Edit the current customer's Information";
}
?>




<div class="alert alert-info"><span class="glyphicon glyphicon-info-sign "></span> <?php echo $noticeMessage; ?> </div>
<form class="form-horizontal" id="fromCustomer" action="./apps/customers/data/saveCustomer.php">

    <input type="hidden" id="inputID" name="inputID" value="<?php echo $c->Id; ?>">

    <div class="form-group">
        <label for="inputCustomer" class="col-sm-2 control-label">Customer</label>
        <div class="col-sm-10">
            <input name="inputCustomer" type="text" class="form-control" id="inputCustomer" value="<?php echo $c->Customer; ?>" placeholder="Customer (Company)">
        </div>
    </div>



    <div class="form-group">
        <label for="selectAgent" class="col-sm-2 control-label">Agent</label>
        <div class="col-sm-10">

            <select name="selectAgent" id="selectAgent" class="form-control" >

                <option value="1" >Cheri</option>
                <option value="2">Jacques</option>
                <option value="3">Luke</option>
            </select>
        </div>
    </div>

    <fieldset >
        <legend>Address</legend>

        <div class="form-group">
            <label for="inputAddressStreetNo" class="col-sm-2 control-label">Street No</label>
            <div class="col-sm-10">
                <input name="inputAddressStreetNo" type="text" class="form-control" id="inputAddressStreetNo" value="<?php echo $c->cusAddress_Street_No; ?>" placeholder="Street No">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressStreetName" class="col-sm-2 control-label">Street Name</label>
            <div class="col-sm-10">
                <input name="inputAddressStreetName" type="text" class="form-control" id="inputAddressStreetName" value="<?php echo $c->cusAddress_Street_Name; ?>" placeholder="Street Name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressUnitNo" class="col-sm-2 control-label">Unit No</label>
            <div class="col-sm-10">
                <input name="inputAddressUnitNo" type="text" class="form-control" id="inputAddressUnitNo" value="<?php echo $c->cusAddress_Unit_No; ?>" placeholder="Unit No">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressBuildingName" class="col-sm-2 control-label">Build/Complex</label>
            <div class="col-sm-10">
                <input name="inputAddressBuildingName" type="text" class="form-control" id="inputAddressBuildingName" value="<?php echo $c->cusAddress_BName; ?>" placeholder="Build/Complex">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressSuburb" class="col-sm-2 control-label">Suburb</label>
            <div class="col-sm-10">
                <input name="inputAddressSuburb" type="text" class="form-control" id="inputAddressSuburb" value="<?php echo $c->cusAddress_suburb; ?>" placeholder="Suburb">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressTown" class="col-sm-2 control-label">Town</label>
            <div class="col-sm-10">
                <input name="inputAddressTown" type="text" class="form-control" id="inputAddressTown" value="<?php echo $c->cusAddress_town; ?>" placeholder="Town">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressZip" class="col-sm-2 control-label">Zip</label>
            <div class="col-sm-10">
                <input name="inputAddressZip" type="text" class="form-control" id="inputAddressZip" value="<?php echo $c->cusAddress_zip; ?>" placeholder="Zip">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddressProvince" class="col-sm-2 control-label">Province</label>
            <div class="col-sm-10">
                <div id="bloodhound">
                    <input name="inputAddressProvince" autocomplete="off" data-provide="typeahead" type="text" class="form-control typeahead" id="inputAddressProvince" value="<?php echo $c->cusProvince; ?>" placeholder="Province">



                </div>
            </div>


    </fieldset>




    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" onclick="saveCustomer();" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
        </div>
    </div>
</form>




<script>

    function saveCustomer() {
        var vinputs = $('#fromCustomer :input');
        var values = $('#fromCustomer').serializeArray();
        console.log(values);
        alert(values);
        $.post("./apps/customers/data/saveCustomer.php", {mydata: values}, function (data) {
            var msg;
            if (data == 1) {
                msg = "Customer Saved!";
                $("#modal-body")
                $("#modal-title").html("Customer");
                $("#modal-body").html(msg);
                $('#myModal').modal('show')
                getCustomers();
            } else {
                msg = data;
                $("#modal-body")
                $("#modal-title").html("Customer");
                $("#modal-body").html(msg);
                $('#myModal').modal('show')
            }


        });
    }
    
    
    
    var states = [
        'The Eastern Cape',
        'The Free State',
        'Gauteng',
        'KwaZulu-Natal',
        'Limpopo',
        'Mpumalanga',
        'The Northern Cape',
        'North West',
        'The Western Cape'
    ];


    // constructs the suggestion engine
    var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: states
    });

    $('#bloodhound .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'states',
        source: states
    });


</script>
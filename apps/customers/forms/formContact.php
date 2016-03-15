<?php
$customerID = $_POST['customerid'];

$contactid = 0;
?>
<form class="form-horizontal" id="formContact">
    <input type="hidden" class="form-control" id="contactID" name="contactID" placeholder="0" value="<?php echo $customerID; ?>">
    <input type="hidden" class="form-control" id="inputID" name="inputID" placeholder="0" value="<?php echo $contactid; ?>">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">
        </div>
    </div>
    <div class="form-group">
        <label for="inputSurname" class="col-sm-2 control-label">Surname</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputSurname" name="inputSurname" placeholder="Surname">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Phone">
        </div>
    </div>
    <div class="form-group">
        <label for="inputCell" class="col-sm-2 control-label">Cell</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputCell" name="inputCell" placeholder="Cell">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">EMail</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="EMail">
        </div>
    </div>
    <div class="form-group">
        <label for="inputType" class="col-sm-2 control-label">Type</label>
        <div class="col-sm-10">
            <input type="text"  class="form-control" id="inputType" name="inputType" placeholder="Type">
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" onclick="saveContact()">Save</button>
        </div>
    </div>
</form>
<script>
    function saveContact() {
        var values = $('#formContact').serializeArray();
        $.post("./apps/customers/data/saveContact.php", {mydata: values}, function (data) {
            var msg;
            $("#modal-title").html("Contact");
            if (data == 1) {
                msg = "Contact Saved!";
                $("#modal-body").html(msg);
                $('#myModal').modal('show')
            } else {
                msg = data;
                $("#modal-body").html(msg);
                $('#myModal').modal('show')
            }
        });
    }




</script>
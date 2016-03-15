<?php 
$customerID = $_POST['customerid'];

?>
<form class="form-horizontal" id="formDomain">
    <input type="text" name="inputCustomerID" value="<?php echo $customerID; ?>" >
    <input type="text" name="inputID" value="<?php echo "0"; ?>" >
    <div class="form-group">
        <label for="inputDomain" class="col-sm-2 control-label">Domain</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputDomain" name="inputDomain" placeholder="Domain">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" onclick="saveDoamin();" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
<script>
    function saveDoamin() {
        var values = $('#formDomain').serializeArray();
        $.post("./apps/customers/data/saveDomain.php", {mydata: values}, function (data) {
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
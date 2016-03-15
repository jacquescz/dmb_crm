<?php
$packageid = $_POST['packageid'];
?>



<div class='panel panel-default'>
    <div class='panel-heading'>Package Info</div>
    <div id='customer-package-customerinfo' class='panel-body'>
        <div class="alert-warning">
            <div class="container">
                <span class="glyphicon glyphicon-warning-sign"></span>
                Package found
            </div>
        </div>    
    </div>
</div>



<div class='panel panel-default'>
    <div class='panel-heading'>Services</div>
            <p class="panel-body">
                <button class="btn btn-primary" onclick="">Add Service</button>
                <button onclick="getServices(<?php echo $packageid; ?>)" class="btn">Refresh</button>
            </p>
    <div id='customer-package' class='panel-body'>
        <div class="alert-warning">
            <div class="container">
                <span class="glyphicon glyphicon-warning-sign"></span>
                Services No Found
            </div>
        </div>  
    </div>
</div>


<script>
    getServices(<?php echo $packageid; ?>);
    getPackageInfo(<?php echo $packageid; ?>);
    function getServices(id) {
        $("#customer-package").html("<span class='glyphicon glyphicon-refresh'></span>");
        $.post('./apps/customers/data/getPackage.php', {packageid: id}, function (data) {
            $("#customer-package").html(data);
        });
    }
    function getPackageInfo(id) {
        $("#customer-package-customerinfo").html("<span class='glyphicon glyphicon-refresh'></span>");
        $.post('./apps/customers/data/getPackageInfo.php', {packageid: id}, function (data) {
            $("#customer-package-customerinfo").html(data);
        });
    }
</script>
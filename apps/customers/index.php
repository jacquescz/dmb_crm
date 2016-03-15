
<p class="panel-body">
    <button class="btn btn-primary" onclick="formCustomer(0);">Add Customer</button>
    <button onclick="getCustomers();" class="btn">Refresh</button>
</p>

<div class="form-group">
    
    <span class="glyphicon glyphicon-search"></span><label class="">Search</label>
    <input id="searchCustomer" type="text" name="searchCustomer" value="" class="form-control" onkeyup="getCustomers()" />
</div>

<div id="cusotmerspage">
    
</div>


<script type="text/javascript">

    getCustomers();

    function getCustomers() {
        var search = $("#searchCustomer").val();
        $("#appTitle").html("Loading");
        $.post("./apps/customers/data/getCustomers.php", {searchstring:search}, function (data) {
            $("#appTitle").html("Customer");
            $("#cusotmerspage").html(data);
        });
    }



    function getCustomer(id) {
        $("#appTitle").html("Loading");
        $.post("./apps/customers/data/getCustomer.php", {contactid: id}, function (data) {
            $("#appTitle").html("Customer");
            $("#appcontent").html(data);
            //alert(data);
        });
    }

    function formCustomer(id) {
        $.post("./apps/customers/forms/formCustomer.php", {customerid: id}, function (data) {

            //msgbox("Customer",data);

            $("#appTitle").html("Customer");
            $("#appcontent").html(data);

            //alert(data);
        });
    }
    
    
    
</script>

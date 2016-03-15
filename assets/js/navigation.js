/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function navApp(appName) {
    
    var apps  = {
        dashboard:'Dashboard',
        customers:'Customers',
        invoice:'Invoicing',
        leads:'Leads'
    };
    
    
    //alert(apps[appName]);
    $("#appTitle").html ('Loading...');
    $("#appcontent").html("Loading.....")
    $("#appTitle").html (apps[appName]);
    $("#appcontent").load("./apps/" + appName + "/index.php");
}
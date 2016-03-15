<?php
include_once './config.php';
$c = new CRMConfig();
?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Digital Marketing Buzz - CRM</title>

        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>



        <!-- BOOTSTRAP STYLES-->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>        

        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />

        <!-- CUSTOM STYLES-->
        <link href="assets/css/cus.css" rel="stylesheet" />




        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modal-title">Modal Header</h4>
                    </div>
                    <div id="modal-body" class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>      










        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">DMB</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="" ><a href="#"  onclick="navApp('dashboard');"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                        <li><a href="#">Leads</a></li>
                        <li><a href="#" onclick="navApp('customers');">Customers</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">
            <div class="container">
                <div style="height: 50px;"></div>
            <h2 class="h1" id="appTitle">ADMIN DASHBOARD</h2> 
            <div id = "appcontent" class="">

            </div>
            </div>


        </div><!-- /.container -->        





        <div class="footer ">
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2016 TURSET | Design by: <a href="www.turset.co.za" style="color:#fff;" target="_blank">www.turset.co.za</a>
                </div>
            </div>
        </div>


        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/navigation.js"></script>

        <script src="assets/js/initial.min.js"></script>

        <script src="assets/plugins/chart/Chart.js"></script>

        <script src="assets/js/typeahead/typeahead.bundle.js"></script>
        <script src="assets/js/typeahead/bloodhound.js"></script>


        <script type="text/javascript">

                            navApp('dashboard');


                            function msgbox(title, content) {

                                $("#modal-title").html(title);
                                $("#modal-body").html(content);
                                $("#myModal").modal();

                            }


        </script>



    </body>
</html>

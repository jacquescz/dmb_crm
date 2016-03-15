<div class="text-center">
    <h1>Digital Marketing Buzz</h1>
    <p class="lead">SEO | SOCIAL</p>
</div>
<?php
$ditems = array(
    'customers' => ['fa-users', 'Customers'],
    'domains' => ['fa-globe', 'Domain(s)']
);
//var_dump($ditems);
?>
<div class="text-center">

    <?php
    foreach ($ditems as $key => $value) {
        ?>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 dashbutton">
            <div onclick="navApp('<?php echo $key; ?>')">
                <i class="fa <?php echo $value[0]; ?> fa-5x"></i>
                <h4><?php echo $value[1]; ?></h4>
            </div>
        </div> 

    <?php } ?>

</div>




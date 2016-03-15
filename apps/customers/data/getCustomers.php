<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$mysqli = new mysqli('127.0.0.1', 'root', '', 'dmb_crm');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$searchstring = $_POST['searchstring'];

$query = "select * from  view_customers where customer like '%" . $searchstring . "%'";
?>


<?php
if ($result = $mysqli->query($query)) {
    ?>




    <table class='table table-striped'>
        <thead>
        <!--<th>id</th>-->
        
        <th>Customer</th>
        <th>Agent</th>
        <th>Domain(s)</th>
        <th>Package(s)</th>
        <th>Domain(s)</th>
    </thead>
    <tbody>



    <?php
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //print_r($row);
        //printf ("%s (%s)\n", $row["Id"], $row["Customer"]);
        ?>


            <tr >
                <td><a href="#" onclick="getCustomer(<?php echo $row['Id'] ?>)">
                <img data-name="<?php echo $row['Customer'] ?>" class="lAvatar" />
                <!--<td><?php echo $row['Id'] ?></td>-->
                <?php echo $row['Customer'] ?></a></td>
                <td><?php echo $row['agtNAme'] ?></td>
                <td class="text-center"><?php echo $row['domains'] ?></td>

                <td class="text-center"><?php echo $row['packages'] ?></td>
                <td><?php echo $row['PaymentMethod'] ?></td>
                <td>
                    <span onclick="formCustomer(<?php echo $row['Id'] ?>);" class="glyphicon glyphicon-edit btn btn-info red-tooltip" data-toggle="tooltip" title="Edit Customer"></span>
                    <span class="glyphicon glyphicon-remove btn btn-danger" data-toggle="tooltip" title="Remove Customer"></span>
                </td>
            </tr>

        <?php
    }

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();
?>

</tbody>

</table>
<script>
    $(document).ready(function () {
        $('.lAvatar').initial({
            name: 'Name', // Name of the user
            charCount: 1, // Number of characherts to be shown in the picture.
            textColor: '#ffffff', // Color of the text
            seed: 1, // randomize background color
            height: 30,
            width: 30,
            fontSize: 26,
            fontWeight: 400,
            fontFamily: 'HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica, Arial,Lucida Grande, sans-serif',
            radius: 0
        });
    })
</script>
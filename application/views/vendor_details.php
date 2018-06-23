<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 20-Dec-17
 * Time: 10:03 AM
 * Project: procurement
 */

//var_dump($vendor_details);
require_once(APPPATH.'views/includes/header.php');
?>
    <table class="table table-bordered table-striped">
    <tr>
        <th>Name: </th>
        <td><?php echo $vendor_details->vendor_name;?></td>
    </tr>
    <tr>
        <th>Contact: </th>
        <td><?php echo $vendor_details->vendor_contact;?></td>
    </tr>
    <tr>
        <th>Email: </th>
        <td><?php echo $vendor_details->vendor_email;?></td>
    </tr>
    <tr>
        <th>Telephone: </th>
        <td><?php echo $vendor_details->vendor_telephone;?></td>
    </tr>
    <tr>
        <th>Address: </th>
        <td><?php echo $vendor_details->vendor_address;?></td>
    </tr>
    <tr>
        <th>Service Provided: </th>
        <td><?php echo $vendor_details->vendor_service;?></td>
    </tr>
    <tr>
        <th>Account Details: </th>
        <td><?php echo $vendor_details->vendor_account_details;?></td>
    </tr>
    <tr>
        <th>Approved: </th>
        <td><?php echo ($vendor_details->is_approved =='1') ? 'Approved' : 'Not Approved' ;?></td>
    </tr>
</table>

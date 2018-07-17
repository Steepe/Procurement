<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 20-Dec-17
 * Time: 9:52 AM
 * Project: procurement
 */

require_once(APPPATH.'views/includes/header.php');
require_once(APPPATH.'views/includes/navigation.php');
require_once(APPPATH.'views/includes/left_sidebar.php');
?>

        <br>
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i>Quotations List</h6></div>
            <!--<div class="datatable-ajax-source">-->
            <table id="requestList">
                <thead>
                <tr>
                    <th>Quotation ID</th>
                    <th>Requested Subject</th>
                    <th>Vendor Name</th>
                    <th>Date Uploaded</th>
                    <th>Uploaded by</th>
                </tr>
                </thead>
                <?php
                    foreach($get_uploaded_quotes as $get_uploaded_quote){
                        ?>
                        <tr>
                            <td><?php echo $get_uploaded_quote['quotation_id'];?></td>
                            <td><a href="<?php echo base_url('quotations/view_quote/'.$get_uploaded_quote['quotation_id']); ?>"> <?php echo $get_uploaded_quote['request_subject'];?></a></td>
                            <td><?php echo $get_uploaded_quote['vendor_name'];?></td>
                            <td><?php echo $get_uploaded_quote['uploaded_by'];?></td>
                            <td><?php echo $get_uploaded_quote['time_uploaded'];?></td>
                        </tr>
                        <?php
                    }
                ?>

                <tfoot>

                <tr>
                    <th>Quotation ID</th>
                    <th>Requested Subject</th>
                    <th>Vendor Name</th>
                    <th>Date Uploaded</th>
                    <th>Uploaded by</th>
                </tr>
                </tfoot>
            </table>
            <!--</div>-->
        </div>
<?php
require_once(APPPATH.'views/includes/footer.php');
?>
<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 29-Nov-17
 * Time: 2:33 PM
 * Project: procurement
 */

require_once(APPPATH.'views/includes/header.php');
?>
<body>

<?php require_once(APPPATH.'views/includes/navigation.php'); ?>
<!-- Page container -->
<div class="page-container">
    <?php require_once(APPPATH.'views/includes/left_sidebar.php'); ?>
    <!-- Page content -->
    <div class="page-content">
        <br>
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li class="active">New Purchase Order</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>

        </div>
        <!-- /breadcrumbs line -->
        <br>

        <?php
        if(isset($success)){
            if($success == "success"){
                ?>
                <div class="alert alert-success fade in block-inner">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-checkmark-circle"></i>Your request has been successfully submitted.
                </div>
                <?php
            }
            elseif($success == "fail"){
                ?>
                <div class="alert alert-danger fade in block-inner">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon-cancel-circle"></i> Your request has NOT been successfully submitted.
                </div>
                <?php
            }
        }
        ?>
        <!-- Form bordered -->
        <form class="form-horizontal form-bordered" id="procurement_form" action="<?php echo base_url('purchase_orders/submit_purchase_order'); ?>" method="post" enctype="multipart/form-data" role="form" accept-charset="utf-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Purchase Order Form</h6></div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Supplier :</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="supplier" id="supplier">
                                <option>Choose Vendor</option>
                                <?php
                                   foreach ($po_vendors as $po_vendor){
                                ?>
                                    <option value="<?php echo $po_vendor['vendor_name'];?>"><?php echo $po_vendor['vendor_name'];?></option>
                                <?php
                                    }
                                ?>

                            </select>
                            <?php echo form_error('supplier'); ?>
                        </div>
                        <label class="col-sm-2 control-label">Payment Method:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="transfer">Bank Transfer</option>
                            </select>
                            <?php echo form_error('payment_method'); ?>
                        </div>
                    </div>

                    <div class="form-group" id="to_duplicate">
                        <label class="col-sm-2 control-label">Item(s): </label>
                        <div class="col-sm-2">
                            <textarea id="description_1" name="description_1" class="form-control" placeholder="Description"></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" min="1" id="quantity_1" name="quantity_1" class="form-control stark" value="<?php echo set_value('Quantity'); ?>" placeholder="Quantity">
                            <?php echo form_error('quantity'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" step=".01" min="1" id="unit_price_1" name="unit_price_1" class="form-control" value="<?php echo set_value('unit_price'); ?>" placeholder="Unit Price" onchange="javascript:getSubTotal();">
                            <?php echo form_error('unit_price'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" id="total_1" name="total_1" class="form-control" value="<?php echo set_value('unit_price'); ?>" placeholder="Total" readonly>
                            <?php echo form_error('unit_price'); ?>
                        </div>
                        <input type="text" id="item_counter" name="item_counter" value="1">
                        <input type="hidden" name="form_page" id="form_page" value="<?php echo set_value('form_page', 'purchase_orders/new_'); ?>" /></td>
                    </div>
                    <div id="more_items_div"></div>

                    <input type="button" id="add_item" name="add_item" class="btn btn-primary" value="+Add An Item"><br><br>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Notes:</label>
                        <div class="col-sm-10">
                            <textarea rows="5" cols="5" class="form-control" id="notes" name="notes"><?php echo set_value('notes'); ?></textarea>
                            <?php echo form_error('notes'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Multiple file uploader inside panel -->
                        <div class="panel panel-primary">
                            <div class="panel-heading"><h6 class="panel-title"><i class="icon-file-upload"></i> Upload your files (PDF, Images, Excel and Word documents)</h6></div>
                            <div class="multiple-uploader" id="uploader">Your browser doesn't support native upload.</div>
                        </div>
                        <!-- /multiple file uploader with header inside panel -->
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Created by:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="created_by" id="created_by" value="<?php echo set_value('created_by', $this->session->userdata('employee_name')); ?>" readonly>
                            <?php echo form_error('created_by'); ?>
                        </div>
                    </div>


                    <div class="form-actions text-right">
                        <input type="reset" value="Cancel" class="btn btn-danger">
                        <input type="submit" value="Submit form" class="btn btn-primary" id="submitreq">
                    </div>

                </div>
            </div>
        </form>
        <!-- /form striped -->

<?php
        require_once(APPPATH.'views/includes/footer.php');
?>


<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 12/4/14
 * Time: 7:06 PM
 */

require_once(APPPATH.'views/includes/header.php');
require_once(APPPATH.'views/includes/navigation.php');
require_once(APPPATH.'views/includes/left_sidebar.php');

$int_no = (int)$last_id->req_id;
$last_no = sprintf("%05d", $int_no + 1);
$procurement_no = "HOF-".$last_no;
?>

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


    <aside class="right-side">
    <!-- Content Header (Page header) -->

    <section class="content">
    <div class="row">
    <div class="col-md-12">
    <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fa fa-fw ti-move"></i> Product Request Form
        </h3>
        <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
    </div>
    <div class="panel-body">

                            <form id="procurement_form" action="<?php echo base_url('do_submit_request'); ?>" method="post" enctype="multipart/form-data" role="form" accept-charset="utf-8">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span>Requisition No.:</span></div>
                                                <input type="text" class="form-control"name="procurement_no" id="procurement_no" value="<?php echo set_value('procurement_no', $procurement_no); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Requisition Subject:</div>
                                                <input type="text" class="form-control" name="request_subject" id="request_subject" value="<?php echo set_value('request_subject'); ?>" required>
                                                <?php echo form_error('request_subject'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span>Product Name:</span></div>
                                                <input type="text" class="form-control" name="product_name" id="product_name" required>
                                                <?php echo form_error('product_name'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span>Brand:</span></div>
                                                <input type="text" class="form-control" name="brand" id="brand" value="<?php echo set_value('brand'); ?>">
                                                <?php echo form_error('brand'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span>Model:</span></div>
                                                <input type="text" class="form-control" name="model" id="model" value="<?php echo set_value('model'); ?>">
                                                <?php echo form_error('model'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">size:</span></div>
                                                <input type="text" class="form-control" name="size" id="size" value="<?php echo set_value('size'); ?>">
                                                <?php echo form_error('size'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">Other Description</label>
                                            <textarea class="form-control" rows="5" id="description" name="description" required><?php echo set_value('description'); ?></textarea>
                                            <?php echo form_error('description'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left"> Justification</label>
                                            <textarea class="form-control" rows="5" id="justification" name="justification" required><?php echo set_value('justification'); ?></textarea>
                                            <?php echo form_error('justification'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">quantity:</span></div>
                                                <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo set_value('quantity'); ?>" required>
                                                <?php echo form_error('quantity'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">amount:</span></div>
                                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount'); ?>" required>
                                                <?php echo form_error('amount'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">suggested supplier:</span></div>
                                                <input type="text" class="form-control" name="suggested_supplier" id="suggested_supplier" value="<?php echo set_value('suggested_supplier'); ?>">
                                                <?php echo form_error('suggested_supplier'); ?>
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
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">delivered to:</span></div>
                                                <input type="text" class="form-control" name="deliver_to" id="deliver_to" value="<?php echo set_value('deliver_to'); ?>" required>
                                                <?php echo form_error('deliver_to'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">requested by:</span></div>
                                                <input type="text" class="form-control" name="requested_by" id="requested_by" value="<?php echo set_value('requested_by', $this->session->userdata('employee_name')); ?>" readonly>
                                                <?php echo form_error('requested_by'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="text-capitalize">department name:</span></div>
                                                <input type="text" class="form-control" name="department_name" id="department_name" value="<?php echo set_value('department_name', $this->session->userdata('department_name')); ?>" disabled>
                                                <?php echo form_error('department_name'); ?>
                                            </div>
                                        </div>

                                        <input type="hidden" name="department_id" id="department_id" value="<?php echo set_value('department_id', $this->session->userdata('department_id')); ?>" />
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id', $this->session->userdata('employee_id')); ?>" /></td>
                                        <input type="hidden" name="form_page" id="form_page" value="<?php echo set_value('form_page', 'request/product'); ?>" /></td>
                                        <input type="hidden" name="request_type" id="request_type" value="<?php echo set_value('request_type', 'Product'); ?>" /></td>
                                        <button type="submit" class="btn btn-success mr-10">Submit</button>
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                    </form>

    </div>
    </div>
    </div>
    </div>
        <!--main content ends-->
        <div class="background-overlay"></div>
    </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
    </div>
    <!-- ./wrapper -->


<?php
    require_once(APPPATH.'views/includes/footer.php');
    ?>
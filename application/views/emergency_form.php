<?php
/**
 * Created by PhpStorm.
 * Author: Oluwamayowa Steepe
 * Date: 8/12/2015
 * Time: 2:51 PM
 */

require_once(APPPATH.'views/include/header.php');
$this->session->unset_userdata('last_page');

$int_no = (int)$last_id->req_id;
$last_no = sprintf("%05d", $int_no + 1);
$procurement_no = "HOF-EMY-".$last_no;
?>

    <body>
<?php require_once(APPPATH.'views/include/navigation.php'); ?>
    <!-- Page container -->
<div class="page-container">
<?php require_once('include/left_sidebar.php'); ?>
    <!-- Page content -->
    <div class="page-content">



    <br>
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li><a href="<?php echo base_url('procurement');?>">Procurement</a></li>
            <li class="active">Emergency Request Form</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>

    </div>
    <!-- /breadcrumbs line -->
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
    <form class="form-horizontal form-bordered" id="procurement_form" action="<?php echo base_url('procurement/request/do_submit_emergency_request'); ?>" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Emergency Request Form</h6></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Requisition No.:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="procurement_no" id="procurement_no" value="<?php echo set_value('procurement_no', $procurement_no); ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Requisition Subject:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="request_subject" id="request_subject" value="<?php echo set_value('request_subject'); ?>" >
                        <?php echo form_error('request_subject'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Brief of Emergency:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="emergency_brief" name="emergency_brief"><?php echo set_value('emergency_brief'); ?></textarea>
                        <?php echo form_error('emergency_brief'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Justification of Emergency:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="emergency_justification" name="emergency_justification"><?php echo set_value('emergency_justification'); ?></textarea>
                        <?php echo form_error('emergency_justification'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Justification of Vendor Choice:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="justification_vendor" name="justification_vendor"><?php echo set_value('justification_vendor'); ?></textarea>
                        <?php echo form_error('justification_vendor'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Specific Agreement made with vendors (if any) including payment terms:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="specific_agreement" name="specific_agreement"><?php echo set_value('specific_agreement'); ?></textarea>
                        <?php echo form_error('specific_agreement'); ?>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Required Price and Quantity:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="price_quantity" id="price_quantity" value="<?php echo set_value('amount'); ?>" >
                        <?php echo form_error('amount'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Estimated Cost:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="estimated_cost" id="estimated_cost" value="<?php echo set_value('amount'); ?>" >
                        <?php echo form_error('amount'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Delivered To:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deliver_to" id="deliver_to" value="<?php echo set_value('deliver_to'); ?>">
                        <?php echo form_error('deliver_to'); ?>
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
                    <label class="col-sm-2 control-label">Requested by:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="requested_by" id="requested_by" value="<?php echo set_value('requested_by', $this->session->userdata('employee_name')); ?>" readonly >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Department Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="department_name" id="department_name" value="<?php echo set_value('department_name', $this->session->userdata('department_name')); ?>" disabled >
                    </div>
                </div>
                <input type="hidden" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id', $this->session->userdata('employee_id')); ?>" />
                <input type="hidden" name="department_id" id="department_id" value="<?php echo set_value('department_id', $this->session->userdata('department_id')); ?>" />
                <input type="hidden" name="last_page" id="last_page" value="<?php echo set_value('last_page', 'procurement/request/emergency_requests'); ?>" /></td>

                <div class="form-actions text-right">
                    <input type="reset" value="Cancel" class="btn btn-danger">
                    <input type="submit" value="Submit form" class="btn btn-primary" id="submitreq">
                </div>

            </div>

        </div>

    </form>

    <?php
require_once(APPPATH.'views/include/footer.php');
    ?>
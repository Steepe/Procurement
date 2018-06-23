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
                                <i class="fa fa-fw ti-move"></i> Project Request Form
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
    <!-- Form bordered -->
    <form class="form-horizontal form-bordered" id="procurement_form" action="<?php echo base_url('do_submit_request'); ?>" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
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
                    <label class="col-sm-2 control-label">Project Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="project_name" id="project_name" value="<?php echo set_value('project_name'); ?>" >
                        <?php echo form_error('project_name'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Project Owner:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="project_owner" id="project_owner" value="<?php echo set_value('project_owner'); ?>" >
                        <?php echo form_error('project_owner'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Other Description:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="description" name="description"><?php echo set_value('description'); ?></textarea>
                        <?php echo form_error('description'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Amount:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount'); ?>" >
                        <?php echo form_error('amount'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <!-- Multiple file uploader inside panel -->
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-file-upload"></i> Uploader inside panel</h6></div>
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
                    <label class="col-sm-2 control-label">Requested by:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="department_name" id="department_name" value="<?php echo set_value('department_name', $this->session->userdata('department_name')); ?>" disabled >
                    </div>
                </div>
                <input type="hidden" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id', $this->session->userdata('employee_id')); ?>" />
                <input type="hidden" name="department_id" id="department_id" value="<?php echo set_value('department_id', $this->session->userdata('department_id')); ?>" />
                <input type="hidden" name="form_page" id="form_page" value="<?php echo set_value('form_page', 'request/project'); ?>" /></td>
                <input type="hidden" name="request_type" id="request_type" value="<?php echo set_value('request_type', 'Project'); ?>" /></td>
                <div class="form-actions text-right">
                    <input type="reset" value="Cancel" class="btn btn-danger">
                    <input type="submit" value="Submit form" class="btn btn-primary" id="submitreq">
                </div>



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
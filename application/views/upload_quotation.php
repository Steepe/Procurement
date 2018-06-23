<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 20-Dec-17
 * Time: 9:59 PM
 * Project: procurement
 */

require_once(APPPATH.'views/includes/header.php');

//var_dump($proc_nos);
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
                <li><a href="<?php echo base_url('procurement/quotations/');?>">Quotations</a></li>
                <li class="active">Upload Quotation</li>
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
                <i class="icon-checkmark-circle"></i>Your quotation has been successfully submitted.
            </div>
            <?php
        }
        elseif($success == "fail"){
            ?>
            <div class="alert alert-danger fade in block-inner">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="icon-cancel-circle"></i> Your quotation has NOT been successfully submitted.
            </div>
            <?php
        }
    }
    ?>
    <!-- Form bordered -->
    <form class="form-horizontal form-bordered" id="procurement_form" action="<?php echo base_url('quotations/do_upload_quotation'); ?>" method="post" enctype="multipart/form-data" role="form" accept-charset="utf-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i> Upload Quotation Form</h6></div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Requisition Subject:</label>
                    <div class="col-sm-10">
                        <select name="request_subject" id="request_subject" data-placeholder="Choose Request Subject" class="select-full" tabindex="2">
                            <option value=""></option>
                            <?php
                            foreach ($finance_approved_requests as $finance_approved_request){
                                ?>
                                <option value="<?php echo $finance_approved_request['request_subject'];?>"><?php echo $finance_approved_request['request_subject'];?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Vendor Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="vendor_name" id="vendor_name"  >
                        <?php echo form_error('vendor_name'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Other Details:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="5" class="form-control" id="details" name="details"><?php echo set_value('details'); ?></textarea>
                        <?php echo form_error('details'); ?>
                    </div>
                </div>


                <div class="form-group">
                    <!-- Multiple file uploader inside panel -->
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-file-upload"></i> Upload your quotation (PDF, Images, Excel and Word documents)</h6></div>
                        <div class="multiple-uploader" id="uploader">Your browser doesn't support native upload.</div>
                    </div>
                    <!-- /multiple file uploader with header inside panel -->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Uploaded by:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="uploaded_by" id="uploaded_by" value="<?php echo set_value('uploaded_by', $this->session->userdata('employee_name')); ?>" readonly>
                        <?php echo form_error('uploaded_by'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                    </div>
                    <input type="hidden" name="form_page" id="form_page" value="<?php echo set_value('form_page', 'quotations/upload'); ?>" /></td>
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
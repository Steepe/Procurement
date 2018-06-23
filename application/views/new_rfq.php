<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 29-Nov-17
 * Time: 3:12 PM
 * Project: procurement
 */

require_once(APPPATH.'views/includes/header.php');
require_once(APPPATH.'views/includes/navigation.php');
require_once(APPPATH.'views/includes/left_sidebar.php');
//var_dump($vendors_list);
//exit;
?>
        <form class="form-horizontal form-bordered" id="job_form" action="<?php echo base_url('do_send_message'); ?>" method="post" enctype="multipart/form-data" role="form" accept-charset="utf-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-menu"></i>Send A Message</h6></div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">To:</label>
                        <div class="col-sm-10">
                            <div class="input-group">
            				<span class="input-group-btn">
                                <a data-toggle="modal" role="button" href="#form_modal"><button class="btn btn-default" type="button" id="addVendor">Add Vendors emails</button></a>
							</span>
                            <input type="text" id="email_to" name="email_to" class="tags" value="<?php if(isset($emails)){foreach($emails as $email){echo $email['email'].', ';}} ?>">
                            <?php echo form_error('email_to'); ?>
                            </div>
                        </div>
                    </div>

                    <div style="display: none;"><input type="text" id="email_cc" name="email_cc" class="tags"  ></div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject:</label>
                        <div class="col-sm-10">
                            <input type="text" id="subject" name="subject" class="form-control" value="" required>
                            <?php echo form_error('subject'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- WYSIWYG editor -->
                        <h6><i class="icon-pencil"></i> Body</h6>
                        <div class="block-inner">
                            <textarea id="body" name="body" class="editor" placeholder="Enter text ..."></textarea>
                        </div>
                        <!-- /WYSIWYG editor -->
                    </div>


                    <input type="hidden" name="sent_by" id="sent_by" value="<?php echo set_value('sent_by', $this->session->userdata('firstname')); ?>" /></td>
                    <input type="hidden" name="last_page" id="last_page" value="<?php echo set_value('last_page', 'admin/messages/'); ?>" /></td>

                    <div class="form-group">
                        <div class="form-actions text-right">
                            <input type="submit" value="Send" class="btn btn-primary" id="submitvac">
                            <input type="reset" value="Cancel" class="btn btn-danger">
                        </div>

                    </div>
                </div>
        </form>




<!-- Form modal -->
<div id="form_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Vendors List</h4>
            </div>
            <div>
                <table class="table table-bordered table-striped" id="requestList">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Type</th>
                        <th>Created By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($vendors_list as $vendor){
                        ?>
                        <tr>
                            <td><input type="checkbox" class="checkbox" ></td>
                            <td><?php echo $vendor['vendor_name'];?></td>
                            <td><?php echo $vendor['vendor_email'];?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>



            <!-- Form inside modal -->
        </div>
    </div>
</div>
<!-- /form modal -->


        <?php
        require_once(APPPATH.'views/includes/footer.php');
        ?>


<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 10/14/14
 * Time: 9:26 PM
 */

require_once(APPPATH.'views/includes/header.php');
require_once(APPPATH.'views/includes/navigation.php');
require_once(APPPATH.'views/includes/left_sidebar.php');
$this->session->unset_userdata('last_page');

//$app_status = $approval_status->approval_status;
$myrequest = $request[0];
$mycomments = $comments[0];
$details = json_decode($myrequest->details, true);
//$amount = $myrequest->amount;
$uploaded_files = json_decode($myrequest->uploaded_files, true);
$comments_no = count($comments);
//echo $comments_no;
//var_dump($this->session->all_userdata());
//var_dump($myrequest);
//var_dump($uploaded_files);
?>
<?php
if(isset($success)){
    if($success == "approved"){
        ?>
        <div class="alert alert-success fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-checkmark-circle"></i>You have approved this request successfully!.
        </div>
    <?php
    }
    elseif($success == "disapproved"){
        ?>
        <div class="alert alert-danger fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-cancel-circle"></i>You have disapproved this request successfully!.
        </div>
    <?php
    }
    elseif($success == "fail"){
        ?>
        <div class="alert alert-warning fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-warning"></i>Your have approval/disapproval could not be registered at this moment!.
        </div>
<?php
    }
}
$approver_role = $myrequest->approval_role;
$progress = number_format(($approver_role/6)*100 ,0);
//echo $approver_role;
?>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <br><div class="progress progress-striped active block-inner">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $progress;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress.'%';?>;">
                        <?php
                        if($progress == 17){
                            echo "Requester Stage";
                        }
                        elseif($progress == 33){
                            echo "Supervisor";
                        }
                        elseif($progress == 50){
                            echo "Finance (Budget Approval)";
                        }
                        elseif($progress == 67){
                            echo "COO";
                        }
                        elseif($progress == 83){
                            echo "Procurement";
                        }
                        elseif($progress == 100){
                            echo "Accounts";
                        }
                        ?>
                    </div>
                </div>
                <div class="panel ">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="ti-layout-grid3"></i> Requests List
                        </h3>
                        <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">

<table width="60%" border="0" cellpadding="10" cellspacing="0" class="table table-striped table-bordered">
    <tr>
        <th align="right" valign="top">
            <label for="Pno">Requisition No.: </label>
        </th>
        <td align="left" valign="top"><?php echo $myrequest->procurement_no; ?>
        </td>
    </tr>
    <?php
        foreach($details as $key=>$value){
            //echo $key." - ".$value."<br>";
    ?>
    <tr>
        <th align="right" valign="top">
            <label for="requested_by">
			<?php echo ucwords(str_replace("_", " ", $key)); ?>
            </label>
        </th>

        <td>
            <?php echo $value;?>
        </td>
    </tr>
    <?php
        }
    $x=0;
    if($uploaded_files){
    foreach($uploaded_files as $uploaded_file) {
        $x++;
        ?>
        <tr>
            <th align="right" valign="top">
                <label for="requested_by">
               <?php echo "Document ".$x;?>
                    </label>
            </th>
            <td>
                <a href="javascript:window.open('<?php echo base_url('uploads')."/".$uploaded_file['tmp_name']?>', '', 'width=700 height=600')"><?php echo $uploaded_file['filename'];?></a>
            </td>
        </tr>
        <?php
     }
    }
   // if($this->session->userdata('user_role') > 5){
    ?>
    <tr>
        <th align="right" valign="top">
            <label for="requested_by">Amount: </label>
        </th>
        <td align="left" valign="top"><?php echo $myrequest->amount; ?></td>
    </tr>
    <?php
    //}
    if(isset($myrequest->procurement_amount)){
        ?>
        <tr>
            <th align="right" valign="top">
                <label for="requested_by">Amount Suggested by Procurement: </label>
            </th>
            <td align="left" valign="top"><?php echo $myrequest->procurement_amount; ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <th align="right" valign="top">
            <label for="requested_by">Requested by: </label>
        </th>
        <td align="left" valign="top"><?php echo $myrequest->requested_by; ?></td>
    </tr>
    <tr>
        <th align="right" valign="top">
            <label for="requested_by">Date Requested: </label>
        </th>
        <td align="left" valign="top"><?php echo $myrequest->date; ?></td>
    </tr>
</table>
<br>
                        <h5>Is Request provided for in Budget?</h5>
                                    <div class="alert <?php  echo $myrequest->request_in_budget == 0 ? 'alert-danger' : 'alert-success';?>">
                                        <p>
                                            Supervisor says <strong><?php echo $myrequest->request_in_budget == 0 ? 'NO' : 'YES';?></strong>
                                        </p>
                                    </div>
  <div class="chat">
        <?php
        if($comments == true){
            ?>
            <hr>
            <h5>Comments</h5>
            <?php
            //for($i= 0; $i<$comments_no; $i++){
            foreach($comments as $i => $comment){
                //echo $comment['approval_status'];
        ?>
                    <div class="alert-message <?php if($comment['approval_status'] == 'approved'){echo 'alert-message-success';
                    }elseif($comment['approval_status'] == 'disapproved'){echo 'alert-message-danger';}?>">
                        <h4>
                            <?php echo $comment['employee_name'] ?>
                        </h4>
                        <p>
                            <?php echo $comment['request_comment']; ?><br>
                            <strong>
                                <?php echo $comment['comment_date']; ?>
                            </strong>
                        </p>
                    </div>

        <?php
            }
        }
        ?>
    </div> <!--end chat div -->
    <?php
    if($myrequest->approval_role < $this->session->userdata('user_role')){
    ?>
    <table width="70%" border="0" id="approvetable">
        <tr>
            <td colspan="2" align="right" valign="top">
                <a data-toggle="modal" role="button" href="#form_modal"><button type="button" class="btn btn-success modalcolor" data-target="#color_modal" data-modalcolor="#66cc99" >Approve Request</button></a>
            </td>


            <td colspan="3" align="center" valign="top">
                <a data-toggle="modal" role="button" href="#form_modal2"><button type="button" class="btn btn-danger">Disapprove Request</button></a>
            </td>
        </tr>
    </table>

        <!-- Form modal -->
        <div id="form_modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Approve Request</h4>
                    </div>


                    <!-- Form inside modal -->
                    <form action="<?php echo base_url('do_request_comment');?>" method="post" role="form" class="validate">

                        <div class="modal-body with-padding">

                            <?php
                                if($this->session->userdata('user_role')==2) {
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label">Is request in budget? <span
                                                class="mandatory">*</span></label><br>
                                        <select data-placeholder="Choose an answer..." name="request_in_budget"
                                                id="request_in_budget" class="required select" tabindex="2">
                                            <option value=""></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                <?php
                                }
                            ?>

                            <div class="form-group">
                                <label>Add Comment:</label>
                                <textarea id="request_comment" name="request_comment" rows="5" cols="5" class="form-control" tabindex="2"></textarea>
                            </div>
                            <?php
                            if($this->session->userdata('user_role') == 5){
                            ?>
                            <div class="form-group">
                                <label>Procurement Amount:</label>
                                <input type="text" class="form-control" name="procurement_amount" id="procurement_amount" required="required">
                            </div>
                            <?php
                                }
                            ?>

                        </div>
                        <input type="hidden" id="employee_email" name="employee_email" value="<?php echo set_value('employee_email', $myrequest->employee_email); ?>">
                        <input type="hidden" id="employee_id" name="employee_id" value="<?php echo set_value('employee_id', $this->session->userdata('employee_id')); ?>" />
                        <input type="hidden" id="approval_role" name="approval_role" value="<?php echo set_value('approval_role', $this->session->userdata('user_role')); ?>" />
                        <input type="hidden" id="request_id" name="request_id" value="<?php echo set_value('request_id', $myrequest->req_id); ?>">
                        <input type="hidden" id="amount" name="amount" value="<?php echo set_value('amount', $myrequest->amount); ?>">
                        <input type="hidden" id="approval_status" name="approval_status" value="<?php echo set_value('approval_status', "approved"); ?>">
                        <input type="hidden" id="employee_name" name="employee_name" value="<?php echo set_value('employee_name', $this->session->userdata('employee_name')); ?>" />
                        <input type="hidden" id="last_page" name="last_page" value="<?php echo set_value('last_page', uri_string()); ?>" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /form modal -->


        <!-- Form modal -->
        <div id="form_modal2" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Disapprove Request</h4>
                    </div>

                    <!-- Form inside modal -->
                    <form action="<?php echo base_url('do_request_comment');?>" method="post" role="form">

                        <div class="modal-body with-padding">

                            <div class="form-group">
                                <label>Add Comment:</label>
                                <textarea id="request_comment" name="request_comment" rows="5" cols="5" class="form-control" tabindex="2"></textarea>
                            </div>
                            <?php
                            if($this->session->userdata('user_role') == 5){
                                ?>
                                <div class="form-group">
                                    <label>Procurement Amount:</label>
                                    <input type="text" class="form-control" name="procurement_amount" id="procurement_amount" required="required">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <input type="hidden" id="employee_email" name="employee_email" value="<?php echo set_value('employee_email', $myrequest->employee_email); ?>">
                        <input type="hidden" id="employee_id" name="employee_id" value="<?php echo set_value('employee_id', $this->session->userdata('employee_id')); ?>" />
                        <input type="hidden" id="approval_role" name="approval_role" value="<?php echo set_value('approval_role', $this->session->userdata('user_role')); ?>" />
                        <input type="hidden" id="request_id" name="request_id" value="<?php echo set_value('request_id', $myrequest->req_id); ?>">
                        <input type="hidden" id="amount" name="amount" value="<?php echo set_value('amount', $myrequest->amount); ?>">
                        <input type="hidden" id="approval_status" name="approval_status" value="<?php echo set_value('approval_status', "disapproved"); ?>">
                        <input type="hidden" id="employee_name" name="employee_name" value="<?php echo set_value('employee_name', $this->session->userdata('employee_name')); ?>" />
                        <input type="hidden" id="last_page" name="last_page" value="<?php echo set_value('last_page', uri_string()); ?>" />

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /form modal -->



<?php
    }
?>
<iframe id='fr' frameborder="0" scrolling="no" width="550" height="400"></iframe>
                    </div>
                </div>
            </div>
        </div>
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

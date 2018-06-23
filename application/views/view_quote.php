<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 03-Jan-18
 * Time: 3:33 AM
 * Project: procurement
 */

require_once(APPPATH.'views/includes/header.php');
$this->session->unset_userdata('last_page');
$uploaded_files = json_decode($quotation->uploaded_files, true);

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
                <li><a href="<?php echo base_url('Quotations');?>">Quotations List</a></li>
                <li class="active">View Quotations</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>

        </div>
        <!-- /breadcrumbs line -->
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="text-right"><a data-toggle="modal" role="button" href="#form_modal"><button class="btn btn-primary">Create Purchase Order</button></a></div>
            </div>

        </div>
        <br>
        <table width="60%" border="0" cellpadding="10" cellspacing="0" class="table table-striped table-bordered">
            <tr>
                <th align="right" valign="top">
                    <label for="Pno">Requisition Subject.: </label>
                </th>
                <td align="left" valign="top"><?php echo $quotation->request_subject; ?>
                </td>
            </tr>
            <tr>
                <th align="right" valign="top">
                    <label for="requested_by">Vendor Name: </label>
                </th>
                <td align="left" valign="top"><?php echo $quotation->vendor_name; ?></td>
            </tr>
            <tr>
                <th align="right" valign="top">
                    <label for="requested_by">Vendor Amount: </label>
                </th>
                <td align="left" valign="top"><?php echo $quotation->amount; ?></td>
            </tr>
            <?php
            $x=0;
            if($uploaded_files){
            foreach($uploaded_files as $uploaded_file) {
                $x++;
                ?>
                <tr>
                    <th align="right" valign="top">
                        <label for="requested_by">
                            Uploaded Quotation(s)<br><br>
                            <?php echo "Quotation " . $x; ?>
                        </label>
                    </th>
                    <td>
                        <br><br>
                        <a href="javascript:window.open('<?php echo base_url('uploads') . "/" . $uploaded_file['tmp_name'] ?>', '', 'width=700 height=600')"><?php echo $uploaded_file['filename']; ?></a>
                    </td>
                </tr>
                <?php
            }
            }
            ?>

            <tr>
                <th align="right" valign="top">
                    <label for="requested_by">Uploaded by: </label>
                </th>
                <td align="left" valign="top"><?php echo $quotation->uploaded_by; ?></td>
            </tr>
            <tr>
                <th align="right" valign="top">
                    <label for="requested_by">Date Requested: </label>
                </th>
                <td align="left" valign="top"><?php echo $quotation->time_uploaded; ?></td>
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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /form modal -->


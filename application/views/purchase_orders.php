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
if(isset($success)) {
    if ($success == "approved") {
        ?>
        <div class="alert alert-success fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-checkmark-circle"></i>You have approved this request successfully!.
        </div>
        <?php
    } elseif ($success == "disapproved") {
        ?>
        <div class="alert alert-danger fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-cancel-circle"></i>You have disapproved this request successfully!.
        </div>
        <?php
    } elseif ($success == "fail") {
        ?>
        <div class="alert alert-warning fade in block-inner">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="icon-warning"></i>Your have approval/disapproval could not be registered at this moment!.
        </div>
        <?php
    }
}
require_once(APPPATH.'views/includes/footer.php');
?>


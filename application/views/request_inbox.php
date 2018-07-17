<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 10/16/14
 * Time: 2:11 PM
 */

require_once(APPPATH.'views/includes/header.php');

$count = count($lists);
//echo $count;
//exit;
?>
<?php require_once(APPPATH.'views/includes/navigation.php'); ?>
<?php require_once(APPPATH.'views/includes/left_sidebar.php'); ?>

    <?php //var_dump($lists);?>

    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
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
                            <div class="table-responsive">

        <!--<div class="datatable-ajax-source">-->
            <table id="sample_1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Request</th>
                    <th>Requested By</th>
                    <th>Subject</th>
                    <th>Department</th>
                    <th>Date Requested</th>
                    <th>Updated by</th>
                </tr>
                </thead>
                <?php
                if($lists == true){
                    foreach($lists as $list){
                        ?>
                        <tr <?php //if($list['is_read'] != 1){ ?>style="font-weight: bold;"<?php //} ?>>
                            <td><a href="<?php echo base_url('inbox/'.$list['req_id']);?>"><?php echo $list['procurement_no'];?></a></td>
                            <td><?php echo $list['requested_by'];?></td>
                            <td><?php echo $list['request_subject'];?></td>
                            <td><?php echo $list['department_name'];?></td>
                            <td><?php echo $list['date'];?></td>
                                <td><?php echo $list['approver'];?></td>
                        </tr>
                    <?php
                    }
                }
                ?>

                <tfoot>

                <tr>
                    <th>Request</th>
                    <th>Requested By</th>
                    <th>Subject</th>
                    <th>Department</th>
                    <th>Date Requested</th>
                    <th>Updated by</th>
                </tr>
                </tfoot>
            </table>
        <!--</div>-->

                            </div>
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
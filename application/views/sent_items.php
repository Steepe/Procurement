<?php
/**
 * Created by PhpStorm.
 * User: Steepe
 * Date: 04/07/2018
 * Time: 10:22
 */

require_once(APPPATH.'views/includes/header.php');
require_once(APPPATH.'views/includes/navigation.php');
require_once(APPPATH.'views/includes/left_sidebar.php');

//1var_dump($lists);
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


                        <div class="table-responsive">

                            <!--<div class="datatable-ajax-source">-->
                            <table id="sample_1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Request</th>
                                    <th>Requested By</th>
                                    <th>Subject</th>
                                    <th>Date Requested</th>
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
                                            <td><?php echo $list['date'];?></td>
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
                                    <th>Date Requested</th>
                                </tr>
                                </tfoot>
                            </table>
                            <!--</div>-->

                        </div>


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

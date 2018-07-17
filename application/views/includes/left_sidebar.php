<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 2/16/15
 * Time: 12:41 AM
 */
 ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="#">
                            <img src="<?php echo base_url('assets/img/authors/avatar1.jpg');?>" class="img-circle" alt="User Image"></a>
                        <div class="content-profile">
                            <h4 class="media-heading"><?php echo $this->session->userdata('employee_name');?></h4>
                            <ul class="icon-list">
                                <li>
                                    <a href="lockscreen.html">
                                        <i class="fa fa-fw ti-lock"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('home/logout');?>">
                                        <i class="fa fa-fw ti-shift-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="navigation">
                    <li class="active" id="active">
                        <a href="<?php echo base_url();?>">
                            <i class="menu-icon ti-desktop"></i>
                            <span class="mm-text ">Dashboard</span>
                        </a>
                    </li>
                    <?php
                        if(in_array("3", $user_roles)){
                    ?>
                    <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon ti-desktop"></i>
                            <span>
                                    Submit Requisition
                                </span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('request/product');?>">
                                    <i class="fa fa-fw ti-plug"></i> Product Request
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('request/service');?>">
                                    <i class="fa fa-fw ti-layout-placeholder"></i> Service Request
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('request/project');?>">
                                    <i class="fa fa-fw ti-layers"></i> Project Request
                                </a>
                            </li>
                            <?php
                            if(in_array("4", $user_roles)){
                                ?>
                                <li><a href="<?php echo base_url('request/emergency');?>">Emergency Form</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                    <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon ti-briefcase"></i>
                            <span>
                                   Requests
                                </span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <?php
                                if(in_array("9", $user_roles)){
                            ?>
                            <li>
                                <a href="<?php echo base_url('inbox');?>">
                                    <i class="fa fa-fw ti-brush"></i> Request Inbox
                                </a>
                            </li>
                            <?php
                                }
                            ?>
                            <li>
                                <a href="<?php echo base_url('sent');?>">
                                    <i class="fa fa-fw ti-brush"></i> Request Sent
                                </a>
                            </li>
                            <?php
                            if(in_array("6", $user_roles)){
                                ?>
                                <li><a href="<?php echo base_url('procurement/request/all_requests'); ?>">View all
                                        requests</a></li>
                                <?php
                                    }
                                    if(in_array("7", $user_roles)){
                                ?>

                                <li><a href="<?php echo base_url('procurement/request/view_emergency_requests'); ?>">View
                                        emergency requests</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                         if(in_array("12", $user_roles)){
                        ?>
                    <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon ti-widget"></i>
                            <span>Product Management</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">

                            <li>
                                <a href="<?php echo base_url('add_new_item');?>">
                                    <i class=" menu-icon fa fa-fw ti-widgetized"></i>
                                    Add new Product
                                </a>
                            </li>


                                <li>
                                    <a href="widgets1.html">
                                        <i class=" menu-icon fa fa-fw ti-widget-alt"></i>
                                        Manage Vendors
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <?php
                    }
                        if(in_array("2", $user_roles)){
                    ?>
                    <li class="menu-dropdown">
                                <a href="#">
                                    <i class="menu-icon ti-layout-grid4"></i>
                                    <span>Request for Quotes</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo base_url('quotations/new_rfq'); ?>">
                                            <i class="fa fa-fw ti-layout"></i> New RFQ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('quotations/upload'); ?>">
                                            <i class="fa fa-fw ti-server"></i> Upload Quotation
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('quotations'); ?>">
                                            <i class="fa fa-fw ti-layout-grid3"></i> Quotations
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    <?php
                        }
                        if(in_array("1", $user_roles)){
                    ?>
                        <li class="menu-dropdown">
                        <a href="#"> <i class="menu-icon ti-bar-chart"></i>
                            <span>Purchase Orders</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('purchase_orders'); ?>">
                                    <i class="fa fa-fw ti-bar-chart-alt"></i> Purchase Orders
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('purchase_orders/new_'); ?>"> <i class="fa fa-fw ti-stats-up"></i> New Purchase Order </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
                <!-- / .navigation --> </div>
            <!-- menu --> </section>
        <!-- /.sidebar --> </aside>

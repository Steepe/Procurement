<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 2/16/15
 * Time: 12:38 AM
 */
?>
<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="<?php echo base_url();?>" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the marginin -->
            <img src="<?php echo base_url('assets/img/logo.png');?>" height="40" alt="logo"/>
        </a>
        <!-- Header Navbar: style can be found in header-->
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i
                        class="fa fa-fw ti-menu"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-fw ti-email black"></i>
                        <span class="label label-success">2</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages table-striped">
                        <li class="dropdown-title">New Messages</li>
                        <li>
                            <a href="" class="message striped-col">
                                <img class="message-image img-circle" src="<?php echo base_url('assets/img/authors/avatar7.jpg');?>" alt="avatar-image">

                                <div class="message-body"><strong>Ernest Kerry</strong>
                                    <br>
                                    Can we Meet?
                                    <br>
                                    <small>Just Now</small>
                                    <span class="label label-success label-mini msg-lable">New</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="message">
                                <img class="message-image img-circle" src="<?php echo base_url('assets/img/authors/avatar6.jpg');?>" alt="avatar-image">

                                <div class="message-body"><strong>John</strong>
                                    <br>
                                    Dont forgot to call...
                                    <br>
                                    <small>5 minutes ago</small>
                                    <span class="label label-success label-mini msg-lable">New</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="message striped-col">
                                <img class="message-image img-circle" src="<?php echo base_url('assets/img/authors/avatar5.jpg');?>" alt="avatar-image">

                                <div class="message-body">
                                    <strong>Wilton Zeph</strong>
                                    <br>
                                    If there is anything else &hellip;
                                    <br>
                                    <small>14/10/2014 1:31 pm</small>
                                </div>

                            </a>
                        </li>
                        <li>
                            <a href="" class="message">
                                <img class="message-image img-circle" src="<?php echo base_url('assets/img/authors/avatar1.jpg');?>" alt="avatar-image">
                                <div class="message-body">
                                    <strong>Jenny Kerry</strong>
                                    <br>
                                    Let me know when you free
                                    <br>
                                    <small>5 days ago</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="message striped-col">
                                <img class="message-image img-circle" src="<?php echo base_url('assets/img/authors/avatar.jpg');?>" alt="avatar-image">
                                <div class="message-body">
                                    <strong>Tony</strong>
                                    <br>
                                    Let me know when you free
                                    <br>
                                    <small>5 days ago</small>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-footer"><a href="#"> View All messages</a></li>
                    </ul>

                </li>
                <!--rightside toggle-->
                <li>
                    <a href="#" class="dropdown-toggle toggle-right" data-toggle="dropdown">
                        <i class="fa fa-fw ti-view-list black"></i>
                        <span class="label label-danger">9</span>
                    </a>
                </li>
                <!-- User Account: style can be found in dropdown-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/img/authors/avatar1.jpg');?>" width="35" class="img-circle img-responsive pull-left"
                             height="35" alt="User Image">
                        <div class="riot">
                            <div>
                                <?php echo $this->session->userdata('employee_name');?>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/img/authors/avatar1.jpg');?>" class="img-circle" alt="User Image">
                            <p> Addison</p>
                        </li>
                        <!-- Menu Body -->
                        <li class="p-t-3"><a href="<?php echo base_url('assets/user_profile.html');?>"> <i class="fa fa-fw ti-user"></i> My Profile </a>
                        </li>
                        <li role="presentation"></li>
                        <li><a href="<?php echo base_url('assets/edit_user.html');?>"> <i class="fa fa-fw ti-settings"></i> Account Settings </a></li>
                        <li role="presentation" class="divider"></li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="lockscreen.html">
                                    <i class="fa fa-fw ti-lock"></i>
                                    Lock
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('home/logout');?>">
                                    <i class="fa fa-fw ti-shift-right"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

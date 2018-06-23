<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 9/9/14
 * Time: 2:05 PM
 */

require_once(APPPATH.'views/includes/login_header.php');



$attributes = array('role'=>'form');

?>

    <body id="sign-in">
    <div class="preloader">
        <div class="loader_img"><img src="<?php echo base_url('assets/img/loader.gif');?>" alt="loading..." height="64" width="64"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 login-form">
                <div class="panel-header">
                    <h2 class="text-center">
                        <img src="<?php echo base_url('assets/img/logo.png');?>" alt="Logo">
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="<?php echo base_url('login/verify_login');?>" id="authentication" method="post" class="login_validator">
                                <div class="form-group">
                                    <label for="email" class="sr-only"> E-mail</label>
                                    <input type="text" class="form-control  form-control-lg" id="email" name="email"
                                           placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password"
                                           name="password" placeholder="Password">
                                </div>
                                <div class="form-group checkbox">
                                    <label for="remember">
                                        <input type="checkbox" name="remember" id="remember">&nbsp; Remember Me
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Sign In" class="btn btn-primary btn-block"/>
                                </div>
                                <a href="forgot_password.html" id="forgot" class="forgot"> Forgot Password ? </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
require_once('includes/login-footer.php');
?>
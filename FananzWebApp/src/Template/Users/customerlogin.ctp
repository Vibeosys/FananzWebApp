<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('admin_header');
echo $this->Html->css('/css/sweetalert.css');
echo $this->Html->script('/js/pages/users-customer-login.js', ['block' => true]);
?>
<section class="login">
    <div class="container">
        <form id="login" action="userlogin" method="post" class="form form--login">
            <div class="row">

                <div class="login-wrapper">
                    <div class="login-form-container">
                        <!-- Put the HTML Code here -->
                        <div class="col-lg-12">
                            <div class="error-msg-container">
                                <div class="<?= $errorDivClass ?>">
                                    <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="login-social">
                                <h2>Sign In</h2>
                                <!--                            <h3>Sign in with social</h3>-->
                            </div>
                            <div class="social-login-btn">
                                <div class="fb-btn">
                                    <a  href="#" onclick="checkLoginState();"><span class="icon"><i class="fa fa-facebook"></i></span> 
                                        <span class="social-text"  >Login with Facebook</span></a>

                                    <div id="status">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="line-or">
                                <span>OR</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top-130">
                            <div class="form-group">
                                <label for="user_email">Email
                                    <input type="email" id="user_email" class="form-control" name="email" required="">
                                    <span class="input-icon"><i class="fa fa-user"></i></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="user_pwd">Password <span class="forgot-pwd"><a href="#fogotpasswordModal" data-toggle="modal" >Forgot password?</a></span>
                                    <input type="password" id="user_pwd" class="form-control" name="password" required="">
                                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                                </label>
                            </div>
                            <div class="form-group login-check">
                                <input type="checkbox" id="brand" value="">
                                <label for="brand"><span></span> Remember me</label>
                            </div>
                        </div>
                        <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="login-button-set">
                                    <a href="<?= VIRTUAL_DIR_PATH . '/users/register' ?>" class="user-register">Register Now</a>   
                                    <button type="submit" name="customerlogin" value="customerlogin" class="button black_sm">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="modal fade" id="fogotpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="forgot_passowrd-popup">
                <div class="header-modal">
                    <h1>Forgot Your Password?</h1>
                </div>
                <div class="modal-body">
                    <?= $this->Form->create(false, ['id' => 'frmForgotPassword']) ?>
                    <h3>RETRIEVE YOUR PASSWORD HERE</h3>
                    <p>Please enter your email address below. You will receive your password by Email.</p>
                    <div class="form-group">
                        <label for="forgot_email">Email
                            <input type="email" id="forgot_email" class="form-control" name="email">
                            <span class="input-icon"><i class="fa fa-user"></i></span>
                        </label>
                    </div>
                    <div class="forgot_set">
                        <button type="submit" title="Submit" id="userForgotPassword" class="button black_sm">Submit</button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo $this->element('admin_header');
echo $this->Html->css('/css/sweetalert.css');
echo $this->Html->script('/js/pages/admin-login.js', ['block' => true]);
?>

<section class="login">
    <div class="container">
        <form id="login" action="login" method="post" class="form form--login">
            <div class="row">
                <div class="login-wrapper">
                    <div class="login-form-container">
                        <div class="col-lg-12">
                            <div class="login-subscriber">
                                <h2>Sign In</h2>
                                <h3>Use your register email address</h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="error-msg-container">
                                <div class="<?= $errorDivClass ?>" >
                                    <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="admin_email">Email
                                    <span id="Email_msg" class="error_red" style="display: none">
                                        Please Enter Your Email Id
                                    </span>
                                    <span id="Email_ptn" class="error_red" style="display: none">
                                        Please Enter Valid Email Id
                                    </span>
                                    <input type="email" id="admin_email" class="form-control" name="email" required="">
                                    <span class="input-icon"><i class="fa fa-user"></i></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="admin_pwd">Password 
                                    <span id="pass_msg" class="error_red" style="display: none">
                                        Please Enter Your Password
                                    </span>
                                    <span class="forgot-pwd"><a href="#fogotpasswordModal" data-toggle="modal">Forgot password?</a></span>
                                    <input type="password" id="admin_pwd" class="form-control" name="password" required="">
                                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                                </label>
                            </div>
                            <div class="form-group login-check">
                                <input type="checkbox" id="brand" value="">

                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group ">
                                <div class="login-button-set admin-set">
                                    <!--                               <button type="submit" title="Submit" class="button black_sm">Sign In</button>-->
                                    <!-- <div id="error_msg" class="login_error error_hide">
                                         Invalid Email id or Password
                                         
                                     </div>-->
                                    <input type="submit" title="submit" name="login" value="login" id="login_sub" class="button black_sm center-block">
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
                <div class="header-modal"> <h1>Forgot Your Password?</h1></div>

                <div class="modal-body">

                    <?= $this->Form->create(false, ['id' => 'frmForgotPassword']) ?>
                    <h3>RETRIEVE YOUR PASSWORD HERE</h3>
                    <p>Please enter your email address below. You will get Your password.</p>
                    <div class="form-group">
                        <label for="user_email">Email
                            <input type="email" id="forgot_email" class="form-control" name="email">
                            <span class="input-icon"><i class="fa fa-user"></i></span>
                        </label>
                    </div>
                    <div class="forgot_set">
                        <button type="submit" title="Submit" name="submit" value="submit" class="button black_sm">Submit</button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header');

echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);

echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
?>
<section class="corporate-register">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="wrapper-left">
                    <div class="row">
                        <!-- Put the HTML Code here -->
                        <div class="col-lg-12">
                            <div class="error-msg-container">
                                <div class="<?= $errorDivClass ?>">
                                    <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="partner-login">
                                <div class="header-login">
                                    <h2>Sign In</h2>
                                </div>
                                <?= $this->Form->create(false, array('url' => ['action' => 'checkLogin'])) ?>
                                <div class="form-group">
                                    <label for="user_email">Email                                        
                                        <input type="email" id="user_email" class="form-control" name="name" required>
                                        <span class="input-icon"><i class="fa fa-user"></i></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user_pwd">Password
                                        <input type="password" id="user_pwd" class="form-control" name="password" required>
                                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                                    </label>
                                </div>
                                <div class="form-group login-check">
                                    <input type="checkbox" id="brand" value="">
                                    <label for="brand"><span></span> Remember me</label>
                                </div>
                                <div class="form-group">
                                    <div class="login-button-set">
                                        <span class="forgot-pwd"><a href="#fogotpasswordModal" data-toggle="modal">Forgot password?</a></span>
                                        <button type="submit" class="button black_sm">Sign In</button>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 border-right-2">
                            <div class="header-login">
                                <h2>Register Now</h2>
                            </div>
                            <div class="register-button-set">
                                <a href="<?= VIRTUAL_DIR_PATH . '/subscribers/signup' ?>" class="button black_sm">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="wrapper-righ">
                    <div class="benefit-fananz">
                        <span> <i class="fa fa-line-chart"></i> </span>
                        <P>Boost your presence online through banner spaces, mailers & articles</P>
                    </div>   
                    <div class="benefit-fananz">
                        <span> <i class="fa fa-users"></i> </span>
                        <P>Get qualified leads with high potential of conversion</P>
                    </div>
                    <div class="benefit-fananz">
                        <span> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span>
                        <P>More than 85% users now determine credibility of a vendor through online reviews</P>
                    </div>       
                </div>
            </div>
        </div>
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
                    <p>Please enter your email address below. You will receive password on your email.</p>
                    <div class="form-group">
                        <label for="user_email">Email
                            <input type="email" id="emailId" class="form-control" name="email">
                            <span class="input-icon"><i class="fa fa-user"></i></span>
                        </label>
                    </div>
                    <div class="forgot_set">
                        <button type="submit" title="Submit" class="button black_sm">Submit</button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#frmForgotPassword").submit(function (e) {
        e.preventDefault();

        var emailId = $('#emailId').val();
        $.ajax({
            url: '/FananzWebApp/subscribers/forgotPassword',
            type: 'POST',
            dataType: 'json',
            data: {
                emailId: emailId
            },
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    swal("Email sent!", data.message, "success");
                } else {
                    swal("Error occurred!", data.message, "error");
                }
            }
        });//end of ajax
    });
</script>
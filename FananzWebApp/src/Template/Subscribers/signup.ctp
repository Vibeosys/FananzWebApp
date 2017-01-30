<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header');

echo $this->Html->css('/css/design/bootstrap-fileupload.min.css', ['block' => true]);
echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);

echo $this->Html->script('/js/jquery.custom-file-input.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/bootstrap-fileupload.js', ['block' => 'scriptTop']);

echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
echo $this->Html->script('/js/jquery.validate.js', ['block' => true]);
echo $this->Html->script('/js/validation.subscribe.reg.js', ['block' => true]);
?>
<section class="corporate-register">
    <div class="container">
        <div class="row">
            <div class="register-wrapper">
                <div class="register-form-container">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h3>Subscribe Now !!</h3>
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#corporate" class="li-mg-right">Corporate</a></li>
                        <li><a data-toggle="tab" href="#freelance">Freelance</a></li>
                    </ul>
                    <div class="row border-outer">
                        <div class="tab-content">
                            <div id="corporate" class="tab-pane fade in active">
                                <form name="corporate_form" id="corporate_form" action="" method="post">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="subscription-desc">Annual subscription charges<span> <?= PAYMENT_CURRENCY . ' ' . CORPORATE_PAYMENT ?></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="com_name">Business Name <span class="required_field">*</span>
                                            <input type="text" id="com_name" class="form-control" name="cor_business_name">
                                            <span class="input-icon"><i class="fa fa-address-book-o"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="represent_name">Name of Representative <span class="required_field">*</span>
                                            <input type="text" id="represent_name" class="form-control" name="cor_represent_name">
                                            <span class="input-icon"><i class="fa fa-address-card-o"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cor_email">Email<span class="required_field">*</span>
                                            <input type="email" id="cor_email" class="form-control" name="cor_email">
                                            <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cor_password">Password<span class="required_field">*</span>
                                            <input type="password" id="cor_password" class="form-control" name="cor_password">
                                            <button type="button" id="show_pwd">  <i class="fa fa-eye" id="show_icon"></i></button>
                                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cor_tel_no">Telephone No
                                            <input type="tel" id="cor_tel_no" class="form-control" name="cor_tel_no">
                                            <span class="input-icon"><i class="fa fa-phone"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cor_mob_no">Mobile No<span class="required_field">*</span>
                                            <input type="tel" id="cor_mob_no" class="form-control" name="cor_mob_no">
                                            <span class="input-icon"><i class="fa fa-mobile"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cor_website_name">Website Name<span class="required_field">*</span>
                                            <input type="text" id="cor_website_name" class="form-control" name="cor_website_name">
                                            <span class="input-icon"><i class="fa fa-tv"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cor_country">Country of Residence<span class="required_field">*</span>
                                            <input type="text" id="cor_country" class="form-control" name="cor_country">
                                            <span class="input-icon"><i class="fa fa-globe"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group login-check">
                                        <input type="checkbox" id="cor_check" class="cor_check" name="cor_check">
                                        <label for="cor_check"><span></span>I agree to <a href="#termCondModal" class="portfolio-link" data-toggle="modal">Terms & Conditions</a>.</label>
                                        <label class="error-check cor-error"></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="button-set">
                                            <button type="submit" title="Submit" class="button black_sm cor_submit">Submit</button>
                                            <a href="index.html" class="white_back_btn">Back</a>     
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>

                            <div id="freelance" class="tab-pane fade">
                                <form name="freelance_form" id="freelance_form" action="" method="post">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="subscription-desc">Annual subscription charges <span> <?= PAYMENT_CURRENCY . ' ' . FREELANCE_PAYMENT ?></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="nick_name">Nick Name<span class="required_field">*</span>
                                            <input type="text" id="nick_name" class="form-control" name="nick_name">
                                            <span class="input-icon"><i class="fa fa-user"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth<span class="required_field">*</span>
                                            <input type="date" id="dob" class="form-control" name="dob">
                                            <span class="input-icon"><i class="fa fa-user"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fl_email">Email<span class="required_field">*</span>
                                            <input type="email" id="fl_email" class="form-control" name="fl_email">
                                            <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fl_password">Password<span class="required_field">*</span>
                                            <input type="password" id="fl_password" class="form-control" name="fl_password">
                                            <button type="button" id="show_pwd_fl">  <i class="fa fa-eye" id="show_icon_fl"></i></button>
                                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fl_tel_no">Telephone No
                                            <input type="tel" id="fl_tel_no" class="form-control" name="fl_tel_no">
                                            <span class="input-icon"><i class="fa fa-phone"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fl_mob_no">Mobile No<span class="required_field">*</span>
                                            <input type="tel" id="fl_mob_no" class="form-control" name="fl_mob_no">
                                            <span class="input-icon"><i class="fa fa-mobile"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fl_website_name">Website Name<span class="required_field">*</span>
                                            <input type="text" id="fl_website_name" class="form-control" name="fl_website_name">
                                            <span class="input-icon"><i class="fa fa-tv"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fl_country">Country of Residence<span class="required_field">*</span>
                                            <input type="text" id="fl_country" class="form-control" name="fl_country">
                                            <span class="input-icon"><i class="fa fa-globe"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group login-check">
                                        <input type="checkbox" id="freelance_check" value="" name="freelance_check">
                                        <label for="freelance_check"><span></span>I agree to <a href="#termCondModal" class="portfolio-link" data-toggle="modal">Terms & Conditions</a>.</label>
                                        <label class="error-check fl-error"></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="button-set">
                                            <button type="submit" title="Submit" class="button black_sm fl_submit" >Submit</button>
                                            <a href="index.html" class="white_back_btn">Back</a>     
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
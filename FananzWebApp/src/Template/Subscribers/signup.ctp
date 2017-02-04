<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header');
//$this->layout = ('home_layout');
echo $this->Html->css('/css/design/bootstrap-fileupload.min.css', ['block' => true]);
echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);
echo $this->Html->css('/css/design/countrySelect.css', ['block' => true]);

echo $this->Html->script('/js/jquery.custom-file-input.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/bootstrap-fileupload.js', ['block' => 'scriptTop']);

echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
echo $this->Html->script('/js/jquery.validate.js', ['block' => true]);
echo $this->Html->script('/js/validation.subscribe.reg.js', ['block' => true]);
echo $this->Html->script('/js/countrySelect.js', ['block' => true]);
echo $this->Html->script('/js/pages/subscriber-signup', ['block' => true]);
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
                        <?php
                        if ($activeTab == FREELANCE_SUB_TYPE) {
                            ?>
                            <li ><a data-toggle="tab" href="#corporate" class="li-mg-right">Corporate</a></li>
                            <li class="active"><a data-toggle="tab" href="#freelance">Freelance</a></li>
                            <?php
                        } else {
                            ?>
                            <li class="active"><a data-toggle="tab" href="#corporate" class="li-mg-right">Corporate</a></li>
                            <li><a data-toggle="tab" href="#freelance">Freelance</a></li>
                        <?php } ?>
                    </ul>
                    <div class="row border-outer">

                        <div class="tab-content">
                            <?php
                            if ($activeTab == FREELANCE_SUB_TYPE) {
                                ?>
                                <div id="corporate" class="tab-pane fade in ">
                                    <?php
                                } else {
                                    ?>
                                    <div id="corporate" class="tab-pane fade in active">
                                    <?php } ?>
                                    <div class="col-lg-12">
                                        <div class="error-msg-container">
                                            <div class="<?= $errorDivCorporateClass ?>" >
                                                <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->create(false, ['url' => ['action' => 'registerCorporate'], 'type' => 'file', 'id' => 'frmCorporateRegistration']) ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="subscription-desc">Annual subscription charges<span> <?= PAYMENT_CURRENCY . ' ' . CORPORATE_PAYMENT ?></span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="com_name">Business Name <span class="required_field">*</span>
                                                <input type="text" id="com_name" class="form-control" name="cor_business_name" required>
                                                <span class="input-icon"><i class="fa fa-address-book-o"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="represent_name">Name of Representative <span class="required_field">*</span>
                                                <input type="text" id="represent_name" class="form-control" name="cor_represent_name" required>
                                                <span class="input-icon"><i class="fa fa-address-card-o"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="cor_email">Email<span class="required_field">*</span>
                                                <input type="email" id="cor_email" class="form-control" name="cor_email" required>
                                                <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="cor_password">Password<span class="required_field">*</span>
                                                <input type="password" id="cor_password" class="form-control" name="cor_password" required>
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
                                                <input type="tel" id="cor_mob_no" class="form-control" name="cor_mob_no" required>
                                                <span class="input-icon"><i class="fa fa-mobile"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="cor_website_name">Website URL<span class="required_field">*</span>
                                                <input type="text" id="cor_website_name" class="form-control" name="cor_website_name" required>
                                                <span class="input-icon"><i class="fa fa-tv"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="cor_country">Country of Residence<span class="required_field">*</span>
                                                <input id="cor_country_selector" type="text" name="cor_country_selector">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label >Trade Certificate
                                                <input type="file" name="trade_certificate" id="trade_certificate" class="inputfile inputfile-2" />
                                                <label for="trade_certificate" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                    </svg>
                                                    <span class="file-name">Choose a file...</span>
                                                </label>
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
                                                <a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">I have already registered</a>     
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end() ?>
                                </div>

                                <?php
                                if ($activeTab == FREELANCE_SUB_TYPE) {
                                    ?>
                                    <div id="freelance" class="tab-pane fade in active">
                                        <?php
                                    } else {
                                        ?>
                                        <div id="freelance" class="tab-pane fade in">
                                        <?php } ?>

                                        <div class="col-lg-12">
                                            <div class="error-msg-container">
                                                <div class="<?= $errorDivFreelanceClass ?>">
                                                    <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                                </div>
                                            </div>
                                        </div>  
                                        <?= $this->Form->create(false, ['url' => ['action' => 'registerFreelance'], 'type' => 'file', 'id' => 'frmFreelanceRegistration']) ?>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="subscription-desc">Annual subscription charges <span> <?= PAYMENT_CURRENCY . ' ' . FREELANCE_PAYMENT ?></span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name">Name<span class="required_field">*</span>
                                                    <input type="text" id="name" class="form-control" name="fl_name" required>
                                                    <span class="input-icon"><i class="fa fa-user"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="nick_name">Nick Name<span class="required_field">*</span>
                                                    <input type="text" id="nick_name" class="form-control" name="nick_name" required>
                                                    <span class="input-icon"><i class="fa fa-user"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="fl_email">Email<span class="required_field">*</span>
                                                    <input type="email" id="fl_email" class="form-control" name="fl_email" required>
                                                    <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="fl_password">Password<span class="required_field">*</span>
                                                    <input type="password" id="fl_password" class="form-control" name="fl_password" required>
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
                                                    <input type="tel" id="fl_mob_no" class="form-control" name="fl_mob_no" required>
                                                    <span class="input-icon"><i class="fa fa-mobile"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="fl_website_name">Website URL<span class="required_field">*</span>
                                                    <input type="text" id="fl_website_name" class="form-control" name="fl_website_name" required>
                                                    <span class="input-icon"><i class="fa fa-tv"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="fl_country">Country of Residence<span class="required_field">*</span>
                                                    <input id="fl_country_selector" type="text" name="fl_country_selector">
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
                                                    <a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">I have already registered</a>     
                                                </div>
                                            </div>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <div class="register-modal modal fade" id="termCondModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="header-modal"> Terms & Conditions</div>

                        <div class="modal-body">
                            <ul>
                                <li>No Refunds at any case.</li>
                                <li>You Verify that you own all the images, info and website of the registered corporate. </li>
                                <li>By agreeing to this term and conditions you accept that golden circle can talk with clients on your behalf. </li>
                                <li>Golden circle has the right to charge 10% of the total invoice as service charge.</li>
                                <li>In case client has comments on the work done Golden Circle has the right to hold the paid amount till the job is done properly.</li>
                            </ul>
                            <button type="button" class="btn btn-primary center-block" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
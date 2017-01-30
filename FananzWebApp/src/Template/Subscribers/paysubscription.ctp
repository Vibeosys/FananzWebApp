<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header');

echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
?>
<section class="login subscribe-payment">
    <div class="container">
        <div class="row">
            <div class="login-wrapper">
                <div class="login-form-container">
                    <div class="col-lg-12">
                        <div class="login-social">
                            <h2>Payment options</h2>
                            <!--                            <h3>Sign in with social</h3>-->
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="total-price">
                            <h3>Annual subscription fees </h3><span><?= $paymentCurrency . ' ' . $paymentAmount ?></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="select-method-text">
                            <span>Select Payment Method</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="<?=VIRTUAL_DIR_PATH.'/pptransactions/'?>">
                            <div class="paypal-link">
                                <div class="paypal-img">
                                    <?= $this->Html->image('pp.png', ['alt' => 'paypal']) ?>   
                                </div>
                                <div class="paypal-text">
                                    <span class="pp1">Paypal</span>
                                    <span class="pp2">pay with paypal</span>
                                </div>            
                            </div>
                        </a>
                    </div>
                        <div class="col-lg-12 block-line">
                        <div class="line-or">
                            <span>OR</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="paying-by-cash">
                            <div class="paying-by-cash-wrapper">
                                <h3>Paying by Cash? </h3>
                                <p>Call:<a href="tel:+971-055-8277781"> +971-055-8277781</a> </p>
                            </div>
                        </div>
                    </div>
                  <div class="col-lg-12 block-line">
                        <div class="line-or">
                            <span>OR</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="paying-later">
                            <div class="paying-btn-wrapper">
                                <button class="button paying-by-later"> Skip this for now <span class="paying-by-later-icon"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
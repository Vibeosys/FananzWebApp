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
<section class="login">
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
                                    <img src="img/pp.png" alt="paypal">
                                </div>
                                <div class="paypal-text">
                                    <span class="pp1">Paypal</span>
                                    <span class="pp2">pay with paypal</span>
                                </div>            
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <a href="add_portfolio_freelance.html">
                            <div class="visa-link">
                                <div class="visa-img">
                                    <img src="img/visa.png" alt="visa">
                                </div>
                                <div class="visa-text">
                                    <span class="vs1">Visa</span>
                                    <span class="vs2">**** **** **** 1234</span>
                                </div>            
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
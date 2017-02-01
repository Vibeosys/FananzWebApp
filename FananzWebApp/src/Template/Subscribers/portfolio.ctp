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
?>
<section class="header-portfolio" id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h1 class="portfolio-res-nm"><?= $subscriberDetails->name ?></h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h1 class="portfolio-header"><?= $this->Html->image('my-portfolio.png', ['class' => 'my-portfolio-img', 'alt' => 'my portfolio']) ?>   My Portfolio</h1>
            </div>
        </div>
    </div>
</section>
<section class="portfolio category_artist" >
    <div class="container">
        <?= $this->Form->hidden('subscriberId', ['value' => $subscriberDetails->subscriberId]) ?>
        <div class="row">
            <?php
            if (is_array($portfolioList) && count($portfolioList) > 0) {
                foreach ($portfolioList as $portfolio) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="layout-figure">
                            <div class="figure-img">                            
                                <img class="img-responsive" src="<?= $portfolio->coverImageUrl ?>">
                            </div>
                            <div class="figure-caption">
                                <div class="artist-name">
                                    <h3><?= $portfolio->subscriberName ?></h3>
                                </div>
                                <div class="artist-cat">
                                    <?php
                                    if ($portfolio->subCategory != '') {
                                        ?>
                                        <h4><?= $portfolio->category . ' - ' . $portfolio->subCategory ?></h4>
                                    <?php } else {
                                        ?>
                                        <h4><?= $portfolio->category ?></h4>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?= $this->Form->hidden('portfolioId', ['value' => $portfolio->portfolioId]) ?>
                                <div class="artist-price">
                                    <div class="price-text"><span>Price</span></div>
                                    <div class="price">AED<span><?= $portfolio->minPrice . ' - ' . $portfolio->maxPrice ?></span></div>
                                </div>
                                <div class="cate-link">
                                    <div class="edit-artists">
                                        <a href="<?= sprintf('%s%d', VIRTUAL_DIR_PATH . '/portfolio/update/', $portfolio->portfolioId) ?>" >Update</a>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }//end of portfolio
            }
            ?>
            <?php
            if ($addPortfolioAllowed) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                    <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/add' ?>">
                        <div class="portfolio-wrapper add-portfolio">
                            <div class="portfolio-card">
                                <i class="fa fa-plus-circle"></i>
                                <span>Add Portfolio</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="detail-corporate">
                    <div class="row"> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row-title">
                                <h2>Profile Details</h2>
                            </div>
                        </div> 
                        <?=$this->Form->create(false, ['url' => ['action' => 'saveBasicInfo']])?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="com_name">Business Name
                                    <input type="text" id="com_name" class="form-control" name="com_name" value="<?= $subscriberDetails->name ?>">
                                    <span class="input-icon"><i class="fa fa-address-book-o"></i></span>
                                </label>
                            </div>
                        </div>
                        <?php if($subscriberType == FREELANCE_SUB_TYPE) : ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="represent_name">Nick Name
                                    <input type="text" id="represent_name" class="form-control" name="nick_name" value="<?= $subscriberDetails->nickName?>">
                                    <span class="input-icon"><i class="fa fa-address-card-o"></i></span>
                                </label>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="represent_name">Name of Representative
                                    <input type="text" id="represent_name" class="form-control" name="represent_name" value="<?= $subscriberDetails->contactPerson ?>">
                                    <span class="input-icon"><i class="fa fa-address-card-o"></i></span>
                                </label>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_email">Email
                                    <input type="email" id="cor_email" class="form-control" name="cor_email" value="<?= $subscriberDetails->emailId ?>">
                                    <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_password">Password
                                    <input type="password" id="cor_password" class="form-control" name="cor_password" value="<?= $subscriberDetails->password ?>">
                                    <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_tel_no">Telephone No
                                    <input type="tel" id="cor_tel_no" class="form-control" name="cor_tel_no" value="<?= $subscriberDetails->telNo ?>">
                                    <span class="input-icon"><i class="fa fa-phone"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_mob_no">Mobile No
                                    <input type="tel" id="cor_mob_no" class="form-control" name="cor_mob_no" value="<?= $subscriberDetails->mobileNo ?>">
                                    <span class="input-icon"><i class="fa fa-mobile"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_website_name">Website URL
                                    <input type="text" id="cor_website_name" class="form-control" name="cor_website_name" value="<?= $subscriberDetails->websiteUrl ?>">
                                    <span class="input-icon"><i class="fa fa-tv"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_country">Country of Residence
                                    <input type="text" id="cor_country" class="form-control" name="cor_country" value="<?= $subscriberDetails->country ?>">
                                    <span class="input-icon"><i class="fa fa-globe"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="button-set">
                                    <button  type="submit" title="Update"  class="white_back_btn">Update</button>     
                                </div>
                            </div>
                        </div>
                        <?=$this->Form->end()?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="detail-corporate">
                    <div class="row"> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row-title">
                                <h2>Bank Details</h2>
                            </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="bank_name">Bank Name
                                    <input type="text" id="bank_name" class="form-control" name="bank_name">
                                    <span class="input-icon"><i class="fa fa-bank"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="cor_tel_no">Account No
                                    <input type="tel" id="cor_tel_no" class="form-control" name="cor_tel_no">
                                    <span class="input-icon"><i class="fa fa-code"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="button-set">
                                    <button  type="submit" title="Update"  class="white_back_btn">Update</button>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Bank Details end -->
        </div>
    </div>
</section>

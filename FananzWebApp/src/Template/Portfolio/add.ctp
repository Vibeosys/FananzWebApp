<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header', array('isSubscriberLoggedIn' => $isSubscriberLoggedIn,
    'subscriberName' => $subscriberName));

echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
echo $this->Html->css('/css/design/slick.css', ['block' => true]);
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);
echo $this->Html->css('/css/design/slick-theme.css', ['block' => true]);

echo $this->Html->script('/js/jquery.custom-file-input.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
echo $this->Html->script('/js/jquery.validate.js', ['block' => true]);
echo $this->Html->script('/js/validation.subscribe.reg.js', ['block' => true]);
echo $this->Html->script('/js/custom.js', ['block' => true]);
echo $this->Html->script('/js/jquery.file.upload.js', ['block' => true]);
echo $this->Html->script('/js/slick.min.js', ['block' => true]);
echo $this->Html->script('/js/portfolio.carousel.js', ['block' => true]);
echo $this->Html->script('/js/pages/portfolio-add.js', ['block' => true]);
?>    
<section class="add-corp-portfolio" id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="add-corp-portfolio-wrapper">
                    <div class="add-corp-portfolio-container">
                        <?= $this->Form->create(false, ['url' => ['action' => 'save'], 'type' => 'file']) ?>
                        <div class="row-title">
                            <h2>Add Your Portfolio</h2>
                        </div>
                        <div class="form-group">
                            <label for="activity">Choose Category
                                <?php
                                echo $this->Form->select('select-cat-id', $categoryList, ['class' => 'form-control', 'id' => 'select-cat-id']);
                                ?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Sub Category
                                <select id="select-subcat-id" class="form-control" name="select-subcat-id" >                                                    
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                Cover Photo <span class="required_field"> *</span><span class="img-size">size 500 x 400</span>
                                <div class="cover-photo-wrapper">
                                    <div class="file-upload"> 
                                        <input type="file" class="file"  title="file 1" accept="image/*" id="file" name="coverImage">
                                        <div id="prev_file" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-group">
                            <label >
                                Photos<span class="required_field"> *</span><span class="img-size">size 300 x 200</span>
                                <div class="add_portfolio_carousel style_1 per_row_2" id="add_portfolio_carousel">
                                    <?php
                                    for ($imageCounter = 0; $imageCounter < $allowedImageCount; $imageCounter++) {
                                        $fileCounter = $imageCounter + 1;
                                        ?>
                                        <div class="portfolio-file" id="parent3">
                                            <div class="file-upload" id="child1"> 
                                                <input type="file" class="file"  title="file 1" accept="image/*" id="<?= sprintf('file%d', $fileCounter) ?>" name="<?= sprintf('file%d', $fileCounter) ?>">
                                                <div id="<?= sprintf('prev_file%d', $fileCounter) ?>" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                            </div>
                                            <div class="portfolio-img-btn" id="parent2">
                                                <div class="edit-portfolio" id="parent1">
                                                    <div class="edit-pf-btn" id="parent"><button type="button" class="photo-edit-btn">Replace</button></div>
                                                    <div class="delete-pf-btn"><button type="button" class="photo-delete-btn">Delete</button></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="cor_fb_link">Facebook Link <span class="required_field"> *</span>
                                <input type="text" id="cor_fb_link" class="form-control" name="cor_fb_link" required>
                                <span class="input-icon1"><i class="fa fa-facebook"></i></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="cor_yt_link">Youtube Link<span class="required_field"> *</span>
                                <input type="text" id="cor_yt_link" class="form-control" name="cor_yt_link" required>
                                <span class="input-icon1"><i class="fa fa-youtube"></i></span>
                            </label>
                        </div>                            
                        <div class="form-group">
                            <label for="mini_price">Minimum Price(AED)<span class="required_field"> *</span>
                                <input type="text" id="mini_price" class="form-control" name="min_price" placeholder="AED 2000" required>
                                <span class="input-icon1"><i class="fa fa-money"></i></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="max_price">Maximum Price(AED)<span class="required_field"> *</span>
                                <input type="text" id="max_price" class="form-control" name="max_price" placeholder="AED 5000" required>
                                <span class="input-icon1"><i class="fa fa-money"></i></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="corpo_self">Write about yourself<span class="required_field"> *</span>
                                <textarea id="corpo_self" class="form-control" name="corpo_self" rows=4 required></textarea>
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="button-set">
                                <button type="submit" title="Update" class="button black_sm">Add</button>
                                <a href="<?= VIRTUAL_DIR_PATH . '/subscribers/portfolio' ?>" class="back_btn">Cancel</a>     
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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
echo $this->Html->script('/js/pages/portfolio-update.js', ['block' => true]);
?>    
<section class="add-corp-portfolio" id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="add-corp-portfolio-wrapper">
                    <div class="add-corp-portfolio-container">
                        <div class="col-lg-12">
                            <div class="error-msg-container">
                                <div class="<?= $errorDivClass ?>">
                                    <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->create(false, ['url' => ['action' => 'saveupdate'], 'type' => 'file']) ?>
                        <div class="row-title">
                            <h2>Update Portfolio</h2>
                        </div>
                        <?= $this->Form->hidden('hdnPortfolioId', ['value' => $portfolioDetails->portfolioId]) ?>
                        <div class="form-group">
                            <label for="activity">Choose Category
                                <?php
                                echo $this->Form->select('select-cat-id', $categoryList, ['class' => 'form-control', 'id' => 'select-cat-id', 'value' => $portfolioDetails->categoryId]);
                                ?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Sub Category
                                <?php
                                echo $this->Form->select('select-subcat-id', $subCategoryList, ['class' => 'form-control', 'id' => 'select-subcat-id', 'value' => $portfolioDetails->subCategoryId]);
                                ?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                Cover Photo <span class="required_field"> *</span><span class="img-size">size 500 x 400</span>
                                <div class="cover-photo-wrapper">
                                    <div class="file-upload"> 
                                        <input type="file" class="file"  title="file 1" accept="image/*" id="file" name="coverImage">
                                        <?php if (is_null($portfolioDetails->coverImageUrl) || $portfolioDetails->coverImageUrl == '') { ?>
                                            <div id="prev_file" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                        <?php } else { ?>
                                            <div id="prev_file" class="preview"><?= $this->Html->image($portfolioDetails->coverImageUrl, ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-group">
                            <label >
                                Photos<span class="required_field"> *</span><span class="img-size">size 300 x 200</span>
                                <div class="add_portfolio_carousel style_1 per_row_2" id="add_portfolio_carousel">
                                    <?php
                                    if ($portfolioDetails->photos != null && is_array($portfolioDetails->photos)) :
                                        foreach ($portfolioDetails->photos as $photoId => $photoUrl) :
                                            $fileCounter = $photoId;
                                            ?>
                                            <div class="portfolio-file" id="parent3">
                                                <div class="file-upload" id="child1"> 
                                                    <input type="file" class="file"  title="file 1" accept="image/*" id="<?= sprintf('file%d', $fileCounter) ?>" name="<?= sprintf('file%d', $fileCounter) ?>">
                                                    <div id="<?= sprintf('prev_file%d', $fileCounter) ?>" class="preview">
                                                        <?= $this->Html->image($photoUrl, ['class' => 'prev_thumb', 'alt' => 'file upload']) ?>
                                                    </div>
                                                </div>
                                                <div class="portfolio-img-btn" id="parent2">
                                                    <div class="edit-portfolio" id="parent1">
                                                        <div class="edit-pf-btn" id="parent"><button type="button" class="photo-edit-btn">Replace</button></div>
                                                        <div class="delete-pf-btn"><button type="button" class="photo-delete-btn">Delete</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $allowedImageCount--;
                                        endforeach;
                                    endif;
                                    ?>

                                    <?php
                                    $tm = new Cake\I18n\Time();
                                    $counterSeed = $tm->getTimestamp();

                                    for ($imageCounter = 0; $imageCounter < $allowedImageCount; $imageCounter++) {
                                        //$fileCounter = 0;
                                        $fileCounter = $counterSeed + $imageCounter;
                                        ?>
                                        <div class="portfolio-file" id="parent3">
                                            <div class="file-upload" id="child1"> 
                                                <input type="file" class="file"  title="file 1" accept="image/*" id="<?= sprintf('file%d', $fileCounter) ?>" name="<?= sprintf('file%d', $fileCounter) ?>">
                                                <div id="<?= sprintf('prev_file%d', $fileCounter) ?>" class="preview">
                                                    <?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?>
                                                </div>
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
                                <input type="text" id="cor_fb_link" class="form-control" name="cor_fb_link" required value="<?= $portfolioDetails->fbLink ?>">
                                <span class="input-icon1"><i class="fa fa-facebook"></i></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="cor_yt_link">Youtube Link<span class="required_field"> *</span>
                                <input type="text" id="cor_yt_link" class="form-control" name="cor_yt_link" required value="<?= $portfolioDetails->youtubeLink ?>">
                                <span class="input-icon1"><i class="fa fa-youtube"></i></span>
                            </label>
                        </div>                            
                        <div class="form-group">
                            <label for="mini_price">Minimum Price(AED)<span class="required_field"> *</span>
                                <input type="text" id="mini_price" class="form-control" name="min_price" placeholder="AED 2000" required value="<?= $portfolioDetails->minPrice ?>">
                                <span class="input-icon1"><i class="fa fa-money"></i></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="max_price">Maximum Price(AED)<span class="required_field"> *</span>
                                <input type="text" id="max_price" class="form-control" name="max_price" placeholder="AED 5000" required value="<?= $portfolioDetails->maxPrice ?>">
                                <span class="input-icon1"><i class="fa fa-money"></i></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="corpo_self">Write about yourself<span class="required_field"> *</span>
                                <textarea id="corpo_self" class="form-control" name="corpo_self" rows=4 required><?= $portfolioDetails->aboutUs ?></textarea>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Publish status<span class="required_field"> *</span>
                                <?php
                                if ($portfolioDetails->isActive == 1) :
                                    ?>
                                    <input type="radio" name="rd_active" value="1" checked > Publish and Make Live
                                    <input type="radio" name="rd_active"  value="0" > Keep in Draft, Don't Publish
                                    <?php
                                else :
                                    ?>
                                    <input type="radio" name="rd_active" value="1"> Publish and Make Live
                                    <input type="radio" name="rd_active"  value="0" checked> Keep in Draft, Don't Publish
                                <?php
                                endif;
                                ?>                                
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="button-set">
                                <button type="submit" title="Update" class="button black_sm">Update</button>
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


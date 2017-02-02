<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindPortfolioDto;

//$this->layout = 'home_layout';
//$this->layout = 'header';
echo $this->element('header', array('isUserLoggedIn' => $isUserLoggedIn,
    'userName' => $userName,
    'isSubscriberLoggedIn' => $isSubscriberLoggedIn,
    'subscriberName' => $subscriberName));

echo $this->Html->css('design/nouislider.css');
echo $this->Html->css('design/responsiveslides.css');
echo $this->Html->script('/js/pages/portfolio-view.js', ['block' => true]);
?>

<?php if ($topBannerDetails != null) : ?>
    <section class="banner mg-top-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-img">
                        <a href="<?= $topBannerDetails->clickUrl ?>"> 
                            <?= $this->Html->image($topBannerDetails->imageUrl); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php
if (count($portfolioDetails) > 0) {
    ?>
    <section class="filter-categ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fliter-wrapper">
                        <div class="sort-categ">
                            <span>Sort By</span>
                            <select class="form-control" id="short_select">
                                <option value="1" >New & Popular</option>
                                <option value="2">Price: Low to High</option>
                                <option value="3">Price: High to Low</option>
                            </select>
                        </div>
                        <div class="filter-categ">
                            <span>Filter</span>
                            <div class="price" id="price_categ">
                                <span>Price <i class="fa fa-caret-down"></i></span>
                                <div class="price-range">
                                    <input type="text" id="txtMinPrice" hidden="hidden">
                                    <input type="text" id="txtMaxPrice" hidden="hidden">
                                    <div id="keypress" class="noUi-target noUi-rtl noUi-horizontal">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-btn">
                                <button type="button" id="submitFiler" class="btn btn-primary">Apply</button>
                                <button type="button" id="resetFilter" class="btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pagination-page" id="paginationStart">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination-inner">
                        <label>
                            Show:
                        </label>
                        <select id="Itemsperpage">
                            <option  selected="selected">9</option>
                            <option>15</option>
                            <option>21</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <?php
} else {
    ?>
    <section class="data-not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dnf-img">
                        <?= $this->Html->image('data-not-found3.png', array('class' => 'img-responsive')); ?>
                    </div>
                    <div class="dnf-content">
                        <h2>No Records Found</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
<section class="category_artist">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            </div>
            <ul id="portfolioUl">


                <?php
                foreach ($portfolioDetails as $portfolio) {
                    // echo $portfolio->subcategory ;
                    ?>
                    <li id="portfolioLi">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="layout-figure">
                                <div class="figure-img">
                                    <?php
                                    if ($portfolio->coverImageUrl == "") {
                                        ?>


                                        <?= $this->Html->image('default_img.jpg', array('class' => 'img-responsive')); ?>
                                        <?php
                                    } else {
                                        ?>

                                        <?= $this->Html->image($portfolio->coverImageUrl, ['class' => 'img-responsive', 'alt' => $portfolio->subcategory]) ?>
                                    <?php }
                                    ?>
                                </div>
                                <div class="figure-caption">
                                    <div class="artist-name">
                                        <h3>  <?= $portfolio->subscriberName ?></h3>
                                    </div>
                                    <div class="artist-cat">
                                        <?php
                                        if ($portfolio->subcategory != '') {
                                            ?>

                                            <h4> <?= $portfolio->category ?> - <?= $portfolio->subcategory ?></h4>
                                            <?php
                                        } else {
                                            ?>
                                            <h4> <?= $portfolio->category ?> </h4>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="artist-price">
                                        <div class="price-text"><span>Price</span></div>
                                        <div class="price">AED<span> <?= $portfolio->minPrice ?> - <?= $portfolio->maxPrice ?> </span></div>
                                    </div>
                                    <div class="cate-link">
                                        <?= $this->Form->hidden('hdnPortfolioId', ['value' => $portfolio->portfolioId]) ?>
                                        <div class="detail-artists">
                                            <a href="#" data-toggle="modal" class="detail_artists" onclick="showDetails(<?= $portfolio->portfolioId ?>)">Details</a>    
                                        </div>
                                        <div class="request-artists">
                                            <a href="#request_artists" data-toggle="modal">Request Now</a>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
            if (count($portfolioDetails) > 0) {
                ?>
                <div class="col-lg-12" id="paginator_last">
                    <div class="pg-bottom">
                        <div class="total-page">
                            <p id="legend1"></p>
                        </div>
                        <div class="page-holder">
                            <div class="holder">
                            </div>
                        </div>
                    </div>
                </div>  


                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php if ($bottomBannerDetails != null) : ?>
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-img">
                        <a href="<?= $bottomBannerDetails->clickUrl ?>"> 
                            <?= $this->Html->image($bottomBannerDetails->imageUrl); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<div class="detail_artists modal fade" id="detail_artists" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div class="header-modal" id="portfolio-header-id"> Details of Artists</div>
            <div class="modal-body">
                <div class="rslides_container">
                    <ul class="rslides" id="slider1">
                        <li>
                            <?= $this->Html->image('slider-1.jpg', array('alt' => '')); ?>

                        </li>
                        <li>
                            <?= $this->Html->image('slider-2.jpg', array('alt' => '')); ?>

                        </li>
                        <li>
                            <?= $this->Html->image('slider-3.jpg', array('alt' => '')); ?>


                        </li>
                        <li>
                            <?= $this->Html->image('slider-4.jpg', array('alt' => '')); ?>

                        </li>
                        <!-- items mirrored twice, total of 12 -->
                    </ul>
                </div>
                <div class="detail_artists_right">
                    <h3 id="portfolio-title-id"></h3>
                    <h4 id="portfolio-cat-id"></h4>
                    <div class="price"><span class="da-1">Price in AED</span> <span class="da-2" id="portfolio-price-range-id"></span></div>
                    <p id="portfolio-desc-id"></p>
                    <div class="share-link-social">
                        <div class="share-link-fb">
                            <a href="#" id="link-portfolio-fb" target="_blank"><img src="<?= VIRTUAL_DIR_PATH . '/img/fb.png' ?>"></a><div class="link-fb"><input type="text" readonly value="" id="txtFbId"></div>
                        </div>
                        <div class="share-link-yt">
                            <a href="#" id="link-portfolio-yt" target="_blank"><img src="<?= VIRTUAL_DIR_PATH . '/img/yt.png' ?>"></a><div class="link-yt"><input type="text" readonly value="" id="txtYtubeId"></div>
                        </div>
                    </div>
                    <div class="share-btn">
                        <span class="sb-text"> Share  <i class="fa fa-share-alt"></i>    </span>
                        <div class="share-btn-social">
                            <span><a href="" class="sbs-mail"><i class="fa fa-envelope"></i></a></span>
                            <span><a href="#" class="sbs-fb" onclick="shareToFacebook()"><i class="fa fa-facebook"></i></a></span>
                            <span><a href="" class="sbs-tw"><i class="fa fa-twitter"></i></a></span>
                            <span><a href="" class="sbs-gp"><i class="fa fa-google-plus"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="request_artists modal fade" id="request_artists" tabindex="-2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div class="header-modal">Request Services For Singer Taylor Swift </div>
            <div class="modal-body">
                <div class="form-group">
                    <label> Write some text
                        <textarea rows="5" class="form-control"></textarea>
                    </label>
                </div>
                <button type="submit" title="Submit" class="button black_sm center-block" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
<input type="text" id="categoryId" value="<?= $categoryId ?>" hidden="hidden">
<input type="text" id="subCategoryId" value="<?= $subCategoryId ?>" hidden="hidden">

<?php
//echo $this->element('footer');

echo $this->Html->script('responsiveslides.js');
echo $this->Html->script('nouislider.js');
echo $this->Html->script('wNumb.js');
echo $this->Html->script('jPages.min.js');
echo $this->Html->script('Pagination.js');
?>
<!-- //cart-js -->  



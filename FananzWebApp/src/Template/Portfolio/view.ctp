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
echo $this->Html->script('/js/pages/request-service.js', ['block' => true]);
?>

<?php if ($topBannerDetails != null) : ?>
    <section class="banner mg-top-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-img">
                        <a href="<?= $topBannerDetails->clickUrl ?>" target="_blank"> 
                            <?= $this->Html->image($topBannerDetails->imageUrl); ?>
                        </a>
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
                                        <div class="cover-img" style="background-image:url(<?= $portfolio->coverImageUrl ?>);">
                                    </div>
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
                                            <a href="#" data-toggle="modal" onclick="<?= sprintf('requestService(%d, \'%s\')', $portfolio->portfolioId, $portfolio->subscriberName) ?>">Request Now</a>    
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="paginator_last">
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
                        <a href="<?= $bottomBannerDetails->clickUrl ?>" target="_blank"> 
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
                        <!--
                                                <span class="sb-text"> Share  <i class="fa fa-share-alt"></i>    </span>
                                                <div class="share-btn-social">
                                                    <span><a href="" class="sbs-mail"><i class="fa fa-envelope"></i></a></span>
                                                    <span><a href="#" class="sbs-fb" onclick="shareToFacebook()"><i class="fa fa-facebook"></i></a></span>
                                                    <span><a href="" class="sbs-tw"><i class="fa fa-twitter"></i></a></span>
                                                    <span><a href="" class="sbs-gp"><i class="fa fa-google-plus"></i></a></span>
                                                </div>
                        -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_default_style">
                            <a class="a2a_button_facebook" target="_blank" href="" onclick='window.location.href = "https://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "&t=" + document.title;' rel="nofollow">
                                <span class="a2a_svg a2a_s__default a2a_s_facebook" style="background-color: rgb(59, 89, 152);">
                                    <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <path fill="#FFF" d="M17.78 27.5V17.008h3.522l.527-4.09h-4.05v-2.61c0-1.182.33-1.99 2.023-1.99h2.166V4.66c-.375-.05-1.66-.16-3.155-.16-3.123 0-5.26 1.905-5.26 5.405v3.016h-3.53v4.09h3.53V27.5h4.223z"></path>
                                    </svg>
                                </span>
                                <span class="a2a_label">Facebook</span>
                            </a>
                            <a class="a2a_button_twitter" target="_blank" href="/#twitter" rel="nofollow">
                                <span class="a2a_svg a2a_s__default a2a_s_twitter" style="background-color: rgb(85, 172, 238);">        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <path fill="#FFF" d="M28 8.557a9.913 9.913 0 0 1-2.828.775 4.93 4.93 0 0 0 2.166-2.725 9.738 9.738 0 0 1-3.13 1.194 4.92 4.92 0 0 0-3.593-1.55 4.924 4.924 0 0 0-4.794 6.049c-4.09-.21-7.72-2.17-10.15-5.15a4.942 4.942 0 0 0-.665 2.477c0 1.71.87 3.214 2.19 4.1a4.968 4.968 0 0 1-2.23-.616v.06c0 2.39 1.7 4.38 3.952 4.83-.414.115-.85.174-1.297.174-.318 0-.626-.03-.928-.086a4.935 4.935 0 0 0 4.6 3.42 9.893 9.893 0 0 1-6.114 2.107c-.398 0-.79-.023-1.175-.068a13.953 13.953 0 0 0 7.55 2.213c9.056 0 14.01-7.507 14.01-14.013 0-.213-.005-.426-.015-.637.96-.695 1.795-1.56 2.455-2.55z"></path>
                                    </svg>
                                </span>
                                <span class="a2a_label">Twitter</span>
                            </a>
                            <a class="a2a_button_google_plus" target="_blank" href="/#google_plus" rel="nofollow">
                                <span class="a2a_svg a2a_s__default a2a_s_google_plus" style="background-color: rgb(221, 75, 57);">
                                    <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M27 15h-2v-2h-2v2h-2v2h2v2h2v-2h2m-15-2v2.4h3.97c-.16 1.03-1.2 3.02-3.97 3.02-2.39 0-4.34-1.98-4.34-4.42s1.95-4.42 4.34-4.42c1.36 0 2.27.58 2.79 1.08l1.9-1.83C15.47 9.69 13.89 9 12 9c-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.72-2.84 6.72-6.84 0-.46-.05-.81-.11-1.16H12z" fill="#FFF"></path></svg>
                                </span>
                                <span class="a2a_label">Google+</span>
                            </a>
                            <a class="a2a_button_email" target="_blank" href="https://www.addtoany.com/add_to/email?linkurl=http%3A%2F%2Ffananz.com&amp;linkname=Share%20Buttons%20Code%20for%20Any%20Website%20-%20fananz&amp;linknote=" rel="nofollow">
                                <span class="a2a_svg a2a_s__default a2a_s_email" style="background-color: rgb(1, 102, 255);">
                                    <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#FFF" d="M26 21.25v-9s-9.1 6.35-9.984 6.68C15.144 18.616 6 12.25 6 12.25v9c0 1.25.266 1.5 1.5 1.5h17c1.266 0 1.5-.22 1.5-1.5zm-.015-10.765c0-.91-.265-1.235-1.485-1.235h-17c-1.255 0-1.5.39-1.5 1.3l.015.14s9.035 6.22 10 6.56c1.02-.395 9.985-6.7 9.985-6.7l-.015-.065z"></path></svg></span>
                                <span class="a2a_label">Email</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->start('requestServicePopup') ?>
<div class="request_artists modal fade" id="service_request_div-id" tabindex="-2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content"><button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div class="header-modal" id="request-service-sub-id">Request Services For Singer Taylor Swift </div>
            <div class="modal-body">
                <div class="form-group">
                    <label> Write some text
                        <textarea rows="5" class="form-control portfolio_home" id="portfolio_msg" ></textarea>
                    </label>
                    <input type="hidden" id="hdnRsPortfolioId" value="" class="home_portfolio_id">
                </div>
                <button type="button" id="portfolio_txt" class="button black_sm center-block" onclick="submitRequest()">Submit</button>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->end() ?>

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



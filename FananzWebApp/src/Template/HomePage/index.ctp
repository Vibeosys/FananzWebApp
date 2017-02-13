<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header', array('isUserLoggedIn' => $isUserLoggedIn,
    'userName' => $userName,
    'isSubscriberLoggedIn' => $isSubscriberLoggedIn,
    'subscriberName' => $subscriberName));
echo $this->Html->css('design/responsiveslides.css');
echo $this->Html->script('/js/slider/jquery.themepunch.revolution.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/slider/jquery.themepunch.tools.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/slider/revolution.extension.layeranimation.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/slider/revolution.extension.navigation.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/slider/revolution.extension.slideanims.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/slider/slider.config.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/jquery.flexisel.js', ['block' => 'scriptTop']);
echo $this->Html->script('responsiveslides.js');

echo $this->Html->script('/js/pages/home-index.js', ['block' => true]);
echo $this->Html->script('/js/pages/request-service.js', ['block' => true]);
?>

<div id="main">
    <div class="container">
        <div class="content-area">
            <article id="post-2">
                <div class="wpb_revslider_element wpb_content_element">
                    <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullscreen-container" style="background-color:transparent;padding:0px;">
                        <!-- START REVOLUTION SLIDER 5.1.6 fullscreen mode -->
                        <div id="rev_slider_4_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.1.6">
                            <ul>
                                <li data-index="rs-16" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="img/slider-1.jpg"  data-delay="5000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide">
                                    <?= $this->Html->image('slider-1.jpg', ['class' => 'rev-slidebg', 'alt' => '']) ?>   
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-16-layer-1" 
                                         data-x="30" 
                                         data-y="center" data-voffset="-83" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 5; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-title">
                                            <mark>artists</mark> <span>SOLO</span>
                                        </div>
                                    </div>
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-16-layer-3" 
                                         data-x="30" 
                                         data-y="center" data-voffset="20" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="x:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 6; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-text">Upcoming solo exhibition “Inside the Landscape” <br>at XYZ Gallery on Dec 20 to Feb 20.<br>
                                            Please see  Events Page for more information.
                                        </div>
                                    </div>
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-16-layer-4" 
                                         data-x="30" 
                                         data-y="center" data-voffset="121" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a href="" class="button bordered icon_right slider-btn">Event</a> 
                                    </div>
                                </li>
                                <!-- SLIDE  -->
                                <li data-index="rs-17" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="img/slider-2.jpg"  data-delay="5000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="img/slider-2.jpg"  alt=""  width="1920" height="759" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-17-layer-1" 
                                         data-x="30" 
                                         data-y="center" data-voffset="-83" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:-50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 5; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-title">
                                            <mark>media</mark><span>EVENT</span>
                                        </div>
                                    </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-17-layer-3" 
                                         data-x="30" 
                                         data-y="center" data-voffset="20" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 6; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-text">Upcoming solo exhibition “Inside the Media” <br>at ABC Media Pvt Ltd on Dec 20 to Jan 5.<br>
                                            Please see  Events Page for more information.
                                        </div>
                                    </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-17-layer-4" 
                                         data-x="30" 
                                         data-y="center" data-voffset="121" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="760" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a href="" class="button bordered icon_right slider-btn">Visit</a> 
                                    </div>
                                </li>
                                <!-- SLIDE  -->
                                <li data-index="rs-18" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="img/slider-3.jpg"  data-delay="5000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="img/slider-3.jpg"  alt=""  width="1920" height="1080" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-18-layer-1" 
                                         data-x="30" 
                                         data-y="center" data-voffset="-83" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="x:-50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 5; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-title">
                                            <mark>fashion </mark><span>WEEK</span>
                                        </div>
                                    </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-18-layer-3" 
                                         data-x="30" 
                                         data-y="center" data-voffset="20" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="x:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 6; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-text">Upcoming solo exhibition “Fashion Week” <br>at XYZ Gallery on Jan 20 to Jan 26.<br>
                                            Please see  Events Page for more information.
                                        </div>
                                    </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-18-layer-4" 
                                         data-x="30" 
                                         data-y="center" data-voffset="121" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a href="" class="button bordered icon_right slider-btn">Read More</a> 
                                    </div>
                                </li>
                                <!-- SLIDE  -->
                                <li data-index="rs-19" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="img/slider-4.jpg"  data-delay="5000"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="img/slider-4.jpg"  alt=""  width="1920" height="759" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-19-layer-1" 
                                         data-x="30" 
                                         data-y="center" data-voffset="-83" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:-50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 5; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-title">
                                            <mark>nightFire</mark> <span>LIFE</span>
                                        </div>
                                    </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-19-layer-3" 
                                         data-x="30" 
                                         data-y="center" data-voffset="20" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="500" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 6; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);">
                                        <div class="fananz-rev-text">Upcoming solo exhibition “nightFire” <br>at PQR Gallery on Dec 25 to Ded 31.<br>
                                            Please see  Events Page for more information.
                                        </div>
                                    </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption   tp-resizeme" 
                                         id="slide-19-layer-4" 
                                         data-x="30" 
                                         data-y="center" data-voffset="121" 
                                         data-width="['auto']"
                                         data-height="['auto']"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" 
                                         data-transform_out="opacity:0;s:300;s:300;" 
                                         data-start="760" 
                                         data-splitin="none" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a href="" class="button bordered icon_right slider-btn">Visit</a> 
                                    </div>
                                </li>
                            </ul>
                            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                        </div>
                        <script></script>
                        <script></script>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </article>
        </div>
    </div>
    <!--.container-->
</div>
<section class="service">
    <div class="top-brands">
        <div class="container">
            <h3>SERVICES</h3>
            <div class="sliderfig">
                <ul id="flexiselDemo1">
                    <li>
                        <div class="sliderfig-img">
                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/artists' ?>"><img src="img/1.png" alt="Artists" class="img-responsive" /></a>
                        </div>
                        <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/artists' ?>" class="dropdown-toggle  hyper page-scroll"><span>Artists</span> </a>

                    </li>
                    <li>
                        <div class="sliderfig-img">
                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/media' ?>"><img src="img/2.png" alt="Media" class="img-responsive" /></a>
                        </div>
                        <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/media' ?>" class="dropdown-toggle  hyper page-scroll"><span>Media</span> </a>

                    </li>
                    <li>
                        <div class="sliderfig-img">
                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/event-facilities' ?>"><img src="img/3.png" alt="Event" class="img-responsive" /></a>
                        </div>
                        <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/event-facilities' ?>" class="dropdown-toggle  hyper page-scroll"><span>Event Facilities</span> </a>

                    </li>
                    <li>
                        <div class="sliderfig-img">
                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/models' ?>"><img src="img/4.png" alt="Models" class="img-responsive" /></a>
                        </div>
                        <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/models' ?>" class="dropdown-toggle  hyper page-scroll"><span>Models</span> </a>

                    </li>
                    <li>
                        <div class="sliderfig-img">
                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/birthdays' ?>"><img src="img/5.png" alt="Birthdays" class="img-responsive" /></a>
                        </div>
                        <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/birthdays' ?>" class="dropdown-toggle  hyper page-scroll"><span>Birthdays</span> </a>

                    </li>
                    <li>
                        <div class="sliderfig-img">
                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/nightlife' ?>"><img src="img/6.png" alt="Night Life" class="img-responsive" /></a>
                        </div>
                        <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/nightlife' ?>" class="dropdown-toggle  hyper page-scroll"><span>Night Life</span> </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php if ($topBannerDetails != null): ?>
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-img">
                        <a href="<?= $topBannerDetails->clickUrl ?>"> 
                            <?= $this->Html->image($topBannerDetails->imageUrl, ['class' => 'img-responsive']); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="request_artist">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Portfolio</h3>
            </div>
            <?php if (count($portfolioList) == 0): ?>
                <div class="col-lg-12">
                    <div class="no-pf-container">
                        <div class="no-pf-wrapper">
                            <div class="no-pf-inner">
                                <div class="no-pf-header">
                                    <h4>No Portfolio At Movement</h4>
                                </div>
                                <div class="no-pf-content">
                                    <p>We are waiting for your portfolio</p>
                                </div>
                                <div class="no-pf-link">
                                    <a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">Please Add One</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            foreach ($portfolioList as $portfolio) {
                ?>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="layout-figure">
                        <div class="figure-img">
                            <?php
                            $textToDisplayOnOverlay = '';
                            if ($portfolio->subcategory == null) {
                                $textToDisplayOnOverlay = $portfolio->category;
                            } else {
                                $textToDisplayOnOverlay = $portfolio->subcategory;
                            }
                            ?>
                            <span><?= $textToDisplayOnOverlay ?></span>
                            <?php
                            if ($portfolio->coverImageUrl == "") {
                                ?>
                                <img src="img/default_img.jpg" alt= " <?= $textToDisplayOnOverlay ?> " class ='img-responsive'/>
                                <?php
                            } else {
                                ?>

                                <?= $this->Html->image($portfolio->coverImageUrl, ['class' => 'img-responsive', 'alt' => $textToDisplayOnOverlay]) ?>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="figure-caption">
                            <div class="artist-name">
                                <h4>By <?= $portfolio->subscriberName ?></h4>
                            </div>
                            <div class="artist-price">
                                <div class="price-text"><span>Price</span></div>
                                <div class="price">AED<span><?= $portfolio->minPrice ?> - <?= $portfolio->maxPrice ?></span></div>
                            </div>
                            <div class="cate-link">
                                <?= $this->Form->hidden('hdnPortfolioId', ['value' => $portfolio->portfolioId]) ?>
                                <div class="detail-artists">                                
                                    <a href="#" data-toggle="modal" class="detail_artists" onclick="showDetails(<?= $portfolio->portfolioId ?>)">Details</a>    
                                </div>
                                <div class="request-artists">
                                    <a href="#" data-toggle="modal" class="home_portfolio_request" onclick="<?= sprintf('requestService(%d, \'%s\')', $portfolio->portfolioId, $portfolio->subscriberName) ?>"> Request Now</a>   
                                </div>
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
<div class="banner-fananz">
    <div class="container">
        <h2>Parties & Events at Fananz</h2>
        <div class="col-md-5 bb-grids bb-left-text">
            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/models' ?>">
                <div class="bb-left-text-inner">
                    <p>Fashion Modeling</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-xs-12 bb-grids bb-middle-text">
            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/artists--belly-dancers' ?>">
                <div class="bb-middle-top">
                    <p>Solo Dance</p>
                </div>
            </a>
            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/birthdays' ?>">
                <div class="bb-middle-bottom">
                    <p>Birthday Party</p>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-xs-12 bb-grids bb-right-text">
            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/media--photographers' ?>">
                <div class="bb-right-top">
                    <p>Photography Capture</p>
                </div>
            </a>
            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/artists--singers' ?>">
                <div class="bb-right-bottom">
                    <p>Solo Singer</p>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php if ($bottomBannerDetails != null): ?>
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-img">
                        <a href="<?= $bottomBannerDetails->clickUrl ?>"> 
                            <?= $this->Html->image($bottomBannerDetails->imageUrl, ['class' => 'img-responsive']); ?>
                        </a>
                    </div>
                </div>           
            </div>
        </div>
    </section>
<?php endif; ?>

<?= $this->Html->start('requestServicePopup') ?>
<div class="request_artists modal fade" id="service_request_div-id" tabindex="-2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content"><button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div class="header-modal" id="request-service-sub-id"> </div>
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

<section class="client-partner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Client Partner</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="client-wrapper">
                    <div class="client-img">
                        <img class="img-responsive center-block" src="img/client-partner/justmedia.png" alt="Just Media FZE">
                    </div>
                    <h4>Developed By</h4>
                    <h5>Just Media FZE</h5>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <a href="http://www.gc-dubai.com " target="_blank">
                    <div class="client-wrapper">
                        <div class="client-img">
                            <img class="img-responsive center-block" src="img/client-partner/goldencircle.png" alt="Golden Circle Events Management">
                        </div>
                        <h4>Managed By</h4>
                        <h5>Golden Circle Events Management</h5>
                        <h5>(Al Daera Al Dahabia Events Management)</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>    
</section> 

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
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
   
       $this->layout = 'home_layout';
      // $this->layout = 'header';
       echo $this->element('header'); 
        
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
                           <?= $this->Html->image('slider-1.jpg', ['class' => 'rev-slidebg','alt' => ''])?>   
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
                     <a href=""><img src="img/1.png" alt="Artists" class="img-responsive" /></a>
                  </div>
                   <a href="<?=VIRTUAL_DIR_PATH.'/portfolio/artists'?>" class="dropdown-toggle  hyper page-scroll"><span>Artists</span> 
                  
               </li>
               <li>
                  <div class="sliderfig-img">
                     <a href=""><img src="img/2.png" alt="Media" class="img-responsive" /></a>
                  </div>
                   <a href="<?= VIRTUAL_DIR_PATH.'/portfolio/media'?>" class="dropdown-toggle  hyper page-scroll"><span>Media</span> 
                 
               </li>
               <li>
                  <div class="sliderfig-img">
                     <a href=""><img src="img/3.png" alt="Event" class="img-responsive" /></a>
                  </div>
                   <a href="<?=VIRTUAL_DIR_PATH.'/portfolio/event-facilities'?>" class="dropdown-toggle  hyper page-scroll"><span>EventFacilities</span> 
                 
               </li>
               <li>
                  <div class="sliderfig-img">
                     <a href=""><img src="img/4.png" alt="Models" class="img-responsive" /></a>
                  </div>
                    <a href="<?=VIRTUAL_DIR_PATH.'/portfolio/models'?>" class="dropdown-toggle  hyper page-scroll"><span>Models</span> 
                  
               </li>
               <li>
                  <div class="sliderfig-img">
                     <a href=""><img src="img/5.png" alt="Birthdays" class="img-responsive" /></a>
                  </div>
                    <a href="<?=VIRTUAL_DIR_PATH.'/portfolio/birthdays'?>" class="dropdown-toggle  hyper page-scroll"><span>Birthdays</span> 
                  
               </li>
               <li>
                  <div class="sliderfig-img">
                     <a href=""><img src="img/6.png" alt="Night Life" class="img-responsive" /></a>
                  </div>
                    <a href="<?=VIRTUAL_DIR_PATH.'/portfolio/nightlife'?>" class="dropdown-toggle  hyper page-scroll"><span>Night Life</span> 
                  
               </li>
            </ul>
         </div>
      </div>
   </div>
</section>
<section class="banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="banner-img">
               <a href=""> <img class="img-responsive" src="img/banner/banner1.jpg"></a>
            </div>
         </div>
         <!--
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div class="banner-wrapper">
                    <div class="banner-title">
                        <h3>Learn to Belly Dance</h3>
                    </div>
                    <div class="banner-line">
                        <p>...one of the oldest social dances<br>inword history</p>
                    </div>
                    <div class="banner-btn">
                        <a href="">Contact Now</a>
                    </div>
                </div>
            </div>
            -->
      </div>
   </div>
</section>
<section class="request_artist">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <h3>Portfolio</h3>
         </div>
          <?php      
            foreach($portfoioList as $portfolio) 
            {
            
            ?>
          
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   <div class="layout-figure">
                      <div class="figure-img">
                         <span><?= $portfolio->subcategory ?></span>
                         <?php
                        if( $portfolio->coverImageUrl == "")
                        {
                        ?>
                           
                         <img src="img/default_img.jpg" alt= " <?= $portfolio->subcategory ?> " class ='img-responsive'/>
                        <?php
                        
                        }
                        else
                        {
                         ?>
                         
                         <?= $this->Html->image( $portfolio->coverImageUrl, ['class' => 'img-responsive','alt' => $portfolio->subcategory])?>
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
                         <div class="figure-link">
                            <a href="" >Request Now</a>
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
         <div class="bb-left-text-inner">
            <p>Fashion Modeling</p>
         </div>
      </div>
      <div class="col-md-4 col-xs-12 bb-grids bb-middle-text">
         <div class="bb-middle-top">
            <p>Solo Dance</p>
         </div>
         <div class="bb-middle-bottom">
            <p>Birthday Party</p>
         </div>
      </div>
      <div class="col-md-3 col-xs-12 bb-grids bb-right-text">
         <div class="bb-right-top">
            <p>Photography Capture</p>
         </div>
         <div class="bb-right-bottom">
            <p>Solo Singer</p>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<section class="banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="banner-img">
               <a href=""> <img class="img-responsive" src="img/banner/banner2.jpg"></a>
            </div>
         </div>
         <!--
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div class="banner-wrapper">
                    <div class="banner-title">
                        <h3>Learn to Belly Dance</h3>
                    </div>
                    <div class="banner-line">
                        <p>...one of the oldest social dances<br>inword history</p>
                    </div>
                    <div class="banner-btn">
                        <a href="">Contact Now</a>
                    </div>
                </div>
            </div>
            -->
      </div>
   </div>
</section>
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
                     <h5>(Al Daera Al Dhabia Events Management)</h5>
                 </div>
                 </a>
            </div>
        </div>
    </div>    
</section> 
<?php
echo $this->element('footer'); 
//echo $this->layout = 'footer';
?>
<!-- //cart-js -->  

<script src="js/slider/jquery.themepunch.revolution.min.js"></script>
<script src="js/slider/jquery.themepunch.tools.min.js"></script>
<script src="js/slider/revolution.extension.layeranimation.min.js"></script>
<script src="js/slider/revolution.extension.navigation.min.js"></script>
<script src="js/slider/revolution.extension.slideanims.min.js"></script>
<script src="js/slider/slider.config.js"></script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<script type="text/javascript">
   $(window).load(function() {
       $("#flexiselDemo1").flexisel({
           visibleItems: 4,
           animationSpeed: 1000,
           autoPlay: false,
           autoPlaySpeed: 3000,    		
           pauseOnHover: true,
           enableResponsiveBreakpoints: true,
           responsiveBreakpoints: { 
               portrait: { 
                   changePoint:480,
                   visibleItems: 1
               }, 
               landscape: { 
                   changePoint:640,
                   visibleItems:2
               },
               tablet: { 
                   changePoint:768,
                   visibleItems: 3
               }
           }
       });
   
   });
   
   
</script>
</body>
</html>
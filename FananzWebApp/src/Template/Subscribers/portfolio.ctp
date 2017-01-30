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
                   <div class="col-lg-12">
                        <h2>My Portfolio</h2>
                   </div>
               </div>
           </div>
       </section>
      <section class="portfolio category_artist" >
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                 <div class="layout-figure">
                     <div class="figure-img">
                         <img class="img-responsive" src="img/request/singer.jpg">
                     </div>
                     <div class="figure-caption">
                         <div class="artist-name">
                             <h3>Taylor Swift</h3>
                         </div>
                         <div class="artist-cat">
                             <h4>Singer</h4>
                         </div>
                         <div class="artist-price">
                             <div class="price-text"><span>Price</span></div>
                             <div class="price">AED<span>2000 - 5000</span></div>
                         </div>
                         <div class="cate-link">
                             <div class="edit-artists">
                                 <a href="#edit_artists" data-toggle="modal">Update</a>    
                             </div>
                             <div class="delete-artists">
                                 <a href="" data-toggle="modal">Delete</a>    
                             </div>
                         </div>
                     </div>
                   </div>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                 <div class="layout-figure">
                     <div class="figure-img">
                         <img class="img-responsive" src="img/request/singer.jpg">
                     </div>
                     <div class="figure-caption">
                         <div class="artist-name">
                             <h3>Taylor Swift</h3>
                         </div>
                         <div class="artist-cat">
                             <h4>Singer</h4>
                         </div>
                         <div class="artist-price">
                             <div class="price-text"><span>Price</span></div>
                             <div class="price">AED<span>2000 - 5000</span></div>
                         </div>
                         <div class="cate-link">
                             <div class="edit-artists">
                                 <a href="#edit_artists" data-toggle="modal">Update</a>    
                             </div>
                             <div class="delete-artists">
                                 <a href="" data-toggle="modal">Delete</a>    
                             </div>
                         </div>
                     </div>
                   </div>
                </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                   <a href="add_portfolio.html">
                      <div class="portfolio-wrapper add-portfolio">
                          <div class="portfolio-card">
                              <i class="fa fa-plus-circle"></i>
                              <span>Add Portfolio</span>
                          </div>
                      </div>
                   </a>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="detail-corporate">
                        <div class="row"> 
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <div class="row-title">
                                   <h2>Profile Details</h2>
                               </div>
                           </div> 
                           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                               <div class="form-group">
                                 <label for="com_name">Business Name
                                 <input type="text" id="com_name" class="form-control" name="com_name">
                                 <span class="input-icon"><i class="fa fa-address-book-o"></i></span>
                                 </label>
                               </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                               <div class="form-group">
                                 <label for="represent_name">Name of Representative
                                 <input type="text" id="represent_name" class="form-control" name="represent_name">
                                 <span class="input-icon"><i class="fa fa-address-card-o"></i></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                 <label for="cor_email">Email
                                 <input type="email" id="cor_email" class="form-control" name="cor_email">
                                 <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                 <label for="cor_tel_no">Telephone No
                                 <input type="tel" id="cor_tel_no" class="form-control" name="cor_tel_no">
                                 <span class="input-icon"><i class="fa fa-phone"></i></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                 <label for="cor_mob_no">Mobile No
                                 <input type="tel" id="cor_mob_no" class="form-control" name="cor_mob_no">
                                 <span class="input-icon"><i class="fa fa-mobile"></i></span>
                                 </label>
                              </div>
                            </div>
                           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                 <label for="cor_website_name">Website Name
                                 <input type="text" id="cor_website_name" class="form-control" name="cor_website_name">
                                 <span class="input-icon"><i class="fa fa-tv"></i></span>
                                 </label>
                              </div>
                            </div>
                           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <div class="form-group">
                                 <label for="cor_country">Country of Residence
                                 <input type="text" id="cor_country" class="form-control" name="cor_country">
                                 <span class="input-icon"><i class="fa fa-globe"></i></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <div class="form-group">
                                    <div class="button-set">
                                       <button type="submit" title="Edit" class="button black_sm">Edit</button>
                                       <button  type="submit" title="Update"  class="white_back_btn">Update</button>     
                                    </div>
                                 </div>
                            </div>
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
                                       <button type="submit" title="Edit" class="button black_sm">Edit</button>
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
       
         
     <div class="edit_artists modal fade" id="edit_artists" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content"><button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                <div class="header-modal"> Edit Portfolio</div>
                <div class="modal-body">
                   <div class="portfolio-wrapper">
                    <form action="" method="post">
                         <div class="form-group">
                            <label for="activity">
                               Activity
                              <select id="activity" class="form-control" >
                                            <option value="Select Activity">Select Activity</option>
                                            <optgroup label="Artists">
                                                <option value="Singer"><span>Singer</span></option>
                                                <option value="Musician"><span>Musician</span></option>
                                                <option value="Belly Dance"><span>Belly Dance</span></option>
                                                <option value="Voice Over"><span>Voice Over</span></option>
                                                <option value="MC">MC</option>
                                                <option value="Band">Band</option>
                                                <option value="Music Arrenger">Music Arrenger</option>
                                                <option value="Song Compsoning z-DJs">Song Compsoning z-DJs</option>
                                            </optgroup>
                                            <optgroup label="Media">                                                
                                                <option value="Photographer">Photographer</option>
                                                <option value="Video Shooter">Video Shooter</option>
                                                <option value="Director">Director</option>
                                            </optgroup>
                                            <option value="Event Ficilities">Event Facilities</option>
                                            <option value="Model">Model</option>
                                            <option value="Birthday">Birthday</option>
                                            <option value="Night Life">Night Life</option>
                                        </select>
                            </label>
                         </div>
                         <div class="form-group">
                            <label >
                               Photos
                               <div class="file-upload">
                                  <div class="fileupload fileupload-new" data-provides="fileupload">
                                     <div class="fileupload-new thumbnail" ><img src="img/demoUpload.jpg" alt="" /> <span class="btn btn-file btn-primary"><input type="file" accept="image/*" id="cor_file_1" /></span></div>
                                     <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                  </div>
                                  <div class="fileupload fileupload-new" data-provides="fileupload">
                                     <div class="fileupload-new thumbnail" ><img src="img/demoUpload.jpg" alt="" /> <span class="btn btn-file btn-primary"><input type="file" accept="image/*" id="cor_file_2" /></span></div>
                                     <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                  </div>
                                  <div class="fileupload fileupload-new" data-provides="fileupload">
                                     <div class="fileupload-new thumbnail" ><img src="img/demoUpload.jpg" alt="" /> <span class="btn btn-file btn-primary"><input type="file" accept="image/*" id="cor_file_3" /></span></div>
                                     <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                  </div>
                               </div>
                            </label>
                         </div>
                         <div class="form-group">
                            <label for="cor_fb_link">Facebook Link 
                            <input type="text" id="cor_fb_link" class="form-control" name="cor_fb_link" required>
                            <span class="input-icon"><i class="fa fa-facebook"></i></span>
                            </label>
                         </div>
                         <div class="form-group">
                            <label for="cor_yt_link">Youtube Link
                            <input type="text" id="cor_yt_link" class="form-control" name="cor_yt_link" required>
                            <span class="input-icon"><i class="fa fa-youtube"></i></span>
                            </label>
                         </div>
                         <div class="form-group">
                            <label >Trade Certificate
                            <input type="file" name="trade_certificate" id="trade_certificate" class="inputfile inputfile-2"  accept="image/*" required/>
                            <label for="trade_certificate">
                               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                  <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                               </svg>
                               <span class="file-name">Choose a file...</span>
                            </label>
                            </label>
                         </div>
                           <div class="form-group">
                            <label for="mini_price">Minimum Price(AED)
                            <input type="text" id="mini_price" class="form-control" name="mini price" placeholder="AED 2000" required>
                            <span class="input-icon"><i class="fa fa-money"></i></span>
                            </label>
                         </div>
                           <div class="form-group">
                            <label for="max_price">Maximum Price(AED)
                            <input type="text" id="max_price" class="form-control" name="max_price" placeholder="AED 5000" required>
                            <span class="input-icon"><i class="fa fa-money"></i></span>
                            </label>
                         </div>
                         <div class="form-group">
                            <label for="corpo_self">Write about yourself
                            <textarea id="corpo_self" class="form-control" name="corpo_self" rows=4 required></textarea>
                            </label>
                         </div>
                         <div class="form-group">
                            <div class="button-set">
                               <button type="submit" title="Update" class="button black_sm edit_update">Update</button>
                               
                            </div>
                         </div>
                      </form>
                  </div>
                </div>
            </div>
            </div>
        </div>
   
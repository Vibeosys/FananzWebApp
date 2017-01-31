<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

echo $this->element('header');

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
?>    
<section class="add-corp-portfolio" id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="add-corp-portfolio-wrapper">
                    <div class="add-corp-portfolio-container">
                        <form action="" method="post">
                            <div class="row-title">
                                <h2>Add Your Portfolio</h2>
                            </div>
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
                                <label>
                                    Cover Photo <span class="required_field"> *</span><span class="img-size">size 500 x 400</span>
                                    <div class="cover-photo-wrapper">
                                        <div class="file-upload"> 
                                            <input type="file" class="file"  title="file 1" accept="image/*" id="file">
                                            <div id="prev_file" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                        </div>
                                    </div>
                                     
                                </label>
                            </div>
                            <div class="form-group">
                                <label >
                                    Photos<span class="required_field"> *</span><span class="img-size">size 300 x 200</span>
                                      <div class="add_portfolio_carousel style_1 per_row_2" id="add_portfolio_carousel">
                                          <div class="portfolio-file" id="parent3">
                                              <div class="file-upload" id="child1"> 
                                                  <input type="file" class="file"  title="file 1" accept="image/*" id="file1">
                                                  <div id="prev_file1" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                              </div>
                                              <div class="portfolio-img-btn" id="parent2">
                                                    <div class="edit-portfolio" id="parent1">
                                                        <div class="edit-pf-btn" id="parent"><button type="button" class="photo-edit-btn">Replace</button></div>
                                                         <div class="delete-pf-btn"><button type="button" class="photo-delete-btn">Delete</button></div>
                                                    </div>
                                              </div>
                                          </div>      
                                           <div class="portfolio-file">
                                            <div class="file-upload"> 
                                                <input type="file" class="file"  title="file 2" accept="image/*" id="file2">
                                                <div id="prev_file2" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                            </div>
                                               <div class="portfolio-img-btn">
                                                    <div class="edit-portfolio">
                                                        <div class="edit-pf-btn"><button type="button" class="photo-edit-btn">Replace</button></div>
                                                         <div class="delete-pf-btn"><button type="button" class="photo-delete-btn">Delete</button></div>
                                                    </div>
                                              </div>
                                          </div>      
                                          <div class="portfolio-file">
                                            <div class="file-upload"> 
                                                <input type="file" class="file"  title="file 2" accept="image/*" id="file3">
                                                <div id="prev_file3" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                            </div>
                                              <div class="portfolio-img-btn">
                                                    <div class="edit-portfolio">
                                                        <div class="edit-pf-btn"><button type="button" class="photo-edit-btn">Replace</button></div>
                                                         <div class="delete-pf-btn"><button type="button" class="photo-delete-btn">Delete</button></div>
                                                    </div>
                                              </div>
                                          </div> 
                                           <div class="portfolio-file">
                                            <div class="file-upload"> 
                                                <input type="file" class="file"  title="file 2" accept="image/*" id="file4">
                                                <div id="prev_file4" class="preview"><?= $this->Html->image('demoUpload.jpg', ['class' => 'prev_thumb', 'alt' => 'file upload']) ?></div>
                                            </div>
                                              <div class="portfolio-img-btn">
                                                    <div class="edit-portfolio">
                                                        <div class="edit-pf-btn"><button type="button" class="photo-edit-btn">Replace</button></div>
                                                         <div class="delete-pf-btn"><button type="button" class="photo-delete-btn">Delete</button></div>
                                                    </div>
                                              </div>
                                          </div> 
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
                                <label >Trade Certificate<span class="required_field"> *</span>
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
                                <label for="mini_price">Minimum Price(AED)<span class="required_field"> *</span>
                                    <input type="text" id="mini_price" class="form-control" name="mini price" placeholder="AED 2000" required>
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
                                    <button  type="submit" title="Delete"  class="white_back_btn">Back</button>     
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(){
        $('.file').preimage();
        
         $('.photo-edit-btn').click(function(e){
             e.preventDefault();
            var edit_id = $(this).parent().parent().parent().parents('.portfolio-file').find('.file').attr('id');
               
            $('#'+edit_id).trigger('click');
            
        });
        
        $('.photo-delete-btn').click(function(e){
            e.preventDefault();
            var delete_id = $(this).parent().parent().parent().parents('.portfolio-file').find('.preview').attr('id');
            var val1 = $('#'+delete_id).find('.prev_thumb').attr('src','../img/demoUpload.jpg');
            var cln = $('#'+delete_id).val('');
        });
        
    });
    
    
    
</script>
<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindPortfolioDto;
use Cake\View\Helper\HtmlHelper;

echo $this->element('admin_header', array('isAdminLoggedIn' => $isAdminLoggedIn));

echo $this->Html->css('/css/design/jquery.dataTables.min.css', ['block' => true]);
echo $this->Html->css('/css/design/bootstrap-fileupload.min.css', ['block' => true]);
echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);

echo $this->Html->script('/js/jquery.custom-file-input.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/bootstrap-fileupload.js', ['block' => 'scriptTop']);

echo $this->Html->script('/js/datatables/jquery.dataTables.min.js', ['block' => true]);
echo $this->Html->script('/js/datatables/dataTables.bootstrap.js', ['block' => true]);
echo $this->Html->script('/js/datatables/dataTables.responsive.min.js', ['block' => true]);
echo $this->Html->script('/js/datatables/responsive.bootstrap.min.js', ['block' => true]);
echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
echo $this->Html->script('/js/pages/admin-dashboard.js', ['block' => true]);
?>
<div class="loading-img"></div>
<section class="admin-dash" id="main">
    <div class="container">
        <div class="row">
            <div class="admin-wrapper">
                <div class="admin-form-container">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h3>Admin Dashboard</h3>
                        </div>
                    </div>
                    <ul class="nav nav-tabs admin-manage-tab">
                        <li class="active"><a id="category_add_tab" data-toggle="tab" href="#categ_add" class="li-mg-right">Manage Categories</a></li>
                        <li><a data-toggle="tab" href="#sub_catg_add" class="li-mg-right">Manage Subcategories</a></li>
                        <li ><a id="manage_subscriber_tab" data-toggle="tab" href="#manage_user_tab" class="li-mg-right">Manage Subscribers</a></li>
                        <li><a data-toggle="tab" href="#advt_banner" >Advt Banners</a></li>

                    </ul>
                    <div class="row border-outer-admindash">
                        <div class="tab-content">
                            <div id="categ_add" class="tab-pane fade in active">
                                <div class="col-lg-12">
                                    <div class="add-catg">                                        
                                        <p>Add Category</p>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="catg_name">Category Name
                                                    <input type="text" id="catg_name" class="form-control" name="com_name">
                                                    <span class="input-icon"><i class="fa fa-object-ungroup"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="button-set">
                                                    <button id="btn-cat-add" type="button" class="button black_sm">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="update-catg">
                                        <p>Update Category</p>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="activity">Category
                                                    <?php
                                                    echo $this->Form->select('select-cat-id', $categoryList, ['id' => 'select-cat-id', 'class' => 'form-control']);
                                                    ?>                                                    
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="catg_name">Category Name
                                                    <input type="text" id="catg_name_to_update" class="form-control" name="com_name">
                                                    <span class="input-icon"><i class="fa fa-object-ungroup"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="button-set">
                                                    <button type="button" id="btn-cat-update" class="button black_sm">Update</button>
                                                    <!--                                                    <button type="submit" title="Submit" class="white_back_btn">Delete</button>-->
                                                    <!--                                   <a href="index.html" class="white_back_btn">Back</a>     -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="sub_catg_add" class="tab-pane fade">

                                <div class="col-lg-12">
                                    <div class="add-sub-catg">
                                        <p>Add Sub Category</p>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="activity">Choose Category
                                                    <?php
                                                    echo $this->Form->select('select-cat-subcat-add-id', $categoryList, ['class' => 'form-control', 'id' => 'select-cat-subcat-add-id']);
                                                    ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="first_name">Sub Category
                                                    <input type="text" id="txt-subcat-name-add" class="form-control" name="fname">
                                                    <span class="input-icon"><i class="fa fa-object-ungroup"></i></span>
                                                </label>
                                            </div>
                                        </div>



                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="button-set">
                                                    <button type="button" id="btn-subcat-add" class="button black_sm">Add</button>
                                                    <!--                                           <a href="index.html" class="white_back_btn">Back</a>     -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="update-sub-catg">
                                        <p>Update Sub Category</p>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="activity">Choose Category
                                                    <?php
                                                    echo $this->Form->select('select-cat-subcat-update-id', $categoryList, ['class' => 'form-control', 'id' => 'select-cat-subcat-update-id']);
                                                    ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="first_name">Sub Category
                                                    <select id="select-subcat-update-id" class="form-control" >                                                    
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="first_name">Update Sub Category
                                                    <input type="text" id="txt-subcat-update" class="form-control" name="fname">
                                                    <span class="input-icon"><i class="fa fa-object-group"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="button-set">
                                                    <button type="button" id="btn-subcat-update" class="button black_sm">Update</button>
                                                    <!--<button type="submit" title="Submit" class="white_back_btn">Delete</button>-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="advt_banner" class="tab-pane fade">                               

                                <div class="col-lg-12">
                                    <div class="manage-banner">
                                        <?= $this->Form->create(false, array('type' => 'file', 'id' => 'advtBannerAdd')) ?>
                                        <p>Advertisement Banner</p>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 mg-top-15 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="select-banner-type-id">Select Banner Location
                                                        <?= $this->Form->select('select-banner-type-id', $bannerTypeList, ['class' => 'form-control', 'id' => 'select-banner-type-id']) ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label > Select Banner Image <span class="post-text">image size 768 x 90</span></label>
                                                    <input type="file" name="banner-pic-file" id="banner-pic-file" class="inputfile inputfile-2"  accept="image/*"/>
                                                    <label for="banner-pic-file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span class="file-name">Choose a banner...</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Provide Click URL
                                                        <input type="url" id="banner-url-id" class="form-control" name="banner-url-id">
                                                        <span class="input-icon"><i class="fa fa-link"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="existing_info">
                                                    <div class="existing_name">
                                                        <div class="form-group">
                                                            <label>Banner Image:
                                                                <input type="text"  readonly value="N/A" class="form-control existing_img_nm" id="txt-banner-image-url-id">
                                                                <a href="" target="_blank" class="input-icon" id="link-banner-image-url-id"><i class="fa fa-link"></i></a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="existing_url">
                                                        <div class="form-group">
                                                            <label>Click URL:
                                                                <input type="text"  readonly value="N/A" class="form-control link-click-url-id" id="txt-banner-click-url-id">
                                                                <a href="" target="_blank" class="input-icon" id="link-banner-click-url-id"><i class="fa fa-link">    </i></a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="button-set">
                                                        <button type="submit" class="button black_sm">Update</button>
                                                        <button type="button" class="white_back_btn" id="btn-banner-delete-id">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>




                            </div><!--End Advt Banner -->
                            <!--Start Manage User  --->
                            <div id="manage_user_tab" class="tab-pane fade in">

                                <div class="col-lg-12">
                                    <table id="manage_user" class="table table-striped table-bordered dt-responsive nowrap rtl-text-1 manage_user" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Subscriber Id</th>
                                                <th>Name</th>
                                                <th>Subscribed As</th>
                                                <th>Subscription Status</th>
                                                <th>Subscription Date</th>
                                                <th>Delete Subscriber?</th>
                                                <th class="hidden-subscribe-col">Is Subscribed</th>
                                                <th class="current-status-col">Current Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>

                            </div><!-- End Manage User -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

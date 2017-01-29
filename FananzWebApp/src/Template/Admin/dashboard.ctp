<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindPortfolioDto;
use Cake\View\Helper\HtmlHelper;

echo $this->element('header');

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
?>

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
                        <li class="active"><a id="manage_subscriber_tab" data-toggle="tab" href="#manage_user_tab" class="li-mg-right">Manage Subscribers</a></li>
                        <li><a id="category_add_tab" data-toggle="tab" href="#categ_add" class="li-mg-right">Manage Categories</a></li>
                        <li><a data-toggle="tab" href="#sub_catg_add" class="li-mg-right">Manage Subcategories</a></li>
                        <li><a data-toggle="tab" href="#advt_banner" >Advt Banners</a></li>

                    </ul>
                    <div class="row border-outer-admindash">
                        <div class="tab-content">
                            <div id="categ_add" class="tab-pane fade">
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
                                        <p>Home Page Bottom Banner</p>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 mg-top-15 col-md-6 col-sm-6">
                                                <?= $this->Form->select('select-banner-type-id', $bannerTypeList, ['class' => 'form-control', 'id' => 'select-banner-type-id']) ?>
                                                <div class="form-group">
                                                    <label >
                                                        <input type="file" name="banner-pic-file" id="banner-pic-file" class="inputfile inputfile-2"  accept="image/*"/>
                                                        <label for="banner-pic-file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span class="file-name">Choose a banner...</span></label>
                                                    </label>
                                                    <input type="url" id="banner-url-id" class="form-control" name="banner-url-id">
                                                    <span class="input-icon"><i class="fa fa-link"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="existing_info">
                                                    <div class="existing_name">
                                                        <span>Banner Image: </span>
                                                        <span class="existing_img_nm">N/A</span>
                                                    </div>
                                                    <div class="existing_url">
                                                        <span>Click URL: </span>
                                                        <a id="link-click-url-id" href="#" target="_blank">N/A</a>
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
                            <div id="manage_user_tab" class="tab-pane fade in active">

                                <div class="col-lg-12">
                                    <table id="manage_user" class="table table-striped table-bordered dt-responsive nowrap rtl-text-1 manage_user" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Subscriber Id</th>
                                                <th>Name</th>
                                                <th>Subscribed As</th>
                                                <th>Subscription Status</th>
                                                <th>Subscription Date</th>
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
<script>
    var oTable = null;

    $(document).ready(function () {
        var heading_last = $('table.table-bordered th:last-child').text();
        if (heading_last == 'Action') {
            $('th:last-child').removeClass('sorting');
        }

        $('.btn-on-hold-user').on('click', function () {
            alert('On hold button clicked');
        });
    });

    /**
     * On click of the manage subscriber tab will populate the records in the datatable.
     * 
     */
    $('#manage_subscriber_tab').on('click', function () {
        var pageNo = 1;
        var subscriberTable = $('#manage_user').DataTable({
            "jQueryUI": true,
            "paging": true,
            "sPaginationType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "searching": false,
            "aaSorting": [[1, "asc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 5,
            "deferRender": true,
            "ajax": "/FananzWebApp/admin/subscriberList",
            "columns": [
                {"data": "subscriberId"},
                {"data": "subscriberName"},
                {"data": "subscriptionType"},
                {"data": "subscriptionStatus"},
                {"data": "subscriptionDate"},
                {"data": "isSubscribed"},
                {"data": "currentStatusId"},
                {"data": "currentActionId"},
            ],
            "fnCreatedRow": function (row, data, index) {
                //Status change
                if (data['currentStatusId'] == 0) {
                    $('td:eq(-2)', row).replaceWith("<td><a>Inactive</a></td>");
                }
                else {
                    $('td:eq(-2)', row).replaceWith("<td><a>Active</a></td>");
                }
                //Action change
                if (data['currentActionId'] == 1) {

                    $('td:eq(-1)', row).replaceWith("<td><button type='button' class='btn btn-on-hold-user' onclick='clicked( 1, " + data['subscriberId'] + ")'>On hold</button></td>");
                }
                else if (data['currentActionId'] == 2) {
                    $('td:eq(-1)', row).replaceWith("<td><button type='button' class='btn btn-active-user' onclick='clicked(2, " + data['subscriberId'] + ")'>Active</button></td>");
                }
                else if (data['currentActionId'] == 3) {
                    $('td:eq(-1)', row).replaceWith("<td><button type='button' class='btn btn-bypss-user' onclick='clicked(3, " + data['subscriberId'] + ")'>Bypass Subscription</button></td>");
                }
            },
            "columnDefs": [
                {
                    "targets": "hidden-subscribe-col",
                    "visible": false
                }
            ],
            "destroy": true
        }); //end of data table

    });//end of on click

    /**
     * When the status button gets clicked, then this event gets fired
     * @param int statusId
     * @param int subscriberId
     * @returns void */
    function clicked(statusId, subscriberId) {
        $.ajax({
            url: '/FananzWebApp/subscribers/changeStatus',
            type: 'POST',
            data: {
                statusId: statusId,
                subscriberId: subscriberId
            },
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data) {
                    alert('Status Changed');
                }
            }
            ,
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Some error occurred');
            }
        });

    }

    /**
     * Add a new category
     * @param void param     
     * */
    $("#btn-cat-add").click(function () {
        var categoryName = $('#catg_name').val();
        //validate category
        if (categoryName == '') {
            alert('Category cannot be blank');
            return;
        }
        //Send ajax post to add category
        $.ajax({
            url: '/FananzWebApp/eventcategories/addNewCategory',
            type: 'POST',
            dataType: 'json',
            data: {
                categoryName: categoryName
            },
            success: function (data, textStatus, jqXHR) {
                alert(data.message);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });//end ajax
        //clear the text box
        $('#catg_name').val("");
    });

    /**
     * Update existing category
     */
    $('#btn-cat-update').click(function () {
        var categoryNameToUpdate = $('#catg_name_to_update').val();
        var selectedCategoryId = $("#select-cat-id option:selected").val();
        //alert(selectedCategoryId)
        //validate category id
        if (selectedCategoryId == 0) {
            alert('Please select a category to update');
            return;
        }
        //validate category
        if (categoryNameToUpdate == '') {
            alert('Category title cannot be blank');
            return;
        }

        $.ajax({
            url: '/FananzWebApp/eventcategories/updateCategory',
            type: 'POST',
            dataType: 'json',
            data: {
                selectedCategoryId: selectedCategoryId,
                categoryNameToUpdate: categoryNameToUpdate
            },
            success: function (data, textStatus, jqXHR) {
                alert(data.message);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        }); // ajax call
        //clear the text
        $("#catg_name_to_update").val("");
    });

//txt-subcat-name-add select-cat-subcat-add-id

    /**
     * Add a new subcategory
     */
    $("#btn-subcat-add").on('click', function () {
        var selectedCategoryId = $("#select-cat-subcat-add-id option:selected").val();
        var subcategoryName = $("#txt-subcat-name-add").val();
        //validate category id 
        if (selectedCategoryId == 0) {
            alert('Please select a category to add subcategory');
            return;
        }
        //validate sub category name
        if (subcategoryName == '') {
            alert('Sub category title cannot be blank');
            return;
        }
        //POST to ajax
        $.ajax({
            url: '/FananzWebApp/subcategories/addSubcategory',
            type: 'POST',
            dataType: 'json',
            data: {
                categoryId: selectedCategoryId,
                subCategoryName: subcategoryName
            },
            success: function (data, textStatus, jqXHR) {
                alert(data.message);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });// Ajax post

        //Clear the text box
        $("#txt-subcat-name-add").val("");
    });

    /**
     * When category changes then populate the sub category
     * @param void param     
     * */
    $("#select-cat-subcat-update-id").change(function () {
        var categoryId = $(this).find('option:selected').val();
        //clear the subcategory list first
        $('#select-subcat-update-id').empty();
        //Post ajax to bind the sub categories
        $.ajax({
            url: '/FananzWebApp/subcategories/getSubCategoryList/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                $.each(data, function (key, value) {
                    $('#select-subcat-update-id').append($('<option></option>').val(key).html(value));
                }); // each
            } // success
        }); // ajax
    });

    /**
     * Update the sub category for the selected category id
     */
    $("#btn-subcat-update").click(function () {
        var selectedSubCategoryId = $("#select-subcat-update-id option:selected").val();
        var subcategoryName = $("#txt-subcat-update").val();
        //validate category id 
        if (selectedSubCategoryId == 0) {
            swal({
                title: "Alert",
                text: "Please select a sub category to update the title",
                timer: 2000,
                showConfirmButton: false
            });
            //alert('Please select a category to add subcategory');
            return;
        }
        //validate sub category name
        if (subcategoryName == '') {
            swal({
                title: "Alert",
                text: "Please provide a title to update",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        $.ajax({
            url: '/FananzWebApp/subcategories/updateSubcategory',
            type: 'POST',
            dataType: 'json',
            data: {
                subCategoryId: selectedSubCategoryId,
                subCategoryName: subcategoryName
            },
            success: function (data, textStatus, jqXHR) {
                swal("Update !", data.message, "success");
            }
        });
        //Clear the text box
        $("#txt-subcat-update").val("");
    });

    /**
     * Add or update the advt banner 
     * @param void param 
     * */
    $("#advtBannerAdd").submit(function (e) {
        e.preventDefault();

        var bannerUrl = $("#banner-url-id").val();
        var bannerFileImageUrl = $('#banner-pic-file').prop('files')[0];
        var bannerLocation = $('#select-banner-type-id option:selected').val();
        var selectedFile = $("#banner-pic-file").val();

        //Validate details
        if (bannerLocation == -1) {
            swal({
                title: "Alert",
                text: "Please select a banner location",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        if (selectedFile == '') {
            swal({
                title: "Alert",
                text: "Please select a banner image file",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        //Prepare the details to post
        var formData = new FormData();
        formData.append('banner-pic-file', bannerFileImageUrl);
        formData.append('banner-url', bannerUrl);
        formData.append('banner-location', bannerLocation);

        $.ajax({
            url: '/FananzWebApp/advtbanner/addNewAdvtBanner',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'text json',
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    swal("Advt Banner Upload !", data.message, "success");
                    getBannerDetails();
                } else {
                    swal("Advt Banner Upload !", data.message, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });

        //TODO: clean up the file and text box
        $("#banner-pic-file").val("");
        $("#banner-url-id").val("");
    });

    /**
     * Get dynamic values for selected banner location
     */
    $("#select-banner-type-id").change(getBannerDetails);

    /**
     * Gets banner details for selected banner type
     * @returns void */
    function getBannerDetails() {
        var bannerLocation = $("#select-banner-type-id").find('option:selected').val();

        $.ajax({
            url: '/FananzWebApp/advtbanner/bannerDetails/' + bannerLocation,
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    var bannerDetails = JSON.parse(data.data);
                    //alert(bannerDetails.imageUrl);
                    $(".existing_img_nm").html(bannerDetails.imageUrl);
                    $("#link-click-url-id").html(bannerDetails.clickUrl);
                    $("#link-click-url-id").attr('href', bannerDetails.clickUrl);
                }
                else {
                    $(".existing_img_nm").html("N/A");
                    $("#link-click-url-id").html("N/A");
                    $("#link-click-url-id").attr('href', '#');
                }
            }
        }); // ajax
    }
    
    /**
     * Deleting an existing banner by selecting the banner location
     */
    $("#btn-banner-delete-id").click(function () {
        var bannerLocation = $('#select-banner-type-id option:selected').val();
        //Validate details
        if (bannerLocation == -1) {
            swal({
                title: "Alert",
                text: "Please select a banner location",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        $.ajax({
            url: '/FananzWebApp/advtbanner/deleteBanner',
            type: 'POST',
            dataType: 'json',
            data: {
                bannerLocation: bannerLocation
            },
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    swal("Advt Banner Deletion!", data.message, "success");
                    //Clean up
                    $(".existing_img_nm").html("N/A");
                    $("#link-click-url-id").html("N/A");
                    $("#link-click-url-id").attr('href', '#');
                } else {
                    swal("Advt Banner Deletion!", data.message, "error");
                }
            }
        }); // ajax
    });

</script>
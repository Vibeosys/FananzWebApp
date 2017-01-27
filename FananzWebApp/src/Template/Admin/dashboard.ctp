<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindPortfolioDto;
use Cake\View\Helper\HtmlHelper;

//$this->layout = 'home_layout';
//$this->layout = 'header';
echo $this->element('header');


echo $this->Html->css('/css/design/jquery.dataTables.min.css', ['block' => true]);
echo $this->Html->css('/css/design/responsive.bootstrap.min.css', ['block' => true]);
//echo $this->Html->css('design/nouislider.css');
//echo $this->Html->css('design/responsiveslides.css');
echo $this->Html->script('/js/jquery.custom-file-input.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/bootstrap-fileupload.js', ['block' => 'scriptTop']);

echo $this->Html->script('/js/datatables/jquery.dataTables.min.js', ['block' => true]);
echo $this->Html->script('/js/datatables/dataTables.bootstrap.js', ['block' => true]);
echo $this->Html->script('/js/datatables/dataTables.responsive.min.js', ['block' => true]);
echo $this->Html->script('/js/datatables/responsive.bootstrap.min.js', ['block' => true]);
//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css
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
                        <li><a data-toggle="tab" href="#categ_add" class="li-mg-right">Manage Category</a></li>
                        <li><a data-toggle="tab" href="#sub_catg_add" class="li-mg-right">Manage Sub Category</a></li>
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
                                                    <button type="submit" title="Submit" class="button black_sm">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="update-catg">
                                        <p>Update/Delete Category</p>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="activity">Category
                                                    <select id="category" class="form-control" >
                                                        <option value="Select Activity">Select Category</option>
                                                        <option value="Artists"><span>Artists</span></option>
                                                        <option value="Media"><span>Media</span></option>
                                                        <option value="Event Ficilities">Event Facilities</option>
                                                        <option value="Model">Model</option>
                                                        <option value="Birthday">Birthday</option>
                                                        <option value="Night Life">Night Life</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
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
                                                    <button type="submit" title="Submit" class="button black_sm">Update</button>
                                                    <button type="submit" title="Submit" class="white_back_btn">Delete</button>
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
                                                <label for="activity">Category
                                                    <select id="category" class="form-control" >
                                                        <option value="Select Activity">Select Category</option>
                                                        <option value="Artists"><span>Artists</span></option>
                                                        <option value="Media"><span>Media</span></option>
                                                        <option value="Event Ficilities">Event Facilities</option>
                                                        <option value="Model">Model</option>
                                                        <option value="Birthday">Birthday</option>
                                                        <option value="Night Life">Night Life</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="first_name">Sub Category
                                                    <input type="text" id="first_name" class="form-control" name="fname">
                                                    <span class="input-icon"><i class="fa fa-object-ungroup"></i></span>
                                                </label>
                                            </div>
                                        </div>



                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="button-set">
                                                    <button type="submit" title="Submit" class="button black_sm">Add</button>
                                                    <!--                                           <a href="index.html" class="white_back_btn">Back</a>     -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="update-sub-catg">
                                        <p>Update/Delete Sub Category</p>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="activity">Category
                                                    <select id="category" class="form-control" >
                                                        <option value="Select Activity">Select Category</option>
                                                        <option value="Artists"><span>Artists</span></option>
                                                        <option value="Media"><span>Media</span></option>
                                                        <option value="Event Ficilities">Event Facilities</option>
                                                        <option value="Model">Model</option>
                                                        <option value="Birthday">Birthday</option>
                                                        <option value="Night Life">Night Life</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="first_name">Sub Category
                                                    <select id="category" class="form-control" >
                                                        <option value="Select Activity">Select Sub Category</option>
                                                        <option value="Artists"><span>Singer</span></option>
                                                        <option value="Media"><span>Musician</span></option>
                                                        <option value="Event Ficilities">Belly Dancer</option>
                                                        <option value="Model">Band</option>
                                                        <option value="Birthday">Music Arranger</option>
                                                        <option value="Night Life">Voice Over</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="first_name">Update Sub Category
                                                    <input type="text" id="first_name" class="form-control" name="fname">
                                                    <span class="input-icon"><i class="fa fa-object-group"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="button-set">
                                                    <button type="submit" title="Submit" class="button black_sm">Update</button>
                                                    <button type="submit" title="Submit" class="white_back_btn">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="advt_banner" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="manage-banner">
                                        <p>Home Page Top Banner</p>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 mg-top-25 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label >
                                                        <input type="file" name="banner-home-top" id="banner-home-top" class="inputfile inputfile-2"  accept="image/*"/>
                                                        <label for="banner-home-top"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span class="file-name">Choose a banner...</span></label>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <div class="button-set">
                                                        <button type="submit" title="Submit" class="button black_sm">Update</button>
                                                        <button type="submit" title="Submit" class="white_back_btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="manage-banner">
                                        <p>Home Page Bottom Banner</p>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 mg-top-25 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label >
                                                        <input type="file" name="advt_banner" id="banner-home-bottom" class="inputfile inputfile-2"  accept="image/*"/>
                                                        <label for="banner-home-bottom"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span class="file-name">Choose a banner...</span></label>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <div class="button-set">
                                                        <button type="submit" title="Submit" class="button black_sm">Update</button>
                                                        <button type="submit" title="Submit" class="white_back_btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="manage-banner">
                                        <p>Category Page Top Banner</p>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 mg-top-25 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label >
                                                        <input type="file" name="advt_banner" id="banner-catg-top" class="inputfile inputfile-2"  accept="image/*"/>
                                                        <label for="banner-catg-top"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span class="file-name">Choose a banner...</span></label>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <div class="button-set">
                                                        <button type="submit" title="Submit" class="button black_sm">Update</button>
                                                        <button type="submit" title="Submit" class="white_back_btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="manage-banner">
                                        <p>Category Page Bottom Banner</p>
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 mg-top-25 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label >
                                                        <input type="file" name="advt_banner" id="banner-catg-bottom" class="inputfile inputfile-2"  accept="image/*"/>
                                                        <label for="banner-catg-bottom"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span class="file-name">Choose a banner...</span></label>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <div class="button-set">
                                                        <button type="submit" title="Submit" class="button black_sm">Update</button>
                                                        <button type="submit" title="Submit" class="white_back_btn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    var subscriberTable = null;
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

    function clicked(statusId, subscriberId) {
        $.ajax({
            url         : '/FananzWebApp/subscribers/changeStatus',
            type      : 'POST',
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



</script>
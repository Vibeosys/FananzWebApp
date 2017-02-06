/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var oTable = null;

$(document).ready(function () {
    var heading_last = $('table.table-bordered th:last-child').text();
    if (heading_last == 'Action') {
        $('th:last-child').removeClass('sorting');
    }

    $('.btn-on-hold-user').on('click', function () {
        swal("Info !", "On hold button clicked", "info");
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
            "responsive": true,
            "sPaginationType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "searching": false,
            "aaSorting": [[1, "asc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 5,
            "deferRender": true,
            "ajax": WEBSITE_VIRTUAL_DIR_NAME + "/admin/subscriberList",
            "columns": [
                {"data": "subscriberId"},
                {"data": "subscriberName"},
                {"data": "subscriptionType"},
                {"data": "subscriptionStatus"},
                {"data": "subscriptionDate"},
                {"data": "deleteSubscriber"},
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

                $('td:eq(-3)', row).replaceWith("<td><button type='button' class='btn btn-on-hold-user' onclick='deleteSubscriber(" + data['subscriberId'] + ")' >Delete</button></td>");

                //Corporate 1
                if (data['subscriptionType'] == "1") {
                    $('td:eq(-6)', row).replaceWith("<td>Corporate</td>");
                }
                else if (data['subscriptionType'] == "2") {
                    $('td:eq(-6)', row).replaceWith("<td>Freelance</td>");
                }

                $('td:eq(-7)', row).replaceWith("<td><a href='" + WEBSITE_VIRTUAL_DIR_NAME + "/subscribers/portfolio/" + data['subscriberId'] + "/" + data['subscriptionType'] + "'>" + data['subscriberName'] + "</a></td>")

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
     * Add a new category
     * @param void param     
     * */
    $("#btn-cat-add").click(function () {
        var categoryName = $('#catg_name').val();
        //validate category
        if (categoryName == '') {
            //alert('Category cannot be blank');
            swal("Info !", "Category cannot be blank", "error");
            return;
        }
        //Send ajax post to add category
        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/eventcategories/addNewCategory',
            type: 'POST',
            dataType: 'json',
            data: {
                categoryName: categoryName
            },
            beforeSend: function () {
                $('.loading-img').show();
            },
            complete: function () {
                $('.loading-img').hide();
            },
            success: function (data, textStatus, jqXHR) {
                swal("Info !", data.message, "success");
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
            swal("Info !", "Please select a category to update", "error");

            return;
        }
        //validate category
        if (categoryNameToUpdate == '') {
            swal("Info !", "Category title cannot be blank", "error");
            return;
        }

        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/eventcategories/updateCategory',
            type: 'POST',
            dataType: 'json',
            data: {
                selectedCategoryId: selectedCategoryId,
                categoryNameToUpdate: categoryNameToUpdate
            },
            beforeSend: function () {
                $('.loading-img').show();
            },
            complete: function () {
                $('.loading-img').hide();
            },
            success: function (data, textStatus, jqXHR) {
                // swal("Info !", data.message, "success");
                swal({
                    title: "Info !",
                    text: data.message,
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: "#AEDEF4",
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                //    $('#select-cat-id').ajax.reload();
                            }
                        });
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
            swal("Info!", "Please select a category to add subcategory", "error");
            return;
        }
        //validate sub category name
        if (subcategoryName == '') {
            swal("Info !", "Sub category title cannot be blank", "error");
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
            beforeSend: function () {
                $('.loading-img').show();
            },
            complete: function () {
                $('.loading-img').hide();
            },
            success: function (data, textStatus, jqXHR) {
                swal("Info !", data.message, "success");
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
            url: WEBSITE_VIRTUAL_DIR_NAME + '/subcategories/getSubCategoryList/' + categoryId,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('.loading-img').show();
            },
            complete: function () {
                $('.loading-img').hide();
            },
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
            url: WEBSITE_VIRTUAL_DIR_NAME + '/subcategories/updateSubcategory',
            type: 'POST',
            dataType: 'json',
            data: {
                subCategoryId: selectedSubCategoryId,
                subCategoryName: subcategoryName
            },
            beforeSend: function () {
                $('.loading-img').show();
            },
            complete: function () {
                $('.loading-img').hide();
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
            url: WEBSITE_VIRTUAL_DIR_NAME + '/advtbanner/addNewAdvtBanner',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'text json',
            beforeSend: function () {
                $('.loading-img').show();
            },
            complete: function () {
                $('.loading-img').hide();
            },
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
            url: WEBSITE_VIRTUAL_DIR_NAME + '/advtbanner/deleteBanner',
            type: 'POST',
            dataType: 'json',
            data: {
                bannerLocation: bannerLocation
            },
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    swal("Advt Banner Deletion!", data.message, "success");
                    //Clean up
                    $("#txt-banner-image-url-id").val('N/A');
                    $("#link-banner-image-url-id").attr('href', '#');
                    $("#txt-banner-click-url-id").val('N/A');
                    $("#link-banner-click-url-id").attr('href', '#');
                    $('#banner-url-id').val('');
                } else {
                    swal("Advt Banner Deletion!", data.message, "error");
                }
            }
        }); // ajax
    });

});// document ready

/**
 * When the status button gets clicked, then this event gets fired
 * @param int statusId
 * @param int subscriberId
 * @returns void */
function clicked(statusId, subscriberId) {
    $.ajax({
        url: WEBSITE_VIRTUAL_DIR_NAME + '/subscribers/changeStatus',
        type: 'POST',
        data: {
            statusId: statusId,
            subscriberId: subscriberId
        },
        dataType: 'json',
        beforeSend: function () {
            $('.loading-img').show();
        },
        complete: function () {
            $('.loading-img').hide();
        },
        success: function (data, textStatus, jqXHR) {
            if (data) {
                // swal("Info !", "Status Changed", "error");
                swal({
                    title: "Info !",
                    text: "Status Changed",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: "#AEDEF4",
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('#manage_user').DataTable().ajax.reload();
                            }
                        });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            swal("Info !", "Some error occurred", "error");
        }
    });

}

function deleteSubscriber(subscriberId) {
    swal({
        title: "Are you sure?",
        text: "Are you sure, you want to delete the subscriber?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
    function () {
        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/subscribers/deleteSubscriber/' + subscriberId,
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data) {
                    swal("Deleted!", "Subscriber is deleted.", "success");
                }
                else {
                    swal("Deleted!", "Subscriber is not deleted.", "error");
                }
            }
        });

    });
}

/**
 * Gets banner details for selected banner type
 * @returns void */
function getBannerDetails() {
    var bannerLocation = $("#select-banner-type-id").find('option:selected').val();

    $("#txt-banner-image-url-id").val('N/A');
    $("#link-banner-image-url-id").attr('href', '#');
    $("#txt-banner-click-url-id").val('N/A');
    $("#link-banner-click-url-id").attr('href', '#');
    $('#banner-url-id').val('');

    $.ajax({
        url: WEBSITE_VIRTUAL_DIR_NAME + '/advtbanner/bannerDetails/' + bannerLocation,
        type: 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.errorCode == 0) {
                var bannerDetails = JSON.parse(data.data);
                //alert(bannerDetails.imageUrl);
                $("#txt-banner-image-url-id").val(bannerDetails.imageUrl);
                $("#link-banner-image-url-id").attr('href', bannerDetails.imageUrl);
                $("#txt-banner-click-url-id").val(bannerDetails.clickUrl);
                $("#link-banner-click-url-id").attr('href', bannerDetails.clickUrl);

            }
        }
    }); // ajax
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('.file').preimage();

    /**
     * Replace button functionality for photo
     */
    $('.photo-edit-btn').click(function (e) {
        e.preventDefault();
        var edit_id = $(this).parent().parent().parent().parents('.portfolio-file').find('.file').attr('id');

        $('#' + edit_id).trigger('click');

    });

    /**
     * Photo delete functionality 
     */
    $('.photo-delete-btn').click(function (e) {
        //TODO: body loading image
        e.preventDefault();
        var delete_id = $(this).parent().parent().parent().parents('.portfolio-file').find('.preview').attr('id');
        var prev_file_length = 'prev_file'.length;
        var photoId = delete_id.substr(prev_file_length);
        //TODO: inactivate image
        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/portfoliophotos/webDeletePhoto/' + photoId,
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    var val1 = $('#' + delete_id).find('.prev_thumb').attr('src', '/FananzWebApp/img/demoUpload.jpg');
                    var cln = $('#' + delete_id).val('');
                } else {
                    swal('Error', data.message, 'error');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });

        //var val1 = $('#' + delete_id).find('.prev_thumb').attr('src', '/FananzWebApp/img/demoUpload.jpg');
        //var cln = $('#' + delete_id).val('');
    });



    /**
     * When category changes then populate the sub category
     * @param void param     
     * */
    $("#select-cat-id").change(function () {
        var categoryId = $(this).find('option:selected').val();
        //clear the subcategory list first
        $('#select-subcat-id').empty();
        //Post ajax to bind the sub categories
        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/subcategories/getSubCategoryList/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                $.each(data, function (key, value) {
                    $('#select-subcat-id').append($('<option></option>').val(key).html(value));
                }); // each
            } // success
        }); // ajax
    });
});
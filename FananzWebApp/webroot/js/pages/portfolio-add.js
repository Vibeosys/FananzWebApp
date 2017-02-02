/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('.file').preimage();

    $('.photo-edit-btn').click(function (e) {
        e.preventDefault();
        var edit_id = $(this).parent().parent().parent().parents('.portfolio-file').find('.file').attr('id');

        $('#' + edit_id).trigger('click');

    });

    $('.photo-delete-btn').click(function (e) {
        e.preventDefault();
        var delete_id = $(this).parent().parent().parent().parents('.portfolio-file').find('.preview').attr('id');
        var val1 = $('#' + delete_id).find('.prev_thumb').attr('src', '../img/demoUpload.jpg');
        var cln = $('#' + delete_id).val('');
    });

});

/**
 * When category changes then populate the sub category
 * @param void param     
 * */
$(document).ready(function () {
    $("#select-cat-id").change(function () {
        var categoryId = $(this).find('option:selected').val();
        //clear the subcategory list first
        $('#select-subcat-id').empty();
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
                    $('#select-subcat-id').append($('<option></option>').val(key).html(value));
                }); // each
            } // success
        }); // ajax
    });
});
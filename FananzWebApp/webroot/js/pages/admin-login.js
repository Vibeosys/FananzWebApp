/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $("#frmForgotPassword").submit(function (e) {
        e.preventDefault();

        var emailId = $('#forgot_email').val();
        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/admin/forgotPass',
            type: 'POST',
            dataType: 'json',
            data: {
                emailId: emailId
            },
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode === 0) {
                    swal("Email sent!", data.message, "success");
                } else {
                    swal("Error occurred!", data.message, "error");
                }
            }
        });//end of ajax
    });
});
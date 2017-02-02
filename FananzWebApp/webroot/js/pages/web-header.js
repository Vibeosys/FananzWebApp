/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#special_request').on('click', function () {
    formValidation();
    //alert('I am here');
    var name = $('#name').val();
    var email = $('#email').val();
    var mobNo = $('#mobNo').val();
    var yourRequest = $('#spec_msg').val();

    $.ajax({
        url: '/FananzWebApp/HomePage/specialRequest',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name,
            email: email,
            mobNo: mobNo,
            yourRequest: yourRequest
        },
        success: function (result, jqXHR) {
            if (result)
            {
                swal('Special request', 'Email has been sent, we will contact you soon', 'success');
                //alert('done');
            }
        }

    });
});
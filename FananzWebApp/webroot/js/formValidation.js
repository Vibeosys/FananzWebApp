

//$(document).ready(function () {

function formValidation() {

    //  alert('here');
    var name = $('.valid_name').val();
    var lastName = $('.valid_last_name').val();
    var password = $('.valid_password').val();
    //  alert('come here');
    var email = $('.valid_email').val();
    var mobNo = $('.valid_mobNo').val();
    var yourRequest = $('.valid_spec_msg').val();
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
    var name_pattern = /^[a-zA-Z]+$/
    if (name === '') {
        $('.valid_Name_msg').css('display', 'inline-block');
    }
    else {
        $('.valid_Name_msg').hide();

        if (!name_pattern.test(name)) {

            $('.valid_name_ptn').css('display', 'inline-block');
        } else {
            $('.valid_name_ptn').hide();

        }
    }
    if (email === '') {
        $('.valid_Email_msg').css('display', 'inline-block');
    }
    else {
        $('.valid_Email_msg').hide();

        if (!pattern.test(email)) {
            $('.valid_Email_ptn').css('display', 'inline-block');
        }
        else {
            $('.valid_Email_ptn').hide();
        }
    }
    if (mobNo === '') {
        $('.valid_mobNo_msg').css('display', 'inline-block');
    }
    else {
        $('.valid_mobNo_msg').hide();
    }
    if (yourRequest === '') {
        $('.valid_req_msg').css('display', 'inline-block');
    }
    else {
        $('.valid_req_msg').hide();
    }

    if (lastName === '') {
        $('.valid_lastName_msg').css('display', 'inline-block');
    }
    else {
        $('.valid_lastName_msg').hide();
    }

    if (password === '') {
        $('.valid_pass_msg').css('display', 'inline-block');
    }
    else {
        $('.valid_pass_msg').hide();
    }
}
//});
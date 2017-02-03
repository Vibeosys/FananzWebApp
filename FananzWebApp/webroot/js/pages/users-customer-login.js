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
            url: WEBSITE_VIRTUAL_DIR_NAME + '/users/customerForgotPassword',
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
//for facebook integration

function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        facebookLogin();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
                'into Facebook.';
    }
}
// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.login(function (response) {
        console.log(response);
        statusChangeCallback(response);
    }, {scope: 'public_profile,email'});
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '369015673462835',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.8', // use graph api version 2.8
        oauth: true,
        status: true // check login status
    });

    FB.getLoginStatus(function (response) {
        // statusChangeCallback(response);

        if (response.status === 'connected') {
            //statusChangeCallback(response);
            console.log(response.authResponse.accessToken);
        }
    });
};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function facebookLogin() {
    FB.api('/me?fields=id,name,email', function (response) {
        name = response.name;
        user_email = response.email;
        id = response.id;

        $.ajax({
            url: WEBSITE_VIRTUAL_DIR_NAME + '/users/loginWithFacebook',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                user_email: user_email,
                id: id
            },
            success: function (data, textStatus, jqXHR) {
                window.location = WEBSITE_VIRTUAL_DIR_NAME + '/ ';
            }
        });//end of ajax

    });
}
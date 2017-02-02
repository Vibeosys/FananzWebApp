/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Request service to open popup and show details.
 * @param {type} portfolioId
 * @param {type} subscriberName
 * @returns {undefined}
 */
function requestService(portfolioId, subscriberName) {
    $("#request-service-sub-id").html('Request services for ' + subscriberName);
    $("#hdnRsPortfolioId").val(portfolioId);
    //Check login first
    $.ajax({
        url: WEBSITE_VIRTUAL_DIR_NAME + '/users/isUserLoggedIn',
        type: 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            //If user is not logged in then send him to login
            if (!data) {
                window.location = WEBSITE_VIRTUAL_DIR_NAME + '/users/customerlogin ';
            }
            else {
                $('#service_request_div-id').modal('show');
            }
        }
    });
}

//$('#portfolio_txt').on('click', function () {
function submitRequest() {
    var portfolioMag = $('#portfolio_msg').val();
    var portfolioId = $("#hdnRsPortfolioId").val();

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: WEBSITE_VIRTUAL_DIR_NAME + '/HomePage/sendPortfolioRequest',
        data: {
            portfolioId: portfolioId,
            portfolioMag: portfolioMag
        },
        success: function (data, textStatus, jqXHR) {
            if (data.errorCode == 0) {
                swal('Service requested', data.message, 'success');
            }
        }

    });
}
//});
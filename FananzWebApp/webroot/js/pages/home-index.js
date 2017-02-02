/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(window).load(function () {
    $("#flexiselDemo1").flexisel({
        visibleItems: 4,
        animationSpeed: 1000,
        autoPlay: false,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 768,
                visibleItems: 3
            }
        }
    });

});

/**
 * Portfolio request to be sent to stakeholders
 * @param {type} param1
 * @param {type} param2
 */
$('.home_portfolio_request').on('click', function () {
    var portfolioId = $(this).attr('id');

    $('#portfolio_txt').on('click', function () {
        var portfolioMag = $('#portfolio_msg').val();
        formValidation();
        
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: '/FananzWebApp/HomePage/sendPortfolioRequest',
            data: {
                portfolioId: portfolioId,
                portfolioMag: portfolioMag
            },
            success: function (data, textStatus, jqXHR) {
                if (data.errorCode == 0) {
                    swal('Service requested', data.message, 'success');
                }
                else {
                    window.location = '/FananzWebApp/users/customerlogin ';
                }
            }

        });
    });

});

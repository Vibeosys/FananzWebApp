/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(window).load(function () {
    $("#slider1").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
    });

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
 * Shows portfolio details of the provided portfolio and opens up modal dialog
 * @param {type} input
 * @param {type} handle
 * @returns {undefined}
 */
function showDetails(portfolioId) {
    //alert(portfolioId);
    $.ajax({
        url: WEBSITE_VIRTUAL_DIR_NAME + '/portfolio/details',
        type: 'POST',
        dataType: 'json',
        data: {
            portfolioId: portfolioId
        },
        success: function (data, textStatus, jqXHR) {
            if (data.errorCode != 0) {
                swal('Info', data.message, 'error');
                return;
            }
            var portfolioData = JSON.parse(data.data);
            $("#portfolio-header-id").html("Portfolio of " + portfolioData.subscriberName);
            $("#portfolio-title-id").html(portfolioData.subscriberName);
            $("#portfolio-price-range-id").html(portfolioData.minPrice + " - " + portfolioData.maxPrice);
            if (portfolioData.subCategory != null) {
                $("#portfolio-cat-id").html(portfolioData.category + " - " + portfolioData.subCategory);
            } else {
                $("#portfolio-cat-id").html(portfolioData.category);
            }
            if (portfolioData.fbLink != null) {
                $("#txtFbId").val(portfolioData.fbLink);
                $("#link-portfolio-fb").attr('href', portfolioData.fbLink);
            }
            if (portfolioData.youtubeLink != null) {
                $("#txtYtubeId").val(portfolioData.youtubeLink);
                $("#link-portfolio-yt").attr('href', portfolioData.youtubeLink);
            }
            $("#portfolio-desc-id").html(portfolioData.aboutUs);
            if (portfolioData.photos != null) {
                var liList = '';
                $.each(portfolioData.photos, function (id, obj) {
                    //alert(obj);
                    liList += "<li><div class='img-slider-list' style='background-image:url("+obj+");'></div></li>";
                });
                //alert(liList);
                $("#slider1").html(liList);
            }// if data photos not null
            else {
                $("#slider1").html("<li><img src='/img/default_img.jpg'></li>");
            }
            $('#detail_artists').modal('show');
            $("#slider1").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                maxwidth: 800,
                namespace: "centered-btns"
            });
           
        },
    });
}
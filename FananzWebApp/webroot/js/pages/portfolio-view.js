/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function shareToFacebook() {
    FB.ui(
            {
                method: 'share',
                href: 'http://www.vibeosys.com'
            }, function (response) {
        //alert(response);
    });
}

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
                    liList += "<li><img src='" + obj + "'></li>";
                });
                //alert(liList);
                $("#slider1").html(liList);
            }// if data photos not null
            else {
                $("#slider1").html("<li><img src='/FananzWebApp/img/default_img.jpg'></li>");
            }
            $("#slider1").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                maxwidth: 800,
                namespace: "centered-btns"
            });
            $('#detail_artists').modal('show');
        },
    });
}

$(document).ready(function () {
    /**
     * Submit button click of the filters for portfolio list
     * @param {type} param1
     * @param {type} param2
     */
    $('#submitFiler').on('click', function () {
        var sortById = $('#short_select').val();
        var minPrice = $('#txtMinPrice').val();
        var maxPrice = $('#txtMaxPrice').val();
        var categoryId = $('#categoryId').val();
        var subCategoryId = $('#subCategoryId').val();

        $.ajax({
            type: 'POST',
            url: WEBSITE_VIRTUAL_DIR_NAME + '/portfolio/filteredPortfolios',
            data: {
                sortById: sortById,
                categoryId: categoryId,
                subCategoryId: subCategoryId,
                minPrice: minPrice,
                maxPrice: maxPrice
            },
            dataType: 'json',
            success: function (result, jqXHR) {
                if (result)
                {
                    var portfolioHtml = "";
                    // alert(result.toString());
                    $.each(result, function (idx, obj)
                    {
                        var subCategory = obj.subcategory;

                        var category = obj.category;
                        var concatinatedString = ''
                        if (subCategory != "")
                        {
                            concatinatedString = category + '-' + subCategory;
                        }
                        else
                        {
                            concatinatedString = category;
                        }
                        var imageUrl = "";

                        if (obj.coverImageUrl != null)
                        {
                            imageUrl = obj.coverImageUrl;
                        }
                        else
                        {
                            imageUrl = WEBSITE_VIRTUAL_DIR_NAME + '/img/default_img.jpg';
                        }
                        portfolioHtml += '<li id="portfolioLi"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="layout-figure"> <div class="figure-img"><img class="img-responsive" src="' + imageUrl + '"> </div><div class="figure-caption"><div class="artist-name"><h3>' + obj.subscriberName + '</h3></div><div class="artist-cat"><h4>' + concatinatedString + '</h4></div><div class="artist-price"><div class="price-text"><span>Price</span></div><div class="price">AED<span>' + obj.minPrice + ' -' + obj.maxPrice + '</span></div></div><div class="cate-link"> <div class="detail-artists"><a href="#detail_artists" data-toggle="modal">Details</a>  </div> <div class="request-artists"><a href="#request_artists" data-toggle="modal">Request Now</a> </div>          </div></div></div></div> </li>';
                    });

                    var startPaginator = '<div class="container"><div class="row"><div class="col-lg-12"><div class="pagination-inner"><label>Show:</label><select id="Itemsperpage"><option  selected="selected">9</option><option>15</option><option>21</option></select></div></div></div></div>';
                    $('#paginationStart').html(startPaginator);
                    $('#portfolioUl').html(portfolioHtml);

                    var paginator = '<div class="pg-bottom"> <div class="total-page"><p id="legend1"></p></div><div class="page-holder"><div class="holder"></div></div></div>';
                    $('$paginator_last').html(paginator);
                }
            }
        });

    });

    /**
     * Portfolio list filters
     * @param {type} param1
     * @param {type} param2
     */
    $('#short_select').on('change', function () {
        var sortById = $('#short_select').val();
        var categoryId = $('#categoryId').val();
        var subCategoryId = $('#subCategoryId').val();
        var minPrice = $('#txtMinPrice').val();
        var maxPrice = $('#txtMaxPrice').val();

        $.ajax({
            type: 'POST',
            url: WEBSITE_VIRTUAL_DIR_NAME + '/portfolio/filteredPortfolios',
            data: {
                sortById: sortById,
                categoryId: categoryId,
                subCategoryId: subCategoryId,
                minPrice: minPrice,
                maxPrice: maxPrice
            },
            dataType: 'json',
            success: function (result, jqXHR) {
                if (result)
                {
                    var portfolioHtml = "";
                    // alert(result.toString());
                    $.each(result, function (idx, obj)
                    {
                        var subCategory = obj.subcategory;
                        var category = obj.category;
                        var concatinatedString = ''
                        if (subCategory != "")
                        {
                            concatinatedString = category + '-' + subCategory;
                        }
                        else
                        {
                            concatinatedString = category;
                        }
                        var imageUrl = "";

                        if (obj.coverImageUrl != null)
                        {
                            imageUrl = obj.coverImageUrl;
                        }
                        else
                        {
                            imageUrl = WEBSITE_VIRTUAL_DIR_NAME + '/img/default_img.jpg';
                        }
                        portfolioHtml += '<li id="portfolioLi"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="layout-figure"> <div class="figure-img"><img class="img-responsive" src="' + imageUrl + '"> </div><div class="figure-caption"><div class="artist-name"><h3>' + obj.subscriberName + '</h3></div><div class="artist-cat"><h4>' + concatinatedString + '</h4></div><div class="artist-price"><div class="price-text"><span>Price</span></div><div class="price">AED<span>' + obj.minPrice + ' -' + obj.maxPrice + '</span></div></div><div class="cate-link"> <div class="detail-artists"><a href="#detail_artists" data-toggle="modal">Details</a>  </div> <div class="request-artists"><a href="#request_artists" data-toggle="modal">Request Now</a> </div>          </div></div></div></div> </li>';
                    });

                    var startPaginator = '<div class="container"><div class="row"><div class="col-lg-12"><div class="pagination-inner"><label>Show:</label><select id="Itemsperpage"><option  selected="selected">9</option><option>15</option><option>21</option></select></div></div></div></div>';

                    $('#paginationStart').html(startPaginator);
                    $('#portfolioUl').html(portfolioHtml);

                    var paginator = '<div class="pg-bottom"> <div class="total-page"><p id="legend1"></p></div><div class="page-holder"><div class="holder"></div></div></div>';
                    $('$paginator_last').html(paginator);
                }
            }
        });
    });

    /*****
     * Slider functionality
     * @type @exp;document@call;getElementById
     */
    var keypressSlider = document.getElementById('keypress');
    var input0 = document.getElementById('txtMinPrice');
    var input1 = document.getElementById('txtMaxPrice');
    var inputs = [input0, input1];

    noUiSlider.create(keypressSlider, {
        start: [1000, 6000],
        connect: true,
        //direction: 'rtl',
        tooltips: [true, wNumb({decimals: 0, thousand: ','})],
        range: {
            'min': 1000,
            'max': 10000
        }
    });

    keypressSlider.noUiSlider.on('update', function (values, handle) {
        inputs[handle].value = values[handle];
    });

    function setSliderHandle(i, value) {
        var r = [null, null];
        r[i] = value;
        keypressSlider.noUiSlider.set(r);
    }

// Listen to keydown events on the input field.
    inputs.forEach(function (input, handle) {

        input.addEventListener('change', function () {
            setSliderHandle(handle, this.value);
        });

        input.addEventListener('keydown', function (e) {

            var values = keypressSlider.noUiSlider.get();
            var value = Number(values[handle]);

            // [[handle0_down, handle0_up], [handle1_down, handle1_up]]
            var steps = keypressSlider.noUiSlider.steps();

            // [down, up]
            var step = steps[handle];

            var position;

            // 13 is enter,
            // 38 is key up,
            // 40 is key down.
            switch (e.which) {

                case 13:
                    setSliderHandle(handle, this.value);
                    break;

                case 38:

                    // Get step to go increase slider value (up)
                    position = step[1];

                    // false = no step is set
                    if (position === false) {
                        position = 1;
                    }

                    // null = edge of slider
                    if (position !== null) {
                        setSliderHandle(handle, value + position);
                    }

                    break;

                case 40:

                    position = step[0];

                    if (position === false) {
                        position = 1;
                    }

                    if (position !== null) {
                        setSliderHandle(handle, value - position);
                    }

                    break;
            }
        });
    });

    /*************Slider functionality completed**************/
});//Document on ready
<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindPortfolioDto;

$this->layout = 'home_layout';
//$this->layout = 'header';
echo $this->element('header');

echo $this->Html->css('design/nouislider.css');
echo $this->Html->css('design/responsiveslides.css');
?>


<section class="banner mg-top-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-img">

                    <?= $this->Html->image('banner/banner2.jpg', array('alt' => 'Fananz Logo', 'class' => 'img-responsive')); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (count($portfolioDetails) > 0) {
    ?>
    <section class="filter-categ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fliter-wrapper">
                        <div class="sort-categ">
                            <span>Sort By</span>
                            <select class="form-control" id="short_select">
                                <option value="1" >New & Popular</option>
                                <option value="2">Price: Low to High</option>
                                <option value="3">Price: High to Low</option>
                            </select>
                        </div>
                        <div class="filter-categ">
                            <span>Filter</span>
                            <div class="price" id="price_categ">
                                <span>Price <i class="fa fa-caret-down"></i></span>
                                <div class="price-range">
                                    <input type="text" id="txtMinPrice" hidden="hidden">
                                    <input type="text" id="txtMaxPrice" hidden="hidden">
                                    <div id="keypress" class="noUi-target noUi-rtl noUi-horizontal">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-btn">
                                <button type="button" id="submitFiler" class="btn btn-primary">Apply</button>
                                <button type="button" id="resetFilter" class="btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pagination-page" id="paginationStart">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination-inner">
                        <label>
                            Show:
                        </label>
                        <select id="Itemsperpage">
                            <option  selected="selected">9</option>
                            <option>15</option>
                            <option>21</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <?php
} else {
    ?>
    <section class="data-not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dnf-img">
                        <?= $this->Html->image('data-not-found3.png', array('class' => 'img-responsive')); ?>
                    </div>
                    <div class="dnf-content">
                        <h2>No Records Found</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
<section class="category_artist">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            </div>
            <ul id="portfolioUl">


                <?php
                foreach ($portfolioDetails as $portfolio) {
                    // echo $portfolio->subcategory ;
                    ?>
                    <li id="portfolioLi">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="layout-figure">
                                <div class="figure-img">
                                    <?php
                                    if ($portfolio->coverImageUrl == "") {
                                        ?>


                                        <?= $this->Html->image('default_img.jpg', array('class' => 'img-responsive')); ?>
                                        <?php
                                    } else {
                                        ?>

                                        <?= $this->Html->image($portfolio->coverImageUrl, ['class' => 'img-responsive', 'alt' => $portfolio->subcategory]) ?>
                                    <?php }
                                    ?>
                                </div>
                                <div class="figure-caption">
                                    <div class="artist-name">
                                        <h3>  <?= $portfolio->subscriberName ?></h3>
                                    </div>
                                    <div class="artist-cat">
                                        <?php
                                        if ($portfolio->subcategory != '') {
                                            ?>

                                            <h4> <?= $portfolio->category ?> - <?= $portfolio->subcategory ?></h4>
                                            <?php
                                        } else {
                                            ?>
                                            <h4> <?= $portfolio->category ?> </h4>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="artist-price">
                                        <div class="price-text"><span>Price</span></div>
                                        <div class="price">AED<span> <?= $portfolio->minPrice ?> - <?= $portfolio->maxPrice ?> </span></div>
                                    </div>
                                    <div class="cate-link">
                                        <?= $this->Form->hidden('hdnPortfolioId', ['value' => $portfolio->portfolioId]) ?>
                                        <div class="detail-artists">
                                            <a href="#" data-toggle="modal" class="detail_artists" onclick="showDetails(<?= $portfolio->portfolioId ?>)">Details</a>    
                                        </div>
                                        <div class="request-artists">
                                            <a href="#request_artists" data-toggle="modal">Request Now</a>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
            if (count($portfolioDetails) > 0) {
                ?>
                <div class="col-lg-12" id="paginator_last">
                    <div class="pg-bottom">
                        <div class="total-page">
                            <p id="legend1"></p>
                        </div>
                        <div class="page-holder">
                            <div class="holder">
                            </div>
                        </div>
                    </div>
                </div>  


                <?php
            }
            ?>
        </div>
    </div>
</section>
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-img">
                    <a href=""> 
                        <?= $this->Html->image('banner/banner1.jpg', array('alt' => 'Fananz Logo', 'class' => 'img-responsive')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="detail_artists modal fade" id="detail_artists" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div class="header-modal" id="portfolio-header-id"> Details of Artists</div>
            <div class="modal-body">
                <div class="rslides_container">
                    <ul class="rslides" id="slider1">
                        <li>
                            <?= $this->Html->image('slider-1.jpg', array('alt' => '')); ?>

                        </li>
                        <li>
                            <?= $this->Html->image('slider-2.jpg', array('alt' => '')); ?>

                        </li>
                        <li>
                            <?= $this->Html->image('slider-3.jpg', array('alt' => '')); ?>


                        </li>
                        <li>
                            <?= $this->Html->image('slider-4.jpg', array('alt' => '')); ?>

                        </li>
                        <!-- items mirrored twice, total of 12 -->
                    </ul>
                </div>
                <div class="detail_artists_right">
                    <h3 id="portfolio-title-id"></h3>
                    <h4 id="portfolio-cat-id"></h4>
                    <div class="price"><span class="da-1">Price in AED</span> <span class="da-2" id="portfolio-price-range-id"></span></div>
                    <p id="portfolio-desc-id"></p>
                    <div class="share-link-social">
                        <div class="share-link-fb">
                            <a href="#" id="link-portfolio-fb" target="_blank"><img src="<?= VIRTUAL_DIR_PATH . '/img/fb.png' ?>"></a><div class="link-fb"><input type="text" readonly value="" id="txtFbId"></div>
                        </div>
                        <div class="share-link-yt">
                            <a href="#" id="link-portfolio-yt" target="_blank"><img src="<?= VIRTUAL_DIR_PATH . '/img/yt.png' ?>"></a><div class="link-yt"><input type="text" readonly value="" id="txtYtubeId"></div>
                        </div>
                    </div>
                    <div class="share-btn">
                        <span class="sb-text"> Share  <i class="fa fa-share-alt"></i>    </span>
                        <div class="share-btn-social">
                            <span><a href="" class="sbs-mail"><i class="fa fa-envelope"></i></a></span>
                            <span><a href="#" class="sbs-fb" onclick="shareToFacebook()"><i class="fa fa-facebook"></i></a></span>
                            <span><a href="" class="sbs-tw"><i class="fa fa-twitter"></i></a></span>
                            <span><a href="" class="sbs-gp"><i class="fa fa-google-plus"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="request_artists modal fade" id="request_artists" tabindex="-2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="float-right close-popup-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div class="header-modal">Request Services For Singer Taylor Swift </div>
            <div class="modal-body">
                <div class="form-group">
                    <label> Write some text
                        <textarea rows="5" class="form-control"></textarea>
                    </label>
                </div>
                <button type="submit" title="Submit" class="button black_sm center-block" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
<input type="text" id="categoryId" value="<?= $categoryId ?>" hidden="hidden">
<input type="text" id="subCategoryId" value="<?= $subCategoryId ?>" hidden="hidden">

<?php
//echo $this->element('footer');

echo $this->Html->script('responsiveslides.js');
echo $this->Html->script('nouislider.js');
echo $this->Html->script('wNumb.js');
echo $this->Html->script('jPages.min.js');
echo $this->Html->script('Pagination.js');
?>
<!-- //cart-js -->  


<script type="text/javascript">

    /*$(document).ready(function () {
     $.ajaxSetup({cache: true});
     $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
     FB.init({
     appId: '{your-app-id}',
     version: 'v2.7' // or v2.1, v2.2, v2.3, ...
     });
     $('#loginbutton,#feedbutton').removeAttr('disabled');
     FB.getLoginStatus(updateStatusCallback);
     });
     
     function updateStatusCallback() {
     alert('I am being called for facebook'');
     }
     });*/

    function shareToFacebook() {
        /*$.ajaxSetup({cache: true});
         $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
         FB.init({
         appId: '{your-app-id}',
         version: 'v2.7' // or v2.1, v2.2, v2.3, ...
         });
         $('#loginbutton,#feedbutton').removeAttr('disabled');
         FB.getLoginStatus(updateStatusCallback);
         });
         
         function updateStatusCallback() {
         alert('I am being called for facebook'');
         }*/

        FB.ui(
                {
                    method: 'share',
                    href: 'http://www.vibeosys.com'
                }, function (response) {
            alert(response);
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
            url: '/FananzWebApp/portfolio/details',
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
                if(portfolioData.fbLink != null){
                    $("#txtFbId").val(portfolioData.fbLink);
                    $("#link-portfolio-fb").attr('href', portfolioData.fbLink);
                }
                if(portfolioData.youtubeLink != null){
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
</script>
<script>
    $('#resetFilter').click(function () {
        alert('here');
        var categoryId = $('#categoryId').val();
        var subCategoryId = $('#subCategoryId').val();
        $.ajax({
            type: 'POST',
            url: '/FananzWebApp/portfolio/resetFilter',
            data: {
                categoryId: categoryId,
                subCategoryId: subCategoryId

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
                        if (subCategory !== "")
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
                            imageUrl = '/FananzWebApp/img/default_img.jpg';
                        }
                        portfolioHtml += '<li id="portfolioLi"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="layout-figure"> <div class="figure-img"><img class="img-responsive" src="' + imageUrl + '"> </div><div class="figure-caption"><div class="artist-name"><h3>' + obj.subscriberName + '</h3></div><div class="artist-cat"><h4>' + concatinatedString + '</h4></div><div class="artist-price"><div class="price-text"><span>Price</span></div><div class="price">AED<span>' + obj.minPrice + ' -' + obj.maxPrice + '</span></div></div><div class="cate-link"> <div class="detail-artists"><a href="#detail_artists" data-toggle="modal">Details</a>  </div> <div class="request-artists"><a href="#request_artists" data-toggle="modal">Request Now</a> </div>          </div></div></div></div> </li>';

                    }


                    );

                    var startPaginator = '<div class="container"><div class="row"><div class="col-lg-12"><div class="pagination-inner"><label>Show:</label><select id="Itemsperpage"><option  selected="selected">9</option><option>15</option><option>21</option></select></div></div></div></div>';

                    $('#paginationStart').html(startPaginator);

                    $('#portfolioUl').html(portfolioHtml);

                    var paginator = '<div class="pg-bottom"> <div class="total-page"><p id="legend1"></p></div><div class="page-holder"><div class="holder"></div></div></div>';
                    $('$paginator_last').html(paginator);
                }
            }
        });


    });



</script>
<script>

    $(document).ready(function () {

        var minPrice = $('#txtMinPrice').val();
        var maxPrice = $('#txtMaxPrice').val();
        var categoryId = $('#categoryId').val();
        var subCategoryId = $('#subCategoryId').val();

        $('#submitFiler').on('click', function () {
            var sortById = $('#short_select').val();
            //alert('hello');

            $.ajax({
                type: 'POST',
                url: '/FananzWebApp/portfolio/filteredPortfolios',
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
                                imageUrl = '/FananzWebApp/img/default_img.jpg';
                            }
                            portfolioHtml += '<li id="portfolioLi"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="layout-figure"> <div class="figure-img"><img class="img-responsive" src="' + imageUrl + '"> </div><div class="figure-caption"><div class="artist-name"><h3>' + obj.subscriberName + '</h3></div><div class="artist-cat"><h4>' + concatinatedString + '</h4></div><div class="artist-price"><div class="price-text"><span>Price</span></div><div class="price">AED<span>' + obj.minPrice + ' -' + obj.maxPrice + '</span></div></div><div class="cate-link"> <div class="detail-artists"><a href="#detail_artists" data-toggle="modal">Details</a>  </div> <div class="request-artists"><a href="#request_artists" data-toggle="modal">Request Now</a> </div>          </div></div></div></div> </li>';

                        }


                        );

                        var startPaginator = '<div class="container"><div class="row"><div class="col-lg-12"><div class="pagination-inner"><label>Show:</label><select id="Itemsperpage"><option  selected="selected">9</option><option>15</option><option>21</option></select></div></div></div></div>';

                        $('#paginationStart').html(startPaginator);

                        $('#portfolioUl').html(portfolioHtml);

                        var paginator = '<div class="pg-bottom"> <div class="total-page"><p id="legend1"></p></div><div class="page-holder"><div class="holder"></div></div></div>';
                        $('$paginator_last').html(paginator);
                    }
                }
            });

        });
    });



</script>


<script>

    $(document).ready(function () {
        var categoryId = $('#categoryId').val();
        var subCategoryId = $('#subCategoryId').val();
        var minPrice = $('#txtMinPrice').val();
        var maxPrice = $('#txtMaxPrice').val();
        // alert('hello'+categoryId);
        //var SubCat= $('#SubCat').val();

        $('#short_select').on('change', function () {
            var sortById = $('#short_select').val();

            $.ajax({
                type: 'POST',
                url: '/FananzWebApp/portfolio/filteredPortfolios',
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
                                imageUrl = '/FananzWebApp/img/default_img.jpg';
                            }
                            portfolioHtml += '<li id="portfolioLi"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="layout-figure"> <div class="figure-img"><img class="img-responsive" src="' + imageUrl + '"> </div><div class="figure-caption"><div class="artist-name"><h3>' + obj.subscriberName + '</h3></div><div class="artist-cat"><h4>' + concatinatedString + '</h4></div><div class="artist-price"><div class="price-text"><span>Price</span></div><div class="price">AED<span>' + obj.minPrice + ' -' + obj.maxPrice + '</span></div></div><div class="cate-link"> <div class="detail-artists"><a href="#detail_artists" data-toggle="modal">Details</a>  </div> <div class="request-artists"><a href="#request_artists" data-toggle="modal">Request Now</a> </div>          </div></div></div></div> </li>';

                        }


                        );

                        var startPaginator = '<div class="container"><div class="row"><div class="col-lg-12"><div class="pagination-inner"><label>Show:</label><select id="Itemsperpage"><option  selected="selected">9</option><option>15</option><option>21</option></select></div></div></div></div>';

                        $('#paginationStart').html(startPaginator);

                        $('#portfolioUl').html(portfolioHtml);

                        var paginator = '<div class="pg-bottom"> <div class="total-page"><p id="legend1"></p></div><div class="page-holder"><div class="holder"></div></div></div>';
                        $('$paginator_last').html(paginator);
                    }
                }
            });
        });



    });
    // }); 


    //    var value = document.getElementById("select").value ;




</script>

<script>
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
</script>


<script>
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
</script>

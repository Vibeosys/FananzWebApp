<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindCategoriesDto;
use App\Dto\FindSubcategoryDto;

//$this->layout = 'home_layout';
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);

echo $this->Html->script('jquery.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('bootstrap.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('custom.js', ['block' => 'scriptTop']);
echo $this->Html->script('formvalidation.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
echo $this->Html->script('/js/pages/web-header.js', ['block' => true]);
?>
<header>
    <div class="header-top-w3layouts navbar-fixed-top">
        <div class="container">
            <div class="col-md-6 logo-w3">
                <a href="<?= VIRTUAL_DIR_PATH . '/' ?>">

                    <?= $this->Html->image('logo-medium.png', array('alt' => 'Fananz Logo')); ?>
                    <h1 class="no-header">Fananz</h1>
                    <span class="logo-com no-header">.com</span>
                </a>
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <?php if (isset($isSubscriberLoggedIn) && $isSubscriberLoggedIn) : ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/portfolio' ?>">My Portfolio</a></li>
                        <li class="border-right"><?= $subscriberName ?></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/HomePage/logout' ?> ">Logout</a></li>
                    </ul>
                </div>
            <?php elseif (isset($isUserLoggedIn) && $isUserLoggedIn) : ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">Partner With Us</a></li>
                        <li class="border-right"><?= $userName ?></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/HomePage/logout' ?> ">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">Partner With Us</a></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/users/customerlogin' ?>">Login</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="clearfix"></div>
        </div>
        <div class="header-bottom-w3ls">
            <div class="container">
                <div class="col-md-12 navigation-agileits">
                    <nav class="navbar navbar-default">
                        <div class="collapse navbar-collapse page-scroll" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav width-100">
                                <li>
                                    <a href="<?= VIRTUAL_DIR_PATH . '/' ?>" class="hyper"  ><span> <?= Home ?></span></a>
                                </li>
                                <?php
                                if ($eventCategoryList != null) {
                                    foreach ($eventCategoryList as $category) {
                                        // echo($values->category);
                                        $isSubcategoryArray = is_array($category->subCategories) && count($category->subCategories) > 0;
                                        ?>


                                        <?php
                                        if ($isSubcategoryArray) {
                                            ?>

                                            <li  class="dropdown">
                                                <?php
                                            } else {
                                                ?>
                                            <li>
                                                <?php
                                            }
                                            ?>

                                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/' . $category->categoryShortName ?>" class="dropdown-toggle  hyper page-scroll"  ><span><?= $category->category ?>
                                                    <?php
                                                    if ($isSubcategoryArray) {
                                                        ?>
                                                        <b class="caret"> </b>
                                                    <?php }
                                                    ?>
                                                </span></a>



                                            <ul class="dropdown-menu multi">
                                                <div class="row">
                                                    <div class="col-sm-4"> 
                                                        <?php
                                                        if ($category->subCategories != null) {
                                                            foreach ($category->subCategories as $subCategories) {
                                                                ?>


                                                                <?php
                                                                $subCategoryValue = count($subCategories->subCategoryId);
                                                                if ($subCategories->subCategoryId % 2 != 0) {
                                                                    ?>     


                                                                    <ul class="multi-column-dropdown">
                                                                        <li><a href="<?= VIRTUAL_DIR_PATH . '/portfolio/' . $category->categoryShortName . '--' . $subCategories->subCategoryShortName ?>" ><?= $subCategories->subCategory ?></a></li>
                                                                    </ul>

                                                                    <?php
                                                                } else {
                                                                    ?>


                                                                    <ul class="multi-column-dropdown">
                                                                        <li><a href="<?= VIRTUAL_DIR_PATH . '/portfolio/' . $category->categoryShortName . '--' . $subCategories->subCategoryShortName ?>" > <?= $subCategories->subCategory ?></a></li>
                                                                    </ul>


                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        // }
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-4 w3l">


                                                        <?= $this->Html->image('menu1.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                </div>

                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if (!$isSubscriberLoggedIn && !$isAdminLoggedIn) : ?>
                                    <li class="float-right dropdown no-request">
                                        <a href="" class="dropdown-toggle hyper" data-toggle="dropdown"><span>Special Requests<b class="caret"></b></span></a>
                                        <ul class="dropdown-menu multi multi1 spec_request">
                                            <div class="row">
                                                <form id="spec_form">
                                                    <div class="col-lg-12">
                                                        <div class="form-group"  >
                                                            <label for="spec_email">Name <span class="required_field">*</span>
                                                                <input type="text" id="name" class="form-control valid_name" name="spec_name" required>
                                                                <span class="input-icon"><i class="fa fa-user"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" >
                                                        <div class="form-group">
                                                            <label for="user_email">Email<span class="required_field">*</span>
                                                                <input type="email" id="email" class="form-control valid_email" name="spec_email" required>
                                                                <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" >
                                                        <div class="form-group">
                                                            <label for="mobNo">Mobile No<span class="required_field">*</span>
                                                                <input type="number" id="mobNo" class="form-control valid_mobNo" name="spec_mobile" required="10">
                                                                <span class="input-icon"><i class="fa fa-mobile fa-1-5x"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" >
                                                        <div class="form-group">
                                                            <label for="user_email">Write your request<span class="required_field">*</span>
                                                                <textarea id="spec_msg" class="form-control valid_spec_msg" name="spec_msg" rows=3 required></textarea>
                                                            </label>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" title="Submit" id="special_request" name="special_request" class="button black_sm center-block">Submit</button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

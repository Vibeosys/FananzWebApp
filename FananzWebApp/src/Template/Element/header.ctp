<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindCategoriesDto;
use App\Dto\FindSubcategoryDto;

$this->layout = 'false';
$this->layout = 'home_layout';
?>
<header>
    <div class="header-top-w3layouts navbar-fixed-top">
        <div class="container">
            <div class="col-md-6 logo-w3">
                <a href="index.php">

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
            <div class="col-md-6 header-top-request">
                <ul>
                    <li class="border-right"><a href="partnerwithus.html">Partner With Us</a></li>
                    <li><a href="login.php">Login</a></li>
                    <!--				<li><a href="subscriber_login.html">Subscriber Login</a></li>-->
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="header-bottom-w3ls">
            <div class="container">
                <div class="col-md-12 navigation-agileits">
                    <nav class="navbar navbar-default">
                        <!--
                           <div class="navbar-header nav_2">
                              
                           </div> 
                        -->
                        <div class="collapse navbar-collapse page-scroll" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav width-100">
                                <!--						<li class=" active">-->
                                <li>


                                    <a href="<?= VIRTUAL_DIR_PATH.'/index.php' ?>" class="hyper"  ><span> <?= Home ?></span></a>
                                </li>
                                <?php
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

                                        <a href="<?= VIRTUAL_DIR_PATH.'/portfolio/' . $category->categoryShortName ?>" class="dropdown-toggle  hyper page-scroll"  ><span><?= $category->category ?>
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
                                                    foreach ($category->subCategories as $subCategories) {
                                                        ?>


                                                        <?php
                                                        $subCategoryValue = count($subCategories->subCategoryId);
                                                        if ($subCategories->subCategoryId % 2 != 0) {
                                                            ?>     


                                                            <ul class="multi-column-dropdown">
                                                                <li><a href="<?= VIRTUAL_DIR_PATH.'/portfolio/' . $category->categoryShortName . '--' . $subCategories->subCategoryShortName ?>" ><?= $subCategories->subCategory ?></a></li>
                                                            </ul>

                                                            <?php
                                                        } else {
                                                            ?>


                                                            <ul class="multi-column-dropdown">
                                                                <li><a href="<?= VIRTUAL_DIR_PATH.'/portfolio/' . $category->categoryShortName . '--' . $subCategories->subCategoryShortName ?>" > <?= $subCategories->subCategory ?></a></li>
                                                            </ul>


            <?php
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
<?php } ?>
                                <li class="float-right dropdown no-request">
                                    <a href="" class="dropdown-toggle hyper" data-toggle="dropdown"><span>Special Requests<b class="caret"></b></span></a>
                                    <ul class="dropdown-menu multi multi1 spec_request">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="spec_email">Name
                                                        <input type="text" id="spec_email" class="form-control" name="name">
                                                        <span class="input-icon"><i class="fa fa-user"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="spec_eventl">Event
                                                        <input type="text" id="spec_eventl" class="form-control" name="name">
                                                        <span class="input-icon"><i class="fa fa-magic"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="spec_date">Date
                                                        <input type="date" id="spec_date" class="form-control" name="name">
                                                        <span class="input-icon"><i class="fa fa-calendar"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="user_email">Email
                                                        <input type="email" id="spec_email" class="form-control" name="name">
                                                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="user_email">Mobile No
                                                        <input type="tel" id="spec_email" class="form-control" name="name">
                                                        <span class="input-icon"><i class="fa fa-mobile fa-1-5x"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="user_email">Write your request
                                                        <textarea id="spec_msg" class="form-control" name="name" rows=3></textarea>
                                                    </label>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" title="Submit" class="button black_sm center-block">Submit</button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

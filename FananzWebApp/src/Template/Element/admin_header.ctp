<?php
echo $this->Html->script('jquery.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('bootstrap.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('custom.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/sweetalert.min.js', ['block' => 'scriptTop']);
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
            <div class="col-md-6 header-top-request">

            </div>
            <?php if (isset($isSubscriberLoggedIn) && $isSubscriberLoggedIn) : ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/portfolio' ?>">My Portfolio</a></li>
                        <li class="border-right"><?= $subscriberName ?></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/HomePage/logout' ?> ">Logout</a></li>
                    </ul>
                </div>
                <?php
            elseif ($isAdminLoggedIn) :
                ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right">Logged in Admin</li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/HomePage/logout' ?>">Logout</a></li>
                    </ul>
                </div>
                <?php
            endif;
            ?>

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


                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>




<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fananz | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="" />


        <?= $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')); ?>
        <!-- css -->

        <?= $this->Html->css('design/bootstrap.min.css'); ?> 
        <?= $this->Html->css('design/slider-setting.css'); ?> 
        <?= $this->Html->css('design/style.css'); ?> 
        <?= $this->Html->css('design/font-awesome.min.css'); ?> 
        <?= $this->fetch('css'); ?>
        <!--// css -->



        <!-- font -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i,900,900i" rel="stylesheet">
        <!-- //font -->
        <?= $this->fetch('scriptTop'); ?>
        <?= $this->fetch('script'); ?>

    </head>
    <body>
        <?= $this->element('header') ?>
        <section class="error-page">
            <div class="container">
                <div class="row">
                    <div class="error-wrapper">
                        <div class="error-container">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="error-img">
                                    <?= $this->Html->Image('sad.png', ['alt' => 'Sorry']) ?>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <div class="error-inner-content">
                                    <h1>Ooops!!!</h1>
                                    <h2>Sorry Something went wrong</h2>
                                    <h3>Try that again, and if it still doesn't work let us know.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?= $this->element('footer'); ?>
        <?= $this->fetch('scriptBotton'); ?>
    </body>
</html>

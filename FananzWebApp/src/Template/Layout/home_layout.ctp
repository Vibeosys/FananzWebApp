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
        <?= $this->fetch('content'); ?>
        <?= $this->element('footer'); ?>
        <?= $this->fetch('scriptBotton'); ?>
    </body>
</html>

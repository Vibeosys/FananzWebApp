<!DOCTYPE html>
<html lang="en">
<head>
<title>Fananz | Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />

 
 <?= $this->Html->meta('favicon.ico', '/favicon.ico' , array ('type' => 'icon' )); ?>
<!-- css -->

 


        
         <?= $this->Html->css('design/bootstrap.min.css') ?> 
         <?= $this->Html->css('design/slider-setting.css') ?> 
         <?= $this->Html->css('design/style.css') ?> 
         <?= $this->Html->css('design/font-awesome.min.css') ?> 

<!--// css -->


<!-- font -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i,900,900i" rel="stylesheet">
<!--
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
-->
<!-- //font -->

</head>
<body>
    <?= $this->fetch('content') ?>
</body>
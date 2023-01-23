<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    
    <?php 
    echo $this->Html->css(['/v1/css/bootstrap.min',
    '/v1/css/style',
    ]); ?>
    <?php echo $this->Html->css(['cake', 'magnific-popup']); ?>

    
    
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>

<body>
    <?php echo $this->element('header'); ?>
    <?php //echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content'); ?>
    <?php echo $this->element('footer'); ?>
    <div id="cover"></div>
    <?php echo $this->Html->script(['jquery-3.6.3.min','jquery.form.min', 'jbvalidator.min']); ?>
    <?php echo $this->Html->script(['/v1/js/bootstrap.bundle.min', '/v1/js/custom']); ?>
    <?php echo $this->fetch('scriptBottom'); ?>
    
</body>
</html>

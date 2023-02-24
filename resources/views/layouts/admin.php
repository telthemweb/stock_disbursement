<?php

 use Ti\Mss\Helpers\SessionManager;
 $session = new SessionManager();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Cottco Portal</title>
    <meta name="csrf-token" content="<?php CSRFToken(); ?>">
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo url('assets/img/favicon.png'); ?>"/>
    <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/datatables.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/chosen.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap-datepicker.min.css'); ?>"  type="text/css">

    <link rel="stylesheet" href="<?php echo url('assets/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/fonts/flaticon/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/sweetalert2.css'); ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-light " id="mb-lg-1">
    <div class="container">
        <a class="navbar-brand p-3 " href="/"><img src="<?php echo url('assets/img/logo.png'); ?>" class="img-fluid" width="90px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item "><a href="<?php route('/admin-auth/login');?>" class="nav-link text-success">
                    login
                    </a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-2">
  
</div>
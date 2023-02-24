<?php

use Ti\Mss\Helpers\SessionManager;
use Ti\Mss\App\models\Settings;
$session = new SessionManager();

$setting = Settings::wherestatus('Active')->first();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $setting==null?"Dashboard":$setting->site_title; ?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo url($setting==null?'assets/img/favicon.png':$setting->favicon); ?>"/>
    <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/jquery.dataTables.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/chosen.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap-datepicker.min.css'); ?>"  type="text/css">
   <link rel="stylesheet" href="<?php echo url('assets/css/datatables.min.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo url('assets/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/fonts/flaticon/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style.blue.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/sweetalert2.css'); ?>">
</head>
<body>
<header class="header" id="myHeader">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="<?php route('/dashboard');?>" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><img src="<?php echo url($setting==null?'assets/img/logo.png':$setting->site_logo); ?>" width="90" class="rounded-0"></a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            
          
            <li class="nav-item dropdown ml-auto">
                <a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    <img src="<?php echo $_SESSION['gender']=="Male"? url('assets/img/male.ico'):url('assets/img/female.ico'); ?>" alt="Profile Picture" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow">
                </a>
                <div aria-labelledby="userInfo" class="dropdown-menu">
                    <a href="<?php route('/profile');?>" class="dropdown-item">
                        <strong class="d-block text-uppercase headings-font-family" id="flname" >
                            <span><i class="fa fa-user"></i> <?php echo $_SESSION['name'] . " " . $_SESSION['surname']; ?></span>
                        </strong>
                    </a>
                   
                    <div class="dropdown-divider"></div>
                    <a href="<?php route('/profile');?>" class="dropdown-item"><i class="fa fa-cog"></i> My Profile</a>
                   
                    <div class="dropdown-divider"></div><a href="<?php route('/admin-auth/logout');?>" class="dropdown-item" ><i class="fa fa-sign-out-alt"></i> Logout</a>

                </div>
            </li>
        </ul>
    </nav>
</header>
<div class="d-flex align-items-stretch">
    <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family text-white">MY DASHBOARD</div>
        <ul class="sidebar-menu list-unstyled">
         <?php if($_SESSION['role_id']=="1" || $_SESSION['role_id']=="5" || $_SESSION['role_id']=="2"): ?>
    
            <li class="sidebar-list-item dropdown bg-info" >
            <a href="#" class="sidebar-link text-white nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-briefcase mr-3 text-white"></i><span>PROCUREMENT</span></a>
            </li>
          <li class="sidebar-list-item " >
            <a href="<?php route('/suppliers');?>" class="sidebar-link text-white nav-link" >
            <i class="fa fa-car mr-3 text-white"></i><span>Suppliers</span></a>
            </li>
             <li class="sidebar-list-item " >
            <a href="<?php route('/categories');?>" class="sidebar-link text-white nav-link" >
            <i class="fa fa-folder mr-3 text-white"></i><span>Stock Categories</span></a>
            </li>
       
          <li class="sidebar-list-item " >
            <a href="<?php route('/products');?>" class="sidebar-link text-white nav-link" >
            <i class="fa fa-briefcase mr-3 text-white"></i><span>Stock Items</span></a>
            </li>

             <li class="sidebar-list-item " >
            <a href="<?php route('/depots');?>" class="sidebar-link text-white nav-link" >
            <i class="fa fa-industry mr-3 text-white"></i><span>Transit Depots </span></a>
            </li>

           
             <li class="sidebar-list-item " >
            <a href="<?php route('/dispatchprocess');?>" class="sidebar-link text-white nav-link" >
            <i class="fa fa-server mr-3 text-white"></i><span>Stock Tranfers</span></a>
            </li>
             
  
        <?php endif; ?>
        <?php if($_SESSION['role_id']=="3"): ?>
        <li class="sidebar-list-item dropdown bg-info">
        <a href="#" class="sidebar-link text-white nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-home mr-3 text-white"></i><span>TRANSIT DEPOT</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/stores');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-folder mr-3 text-white"></i><span>Pending GRV</span></a>
        </li>

        <li class="sidebar-list-item " >
        <a href="<?php route('/received/items');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-folder mr-3 text-white"></i><span>Received GRV</span></a>
        </li>

        
         <li class="sidebar-list-item " >
        <a href="<?php route('/store/cidp/'.$_SESSION['admin_id']);?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-folder mr-3 text-white"></i><span>CIDP</span></a>
        </li>
        
         <?php endif; ?>
         <?php if($_SESSION['role_id']=="4"): ?>
        <li class="sidebar-list-item dropdown bg-info">
        <a href="#" class="sidebar-link text-white nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-shopping-bag mr-3 text-white"></i><span>CID POINT</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/farmers');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-users mr-3 text-white"></i><span>Farmers</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/inputs/received');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-car mr-3 text-white"></i><span>Pending GRV</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/inputs/disburse');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-car mr-3 text-white"></i><span>Received GRV </span></a>
        </li>
        
        <?php endif; ?>
        <?php if($_SESSION['role_id']=="5"): ?>
        <li class="sidebar-list-item dropdown bg-info">
        <a href="#" class="sidebar-link text-white nav-linkdropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cogs mr-3 text-white"></i><span>CONFIGURATIONS</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/roles');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-lock mr-3 text-white"></i><span>System Roles</span></a>
        </li>
         <li class="sidebar-list-item " >
        <a href="<?php route('/employees');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-users mr-3 text-white"></i><span>System Users</span></a>
        </li>

         <li class="sidebar-list-item " >
        <a href="<?php route('/settings');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-cogs mr-3 text-white"></i><span>System Settings</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/audits');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-tasks mr-3 text-white"></i><span>Audit Logs</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/systemlogs');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-database mr-3 text-white"></i><span>System logs</span></a>
        </li>
        <li class="sidebar-list-item " >
        <a href="<?php route('/systemlogs');?>" class="sidebar-link text-white nav-link" >
        <i class="fa fa-file mr-3 text-white"></i><span>System Reports</span></a>
        </li>

        <?php endif; ?>
        
        
       <p class="mb-5"></p>
        <li class="sidebar-list-item bg-red text-white" >
        <a href="<?php route('/admin-auth/logout');?>" class="sidebar-link text-white nav-link " >
        <i class="fa fa-sign-out-alt mr-3 text-gray text-white"></i><span class="text-white">LOGOUT</span></a>
        </li>
        </ul>
    </div>
    <div class="page-holder w-100 d-flex flex-wrap">




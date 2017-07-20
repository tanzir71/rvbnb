<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="International online Parking System">
    <meta name="keywords" content="">
    <meta name="author" content="ThirdHand">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/icons/fontawesome/css/style.css">
    <!-- THEME / PLUGIN CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animsition.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/vendors/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/mystyle.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="animsition">
        <div class="wrapper">
        <!-- HEADER -->

        <header>
            <nav class="navbar-default navbar-fixed-top">
                <div class="container">
                    <a href="#" class="nav-trigger hidden-xs" data-toggle="modal" data-target="#myModal"></a>
                    <div class="navbar-header"> <a href="<?php echo base_url() ?>home" class="navbar-brand">rv<span>bnb</span></a> </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li> <a href="<?php echo base_url() ?>home">Home</a></li>
                            <li> <a href="index.html">How It Works</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                        </ul>

                    </div>
                    <div class="header-widget pull-right">
                        <a href="#" class="h-login" data-toggle="modal" data-target="#myModal2" data-tab="login">Become a Host</a>
                        <a href="#" class="h-login" data-toggle="modal" data-target="#myModal2" data-tab="login">Sign In</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- start: Intro search section -->

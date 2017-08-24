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
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png"/>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- ICONS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/icons/fontawesome/css/style.css">
    <!-- THEME / PLUGIN CSS -->
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animsition.min.css">
    <link href="<?php echo base_url(); ?>assets/css/jquery.autocomplete.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/vendors/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/mystyle.css">

    
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="animsition">
    <div id="overlay">
        <div class="spinner"></div>
    </div>
        <div class="wrapper">
        <!-- HEADER -->

        <header>
            <nav class="navbar-default navbar-fixed-top">
                <div class="container">
                    <a href="<?php echo base_url() ?>home" class="nav-trigger hidden-xs" data-toggle="modal" data-target="#myModal"></a>
                    <div class="navbar-header"> <a href="<?php echo base_url() ?>home" class="navbar-brand">air<span>rv</span></a> </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li> <a href="<?php echo base_url() ?>home">Home</a></li>
                            <li> <a href="#">How It Works</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>

                    </div>
                    <div class="header-widget pull-right">
                        
                        <?php 
                        if ($this->session->userdata('airbnb') && $this->session->userdata('session') && $this->session->userdata('user')) { ?>
                            <a href="<?php echo base_url(); ?>user/profile" class="h-login">Profile</a>
                            <a href="<?php echo base_url(); ?>user/logout" class="h-login">Logout</a>
                        <?php }else{ ?>
                            <a href="#" class="h-login" data-toggle="modal" data-target="#sign_up" data-tab="login">Sign Up</a>
                            <a href="#" class="h-login" data-toggle="modal" data-target="#login_model" data-tab="login">Sign In</a>
                        <?php } ?>

                    </div>
                </div>
            </nav>
        </header>
        <!-- start: Intro search section -->



        <div class="modal fade-scale" id="login_model"> <!--data-backdrop="static" data-keyboard="false"-->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="modal-title text-center">LOGIN</h4>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10 col-lg-10" style="margin-top: 20px;">
                        
                            <?php
                            if(!empty($authUrl)) {
                                echo '<center><a href="'.$authUrl.'">
                                    <img src="'.base_url().'assets/images/flogin.png" alt=""/>
                                </a><br>or</center>';

                            }
                            ?> 

                            <form class="form-signin" method="post" action="<?php echo base_url(); ?>member/adminlogin1">
                                <div class="intro-login">
                                    <input type="text" name="name" autofocus="1" placeholder="Enter username" autocomplete="off" required="1">
                                    <input type="password" name="password" placeholder="Enter password" required="1">

                                    <button type="submit">LOGIN <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
                                </div>
                            </form>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <h4>Don't have an account? <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#sign_up" data-dismiss="modal">Sign up</button></h4>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade-scale" id="sign_up">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="modal-title text-center">SIGN UP</h4>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10 col-lg-10" style="margin-top: 20px;">

                            <?php
                            if(!empty($authUrl)) {
                                echo '<center><a href="'.$authUrl.'">
                                    <img src="'.base_url().'assets/images/flogin.png" alt=""/>
                                </a><br>or</center>';
                            }
                            ?>    
                            <form class="form-signin" method="post" action="<?php echo base_url(); ?>home/signup">
                                <div class="intro-login">
                                    <input type="text" name="name" autofocus="1" placeholder="Enter username" autocomplete="off" required="1">
                                    <input type="password" name="password" id="pass_up" placeholder="Enter password" required="1">
                                    <input type="password" name="confirm_password" id="con_pass" onclick="con_pass()" placeholder="Repeat password" required="1">
                                    <span id="match_result"></span>
                                    <input type="email" name="email" placeholder="Enter Email" required="1">

                                    <button type="submit">SIGN UP <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
                                </div>
                            </form>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <h4>Already have an account? <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#login_model" data-dismiss="modal">Login</button></h4>
                    </div>
                </div>
            </div>
        </div>

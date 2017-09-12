<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicons.png"/>

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> 

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>panel/css/style.css">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>panel/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>panel/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>panel/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>panel/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>panel/css/morris.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>panel/css/test.css" rel="stylesheet">
	
    <link href="<?php echo base_url(); ?>panel/css/tcal.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>panel/css/jquery.autocomplete.css" rel="stylesheet">
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>panel/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>panel/css/jquery-ui.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
    <div id="overlay">
        <div class="spinner"></div>
    </div>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand admin-logo" href="<?php echo base_url();?>admin"><img src="<?php echo base_url(); ?>panel/img/logo_250x60.png"></a>
            </div>
            <!-- /.navbar-header -->

			
			<div class="col-sm-6 user_title">
			
			<?php
						
			$wire=$this->session->userdata('wire');
				
    		if(!empty($wire)){
    			$this->db->where("id", $wire); 
            	$result = $this->db->get('ware');
            	$row = $result->row();
    		    echo $row->name;
				
			}	
			else
				echo "Super Admin";
			?>
			
			
			</div>
			
			

			
            <ul class="nav navbar-top-links navbar-right text-right">             
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo 'Profile'; ?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url(); ?>admin/change_password"><i class="fa fa-lock"></i> Change password</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <?php include ('sidebar-nav.php'); ?>

        </nav>
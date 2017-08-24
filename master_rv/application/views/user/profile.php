<?php include_once'widget.php'; ?>

<div class="home-directory">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

            	<?php include_once'profile_sidebar.php'; ?>

            </div>

            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            	<div class="panel panel-default">
            		<div class="panel-heading">
            			<h3 class="panel-title"><i class="fa fa-user"></i> Profile</h3>
            		</div>
            		<div class="panel-body">
            			<?php if (!empty($user_data->user)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Username</strong>: <?php echo $user_data->user; ?>
                        </div>
                        <?php } ?>

                        <?php if (!empty($user_data->fname)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Name</strong>: <?php echo $user_data->fname.' '. $user_data->lname; ?>
                        </div>
                        <?php } ?>


                        <?php if (!empty($user_data->email)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Email</strong>: <?php echo $user_data->email; ?>
                        </div>
                        <?php } ?>

                        <?php if (!empty($user_data->gender)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Gender</strong>: <?php echo ucfirst($user_data->gender); ?>
                        </div>
                        <?php } ?>

                        <?php if ($user_data->birthday !== '0000-00-00') { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Birthday</strong>: <?php echo $user_data->birthday; ?>
                        </div>
                        <?php } ?>

                        <?php if (!empty($user_data->phone)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Phone Number</strong>: <?php echo $user_data->phone; ?>
                        </div>
                        <?php } ?>


                        <?php if (!empty($user_data->live)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Location</strong>: <?php echo $user_data->live; ?>
                        </div>
                        <?php } ?>


                        <?php if (!empty($user_data->added_date)) { ?>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Join Date</strong>: <?php echo $user_data->added_date; ?>
                        </div>
                        <?php } ?>


                        <?php if (!empty($user_data->yourself)) { ?>
                        <div class="col-sm-12 col-xs-12 become_review">
                            <strong>Describe Yourself</strong>: <p><?php echo $user_data->yourself; ?></p>
                        </div>
                        <?php } ?>


            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
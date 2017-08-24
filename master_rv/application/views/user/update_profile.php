<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
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
            			<h3 class="panel-title"><i class="fa fa-user"></i> Update Profile</h3>
            		</div>
            		<div class="panel-body">

                        <?php if ($all_up == 'edit') { ?>

                            <form class="row" method="POST" action="<?php echo base_url(); ?>user/update_profile_submit">

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>First Name: </label>
                                    <input class="form-control" name="fname" type="text" value="<?php echo $user_data->fname; ?>"> 
                                </div>

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>Last Name: </label>
                                    <input class="form-control" name="lname" type="text" value="<?php echo $user_data->lname; ?>"> 
                                </div>

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>Gender: </label>
                                    <select class="form-control" name="gender">
                                        <option value="male" <?php if ($user_data->gender == 'male'): ?>
                                            selected = 'selected'
                                        <?php endif ?>>Male</option>
                                        <option value="female" <?php if ($user_data->gender == 'female'): ?>
                                            selected = 'selected'
                                        <?php endif ?>>Female</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>Birthday: </label>
                                    <input class="form-control" name="from_date" id="b_date" type="text" placeholder="yyyy-mm-dd" value="<?php echo $user_data->birthday; ?>">
                                </div>

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>Email: </label>
                                    <input class="form-control" name="email" type="email" value="<?php echo $user_data->email; ?>"> 
                                </div>

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>Phone Number: </label>
                                    <input class="form-control" name="phone" type="text" value="<?php echo $user_data->phone; ?>"> 
                                </div>

                                <div class="form-group col-sm-6 col-xs-12">
                                    <label>Live Location: </label>
                                    <input class="form-control" name="location" type="text" id="search_location" value="<?php echo $user_data->live; ?>"> 
                                </div>

                                <div class="form-group col-sm-12 col-xs-12">
                                    <label>Describe Yourself: </label>
                                    <textarea name="yourself" class="form-control" style="height: 200px"><?php echo $user_data->yourself; ?></textarea>
                                </div>

                                <div class="form-group col-sm-12 col-xs-12 text-right">
                                    <input type="submit" value="UPDATE" class="btn btn-lg btn-default">
                                </div>

                            </form>

                        <?php } else if ($all_up == 'password') { ?>
                            

                            <div class="form-group col-sm-7 col-xs-12">
                                <label>Current Password: </label>
                                <input class="form-control" id="old_pass" type="password" placeholder="Type Current Password" autofocus="1"> 
                            </div>

                            <div class="form-group col-sm-7 col-xs-12">
                                <label>New Password: </label>
                                <input class="form-control" id="new_pass" type="password" placeholder="Type New Password"> 
                            </div>

                            <div class="form-group col-sm-7 col-xs-12">
                                <label>Re-type Password: </label>
                                <input class="form-control" id="confirm_pass" type="password" placeholder="Type Re-type Password"> 
                            </div>
                            <div class="form-group col-sm-7 col-xs-12">
                                <span id="show_change_pass"></span>
                            </div>

                            <div class="form-group col-sm-7 col-xs-12">
                                <input type="submit" onclick="return password_change()" value="CHANGE" class="btn btn-default">
                            </div>


                        <?php } else if ($all_up == 'picture') { ?>
                            <form enctype="multipart/form-data" action="<?php echo base_url() ?>user/change_profile_picture" method="post">

                                <div class="form-group col-sm-7 col-xs-12">
                                    <img class="img img-responsive" src="<?php echo base_url() ?>assets/images/profile/<?php echo $user_data->images; ?>" alt="Image" style="height: 300px;">
                                </div>
                                <div class="form-group col-sm-7 col-xs-12">
                                    <label>Browse Image: </label>
                                   <input type="file" class="form-control" name="userpic">  
                                </div>


                                <div class="form-group col-sm-7 col-xs-12">
                                    <input type="submit" name="fileSubmit" value="UPDATE" class="btn btn-default">
                                </div>
                            </form>

                        <?php } ?>


            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
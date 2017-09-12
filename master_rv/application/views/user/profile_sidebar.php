<div class="profile_left_bar">
	<div class="profile_img">
		<?php if ($user_data->oauth_provider == 'facebook'){ ?>
			<img src="<?php echo $user_data->picture_url; ?>" alt="Profile Image">
		<?php }else{ ?>
			<img src="<?php echo base_url() ?>assets/images/profile/<?php echo $user_data->images; ?>" alt="Image">
		<?php } ?>
	</div>
	<h3 class="profile_name"><?php echo $user_data->fname.' '. $user_data->lname; ?></h3>

	<div class="profile_categories">
		<h4>Profile</h4>
		<ul>
			<li><a href="<?php echo base_url() ?>user/profile"><i class="fa fa-user"></i> Profile</a></li>
			<li><a href="<?php echo base_url() ?>user/update_profile/edit"><i class="fa fa-pencil"></i> Edit Ptofile</a></li>
			<?php if (empty($user_data->oauth_provider)){ ?>
			<li><a href="<?php echo base_url() ?>user/update_profile/password"><i class="fa fa-key"></i> Change Password</a></li>
			<li><a href="<?php echo base_url() ?>user/update_profile/picture"><i class="fa fa-users"></i> Profile Picture</a></li>
			<?php } ?>
		</ul>

		<h4>Hosting Information</h4>
		<ul>
			<li><a href="<?php echo base_url() ?>user/become_a_host"><i class="fa fa-list-ol"></i> Add new place</a></li>
			<li><a href="<?php echo base_url() ?>user/hosting_history"><i class="fa fa-history"></i> Hosting History</a></li>
		</ul>

		<h4>Booking list</h4>
		<ul>
			<li><a href="<?php echo base_url() ?>user/active_booking"><i class="fa fa-product-hunt"></i> Active booking</a></li>
			<li><a href="<?php echo base_url() ?>user/booking_history"><i class="fa fa-history"></i> Booking history</a></li>
		</ul>

		<h4>Messaging</h4>
		<ul>
			<li><a href="<?php echo base_url() ?>user/chat_list"><i class="fa fa-envelope"></i> Inbox</a></li>
		</ul>	

		<h4>Transaction</h4>
		<ul>
			<li><a href="<?php echo base_url() ?>user/payment"><i class="fa fa-credit-card-alt"></i> Payment</a></li>
			<li><a href="<?php echo base_url() ?>user/transaction_hostory"><i class="fa fa-history"></i> Transaction History</a></li>
		</ul>
<!--
		<h4>Parking List</h4>
		<ul>
			<li><a href="#"><i class="fa fa-product-hunt"></i> Pending Parking</a></li>
			<li><a href="#"><i class="fa fa-ban"></i> Discard Parking</a></li>
			<li><a href="#"><i class="fa fa-history"></i> Parking History</a></li>
		</ul>

		<h4>Client</h4>
		<ul>
			<li><a href="#"><i class="fa fa-long-arrow-right"></i> Following client</a></li>
			<li><a href="#"><i class="fa fa-comments"></i> Chatting Client</a></li>
		</ul>

		<h4>About</h4>
		<ul>
			<li><a href="#"><i class="fa fa-question-circle"></i> FAQ</a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i> Payment Policy</a></li>
			<li><a href="#"><i class="fa fa-cc-discover"></i> Transection System</a></li>
			<li><a href="#"><i class="fa fa-industry"></i> About us</a></li>
			<li><a href="#"><i class="fa fa-wrench"></i> Privacy &amp; Policy</a></li>
			<li><a href="#"><i class="fa fa-exclamation-triangle"></i> Terms &amp; Service</a></li>
		</ul>
-->
	</div>
</div>
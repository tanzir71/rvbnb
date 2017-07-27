<div class="page_header" style="margin-top: 110px"> 

    <img src="http://placehold.it/1780x400" class="img-responsive" alt="">
    <div class="container">
        <ul class="bcrumbs">
            <li><a href="#">Home</a> </li>
            <li>Profile</li>
        </ul>
    </div>
</div>

<div class="jumbotron">
	<div class="container">
		<p>
			username : <a href="#"><?php echo $user_data->user; ?></a> <br>
			Name : <?php echo $user_data->fname.' '.$user_data->lname; ?> <br>
			Email : <?php echo $user_data->email; ?> <br>
			Phone Number : <?php echo $user_data->phone; ?> <br>
			Join Date : <?php echo $user_data->added_date; ?>

		</p>
		<p>
			<a class="btn btn-primary btn-lg">Learn more</a>
		</p>
	</div>
</div>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

        	<div class="panel panel-default" style="margin-top: 25px">
				<div class="panel-heading">
					<h3 class="panel-title"><span style="text-transform: uppercase; color: #FA824C;font-weight: bold;">
					<?php
						$id=$this->session->userdata('admin');
						$this->db->where('id',$id);
						$info=$this->db->get('password');						
						$da=$info->row();						
						echo $da->user;
					?></span> Change password
					</h3>
				</div>
				<div class="panel-body">

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

				</div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
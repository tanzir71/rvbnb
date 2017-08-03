<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

        	<div class="panel panel-default" style="margin-top: 25px">
				<div class="panel-heading">
					<h3 class="panel-title">WELCOME <span style="text-transform: uppercase; color: blue;font-weight: bold;">
					<?php
						$id=$this->session->userdata('admin');
						$this->db->where('id',$id);
						$info=$this->db->get('password');						
						$da=$info->row();						
						echo $da->user;
					?></span>
					</h3>
				</div>
				<div class="panel-body">
					
				</div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
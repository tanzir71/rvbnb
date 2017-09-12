<?php

 class Admin extends CI_Controller{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");


		$admin_user = $this->session->userdata('admin');
		$session = $this->session->userdata('session');
		$aaa = $this->session->userdata('aaa');
		if(empty($admin_user) || empty($session)  || empty($aaa) )
		{	
			redirect('member/adminlogin');
		}
		$this->load->model('trans');
		$this->load->model('user_model');
	
	}
	public function index(){
		$this->load->model('setting');
		 
		$data['setting']="";
		$data['type']=0;

		$data['title'] = 'Airrv';
		
		$admin = $this->session->userdata('admin');
		$t = $this->session->userdata('wire');
		$type = $this->session->userdata('type');			
			
		$this->load->view('home/headar',$data);	
	
		$data['wire']=$this->setting->getWireList('ware','name','asc',2);

		$data['ware'] = $t;
		
		if($type == 1)
		$this->load->view('home/index',$data);
		else
			$this->load->view('home/blank',$data);

		$this->load->view('home/footer');		 
	}
	public function change_password(){
		$this->load->model('setting');
		 
		$data['setting']="";
		$data['type']=0;

		$data['title'] = 'Airrv';
		
		$admin = $this->session->userdata('admin');
		$t = $this->session->userdata('wire');
		$type = $this->session->userdata('type');			
			
		$this->load->view('home/headar',$data);	
	
		$data['wire']=$this->setting->getWireList('ware','name','asc',2);

		$data['ware'] = $t;
		
		if($type == 1)
		$this->load->view('home/change_password',$data);
		else
			$this->load->view('home/change_password',$data);

		$this->load->view('home/footer');		 
	}
	public function password_change(){
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$confirm_pass = $this->input->post('confirm_pass');

		$id = $this->session->userdata('admin');
		$this->db->where('id',$id);
        $query = $this->db->get('password');
        if ($query->num_rows()>0) {
        	$data = $query->row();
        	$password = $data->password;

        	if ($password == $old_pass) {
        		$change_pass=array(
	                'password' => $new_pass
	            );
	            $this->db->where('id',$id);
	            $this->db->update('password',$change_pass);
	            if ($this->db->affected_rows()>0) {
	            	$msg['success'] = 'Password Change successfully.';
	            }
	            else{
	        		$msg['try_new'] = 'Type new password and try again!';
	        	}
        	}else{
        		$msg['mismatch'] = 'Old Password not matched !';
        	}
        }
        echo json_encode($msg);

	}

	function logout()
    {
		$this->session->unset_userdata('admin');

		$this->session->unset_userdata('aaa');
		$this->session->unset_userdata('session');
		redirect('admin');
	}

	public function change_wire($id=null){
		
		
		if(!empty($id)){
			$this->session->unset_userdata('admin');
			$this->session->unset_userdata('wire');
			$this->session->set_userdata('wire',$id);
			
			$this->db->where('ware',$id);
			$info = $this->db->get('password');
			$row=$info->row();

			$this->session->set_userdata('admin',$row->id);
		}
		
		redirect('admin');
		
	}


	public function create_user(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);

		$data['title'] = 'Create User ';
		
		$this->load->view('home/headar',$data);


		$this->load->view('admin/create_user',$data);
		
		$this->load->view('home/footer');
	}
	public function user_all()
	{
		
		$this->load->model('setting');
		$data['setting']="";
		$data['type']=0;



		$data['title'] = 'User All';
		
		$admin = $this->session->userdata('admin');
		$t = $this->session->userdata('wire');
		$type = $this->session->userdata('type');
		
		$this->load->view('home/headar',$data);
		
		$data['user']=$this->setting->getAll('password');

		$this->load->view('admin/user_all',$data);
		$this->load->view('home/footer');
	} //end user and ware all working


	public function buyers_vendor(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);

		$data['title'] = 'Buyers and Vendors';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/buyers_vendor',$data);
		
		$this->load->view('home/footer');
	}

	public function host_approval(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['host_history'] = $this->user_model->host_approval();
		$data['host_success'] = $this->user_model->host_success();

		$data['title'] = 'Host Review';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/host_approval',$data);
		
		$this->load->view('home/footer');
	}


	public function approve_now(){
		$id = $this->input->post('id');

		$up_status = array('status' => 1 );
		
		$this->db->where('id', $id);
		$this->db->update('host', $up_status);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);
	}
	public function disapprove_host(){
		$id = $this->input->post('id');

		$up_status = array('status' => 0 );
		
		$this->db->where('id', $id);
		$this->db->update('host', $up_status);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);
	}

	public function delete_host(){
		$id = $this->input->post('id');

		$up_status = array('status' => 2 );
		
		$this->db->where('id', $id);
		$this->db->update('host', $up_status);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);
	}


	//user details
	public function user_details($id){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['host_user'] = $this->user_model->host_user_details($id);


		$data['title'] = 'User Details';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/user_details',$data);
		
		$this->load->view('home/footer');
	}


	public function user_controls(){
		$id = $this->input->post('id');
		$assign = $this->input->post('assign');

		if ($assign=='a') {
			$status = 1;
		}elseif ($assign=='d') {
			$status = 2;
		}

		$up_status = array('status' => $status );

		$this->db->where('id',$id);
		$this->db->update('alluser',$up_status);
		if ($this->db->affected_rows()>0) {

			$this->db->where('userid',$id);
			$this->db->where('reviews',1);
			$query = $this->db->get('host');
			if ($query->num_rows()>0) {
				$up_host_st = array('status' => $status );
				$this->db->where('userid',$id);
				$this->db->where('reviews',1);
				$this->db->update('host',$up_host_st);
				if ($this->db->affected_rows()>0) {
					$msg = 1;
				}else{
					$msg = 2;
				}
			}else{
				$msg = 1;
			}
			
		}else{
			$msg = 2;
		}
		echo json_encode($msg);		
	}



	public function buyer_vendor_status(){

		$id = $this->input->post('userid');
		$email = $this->input->post('email');
		$status = $this->input->post('user_status');

		$data['s_results']=$this->user_model->all_search_user($id,$email,$status,'alluser');


		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);

		$data['title'] = 'Buyers and Vendors';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/buyer_vendor_status',$data);
		
		$this->load->view('home/footer');
	}
	public function autocomplete_view_email()
	{
		$this->load->database();
		$email=$this->input->post('id');
		$this->db->like('email', $email);
		$this->db->limit(20);
		$info=$this->db->get('alluser');
		if ($info->num_rows()>0) {
			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['email']);
			}
			echo json_encode($data);
		}
	} //all user view





	public function autocomplete_view_state()
	{
		$this->load->database();
		$state=$this->input->post('id');
		$this->db->like('state', $state);
		$this->db->where('reviews', 1);
		$this->db->group_by('state');
		$this->db->limit(20);
		$info=$this->db->get('host');
		if ($info->num_rows()>0) {
			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['state']);
			}
			echo json_encode($data);
		}
	}


	public function autocomplete_view_city()
	{
		$this->load->database();
		$city=$this->input->post('id');
		$this->db->like('city', $city);
		$this->db->where('reviews', 1);
		$this->db->group_by('city');
		$this->db->limit(20);
		$info=$this->db->get('host');
		if ($info->num_rows()>0) {
			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['city']);
			}
			echo json_encode($data);
		}
	}


	public function autocomplete_view_street_location()
	{
		$this->load->database();
		$location=$this->input->post('id');
		$this->db->like('location', $location);
		$this->db->where('reviews', 1);
		$this->db->group_by('location');
		$this->db->limit(20);
		$info=$this->db->get('host');
		if ($info->num_rows()>0) {
			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['location']);
			}
			echo json_encode($data);
		}
	}


	public function allhost_search(){

		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$location = $this->input->post('location');
		$status = $this->input->post('status');

		$data['s_results']=$this->user_model->allhost_search($state,$city,$location,$status,'host');

		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['host_history'] = $this->user_model->host_approval();
		$data['host_success'] = $this->user_model->host_success();

		$data['title'] = 'Host Review';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/allhost_search',$data);
		
		$this->load->view('home/footer');
	}


	public function inbox(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['title'] = 'Message';
		
		$this->load->view('home/headar',$data);

		$data['admin_inbox'] = $this->user_model->admin_inbox_list();
		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/inbox',$data);
		
		$this->load->view('home/footer');
	}
	public function reply_inbox(){
		$all_val = $this->input->post('all_val');
		$explode = explode(':', $all_val);

		$id = $explode[0];
		$id1 = $explode[1];
		$id2 = $explode[2];

		$result['final'] = $this->user_model->inbox_messege($id);

		echo json_encode($result);
	}


	public function submit_messege(){
		$all_val = $this->input->post('all_val');
		$explode = explode(':', $all_val);

		$id = $explode[0];
		$id1 = $explode[1];
		$id2 = $explode[2];

		$details = $this->input->post('details');

		$insert_message = array(
			'details' => $details,
			'root' => $id, 
			'id1' => $id1, 
			'id2' => $id2, 
			'type' => $id1 
		);
        $this->db->insert("inbox",$insert_message);
        if ($this->db->affected_rows()>0) {
        	$result['final'] = $this->user_model->inbox_messege($id);
        }
        echo json_encode($result);
	}

	public function request_inbox(){
		$email = $this->input->post('email');

		$id2 = $this->user_model->find_id_by_email($email);

		$chk = $this->user_model->chk_id_by_email($id2);
		if ($chk->num_rows()>0) {
			$result['old'] = 3;
		}else{

			$insert_message = array(
				'id1' => 0, 
				'id2' => $id2, 
				'type' => 0 
			);
	        $this->db->insert("inbox",$insert_message);
	        if ($this->db->affected_rows()>0) {
	        	$result['success'] = 1;
	        }else{
	        	$result['failed'] = 2;
	        }
	    }
	    
        echo json_encode($result);
	}


	public function payments(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['title'] = 'Payments || Admin panel';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/payments',$data);
		
		$this->load->view('home/footer');
	}
	public function accounts(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['title'] = 'Accounts || Admin panel';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/accounts',$data);
		
		$this->load->view('home/footer');
	}
	public function withdraw_request(){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$this->load->model('setting');
		
		$data['type']=0;
		$data['ware']=$this->setting->getWare('ware','name','asc',1);


		$data['title'] = 'Withdrw Request || Admin panel';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/withdraw_request',$data);
		
		$this->load->view('home/footer');
	}



	public function payment_withdrw_by_admin(){
		$values = $this->input->post('values');

		$exp = explode(':', $values);
		$id = $exp[0];
		$assign = $exp[1];

		$up_withdraw = array('status' => $assign );
		$this->db->where('id',$id);
		$this->db->update('payments',$up_withdraw);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}

		
		echo json_encode($msg);		
	}








}
?>
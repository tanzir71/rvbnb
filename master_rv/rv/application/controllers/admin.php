<?php

 class Admin extends CI_Controller{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");


		$admin_user = $this->session->userdata('admin');
		if(empty($admin_user))
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

		$data['title'] = 'rvBnB';
		
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

	function logout()
    {
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('cid');
		$this->session->unset_userdata('admin_name');
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

		$data['title'] = 'ALL Buyers and Vendors ';
		
		$this->load->view('home/headar',$data);

		$data['alluser']=$this->setting->getAll_data('alluser');


		$this->load->view('admin/buyers_vendor',$data);
		
		$this->load->view('home/footer');
	}






}
?>
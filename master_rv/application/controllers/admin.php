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
		$this->load->model('user_model');
	
	}
	public function index(){
		$data['title'] = 'RVbnb | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('home/index');
		$this->load->view('home/home_page');
		$this->load->view('home/footer');		 
	}

	function logout()
    {
		$this->session->unset_userdata('admin');
		redirect('admin');
	}

	public function profile(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Profile | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('admin/profile', $data);
		$this->load->view('home/footer');
	}

	public function become_a_host(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);

		$data['title'] = 'Become a Host | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('admin/become_a_host', $data);
		$this->load->view('home/footer');
	}
	public function become_a_host_location(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);

		$data['title'] = 'Become a Host Location | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('admin/become_a_host_location', $data);
		$this->load->view('home/footer');
	}
	public function become_a_host_info(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);

		$data['title'] = 'Become a Host Information | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('admin/become_a_host_info', $data);
		$this->load->view('home/footer');
	}
	public function become_a_host_review(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);

		$data['title'] = 'Become a Host Review | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('admin/become_a_host_review', $data);
		$this->load->view('home/footer');
	}



	public function host_step_one(){
		$this->load->library('form_validation');      
        $this->form_validation->set_rules('id',  'id',  'required');
        $this->form_validation->set_rules('fname',  'fname',  'required');
        $this->form_validation->set_rules('lname',  'lname',  'required');
        $this->form_validation->set_rules('email',  'email',  'required');
        $this->form_validation->set_rules('phone',  'phone',  'required');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('admin/become_a_host');
		}else{

			$id = $this->input->post('id');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');

			if (empty($fname) || empty($lname) || empty($email) || empty($phone)) {
				redirect('admin/become_a_host');
			}else{
				$up_user = array(
					'fname' => $fname, 
					'lname' => $lname, 
					'email' => $email, 
					'phone' => $phone 
				);
				$this->db->where('id', $id);
				$this->db->update('alluser', $up_user);
				redirect('admin/become_a_host_location');
			}
		}
	}

	public function host_step_two(){
		$this->load->library('form_validation');
        $this->form_validation->set_rules('country',  'country',  'required');
        $this->form_validation->set_rules('state',  'state',  'required');
        $this->form_validation->set_rules('city',  'city',  'required');
        $this->form_validation->set_rules('borough',  'borough',  'required');
        $this->form_validation->set_rules('zip',  'zip',  'required');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('admin/become_a_host_location');
		}else{

			$id = $this->session->userdata('admin');
			$country = $this->input->post('country');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$borough = $this->input->post('borough');
			$zip = $this->input->post('zip');

			if (empty($id) || empty($country) || empty($state) || empty($city) || empty($borough) || empty($zip)) {
				redirect('admin/become_a_host_location');
			}else{
				$insert_host = array(
					'userid' => $id, 
					'country' => $country, 
					'state' => $state, 
					'city' => $city, 
					'borough' => $borough,
					'zip' => $zip 
				);
				$this->db->insert('host', $insert_host);
				redirect('admin/become_a_host_info');
			}
		}
	}



}
?>
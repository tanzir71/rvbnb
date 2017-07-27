<?php

class Home extends CI_Controller{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");

		$this->load->database();
		$this->load->model('user_model');
	
	}
	public function index(){

		$data['title'] = 'RVbnb | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('home/index');
		$this->load->view('home/home_page');
		$this->load->view('home/footer');		 
	}
	public function location_data(){
		$location = $this->input->post('input_data');
		$from_date = $this->input->post('from');
		$to_date = $this->input->post('to');


		$result['final'] = $this->user_model->anyQueryApply($location,$from_date,$to_date);

		

		echo json_encode($result);
	}

	public function autocomplete_view()
	{		
		
		$this->load->database();	
		
		$id=$this->input->post('id');
		
		$this->db->like('location', $id); 
		$info=$this->db->get('host');

		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['location']);
		}
		echo json_encode($data);	
		
	}


	public function host_rv($id, $title){

		$title = $this->user_model->title_apply($id);

		$data['title'] = $title;

		$data['id'] = $id;
		$data['title'] = $title;

		if ($title=='') {
			redirect('home');
		}else{
			$this->load->view('home/header',$data);
			$this->load->view('home/host_rv',$data);
			$this->load->view('home/footer');		
		}
		 
	}


	public function signup(){

		$this->load->library('form_validation');      
        $this->form_validation->set_rules('name',  'name',  'required');
        $this->form_validation->set_rules('email',  'email',  'required');
        $this->form_validation->set_rules('password',  'Password',  'required|min_length[1]');
        $this->form_validation->set_rules('confirm_password',  'Password',  'required|min_length[1]');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('home');
		}else{

			$name = $this->input->post('name');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$email = $this->input->post('email');

			if (empty($name) || empty($password) || empty($confirm_password) || empty($email)) {
				redirect('home');
			}else{
				$name_ch = $this->user_model->user_check($name);
				if ($name_ch==0) {
					redirect('home');
				}else{

					if ($password == $confirm_password) {
						$user_add = array(
							'user' => $name, 
							'password' => $confirm_password, 
							'email' => $email, 
						);
						$this->db->insert('alluser', $user_add);
						

						$data = array(
						'name' => $name,
						'pass' => $confirm_password
						);
				
						$this->db->where('user', $data['name']);
						$query = $this->db->get("alluser");
						$row = $query->row();
				
				
				 		if($row->password == $data['pass'])
						{
							$this->session->set_userdata('admin', $row->id);
							
							session_start();
							$session_id = session_id( );
							
							$da=array(
								"session" => $session_id
							);
													
							
							$this->db->where('id',$row->id);
							$this->db->update('alluser',$da);

							redirect('admin');
						
						}


					}else{
						redirect('home');
					}
				}
			}


		}
	}


	



}
?>
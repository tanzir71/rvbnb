<?php
class Member extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');

	}

	
	
	function adminlogin1()
	{
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->helper('form');
		$this->load->library('form_validation');      
        $this->form_validation->set_rules('name',  'name',  'required');
        $this->form_validation->set_rules('password',  'Password',  'required|min_length[1]');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('home');
		}
		else
		{
			$this->load->database();			
				
			$data = array(
			'name' => $this->input->post('name'),
			'pass' => $this->input->post('password'),
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

				$this->session->set_userdata('session', $session_id);

				redirect('user');
			
			}


			else{

				redirect('home');
			} 
		}
	}


	function adminlogin()
	{
		$admin_user = $this->session->userdata('admin');
		if(!empty($admin_user))
		{	
			redirect('admin');
		}else{

			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
			$this->load->helper('form');
			$this->load->library('form_validation');      
	        $this->form_validation->set_rules('name',  'name',  'required');
	        $this->form_validation->set_rules('password',  'Password',  'required|min_length[1]');
	        if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('admin/login');
			}
			else
			{
				$this->load->database();			
					
				$data = array(
				'name' => $this->input->post('name'),
				'pass' => $this->input->post('password'),
				);
		
				$this->db->where('user', $data['name']);
				$query = $this->db->get("password");
				$row = $query->row();
		
		
		 		if($row->password == $data['pass'])
				{
					$this->session->set_userdata('admin', $row->id);	
					$this->session->set_userdata('type', $row->type);	
					$this->session->set_userdata('wire', $row->ware);
				
					if(!empty($row->ware)){
						
						$this->db->where('id', $row->ware);
						$querys = $this->db->get("ware");
						$rows = $querys->row();					
						$this->session->set_userdata('barcode', $rows->barcode);
					}
					
					session_start();
					$session_id = session_id( );
					
					$da=array(
						"session" => $session_id
					);
											
					
					$this->db->where('id',$row->id);
					$this->db->update('password',$da);

					redirect('admin');
				
				}


				else{

					$this->load->view('admin/login');
				} 
			}
		}
		
	}
	







}
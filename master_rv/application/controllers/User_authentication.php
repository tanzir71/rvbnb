<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct() {
		parent::__construct();
		
		// Load facebook library
		$this->load->library('facebook');
		//Load user model
		$this->load->model('user');
        $this->load->database();
    }
    
    public function index(){


        $userData = array();
		// Check if user is logged in
		if($this->facebook->is_authenticated()){
			// Get user facebook profile details
			$userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture.width(800).height(800)');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['fname'] = $userProfile['first_name'];
            $userData['lname'] = $userProfile['last_name'];

            //$userData['email'] = $userProfile['email'];

            if(!empty($userProfile['email'])){
            	$userData['email'] = $userProfile['email'];
            }
            
            //$data['sohel'] = $this->facebook->getFriendList(); //my editing


            $userData['gender'] = $userProfile['gender'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
			
            // Insert or update user data
            $userID = $this->user->checkUser($userData);

            $this->db->where('id',$userID);
            $this->db->where('status',2);
            $query = $this->db->get('alluser');
            if ($query->num_rows()>0) {
                redirect('home');
            }else{
                $up_status = array('status' => 1 );
                $this->db->where('id',$userID);
                $up_query = $this->db->update('alluser',$up_status);


                //reserved code
                if(!empty($userID)){
                    $data['userData'] = $userData;
                    $this->session->set_userdata('userData',$userData);

                    $this->session->set_userdata('airbnb', $userID); //my set user id
                    $session_id = session_id();
                    $this->session->set_userdata('session', $session_id);
                    $this->session->set_userdata('user', 'user');

                } else {
                   $data['userData'] = array();
                }
                
                // Get logout URL
                $data['logoutUrl'] = $this->facebook->logout_url();


            }
		}else{
            $fbuser = '';
			
			// Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }
		
		// Load login & profile view
        //$this->load->view('user_authentication/index',$data);
        redirect('user');
    }
/*
	public function logout() {
		// Remove local Facebook session
		$this->facebook->destroy_session();
		// Remove user data from session
		$this->session->unset_userdata('userData');
		// Redirect to login page
        redirect('user_authentication');
    }
*/


}

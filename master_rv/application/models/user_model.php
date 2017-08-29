<?php


class User_Model extends CI_Model{
	
	
	public function __construct()
	{
		$this->load->database();
	}


    public function getPname($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null)
    {

        
        
        $this->db->where($col,$id);
        if(!empty($col2))
            $this->db->where($col2,$id2);
        if(!empty($col3))
            $this->db->where($col3,$id3);
        
        $info=$this->db->get($table);
        
        foreach($info->result_array() as $val){
            
            
            return $val[$name];
            
        }
        
        
        
    }
    public function anyName($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null){
        
        
        
        $w = $this->session->userdata('wire');
        
        
        if(!empty($col2)){
            
                    $this->db->where($col2,$id2);   

        }
        if(!empty($col3)){
            
                    $this->db->where($col3,$id3);   

        }
        
    $this->db->where("(ware='".$w."' OR ware='0')");

    
    
        $this->db->where($col,$id);
        $info=$this->db->get($table);
        foreach($info->result_array() as $val){
            
            return $val[$name];
            
        }
    }

    //my web application model database query start

    
	public function anyQueryApply($location,$from_date){

        $this->db->join('host', 'files.hostid = host.id', 'left');

		if(!empty($location)){
            $this->db->like('host.city',$location);
        }


        if(!empty($from_date)){
            $this->db->where('host.to_date >=', $from_date);
            $this->db->where('host.from_date <=', $from_date);
        }

         $this->db->where('host.reviews',1);
         $this->db->where('host.status',1);

        $this->db->group_by('files.hostid', 'desc');
		$query = $this->db->get("files");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function title_apply($id){
		$this->db->where('id',$id);
		$query = $this->db->get("host");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->title;            
        }
	}

	public function user_check($name){
		$this->db->where('user',$name);
		$query = $this->db->get("alluser");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return 0;            
        }else{
        	return 1;
        }
	}

    public function user_all_data($id){
        $this->db->where('id', $id);
        $query = $this->db->get("alluser");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }
        return false;
    }


    public function host_history($id){
        $this->db->where('reviews', '1');
        $this->db->where('userid', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("host");
        return $query;
    }


    public function host_data_check($user_id,$user_session){
        $this->db->where('userid', $user_id);
        $this->db->where('session', $user_session);
        $this->db->where('reviews', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get("host");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }
        return false;
    }
    
    
    public function insert($data = array()){
        $insert = $this->db->insert_batch('files',$data);
        return $insert?true:false;
    }//multiple images upload


    public function get_host_by_data($hostid, $userid,$table){
        $this->db->where('hostid', $hostid);
        $this->db->where('userid', $userid);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table);
        return $query;
    }
    public function get_host_by_delete($hostid, $userid,$table){
        $this->db->where('hostid', $hostid);
        $this->db->where('userid', $userid);
        $query = $this->db->delete($table);
        return $query;
    }

    public function get_user_email_phone($id){
        $this->db->where('id', $id);
        $query = $this->db->get("alluser");
        return $query;
    }


    //park host
    public function get_host($id){
        $this->db->where('id', $id);
        $query = $this->db->get("host");
        return $query;
    }

    public function host_approval(){
        $this->db->where('status', 0);
        $this->db->where('reviews', 1);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("host");
        return $query;
    }
    public function host_success(){
        $this->db->where('status', 1);
        $this->db->where('reviews', 1);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("host");
        return $query;
    }

    public function get_host_by_alluser_data($userid,$table){
        $this->db->where('id', $userid);
        $query = $this->db->get($table);
        return $query;
    }

    public function host_user_details($id){
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get("alluser");
        return $query;
    }


    public function all_search_user($id,$email,$status,$table){

        if(!empty($id)){
            $this->db->where('id',$id);
        }

        if(!empty($email)){
            $this->db->where('email',$email);
        }

        if($status !== ' '){
            $this->db->where('status',$status);
        }

        $this->db->order_by('id','desc');
        $query = $this->db->get($table);

        return $query->result_array();

    }


    public function allhost_search($state,$city,$location,$status,$table){

        if(!empty($state)){
            $this->db->where('state',$state);
        }

        if(!empty($city)){
            $this->db->where('city',$city);
        }

        if(!empty($location)){
            $this->db->where('location',$location);
        }

        if($status !== ' '){
            $this->db->where('status',$status);
        }

        $this->db->where('reviews',1);
        $this->db->order_by('id','desc');
        $query = $this->db->get($table);

        return $query->result_array();

    }

    public function admin_inbox_list(){
        $this->db->where('id1', 0);
        $this->db->where('root', 0);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get("inbox");
        return $query;
    }

	
	public function inbox_messege($id){

        $this->db->join('inbox', 'alluser.id = inbox.id2', 'left');


        $this->db->where('inbox.root',$id);
        $query = $this->db->get("alluser");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return 2;
    }

    public function inbox_messege2($id){

        $this->db->join('inbox', 'alluser.id = inbox.id1', 'left');


        $this->db->where('inbox.root',$id);
        $query = $this->db->get("alluser");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return 2;
    }
	//admin panel end

    public function user_inbox_list($id){
        $this->db->where('id2', $id);
        $this->db->where('root', 0);
        $query = $this->db->get("inbox");
        return $query;
    } //user reciever

    public function user_inbox_list_sender($id){
        $this->db->where('id1', $id);
        $this->db->where('root', 0);
        $query = $this->db->get("inbox");
        return $query;
    } //user sender

    public function admin_user_inbox($id2){
        $this->db->where('id1', 0);
        $this->db->where('id2', $id2);
        $this->db->where('root', 0);
        $query = $this->db->get("inbox");
        return $query;
    } //admin


    public function find_id_by_email($email){
        $this->db->where('email', $email);
        $query = $this->db->get("alluser");
        $row_data = $query->row();
        return $row_data->id;
    }

    public function chk_id_by_email($id2){
        $this->db->where('id1', 0);
        $this->db->where('id2', $id2);
        $query = $this->db->get("inbox");
        return $query;
    }
    public function chk_id_by_email_user($id2){
        $this->db->where('id1', $this->session->userdata('airbnb'));
        $this->db->where('id2', $id2);
        $query = $this->db->get("inbox");
        return $query;
    }
    public function chk_id_by_email_user2($id2){
        $this->db->where('id2', $this->session->userdata('airbnb'));
        $this->db->where('id1', $id2);
        $query = $this->db->get("inbox");
        return $query;
    }


    public function get_booking_user($m_id,$table){
        $this->db->where('id', $m_id);
        $this->db->where('status', 1);
        $query = $this->db->get($table);
        return $query;
    } //admin

    public function get_booking_user_f($m_id,$table){
        $this->db->where('hostid', $m_id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get($table);
        return $query;
    } //admin


    
}
?>
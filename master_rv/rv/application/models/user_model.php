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



    
	public function anyQueryApply($location,$from_date,$to_date){

		if(!empty($location))		
        $this->db->like('location',$location);


        if(!empty($from_date) && !empty($to_date)){
            $this->db->where('to_date >=', $from_date);
            $this->db->where('to_date <=', $to_date);
        }


        $this->db->order_by('id', 'desc');
		$query = $this->db->get("host");

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


    public function host_data_check($user_id,$user_session){
        $this->db->where('userid', $user_id);
        $this->db->where('session', $user_session);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get("host");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }
        return false;
    }


	
	
	
}
?>
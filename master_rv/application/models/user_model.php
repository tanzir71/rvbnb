<?php


class User_Model extends CI_Model{
	
	
	public function __construct()
	{
		$this->load->database();
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
	
	
	
}
?>
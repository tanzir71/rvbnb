<?php


class Trans extends CI_Model{
	
	
	public function __construct()
	{
		$this->load->database();
	}


	public function bill_count($ware) {
		$this->db->where('ware',$ware);
        return $this->db->count_all("bill");
    }

    public function fetch_bill($limit, $start, $ware) {

		$this->db->where('ware',$ware);
		
        $this->db->limit($limit, $start);
        //$this->db->order_by('dated','desc');
		$this->db->order_by('id','desc');
        $query = $this->db->get("bill");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function pay_count($ware) {
		$this->db->where('ware',$ware);
        return $this->db->count_all("payment");
    }

   public function fetch_pay($limit, $start, $ware) {

		$this->db->where('ware',$ware);
		
        $this->db->limit($limit, $start);
        //$this->db->order_by('dated','desc');
		$this->db->order_by('id','desc');
        $query = $this->db->get("payment");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

    public function pay_amount($dated) {

   		$this->db->select_sum("amount");
		$this->db->where('ware',$this->session->userdata('wire'));
        $this->db->where('dated',$dated);
        $this->db->where('status !=', 3);
        $query = $this->db->get("payment");

        if ($query->num_rows() > 0) {            
            return $query->row()->amount;;
        }
        return false;
    }
    public function pay_amount_status($dated) {

        $this->db->select_sum("amount");
        $this->db->where('ware',$this->session->userdata('wire'));
        $this->db->where('dated',$dated);
        $this->db->where('status',1);
        $query = $this->db->get("payment");

        if ($query->num_rows() > 0) {            
            return $query->row()->amount;;
        }
        return false;
    }

    public function anyone_check($table,$col_check,$col_value,$ware,$name){

        $this->db->where('ware',$ware);
        $this->db->where($col_check,$col_value);
        $query = $this->db->get($table);
        if ($query->num_rows()>0) {
            $rows = $query->row();
            return $rows->$name;
        }

    }

    public function max_count($ware) {
        $this->db->where('ware',$ware);
        return $this->db->count_all("max_pay");
    }
    public function fetch_max($limit, $start, $ware) {

        $this->db->where('ware',$ware);
        
        $this->db->limit($limit, $start);
        $this->db->order_by('dated','desc');
        //$this->db->order_by('id','desc');
        $query1 = $this->db->get("max_pay");

        if ($query1->num_rows() > 0) {
            foreach ($query1->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

    public function search_bill_report($supp_id, $start_dated, $end_dated, $status, $pay_date){

        $this->db->join('bill', 'supplier.id = bill.supp_id');

        $this->db->where('bill.ware',$this->session->userdata('wire'));

        if(!empty($supp_id))
            $this->db->where('bill.supp_id',$supp_id);

        if($status !== '')
            $this->db->where('bill.status',$status);

        if(!empty($pay_date))
            $this->db->where('bill.pay_date',$pay_date);

        if(!empty($start_dated) && !empty($end_dated)){
            $this->db->where('dated >=', $start_dated);
            $this->db->where('dated <=', $end_dated);
        }


        $this->db->order_by('bill.id','desc');
        

        $query = $this->db->get('supplier');
        if ($query->num_rows()>0) {
            return $query->result_array();
        }
        return false;

    }

    public function search_payment_report($bank_name, $start_dated, $end_dated, $status, $for_status, $bill_id){

        $this->db->where('ware',$this->session->userdata('wire'));
        
        if(!empty($bank_name)){
            $ex_b = explode('*', $bank_name);
            $bank_id = $ex_b[1];

            $this->db->where('bank_id',$bank_id);
        }

        

        if($status !== 'none')
            $this->db->where('status',$status);

        if($for_status !== 'none')
            $this->db->where('forw_status',$for_status);

        if(!empty($bill_id))
            $this->db->where('bill_id',$bill_id);

        if(!empty($start_dated) && !empty($end_dated)){
            $this->db->where('check_date >=', $start_dated);
            $this->db->where('check_date <=', $end_dated);
        }

        $this->db->order_by('id','desc');


        $query1 = $this->db->get('payment');
        if ($query1->num_rows() > 0) {
            foreach ($query1->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }




    public function supplier_count($ware) {
        $this->db->where('ware',$ware);
        return $this->db->count_all("supplier");
    }

    public function fetch_supplier($limit, $start, $ware) {

        $this->db->where('ware',$ware);
        
        $this->db->limit($limit, $start);
        $this->db->order_by('id','desc');
        $query = $this->db->get("supplier");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }


    public function bank_count($ware) {
        $this->db->where('ware',$ware);
        return $this->db->count_all("bank");
    }

    public function fetch_bank($limit, $start, $ware) {

        $this->db->where('ware',$ware);
        
        $this->db->limit($limit, $start);
        $this->db->order_by('id','desc');
        $query = $this->db->get("bank");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	
	
}
?>
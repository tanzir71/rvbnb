<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Stripe/lib/Stripe.php');

class Payment extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('stripe/paymentmodel', 'payment');
    }
	
	public function index(){
		$this->load->view('stripe/index');
	}
	
	public function process(){
        $m_id = $this->input->post('m_id');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');


        $hostid = $this->input->post('hostid');
        $this->db->where('id',$hostid);
        $query = $this->db->get('host');
        $row_amount = $query->row();
        $db_amount = $row_amount->amount;

        $date1=date_create($from_date);
        $date2=date_create($to_date);
        $diff=date_diff($date1,$date2);
        $total_day = $diff->format("%a");

        $amount = $total_day*$db_amount*100;



        //$amount = $row_amount->amount*100;

        


        $card_number = $this->input->post('card_number');
        $ex_mm = $this->input->post('ex_mm');
        $ex_yy = $this->input->post('ex_yy');
        $cvc = $this->input->post('cvc');
        $zip = $this->input->post('zip');


		try {
            Stripe::setApiKey('sk_test_nf0WyOczHZgKplTMOv548csi');
            $charge = Stripe_Charge::create(array(
                "amount" => $amount,
                "currency" => "USD",
                "card" => $this->input->post('access_token'),
                "description" => "Stripe Payment"
            ));
            // this line will be reached if no error was thrown above
            $data = array(
                'payment_id' => $charge->id,
                'payment_status' => 'success',
                'hostid' => $hostid,

                'status' => 1,
                'total' => $amount,

                'm_userid' => $m_id,
                'from_date' => $from_date,
                'to_date' => $to_date,

                'card_number' => $card_number,
                'ex_mm' => $ex_mm,
                'ex_yy' => $ex_yy,
                'cvc' => $cvc,
                'zip' => $zip,

                'created_on' => date('Y-m-d H:i:s'),
                'updated_on' => date('Y-m-d H:i:s')
            );
            $response = $this->payment->insert($data);
            if ($response) {
                echo json_encode(array('status' => 200, 'success' => 'Payment successfully completed.'));
                exit();
            } else {
                echo json_encode(array('status' => 500, 'error' => 'Something went wrong. Try after some time.'));
                exit();
            }
        } catch (Stripe_CardError $e) {
            echo json_encode(array('status' => 500, 'error' => STRIPE_FAILED));
            exit();
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            echo json_encode(array('status' => 500, 'error' => $e->getMessage()));
            exit();
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            echo json_encode(array('status' => 500, 'error' => AUTHENTICATION_STRIPE_FAILED));
            exit();
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            echo json_encode(array('status' => 500, 'error' => NETWORK_STRIPE_FAILED));
            exit();
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            echo json_encode(array('status' => 500, 'error' => STRIPE_FAILED));
            exit();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            echo json_encode(array('status' => 500, 'error' => STRIPE_FAILED));
            exit();
        }
	}



    
}
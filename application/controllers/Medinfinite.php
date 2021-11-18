<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Medinfinite extends CI_Controller {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common_model');
		//error_reporting(0);
	
	}

	public function reservation(){ 

		//$this->client_request = new stdClass();
		$this->client_request = json_decode(file_get_contents('php://input', true));
		//$this->client_request = json_decode(json_encode($this->client_request), true);

		$array = json_decode(json_encode($this->client_request), true);
		//

		//$user1[0]=$this->client_request;
		$user=$array[0];
		//echo '<pre>';print_r($this->client_request);
		//echo '<pre>';print_r($array[0]);

		$post_data=array(
							'name' => $user['name'],
						    'email' => $user['email'],
						    'phone'=>  $user['phone'],
						    'college_name'=> $user['college_name'],
						    'year_of_study'=> $user['year_of_study'],
						    'member_id'=> $user['member_id'],
						    'ima_member'=> $user['ima_member'],
						    'event'=>$user['event'],
						    'food'=>json_encode($user['food']),
						    'accomodation'=>json_encode($user['accomodation']),
						    'created_on'=>date('Y-m-d H:i:s')
		                );
		//echo '<pre>';print_r($post_data);
		$this->db->insert('medinfinite_users',$post_data);
		//echo $this->db->last_query();exit;
		$insert_id=$this->db->insert_id();
		//$response = array('status' => true, 'message' => 'User register Successfully', 'user_id'=>$insert_id);
		echo $insert_id;

		//redirect('medinfinite/payment/'.$insert_id, 'refresh');
	}

	public function checkout($user_id){

	 $data['user_data']=$this->common_model->get_table_row('medinfinite_users',array('id'=>$user_id),array());

	 $this->load->view('medinfinite_checkout',$data);
	}

	public function payment($user_id){

		//echo 'srinivas'.$user_id;exit;

	$data['user_data']=$this->common_model->get_table_row('medinfinite_users',array('id'=>$user_id),array());
	$receipt_id=getDynamicId('receipt_no','RECPT');

	$paid_amt=1;

    $payment_insert_id=$this->payment_model->medinfiniteUpdatePaymentOrder($user_id,$receipt_id,$paid_amt);
    if($payment_insert_id !=''){

    	$razorpay_order_id=$this->payment_model->makeCurlRequest($receipt_id,$paid_amt);
    	$this->payment_model->medinfiniteUpdateRazorPayOrderId($razorpay_order_id,$user_id);

            if($razorpay_order_id !=''){
            $data['razorpay_order_id']=$razorpay_order_id;
            $data['total_price']=$paid_amt;
            $data['payment_id']=$user_id;
           
    		$this->load->view('medinfinite_razorpay_payment',$data);
            }else{
            $data['payment_info']=$receipt_id;
        	$this->load->view('medinfinite_razorpay_failed',$data);
            }
		}


	}

	 public function success($id){
    	$data['payment_id']=$id;
    	$this->load->view('medinfinite_razorpay_success',$data);

    }



}

?>
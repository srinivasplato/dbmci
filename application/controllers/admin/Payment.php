<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Payment extends CI_Controller {

	
	

	public function __construct()
	{
	parent::__construct();
	
	$this->load->model('admin/Payment_model','payment_model');
	$this->load->model('Common_model','common_model');
	$this->data=array();
	$this->load->library('session');
	error_reporting(0);
	}

	public function index(){

	 $user_input=$this->input->post();
	 $receipt_id=getDynamicId('receipt_no','RECPT');
     $payment_insert_id=$this->payment_model->createPaymentOrder($user_input,$receipt_id);
     $data['user_data']=$this->common_model->get_table_row('students_before_admissions',array('id'=>$user_input['row_id']),array());
    $data['batch']=$this->common_model->get_table_row('batchs',array('id'=>$data['user_data']['batch_id']),array());
    $data['user_data']['batch_name']=$data['batch']['batch_name'];
   //echo '<pre>';print_r($data['user_data']);exit;
     $student_paid_amt=$data['user_data']['student_paid_amt'];

        if($payment_insert_id !=''){
        	$razorpay_order_id=$this->payment_model->makeCurlRequest($receipt_id,$student_paid_amt);
            $this->payment_model->updateRazorPayOrderId($razorpay_order_id,$payment_insert_id);

            if($razorpay_order_id !=''){
            $data['razorpay_order_id']=$razorpay_order_id;
            $data['total_price']=$student_paid_amt;
            $data['payment_id']=$payment_insert_id;
           
    		$this->load->view('admin/website/razorpay_manual_payment',$data);
            }
        }else{
        	$data['payment_info']=$receipt_id;
        	$this->load->view('admin/website/razorpay_failed',$data);
        }

    }

    public function success($id){
    	$data['payment_id']=$id;
    	$this->load->view('admin/website/razorpay_success',$data);

    }





}?>
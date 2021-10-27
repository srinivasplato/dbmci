<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model{


	public function createPaymentOrder($post_data,$receipt_id){

		$put_data=array(
						'complition_steps' => 3,
						'receipt_id'=>$receipt_id,
		               );

		$res=$this->db->update('students_before_admissions',$put_data,array('id'=> $post_data['row_id']));
		return $post_data['row_id'];
	}


	public function makeCurlRequest($receipt_id,$total_price){

    $payment_keys=$this->db->query("select * from payment_gateway where id='1'")->row_array();
    $api_key=$payment_keys['key'];
    $api_secret=$payment_keys['secret']; 


 	    $url='https://api.razorpay.com/v1/orders';
 	    $final_price=$total_price*100;
        $razorPayRequest=array(
                            'amount'=> $final_price,
                            'currency'=> 'INR',
                            'receipt'=> $receipt_id
                           );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($razorPayRequest));
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_USERPWD, "rzp_test_BGLPFtM9zlOVDY:P6EVJZ59BYmsx1N0E6sLFGsr"); //issm test keys
        //curl_setopt($ch, CURLOPT_USERPWD, "rzp_live_aNXO7tqUxvv7rl:V0z4mq5OtX2yL8vOd3Kz7fMw"); //issm live keys

        //curl_setopt($ch, CURLOPT_USERPWD, "rzp_test_EKzZtSCRLMnLtC:Ss84oH7P5OhNAG7X1rEPVRwP"); //plato test keys

        curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$api_secret"); //plato live keys
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        curl_close($ch);
        $step1_response=json_decode($data);
        $order_info = (array) $step1_response;

        //echo '<pre>';print_r($tmp);exit;
        if(!empty($order_info)){
            $order_id=$order_info['id'];
    		}else{
    			$order_id='';
    		}

        return $order_id;
 }

 public function updateRazorPayOrderId($razorpay_order_id,$payment_insert_id){
 		$update_data=array(
 							'razorpay_order_id'=>$razorpay_order_id,
 							'payment_status'=>'order_created',
 		                  );
 		$this->db->where('id',$payment_insert_id);
 		$result=$this->db->update('students_before_admissions',$update_data);
 		return $result;	
 }

}

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Medinfinite extends CI_Controller {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common_model');
		//error_reporting(0);
	
	}

	public function reservation(){ 

		$this->client_request = new stdClass();
		$this->client_request = json_decode(file_get_contents('php://input', true));
		$this->client_request = json_decode(json_encode($this->client_request), true);


		//

		$this->client_request;

		//echo '<pre>';print_r($this->client_request);
		echo '<pre>';print_r($_POST);exit;

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
		$this->db->insert('medinfinite_users',$post_data);
		//echo $this->db->last_query();exit;
		$insert_id=$this->db->insert_id();
		//$response = array('status' => true, 'message' => 'User register Successfully', 'user_id'=>$insert_id);
		echo $insert_id;
	}



}

?>
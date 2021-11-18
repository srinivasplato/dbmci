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


		echo '<pre>';print_r($this->client_request);exit;
	}



}

?>
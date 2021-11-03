<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Script extends CI_Controller {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common_model');
	
	}

	public function save_receipts(){

		
		$query="select id,receipt_id,receipt_pdf_path from tbl_student_payment_details";

		$receipts=$this->db->query($query)->result_array();

		foreach($receipts as $key=>$value){

			if($key  <= 10){
			    $this->common_model->save_pdf($value['receipt_id'],'');
			  }
		}

		

	}



}

?>
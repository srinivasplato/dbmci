<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Payment_approvals extends CI_Controller {


	public $list_payments_Page='admin/payment_approvals/list_payments_approvals';
	public $payment_buttons_Page='admin/payment_approvals/payment_buttons';
	public $payment_edit_Page='admin/payment_approvals/edit_payment';
	

	public $header_page= 'admin/includes/header';
	public $footer_Page= 'admin/includes/footer';
	public $leftMenu='admin/includes/left_menu';




	public function __construct()
	{
	parent::__construct();
	
	$this->load->model('admin/Payment_approvals_model','my_model');
	$this->load->model('Common_model','common_model');
	checkAdminLogin();
	 if($this->session->userdata('user_id') != 'ADM0001'){
	 $this->data['roleResponsible'] = $this->common_model->get_responsibilities();
     }else{
	 $this->data['roleResponsible'] = $this->common_model->get_default_responsibilities();
	 }

	// echo '<pre>';print_r($this->data['roleResponsible']);exit;
	}

	public function index(){

		$this->setHeaderFooter($this->payment_buttons_Page,$this->data);
	}

	public function payments($type){		
				 
		 $this->data['type']=$type;
         $this->setHeaderFooter($this->list_payments_Page,$this->data);
         
	}

	public function all_records(){

		$records = $this->my_model->all_records($_POST);

        $result_count=$this->my_model->all_records($_POST,1);

        $json_data = array(

            "draw"  => intval($_POST['draw'] ),

            "iTotalRecords"  => intval($result_count ),

            "iTotalDisplayRecords"  => intval($result_count ),

            "recordsFiltered"  => intval(count($records) ),

            "data"  => $records);  

        echo json_encode($json_data);

	}

	public function change_status($user_id,$status,$type)
	{
		if($this->my_model->change_status($user_id, $status) == true)
		{
			$this->session->set_flashdata('success', 'Status Updated Successfully.');
		}
		else
		{
			$this->session->set_flashdata('fail', 'Error in Updating.');
		}
		redirect('admin/payment_approvals/payments/'.$type, 'refresh');
	}

	public function delete_payment($id){
		
		if($this->my_model->delete_payment($id) == true)
		{
			$this->session->set_flashdata('success', 'Record has been Deleted Successfully.');
		}
		else
		{
			$this->session->set_flashdata('fail', 'Error in Deleting.');
		}
		redirect('admin/payment_approvals', 'refresh');

	}

	public function payment_edit($id,$type){

		
		$this->data['type']=$type;
		$this->data['record']=$this->my_model->get_record($id);

		 $state_id=$this->data['record']['state_id'];
		 $organisation_id=$this->data['record']['organisation_id'];
		 $center_id=$this->data['record']['center_id'];
		$this->data['states']=$this->common_model->get_table('states',array('status'=>'Active'),array(),'state','asc');
		$this->data['colleges']=$this->common_model->get_table('colleges',array('state_id'=>$this->data['record']['college_state_id'],'status'=>'Active'),array(),'college_name','asc');

		$this->data['organisations']=$this->common_model->get_table('organisations',array('state_id'=>$this->data['record']['state_id'],'status'=>'Active'),array(),'organisation_name','asc');

		$this->data['centers']=$this->common_model->get_table('centers',array('state_id'=>$this->data['record']['state_id'],'organisation_id'=>$this->data['record']['organisation_id'],'status'=>'Active'),array(),'center','asc');

		$this->data['payments']=$this->common_model->get_table('payment_modes',array('state_id'=>$this->data['record']['state_id'],'organisation_id'=>$this->data['record']['organisation_id'],'center_id'=>$this->data['record']['center_id'],'status'=>'Active'),array(),'payment_mode','asc');
		$this->data['courses']=$this->common_model->get_table('courses',array('state_id'=>$state_id,'organisation_id'=>$organisation_id,'center_id'=>$center_id,'course_type'=>'admin','status'=>'Active'),array(),'id','desc');
		$this->data['batchs']=$this->common_model->get_table('batchs',array('course_id'=>$this->data['record']['course_id'],'status'=>'Active'),array(),'batch_name','asc');
		$this->data['student_data']=$this->common_model->get_table_row('students',array('id'=>$this->data['record']['student_id']),array('room_no','cabin_no'));

		$this->setHeaderFooter($this->payment_edit_Page,$this->data);
	

	}
	/*-----------start setting header and footer --------------*/

	public function setHeaderFooter($view, $data)
	{
		$this->load->view($this->header_page, $data);
		$this->load->view($this->leftMenu, $data);
		$data['message']=$this->load->view('admin/includes/message',$data,TRUE);
		$this->load->view($view, $data);
		$this->load->view($this->footer_Page);
	}
  /*----------- stop setting header and footer --------------*/




}

?>
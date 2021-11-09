<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Total_batches extends CI_Controller {

	
	public $batches_list_Page='admin/total_batches/total_batches_list';
	public $batch_students_Page='admin/total_batches/list_batch_students';

	public $header_page= 'admin/includes/header';
	public $footer_Page= 'admin/includes/footer';
	public $leftMenu='admin/includes/left_menu';



	public function __construct()
	{
	parent::__construct();
	
	$this->load->model('admin/Total_batches_model','my_model');
	$this->load->model('Common_model','common_model');
	checkAdminLogin();
	 if($this->session->userdata('user_id') != 'ADM0001'){
	 $this->data['roleResponsible'] = $this->common_model->get_responsibilities();
     }else{
	 $this->data['roleResponsible'] = $this->common_model->get_default_responsibilities();
	 }
	}

	public function total_batches_list(){

		$this->data['batch_wise_students']=$this->my_model->batch_wise_students_count();
		$this->setHeaderFooter($this->batches_list_Page,$this->data);

	}

	public function batch_wise_students($batch_id){

		
		$this->data['batch_id']=$batch_id;
		$this->data['batch_data']=$this->common_model->get_table_row('batchs',array('id'=>$batch_id),array());
		$this->setHeaderFooter($this->batch_students_Page,$this->data);
	}

	public function all_batch_students(){
		
		$records = $this->my_model->all_batch_students($_POST);

        $result_count=$this->my_model->all_batch_students($_POST,1);

        $json_data = array(

            "draw"  => intval($_POST['draw'] ),

            "iTotalRecords"  => intval($result_count ),

            "iTotalDisplayRecords"  => intval($result_count ),

            "recordsFiltered"  => intval(count($records) ),

            "data"  => $records);  

        echo json_encode($json_data);
	}

	public function download_batch_students($batch_id){
       $query = $this->my_model->download_batch_students($batch_id);
       //echo $query;exit;
       $this->load->helper('csv');
       query_to_csv($query, TRUE, "all_batch_students".'-'.date("m-d-Y H:i:s").'.csv');
    }

    public function insert_remarks(){

    	//echo '<pre>';print_r($_POST);exit;
    	$batch_id=$this->input->post('batch_id');
    	$student_id=$this->input->post('student_id');

    	$batch_data=$this->common_model->get_table_row('batchs',array('id'=>$batch_id),array());

    	$remarks_data=array(
    				'state_id'=> $batch_data['state_id'],
    				'organisation_id'=>$batch_data['organisation_id'],
    				'center_id'=>$batch_data['center_id'],
    				'course_id'=>$batch_data['course_id'],
    				'batch_id'=> $batch_id,
    				'student_id'=>$student_id,
    				'remarks'=>$this->input->post('remarks'),
    				'created_by'=>$this->session->userdata('user_id'),
    				'created_on'=>date('Y-m-d H:i:s')
    				);
    	//echo '<pre>';print_r($remarks_data);exit;
    	$res=$this->db->insert('student_remarks',$remarks_data);

    	if($res){
		$this->session->set_flashdata('success', 'Record Added Successfully.');
		
			}else{
		$this->session->set_flashdata('error', 'Record Added Failed!...');
			}
		redirect('admin/total_batches/batch_wise_students/'.$batch_id, 'refresh');


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
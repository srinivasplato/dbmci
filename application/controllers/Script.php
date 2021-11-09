<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Script extends CI_Controller {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','common_model');
		error_reporting(0);
	
	}

	public function save_receipts(){

		
		$query="select id,receipt_id,receipt_pdf_path from tbl_student_payment_details";

		$receipts=$this->db->query($query)->result_array();

		foreach($receipts as $key=>$value){

			if($key  <= 10){
			    $this->save_pdf($value['receipt_id'],'');
			  }
		}

		echo 'done';exit;

		

	}


	public function save_pdf($receipt_id,$previous_payment){ 
         $path=''; $full_path='';

         //load mPDF library
         $this->load->library('M_pdf'); 
         //now pass the data//
         $data=array();
        
         $data['payment_data']= $this->getStudentPaymentRecord($receipt_id);
         $data['student_data']['course_name']=$data['payment_data']['course_name'];
         $data['student_data']['batch_name']=$data['payment_data']['batch_name'];

          //echo '<pre>';print_r($data['student_data']);exit;

         $html=".html";
         $receipt_id.$html =$this->load->view('admin/paymentportal/payment_nonbhatia_pdf',$data, true); //load the pdf.php by passing our data and get all data in $html varriable.
          //echo '<pre>';print_r($data);

         //$var_html=$receipt_id.'_html';
         $pdfFilePath = $receipt_id.".pdf"; 
         $this->m_pdf->pdf->WriteHTML($receipt_id.$html);

            //download it D save F.
         $this->m_pdf->pdf->Output("./storage/paymentreceipts/".$pdfFilePath, "F");
         $path= "storage/paymentreceipts/".$pdfFilePath;
         $full_path=base_url().$path;
         //unset($var_html);
         unset($this->m_pdf);
         
         

         $update_path=array('receipt_pdf_path' => $path);
         $this->db->update('student_payment_details',$update_path,array('receipt_id' => $receipt_id));

         
         
         }

         public function getStudentPaymentRecord($receipt_id){

         	$query="SELECT stp.*,b.batch_name,c.course_name FROM tbl_student_payment_details stp INNER JOIN tbl_courses c on c.id=stp.course_id INNER JOIN tbl_batchs b on b.id=stp.batch_id where stp.receipt_id='$receipt_id' ";
         	$res=$this->db->query($query)->row_array();
         	return $res;
         }



}

?>
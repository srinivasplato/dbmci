<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Total_batches_model extends CI_Model {


	public function batch_wise_students_count(){

		$query="SELECT *,
		  (select count(id)  from tbl_students where tbl_students.batch_id=tbl_batchs.id ) as students_count,
		  (select sum(amount_paid) from tbl_student_payment_details tspt where tspt.amount_from='1' and tspt.approval_status='Approved' and  tspt.batch_id=tbl_batchs.id) as paid_amount,
		  (select sum(due_amount) from tbl_student_payment_details tspt where tspt.amount_from='1' and tspt.approval_status='Approved' and  tspt.batch_id=tbl_batchs.id) as due_amount
		   FROM tbl_batchs where status='active' ";
 			//echo $query;exit;
		$result=$this->db->query($query)->result_array();

		return $result;
	}

}

?>
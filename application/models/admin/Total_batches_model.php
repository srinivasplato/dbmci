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

	public function all_batch_students($pdata, $getcount=null)
    {
    	// $res=$this->db->select('*')->from('batchs')->order_by('id','desc')->get()->result_array();
    	  //echo '<pre>';print_r($res);exit; 
        $columns = array
        (
            0 => 'student_mobile',
            1 => 'student_name',
            2 => 'student_dynamic_id',
            3 => 'admission_no',
            4 => 'batch_name',
            5 => 'course_name',
        );
        $search_1 = array
        (
             1 => 'students.student_mobile',
             2 => 'students.student_name',
             3 => 'students.student_dynamic_id',
             4 => 'students.admission_no',
             5 => 'batchs.batch_name',
             6 => 'courses.course_name',
            
        );        
        if(isset($pdata['search_text_1'])!="")
        {
            $this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text_1'], $pdata['search_at_1'] );
        }
        if($getcount)
        {
            return $this->db->select('students.id')
            ->from('students')
            ->join('courses','courses.id=students.course_id','left')
            ->join('batchs','batchs.id=students.batch_id','left')

            ->where('students.batch_id',$pdata['batch_id'])

            ->order_by('students.created_on','desc')->get()->num_rows();
        }
        else
        {
        $this->db->select('students.*,courses.course_name,batchs.batch_name,(select IFNULL(sum(amount_paid),0) from tbl_student_payment_details where tbl_student_payment_details.student_id=tbl_students.id) as total_paid_amount,(select IFNULL(sum(due_amount),0) from tbl_student_payment_details where tbl_student_payment_details.student_id=tbl_students.id) as total_due_amount')
        ->from('students')
        ->join('courses','courses.id=students.course_id','left')
        ->join('batchs','batchs.id=students.batch_id','left')
        ->where('students.batch_id',$pdata['batch_id'])
        ->order_by('students.created_on','desc');
        }
        if(isset($pdata['length']))
        {
            $perpage = $pdata['length'];
            $limit = $pdata['start'];
            $generatesno=$limit+1;
            $orderby_field = $columns[$pdata['order'][0]['column'] ];   
            $orderby = $pdata['order']['0']['dir'];
            $this->db->order_by($orderby_field,$orderby);
            $this->db->limit($perpage,$limit);
        }
        else
        {
            $generatesno = 0;
        }
        $result = $this->db->get()->result_array();       
       // echo $this->db->last_query();exit;
        foreach($result as $key=>$values)
        {
            $result[$key]['sno'] = $generatesno++;           
           
        }
        return $result;
    }    


}

?>
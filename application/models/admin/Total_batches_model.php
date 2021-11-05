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
    	$batch_id=$pdata['batch_id'];
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
             1 => 'ab.student_mobile',
             2 => 'ab.student_name',
             3 => 'students.student_dynamic_id',
             4 => 'students.admission_no',
             5 => 'batchs.batch_name',
             6 => 'courses.course_name',
            
        );        
        
        if($getcount)
        {
            /*return $this->db->select('students.id')
            ->from('students')
            ->join('courses','courses.id=students.course_id','left')
            ->join('batchs','batchs.id=students.batch_id','left')

            ->where('students.batch_id',$pdata['batch_id'])

            ->order_by('students.created_on','desc')->get()->num_rows();*/

     return $this->db->query("SELECT ab.minB, ab.id,ab.student_name,ab.student_mobile,ab.student_alt_mobile,c.total_fee,c.due_date,c.discount_fee,ab.paid_amount,ab.due_amount,c.created_on as joining_date,ab.status

FROM (SELECT a.id,a.student_name,a.student_mobile,a.student_alt_mobile,a.status, MIN(b.id) AS minB,sum(amount_paid) AS paid_amount,min(b.due_amount) AS due_amount 
      FROM tbl_students a 
      LEFT JOIN tbl_student_payment_details b ON a.id = b.student_id 
      WHERE a.batch_id='$batch_id' 
      GROUP BY a.id 
     ) ab 
LEFT JOIN tbl_student_payment_details c ON ab.minB = c.id")->num_rows();

        }
        else
        {
        /*$this->db->select('students.*,courses.course_name,batchs.batch_name,(select IFNULL(sum(amount_paid),0) from tbl_student_payment_details where tbl_student_payment_details.student_id=tbl_students.id) as total_paid_amount,(select IFNULL(sum(due_amount),0) from tbl_student_payment_details where tbl_student_payment_details.student_id=tbl_students.id) as total_due_amount')
        ->from('students')
        ->join('courses','courses.id=students.course_id','left')
        ->join('batchs','batchs.id=students.batch_id','left')
        ->where('students.batch_id',$pdata['batch_id'])
        ->order_by('students.created_on','desc');*/
      
        $query="SELECT ab.minB, ab.id,ab.student_name,ab.student_mobile,ab.student_alt_mobile,c.total_fee,c.due_date,c.discount_fee,ab.paid_amount,ab.due_amount,c.created_on as joining_date,ab.status

FROM (SELECT a.id,a.student_name,a.student_mobile,a.student_alt_mobile,a.status, MIN(b.id) AS minB,sum(amount_paid) AS paid_amount,min(b.due_amount) AS due_amount 
      FROM tbl_students a 
      LEFT JOIN tbl_student_payment_details b ON a.id = b.student_id 
      WHERE a.batch_id='$batch_id' 
      GROUP BY a.id 
     ) ab 
LEFT JOIN tbl_student_payment_details c ON ab.minB = c.id";


        }
        if(isset($pdata['search_text_1'])!="")
        {
        	
        	$search_on_1=$search_1[$pdata['search_on_1']];
        	$search_text_1=$pdata['search_text_1'];
        	$query .=" WHERE $search_on_1= '$search_text_1' ";
            //$this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text_1'], $pdata['search_at_1'] );
        }
        if(isset($pdata['length']))
        {
            $perpage = $pdata['length'];
            $limit = $pdata['start'];
            $generatesno=$limit+1;
            $orderby_field = $columns[$pdata['order'][0]['column'] ];   
            $orderby = $pdata['order']['0']['dir'];
            $query .= " ORDER BY $orderby_field $orderby";

            $query .= " LIMIT $limit,$perpage";
             //echo $input;exit;
            //$this->db->order_by($orderby_field,$orderby);
            //$this->db->query->limit($perpage,$limit);

        }
        else
        {
            $generatesno = 0;
        }
        //echo $query;exit;
        $result = $this->db->query($query)->result_array();       
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($result);exit;

        foreach($result as $key=>$values)
        {
            $result[$key]['sno'] = $generatesno++;           
           
        }
        return $result;
    }    

    public function download_batch_students($batch_id){


    	$query=$this->db->query("SELECT ab.maxB,
        c.student_id,ab.student_name,ab.student_mobile,c.total_fee,c.due_date,ab.paid_amount,ab.due_amount,c.discount_fee
	 FROM (SELECT       a.id,a.student_name,a.student_mobile, MAX(b.id) AS maxB,sum(amount_paid) AS paid_amount,min(b.due_amount) as due_amount 
	       FROM         tbl_students a
	       LEFT JOIN   tbl_student_payment_details b ON a.id = b.student_id
	       WHERE a.batch_id='$batch_id'
	       GROUP BY     a.id
	      ) ab
      LEFT JOIN tbl_student_payment_details c ON ab.maxB = c.id ");
    	return $query;
    }


}

?>
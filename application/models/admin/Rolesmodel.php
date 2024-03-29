<?php
class Rolesmodel extends CI_Model
{


	/*----------Start Roles ------------*/

    public function all_roles($pdata, $getcount=null)
    {

        $columns = array
        (
        0 => 'rolename',
        );

        $search_1 = array
        (
        1 => 'rolename',
        );        
        if(isset($pdata['search_text_1'])!="")
        {
        $this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text_1'], $pdata['search_at_1'] ); 
        }
        if($getcount)
        {
        return $this->db->select('id')->from('roles')
        ->where('delete_status', '1')
        ->order_by('id','desc')->get()->num_rows();   

        //echo $this->db->last_query();exit;
        }
        else
        {
        $var=$this->db->select('*')->from('roles')
        ->where('delete_status', '1')
        ->order_by('id','desc');
        // echo $this->db->last_query();exit;
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
        foreach($result as $key=>$values)
        {
        $result[$key]['sno'] = $generatesno++;           
        }
        return $result;
    }
/** In Function Add Check Exits records for select table **/
	public function exit_details($exit_data) {
        $this->db->select("*");
		$this->db->from('roles');
		$this->db->where($exit_data);
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
    }

    /** In Function Add records for select table **/
	public function add_record(){
		foreach($this->input->post('method') as $key => $value){
			$roles_data[$key]=  implode(',',$value);
		}
		//echo '<pre>'; print_r($roles_data);exit;
		$set_data = array(
            'state_id' => $this->input->post('state_id'),
            'organisation_id' => $this->input->post('organisation_id'),
            'center_id' => $this->input->post('center_id'),
			'rolename' => $this->input->post('rolename'),
			'status' => 1,
			'created_on' => date('Y-m-d H:i:s') 
		);
		$full_data = array_merge($set_data,$roles_data);
		$result = $this->db->insert('roles', $full_data); 
		//echo $this->db->last_query();exit;
		return $result;
	}


	/*----------Start Employess ------------*/
    public function all_employees($pdata, $getcount=null)
    {

        $columns = array
        (
        0 => 'users.user_id',
        1 => 'users.user_name',
        2 => 'users.user_email',
        3 => 'users.user_mobile',
        );

        $search_1 = array
        (
        1 => 'users.user_id',
        2 => 'users.user_name',
        3 => 'users.user_email',
        4 => 'users.user_mobile',
        );        
        if(isset($pdata['search_text_1'])!="")
        {
        $this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text_1'], $pdata['search_at_1'] ); 
        }
        if($getcount)
        {
        return $this->db->select('users.id')->from('users')
        ->join('tbl_roles', 'FIND_IN_SET(tbl_roles.id, tbl_users.role_ids)', '', FALSE)        
        ->where('users.id !=', '1')
        ->group_by('users.id')
        ->order_by('users.id','desc')->get()->num_rows();   

        //echo $this->db->last_query();exit;
        }
        else
        {
        $var=$this->db->select('users.*,GROUP_CONCAT(DISTINCT tbl_roles.rolename SEPARATOR ", ") as roles')->from('users')
        ->join('tbl_roles', 'FIND_IN_SET(tbl_roles.id, tbl_users.role_ids)', '', FALSE)        
        ->where('users.id !=', '1')
        ->group_by('users.id')
        ->order_by('users.id','desc');
        // echo $this->db->last_query();exit;
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
        foreach($result as $key=>$values)
        {
        $result[$key]['sno'] = $generatesno++;           
        }
        return $result;
    }

    public function check_emp_id($table,$where,$id,$employeeID){

    	if($id != ''){

            $query='select id from '.$table.' where employee_id ="'.$employeeID.'" and id !="'.$id.'" '.$where.' and delete_status="1" ';

          // echo '<pre>';print_r($query);exit;

            $result=$this->db->query($query)->row_array();

        }else{

            $query='select id from '.$table.' where employee_id ="'.$employeeID.'" '.$where.' and delete_status="1" ';

            //echo '<pre>';print_r($query);exit;

           $result=$this->db->query($query)->row_array();

        }

       

        return $result;
    }

    public function insert_employees($data)

    {

        $result=$this->db->insert('users', $data); 

    //echo $this->db->last_query();exit;            

        return $result;

    }

    public function edit_employees()

    {

        $this->db->order_by('id', 'desc');

        $this->db->where('id', $this->uri->segment(4));

        $query = $this->db->get('users');      

        return $query->row();

    }

    public function update_employees($data, $id)

    {

        $this->db->where('id', $id);

        $result=$this->db->update('users', $data);             
//echo $this->db->last_query();exit;   
        return $result;

    }

    public function delete_employees()

    {        

        $data = array('delete_status' => '0');

        $this->db->where('id', $this->uri->segment(4));

        $result=$this->db->update('users', $data); 

        //echo $this->db->last_query();exit;            

        return $result;

    }

    public function view_employee($id){
      $result=$this->db->select('employees.*,GROUP_CONCAT(DISTINCT ag_roles.rolename SEPARATOR ", ") as roles')
      ->from('employees')
      ->join('ag_roles', 'FIND_IN_SET(ag_roles.id, ag_employees.role_ids)', '', FALSE)
      ->where('employees.id', $id)->get()
      ->row_array();
     // echo $this->db->last_query();exit;
      return  $result;
    }

    public function view_role_emp($id){
    $query="select * from ag_employees where find_in_set('".$id."',role_ids) <> 0";
    $result=$this->db->query($query)->result_array(); 
    return $result;
    }

     /*----------Stop employees ------------*/
     public function change_status($table,$user_id, $status)

    {        

        $this->db->where('id', $user_id);

        $this->db->update($table, array('status' => $status));

        if($status == "Inactive")

        {

        $message = "Your account has been put on hold. Please contact administrator.";

        //$this->send_notifications($user_id, $message);  

        }            

        return true;

    }

	/** In Function Get single records for edit view purpose from select table **/
    public function get_single_record($id) {
        $this->db->select("*");
		$this->db->from('roles');
		$this->db->where("id",$id);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
    }

    /** In Function Update records for select table **/
	public function update_record($id){
		$result = $this->empty_records($id);
		if($result){
			foreach($this->input->post('method') as $key => $value){
				$roles_data[$key]=  implode(',',$value);
			}
			$set_data = array(
                'state_id' => $this->input->post('state_id'),
                'organisation_id' => $this->input->post('organisation_id'),
                'center_id' => $this->input->post('center_id'),
				'rolename' => $this->input->post('rolename'),
				'status' => 1,
				'modified_on' => date('Y-m-d H:i:s') 
			);
			$full_data = array_merge($set_data,$roles_data);
			$this->db->where('id',$id);
			$result = $this->db->update('roles', $full_data); 
		}
		return $result;
	}
	public function empty_records($id){
		$set_data = array(
			'dashboard' => '',
            'employee_dashboard' => '',
            'daily_sheet' => '',
            'total_batches' => '',
            'my_collection' => '',
            'my_admission' => '',
			'students' => '',
            'student_payments'=> '',
            'bulk_students'=>'',
            'overview_details'=>'',
            'available_funds'=>'',
            'transfer_funds'=>'',
            'payment_approvals'=>'',
            //'general_students'=>'',
            'all_registered_students'=>'',
            'expenses'=>'',
            'expense_approval'=>'',
            'categories'=>'',
            'advance_release'=>'',
            'states'=>'',
            'organisations'=>'',
            'centers'=>'',
            'courses' => '',
            'batchs' => '',
            'attachment_groups'=>'',
			'attachments' => '',
			'payment_modes' => '',
            'colleges' => '',
            'discount_schemes' => '',
            'departments' => '',
            'in_stock' => '',
            'schedule' => '',
            'events' => '',
            'special_attendance' => '',
			'roles' => '',
			'employees' => '',			
			
		);
		$this->db->where('id',$id);
		$result = $this->db->update('roles', $set_data); 
		return $result;
	}
	

}
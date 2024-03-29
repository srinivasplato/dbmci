<!-- START BREADCRUMB -->

<!-- END BREADCRUMB -->
<!-- END PAGE TITLE -->
<!-- PAGE CONTENT WRAPPER -->
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
              <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <?php if($this->session->userdata('user_type') == 'employee'){ ?>
                <a href="<?php echo site_url();?>admin/agent_dashboard">Home</a>
                <?php } else { ?>
                <a href="<?php echo site_url();?>admin/dashboard">Home</a>
                <?php } ?>
              </li>

              
              <li class="active">Students</li>
            </ul><!-- /.breadcrumb -->

            
          </div>

<div class="page-content">
  <div class="page-header-1">
              <h1 class="col-lg-12 col-sm-4 col-md-5 col-xs-7 mbl-mgbtm-5 pdg-top-10">
                <i class="menu-icon blue fa fa-cart-arrow-down"></i>  
                <?php echo $batch_data['batch_name'];?> Students List
              </h1>
              
              <div class="pull-right ">       
                
                <a href="<?php echo base_url();?>admin/total_batches/download_batch_students/<?php echo $batch_id;?>" class="btn btn-success btn-sm" type="button"><i class="fa fa-arrow-down fa-lg"></i> Download </a>                          
                <input type="hidden" name="hiv" id="hiv" value="0" />
               </div>
          
            </div><!-- /.page-header -->

            <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter Remarks</h4>
        </div>
<?php 
      $attributes = array('class' => 'form-horizontal', 'id' => 'validation');
      echo form_open_multipart('admin/total_batches/insert_remarks', $attributes); 
      ?>
        <div class="modal-body">

          <input type="hidden" id="student_id" name="student_id" value=""></input>
          <input type="hidden" id="batch_id" name="batch_id" value=""></input>

          <div class="form-group">
              <label class="col-md-3 col-xs-12 control-label">Remarks</label>
              <div class="col-md-6 col-xs-12">
          <textarea name="remarks" value="" class="form-control" style="margin: 0px -93px 0px 0px; width: 366px; height: 147px;"></textarea>
        </div>
      </div>
    </div>

          <div class="form-group">
              
              <div class="col-md-12 col-xs-12">
          <button type="submit" class="btn btn-primary " style="margin-left:50%;text-algin:center">Submit</button>
        </div>
      </div>
    </div>

        </div>
    </from>
      </div>
    </div>
  </div>

  <div class="row" style="margin: 36px 0 0 0;">
    <div class="col-md-12">
 
      <!-- START DATATABLE EXPORT -->
      <div class="panel panel-default">
        
       <?php echo $message;?>
        <div class="panel-body">
          <div class="table-responsive">
          <div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px; z-index:99999999"><img src='<?=base_url();?>assets/img/demo_wait.gif' width="64" height="64" /></div>
            <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
            <table id="users" class="table datatable table-striped">

            <!-------- Search Form ---------->
            <form id="fees_form" name="search_fees" method="post" class="pull-right">
              <div class="col-md-3 col-md-offset-3" style="padding:0">
                  <input type="text" name="search_text_1" id="search_text_1" placeholder="Type keyword to search" class="input-sm form-control custom-input" style="margin-left:5px;">
              </div>
              <div class="col-md-2">
                  <select name="search_on_1" id="search_on_1" class="form-control input-sm custom-input">

                      <option value="1">Student Mobile</option>
                      <option value="2">Student Name</option>
                      <!-- <option value="3">Student ID</option>
                      <option value="4">Admission No</option>
                      <option value="5">Batch</option>
                      <option value="6">Course</option> -->

                  </select>
                  
              </div>
              <div class="col-md-2">
                  <select name="search_at_1" id="search_at_1" class="input-sm form-control custom-input">
                      <option value="">Contains</option>
                      <option value="after">Starts with</option>
                      <option value="before">Ends with</option>
                  </select>
                  
              </div>
              <div class="col-md-2">
              <button type="button" id="search_user" class="btn btn-info margin_search" style=""><i class="fa fa-search icon-style"></i></button>
              <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url().'admin/total_batches/batch_wise_students/'.$batch_id ?>"><li class="fa fa-minus icon-style"></li></a>
              </div>
            </form> 
            <!-------- /Search Form ---------->

            </table>                                            
          </div>
        </div>
      </div>
      <!-- END DATATABLE EXPORT -->      
    </div>
  </div>
</div>   
</div>       
</div>      
<!-- END PAGE CONTENT WRAPPER -->
<!-- <script src="<?php echo base_url();?>assets/admin/js/jquery-3.0.0.min.js"></script> -->

<script>
    var dtabel;
    var search_text_1;
    var search_on_1;
    var search_at_1;
    var ispage;
    var url = '<?php echo base_url();?>';
    var batch_id= '<?php echo $batch_id;?>';
    
  
    $(document).ready(function () {
        dtabel = $('#users').DataTable({
            "processing": true,
            "serverSide": true,
            "bStateSave": true,
            "language": {
            "emptyTable": "No Records Found!",
        },
        dom: '<"html5buttons" B>lTgtp',
        buttons: [],
        "aLengthMenu": [100,250,500],
        "destroy": true,
        "ajax": {
            "url": "<?php echo base_url('admin/total_batches/all_batch_students'); ?>",
            "type":"POST",
            beforeSend: function() {
              $("#wait").css("display", "block");
            },
            "data":function (d){
                d.search_text_1 = search_text_1;
                d.search_on_1 = search_on_1;
                d.search_at_1 = search_at_1;
                d.batch_id=batch_id;
                
            },
            "dataSrc": function ( jsondata ) {
                $("#wait").css("display", "none");
                return jsondata['data'];
            }
        },
        "columns": [
            { "title": "S.No", "name":"sno", "orderable": true, "data":"sno", "width":"0%" },
            //{ "title": "Admission No", "name":"title","orderable": false, "data":"admission_no", "width":"0%" },
            //{ "title": "Student ID", "name":"title","orderable": false, "data":"student_dynamic_id", "width":"0%" },
            //{ "title": "Course Name", "name":"title","orderable": false, "data":"course_name", "width":"0%" },
            //{ "title": "Batch Name", "name":"title","orderable": false, "data":"batch_name", "width":"0%" },
            { "title": "Student Name", "name":"title","orderable": false, "data":"student_name", "width":"0%" },
            { "title": "Mobile", "name":"title","orderable": false, "data":"student_mobile", "width":"0%" },

            { "title": "Joining Date&Time", "name":"created_on","orderable": false, "data":"joining_date", "width":"0%" },

            { "title": "Batch Fee", "name":"created_on","orderable": true, "data":"total_fee", "width":"0%" },

            { "title": "Discount", "name":"created_on","orderable": true, "data":"discount_fee", "width":"0%" },

            { "title": "Total Paid Fee", "name":"created_on","orderable": true, "data":"paid_amount", "width":"0%" },

            

            { "title": "Due Fees", "name":"created_on","orderable": true, "data":"due_amount", "width":"0%" },

            { "title": "Status", "name":"created_on","orderable": false, "data":"status", "width":"0%" },

            { "title": "Due Date", "name":"created_on","orderable": false, "data":"due_date", "width":"0%" },

            { "title": "Remarks", "name":"created_on","orderable": false, "data":"id", "width":"0%" },

            { "title": "Details", "name":"college_name","orderable": false, "data":"id", "width":"0%" },

            { "title": "View", "name":"view","orderable": false, "data":"id", "width":"0%" },

            //{ "title": "Modified Date", "name":"modified_on","orderable": false, "data":"modified_on", "width":"0%" },
            //{ "title": "Receipt Details", "name":"title","orderable": false, "data":"id", "width":"0%" },

             <?php /*if( in_array('s',$roleResponsible['students'])){?>
            { "title": "Status", "name":"action", "orderable": false, "deafultContent":"", "data": "id", "width":"0%", "class":"td_action"},
            <?php }*/ ?>

             <?php /*if( (in_array('e',$roleResponsible['students'])) || (in_array('d',$roleResponsible['students']))) {?>

            {"title": "Actions", "name":"action", "orderable": false, "deafultContent":"", "data": "id", "width":"0%", "class":"td_action"},  
            <?php }*/ ?>    
              
            
        ],
        "fnCreatedRow": function(nRow, aData, iDataIndex) 
        {           

         var mobile = '<b style="color:green">Mobile:'+aData['student_mobile'] +'</b><br><b style="color:red">Alt Mobile:'+aData['student_alt_mobile'] +'</b>';

          $(nRow).find('td:eq(2)').html(mobile);


          var batch_fee = '<b style="color:green">'+aData['total_fee'] +'</b>';

         // $(nRow).find('td:eq(4)').html(batch_fee);

        var paid_amount = '<b style="color:green">'+aData['paid_amount'] +'</b>';

        $(nRow).find('td:eq(6)').html(paid_amount);

        var due_amount = '<b style="color:red">'+aData['due_amount'] +'</b>';

        $(nRow).find('td:eq(7)').html(due_amount);


          if(aData['status'] == 'Active')
          {
            var action = '<a title="Click to Inactive" href="'+url+'admin/student/change_record_status/'+aData['id']+'/Inactive/" class="btn btn-success btn-condensed">Active</a>';
          }
          else
          {
            var action = '<a title="Click to Active" href="'+url+'admin/student/change_record_status/'+aData['id']+'/Active/" class="btn btn-danger btn-condensed">Inactive</a>';
          }

          <?php /*if( in_array('s',$roleResponsible['students'])){?>

          $(nRow).find('td:eq(10)').html(action);
          
          <?php }*/ ?>

          var remarks = '<button type="button" class="btn btn-primary" onclick="getpopup('+aData['batch_id']+','+aData['id']+')">Remarks</button>';

          $(nRow).find('td:eq(10)').html(remarks);

         var details = '<a  title="Click to details" href="'+url+'admin/student/student_receipt_details/'+aData['id']+'" class="btn btn-success btn-condensed">Details</a>';
          $(nRow).find('td:eq(11)').html(details);

          var view = '<a  title="Click to details" href="'+url+'admin/student/student_view/'+aData['id']+'" class="btn btn-primary btn-condensed">View</a>';
          $(nRow).find('td:eq(12)').html(view);
           
       
          var action ='<a class="btn btn-warning btn-condensed" title="edit" href="'+url+'admin/student/edit/'+aData['id']+'"><i class="fa fa-edit"></i></a>';

          
             <?php /*if( (in_array('s',$roleResponsible['students'])) && (in_array('e',$roleResponsible['students'])) ){?>
        
          $(nRow).find('td:eq(11)').html(action);
        
        <?php }else if((!in_array('s',$roleResponsible['students'])) && (in_array('e',$roleResponsible['students'])) ){?>
           $(nRow).find('td:eq(10)').html(action);

        <?php }*/ ?>


        },
        "fnDrawCallback": function( oSettings ) {            
            var info = this.fnPagingInfo().iPage;
            $("#atpagination").val(info+1);
            $("td:empty").html("&nbsp;");
        },
    });
    $("#search_user").click(function(){
        if($("#search_text_1").val()!=""){
            $("#search_text_1").css('background', '#ffffff');
            setallvalues();
            dtabel.draw();
        }else{
         $("#search_text_1").css('background', '#ffb3b3');
         $("#search_text_1").focus();
                     return false;
        }
    });
});

function setallvalues(){
    search_text_1 = $("#search_text_1").val();
    search_on_1 = $("#search_on_1").val();
    search_at_1 = $("#search_at_1").val();
    var table = $('#users').DataTable();
    var info = table.page.info();
    $("#atpagination").val((info.page+1));
    if(search_text_1!=""){
        $("#searchreset").show();            
    }
    searchAstr = '';
}

function getpagenumber()
{
    return $("#atpagination").val() / $("#paginationlength").val();
}



function getpopup(batch_id,stu_id){

  //$('.modal-body').load('content.html',function(){
        $('#batch_id').val(batch_id);
        $('#student_id').val(stu_id);
        $('#myModal').modal({show:true});
   // });

}

    

</script>


    
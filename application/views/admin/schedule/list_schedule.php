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
                <a href="<?php echo site_url();?>admin/dashboard">Home</a>
              </li>              
              <li class="active">Schedule</li>
            </ul><!-- /.breadcrumb -->            
          </div>

<div class="page-content">
  <div class="page-header-1">
              <h1 class="col-lg-3 col-sm-4 col-md-5 col-xs-7 mbl-mgbtm-5 pdg-top-10">
                <i class="menu-icon blue fa fa-cart-arrow-down"></i>  
                Schedule
              </h1>
              <?php if( in_array('a',$roleResponsible['schedule'])){?>
                <div class="pull-right ">
                  <a href="<?php echo base_url();?>admin/schedule/add" class="btn btn-success btn-sm" type="button"><i class="fa fa-plus fa-lg"></i> Add </a>                        
                  <input type="hidden" name="hiv" id="hiv" value="0" />
               </div>
              <?php }?>
          
            </div><!-- /.page-header -->

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
              
              <div class="col-md-2">
                  <select name="search_on_1" id="search_on_1" class="form-control input-sm custom-input" onclick="changediv(this.value)">

                      <!-- <option value="1">Batch Name</option> -->
                      <option value="1">Course Name</option>
                      <option value="2">State Name</option>
                      <option value="3">Organisation Name</option>
                      <option value="4">Center Name</option>
                      <option value="5">Schedule Name</option>
                      <option value="6">Date</option>

                  </select>
                  
              </div>
              <div id="date_div" style="display:none">
              <div class="col-md-2 ">
                                      
                <input type="text" class="form-control" name="date_from" value="" placeholder="Start-date(yyyy-mm-dd)" id="date_from">
                                       
              </div>
              <div class="col-md-2 ">
                                      
                <input type="text" class="form-control" name="date_to" value="" placeholder="End-date(yyyy-mm-dd)" id="date_to">
                                       
              </div>
            </div>
              <div   id="search_div" class="col-md-2" style="padding:0">
                  <input type="text" name="search_text_1" id="search_text_1" placeholder="Type keyword to search" class="input-sm form-control custom-input" style="margin-left:5px;">
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
              <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('admin/schedule'); ?>"><li class="fa fa-minus icon-style"></li></a>
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
    var date_from;
    var date_to;
  //alert(date_from);
    $(document).ready(function () {

      var date_from=$('#date_from').val();
      var date_to=$('#date_to').val();
//alert(date_from);alert(date_to);
        dtabel = $('#users').DataTable({
            "processing": true,
            "serverSide": true,
            "bStateSave": true,
            "language": {
            "emptyTable": "No Records Found!",
        },
        dom: '<"html5buttons" B>lTgtp',
        buttons: [],
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
        "ajax": {
            "url": "<?php echo base_url('admin/schedule/all_records'); ?>",
            "type":"POST",
            beforeSend: function() {
              $("#wait").css("display", "block");
            },
            "data":function (d){
                d.search_text_1 = search_text_1;
                d.search_on_1 = search_on_1;
                d.search_at_1 = search_at_1;
                d.date_from=$('#date_from').val();
                d.date_to=$('#date_to').val();
            },
            "dataSrc": function ( jsondata ) {
                $("#wait").css("display", "none");
                return jsondata['data'];
            }
        },
        "columns": [
            { "title": "S.No", "name":"sno", "orderable": false, "data":"sno", "width":"0%" },
            { "title": "State", "name":"state","orderable": false, "data":"state", "width":"0%" },            
            
            { "title": "Organisation Name", "name":"organisation_name","orderable": false, "data":"organisation_name", "width":"0%" },
            { "title": "Center Name", "name":"center","orderable": false, "data":"center", "width":"0%" },
            { "title": "Course Name", "name":"course_name","orderable": false, "data":"course_name", "width":"0%" },
           // { "title": "Batch Name", "name":"batch_name","orderable": false, "data":"batch_name", "width":"0%" },
            { "title": "Schedule Name", "name":"schedule_name","orderable": false, "data":"schedule_name", "width":"0%" },
            { "title": "Start Date", "name":"start_date","orderable": false, "data":"start_date", "width":"0%" },
            { "title": "Start Time", "name":"start_time","orderable": false, "data":"start_time", "width":"0%" },
            { "title": "End Date", "name":"end_date","orderable": false, "data":"end_date", "width":"0%" },
            { "title": "End Time", "name":"end_time","orderable": false, "data":"end_time", "width":"0%" },
            <?php if( in_array('s',$roleResponsible['schedule'])){?>
              { "title": "Status", "name":"action", "orderable": false, "deafultContent":"", "data": "id", "width":"0%", "class":"td_action"},
            <?php }?>

            <?php if( in_array('e',$roleResponsible['schedule'])){?>           

              {"title": "Actions", "name":"action", "orderable": false, "deafultContent":"", "data": "id", "width":"0%", "class":"td_action"},      
            <?php }?>
            
        ],
        "fnCreatedRow": function(nRow, aData, iDataIndex) 
        {           

          var image = '<img src="'+url+aData['image_path']+'" height="100" width="150">';
         // $(nRow).find('td:eq(2)').html(image);

          if(aData['status'] == 'Active')
          {
            var action = '<a title="Click to Inactive" href="'+url+'admin/schedule/change_record_status/'+aData['id']+'/Inactive/" class="btn btn-success btn-condensed">Active</a>';
          }
          else
          {
            var action = '<a title="Click to Active" href="'+url+'admin/schedule/change_record_status/'+aData['id']+'/Active/" class="btn btn-danger btn-condensed">Inactive</a>';
          }
          <?php if( in_array('s',$roleResponsible['schedule'])){?>
          $(nRow).find('td:eq(10)').html(action);
        <?php }?>

        
          var action ='<a class="btn btn-warning btn-condensed" title="edit" href="'+url+'admin/schedule/edit/'+aData['id']+'"><i class="fa fa-edit"></i></a>';
          

        <?php if( (in_array('s',$roleResponsible['schedule'])) && (in_array('e',$roleResponsible['schedule'])) ){?>
        
          $(nRow).find('td:eq(11)').html(action);
        
        <?php }else if((!in_array('s',$roleResponsible['schedule'])) && (in_array('e',$roleResponsible['schedule'])) ){?>
           $(nRow).find('td:eq(10)').html(action);

        <?php }?>



        },
        "fnDrawCallback": function( oSettings ) {            
            var info = this.fnPagingInfo().iPage;
            $("#atpagination").val(info+1);
            $("td:empty").html("&nbsp;");
        },
    });
    $("#search_user").click(function(){
        /*if($("#search_text_1").val()!=""){
            $("#search_text_1").css('background', '#ffffff');
            setallvalues();
            dtabel.draw();
        }else{
         $("#search_text_1").css('background', '#ffb3b3');
         $("#search_text_1").focus();
                     return false;
        }*/
         setallvalues();
            dtabel.draw();
        return true;
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



   

    

</script>

<script type="text/javascript">

  function changediv(value){
    if(value == 6){
      $("#search_div").hide();
      $("#date_div").show();
    }else{
       $("#search_div").show();
       $("#date_div").hide();
    }

  }
$(document).ready(function(){
    $('#date_from,#date_to').datepicker({
        autoclose: true,
        todayHighlight: true,
        format:"yyyy-mm-dd"
    })
   
})
    </script>

    
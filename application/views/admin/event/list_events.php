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
          <li class="active">List Events</li>
        </ul><!-- /.breadcrumb -->            
    </div>

<div class="page-content">
  <div class="page-header-1">
      <h1 class="col-lg-3 col-sm-4 col-md-5 col-xs-7 mbl-mgbtm-5 pdg-top-10">
        <i class="menu-icon blue fa fa-cart-arrow-down"></i>  
       List Events
      </h1>
      <?php if( in_array('a',$roleResponsible['events'])){?>
        <div class="pull-right "> 
          <a href="<?php echo base_url();?>admin/eventcreation/add" class="btn btn-success btn-sm" type="button"><i class="fa fa-plus fa-lg"></i> Add Event Create</a>                          
          <input type="hidden" name="hiv" id="hiv" value="0"/>
       </div> 
      <?php }?> 
  </div><!-- /.page-header -->

  <div class="row" style="margin: 0px 0px 0px 0px;">
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
              <div class="col-md-3 col-md-offset-3">
                  <input type="text" name="search_text_1" id="search_text_1" placeholder="Type keyword to search" class="input-sm form-control custom-input" style="margin-left:0px;">
              </div>
              <div class="col-md-2">
                  <select name="search_on_1" id="search_on_1" class="form-control input-sm custom-input">
                      <option value="1">Event Name</option>
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
              <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('admin/eventcreation'); ?>"><li class="fa fa-minus icon-style"></li></a>
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
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
        "ajax": {
            "url": "<?php echo base_url('admin/eventcreation/all_records'); ?>",
            "type":"POST",
            beforeSend: function() {
              $("#wait").css("display", "block");
            },
            "data":function (d){
                d.search_text_1 = search_text_1;
                d.search_on_1 = search_on_1;
                d.search_at_1 = search_at_1;
                //d.language_id=language_id;
            },
            "dataSrc": function ( jsondata ) {
                $("#wait").css("display", "none");
                return jsondata['data'];
            }
        },
        "columns": [
            { "title": "S.No", "name":"sno", "orderable": false, "data":"sno", "width":"0%" },

            { "title": "Event Name", "name":"event_name","orderable": false, "data":"event_name", "width":"0%" },
            { "title": "Event Id", "name":"event_unique_id","orderable": false, "data":"event_unique_id", "width":"0%" },

            { "title": "Start Date", "name":"start_date","orderable": false, "data":"start_date", "width":"0%" },

            { "title": "End Date", "name":"end_date","orderable": false, "data":"end_date", "width":"0%" },

            { "title": "QR Code", "name":"qrcode_path","orderable": false, "data":"qrcode_path", "width":"0%" },

            { "title": "Download PDF", "name":"pdf_path","orderable": false, "data":"event_pdf_path", "width":"0%" },

            { "title": "Stock Details", "name":"id","orderable": false, "data":"id", "width":"0%" },

            <?php if( in_array('s',$roleResponsible['events'])){?>
              { "title": "Status", "name":"action", "orderable": false, "deafultContent":"", "data": "id", "width":"0%", "class":"td_action"},
            <?php }?>

            <?php if( in_array('e',$roleResponsible['events'])){?>

            {"title": "Actions", "name":"action", "orderable": false, "deafultContent":"", "data": "id", "width":"0%", "class":"td_action"},
          <?php }?>
                    
        ],
        "fnCreatedRow": function(nRow, aData, iDataIndex) 
        {           

          var pdf_path = '<a href="'+url+'admin/eventcreation/download_event_pdf/'+aData['id']+'"><i class="fa fa-download"> </i>  PDF Download</a>' ;

          $(nRow).find('td:eq(6)').html(pdf_path);

          var qr_code = '<img src="'+url+aData['qrcode_path']+'" height="100" width="150">';
          $(nRow).find('td:eq(5)').html(qr_code);

          var stock_details = '<b style="color:green">Stock Include:</b><b>'+aData['stock_included'] +'</b><br><b style="color:green"> Count:</b><b style="color:red">'+aData['in_stock_count'] +'</b>';

          $(nRow).find('td:eq(7)').html(stock_details);

          if(aData['status'] == 'Active')
          {
            var action = '<a title="Click to Inactive" href="'+url+'admin/eventcreation/change_record_status/'+aData['id']+'/Inactive/" class="btn btn-success btn-condensed">Active</a>';
          }
          else
          {
            var action = '<a title="Click to Active" href="'+url+'admin/eventcreation/change_record_status/'+aData['id']+'/Active/" class="btn btn-danger btn-condensed">Inactive</a>';
          }
        <?php if( in_array('s',$roleResponsible['events'])){?>
          $(nRow).find('td:eq(8)').html(action);
        <?php }?>

         
            var action ='<a class="btn btn-warning btn-condensed" title="edit" href="'+url+'admin/eventcreation/edit/'+aData['id']+'">Edit</a>';
           
          <?php if( (in_array('s',$roleResponsible['events'])) && (in_array('e',$roleResponsible['events'])) ){?>
        
          $(nRow).find('td:eq(9)').html(action);
        
        <?php }else if((!in_array('s',$roleResponsible['events'])) && (in_array('e',$roleResponsible['events'])) ){?>
           $(nRow).find('td:eq(8)').html(action);

        <?php }?>



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

</script>   
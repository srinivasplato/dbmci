
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
              <li>                 
                <a href="<?php echo site_url();?>admin/attachments">Attachments</a>
              </li>
              <li class="active"> Edit</li>
            </ul><!-- /.breadcrumb -->            
          </div>

          <div class="page-content">
            <div class="page-header-2">
              <h1 class="col-lg-4 col-md-3 col-sm-3 col-xs-12 pdg-top-10">
                <i class="menu-icon fa fa-list-ul blue"></i>Attachments
                <span class="label label-purple arrowed">Edit<span>
              </h1>
              <div class="pull-right ">              
                 <input type="hidden" name="hiv" id="hiv" value="0" />
                           </div>
            </div><!-- /.page-header -->
            
             <?php echo $message; ?>
                   
            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" name="myform" id="myform" method="post" action="<?php echo base_url()?>admin/attachments/update_records" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-9 col-xs-12 col-sm-9 col-md-9 col-lg-offset-1">
                  
                 <!--  <div class="row form-group frm-btm">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
                      <label class="input-text">Select State<span class="red bigger-120">*</span></label>
                    </div>
                    <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 word-brk">
                      <select class="form-control" name="state_id" id="state_id" required="" onchange="getOrganisations(this.value)">
                                <option value="">Select State</option>
                                <?php
                                if(!empty($states))
                                {
                                  foreach($states as $state)
                                  {
                                    ?>
                                    <option value="<?=$state['id'];?>" <?php if($state['id'] == $record['state_id']){?> selected  <?php }?>><?=$state['state'];?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                    </div>
                  </div>

                  <div class="row form-group frm-btm">
                      <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
                        <label class="input-text">Select Organisation <span class="red bigger-120">*</span></label>
                      </div>
                      <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
                      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 word-brk">
                        <select class="form-control" name="organisation_id" id="organisation_id" required="" onchange="getCenters(this.value)">
                                 <option value="">Select Organisation</option> 
                                 <?php
                                if(!empty($organisations))
                                {
                                  foreach($organisations as $org)
                                  {
                                    ?>
                                    <option value="<?=$org['id'];?>"  <?php if($org['id'] == $record['organisation_id']){?> selected  <?php }?> ><?=$org['organisation_name'];?></option>
                                    <?php
                                  }
                                }
                                ?>
                                </select>
                      </div>  
                    </div>  


                  <div class="row form-group frm-btm">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
                      <label class="input-text">Center<span class="red bigger-120">*</span></label>
                    </div>
                    <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 word-brk">
                      <select class="form-control" name="center_id" id="center_id" required="">
                                <option value="">Select Center</option>
                                <?php
                                if(!empty($centers))
                                {
                                  foreach($centers as $center)
                                  {
                                    ?>
                                    <option value="<?=$center['id'];?>"  <?php if($center['id'] == $record['center_id']){?> selected  <?php }?> ><?=$center['center'];?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                    </div>
                  </div> -->
                  <div class="row form-group frm-btm">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                      <label class="input-text">Attachments Name<span class="red bigger-120">*</span></label>
                    </div>
                    <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk">
                      <input class="form-control" placeholder="" type="text" name="attachment_name" value="<?php echo $record['attachment_name'] ?>" id="attachment_name" onkeyup="" required>
                    </div>
                  </div>
                  <div class="row form-group frm-btm">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                      <label class="input-text">Mobile Number<span class="red bigger-120">*</span></label>
                    </div>
                    <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk">
                      <input class="form-control" placeholder="" type="text" name="mobile_num" value="<?php echo $record['mobile_num'] ?>" id="mobile_num" onkeyup="" required>
                    </div>
                  </div>

                  <div class="row form-group frm-btm">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                      <label class="input-text">Opening Balance<span class="red bigger-120">*</span></label>
                    </div>
                    <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk">
                      <input class="form-control" placeholder="" type="number" name="opening_balance" value="<?php echo $record['opening_balance'] ?>" id="opening_balance" onkeyup="" required>
                    </div>
                  </div>
                    <input class="form-control" type="hidden" name="id" value="<?php echo $record['id']; ?>">
                                    
                  </div>                  
                </div>
                
                <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formfooter text-center mgtp-btm-10">
                  <input type="submit" name="edit"  class="btn btm-sm btn-success btn-sm" value="Update" /> 
                  
                  <a class="btn btn-danger btn-sm" type="edit" href="<?php echo base_url();?>admin/attachments">Back
                  </a>
                </div>                
              </div><!-- End Row -->
              </form>
              </div>
              </div>
            </div>
            
        </div>
      </div><!-- /.main-content -->
      
  
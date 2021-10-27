	<div class="main-content">
		<div class="main-content-inner">
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>
				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="dashboard.html">Home</a>
					</li>
					<li class="active">Batches</li>
				</ul><!-- /.breadcrumb -->						
			</div>
			<div class="page-content">						 
				<div class="page-header">
					<?php 
						if($this->session->flashdata('message')!=''){
						?>						
						<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<?php echo $this->session->flashdata('message');?>
						</div>	
						<?php 
						}
					?>				
					<h1 class="col-lg-6 col-md-3 col-sm-3 col-xs-9  pdg-top-10">
					<i class=" pull-left blue fa fa-dashboard"></i>
						Batch Wise Students Count  
					</h1>
					<!-- <div class="pull-right">								
						<a class="btn btn-success btn-sm" href="<?php echo site_url();?>admin/paymentview" type="button">Back </a>
						
						 <input type="hidden" name="hiv" id="hiv" value="0" />
	               </div> -->
				</div><!-- /.page-header -->
				
				<section class="edu_admin_content">	 
					<div class="sectionHolder edu_admin_right edu_dashboard_wrap">
						<div class="edu_dashboard_widgets">							
				    		<div class="row">
				    			<?php foreach($batch_wise_students as $batch){ ?>
			    				<div class="col-xl-12 col-lg-4 col-md-4 col-sm-12 col-12">
			    					
				    					

				    					<div class="edu_color_boxes box_left">

				    						<div  class="edu_dash_box_data">
				    						    <p><b><?php echo $batch['batch_name']; ?></b></p>
				    							<h3><b><?php echo $batch['students_count'];
												    	?></b></h3>    					
				    						</div>


				    						
				    					<a href="<?php echo base_url();?>admin/batchs/download_students/<?php echo $batch['id'];?>">
				    						<div class="edu_dash_box_icon">
				    							 
												<i class="fa fa-arrow-down" aria-hidden="true"></i> 


											
				    						</div>
				    					</a>
				    					    
											


				    						<div class="edu_dash_info">
				        					    <ul>
				    					            <li style="color: green"><p><b>Paid Amount : </b><span><b>

				    					            	

				    					            	<?php 
												    			echo number_format_in($batch['paid_amount']);
												    		
												    	?>
				    					            		<!-- <i style="margin-left:60px" class="fa fa-arrow-down" aria-hidden="true"></i>
				    					            	</b></span></p></li> -->
				    					            	
				    					             
				    					         		
				    					            	<!-- <img style="width:50px;height:40px;margin-left:60px" src="<?php echo base_url('storage/download.jpg')?>" > -->
				    					            
				    					        </ul>

				    					        <ul>
				    					            <li style="color: red"><p><b>Due Amount : </b><span><b>

				    					            	

				    					            	<?php 
												    			echo number_format_in($batch['due_amount']);
												    		
												    	?>
				    					            		
				    					            		<!-- <i style="margin-left:60px" class="fa fa-arrow-down" aria-hidden="true"></i> -->
				    					            	</b>
				    					            </span>
				    					        </p>
				    					    </li>
				    					            	
				    					            	 
				    					            	
				    					            
				    					        </ul>
				    					    </div>
				    					</div>
			    					
			    				</div>
			    			<?php }?>
			    				
				    		</div>				    				
				    	</div>
					        </div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
		
		
		
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
					<li class="active">Payment View</li>
				</ul><!-- /.breadcrumb -->						
			</div>
			<div class="page-content">						 
				<div class="page-header">
									
					<h1 class="col-lg-12 col-md-3 col-sm-3 col-xs-9  pdg-top-10">
					<i class=" pull-left blue fa fa-dashboard"></i>
						Income and Expense---> <b style="color:red"><?php echo $state['state'];?></b>(state) ---><b style="color:red"> <?php echo $organisation['organisation_name'];?> </b>(organasation) ---><b style="color:red"> <?php echo $center['center'];?> </b>(center) ---><b style="color:red"> <?php echo $year;?> </b>(Year) ---><b style="color:red"> <?php echo $month['month'];?> </b>(Month)  
					
					</h1>
					<div class="pull-right">								
						<a class="btn btn-success btn-sm" href="<?php echo site_url();?>admin/paymentview/center_years_months/<?php echo $state_id;?>/<?php echo $org_id;?>/<?php echo $center_id;?>/<?php echo $year;?>" type="button">Back </a>
						<!-- <a class="btn btn-warning btn-sm" href="<?php echo site_url();?>#" type="button"><i class="fa fa-bar-chart fa-lg"></i>  </a> -->
						 <input type="hidden" name="hiv" id="hiv" value="0" />
	               </div>
				</div><!-- /.page-header -->
				
				<section class="edu_admin_content">	 
					<div class="sectionHolder edu_admin_right edu_dashboard_wrap">
						<div class="edu_dashboard_widgets">							
				    		<div class="row">
			    				<div class="col-xl-12 col-lg-4 col-md-4 col-sm-12 col-12">
			    					<a href="<?php echo base_url()?>admin/paymentview/payment_mode_payments/<?php echo $state_id;?>/<?php echo $org_id;?>/<?php echo $center_id;?>/<?php echo $year;?>/<?php echo $month_id;?>/income">
				    					<div class="edu_color_boxes box_left">
				    						<div class="edu_dash_box_data">
				    						    <p><b>Total Income</b></p>
				    							<h3><b>
				    					            		<?php if($income['total_amount'] != ''){
										    					echo $income_total_amt=roundInt($income['total_amount']);
												    		}else{
												    			echo $income_total_amt=0;
												    		}
												    	?></b></h3>    					
				    						</div>
				    						<div class="edu_dash_box_icon">
												<i class="fa fa-money" aria-hidden="true"></i>
				    						</div>
				    						<div class="edu_dash_info">
				        					    <ul>
				    					            <li><p><b>Total Income : </b><span><b>

				    					            	
				    					            		<?php if($income['total_amount'] != ''){
										    					echo roundInt($income['total_amount']);
												    		}else{
												    			echo 0;
												    		}
												    	?>
				    					            	</b></span></p></li>
				    					            <!-- <li><p><b>Due Fees : </b> <span><b><?php echo $due_amount;?></b></span></p></li> -->
				    					        </ul>
				    					    </div>
				    					</div>
			    					</a>
			    				</div>
			    				<div class="col-xl-12 col-lg-4 col-md-4 col-sm-12 col-12">
			    					<a href="<?php echo base_url()?>admin/paymentview/expense_categories/<?php echo $state_id;?>/<?php echo $org_id;?>/<?php echo $center_id;?>/<?php echo $year;?>/<?php echo $month_id;?>/expense">
				    					<div class="edu_color_boxes box_center">
				    						<div class="edu_dash_box_data">
				    						    <p><b>Total Expenses</b></p>
				    							<h3><b><?php if($expense['total_amount'] != ''){
										    					echo $expense_total_amt=roundInt($expense['total_amount']);
												    		}else{
												    			echo $expense_total_amt=0;
												    		}
												    	?>
												    		
												    	</b></h3>
				    						</div>
				    						<div class="edu_dash_box_icon">
				    							<i class="fa fa-money" aria-hidden="true"></i>
				    						</div>
				    						<div class="edu_dash_info">
												<ul>
												    <li><p><b>Total Expenses : </b><span><b><?php echo roundInt($expense_total_amt);?></b></span></p></li>
												   <!--  <li><p><b>Due Fees : </b> <span><b><?php echo $due_amount;?></b></span></p></li> -->
												</ul>
						    				</div>
				    					</div>
			    					</a>
			    				</div>
			    				<div class="col-xl-12 col-lg-4 col-md-4 col-sm-12 col-12">
			    					<!-- <a href="<?php echo base_url()?>admin/paymentview/payment_mode_payments/<?php echo $state_id;?>/<?php echo $org_id;?>/<?php echo $center_id;?>"> -->
			        					<div class="edu_color_boxes box_right">
			        						<div class="edu_dash_box_data">
			        						    <p><b>Net Amount</b></p>
			        							<h3><b><?php  $net_amt=$income_total_amt-$expense_total_amt;
							        							echo number_format($net_amt);;
			        										
			        										?></b></h3>
			        						</div>
			        						<div class="edu_dash_box_icon">				        							
												<i class="fa fa-cc" aria-hidden="true"></i>
			        						</div>
			        						<div class="edu_dash_info">
												<ul>
												    <li><p><b>Total Net : </b><span><b><?php echo number_format($net_amt);?></b></span></p></li>
												   <!--  <li><p><b>Due Fees : </b> <span><b><?php echo $due_amount;?></b></span></p></li> -->
												</ul>
						    				</div>
			        					</div>
			    					<!-- </a> -->
			    				</div>
				    		</div>				    				
				    	</div>
					        </div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div><!-- /.page-content -->
		<!--[if !IE]> -->
		
		
		
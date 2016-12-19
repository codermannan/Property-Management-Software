<div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>
<div class="primary-sidebar">
	<!-- Main nav -->
    <br />
    <div style="text-align:center;">
    	<a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>
    </div>
   	<br />
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------dashboard----->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/dashboard" >
					<i class="icon-desktop icon-2x"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
		</li>
        
       <!------properties settings------>
		<li class="dark-nav <?php if(	$page_name == 'manage_property' || $page_name == 'manage_unit' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#properties_submenu" >
                            <i class="icon-suitcase icon-2x"></i>
                            <span><?php echo get_phrase('properties');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="properties_submenu" class="collapse <?php if(	$page_name == 'manage_landlord' || $page_name == 'manage_property' || $page_name == 'manage_unit' )echo 'in';?>">
                            
                            <li class="<?php if($page_name == 'manage_landlord')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_landlord">
                                    <i class="icon-user"></i> <?php echo get_phrase('manage_landlord');?>
                                </a>
                            </li>
                            <li class="<?php if($page_name == 'manage_property')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_property">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('manage_property');?>
                                </a>
                            </li>
                            <li class="<?php if($page_name == 'manage_unit')echo 'active';?>">
                              <a href="<?php echo base_url();?>index.php?admin/manage_unit">
                                  <i class="icon-h-sign"></i> <?php echo get_phrase('manage_unit');?>
                              </a>
                            </li>
                             
                        </ul>
		</li>
         <!------Lease------>
		<li class="dark-nav <?php if($page_name == 'rental_application' || $page_name == 'applicant_list' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#rental_submenu" >
                            <i class="icon-pencil icon-2x"></i>
                            <span><?php echo get_phrase('applicants_');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="rental_submenu" class="collapse <?php if($page_name == 'rental_application' || $page_name == 'applicant_list')echo 'in';?>">
                        
                            <li class="<?php if($page_name == 'rental_application')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/rental_application">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('rental_application');?>
                                </a>
                            </li>
                            <li class="<?php if($page_name == 'applicant_list')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/rental_application_list">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('applicant_list');?>
                                </a>
                            </li>
                        </ul>
		</li>   
         
                 <!------lease------>
		<li class="dark-nav <?php if($page_name == 'lease_list' || $page_name == 'weekly_lease' || $page_name == 'tenant_list')echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#lease_submenu" >
                            <i class="icon-user icon-2x"></i>
                            <span><?php echo get_phrase('lease_management');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="lease_submenu" class="collapse <?php if($page_name == 'lease_list' || $page_name == 'weekly_lease' || $page_name == 'tenant_list')echo 'in';?>">
                            
                            <li class="<?php if($page_name == 'tenant_list')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_lease/tenant_list">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('tenant_list');?>
                                </a>
                            </li>
                            <li class="<?php if($page_name == 'lease_list')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/lease_managemnet">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('lease_list');?>
                                </a>
                            </li>
                            <li class="<?php if($page_name == 'weekly_lease')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/lease_managemnet/weeklyLeaseForm">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('weekly_lease_agreement');?>
                                </a>
                            </li>
                            
                        </ul>
		</li> 
          <!------payment------>
		<li class="dark-nav <?php if(	$page_name == 'view_payment' || $page_name == 'leadger_group'|| $page_name == 'account_ledger')echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#payment_submenu" >
                            <i class="icon-credit-card icon-2x"></i>
                            <span><?php echo get_phrase('payment');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="payment_submenu" class="collapse <?php if($page_name == 'view_payment' || $page_name == 'account_ledger'|| $page_name == 'leadger_group')echo 'in';?>">
                        
                            <li class="<?php if($page_name == 'view_payment')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/view_payment">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('weekly_payment_view');?>
                                </a>
                            </li>
                        </ul>
		</li>
                <!------accounts module------>
		<li class="dark-nav <?php if($page_name == 'cash_book' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#accmodule_submenu" >
                            <i class="icon-money icon-2x"></i>
                            <span><?php echo get_phrase('accounts_module');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="accmodule_submenu" class="collapse <?php if($page_name == 'cash_book')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'cash_book')echo 'active';?>">
                                <a href="<?php echo base_url();?>accounting/scb_mod/pages/home.php" target="_blank">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('cash_book');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
                 <!------Operations------>
		<li class="dark-nav <?php if($page_name == 'cashflow_report' || $page_name == 'graphical_report' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#operations_submenu" >
                            <i class="icon-suitcase icon-2x"></i>
                            <span><?php echo get_phrase('operations_');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="operations_submenu" class="collapse <?php if($page_name == 'cashflow_report' || $page_name == 'graphical_report')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'cashflow_report')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?report/manage_operation/cashflow">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('cashflow_report');?>
                                </a>
                            </li>
<!--                            <li class="<?php //if($page_name == 'graphical_report')echo 'active';?>">
                                 <a href="<?php //echo base_url();?>index.php?report/manage_operation/plot/200022000/2015">
                                     <i class="icon-h-sign"></i> <?php //echo get_phrase('graphical_report');?>
                                 </a>
                           </li>-->
                        </ul>
		</li>
                <!------work orders------>
		<li class="dark-nav <?php if(	$page_name == 'work_order' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#workorder_submenu" >
                            <i class="icon-suitcase icon-2x"></i>
                            <span><?php echo get_phrase('work_orders');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="workorder_submenu" class="collapse <?php if(	$page_name == 'work_order')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'work_order')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_work_order">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('work_orders');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
               
                 <!------maintenance_log------>
		<li class="dark-nav <?php if(	$page_name == 'maintenance_log' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#maintain_submenu" >
                            <i class="icon-suitcase icon-2x"></i>
                            <span><?php echo get_phrase('maintenance_');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="maintain_submenu" class="collapse <?php if(	$page_name == 'maintenance_log')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'maintenance_log')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_maintenance_log">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('maintenance_log');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
                 <!------project managment------>
		<li class="dark-nav <?php if($page_name == 'manage_project' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#project_submenu" >
                            <i class="icon-suitcase icon-2x"></i>
                            <span><?php echo get_phrase('project_management');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="project_submenu" class="collapse <?php if(	$page_name == 'maintenance_log')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'manage_project')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_project">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('project_management');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
                 <!------quicklinks------>
                 <li class="dark-nav <?php if($page_name == 'manage_links' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#link_submenu" >
                            <i class="icon-suitcase icon-2x"></i>
                            <span><?php echo get_phrase('quick_links');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="link_submenu" class="collapse <?php if(	$page_name == 'manage_links')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'manage_links')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_links">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('quick_links');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
                 <!------ups------>
		<li class="dark-nav <?php if($page_name == 'ups_entry' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#link_ups" >
                            <i class="icon-globe icon-2x"></i>
                            <span><?php echo get_phrase('pass_storer_');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="link_ups" class="collapse <?php if($page_name == 'ups_entry')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'ups_entry')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/universal_pass_storer">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('pass_storer_entry');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
                <!------marketing------>
		<li class="dark-nav <?php if($page_name == 'marketing' )echo 'active';?>">
			<span class="glow"></span>
                        <a class="accordion-toggle  " data-toggle="collapse" href="#link_marketing" >
                            <i class="icon-globe icon-2x"></i>
                            <span><?php echo get_phrase('marketing_');?><i class="icon-caret-down"></i></span>
                        </a>

                        <ul id="link_marketing" class="collapse <?php if($page_name == 'marketing')echo 'in';?>">
                           
                            <li class="<?php if($page_name == 'marketing')echo 'active';?>">
                                <a href="<?php echo base_url();?>index.php?admin/manage_marketing">
                                    <i class="icon-h-sign"></i> <?php echo get_phrase('marketing_upload');?>
                                </a>
                            </li>
                           
                        </ul>
		</li>
                
        <!------system settings------>
		<li class="dark-nav <?php if(	$page_name == 'manage_email_template' 	|| 
										$page_name == 'manage_noticeboard' 		||
										$page_name == 'system_settings' 		|| 
										$page_name == 'manage_language' 		|| 
										$page_name == 'backup_restore' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#settings_submenu" >
                <i class="icon-wrench icon-2x"></i>
                <span><?php echo get_phrase('settings');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="settings_submenu" class="collapse <?php if(	$page_name == 'manage_late_fee' 	|| 
                    $page_name == 'manage_noticeboard' 		||
                    $page_name == 'system_settings' 		|| 
                    $page_name == 'manage_language' 		|| 
                    $page_name == 'backup_restore' )echo 'in';?>">
                <li class="<?php if($page_name == 'manage_late_fee')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_late_fee">
                      <i class="icon-envelope"></i> <?php echo get_phrase('manage_late_fee');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'manage_noticeboard')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/manage_noticeboard">
                      <i class="icon-columns"></i> <?php echo get_phrase('manage_noticeboard');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'system_settings')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/system_settings">
                      <i class="icon-h-sign"></i> <?php echo get_phrase('system_settings');?>
                  </a>
                </li>
                 
            </ul>
		</li>
                
		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_profile" >
					<i class="icon-lock icon-2x"></i>
					<span><?php echo get_phrase('profile');?></span>
				</a>
		</li>
		
	</ul>
	
</div>
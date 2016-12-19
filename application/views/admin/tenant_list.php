<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="<?php if(isset($tenant_list)) echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('current_tenant');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('old_tenant');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(isset($activeTenant))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('tenant_id');?></div></th>
                    		<th><div><?php echo get_phrase('tenant_name');?></div></th>
                    		<th><div><?php echo get_phrase('tenant_contact');?></div></th>
                                <th><div><?php echo get_phrase('property_name');?></div></th>
                                <th><div><?php echo get_phrase('frequency_');?></div></th>
                                <th><div><?php echo get_phrase('vacant_unit');?></div></th>
                    		<th><div><?php echo get_phrase('balance_');?></div></th>
                                <th><div><?php echo get_phrase('dashboard_');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($activeTenant as $row):?>
                        <tr>
                                                        <td><?php echo $row['tenant_id'];?></td>
							<td><?php echo $row['tenant_name'];?></td>
							<td><?php echo $row['tenant_contact'];?></td>
                                                        <td><?php echo $row['property_name'];?></td>
                                                        <td><?php echo $row['frequency'];?></td>
                                                        <td><?php echo $row['unit_name'];?></td>
                                                        <td><?php echo $row['balance'];?></td>
                                                        <td align="center">
                                                             <a href="<?php echo base_url();?>index.php?admin/manage_lease/tdashboard/<?php echo $row['tenant_id'];?>"
                                                                    rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('tenant_dashboard');?>" class="btn btn-success">
                                                                            <i class="icon-dashboard"></i>
                                                            </a>
                                                        </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('tenant_id');?></div></th>
                    		<th><div><?php echo get_phrase('tenant_name');?></div></th>
                    		<th><div><?php echo get_phrase('tenant_contact');?></div></th>
                                <th><div><?php echo get_phrase('property_name');?></div></th>
                                <th><div><?php echo get_phrase('frequency_');?></div></th>
                                <th><div><?php echo get_phrase('vacant_unit');?></div></th>
                    		<th><div><?php echo get_phrase('balance_');?></div></th>
                                <th><div><?php echo get_phrase('dashboard_');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($inactiveTenant as $row):?>
                        <tr>
                                                        <td><?php echo $row['tenant_id'];?></td>
							<td><?php echo $row['tenant_name'];?></td>
							<td><?php echo $row['tenant_contact'];?></td>
                                                        <td><?php echo $row['property_name'];?></td>
                                                        <td><?php echo $row['frequency'];?></td>
                                                        <td><?php echo $row['unit_name'];?></td>
                                                        <td><?php echo $row['balance'];?></td>
                                                        <td align="center">
                                                             <a href="<?php echo base_url();?>index.php?admin/manage_lease/tdashboard/<?php echo $row['tenant_id'];?>"
                                                                    rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('tenant_dashboard');?>" class="btn btn-success">
                                                                            <i class="icon-dashboard"></i>
                                                            </a>
                                                        </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>           
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
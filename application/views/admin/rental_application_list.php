<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
			<li>
            	<a href="#list" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('rental_application_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	
            <!----TABLE LISTING STARTS--->
<!--            <div class="tab-pane box <?php //if(!isset($appinfo))echo 'active';?>" id="list">-->
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('tenant_name');?></div></th>
                    		<th><div><?php echo get_phrase('phone_');?></div></th>
                    		<th><div><?php echo get_phrase('email_');?></div></th>
                                <th><div><?php echo get_phrase('ssn');?></div></th>
                                <th><div><?php echo get_phrase('property_name');?></div></th>
                                <th><div><?php echo get_phrase('move_in_date');?></div></th>
                                <th><div><?php echo get_phrase('no_of_bedroom');?></div></th>
                                <th><div><?php echo get_phrase('status_');?></div></th>
                                <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($appinfo as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['full_name'];?></td>
							<td><?php echo $row['phone_number'];?></td>
                                                        <td><?php echo $row['email'];?></td>
                                                        <td><?php echo $row['ssn'];?></td>
                                                        <td><?php echo $row['property_name'];?></td>
                                                        <td><?php echo $row['movein_date'];?></td>
                                                        <td><?php echo $row['no_of_bedroom'];?></td>
                                                        <td><?php if($row['rent_status']==0){ echo 'Not Approved'; } else if($row['rent_status']==1) { echo 'Approved'; }else{ echo 'Booked';}?></td>
                                                        <td align="center">
                                                            <?php if($row['rent_status']==0){?>
                            	<a href="<?php echo base_url();?>index.php?admin/rental_application_list/screening/<?php echo $row['appinfo_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('Approve Screening Test');?>" class="btn btn-green">
                                		<i class="icon-ok"></i>
                                </a>
                                                            <?php }else if($row['rent_status']==1){?>
                                 <a href="<?php echo base_url();?>index.php?admin/rental_application_list/approve/<?php echo $row['appinfo_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('booking');?>" class="btn btn-success">
                                		<i class="icon-external-link"></i>
                                </a>     
                                                             <?php }?>
                                                            
                                 <a href="<?php echo base_url();?>index.php?admin/rental_application_list/view/<?php echo $row['appinfo_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view');?>" class="btn btn-info">
                                		<i class="icon-eye-open"></i>
                                </a>
                                                           
                            	<a href="#" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
                                </a>
        					</td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
<!--			</div>-->
            <!----TABLE LISTING ENDS--->
            
            
		</div>
	</div>
</div>
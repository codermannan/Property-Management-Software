<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
			<li>
            	<a href="#list" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('active_lease');?>
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
                    		<th><div><?php echo get_phrase('start_date');?></div></th>
                    		<th><div><?php echo get_phrase('end_date');?></div></th>
                                <th><div><?php echo get_phrase('rent_amount');?></div></th>
                                <th><div><?php echo get_phrase('deposit_');?></div></th>
                                <th><div><?php echo get_phrase('total_late');?></div></th>
                                <th><div><?php echo get_phrase('late_fee');?></div></th>
                                <th><div><?php echo get_phrase('paid_amount');?></div></th>
                                <th><div><?php echo get_phrase('due_amount');?></div></th>
                                <th><div><?php echo get_phrase('notice_date');?></div></th>
                                <th><div><?php echo get_phrase('renewal_status');?></div></th>
                                <th><div><?php echo get_phrase('termination_status');?></div></th>
                                <th><div><?php echo get_phrase('lease_status');?></div></th>
                                <th><div><?php echo get_phrase('option_');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
                        $count = 1;
                        foreach($Lease as $row):
                            $tenantname = $this->Operation_Model->getSingleDataOfTable('tenant_name', 'tenant_id', $row['tenantId'], 'p_tenant');
                            $lateday = abs($this->Operation_Model->totalLateDayCalculation($row['moveoutDate']));
                            $totalLateFee = $this->Operation_Model->totalLateFeeCalculation($row['leaseId'], $row['tenantId'],$row['rentAmount'],$lateday);
                            $due_amount = (($row['rentAmount'] + $row['lateFee']) - $row['paidAmount']);
                            //$row['isAppliedLate']
                        ?>
                        <tr>
                                                        <td><?php echo $count++;?></td>
							<td><?php echo $tenantname;?></td>
							<td><?php echo $row['moveinDate'];?></td>
                                                        <td><?php echo $row['moveoutDate'];?></td>
                                                        <td><?php echo $row['rentAmount'];?></td>
                                                        <td><?php echo $row['securityDeposit'];?></td>
                                                        <td><?php echo $lateday;?></td>
                                                        <td><?php echo $row['lateFee'];?></td>
                                                        <td><?php echo $row['paidAmount'];?></td>
                                                        <td><?php echo $due_amount;?></td>
                                                        <td><?php echo 'notice date';?></td>
                                                        <td><?php if($row['renewalStatus']==0){ echo 'No'; } else if($row['renewalStatus']==1) { echo 'Yes'; }?></td>
                                                        <td><?php if($row['terminationStatus']==0){ echo 'No'; } else if($row['terminationStatus']==1) { echo 'Yes'; }?></td>
                                                        <td><?php if($row['leaseStatus']==0){ echo 'Active'; } else if($row['leaseStatus']==1) { echo 'Inactive'; }?></td>
                                                        
                                                        <td align="center">
                                                            <?php //if($row['rent_status']==0){?>
                            	<a href="<?php echo base_url();?>index.php?admin/lease_managemnet/approveLateFee/<?php echo $row['leaseId'];?>/<?php echo $totalLateFee;?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('Apply Late Fee');?>" class="btn btn-green">
                                		<i class="icon-ok"></i>
                                </a>
                                                            <?php //}else if($row['rent_status']==1){?>
                                 <a href="<?php echo base_url();?>index.php?admin/lease_managemnet/viewLease/<?php echo $row['leaseId'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_lease_agreement');?>" class="btn btn-info">
                                		<i class="icon-eye-open"></i>
                                </a>     
                                                             <?php //}?>
                                                            
                                 <a href="#"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('Send Notice');?>" class="btn btn-info">
                                		<i class="icon-columns"></i>
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
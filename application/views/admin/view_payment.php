<div class="box">
        <div class="box-header">
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('search_panel');?>
                    	</a></li>
		</ul>
        </div>
    	<!------CONTROL TABS END------->
        <div class="box-content padded">
            <div class="tab-content">            
                <!----TABLE LISTING STARTS--->
                <div class="tab-pane box active" id="list">
                    <div class="control-group">
                        <?php echo form_open('admin/view_payment/weekly/' , array('class' => 'form-horizontal validatable'));?>
                            <input type="text" class="datepicker fill-up" name="start_date" id="moveout_date" required placeholder="Start Date">
                            <input type="text" class="datepicker fill-up" name="end_date" id="moveout_date" required placeholder="End Date">
                            <button class="btn btn-blue" type="submit">Search</button>
                        </form> <?php echo form_close();?> 
                    </div>
                </div>

            </div>
        </div>
</div>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('view_payment');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                                <tr>
                                    <th><div>#</div></th>
                                    <th><div><?php echo get_phrase('tenant_name');?></div></th>
                                    <th><div><?php echo get_phrase('due_date');?></div></th>
                                    <th><div><?php echo get_phrase('rent_amount');?></div></th>
                                    <th><div><?php echo get_phrase('late_fee');?></div></th>
                                    <th><div><?php echo get_phrase('deposit_');?></div></th>
                                    <th><div><?php echo get_phrase('total_amount');?></div></th>
                                    <th><div><?php echo get_phrase('amount_paid');?></div></th>
                                    <th><div><?php echo get_phrase('due_amount');?></div></th>
                                    <th><div><?php echo get_phrase('status_');?></div></th>
                                    <th><div><?php echo get_phrase('private_note');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
						$count = 1;
						foreach($payments as $row):
                                                        $total_fee = ($row['rentAmount'] + $row['lateFee']);
                                                        $tenantname = $this->Operation_Model->getSingleDataOfTable('tenant_name', 'tenant_id', $row['tenantId'], 'p_tenant');
                                                        $paid_amnt = $this->Operation_Model->getPaidAmount($row['tenantId']);
                                                        $due_amnt = ($paid_amnt - $total_fee);
							?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $tenantname;?></td>
								<td><?php echo $row['moveoutDate'];?></td>
								<td><?php echo '$'.$row['rentAmount'];?></td>   
								<td><?php echo $row['lateFee'];?></td>
                                                                <td><?php echo '$'.$row['securityDeposit']; ?></td>
								<td><?php echo '$'.$total_fee;?></td>
								<td><?php echo '$'.$paid_amnt;?></td>
                                                                <td><?php echo '$'.$due_amnt;?></td>
								<td><?php if($due_amnt == 0){ echo 'Paid';}else{ echo 'Unpaid';}?></td>
                                                              <td><?php echo $row['notice'];?></td>
							</tr>
							<?php 
						endforeach;
						?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>
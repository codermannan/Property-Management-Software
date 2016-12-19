<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_workorder)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_work_orders');?>
                    	</a></li>
            <?php endif;?>
                        <li class="<?php if(!isset($edit_workorder)) echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('work_orders');?>
                    	</a></li>
                        
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_work_orders');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_workorder)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                 <div class="box-content">
                     <?php foreach($edit_workorder as $row):?>
                    <?php echo form_open('admin/manage_work_order/edit/do_update/'.$row['wo_id'] , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('contractor_');?></label>
                                <div class="controls">
                                    <select name="contractor" required="">
                                        <option value="">Please Select</option>
                                        <option value="1" <?php if ($row['contractor']==1){?> selected <?php } ?>>Diversified Renovating Solutions</option>
                                        <option value="2" <?php if ($row['contractor']==2){?> selected <?php } ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('job_title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="job_title" value="<?php echo $row['JobTitle'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Job Description');?></label>
                                <div class="controls">
                                    <textarea name="job_description" cols="30" rows="5" required="" ><?php echo $row['JobDescription'];?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Material 1 Cost');?></label>
                                <div class="controls">
                                    <input type="text" name="mat_1_cost" value="<?php echo $row['Material1Cost'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label"><?php echo get_phrase('Material 1 Description');?></label>
                                <div class="controls">
                                    <textarea name="mate_1_description" cols="30" rows="5">value="<?php echo $row['Material1Description'];?>"</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Labor 1');?></label>
                                <div class="controls">
                                    <input type="text" name="labor_1" placeholder="Enter Labor Charge" value="<?php echo $row['Labor1Charge'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Paid?');?></label>
                                <div class="controls">
                                    <select name="PaidStatus">
                                        <option value="">Please Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_address');?></label>
                                <div class="controls">
                                    <select name="property_address">
                                        <option value="">Please Select</option>
                                        <?php if(isset($property)):?>
                                            <?php foreach($property as $pr):?>
                                            <option value="<?php echo $pr['property_id'];?>" <?php if ($row['PropertyId']==$pr['property_id']){?> selected <?php } ?>><?php echo $pr['property_name'];?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('work_done?');?></label>
                                <div class="controls">
                                    <select name="work_done">
                                        <option value="">Please Select</option>
                                        <option value="Yes" <?php if ($row['isWorkDone']=='Yes'){?> selected <?php } ?>>Yes</option>
                                        <option value="Pending Payment" <?php if ($row['isWorkDone']=='Pending Payment'){?> selected <?php } ?>>Pending Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Note');?></label>
                                <div class="controls">
                                    <textarea name="note" cols="30" rows="5"><?php echo $row['Notes'];?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Material 2 Cost');?></label>
                                <div class="controls">
                                    <input type="text" name="mat_2_cost" value="<?php echo $row['Labor2Charge'];?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Material 2 Description');?></label>
                                <div class="controls">
                                    <textarea name="mate_2_description" cols="30" rows="5"><?php echo $row['Material2Description'];?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Labor 2');?></label>
                                <div class="controls">
                                    <input type="text" name="labor_2" placeholder="Enter Labor Charge" value="<?php echo $row['Labor2Charge'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Authorized?');?></label>
                                <div class="controls">
                                    <select name="authorized">
                                        <option value="">Please Select</option>
                                        <option value="Approve">Approve</option>
                                        <option value="Decline">Decline</option>
                                        <option value="Defer">Defer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            
                            
                        </div>
                    <div style="clear:both;"></div>
                    
                    <div class="form-actions twoside">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('Update');?></button>
                        </div>
                    <?php echo form_close();?> 
                    <?php endforeach;?>
                </div>           
                
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_workorder))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                                    <th><div><?php echo get_phrase('wo#');?></div></th>
                                    <th><div><?php echo get_phrase('Timestamp');?></div></th>
                                    <th><div><?php echo get_phrase('job_title');?></div></th>
                                    <th><div><?php echo get_phrase('Contractor');?></div></th>
                                    <th><div><?php echo get_phrase('property_address');?></div></th>
                                    <th><div><?php echo get_phrase('Total Expense');?></div></th>
                                    <th><div><?php echo get_phrase('Authorized ');?></div></th>
                                    <th><div><?php echo get_phrase('payment_status ');?></div></th>
                                    <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($work_order as $row):
                            $totalExpense = ($row['Material1Cost'] + $row['Material2Cost'] + $row['Labor1Charge'] + $row['Labor2Charge']);
                            $property_name = $this->Operation_Model->getSingleDataOfTable('property_name', 'property_id', $row['PropertyId'], 'property');
                        ?>
                        
                        <tr>
                            <td><?php echo $row['wo_id'];?></td>
                            <td><?php echo date('m-d-Y',  strtotime($row['Timestamp']));?></td>
                            <td><?php echo $row['JobTitle'];?></td>
                            <td><?php if($row['contractor']==1): echo 'Diversified Renovating Solutions'; else: echo 'Other'; endif;?></td>
                            <td><?php echo $property_name;?></td>
                            <td><?php echo '$'.$totalExpense;?></td>
                            <?php if($row['isAuthorized']=='Approve'):?><td style="text-align: center; color: #eaebef; font-weight: 600; background-color: green;"><?php echo $row['isAuthorized'];?></td>
                            <?php elseif($row['isAuthorized']=='Decline'):?><td style="background-color: rgb(255, 0, 0); text-align: center; font-weight: bold; color: rgb(255, 255, 255);"><?php echo $row['isAuthorized'];?></td>
                            <?php elseif($row['isAuthorized']=='Defer'):?><td style="background-color: rgb(254, 191, 16); text-align: center; color: rgb(18, 73, 239); font-weight: 600;"><?php echo $row['isAuthorized'];?></td><?php endif;?>
                            
                            <?php if($row['isPaid']=='Yes'):?><td style="text-align: center; color: #eaebef; font-weight: 600; background-color: green;"><?php echo $row['isPaid'];?></td>
                            <?php elseif($row['isPaid']=='No'):?><td style="background-color: rgb(255, 0, 0); text-align: center; font-weight: bold; color: rgb(255, 255, 255);"><?php echo $row['isPaid'];?></td><?php endif;?> 
                           
							
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_work_order/edit/<?php echo $row['wo_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
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
			</div>
            <!----TABLE LISTING ENDS--->
            
            
		<!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_work_order/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('contractor_');?></label>
                                <div class="controls">
                                    <select name="contractor" required="">
                                        <option value="">Please Select</option>
                                        <option value="1">Diversified Renovating Solutions</option>
                                        <option value="2">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('job_title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="job_title"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Job Description');?></label>
                                <div class="controls">
                                    <textarea name="job_description" cols="30" rows="5" required=""></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Material 1 Cost');?></label>
                                <div class="controls">
                                    <input type="text" name="mat_1_cost"/>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label"><?php echo get_phrase('Material 1 Description');?></label>
                                <div class="controls">
                                    <textarea name="mate_1_description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Labor 1');?></label>
                                <div class="controls">
                                    <input type="text" name="labor_1" placeholder="Enter Labor Charge"/>
                                </div>
                            </div>
                             
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_address');?></label>
                                <div class="controls">
                                    <select name="property_address">
                                        <option value="">Please Select</option>
                                        <?php if(isset($property)):?>
                                            <?php foreach($property as $row):?>
                                            <option value="<?php echo $row['property_id'];?>"><?php echo $row['property_name'];?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('work_done?');?></label>
                                <div class="controls">
                                    <select name="work_done">
                                        <option value="">Please Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="Pending Payment">Pending Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Note');?></label>
                                <div class="controls">
                                    <textarea name="note" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Material 2 Cost');?></label>
                                <div class="controls">
                                    <input type="text" name="mat_2_cost"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Material 2 Description');?></label>
                                <div class="controls">
                                    <textarea name="mate_2_description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Labor 2');?></label>
                                <div class="controls">
                                    <input type="text" name="labor_2" placeholder="Enter Labor Charge"/>
                                </div>
                            </div>
                        </div>
                            
                            
                        </div>
                    <div style="clear:both;"></div>
                    
                    <div class="form-actions twoside">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('Submit');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
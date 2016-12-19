<script>
    function loadtxtBox(val){
        if(val == 1){
            document.getElementById('fixedAmount').style = 'display:block, width:12%'
            document.getElementById('ratioAmount').style = 'display:none'
        }else if(val == 2){
            document.getElementById('ratioAmount').style = 'display:block ,width:10%'
            document.getElementById('fixedAmount').style = 'display:none'
        }
    }
</script>

<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_late_fee_rule');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('late_fee_rule_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_late_fee_rule');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_profile as $row):?>
                    <?php echo form_open('admin/manage_noticeboard/edit/do_update/'.$row['notice_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="notice_title" value="<?php echo $row['notice_title'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('notice');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="notice" value="<?php echo $row['notice'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="create_timestamp" value="<?php echo date('m/d/Y',$row['create_timestamp']);?>"/>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_noticeboard');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('fee_title');?></div></th>
                    		<th><div><?php echo get_phrase('fee_type');?></div></th>
                    		<th><div><?php echo get_phrase('frequency_');?></div></th>
                                <th><div><?php echo get_phrase('fee_amount');?></div></th>
                                <th><div><?php echo get_phrase('fee_ratio');?></div></th>
                                <th><div><?php echo get_phrase('due_day');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($late_fee as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['fee_title'];?></td>
							<td><?php echo $row['fee_type'];?></td>
							<td><?php echo $row['fee_frequency'];?></td>
                                                        <td><?php echo $row['fee_amount'];?></td>
                                                        <td><?php echo $row['fee_ratio'];?></td>
                                                        <td><?php echo $row['due_day'];?></td>
							<td align="center">
                            	<a href="#"
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
                    <?php echo form_open('admin/manage_late_fee/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('fee_title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="fee_title"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('fee_type');?></label>
                                <div class="controls">
                                    <select name="fee_type" required="">
                                                <option value="">Select Fee Type</option>
                                                <option value="Per Day Fee">Per Day Fee</option>
                                                <option value="Per Month Fee">Per Month Fee</option>
                                     </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('frequency_');?></label>
                                <div class="controls">
                                    <select name="frequency" required="" onchange="loadtxtBox(this.value)">
                                                <option value="">Select Frequency</option>
                                                <option value="1">Fixed Amount</option>
                                                <option value="2">Percent of Rent</option>
                                    </select>
                                    <input type="text" class="validate[required]" id="fixedAmount" name="amount" style="width:12%; display: none;" placeholder="Enter Fixed Amount"/>
                                    <input type="text" class="validate[required]" id="ratioAmount" name="ratio" style="width:10%; display: none;" placeholder="Enter Ratio"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('due_day');?></label>
                                <div class="controls">
                                    <select name="due_day" required="">
                                                <option value="">Select Due Day</option>
                                                <option value="1">1 Day</option>
                                                <option value="2">2 Day</option>
                                                <option value="3">3 Day</option>
                                                <option value="4">4 Day</option>
                                                <option value="5">5 Day</option>
                                     </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_late_fee');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
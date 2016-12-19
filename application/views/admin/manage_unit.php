<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_unit)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_unit');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_unit))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('unit_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_unit');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_unit)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_unit as $row):?>
                    <?php echo form_open('admin/manage_unit/edit/do_update/'.$row['unit_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('unit_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="unit_name" value="<?php echo $row['unit_name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('unit_type');?></label>
                                <div class="controls">
                                    <select name="unit_type"  style="width: 25%;">
                                            <option <?php if($row['unit_type']=='Studio'){?>selected="selected"<?php } ?> value="Studio">Studio</option>
                                            <option <?php if($row['unit_type']=='Shared Weekly'){?>selected="selected"<?php } ?> value="Shared Weekly">Shared Weekly</option>
                                            <option <?php if($row['unit_type']=='Weekly Studio'){?>selected="selected"<?php } ?> value="Weekly Studio">Weekly Studio</option>
                                            <option <?php if($row['unit_type']=='1bed/1bath'){?>selected="selected"<?php } ?> value="1bed/1bath">1bed/1bath</option>
                                            <option <?php if($row['unit_type']=='2bed/1bath'){?>selected="selected"<?php } ?> value="2bed/1bath">2bed/1bath</option>
                                            <option <?php if($row['unit_type']=='2 bed/2 bath'){?>selected="selected"<?php } ?> value="2 bed/2 bath">2 bed/2 bath</option>
                                            <option <?php if($row['unit_type']=='3bed/1bath'){?>selected="selected"<?php } ?> value="3bed/1bath">3bed/1bath</option>
                                            <option <?php if($row['unit_type']=='3 bed/2 bath'){?>selected="selected"<?php } ?> value="3 bed/2 bath">3 bed/2 bath</option>
                                            <option <?php if($row['unit_type']=='4 bed/2bath'){?>selected="selected"<?php } ?> value="4 bed/2bath">4 bed/2bath</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_name');?></label>
                                <div class="controls">
                                    <select name="property_name" style="width: 25%;">
                                        <?php if(isset($property)):
                                                foreach ($property as $value) {
                                           ?>
                                            <option selected="selected" value="<?php echo $value['property_id'];?>"><?php echo $value['property_name'];?></option>
                                         <?php } else:?> 
                                             <option value='0'>Data Not Found</option>   
                                         <?php endif;?>   
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bedrooms');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="bedrooms" value="<?php echo $row['bedrooms'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bathrooms');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="bathrooms" value="<?php echo $row['bathrooms'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Target Rent');?></label>
                                <div class="controls">
                                    <input type="text" name="trent" style="width: 8%;" value="<?php echo $row['trent'];?>"/>
                                    <select name="trent_period" style="width: 16%;">
                                        <option <?php if($row['trent_period']=='Monthly'){?>selected="selected"<?php } ?> value="Monthly">Monthly</option>
                                        <option <?php if($row['trent_period']=='Weekly'){?>selected="selected"<?php } ?> value="Weekly">Weekly</option>
                                        <option <?php if($row['trent_period']=='Yearly'){?>selected="selected"<?php } ?> value="Yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_unit');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_unit))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('unit_name');?></div></th>
                    		<th><div><?php echo get_phrase('unit_type');?></div></th>
                                <th><div><?php echo get_phrase('property_name');?></div></th>
                                <th><div><?php echo get_phrase('Rent Rate');?></div></th>
                                <th><div><?php echo get_phrase('Room Status');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($units as $row):?>
                        <?php if($row['vacant_status']==0):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['unit_name'];?></td>
							<td><?php echo $row['unit_type'];?></td>
                                                        <td><?php echo $row['property_name'];?></td>
                                                        <td><?php echo '$'.$row['trent'];?></td>
                                                        <td><?php echo 'Available';?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_unit/edit/<?php echo $row['unit_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_unit/delete/<?php echo $row['unit_id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
                                </a>
        					</td>
                        </tr>
                        <?php else:?>
                        <tr class="book">
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['unit_name'];?></td>
							<td><?php echo $row['unit_type'];?></td>
                                                        <td><?php echo $row['property_name'];?></td>
                                                        <td><?php echo '$'.$row['trent'];?></td>
                                                        <td><?php echo 'Vacant';?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_unit/edit/<?php echo $row['unit_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_unit/delete/<?php echo $row['unit_id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endif;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/manage_unit/create' , array('class' =>'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('unit_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="unit_name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('unit_type');?></label>
                                <div class="controls">
                                    <select name="unit_type"  style="width: 25%;">
                                            <option selected="selected" value="0">Please Select</option>
                                            <option value="Studio">Studio</option>
                                            <option value="Shared Weekly">Shared Weekly</option>
                                            <option value="Weekly Studio">Weekly Studio</option>
                                            <option value="1bed/1bath">1bed/1bath</option>
                                            <option value="2bed/1bath">2bed/1bath</option>
                                            <option value="2 bed/2 bath">2 bed/2 bath</option>
                                             <option value="3bed/1bath">3bed/1bath</option>
                                            <option value="3 bed/2 bath">3 bed/2 bath</option>
                                            <option value="4 bed/2bath">4 bed/2bath</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_name');?></label>
                                <div class="controls">
                                    <select name="property_name" style="width: 25%;">
                                        <?php if(isset($property)):
                                                foreach ($property as $value) {
                                           ?>
                                            <option selected="selected" value="<?php echo $value['property_id'];?>"><?php echo $value['property_name'];?></option>
                                         <?php } else:?> 
                                             <option value='0'>Data Not Found</option>   
                                         <?php endif;?>   
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bedrooms');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="bedrooms"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bathrooms');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="bathrooms"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Target Rent');?></label>
                                <div class="controls">
                                    <input type="text" name="trent" style="width: 8%;"/>
                                    <select name="trent_period" style="width: 16%;">
                                        <option selected="selected" value="0">Please Select</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_unit');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
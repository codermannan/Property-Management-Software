<script>
function getVacantUnit(str)
    {        
            var xmlhttp;
            
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                      var jsonObject = JSON.parse(xmlhttp.responseText);
                      
                        if (jsonObject != null){
                            $("#propertyUnit").empty();
                            var i = 0; 
                            $.each(jsonObject, function () {
                                $("#propertyUnit").append($("<option></option>").val(jsonObject[i].unit_name).html(jsonObject[i].unit_name));
                                i++;
                            });
                        }
                }
              }
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/retrieveVacantData/"+str,true);
            xmlhttp.send();
    }
</script>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_maintenance_log)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_maintenance_log');?>
                    	</a></li>
            <?php endif;?>
                        <li class="<?php if(!isset($edit_maintenance_log)) echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('maintenance_log');?>
                    	</a></li>
                        
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_maintenance_log');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_maintenance_log)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                 <div class="box-content">
                     <?php foreach($edit_maintenance_log as $row):?>
                    <?php echo form_open('admin/manage_maintenance_log/edit/do_update/'.$row['log_id'] , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('contractor_');?></label>
                                <div class="controls">
                                    <select name="contractor" required="">
                                        <option value="">Please Select</option>
                                        <option value="1" <?php if ($row['contractor']==1){?> selected <?php } ?>>Diversified Renovating Solutions</option>
                                        <option value="2" <?php if ($row['contractor']==2){?> selected <?php } ?>>Mike</option>
                                        <option value="2" <?php if ($row['contractor']==3){?> selected <?php } ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('category_');?></label>
                                <div class="controls">
                                    <select name="category" required="">
                                        <option value="">Please Select</option>
                                        <option value="1" <?php if ($row['Category']==1){?> selected <?php } ?>>Yard Maintenance</option> 
                                        <option value="2" <?php if ($row['Category']==2){?> selected <?php } ?>>Electrical</option> 
                                        <option value="3" <?php if ($row['Category']==3){?> selected <?php } ?>>HVAC</option> 
                                        <option value="4" <?php if ($row['Category']==4){?> selected <?php } ?>>Plumbing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('maintenance _title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="maintenance_title" value="<?php echo $row['MaintenanceTitle'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('maintenance_description');?></label>
                                <div class="controls">
                                    <textarea name="maintenance_description" cols="30" rows="5" required=""><?php echo $row['Description'];?></textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_address');?></label>
                                <div class="controls">
                                    <select name="property_address" required="" onchange="getVacantUnit(this.value);">
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
                                <label class="control-label"><?php echo get_phrase('property_unit');?></label>
                                <div class="controls">
                                    <select name="property_unit" id="propertyUnit">
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('when_done?');?></label>
                                <div class="controls">
                                    <input type="text" name="when_done" required="" class="datepicker fill-up"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('note_');?></label>
                                <div class="controls">
                                    <textarea name="note" cols="30" rows="5" required=""><?php echo $row['Notes'];?></textarea>
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
            <div class="tab-pane box <?php if(!isset($edit_maintenance_log))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                                    <th><div><?php echo get_phrase('log_id#');?></div></th>
                                    <th><div><?php echo get_phrase('Timestamp');?></div></th>
                                    <th><div><?php echo get_phrase('maintenance title');?></div></th>
                                    <th><div><?php echo get_phrase('Contractor');?></div></th>
                                    <th><div><?php echo get_phrase('property_address');?></div></th>
                                    <th><div><?php echo get_phrase('unit_name');?></div></th>
                                    <th><div><?php echo get_phrase('category_');?></div></th>
                                    <th><div><?php echo get_phrase('when_done');?></div></th>
                                    <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($maintenance_log as $row):
                            $property_name = $this->Operation_Model->getSingleDataOfTable('property_name', 'property_id', $row['PropertyId'], 'property');
                        ?>
                        
                        <tr>
                            <td><?php echo $row['log_id'];?></td>
                            <td><?php echo date('m-d-Y',  strtotime($row['Timestamp']));?></td>
                            <td><?php echo $row['MaintenanceTitle'];?></td>
                            <td><?php if($row['contractor']==1): echo 'Diversified Renovating Solutions'; elseif($row['contractor']==2): echo 'Mike'; else: echo 'Other'; endif;?></td>
                            <td><?php echo $property_name;?></td>
                            <td><?php echo $row['UnitName'];?></td>
                            <td><?php if($row['Category']==1): echo 'Yard Maintenance'; elseif($row['Category']==2): echo 'Electrical'; elseif($row['Category']==3): echo 'HVAC'; else: echo 'Plumbing'; endif;?></td>
                            <td><?php echo $row['when_done'];?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_maintenance_log/edit/<?php echo $row['log_id'];?>"
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
                    <?php echo form_open('admin/manage_maintenance_log/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('contractor_');?></label>
                                <div class="controls">
                                    <select name="contractor" required="">
                                        <option value="">Please Select</option>
                                        <option value="1">Diversified Renovating Solutions</option>
                                        <option value="2">Mike</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('category_');?></label>
                                <div class="controls">
                                    <select name="category" required="">
                                        <option value="">Please Select</option>
                                        <option value="1">Yard Maintenance</option> 
                                        <option value="2">Electrical</option> 
                                        <option value="3">HVAC</option> 
                                        <option value="4">Plumbing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('maintenance _title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="maintenance_title"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('maintenance_description');?></label>
                                <div class="controls">
                                    <textarea name="maintenance_description" cols="30" rows="5" required=""></textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_address');?></label>
                                <div class="controls">
                                    <select name="property_address" required="" onchange="getVacantUnit(this.value);">
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
                                <label class="control-label"><?php echo get_phrase('property_unit');?></label>
                                <div class="controls">
                                    <select name="property_unit" id="propertyUnit">
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('when_done?');?></label>
                                <div class="controls">
                                    <input type="text" name="when_done" required="" class="datepicker fill-up"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('note_');?></label>
                                <div class="controls">
                                    <textarea name="note" cols="30" rows="5" required=""></textarea>
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
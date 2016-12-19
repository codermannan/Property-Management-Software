<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_property)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_property');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_property))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('property_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_property');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_property)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_property as $row):?>
                    <?php echo form_open('admin/manage_property/edit/do_update/'.$row['property_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Type');?></label>
                                <div class="controls">
                                    <select name="property_type" class="uniform" style="width:100%;" class="validate[required]">
                                                <option value="">Select Property Type</option>
                                                <option value="1" <?php if($row['property_type']==1){?>selected="selected"<?php } ?>>Office</option>
                                                <option value="2" <?php if($row['property_type'] == 2){?> selected="selected" <?php } ?>>Industrial</option>
                                                <option value="3" <?php if($row['property_type'] == 3){?> selected="selected" <?php } ?>>Retail</option>
                                                <option value="4" <?php if($row['property_type'] == 4){?> selected="selected" <?php } ?>>Healthcare</option>
                                                <option value="5" <?php if($row['property_type'] == 5){?> selected="selected" <?php } ?>>Government</option>
                                                <option value="6" <?php if($row['property_type'] == 6){?> selected="selected" <?php } ?>>Airport</option>
                                                <option value="7" <?php if($row['property_type'] == 7){?> selected="selected" <?php } ?>>Garage/Parking</option>
                                                <option value="8" <?php if($row['property_type'] == 8){?> selected="selected" <?php } ?>>Apartment Building</option>
                                                <option value="9" <?php if($row['property_type'] == 9){?> selected="selected" <?php } ?>>Duplex / Triplex</option>
                                                <option value="10" <?php if($row['property_type']== 10){?>selected<?php } ?>>Mobile Home / RV Community</option>
                                                <option value="11" <?php if($row['property_type'] == 11){?> selected="selected" <?php } ?>>Garage/Parking</option>
                                                <option value="12" <?php if($row['property_type'] == 12){?> selected="selected" <?php } ?>>Residential</option>
                                     </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="property_name" value="<?php echo $row['property_name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Frequency_');?></label>
                                <div class="controls">
                                    <select name="frequency" required="required">
                                        <option value="Weekly" <?php if($row['frequency']=='Weekly'){?>selected="selected"<?php } ?>>Weekly</option>
                                        <option value="Monthly" <?php if($row['frequency']=='Monthly'){?>selected="selected"<?php } ?>>Monthly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Number of Units');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="unit" value="<?php echo $row['unit'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Total Area');?></label>
                                <div class="controls">
                                    <input type="text" name="tarea" style="width: 37%;" value="<?php echo $row['tarea'];?>"/>
                                    <select name="tarea_munit" style="width: 25%;">
                                        <option value="Sq Ft"<?php if($row['tarea_munit'] == 'Sq Ft'){?> selected="selected" <?php } ?>>Sq Ft</option>
                                        <option value="Sq M"<?php if($row['tarea_munit'] == 'Sq M'){?> selected="selected" <?php } ?>>Sq M</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Address.');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="property_address" value="<?php echo $row['property_address'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('City');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="city" value="<?php echo $row['city'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('County');?></label>
                                <div class="controls">
                                    <select name="property_country" class="validate[required]">
                                        <option <?php if($row['property_country'] == 'usa'){?> selected="selected" <?php } ?> value="usa">United State</option>
                                        <option <?php if($row['property_country'] == 'uk'){?> selected="selected" <?php } ?> value="uk">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('State/Province');?></label>
                                <div class="controls">
                                    <select name="property_province" class="validate[required]">
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>	
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Zip/Postal Code');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="zip_code" value="<?php echo $row['zip_code'];?>"/>
                                </div>
                            </div>
                        </div>
                            
                            
                        </div>
                        <div style="clear:both;"></div>
                         <div class="form-actions twoside">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_property');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_property))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('property_name');?></div></th>
                    		<th><div><?php echo get_phrase('Address_');?></div></th>
                    		<th><div><?php echo get_phrase('total_units');?></div></th>
                                <th><div><?php echo get_phrase('Edit');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($property as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['property_name'];?></td>
							<td><?php echo $row['property_address'];?></td>
                                                        <td><?php echo $row['unit'];?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_property/edit/<?php echo $row['property_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
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
                    <?php echo form_open('admin/manage_property/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Type');?></label>
                                <div class="controls">
                                    <select name="property_type" class="uniform" style="width:100%;" class="validate[required]">
                                                <option value="">Select Property Type</option>
                                                <option value="1">Office</option>
                                                <option value="2">Industrial</option>
                                                <option value="3">Retail</option>
                                                <option value="4">Healthcare</option>
                                                <option value="5">Government</option>
                                                <option value="6">Airport</option>
                                                <option value="7">Garage/Parking</option>
                                                <option value="8">Apartment Building</option>
                                                <option value="9">Duplex / Triplex</option>
                                                <option value="10">Mobile Home / RV Community</option>
                                                <option value="11">Garage/Parking</option>
                                                <option value="12">Residential</option>
                                     </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="property_name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Frequency_');?></label>
                                <div class="controls">
                                    <select name="frequency" required="required">
                                        <option selected="selected" value="0">Please Select</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Number of Units');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="unit"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Total Area');?></label>
                                <div class="controls">
                                    <input type="text" name="tarea" style="width: 37%;"/>
                                    <select name="tarea_munit" style="width: 25%;">
                                        <option selected="selected" value="Sq Ft">Sq Ft</option>
                                        <option value="Sq M">Sq M</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Address.');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="property_address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('City');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="city"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('County');?></label>
                                <div class="controls">
                                    <select name="property_country" class="validate[required]">
                                        <option selected="selected" value="usa">United State</option>
                                        <option value="uk">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('State/Province');?></label>
                                <div class="controls">
                                    <select name="property_province" class="validate[required]">
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>	
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Zip/Postal Code');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="zip_code"/>
                                </div>
                            </div>
                        </div>
                            
                            
                        </div>
                    <div style="clear:both;"></div>
                    
                    <div class="form-actions twoside">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('Save');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
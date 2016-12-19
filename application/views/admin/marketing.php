<script>
    //----------
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
                {      console.log(xmlhttp.responseText);
                      var jsonObject = JSON.parse(xmlhttp.responseText);
                      
                        if (jsonObject != null){
                            $("#vacantUnit").empty();
                            var i = 0; 
                            $.each(jsonObject, function () {
                                $("#vacantUnit").append($("<option></option>").val(jsonObject[i].unit_id).html(jsonObject[i].unit_name));
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
			<li class="<?php if(!isset($edit_property))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('advertisement_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('marketing_entry_form');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_marketing))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('image_');?></div></th>
                    		<th><div><?php echo get_phrase('short_description');?></div></th>
                    		<th><div><?php echo get_phrase('property_type');?></div></th>
                                <th><div><?php echo get_phrase('property_address');?></div></th>
                                <th><div><?php echo get_phrase('unit_name');?></div></th>
                                <th><div><?php echo get_phrase('unit_type');?></div></th>
                                <th><div><?php echo get_phrase('rent_');?></div></th>
                                <th><div><?php echo get_phrase('available_date');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($marketing as $row):?>
                        <?php
                            $propertytype    = $this->Operation_Model->getSingleDataOfTable('property_type', 'property_id', $row['propertyName'], 'property');
                            $propertyaddress = $this->Operation_Model->getSingleDataOfTable('property_address', 'property_id', $row['propertyName'], 'property'); 
                        ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><img width="75" height="75" src="<?php echo base_url().'/uploads/marketing/'.$row['imageUpload'];?>" data-phototype="buildingPhoto"></td>
                            <td><?php echo $row['shortDescription'];?></td>
                            <td><?php if($propertytype == 12): echo 'Residential'; endif;?></td>
                            <td><?php echo $propertyaddress;?></td>
                            <td><?php echo $row['unit_name'];?></td>
                            <td><?php echo $row['unit_type'];?></td>
                            <td><?php echo $row['trent'];?></td>
                            <td><?php echo $row['availableDate'];?></td>	
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
		<!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open_multipart('admin/manage_marketing/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Marketing Name :');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="marketingname" id="marketingname"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Posting Title :');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="postingTitle" id="postingTitle"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Description :');?></label>
                                <div class="controls">
                                    <textarea name="description" cols="2" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Short Description :');?></label>
                                <div class="controls">
                                    <input type="text" name="shortdescription" id="shortdescription"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <select name="property_name" id="propertyId" onchange="getVacantUnit(this.value);" required>
                                        <option value="" selected="selected">Please Select</option>
                                        <?php if(isset($property)):
                                                foreach ($property as $value) {
                                           ?>
                                            <option value="<?php echo $value['property_id'];?>"><?php echo $value['property_name'];?></option>
                                         <?php } else:?> 
                                             <option value='0'>Data Not Found</option>   
                                         <?php endif;?>   
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('vacant_unit');?></label>
                                <div class="controls">
                                    <select name="vacant_unit" class="validate[required]" id="vacantUnit" required>
                                        <option value="" selected="selected">Please Select</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Available Date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="available_date" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Website :');?></label>
                                <div class="controls">
                                    <input type="text" name="website"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Featured Rental');?></label>
                                <div class="controls">
                                    <select name="featured_rental">
                                        <option value="">Please Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Published Rental');?></label>
                                <div class="controls">
                                    <select name="published">
                                        <option value="">Please Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('For Sale');?></label>
                                <div class="controls">
                                    <select name="forsale">
                                        <option value="">Please Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Allow Pets');?></label>
                                <div class="controls">
                                    <select name="AllowPets">
                                        <option value="">Please Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Allow Smoking');?></label>
                                <div class="controls">
                                     <select name="AllowSmoking">
                                         <option value="">Please Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Image Upload');?></label>
                                <div class="controls">
                                    <input type="file" name="propertyImage" multiple/>
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
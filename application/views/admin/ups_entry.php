<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
                    <?php if(isset($edit_ups)):?>
                            <li class="active">
                    <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
                                            <?php echo get_phrase('edit_ups');?>
                            </a></li>
                    <?php endif;?>
                            <li class="<?php if(!isset($edit_ups)) echo 'active';?>">
                    <a href="#gen_list" data-toggle="tab"><i class="icon-align-justify"></i> 
                                            <?php echo get_phrase('general_admin');?>
                            </a></li>
                            <li>
                    <a href="#p1_list" data-toggle="tab"><i class="icon-align-justify"></i> 
                                            <?php echo get_phrase('4202_N_10');?>
                            </a></li>
                            <li>
                    <a href="#p2_list" data-toggle="tab"><i class="icon-align-justify"></i> 
                                            <?php echo get_phrase('4214_N_10th_St');?>
                            </a></li>
                            <li>
                    <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                                            <?php echo get_phrase('add_ups');?>
                            </a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_ups)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                 <div class="box-content">
                     <?php foreach($edit_ups as $row):?>
                    <?php echo form_open('admin/universal_pass_storer/edit/do_update/'.$row['storer_id'] , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('storer_for');?></label>
                                <div class="controls">
                                    <select name="storer_for" required="">
                                        <option value="">Please Select</option>
                                        <option value="100"<?php if($row['storer_for']==100):?> selected<?php endif;?>>General Admin</option>
                                        <?php if(isset($property)):?>
                                            <?php foreach($property as $pr):?>
                                            <option value="<?php echo $pr['property_id'];?>" <?php if ($row['storer_for']==$pr['property_id']){?> selected <?php } ?>><?php echo $pr['property_name'];?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('site_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="site" value="<?php echo $row['site'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name_status');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name_status" value="<?php echo $row['name_status'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address_on_file');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="address_on_file" value="<?php echo $row['address_on_file'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label"><?php echo get_phrase('user_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="user_name" value="<?php echo $row['username'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="password" value="<?php echo $row['pass'];?>"/>
                                </div>
                            </div>
                             
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('account#_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="account" value="<?php echo $row['account'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('website_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="website" value="<?php echo $row['website'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('note_');?></label>
                                <div class="controls">
                                    <textarea name="note" cols="30" rows="5"><?php echo $row['notes'];?></textarea>
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
            <div class="tab-pane box <?php if(!isset($edit_ups))echo 'active';?>" id="gen_list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                                    <th><div><?php echo get_phrase('site_');?></div></th>
                                    <th><div><?php echo get_phrase('name_status');?></div></th>
                                    <th><div><?php echo get_phrase('address_on_file');?></div></th>
                                    <th><div><?php echo get_phrase('username_');?></div></th>
                                    <th><div><?php echo get_phrase('pass_');?></div></th>
                                    <th><div><?php echo get_phrase('account_');?></div></th>
                                    <th><div><?php echo get_phrase('website_');?></div></th>
                                    <th><div><?php echo get_phrase('phone_');?></div></th>
                                    <th><div><?php echo get_phrase('notes_');?></div></th>
                                    <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($gen_admin as $row):
                        ?>
                        
                        <tr>
                            <td><?php echo $row['site'];?></td>
                            <td><?php echo $row['name_status'];?></td>
                            <td><?php echo $row['address_on_file'];?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['pass'];?></td>
                            <td><?php echo $row['account'];?></td>
                            <td><?php echo $row['website'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['notes'];?></td>
                            
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/universal_pass_storer/edit/<?php echo $row['storer_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING general admin--->
            <!----TABLE LISTING property 1--->
            <div class="tab-pane box" id="p1_list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                                    <th><div><?php echo get_phrase('site_');?></div></th>
                                    <th><div><?php echo get_phrase('name_status');?></div></th>
                                    <th><div><?php echo get_phrase('address_on_file');?></div></th>
                                    <th><div><?php echo get_phrase('username_');?></div></th>
                                    <th><div><?php echo get_phrase('pass_');?></div></th>
                                    <th><div><?php echo get_phrase('account_');?></div></th>
                                    <th><div><?php echo get_phrase('website_');?></div></th>
                                    <th><div><?php echo get_phrase('phone_');?></div></th>
                                    <th><div><?php echo get_phrase('notes_');?></div></th>
                                    <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($property1 as $p1):
                        ?>
                        
                        <tr>
                            <td><?php echo $p1['site'];?></td>
                            <td><?php echo $p1['name_status'];?></td>
                            <td><?php echo $p1['address_on_file'];?></td>
                            <td><?php echo $p1['username'];?></td>
                            <td><?php echo $p1['pass'];?></td>
                            <td><?php echo $p1['account'];?></td>
                            <td><?php echo $p1['website'];?></td>
                            <td><?php echo $p1['phone'];?></td>
                            <td><?php echo $p1['notes'];?></td>
                            
							<td align="center">
                            	<a href="#"
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
            <!----TABLE LISTING property2--->
            <div class="tab-pane box" id="p2_list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                                    <th><div><?php echo get_phrase('site_');?></div></th>
                                    <th><div><?php echo get_phrase('name_status');?></div></th>
                                    <th><div><?php echo get_phrase('address_on_file');?></div></th>
                                    <th><div><?php echo get_phrase('username_');?></div></th>
                                    <th><div><?php echo get_phrase('pass_');?></div></th>
                                    <th><div><?php echo get_phrase('account_');?></div></th>
                                    <th><div><?php echo get_phrase('website_');?></div></th>
                                    <th><div><?php echo get_phrase('phone_');?></div></th>
                                    <th><div><?php echo get_phrase('notes_');?></div></th>
                                    <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($property2 as $p2):
                        ?>
                        
                        <tr>
                            <td><?php echo $p2['site'];?></td>
                            <td><?php echo $p2['name_status'];?></td>
                            <td><?php echo $p2['address_on_file'];?></td>
                            <td><?php echo $p2['username'];?></td>
                            <td><?php echo $p2['pass'];?></td>
                            <td><?php echo $p2['account'];?></td>
                            <td><?php echo $p2['website'];?></td>
                            <td><?php echo $p2['phone'];?></td>
                            <td><?php echo $p2['notes'];?></td>
                            
							<td align="center">
                            	<a href="#"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
              <!----property 2 list end---->       
		<!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/universal_pass_storer/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('storer_for');?></label>
                                <div class="controls">
                                    <select name="storer_for" required="">
                                        <option value="">Please Select</option>
                                         <option value="100">General Admin</option>
                                        <?php if(isset($property)):?>
                                            <?php foreach($property as $pr):?>
                                            <option value="<?php echo $pr['property_id'];?>" <?php if ($row['PropertyId']==$pr['property_id']){?> selected <?php } ?>><?php echo $pr['property_name'];?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('site_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="site"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name_status');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name_status"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address_on_file');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="address_on_file"/>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label"><?php echo get_phrase('user_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="user_name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="password"/>
                                </div>
                            </div>
                             
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('account#_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="account"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('website_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="website"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="phone"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('note_');?></label>
                                <div class="controls">
                                    <textarea name="note" cols="30" rows="5"></textarea>
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
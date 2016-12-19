<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_links)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_links');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_links))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('quick_links');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_links');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_links)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_links as $row):?>
                    <?php echo form_open('admin/manage_links/edit/do_update/'.$row['id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('website_title');?></label>
                                <div class="controls">
                                    <input type="text" name="website_title" value="<?php echo $row['website_title'];?>" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('quick_links');?></label>
                                <div class="controls">
                                    <input type="text" name="quick_links" value="<?php echo $row['quick_links'];?>" required/>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                         <div class="form-actions twoside">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_links');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_links))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('links_title');?></div></th>
                                <th><div><?php echo get_phrase('links_');?></div></th>
                                <th><div><?php echo get_phrase('Edit || Delete');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($links as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['website_title'];?></td>
                                                        <td><a href="<?php echo $row['quick_links'];?>" target="_blank"><?php echo $row['quick_links'];?></a></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_links/edit/<?php echo $row['id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_links/delete/<?php echo $row['id'];?>" onclick="return confirm('delete?')"
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
                    <?php echo form_open('admin/manage_links/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('website_title');?></label>
                                <div class="controls">
                                    <input type="text" name="website_title" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('quick_links');?></label>
                                <div class="controls">
                                    <input type="text" name="quick_links" required/>
                                </div>
                            </div>
                            
                        </div>
                    <div style="clear:both;"></div>
                    
                    <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('Save');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
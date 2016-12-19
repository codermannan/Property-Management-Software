<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
                        <li class="<?php if(!isset($edit_project)) echo 'active';?>">
            	<a href="#graph" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('project_graph');?>
                    	</a></li>
                        <li>
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('project_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_project');?>
                    	</a></li>
                    <?php if(isset($edit_project)):?>
                    <li class="active">
                        <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
                                                <?php echo get_phrase('edit_project');?>
                                </a></li>
                    <?php endif;?>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_project)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                 <div class="box-content">
                     <?php foreach($edit_project as $erow):?>
                     
                    <?php echo form_open('admin/manage_project/edit/do_update/'.$erow['project_id'] , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_address');?></label>
                                <div class="controls">
                                    <select name="property_address" required="">
                                        <option value="">Please Select</option>
                                        <?php if(isset($property)):?>
                                            <?php foreach($property as $row):?>
                                        <option value="<?php echo $row['property_id'];?>" <?php if($erow['property_address'] == $row['property_id']):?>selected<?php endif;?>><?php echo $row['property_name'];?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('start_date');?></label>
                                <div class="controls">
                                    <input type="text" name="start_date" required="" class="datepicker fill-up" value="<?php echo date('m-d-Y',  strtotime($erow['start_date']));?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('priority_');?></label>
                                <div class="controls">
                                    <select name="priority">
                                        <option value="">Please Select</option>
                                        <option value="1" <?php if($erow['priority'] == 1):?>selected<?php endif;?>>1</option> 
                                        <option value="2" <?php if($erow['priority'] == 2):?>selected<?php endif;?>>2</option> 
                                        <option value="3" <?php if($erow['priority'] == 3):?>selected<?php endif;?>>3</option> 
                                        <option value="4" <?php if($erow['priority'] == 4):?>selected<?php endif;?>>4</option>
                                        <option value="5" <?php if($erow['priority'] == 5):?>selected<?php endif;?>>5</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('project_title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="project_title" value="<?php echo $erow['project_title'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('end_date');?></label>
                                <div class="controls">
                                    <input type="text" name="end_date" required="" class="datepicker fill-up" value="<?php echo date('m-d-Y',  strtotime($erow['end_date']));?>"/>
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
            
            <!----TABLE GRAPH STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_project))echo 'active';?>" id="graph">
                    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization',
                            'version':'1','packages':['timeline']}]}"></script>
                     <script type="text/javascript">

                     google.setOnLoadCallback(drawChart);
                     function drawChart() {

                       var container = document.getElementById('cis');
                       var chart = new google.visualization.Timeline(container);

                       var dataTable = new google.visualization.DataTable();
                       dataTable.addColumn({ type: 'string', id: 'Position' });
                       dataTable.addColumn({ type: 'string', id: 'Name' });
                       dataTable.addColumn({ type: 'date', id: 'Start' });
                       dataTable.addColumn({ type: 'date', id: 'End' });
                       dataTable.addRows([
                         <?php foreach ($project_data as $value) {?>
                         [ '<?php echo $value['property_name'];?>', '<?php echo $value['project_title'];?>', new Date('<?php echo $value['start_date'];?>'), new Date('<?php echo $value['end_date'];?>') ],
                         <?php }?>
                     
                       ]);
                       
                       var options = {
                            timeline: { colorByRowLabel: true },
                            colors: ['#e63b6f', '#19c362', '#592df7'],
                       };
                          
                       chart.draw(dataTable,options);
                     }
                     </script>

                     <div id="cis" style="height: 500px;"></div>
                
	    </div>
            <!----TABLE GRAPH ENDS--->
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('property_name');?></div></th>
                    		<th><div><?php echo get_phrase('project_title');?></div></th>
                    		<th><div><?php echo get_phrase('start_date');?></div></th>
                                <th><div><?php echo get_phrase('end_date');?></div></th>
                                <th><div><?php echo get_phrase('priority');?></div></th>
                                <th><div><?php echo get_phrase('edit_');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($project_data as $lrow):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $lrow['property_name'];?></td>
							<td><?php echo $lrow['project_title'];?></td>
                                                        <td><?php echo $lrow['start_date'];?></td>
                                                        <td><?php echo $lrow['end_date'];?></td>
                                                        <td><?php echo $lrow['priority'];?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_project/edit/<?php echo $lrow['project_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                                                            <a href="<?php echo base_url();?>index.php?admin/manage_project/delete/<?php echo $lrow['project_id'];?>" onclick="return confirm('delete?')"
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
                    <?php echo form_open('admin/manage_project/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('property_address');?></label>
                                <div class="controls">
                                    <select name="property_address" required="">
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
                                <label class="control-label"><?php echo get_phrase('start_date');?></label>
                                <div class="controls">
                                    <input type="text" name="start_date" required="" class="datepicker fill-up"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('priority_');?></label>
                                <div class="controls">
                                    <select name="priority">
                                        <option value="">Please Select</option>
                                        <option value="1">1</option> 
                                        <option value="2">2</option> 
                                        <option value="3">3</option> 
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('project_title');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="project_title"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('end_date');?></label>
                                <div class="controls">
                                    <input type="text" name="end_date" required="" class="datepicker fill-up"/>
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
<div class="box">
        
	<div class="box-header">
            <div style="width:330px;">
                <?php echo form_open('report/manage_operation/getYear/' , array('class' => 'form-horizontal validatable'));?>
                <select name="findYear" required="" ><option value="">Please Select Year</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option></select>
                    <button class="btn btn-blue" type="submit">Search</button>
                <?php echo form_close();?>
            </div>
	</div>
    
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_property))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('property_name');?></div></th>
                    		<th><div><?php echo get_phrase('Address_');?></div></th>
                                <th><div><?php echo get_phrase('reports_');?></div></th>
                                
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($property as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['property_name'];?></td>
							<td><?php echo $row['property_address'];?></td>
							<td align="center">
                                                            <a href="<?php echo base_url();?>index.php?report/manage_operation/<?php echo $row['frequency'];?>/<?php echo $row['property_id'];?>/<?php echo $year;?>"
                                   rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('cash_flow_report');?>" class="btn btn-info">
                                        <i class="icon-table"></i>
                                </a>                   
                                                            <a href="<?php echo base_url();?>index.php?report/manage_operation/plot/<?php echo $row['property_id'];?>/<?php echo $year;?>"
                                                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('expense_plot_report');?>" class="btn btn-info">
                                        <i class="icon-eye-close"></i>
                                </a> 
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>
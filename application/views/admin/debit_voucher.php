<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	
			<li class="<?php if(!isset($edit_property))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('debit_voucher_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_debit_voucher');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
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
                        <div  class="paymenthead">   
                        <div class="frmleftdiv">
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('voucher_date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="voucher_date" required=""/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                 <label class="control-label"><?php echo get_phrase('paid_to');?></label>
                                <div class="controls">
                                    <input type="text" name="paid_to"/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('paid_mode');?></label>
                                <div class="controls">
                                    <select name="paid_mode" required="">
                                               <option value="">Please Select</option>
                                            <?php if(isset($paid_mode)):
                                                    foreach ($paid_mode as $value) {
                                               ?>
                                                <option selected="selected" value="<?php echo $value['ledger_id'];?>"><?php echo $value['ledger_name'];?></option>
                                             <?php } else:?> 
                                                 <option value="">Data Not Found</option>   
                                             <?php endif;?>   
                                    </select>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('check_date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="check_date"/>
                                </div>
                            </div>
                        </div>
                        <div class="frmrightdiv">
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('property_');?></label>
                                <div class="controls">
                                     <select name="property" required="" style="width: 65%;">
                                               <option value="">Please Select</option>
                                            <?php if(isset($property)):
                                                    foreach ($property as $value) {
                                               ?>
                                                <option selected="selected" value="<?php echo $value['ledger_id'];?>"><?php echo $value['property_name'];?></option>
                                             <?php } else:?> 
                                                 <option value="">Data Not Found</option>   
                                             <?php endif;?>   
                                    </select>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('bank_');?></label>
                                <div class="controls">
                                    <input type="text"  name="bank"/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('check_no');?></label>
                                <div class="controls">
                                    <input type="text"  name="check_no"/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('ref#_');?></label>
                                <div class="controls">
                                    <input type="text"  name="ref"/>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div style="clear:both;"></div>
                        <br/>
<!--                      <div>
                          <h4 style="border-bottom:3px solid red;">New Charges</h4>
                      </div>-->
                      <div style="clear:both;"></div>
                      <div  class="paymentdetails">   
                          <table class="table">
                            <thead>
                              <tr>
                                <th><center>A/C Head</center></th>
                                <th><center>Current Balance</center></th>
                                <th><center>Narration</center></th>
                                <th><center>Amount</center></th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="payment_head" required="">
                                               <option value="">Please Select</option>
                                            <?php if(isset($ledger)):
                                                    foreach ($ledger as $value) {
                                               ?>
                                                <option selected="selected" value="<?php echo $value['ledger_id'];?>"><?php echo $value['ledger_name'];?></option>
                                             <?php } else:?> 
                                                 <option value="">Data Not Found</option>   
                                             <?php endif;?>   
                                        </select>
                                    </td>
                                    <td><input type="text" name="cbalance" style="width: 90%;" disabled=""/></td>
                                    <td><input type="text" name="narration" required="" style="width:91%;"/></td>
                                    <td><input type="text" name="amount" style="width: 90%;"/></td>
                                </tr>
                            </tbody>
                          </table>
                        
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

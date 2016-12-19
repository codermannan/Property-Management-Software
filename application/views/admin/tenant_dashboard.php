<script>
    function tenantInfo(tid)
    {  
            document.getElementById("myModal").style.zIndex = "1050";
            document.getElementById("myModal").style.marginLeft = "-435px";
          
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
                      
                        if (jsonObject != null)
                        {
                            document.getElementById("propertyName").value=jsonObject[0].property_name;
                            document.getElementById("unitNo").value=jsonObject[0].unit_name;
                            document.getElementById("tenantName").value=jsonObject[0].tenant_name;
                        }
                }
              }
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/getTenantData/"+tid,true);
            xmlhttp.send();
    }
    function showCustomer(tid)
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
                       $('#myTable tbody').empty();
                       
                       var jsonObject = JSON.parse(xmlhttp.responseText);
                        
                        if (jsonObject != null)
                        {
                            for(var i = 0; i < jsonObject.length; i++) {
                                var dueAmount = (jsonObject[i].TotalPrice - jsonObject[i].paidAmount);
                                
                                $('#myTable tbody').append('<tr><td>'+jsonObject[i].moveinDate+'</td><td>'+jsonObject[i].ledger_name+'</td>\n\
                                <td>'+jsonObject[i].RefNo+'</td><td>$'+jsonObject[i].TotalPrice+'</td><td>$'+dueAmount+'</td>\n\
                                <td><input type="text" style="width: 78%;" name="PaidAmount['+i+']" required="required"></td><td><input type="checkbox" name="paid['+i+']"/>\n\
                                <input type="hidden" name="InvoiceNo['+i+']" value="'+jsonObject[i].InvId+'"/><input type="hidden" name="PropertyId" value="'+jsonObject[i].PropertyId+'"/>\n\
                                <input type="hidden" name="TenantId" value="'+jsonObject[i].TenantId+'"/><input type="hidden" name="UnitId" value="'+jsonObject[i].UnitId+'"/>\n\
                                <input type="hidden" name="LeaseId" value="'+jsonObject[i].leaseId+'"/><input type="hidden" name="RefNo['+i+']" value="'+jsonObject[i].RefNo+'"/><input type="hidden" name="PaymentHeadId['+i+']" value="'+jsonObject[i].PaymentHeadId+'"/>n\
                                </td></tr>');
                            }
                            
                        }
                }
              }
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/tenantPaymentReceive/"+tid,true);
            xmlhttp.send();
    }

    function chargesInfo(tid)
    {   
          document.getElementById("newAdjModal").style.zIndex = "1050";
          document.getElementById("newAdjModal").style.marginLeft = "-435px";

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
                      
                        if (jsonObject != null)
                        {
                            document.getElementById("chPropertyName").value =jsonObject[0].property_name;
                            document.getElementById("chUnitNo").value       =jsonObject[0].unit_name;
                            document.getElementById("chTenantName").value   =jsonObject[0].tenant_name;
                        }
                }
              }
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/getTenantData/"+tid,true);
            xmlhttp.send();
    }
  </script>
 <div class="row">
    <div class="col-lg-12">
        <?php if ($this->session->flashdata('due_payment_message') != ''){?>
            <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('due_payment_message');?></div>
        <?php }else if($this->session->flashdata('ltermination_message') != '') {?>
            <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('ltermination_message');?></div>
        <?php }else if($this->session->flashdata('renew_message') != '') {?>
            <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('renew_message');?></div>
        <?php } ?>   
    </div>
    <!-- /.col-lg-12 -->
</div>
  <?php
  
   $tid =  $this->uri->segment(4);
  ?>
<!-- new payment Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Receive Payment</h4>
        </div>
        <div class="modal-body">
          <div class="box-content">
                    <?php echo form_open('payment/manage_tpayment/receivePayment/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                      <div  class="paymenthead">   
                        <div class="frmleftdiv">
                            
                            <div class="control-group mbottomonmodal">
                                 <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <input type="text" name="property_name" id="propertyName" disabled/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('date_');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="receipt_date" required=""/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('Payment Type');?></label>
                                <div class="controls">
                                    <select name="payment_type" required="required">
                                        <option selected="selected" value="0">Please Select</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Check">Check</option>
                                        <option value="Money Order">Money Order</option>
                                        <option value="Online">Online</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Debit Card">Credit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('check_no');?></label>
                                <div class="controls">
                                    <input type="text" name="check_no"/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('ref#_');?></label>
                                <div class="controls">
                                    <input type="text" name="ref"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('unit_no');?></label>
                                <div class="controls">
                                    <input type="text"  name="unit_no" id="unitNo" disabled/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('tenant_name');?></label>
                                <div class="controls">
                                    <input type="text" name="tenant_name" id="tenantName" disabled/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('deposit_to');?></label>
                                <div class="controls">
                                    <select name="deposit_to" required="">
                                        <option selected="selected" value="">Please Select</option>
                                        <?php
                                            $bankacc = $this->Search_Model->getAllDataFromTableBycondition('accounts_ledger','ledger_group_id',102);
                                            foreach ($bankacc as $value):
                                        ?>
                                                <option value="<?php echo $value['ledger_id'];?>"><?php echo $value['ledger_name'];?></option>
                                         <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('check_date');?></label>
                                <div class="controls">
                                    <input type="text" name="check_date" class="datepicker fill-up"/>	
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('comments_');?></label>
                                <div class="controls">
                                    <input type="text" name="comments"/>
                                </div>
                            </div>
                        </div>
                      </div>
                        
                      <div style="clear:both;"></div>
                      <div>
                          <h4 style="border-bottom:3px solid red;">Unpaid Charges</h4>
                      </div>
                      <div style="clear:both;"></div>
                      <div  class="paymentdetails">   
                          <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Payment Head</th>
                                <th>Ref#</th>
                                <th>Orig. Amount</th>
                                <th>Amount Due</th>
                                <th>Current Payment</th>
                                <th>Paid?</th>
                              </tr>
                            </thead>
                            <tbody>
                              
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
      </div>
      
    </div>
  </div>

<div style="padding-bottom:5px;">
     
    <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="showCustomer(<?php echo $tid; ?>);tenantInfo(<?php echo $tid; ?>);"><i class="icon-money"></i>
                <?php echo get_phrase('receive_payment');?>
    </a>                     
    <a href="#" class="btn btn-blue" data-toggle="modal" data-target="#newAdjModal" onclick="chargesInfo(<?php echo $tid; ?>);"><i class="icon-plus"></i>
                <?php echo get_phrase('add_charge');?>
    </a>  

</div>

<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	
			<li class="<?php if(!isset($edit_property))echo 'active';?>">
            	<a href="#das" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('dashboard_');?>
                </a></li>
                
                        <li>
            	<a href="#lreport" data-toggle="tab"><i class="icon-print"></i>
					<?php echo get_phrase('print_ledger');?>
                    	</a></li>
                        
                        <li>
            	<a href="#" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('late_fee');?>
                    	</a></li>
                        <li>
            	<a href="#moveOut" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('move_out');?>
                    	</a></li>
                         <li>
            	<a href="#renewLease" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('renew_lease');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----start new payment---->
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
            <!----edn new payment--->
           
            <!----start dasboard tab--->
            <div class="tab-pane box <?php if(!isset($edit_property))echo 'active';?>" id="das">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('transaction_');?></div></th>
                    		<th><div><?php echo get_phrase('date_');?></div></th>
                    		<th><div><?php echo get_phrase('ref#_');?></div></th>
                                <th><div><?php echo get_phrase('description_');?></div></th>
                                <th><div><?php echo get_phrase('payer_name');?></div></th>
                                <th><div><?php echo get_phrase('deposit_date');?></div></th>
                                <th><div><?php echo get_phrase('charges_');?></div></th>
                                <th><div><?php echo get_phrase('payments_');?></div></th>
                                <th><div><?php echo get_phrase('balance_');?></div></th>
                                <th><div><?php echo get_phrase('actions_');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($ten_dashboard as $row):
                                $balance = ($row['TotalPrice'] - $row['paidAmount']);
                        ?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo get_phrase('unpaid_charge');?></td>
							<td><?php echo $row['booking_date'];?></td>
                                                        <td><?php echo $row['RefNo'];?></td>
                                                        <td><?php echo $row['head_name'];?></td>
							<td><?php echo '';?></td>
                                                        <td><?php echo '';?></td>
                                                        <td><?php echo '$'.$row['TotalPrice'];?></td>
							<td><?php echo '$'.$row['paidAmount'];?></td>
                                                        <td><?php echo '$'.$balance;?></td>
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
            <!----end dashboard-->
            
 <script type="text/javascript">
    function myPrint() {
        var printContents = document.getElementById('printDiv').innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script>          
            
		<!----start ledger tab---->
            <div class="tab-pane box" id="lreport" style="padding: 5px">
                
                <div class="box-content">
                    <div class="padded">
                        <div id="printDiv"><!----start print div--->
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                  
                                    <tr>
                                        <td><b>S/N</b></td>
                                        <td><b>Voucher</b></td>
                                        <td><b>Tr Date</b></td>
                                        <td><b>Particulars</b></td>
                                        <td><b>Source</b></td>
                                        <td><b>Debit Amount</b></td>   
                                        <td><b>Credit Amount</b></td>  
                                    </tr>
                               <?php if(isset($ten_ledger)):?>
                                    <?php
                                    $count = 1;foreach($ten_ledger as $row):
                                    $total_dr_amt += $row['dr_amt'];
                                    $total_cr_amt += $row['cr_amt'];
                                    ?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $row['tr_no'];?></td>
                                        <td><?php echo date('m-d-Y', $row['jv_date']);?></td>
                                        <td><?php echo $row['narration'];?></td>
                                        <td><?php echo $row['tr_from'];?></td>
                                        <td><?php echo '$'.$row['dr_amt'];?></td>   
                                        <td><?php echo '$'.$row['cr_amt'];?></td>   
                                    </tr>
                                 <?php endforeach;?> 
                             <?php endif;?> 
                                    <tr>
                                        <td colspan="4"><b>Closing Balance : <?php echo '$'.$clsoingBalance = ($total_dr_amt - $total_cr_amt);?><?php if($total_dr_amt > $total_cr_amt){ echo '  (Dr)';}else{ echo '  (Cr)';}?></b></td>
                                        <td><b>Total :</b></td>
                                        <td><?php echo '$'.$total_dr_amt;?></td>   
                                        <td><?php echo '$'.$total_cr_amt;?></td>   
                                    </tr>
                                </table>
                             </div> <!----end print div--->
                     </div>
                             
                </div>    
                <a href="#" onclick="myPrint();">Print <span class="glyphicon glyphicon-print"></span></a>
			</div>
			<!----end ledger tab--->
                        <!----start moveout tab--->
                        <div class="tab-pane box" id="moveOut" style="padding: 5px">
                            <div class="box-content">
                                <?php echo form_open('admin/manage_lease/moveout/'.$tid , array('class' => 'form-horizontal validatable'));?>
                                <div class="padded">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('vacated_date');?></label>
                                            <div class="controls">
                                                <input type="text" class="datepicker fill-up" name="vacated_date" required=""/>
                                                <input type="hidden" name="dr_amount" value="<?php echo $clsoingBalance;?>"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('reason_for_leaving');?></label>
                                            <div class="controls">
                                                <select name="reason_for_leaving" required="">
                                                    <option value="">Please Select</option>
                                                    <option value="Bought House">Bought House</option>
                                                    <option value="Deceased">Deceased</option>
                                                    <option value="Eviction">Eviction</option>
                                                    <option value="Transfer Unit">Transfer Unit</option>
                                                    <option value="Termination">Termination</option>
                                                    <option value="Too Expensive">Too Expensive</option>
                                                    <option value="Personal">Personal</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-actions">
                                        <button type="submit" class="btn btn-blue"><?php echo get_phrase('save_');?></button>
                                </div>
                                 <?php echo form_close();?> 
                            </div>
                        </div>
                        <!----end moveout tab--->
                        <!----start renew tab--->
                        <div class="tab-pane box" id="renewLease" style="padding: 5px">
                            <div class="box-content">
                                <?php echo form_open('admin/manage_lease/renewLease/'.$tid , array('class' => 'form-horizontal validatable'));?>
                                <div class="padded">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('move_in_date');?></label>
                                            <div class="controls">
                                                <input type="text" class="datepicker fill-up" name="move_in_date" required=""/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('move_out_date');?></label>
                                            <div class="controls">
                                                <input type="text" class="datepicker fill-up" name="move_out_date" required=""/>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-actions">
                                        <button type="submit" class="btn btn-blue"><?php echo get_phrase('save_');?></button>
                                </div>
                                 <?php echo form_close();?> 
                            </div>
                        </div>
                        <!----end renew tab--->
		</div>
	</div>
</div>

<!--new charges modal box-->
<div class="modal fade" id="newAdjModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Charge</h4>
        </div>
        <div class="modal-body">
          <div class="box-content">
                    <?php echo form_open('payment/manage_tpayment/addCharges/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                      <div  class="paymenthead">   
                        <div class="frmleftdiv">
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('tenant_name');?></label>
                                <div class="controls">
                                    <input type="text" name="chTenantName" id="chTenantName" readonly/>
                                    <input type="hidden" name="tenant_id" value="<?php echo $tid;?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group mbottomonmodal">
                                 <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <input type="text" name="chPropertyName" id="chPropertyName" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="frmrightdiv">
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('date_');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="charges_date" required=""/>
                                </div>
                            </div>
                            <div class="control-group mbottomonmodal">
                                <label class="control-label"><?php echo get_phrase('unit_no');?></label>
                                <div class="controls">
                                    <input type="text"  name="chUnitNo" id="chUnitNo" readonly/>
                                </div>
                            </div>
                        </div>
                      </div>
                        
                      <div style="clear:both;"></div>
                      <div>
                          <h4 style="border-bottom:3px solid red;">New Charges</h4>
                      </div>
                      <div style="clear:both;"></div>
                      <div  class="paymentdetails">   
                          <table class="table">
                            <thead>
                              <tr>
                                <th><center>Type</center></th>
                                <th><center>Payment Head</center></th>
                                <th><center>Ref#</center></th>
                                <th><center>Charge Amount</center></th>
                                <th><center>Note</center></th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Debit</td>
                                    <td>
                                        <select name="payment_head" required="">
                                               <option value="">Please Select</option>
                                            <?php 
                                            $paymenthead = $this->Search_Model->getmultiConditionData('ledger_id,ledger_name', 'accounts_ledger', '(ledger_group_id=200 or ledger_group_id = 405)');
                                                foreach ($paymenthead as $lvalue) {
                                               ?>
                                                <option value="<?php echo $lvalue['ledger_id'];?>"><?php echo $lvalue['ledger_name'];?></option>
                                             <?php }?> 
                                        </select>
                                    </td>
                                    <td><input type="text" name="ref_no" style="width: 90%;"/></td>
                                    <td><input type="text" name="charge_amount" required="" style="width:91%;"/></td>
                                    <td><textarea name="note" cols="2" rows="1"></textarea></td>
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
      </div>
      
    </div>
  </div>
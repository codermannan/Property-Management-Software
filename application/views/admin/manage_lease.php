<?php
if(isset($appdata)){
    $app_id      = $appdata[0]['appinfo_id'];
    $movein_date = $appdata[0]['movein_date'];
    $full_name   = $appdata[0]['full_name'];
    $phone_number= $appdata[0]['phone_number'];
}
?>
<script>
    function showCustomer(str)
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
                      
                        if (jsonObject != null)
                        {
                            document.getElementById("freQuency").value=jsonObject[0].frequency;
                            document.getElementById("propertyAddress").value=jsonObject[0].property_address;
                        }
                }
              }
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/retrieveLeaseData/"+str,true);
            xmlhttp.send();
    }
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
                {
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
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/retrieveVacantData/"+str+"/1",true);
            xmlhttp.send();
    }
    function setMovedate(movind)
    { 
        var frequency = $('#freQuency').val();
        
        if(frequency == 'Monthly'){ 
            var mdate  = new Date(movind);
            var d =  new Date(mdate.setMonth(mdate.getMonth()+1));
            
            month = '' + (d.getMonth()),
            day = '' + d.getDate(),
            year = d.getFullYear();
            
            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;
            
            var moutdate = [month, day, year].join('/');
            $('#moveout_date').val(moutdate);
        }
        
//        if(frequency == 'Weekly'){ 
//            var mdate  = new Date(movind);
//            var d =  new Date(mdate.setDate(mdate.getDate()+7));
//            
//            month = '' + (d.getMonth()),
//            day = '' + d.getDate()+7,
//            year = d.getFullYear();
//            
//            if (month.length < 2) month = '0' + month;
//            if (day.length < 2) day = '0' + day;
//            
//            var moutdate = [month, day, year].join('/');
//            $('#moveout_date').val(moutdate);
//        }
        
    }
    function getUnitprice(uid)
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
                       
                        if (jsonObject != null)
                        {
                            document.getElementById("rentAmount").value=jsonObject[0].trent;
                        }
                }
              }
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/retrieveUnitPrice/"+uid,true);
            xmlhttp.send();
    }
</script>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('residential_lease_agreement ( MonthlY Tenant )');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	
                <div class="box-content">
                    <?php echo form_open('admin/manage_lease/create/' , array('class' => 'form-horizontal validatable'));?>
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Tenant Name :');?></label>
                                <div class="controls">
                                    <input type="hidden" name="appinfo_id" value="<?php echo $app_id;?>">
                                    <input type="text" class="validate[required]" name="tenantname" id="tenantName" value="<?php echo $full_name;?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <select name="property_name" id="propertyId" onchange="showCustomer(this.value); getVacantUnit(this.value);" required>
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
                                    <select name="vacant_unit" class="validate[required]" id="vacantUnit" onchange="getUnitprice(this.value)">
                                        <option value="" selected="selected">Please Select</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('personal_property_included');?></label>
                                <div class="controls">
                                    <input type="checkbox" name="personal_property[]" value="Washer" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Washer</label>
                                    <input type="checkbox" name="personal_property[]" value="Dryer" style="float:left;margin-left: 3px;"><label style="float:left; margin-left: 3px;">Dryer</label>
                                    <input type="checkbox" name="personal_property[]" value="Refrigerator" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Refrigerator</label>
                                    <input type="checkbox" name="personal_property[]" value="Oven" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Range/Oven</label>
                                    <input type="checkbox" name="personal_property[]" value="Dishwasher" style="float:left;margin-left: 3px;"><label style="float:left; margin-left: 3px;">Dishwasher</label>
                                    <input type="checkbox" name="personal_property[]" value="Microwave" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Microwave</label>
                                    <input type="checkbox" name="personal_property[]" value="Other" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Other</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Move-in Date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="movein_date" id="moveinDate" onblur="setMovedate(this.value)" value="<?php echo $movein_date;?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Rent Amount');?></label>
                                <div class="controls">
                                    <input type="text" id="rentAmount" class="validate[required]" name="rent_amount"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Security Deposit');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="deposit_amount" class="validate[required]"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pet_deposit');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="pet_deposit"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('cleaning_deposit');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="cleaning_deposit"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('earnest_money_receipt');?></label>
                                <div class="controls">
                                    <input type="radio" name="earnest_money_receipt" value="Yes" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Yes</label>
                                    <input type="radio" name="earnest_money_receipt" value="No" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">No</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pet_allowed');?></label>
                                <div class="controls">
                                    <input type="radio" name="pet_allowed" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Yes</label>
                                    <input type="radio" name="pet_allowed" value="0" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">No</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('keys_');?></label>
                                <div class="controls">
                                    <input type="checkbox" name="keys[]" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Door</label>
                                    <input type="checkbox" name="keys[]" value="2" style="float:left;margin-left: 3px;"><label style="float:left; margin-left: 3px;">Pool</label>
                                    <input type="checkbox" name="keys[]" value="3" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Mail Box</label>
                                    <input type="checkbox" name="keys[]" value="4" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Entry Gate</label>
                                    <input type="checkbox" name="keys[]" value="5" style="float:left;margin-left: 3px;"><label style="float:left; margin-left: 3px;">Laundry</label>
                                    <input type="checkbox" name="keys[]" value="6" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Garage</label>
                                    <input type="checkbox" name="keys[]" value="7" style="float:left;margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Other</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pool_chemicals');?></label>
                                <div class="controls">
                                    <input type="radio" name="pool_chemicals" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="pool_chemicals" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="pool_chemicals" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Association</label>
                                    <input type="radio" name="pool_chemicals" value="4" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('front_yard');?></label>
                                <div class="controls">
                                    <input type="radio" name="front_yard" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="front_yard" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="front_yard" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Association</label>
                                    <input type="radio" name="front_yard" value="4" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('routine_pest_control');?></label>
                                <div class="controls">
                                    <input type="radio" name="routine_pest_control" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="routine_pest_control" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="routine_pest_control" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Association</label>
                                    <input type="radio" name="routine_pest_control" value="4" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('hoa_fees');?></label>
                                <div class="controls">
                                    <input type="radio" name="hoa_fees" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="hoa_fees" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="hoa_fees" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Tenant Contact :');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="tenantcontact" id="tenantContact" value="<?php echo $phone_number;?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Frequency_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="frequency" id="freQuency" readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Address_');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="property_address" id="propertyAddress" disabled=""/>
                                </div>
                            </div>
                             <div class="control-group" style="height:50px;">
                                <label class="control-label"><?php echo get_phrase('addenda_incorporated');?></label>
                                <div class="controls">
                                    <input type="checkbox" name="addenda_incorporated[]" value="Lead-based Paint Disclousure" style="float:left;"/><label style="float:left; margin-left: 3px;">Lead-based Paint Disclousure</label>
                                    <input type="checkbox" name="addenda_incorporated[]" value="Inventory List" style="float:left;"><label style="float:left; margin-left: 3px;">Inventory List</label>
                                    <input type="checkbox" name="addenda_incorporated[]" value="Other" style="float:left;"/><label style="float:left; margin-left: 3px;">Other</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Move-out Date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="moveout_date" id="moveout_date" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('cleaning_fee');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="cleaning_fee"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('redecorating_fee');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="redecorating_fee"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pet_fee');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="pet_fee"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('other_fee');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="other_fee"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('form_of_earnest_money_receipt');?></label>
                                <div class="controls">
                                    <input type="radio" name="form_earnest_money_receipt" value="Personal Check" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Personal Check</label>
                                    <input type="radio" name="form_earnest_money_receipt" value="Cashier's Check" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Cashier's Check</label>
                                    <input type="radio" name="form_earnest_money_receipt" value="Other" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Other</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pet_liability_insurance');?></label>
                                <div class="controls">
                                    <input type="radio" name="pet_liability_insurance" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Required</label>
                                    <input type="radio" name="pet_liability_insurance" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Required</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('utilities_');?></label>
                                <div class="controls">
                                    <input type="checkbox" name="utilities[]" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Water</label>
                                    <input type="checkbox" name="utilities[]" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Swarage</label>
                                    <input type="checkbox" name="utilities[]" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Trash</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('pool_maintenance');?></label>
                                <div class="controls">
                                    <input type="radio" name="pool_maintenance" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="pool_maintenance" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="pool_maintenance" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Association</label>
                                    <input type="radio" name="pool_maintenance" value="4" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('back_yard');?></label>
                                <div class="controls">
                                    <input type="radio" name="back_yard" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="back_yard" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="back_yard" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Association</label>
                                    <input type="radio" name="back_yard" value="4" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('other_');?></label>
                                <div class="controls">
                                    <input type="radio" name="other" value="1" style="float:left; margin-left: 3px;"/><label style="float:left; margin-left: 3px;">Landlord</label>
                                    <input type="radio" name="other" value="2" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Tenant</label>
                                    <input type="radio" name="other" value="3" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Association</label>
                                    <input type="radio" name="other" value="4" style="float:left; margin-left: 3px;"><label style="float:left; margin-left: 3px;">Not Applicable</label>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Late Fee Rule');?></label>
                                <div class="controls">
                                    <select name="latefee_rule" required>
                                        <option selected="selected" value="">Please Select</option>
                                        <?php if(isset($lateFee)):
                                                foreach ($lateFee as $value) {
                                           ?>
                                            <option value="<?php echo $value['id'];?>"><?php echo $value['fee_title'];?></option>
                                         <?php } else:?> 
                                             <option value="">Data Not Found</option>   
                                         <?php endif;?>
                                    </select>
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
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
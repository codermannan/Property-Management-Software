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
            xmlhttp.open("GET","<?php echo base_url()?>index.php?admin/retrieveVacantData/"+str,true);
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
					<?php echo get_phrase('weekly_lease_form');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	
                <div class="box-content">
                    <?php echo form_open('admin/lease_managemnet/create/' , array('class' => 'form-horizontal validatable'));?>
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
                                <label class="control-label"><?php echo get_phrase('representative_name');?></label>
                                <div class="controls">
                                    <input type="text" name="representative_name" class="validate[required]"/>
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
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Move-out Date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="moveout_date" id="moveout_date" required>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Deposit Amount');?></label>
                                <div class="controls">
                                    <input type="text" id="depositAmount" name="deposit_amount"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('representative_phone');?></label>
                                <div class="controls">
                                    <input type="text" name="representative_phone" class="validate[required]"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('under_ledger');?></label>
                                <div class="controls">
                                    <select name="underledger" required>
                                        <option selected="selected" value="200">House Rent</option>
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
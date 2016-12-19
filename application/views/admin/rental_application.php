<!--For lease form-->
<link href="<?php echo base_url();?>template/css/smart_wizard.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.smartWizard-2.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    	// Smart Wizard     	
  		$('#wizard').smartWizard({transitionEffect:'slideleft',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:true});

      function leaveAStepCallback(obj){
        var step_num= obj.attr('rel');
        return validateSteps(step_num);
      }
      
      function onFinishCallback(){
       if(validateAllSteps()){
        $('form').submit();
       }
      }
		});
	   
    function validateAllSteps(){
       var isStepValid = true;
       
       if(validateStep1() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});         
       }else{
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
       }
       
       if(validateStep2() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:2,iserror:true});         
       }else{
         $('#wizard').smartWizard('setError',{stepnum:2,iserror:false});
       }
       
       if(validateStep3() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:3,iserror:true});         
       }else{
         $('#wizard').smartWizard('setError',{stepnum:3,iserror:false});
       }
       
       if(!isStepValid){
          $('#wizard').smartWizard('showMessage','Please correct the errors in the steps and continue');
       }
              
       return isStepValid;
    } 	
		
		
		function validateSteps(step){
		  var isStepValid = true;
      // validate step 1
      if(step == 1){
        if(validateStep1() == false ){
          isStepValid = false; 
          $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }
      // validate step2
      if(step == 2){
        if(validateStep2() == false ){
          isStepValid = false; 
          $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }
      // validate step3
      if(step == 3){
        if(validateStep3() == false ){
          isStepValid = false; 
          $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }
      
      return isStepValid;
    }
		
		function validateStep1(){
       var isValid = true; 
       // Validate Username
       var pr = $('#propertyName').val();
       if(!pr && pr.length <= 0){
         isValid = false;
         $('#msg_pname').html('Please select property name').show();
       }else{
         $('#msg_pname').html('').hide();
       }
       
       // Move in date
       var mid = $('#moveinDate').val();
       if(!mid && mid.length <= 0){
         isValid = false;
         $('#msg_movein_date').html('Please fill movein date').show();
       }else{
         $('#msg_movein_date').html('').hide();
       }
       
       // validate noofBedroom
       var nbr = $('#noofBedroom').val();
       if(!nbr && nbr.length <= 0){
         isValid = false;
         $('#msg_noofbedroom').html('Please select no of bedroom').show();         
       }else{
         $('#msg_noofbedroom').html('').hide();
       } 
       
       // validate fullName
       var fn = $('#fullName').val();
       if(!fn && fn.length <= 0){
         isValid = false;
         $('#msg_fullname').html('Please fill full name').show();         
       }else{
         $('#msg_fullname').html('').hide();
       } 
       
       // validate phoneNumber
       var pn = $('#phoneNumber').val();
       if(!pn && pn.length <= 0){
         isValid = false;
         $('#msg_phonenumber').html('Please fill phone number').show();         
       }else{
         $('#msg_phonenumber').html('').hide();
       } 
       
       // validate email
       var em = $('#email').val();
       if(!em && em.length <= 0){
         isValid = false;
         $('#msg_email').html('Please fill email address').show();         
       }else{
         $('#msg_email').html('').hide();
       } 
       
       // validate ssn
       var ssn = $('#ssn').val();
       if(!ssn && ssn.length <= 0){
         isValid = false;
         $('#msg_ssn').html('Please fill ssn').show();         
       }else{
         $('#msg_ssn').html('').hide();
       }
       
       // validate dob
       var dob = $('#dob').val();
       if(!dob && dob.length <= 0){
         isValid = false;
         $('#msg_dob').html('Please fill date of birth').show();         
       }else{
         $('#msg_dob').html('').hide();
       }
       
       return isValid;
    }
    function validateStep2(){
      var isValid = true;    
      //validate email  email
      var jt = $('#jobType').val();
       if(!jt && jt.length <= 0){
         isValid = false;
         $('#msg_jobtype').html('Please select job type').show();         
       }else{
         $('#msg_jobtype').html('').hide();
       }      
      return isValid;
    }
    
    function validateStep3(){
      var isValid = true;    
      //validate email  email
      var ca = $('#curAddress').val();
       if(!ca && ca.length <= 0){
         isValid = false;
         $('#msg_curaddress').html('Please fill current address').show();         
       }else{
         $('#msg_curaddress').html('').hide();
       }  
       
       // validate msg_curjobyear
       var jbt = $('#curJobyear').val();
       if(!jbt && jbt.length <= 0){
         isValid = false;
         $('#msg_curjobyear').html('Please fill current job year').show();         
       }else{
         $('#msg_curjobyear').html('').hide();
       }
       
       // validate curRenamnt
       var crent = $('#curRenamnt').val();
       if(!crent && crent.length <= 0){
         isValid = false;
         $('#msg_currenamnt').html('Please fill current amount').show();         
       }else{
         $('#msg_currenamnt').html('').hide();
       }
       
       // validate curResleaving
       var crl = $('#curResleaving').val();
       if(!crl && crl.length <= 0){
         isValid = false;
         $('#msg_curresleaving').html('Please fill reason for leaving').show();         
       }else{
         $('#msg_curresleaving').html('').hide();
       }
      return isValid;
    }
   
    
    // Email Validation
    function isValidEmailAddress(emailAddress) {
      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
      return pattern.test(emailAddress);
    } 		
</script>
<div class="box">
<table align="center" border="0" cellpadding="0" cellspacing="0">
<tr><td>

<?php echo form_open('admin/rental_application/create/' , array('class' => 'form-horizontal validatable'));?>
<!--<form action="#" method="POST">-->
  <input type='hidden' name="issubmit" value="1">
<!-- Tabs -->
  		<div id="wizard" class="swMain">

    	<!------CONTROL TABS START------->             
  			<ul>
  				<li><a href="#step-1">
                <span class="stepNumber">1</span>
                <span class="stepDesc">
                   Applicant Info<br />
                   <small>Fill your account details</small>
                </span>
            </a></li>
  				<li><a href="#step-2">
                <span class="stepNumber">2</span>
                <span class="stepDesc">
                   Employer Info<br />
                   <small>Fill your employer details</small>
                </span>
            </a></li>
  				<li><a href="#step-3">
                <span class="stepNumber">3</span>
                <span class="stepDesc">
                   Rental History<br />
                   <small>Fill your rental details</small>
                </span>
             </a></li>
                    <li><a href="#step-4">
                    <span class="stepNumber">4</span>
                    <span class="stepDesc">
                       Giving Answer<br />
                       <small>Answer the questions</small>
                    </span>
                 </a></li>
  				<li><a href="#step-5">
                <span class="stepNumber">5</span>
                <span class="stepDesc">
                   Other Details<br />
                   <small>Fill your other details</small>
                </span>
            </a></li>
  			</ul>
        <!------CONTROL TABS END------->

                        <div id="step-1">
                                <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Property Name');?></label>
                                <div class="controls">
                                    <select id="propertyName" name="property_name">
                                        <option value="">Please Select</option>
                                        <?php if(isset($property)): ?>
                                        <?php foreach($property as $val): ?>
                                            <option value="<?php echo $val['property_id']; ?>"><?php echo $val['property_name']; ?></option>
                                        <?php endforeach; ?>   
                                        <?php else: ?>
                                             <option value="">Need to setup property first</option>
                                         <?php endif; ?>    
                                   </select>
                                    <span id="msg_pname" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Move-in Date');?></label>
                                <div class="controls">
                                    <input type="text" id="moveinDate" name="movein_date" class="datepicker fill-up">
                                    <span id="msg_movein_date" class="msg_color"></span>
                                </div>
                            </div>
                             <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('Property Type');?></label>
                                    <div class="controls">
                                        <select id="noofBedroom" name="no_of_bedroom">
                                            <option value="">-select-</option>
                                            <option value="Studio">Studio</option>
                                            <option value="1 bedroom">1 bedroom</option>
                                            <option value="2 bedroom">2 bedroom</option> 
                                            <option value="3 bedroom">3 bedroom</option> 
                                      </select>
                                        <span id="msg_noofbedroom" class="msg_color"></span>
                                    </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Tenant Name');?></label>
                                <div class="controls">
                                    <input type="text" id="fullName" name="full_name" value="" class="txtBox">
                                    <span id="msg_fullname" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Phone Number');?></label>
                                <div class="controls">
                                    <input type="text" id="phoneNumber" name="phone_number" value="" class="txtBox">
                                    <span id="msg_phonenumber" class="msg_color"></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Email Address .');?></label>
                                <div class="controls">
                                    <input type="text" id="email" name="email" value="" class="txtBox">
                                    <span id="msg_email" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('SSN');?></label>
                                <div class="controls">
                                    <input type="text" id="ssn" name="ssn" value="" class="txtBox">
                                    <span id="msg_ssn" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Date of Birth');?></label>
                                <div class="controls">
                                    <input type="text" id="dob" name="dob" class="datepicker fill-up">
                                     <span id="msg_dob" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Driver License Number');?></label>
                                <div class="controls">
                                    <input type="text" id="drivingLicense" name="drivinglicense" value="" class="txtBox">	
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Drivers License State');?></label>
                                <div class="controls">
                                    <input type="text" id="drivingLicensestate" name="drivinglicensestate" value="" class="txtBox">
                                </div>
                            </div>
                        </div>  
                        </div>
                        </div>    
<!--                         end step1-->
  			<div id="step-2">
            <h2 class="StepTitle">Step 2: Employer Information</h2>	
                    <div class="padded">
                        
                        <div class="frmleftdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Current Employer Name');?></label>
                                <div class="controls">
                                    <input type="text" id="empName" name="emp_name" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('Job Type');?></label>
                                    <div class="controls">
                                        <select id="jobType" name="job_type">
                                            <option value="">-select-</option>
                                            <option value="Full-Time">Full-Time</option>
                                            <option value="Part-Time">Part-Time</option>
                                            <option value="Retired">Retired</option> 
                                            <option value="Other">Other</option> 
                                      </select>
                                        <span id="msg_jobtype" class="msg_color"></span>
                                    </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Employer Address');?></label>
                                <div class="controls">
                                    <input type="text" id="empAddress" name="emp_address" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Employer Phone Number');?></label>
                                <div class="controls">
                                    <input type="text" id="empPhone" name="emp_aphone" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Position');?></label>
                                <div class="controls">
                                    <input type="text" id="position" name="Position" class="txtBox">
                                </div>
                            </div>
                             
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Supervisor Name.');?></label>
                                <div class="controls">
                                    <input type="text" id="supName" name="sup_name" value="" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('How long with employer? (Years & Months)');?></label>
                                <div class="controls">
                                    <input type="text" id="jobDuration" name="job_duration" value="" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Monthly income from employer:');?></label>
                                <div class="controls">
                                    <input type="text" id="monthlyIncome" name="monthly_income" value="" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Other Income:');?></label>
                                <div class="controls">
                                    <input type="text" id="otherIncome" name="other_income" value="" class="txtBox">	
                                </div>
                            </div>
                            
                        </div>  
                        </div>       
        </div>                      
  			<div id="step-3">
            <h2 class="StepTitle">Step 3: Current & Former Residency</h2>	
            <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Current Address.');?></label>
                                <div class="controls">
                                    <input type="text" id="curAddress" name="cur_address" class="txtBox">
                                </div>
                                <span id="msg_curaddress" class="msg_color"></span>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('How long at this address?');?></label>
                                <div class="controls">
                                    <input type="text" id="curJobyear" name="curjobyear" class="txtBox">
                                    <span id="msg_curjobyear" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Rental Amount:');?></label>
                                <div class="controls">
                                    <input type="text" id="curRenamnt" name="cur_renamnt" class="txtBox">
                                    <span id="msg_currenamnt" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reason for leaving?');?></label>
                                <div class="controls">
                                    <input type="text" id="curResleaving" name="cur_resleaving" class="txtBox">
                                    <span id="msg_curresleaving" class="msg_color"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Landlord Name:');?></label>
                                <div class="controls">
                                    <input type="text" id="curLname" name="curlname" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Landlord Phone Number');?></label>
                                <div class="controls">
                                    <input type="text" id="landPhone" name="land_phone" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('Can Contact Landlord?');?></label>
                                    <div class="controls">
                                        <select id="canContactlandlord" name="can_contactlandlord">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                    </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Former Address:');?></label>
                                <div class="controls">
                                    <input type="text" id="forAddress" name="for_address" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('How long at this address?');?></label>
                                <div class="controls">
                                    <input type="text" id="forResyear" name="forresyear" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Rental Amount:');?></label>
                                <div class="controls">
                                    <input type="text" id="forRenamnt" name="for_renamnt" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reason for leaving?');?></label>
                                <div class="controls">
                                    <input type="text" id="forResleaving" name="for_resleaving" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Landlord Name:');?></label>
                                <div class="controls">
                                    <input type="text" id="forLname" name="forlname" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Landlord Phone Number');?></label>
                                <div class="controls">
                                    <input type="text" id="forlandPhone" name="forland_phone" class="txtBox">
                                </div>
                            </div>
                            
                        </div>  
                        </div>              				          
        </div>
                        <div id="step-4">
            <h2 class="StepTitle">Step 4: Other Details</h2>	
            <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Have you declared bankruptcy in the past (7) years?');?></label>
                                    <div class="controls">
                                        <select id="canContactlandlord" name="dec_bankrupcy">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                    </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Have you ever been evicted from a rental residence?');?></label>
                                <div class="controls">
                                        <select id="canContactlandlord" name="evicted_residence">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Have you had two or more late rental payments in the past year?');?></label>
                                <div class="controls">
                                    <select id="canContactlandlord" name="rental_due">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Have you ever willfully or intentionally refused to pay rent?');?></label>
                                <div class="controls">
                                    <select id="canContactlandlord" name="refused_rent">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Have you ever been convicted of a felony?');?></label>
                                <div class="controls">
                                    <select id="canContactlandlord" name="con_felony">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Are you a registered sex offender?');?></label>
                                <div class="controls">
                                    <select id="canContactlandlord" name="sex_offence">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Have you ever been convicted of a drug related crime?');?></label>
                                <div class="controls">
                                    <select id="canContactlandlord" name="drug_crime">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Are you currently on probation or parole?');?></label>
                                <div class="controls">
                                    <select id="canContactlandlord" name="parole">
                                            <option value="">-select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option> 
                                      </select>
                                     <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                               
                            </div>
                            
                        </div>  
                        </div>                 			
        </div>
  			<div id="step-5">
            <h2 class="StepTitle">Step 5: Personal References || Vehicle Information || Emergency Contact Person</h2>	
            <div class="padded">
                        
                        <div class="frmleftdiv">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reference 1 Name:');?></label>
                                <div class="controls">
                                    <input type="text" id="ref1Name" name="ref1_name" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reference 1 Phone Number: ');?></label>
                                <div class="controls">
                                    <input type="text" id="ref1Phone" name="ref1phone" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reference 1 Relationship:');?></label>
                                <div class="controls">
                                    <input type="text" id="ref1Relation" name="ref1relation" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reference 2 Name:');?></label>
                                <div class="controls">
                                    <input type="text" id="ref2Name" name="ref2_name" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reference 2 Phone Number:');?></label>
                                <div class="controls">
                                    <input type="text" id="ref2phone" name="ref2phone" class="txtBox">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Reference 2 Relationship: ');?></label>
                                <div class="controls">
                                    <input type="text" id="ref2Relation" name="ref2relation" class="txtBox">
                                </div>
                            </div>
                            
                        </div>
                        <div class="frmrightdiv">
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Emergency Contact Name:');?></label>
                                <div class="controls">
                                    <input type="text" id="emrContactname" name="emrcontactname" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Emergency Contact Number: ');?></label>
                                <div class="controls">
                                    <input type="text" id="emrContactnumber" name="emr_contactnumber" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Emergency Contact Relationship: *');?></label>
                                <div class="controls">
                                    <input type="text" id="emrContactrel" name="emr_contactrel" class="txtBox">
                                    <span id="msg_jobtype" class="msg_color"></span>
                                </div>
                                
                            </div>
                            
                        </div>  
                        </div>               			
                       </div>
  		</div>
<!-- End SmartWizard Content -->  		
<?php echo form_close();?>  
  		
</td></tr>
</table> 
</div>
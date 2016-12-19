<script type="text/javascript">
    function myPrint() {
        var printContents = document.getElementById('printDiv').innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script> 
<div class="box">

		<div class="tab-content">
        	
			<!----CREATION FORM STARTS---->
			
                <div class="box-content">
<!--                        <div class="form-actions">
                            <p>Rental Application</p>
                        </div>-->
                        <div class="padded" id="printDiv">
                         <?php if(isset($appAlldata)):?>  
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                    <caption style="text-align: left; font-size: 16px; font-weight: bold"> Basic Information</caption>
                                   
                                    <tr>
                                        <td>Tenant Name : </td>
                                        <td><?php echo $appAlldata[0]['full_name'];?></td>
                                        <td>Phone Number : </td>
                                        <td><?php echo $appAlldata[0]['phone_number'];?></td>
                                        <td>Email Address :</td>
                                        <td><?php echo $appAlldata[0]['email'];?></td>                                        
                                    </tr>
                                    <tr>  
                                        <td>SSN : </td>
                                        <td><?php echo $appAlldata[0]['ssn'];?></td> 
                                        <td>Date Of Birth :</td>
                                        <td><?php echo $appAlldata[0]['dob'];?></td>                                       
                                        <td>Property Name :</td>
                                        <td><?php echo $appAlldata[0]['property_name'];?></td> 
                                    </tr>
                                    <tr> 
                                        <td>Move-in Date :</td>
                                        <td><?php echo $appAlldata[0]['movein_date'];?></td> 
                                        <td>Property Type :</td>
                                        <td><?php echo $appAlldata[0]['no_of_bedroom'];?></td> 
                                        <td>Driving License Number :</td>
                                        <td><?php echo $appAlldata[0]['drivinglicense'];?></td> 
                                    </tr>
                                     <tr>
                                        <td>Drivers License State:</td>
                                        <td colspan="5"><?php echo $appAlldata[0]['drivinglicensestate'];?></td> 
                                     </tr>
                                     <tr>
                                        <td colspan="6" style="font-size: 16px; font-weight: bold; text-align: left;">Employer Information</td> 
                                     </tr>
                                 
                                     <tr>
                                        <td>Current Employer Name : </td>
                                        <td><?php echo $appAlldata[0]['emp_name'];?></td>
                                        <td>Job Type : </td>
                                        <td><?php echo $appAlldata[0]['job_type'];?></td>
                                        <td>Employer Address :</td>
                                        <td><?php echo $appAlldata[0]['emp_address'];?></td>                                      
                                    </tr>
                                    <tr>  
                                        <td>Employer Phone Number : </td>
                                        <td><?php echo $appAlldata[0]['emp_aphone'];?></td>  
                                        <td>Position :</td>
                                        <td><?php echo $appAlldata[0]['position'];?></td>                                        
                                        <td>Supervisor Name :</td>
                                        <td><?php echo $appAlldata[0]['sup_name'];?></td>    
                                    </tr>
                                    <tr> 
                                        <td>How Long With Employer? (Years & Months) :</td>
                                        <td><?php echo $appAlldata[0]['job_duration'];?></td>  
                                        <td>Monthly Income From Employer :</td>
                                        <td><?php echo $appAlldata[0]['monthly_income'];?></td>  
                                        <td>Other Income :</td>
                                        <td><?php echo $appAlldata[0]['other_income'];?></td>  
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="font-size: 16px; font-weight: bold; text-align: left;">Current & Former Residency</td> 
                                     </tr>
                                 
                                     <tr>
                                        <td>Current Address : </td>
                                        <td><?php echo $appAlldata[0]['cur_address'];?></td>
                                        <td>How Long At This Address? : </td>
                                        <td><?php echo $appAlldata[0]['curjobyear'];?></td>
                                        <td>Rental Amount :</td>
                                        <td><?php echo $appAlldata[0]['cur_renamnt'];?></td>                                       
                                    </tr>
                                    <tr>  
                                        <td>Reason For Leaving : </td>
                                        <td><?php echo $appAlldata[0]['cur_resleaving'];?></td>
                                        <td>Position :</td>
                                        <td><?php echo $appAlldata[0]['other_income'];?></td>                                     
                                        <td>Landlord Name :</td>
                                        <td><?php echo $appAlldata[0]['curlname'];?></td>
                                    </tr>
                                    <tr> 
                                        <td>Former Address :</td>
                                        <td><?php echo $appAlldata[0]['for_address'];?></td>
                                        <td>How Long At This Address? :</td>
                                        <td><?php echo $appAlldata[0]['forresyear'];?></td>
                                        <td>Rental Amount :</td>
                                        <td><?php echo $appAlldata[0]['for_renamnt'];?></td>
                                    </tr>
                                    <tr> 
                                        <td>Reason For Leaving? :</td>
                                        <td><?php echo $appAlldata[0]['for_resleaving'];?></td>
                                        <td>Landlord Name :</td>
                                        <td><?php echo $appAlldata[0]['forlname'];?></td>
                                        <td>Landlord Phone Number :</td>
                                        <td><?php echo $appAlldata[0]['forland_phone'];?></td>
                                    </tr>
                                     <tr>
                                        <td colspan="6" style="font-size: 16px; font-weight: bold; text-align: left;">Other Details</td> 
                                     </tr>
                                 
                                     <tr>
                                        <td>Have You Declared Bankruptcy In The Past (7) Years? : </td>
                                        <td><?php if($appAlldata[0]['dec_bankrupcy']==1){ echo 'yes'; }else{ echo 'No';}?></td>
                                        <td>Have You Ever Been Evicted From A Rental Residence? : </td>
                                        <td><?php if($appAlldata[0]['evicted_residence']==1){ echo 'yes'; }else{ echo 'No';}?></td>
                                        <td>Have You Had Two Or More Late Rental Payments In The Past Year? :</td>
                                        <td><?php if($appAlldata[0]['rental_due']==1){ echo 'yes'; }else{ echo 'No';}?></td>                                       
                                    </tr>
                                    <tr>  
                                        <td>Have You Ever Been Convicted Of A Felony? : </td>
                                        <td><?php if($appAlldata[0]['con_felony']==1){ echo 'yes'; }else{ echo 'No';}?></td>
                                        <td>Are You A Registered Sex Offender? :</td>
                                        <td><?php if($appAlldata[0]['sex_offence']==1){ echo 'yes'; }else{ echo 'No';}?></td>                                      
                                        <td>Have You Ever Been Convicted Of A Drug Related Crime?:</td>
                                        <td><?php if($appAlldata[0]['drug_crime']==1){ echo 'yes'; }else{ echo 'No';}?></td> 
                                    </tr>
                                    <tr> 
                                        <td>Are You Currently On Probation Or Parole? :</td>
                                        <td><?php if($appAlldata[0]['parole']==1){ echo 'yes'; }else{ echo 'No';}?></td>
                                        <td>Have You Ever Willfully Or Intentionally Refused To Pay Rent? :</td>
                                        <td><?php if($appAlldata[0]['refused_rent']==1){ echo 'yes'; }else{ echo 'No';}?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="font-size: 16px; font-weight: bold; text-align: left;">Personal References</td> 
                                     </tr>
                                 
                                     <tr>
                                        <td>Reference 1 Name : </td>
                                        <td><?php echo $appAlldata[0]['ref1_name'];?></td>
                                        <td>Reference 1 Phone Number : </td>
                                        <td><?php echo $appAlldata[0]['ref1phone'];?><</td>
                                        <td>Reference 1 Relationship :</td>
                                        <td><?php echo $appAlldata[0]['ref1relation'];?></td>                                        
                                    </tr>
                                    <tr>  
                                        <td>Reference 2 Name : </td>
                                        <td><?php echo $appAlldata[0]['ref2_name'];?></td>
                                        <td>Reference 2 Phone Number :</td>
                                        <td><?php echo $appAlldata[0]['ref2phone'];?></td>                                     
                                        <td>Reference 2 Relationship :</td>
                                        <td><?php echo $appAlldata[0]['ref2relation'];?></td> 
                                    </tr>
                                    <tr> 
                                        <td>Emergency Contact Name :</td>
                                        <td><?php echo $appAlldata[0]['emrcontactname'];?></td>
                                        <td>Emergency Contact Number :</td>
                                        <td><?php echo $appAlldata[0]['emr_contactnumber'];?></td>
                                        <td>Emergency Contact Relationship :</td>
                                        <td><?php echo $appAlldata[0]['emr_contactrel'];?></td>
                                    </tr>
                                    
                                </table>
                             <?php endif;?>    
                        </div>
                        <a href="#" onclick="myPrint();">Print <span class="glyphicon glyphicon-print"></span></a>
                               
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            

</div>
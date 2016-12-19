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

                        <div class="padded" id="printDiv">
                           
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                    <caption style="text-align: left; font-size: 16px; font-weight: bold"></caption>
                                    <thead>
                                        <tr>
                                            <th colspan="7" style="text-align: center; font-size: 16px; font-weight: bold">Revenue</th>
                                            <th colspan="11" style="text-align: center; font-size: 16px; font-weight: bold">Expense</th>
                                            <th style="text-align: center; font-size: 16px; font-weight: bold">Cash Flow</th>
                                        </tr>
                                        <tr>
                                            <th>Month</th>
                                            <th>Week 1</th>
                                            <th>Week 2</th>
                                            <th>Week 3</th>
                                            <th>Week 4</th>
                                            <th>Week 5</th>
                                            <th>Total</th>
                                            <th>Mortgage/Taxes/Insurance</th>
                                            <th>Water</th>
                                            <th>Gas</th>
                                            <th>Electric</th>
                                            <th>Int/Ph/Cbl</th>
                                            <th>Mgmt</th>
                                            <th>Owner Pay</th>
                                            <th>Repairs</th>
                                            <th>Admin Expenses</th>
                                            <th>Liabilities</th>
                                            <th>Total</th>
                                            <th>Cash Flow</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>January</td>
                                        <?php foreach ($january as $jvalue) { ?>

                                        <td><?php if(isset($jvalue[0]['SUM(a.cr_amt)'])):echo '$'.$jvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $januaryTotal += $jvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($january)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        
                                        <td><?php if($januaryTotal!=0):echo '$'.$januaryTotal;endif;?></td>
                                        
                                         <?php foreach ($ejanuary as $ejvalue) { ?>
                                        
                                        <td><?php if(isset($ejvalue[0]['SUM(dr_amt)'])):echo '$'.$ejvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $ejanuaryTotal += $ejvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($jliabilities)): echo '$'.$jliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $jtotalincome = $januaryTotal - ($ejanuaryTotal - $ejvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($jtotalincome!=0):echo '$'.$jtotalincome;endif;?></td>
                                        <?php $jCashFlow = $jtotalincome - ($ejvalue[0]['SUM(dr_amt)'] + $jliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($jCashFlow!=0):echo '$'.$jCashFlow;endif;?></td>
                                        
                                    </tr>
                                    <tr>  
                                        <td>February</td>
                                        <?php foreach ($february as $fvalue) { ?>
                                        <td><?php if(isset($fvalue[0]['SUM(a.cr_amt)'])):echo '$'.$fvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $februaryTotal += $fvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($february)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($februaryTotal!=0):echo '$'.$februaryTotal;endif;?></td>
                                        
                                        <?php foreach ($efebruary as $efvalue) { ?>

                                        <td><?php if(isset($efvalue[0]['SUM(dr_amt)'])):echo '$'.$efvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $efebruaryTotal += $efvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($fliabilities)): echo '$'.$fliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $ftotalincome = $februaryTotal - ($efebruaryTotal - $efvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($ftotalincome!=0):echo '$'.$ftotalincome;endif;?></td>
                                        <?php $fCashFlow = $ftotalincome - ($efvalue[0]['SUM(dr_amt)'] + $fliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($fCashFlow!=0):echo '$'.$fCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>March</td>
                                        <?php foreach ($march as $mvalue) { ?>
                                        <td><?php if(isset($mvalue[0]['SUM(a.cr_amt)'])):echo '$'.$mvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $marchTotal += $mvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($march)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($marchTotal!=0):echo '$'.$marchTotal;endif;?></td>
                                        
                                         <?php foreach ($emarch as $emvalue) { ?>

                                        <td><?php if(isset($emvalue[0]['SUM(dr_amt)'])):echo '$'.$emvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $emarchTotal += $emvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        
                                        <td><?php if(isset($mliabilities)): echo '$'.$mliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $ftotalincome = $marchTotal - ($efebruaryTotal - $emvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($mtotalincome!=0):echo '$'.$mtotalincome;endif;?></td>
                                        <?php $mCashFlow = $mtotalincome - ($emvalue[0]['SUM(dr_amt)'] + $mliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($mCashFlow!=0):echo '$'.$mCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>April</td>
                                        <?php foreach ($april as $avalue) { ?>
                                        <td><?php if(isset($avalue[0]['SUM(a.cr_amt)'])):echo '$'.$avalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $aprilTotal += $avalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($april)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($aprilTotal!=0):echo '$'.$aprilTotal;endif;?></td>
                                        
                                        <?php foreach ($eapril as $eavalue) { ?>

                                        <td><?php if(isset($eavalue[0]['SUM(dr_amt)'])):echo '$'.$eavalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $eaprilTotal += $eavalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        
                                        <td><?php if(isset($aprliabilities)): echo '$'.$aprliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $ftotalincome = $aprilTotal - ($eaprilTotal - $eavalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($mtotalincome!=0):echo '$'.$mtotalincome;endif;?></td>
                                        <?php $mCashFlow = $mtotalincome - ($eavalue[0]['SUM(dr_amt)'] + $aprliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($mCashFlow!=0):echo '$'.$mCashFlow;endif;?></td>
                                        
                                    </tr>
                                    <tr> 
                                        <td>May</td>
                                        <?php foreach ($may as $mvalue) { ?>
                                        <td><?php if(isset($mvalue[0]['SUM(a.cr_amt)'])):echo '$'.$mvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $mayTotal += $mvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($may)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($mayTotal!=0):echo '$'.$mayTotal;endif;?></td>
                                        
                                        <?php foreach ($emay as $emayvalue) { ?>

                                        <td><?php if(isset($emayvalue[0]['SUM(dr_amt)'])):echo '$'.$emayvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $emayTotal += $emayvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        
                                        <td><?php if(isset($aprliabilities)): echo '$'.$aprliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $maytotalincome = $mayTotal - ($emayTotal - $emayvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($maytotalincome!=0):echo '$'.$maytotalincome;endif;?></td>
                                        <?php $mayCashFlow = $maytotalincome - ($emayvalue[0]['SUM(dr_amt)'] + $aprliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($mayCashFlow!=0):echo '$'.$mayCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>June</td>
                                        <?php foreach ($june as $jvalue) { ?>
                                        <td><?php if(isset($jvalue[0]['SUM(a.cr_amt)'])):echo '$'.$jvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $juneTotal += $jvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($june)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($juneTotal!=0):echo '$'.$juneTotal;endif;?></td>
                                        
                                        <?php foreach ($ejune as $ejunevalue) { ?>

                                        <td><?php if(isset($ejunevalue[0]['SUM(dr_amt)'])):echo '$'.$ejunevalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $ejuneTotal += $ejunevalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        
                                        <td><?php if(isset($juneliabilities)): echo '$'.$juneliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $junetotalincome = $juneTotal - ($ejuneTotal - $ejunevalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($junetotalincome!=0):echo '$'.$junetotalincome;endif;?></td>
                                        <?php $juneCashFlow = $junetotalincome - ($ejunevalue[0]['SUM(dr_amt)'] + $juneliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($juneCashFlow!=0):echo '$'.$juneCashFlow;endif;?></td>
                                        
                                    </tr>
                                    <tr> 
                                        <td>July</td>
                                        <?php foreach ($july as $juvalue) { ?>
                                         <td><?php if(isset($juvalue[0]['SUM(a.cr_amt)'])):echo '$'.$juvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $julyTotal += $juvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($july)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($julyTotal!=0):echo '$'.$julyTotal;endif;?></td>
                                        
                                        <?php foreach ($ejuly as $ejulyvalue) { ?>

                                        <td><?php if(isset($ejulyvalue[0]['SUM(dr_amt)'])):echo '$'.$ejulyvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $ejulyTotal += $ejulyvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($julyliabilities)): echo '$'.$julyliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $julytotalincome = $julyTotal - ($ejulyTotal - $ejulyvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($julytotalincome!=0):echo '$'.$julytotalincome;endif;?></td>
                                        <?php $julyCashFlow = $julytotalincome - ($ejulyvalue[0]['SUM(dr_amt)'] + $julyliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($julyCashFlow!=0):echo '$'.$julyCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>August</td>
                                        <?php foreach ($august as $augvalue) { ?>
                                        <td><?php if(isset($augvalue[0]['SUM(a.cr_amt)'])):echo '$'.$augvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $augustotal += $augvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($august)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($augustotal!=0):echo '$'.$augustotal;endif;?></td>
                                        
                                        <?php foreach ($eaugust as $eaugustvalue) { ?>

                                        <td><?php if(isset($eaugustvalue[0]['SUM(dr_amt)'])):echo '$'.$eaugustvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $eaugustotal += $eaugustvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($augliabilities)): echo '$'.$augliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $augtotalincome = $augustotal - ($eaugustotal - $ejulyvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($augtotalincome!=0):echo '$'.$augtotalincome;endif;?></td>
                                        <?php $augCashFlow = $augtotalincome - ($ejulyvalue[0]['SUM(dr_amt)'] + $augliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($augCashFlow!=0):echo '$'.$augCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>September</td>
                                        <?php foreach ($september as $sepvalue) { ?>
                                        <td><?php if(isset($sepvalue[0]['SUM(a.cr_amt)'])):echo '$'.$sepvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $septembertotal += $sepvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($september)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($septembertotal!=0):echo '$'.$septembertotal;endif;?></td>
                                        
                                        <?php foreach ($eseptember as $esepvalue) { ?>

                                        <td><?php if(isset($esepvalue[0]['SUM(dr_amt)'])):echo '$'.$esepvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $eseptembertotal += $esepvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        
                                        <td><?php if(isset($sepliabilities)): echo '$'.$sepliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $septotalincome = $septembertotal - ($eseptembertotal - $esepvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($septotalincome!=0):echo '$'.$septotalincome;endif;?></td>
                                        <?php $sepCashFlow = $septotalincome - ($esepvalue[0]['SUM(dr_amt)'] + $sepliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($sepCashFlow!=0):echo '$'.$sepCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>October</td>
                                        <?php foreach ($october as $ocvalue) { ?>
                                        <td><?php if(isset($ocvalue[0]['SUM(a.cr_amt)'])):echo '$'.$ocvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $octobertotal += $ocvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($october)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($octobertotal!=0):echo '$'.$octobertotal;endif;?></td>
                                        
                                        <?php foreach ($eoctober as $eoctvalue) { ?>

                                        <td><?php if(isset($eoctvalue[0]['SUM(dr_amt)'])):echo '$'.$eoctvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $eoctobertotal += $eoctvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($octliabilities)): echo '$'.$octliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $octtotalincome = $octobertotal - ($eoctobertotal - $eoctvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($octtotalincome!=0):echo '$'.$octtotalincome;endif;?></td>
                                        <?php $octCashFlow = $octtotalincome - ($esepvalue[0]['SUM(dr_amt)'] + $octliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($octCashFlow!=0):echo '$'.$octCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>November</td>
                                         <?php foreach ($november as $novvalue) { ?>
                                        <td><?php if(isset($novvalue[0]['SUM(a.cr_amt)'])):echo '$'.$novvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $novembertotal += $novvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($november)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($novembertotal!=0):echo '$'.$novembertotal;endif;?></td>
                                        
                                        <?php foreach ($enovember as $enovvalue) { ?>

                                        <td><?php if(isset($enovvalue[0]['SUM(dr_amt)'])):echo '$'.$enovvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $enovembertotal += $enovvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($novliabilities)): echo '$'.$novliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $novtotalincome = $novembertotal - ($enovembertotal - $enovvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($novtotalincome!=0):echo '$'.$novtotalincome;endif;?></td>
                                        <?php $novCashFlow = $novtotalincome - ($enovvalue[0]['SUM(dr_amt)'] + $novliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($novCashFlow!=0):echo '$'.$novCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td>December</td>
                                        <?php foreach ($december as $decvalue) { ?>
                                        <td><?php if(isset($decvalue[0]['SUM(a.cr_amt)'])):echo '$'.$decvalue[0]['SUM(a.cr_amt)'];endif;?></td>
                                         <?php 
                                            $decembertotal += $decvalue[0]['SUM(a.cr_amt)'];
                                            } 
                                         ?>
                                        <?php if(count($december)< 5 ) :?>
                                        <td></td>
                                        <?php endif;?>
                                        <td><?php if($decembertotal!=0):echo '$'.$decembertotal;endif;?></td>
                                        
                                        <?php foreach ($edecember as $edecvalue) { ?>

                                        <td><?php if(isset($edecvalue[0]['SUM(dr_amt)'])):echo '$'.$edecvalue[0]['SUM(dr_amt)'];endif;?></td>
                                        
                                         <?php 
                                            $edecembertotal += $edecvalue[0]['SUM(dr_amt)'];
                                            } 
                                         ?>
                                        <td><?php if(isset($decliabilities)): echo '$'.$decliabilities[0]['SUM(dr_amt)']; endif;?></td>
                                        <?php $dectotalincome = $decembertotal - ($edecembertotal - $edecvalue[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($dectotalincome!=0):echo '$'.$dectotalincome;endif;?></td>
                                        <?php $decCashFlow = $dectotalincome - ($edecvalue[0]['SUM(dr_amt)'] + $decliabilities[0]['SUM(dr_amt)']); ?>
                                        <td><?php if($decCashFlow!=0):echo '$'.$decCashFlow;endif;?></td>
                                    </tr>
                                    <tr> 
                                        <td style="font-size: 15px; font-weight: bold; ">2015 Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo '$'.$monthlyTotal = ($januaryTotal+$februaryTotal+$marchTotal+$aprilTotal+$mayTotal+$juneTotal+$julyTotal+$augustotal+$septembertotal+$octobertotal+$novembertotal+$decembertotal);?></td>
                                    </tr>
                                    
                                    
                                </table>   
                        </div>
                        
                               
                </div>                
			</div>
                        <div style="height: 25px; text-align: center;">
                                    <a href="#" onclick="myPrint();" class="btn btn-facebook"><i class="icon-print"></i></a>
                        </div>
			<!----end weekly income--->
            

</div>
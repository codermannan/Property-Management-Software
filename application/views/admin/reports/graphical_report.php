<?php
// For Repairs
$incomeValue = [
          ['Months', 'Rental Income'],
          ['Jan', round($january[0]['SUM(a.cr_amt)'])],
          ['Feb', round($february[0]['SUM(a.cr_amt)'])],
          ['Mar', round($march[0]['SUM(a.cr_amt)'])],
          ['Apr', round($april[0]['SUM(a.cr_amt)']) ],
          ['May', round($may[0]['SUM(a.cr_amt)'])],
          ['Jun', round($june[0]['SUM(a.cr_amt)'])],
          ['Jul', round($july[0]['SUM(a.cr_amt)'])],
          ['Aug', round($august[0]['SUM(a.cr_amt)'])],
          ['Sep', round($september[0]['SUM(a.cr_amt)'])],
          ['Oct', round($october[0]['SUM(a.cr_amt)'])],
          ['Nov', round($november[0]['SUM(a.cr_amt)'])],
          ['Dec', round($december[0]['SUM(a.cr_amt)'])]
    ];

//for expense
$allValue = [
          ['Months', 'Water','Gas','Electric', 'Internet', 'Mgmt', 'Repair'],
          ['Jan', round($ejanuary[1][0]['SUM(dr_amt)']) ,round($ejanuary[2][0]['SUM(dr_amt)']),round($ejanuary[3][0]['SUM(dr_amt)']),round($ejanuary[4][0]['SUM(dr_amt)']) ,round($ejanuary[5][0]['SUM(dr_amt)']),round($ejanuary[7][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[1][0]['SUM(dr_amt)']),round($efebruary[2][0]['SUM(dr_amt)']),round($efebruary[3][0]['SUM(dr_amt)']),round($efebruary[4][0]['SUM(dr_amt)']),round($efebruary[5][0]['SUM(dr_amt)']),round($efebruary[7][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[1][0]['SUM(dr_amt)']),round($emarch[2][0]['SUM(dr_amt)']),round($emarch[3][0]['SUM(dr_amt)']),round($emarch[4][0]['SUM(dr_amt)']),round($emarch[5][0]['SUM(dr_amt)']),round($emarch[7][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[1][0]['SUM(dr_amt)']),round($eapril[2][0]['SUM(dr_amt)']),round($eapril[3][0]['SUM(dr_amt)']),round($eapril[4][0]['SUM(dr_amt)']),round($eapril[5][0]['SUM(dr_amt)']),round($eapril[7][0]['SUM(dr_amt)'])],
          ['May', round($emay[1][0]['SUM(dr_amt)']), round($emay[2][0]['SUM(dr_amt)']),round($emay[3][0]['SUM(dr_amt)']),round($emay[4][0]['SUM(dr_amt)']), round($emay[5][0]['SUM(dr_amt)']),round($emay[7][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[1][0]['SUM(dr_amt)']),round($ejune[2][0]['SUM(dr_amt)']),round($ejune[3][0]['SUM(dr_amt)']),round($ejune[4][0]['SUM(dr_amt)']),round($ejune[5][0]['SUM(dr_amt)']),round($ejune[7][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[1][0]['SUM(dr_amt)']), round($ejuly[2][0]['SUM(dr_amt)']),round($ejuly[3][0]['SUM(dr_amt)']),round($ejuly[4][0]['SUM(dr_amt)']), round($ejuly[5][0]['SUM(dr_amt)']),round($ejuly[7][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[1][0]['SUM(dr_amt)']),round($eaugust[2][0]['SUM(dr_amt)']),round($eaugust[3][0]['SUM(dr_amt)']),round($eaugust[4][0]['SUM(dr_amt)']),round($eaugust[5][0]['SUM(dr_amt)']),round($eaugust[7][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[1][0]['SUM(dr_amt)']),round($eseptember[2][0]['SUM(dr_amt)']),round($eseptember[3][0]['SUM(dr_amt)']),round($eseptember[4][0]['SUM(dr_amt)']),round($eseptember[5][0]['SUM(dr_amt)']),round($eseptember[7][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[1][0]['SUM(dr_amt)']),round($eoctober[2][0]['SUM(dr_amt)']),round($eoctober[3][0]['SUM(dr_amt)']),round($eoctober[4][0]['SUM(dr_amt)']),round($eoctober[5][0]['SUM(dr_amt)']),round($eoctober[7][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[1][0]['SUM(dr_amt)']),round($enovember[2][0]['SUM(dr_amt)']),round($enovember[3][0]['SUM(dr_amt)']),round($enovember[4][0]['SUM(dr_amt)']),round($enovember[5][0]['SUM(dr_amt)']),round($enovember[7][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[1][0]['SUM(dr_amt)']),round($edecember[2][0]['SUM(dr_amt)']),round($edecember[3][0]['SUM(dr_amt)']),round($edecember[4][0]['SUM(dr_amt)']),round($edecember[5][0]['SUM(dr_amt)']),round($edecember[7][0]['SUM(dr_amt)'])]
    ];

// For cashflow
$cashflowValue = [
          ['Months', 'Cash Flow'],
          ['Jan', round($janCash)],
          ['Feb', round($febCash)],
          ['Mar', round($marCash)],
          ['Apr', round($aprCash)],
          ['May', round($mayCash)],
          ['Jun', round($juneCash)],
          ['Jul', round($julyCash)],
          ['Aug', round($augCash)],
          ['Sep', round($sepCash)],
          ['Oct', round($octCash)],
          ['Nov', round($novCash)],
          ['Dec', round($decCash)]
    ];

$waterValue = [
          ['Months', 'Water'],
          ['Jan', round($ejanuary[1][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[1][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[1][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[1][0]['SUM(dr_amt)'])],
          ['May', round($emay[1][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[1][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[1][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[1][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[1][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[1][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[1][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[1][0]['SUM(dr_amt)'])]
    ];
// For gas
$gasValue = [
          ['Months', 'Gas'],
          ['Jan', round($ejanuary[2][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[2][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[2][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[2][0]['SUM(dr_amt)']) ],
          ['May', round($emay[2][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[2][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[2][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[2][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[2][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[2][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[2][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[2][0]['SUM(dr_amt)'])]
    ];
// For electric
$electricValue = [
          ['Months', 'Electric'],
          ['Jan', round($ejanuary[3][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[3][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[3][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[3][0]['SUM(dr_amt)']) ],
          ['May', round($emay[3][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[3][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[3][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[3][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[3][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[3][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[3][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[3][0]['SUM(dr_amt)'])]
    ];

// For electric
$cableValue = [
          ['Months', 'Int/Ph/Cbl'],
          ['Jan', round($ejanuary[4][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[4][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[4][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[4][0]['SUM(dr_amt)']) ],
          ['May', round($emay[4][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[4][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[4][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[4][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[4][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[4][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[4][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[4][0]['SUM(dr_amt)'])]
    ];

// For mgmt
$mgmtValue = [
          ['Months', 'Mgmt'],
          ['Jan', round($ejanuary[5][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[5][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[5][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[5][0]['SUM(dr_amt)']) ],
          ['May', round($emay[5][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[5][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[5][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[5][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[5][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[5][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[5][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[5][0]['SUM(dr_amt)'])]
    ];
// For Repairs
$repairstValue = [
          ['Months', 'Mgmt'],
          ['Jan', round($ejanuary[7][0]['SUM(dr_amt)'])],
          ['Feb', round($efebruary[7][0]['SUM(dr_amt)'])],
          ['Mar', round($emarch[7][0]['SUM(dr_amt)'])],
          ['Apr', round($eapril[7][0]['SUM(dr_amt)']) ],
          ['May', round($emay[7][0]['SUM(dr_amt)'])],
          ['Jun', round($ejune[7][0]['SUM(dr_amt)'])],
          ['Jul', round($ejuly[7][0]['SUM(dr_amt)'])],
          ['Aug', round($eaugust[7][0]['SUM(dr_amt)'])],
          ['Sep', round($eseptember[7][0]['SUM(dr_amt)'])],
          ['Oct', round($eoctober[7][0]['SUM(dr_amt)'])],
          ['Nov', round($enovember[7][0]['SUM(dr_amt)'])],
          ['Dec', round($edecember[7][0]['SUM(dr_amt)'])]
    ];
//echo '<pre>';
//    print_r($datsa);
//echo '</pre>';
?>
<head>
    <script src="<?php echo base_url();?>template/js/jsapi.js" type="text/javascript"></script>
    <script type="text/javascript"> 
        
      //----------
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
          
        // for all income
         var all_income_data = google.visualization.arrayToDataTable(<?php echo json_encode($incomeValue); ?>);

          var options_income = {
          title: 'All Rental Income',
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 500,
                max: 2000
            }
          },
        };

        //for all expense
        var all_operating_data = google.visualization.arrayToDataTable(<?php echo json_encode($allValue); ?>);
        
        var options_all = {
          title: 'All Operating Expenses',
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 2000
            }
          },
        };
        
        // for cash flow
         var cash_flow_data = google.visualization.arrayToDataTable(<?php echo json_encode($cashflowValue); ?>);

          var options_cashflow = {
          title: 'Monthly Cash Flow',
          colors: ['#01480E'],
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 500,
                max: 2000
            }
          },
        };

        //for water expense
         var water_data = google.visualization.arrayToDataTable(<?php echo json_encode($waterValue); ?>);
         
        var options_water = {
          title: 'Water Expense',
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 100
            }
          },
        };
        
        //for gas expense
        var gas_data = google.visualization.arrayToDataTable(<?php echo json_encode($gasValue); ?>);
        
        var options_gas = {
          title: 'Gas Expense',
          colors: ['#e0440e'],
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 300
            }
          },
        };
        
        //for Electric expense
        var ele_data = google.visualization.arrayToDataTable(<?php echo json_encode($electricValue); ?>);
        
        var options_ele = {
          title: 'Electric Expense',
          colors: ['#FFE0B3'],
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 2000
            }
          },
        };
        
        //for internet expense
        var int_data = google.visualization.arrayToDataTable(<?php echo json_encode($cableValue); ?>);
        
        var options_int = {
          title: 'Internet/Phone/Cable Expense',
          colors: ['#C3D6BB'],
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 196
            }
          },
        };
        
        //for mgmt expense
        var mgmt_data = google.visualization.arrayToDataTable(<?php echo json_encode($mgmtValue); ?>);
        
        var options_mgmt = {
          title: 'Management Expense',
          colors: ['#E0B3FF'],
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 840
            }
          },
        };
        
        //for Repair Expense
        var repair_data = google.visualization.arrayToDataTable(<?php echo json_encode($repairstValue); ?>);
        
        var options_repair = {
          title: 'Repair Expense',
          colors: ['#C2D1F0'],
          hAxis: {title: 'January - December 2015',  titleTextStyle: {color: '#333'}},
          vAxis: {
             viewWindow: {
                min: 0,
                max: 1000
            }
          },
        };
        
        
        var all_income = new google.visualization.ColumnChart(document.getElementById('all_income'));
        all_income.draw(all_income_data, options_income);
        var all_operating = new google.visualization.AreaChart(document.getElementById('all_operating'));
        all_operating.draw(all_operating_data, options_all);
        var all_cashflow = new google.visualization.ColumnChart(document.getElementById('all_cashflow'));
        all_cashflow.draw(cash_flow_data, options_cashflow);
        
        
        var water_bill = new google.visualization.AreaChart(document.getElementById('water_bill'));
        water_bill.draw(water_data, options_water);
        var gas_bill = new google.visualization.AreaChart(document.getElementById('gas_bill'));
        gas_bill.draw(gas_data, options_gas);
        var elictric = new google.visualization.AreaChart(document.getElementById('elictric'));
        elictric.draw(ele_data, options_ele);
        
        var internet_bill = new google.visualization.AreaChart(document.getElementById('internet'));
        internet_bill.draw(int_data, options_int);
        var mgmt_bill = new google.visualization.AreaChart(document.getElementById('mgmt'));
        mgmt_bill.draw(mgmt_data, options_mgmt);  
        var repair_bill = new google.visualization.AreaChart(document.getElementById('repair'));
        repair_bill.draw(repair_data, options_repair);

      }
      function myPrint() {
        var printContents = document.getElementById('printDiv').innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
    </script>
</head>
<div class="box">

    <div style="width: 100%; overflow: auto; float: left;" id="printDiv">
       <div style="width: 1215px; position: relative;"> 	
            <div id="all_income" style="width: 400px; height: 200px; float: left;border: 1px solid #000;"></div>
            <div id="all_operating" style="width: 400px; height: 200px; float: left;border: 1px solid #000;"></div>
            <div id="all_cashflow" style="width: 400px; height: 200px; float: left;border: 1px solid #000;"></div>
       </div>                  

       <div style="width: 1215px; position: relative;"> 
           <div id="water_bill" style="width: 400px; height: 200px; float: left; border: 1px solid #000;"></div>
            <div id="gas_bill" style="width: 400px; height: 200px; float: left; border: 1px solid #000;"></div>
            <div id="elictric" style="width: 400px; height: 200px; float: left;border: 1px solid #000;"></div>                    
      </div>

       <div style="width: 1215px; position: relative;"> 
            <div id="internet" style="width: 400px; height: 200px; float: left; border: 1px solid #000;"></div>
            <div id="mgmt" style="width: 400px; height: 200px; float: left; border: 1px solid #000;"></div>
            <div id="repair" style="width: 400px; height: 200px; float: left;border: 1px solid #000;"></div>
       </div>                       
    </div>
    <div style="height: 25px; text-align: center;">
                <a href="#" onclick="myPrint();" class="btn btn-facebook"><i class="icon-print"></i></a>
    </div>
</div>
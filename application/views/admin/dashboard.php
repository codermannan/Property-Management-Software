<div class="container-fluid padded">
	<div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons-->
            <div class="action-nav-normal">
                <div class="row-fluid">
                    <div class="panel panel-primary" style="height: 195px; float: left; margin-right: 10px; width: 264px;">
                        <div class="panel-heading" style="height: 115px;">
                            <div>
                                <div style="float: left; width: 35%; margin-left: 15px; margin-top: 20px;">
                                    <i class="icon-user fa-5x"></i>
                                </div>
                                <div class="text-right" style="float: left; width: 55%;">
                                    <div class="huge"><?php echo $this->db->count_all_results('property');?></div>
                                    <div>Total Tenants!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="color: #23527c;">View Details</span>
                                <span class="pull-right"><i class="icon-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="panel panel-green" style="height: 195px; float: left; margin-right: 5px; width: 264px;">
                        <div class="panel-heading" style="height: 115px;">
                            <div>
                                <div style="float: left; width: 35%; margin-left: 15px; margin-top: 20px;">
                                    <i class="icon-globe fa-5x"></i>
                                </div>
                                <div class="text-right" style="float: left; width: 55%;">
                                    <div class="huge"><?php echo $this->Operation_Model->vacancyRateCalculation().'%';?></div>
                                    <div>Vacancy Rate</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="color: #5cb85c;">View Details</span>
                                <span class="pull-right"><i class="icon-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="panel panel-yellow" style="height: 195px; float: left; margin-right: 10px; width: 264px;">
                        <div class="panel-heading" style="height: 115px;">
                            <div>
                                <div style="float: left; width: 35%; margin-left: 15px; margin-top: 20px;">
                                    <i class="icon-money fa-5x"></i>
                                </div>
                                <div class="text-right" style="float: left; width: 55%;">
                                    <div class="huge">$500</div>
                                    <div>Total Deposit!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="color: #f0ad4e;">View Details</span>
                                <span class="pull-right"><i class="icon-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="panel panel panel-red" style="height: 195px; float: left; width: 263px;">
                        <div class="panel-heading" style="height: 115px;">
                            <div>
                                <div style="float: left; width: 35%; margin-left: 15px; margin-top: 20px;">
                                    <i class="icon-money fa-5x"></i>
                                </div>
                                <div class="text-right" style="float: left; width: 55%;">
                                    <div class="huge">$450</div>
                                    <div>Total Cash Out!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="color: #d9534f;">View Details</span>
                                <span class="pull-right"><i class="icon-arrow-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
        <!---DASHBOARD MENU BAR ENDS HERE-->
    </div>
    <hr />
    <div class="row-fluid">
    
    	<!-----CALENDAR SCHEDULE STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <div class="title">
                        <i class="icon-calendar"></i> <?php echo get_phrase('calendar_schedule');?>
                    </div>
                </div>
                <div class="box-content">
                    <div id="schedule_calendar">
                    </div>
                </div>
            </div>
        </div>
    	<!-----CALENDAR SCHEDULE ENDS-->
        
    	<!-----NOTICEBOARD LIST STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <span class="title">
                        <i class="icon-reorder"></i> <?php echo get_phrase('noticeboard');?>
                    </span>
                </div>
                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">
                
                    <?php 
					$this->db->order_by('create_timestamp' , 'desc');
                    $notices	=	$this->db->get('noticeboard')->result_array();
                    foreach($notices as $row):
                    ?>
                    <div class="box-section news with-icons">
                        <div class="avatar blue">
                            <i class="icon-tag icon-2x"></i>
                        </div>
                        <div class="news-time">
                            <span><?php echo date('d',$row['create_timestamp']);?></span> <?php echo date('M',$row['create_timestamp']);?>
                        </div>
                        <div class="news-content">
                            <div class="news-title">
                                <?php echo $row['notice_title'];?>
                            </div>
                            <div class="news-text">
                                 <?php echo $row['notice'];?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    	<!-----NOTICEBOARD LIST ENDS-->
    </div>
    <div class="row-fluid">
        <!-----VACANCY RATE STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <span class="title">
                        <i class="icon-reorder"></i> <?php echo get_phrase('vacancy_rate');?>
                    </span>
                </div>
                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto;">
                    <div class="box-section news with-icons">
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                        <th><div><?php echo get_phrase('property_name');?></div></th>    
                                        <th><div><?php echo get_phrase('units_available');?></div></th>
                                        <th><div><?php echo get_phrase('units_vacant');?></div></th> 
                                        <th><div><?php echo get_phrase('vacancy_rate');?></div></th>
                                        <th><div><?php echo get_phrase('occupancy_rate');?></div></th>
                                    </tr>
                               </thead>
                            <tbody>
                                <?php 
                                    foreach($vrate as $row):
                                        
                                    $unitq = $this->db->query('SELECT * FROM `unit` WHERE `property_name` = '.$row['property_id']);
                                    $totalUnit =  $unitq->num_rows();

                                    $vacantq = $this->db->query('SELECT * FROM `unit` WHERE `property_name` = '.$row['property_id'].' AND `vacant_status` =1');
                                    $totalVacantUnit =  $vacantq->num_rows();
                                      
                                    $vrate = substr($totalVacantUnit/$totalUnit,2,2);
                                    
                                ?>
                                <tr>
                                    <td><?php echo $row['property_name'];?></td>
                                    <td><?php echo $totalUnit;?></td>
                                    <td><?php echo $totalVacantUnit;?></td>
                                    <td><?php echo $vrate.'%';?></td>
                                    <td><?php echo (100 - $vrate).'%';?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                 
                </div>
            </div>
        </div>
    	<!-----VACANCY RATE ENDS-->
        <!-----PROJECT MANAGER STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <span class="title">
                        <i class="icon-reorder"></i> <?php echo get_phrase('projects_');?>
                    </span>
                </div>
                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto;">
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
            </div>
        </div>
    	<!-----PROJECT MANAGER ENDS-->
    </div>
    <div class="row-fluid">
        <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                                    <th><div><?php echo get_phrase('sl#_');?></div></th>
                                    <th><div><?php echo get_phrase('Timestamp');?></div></th>
                                    <th><div><?php echo get_phrase('job_title');?></div></th>
                                    <th><div><?php echo get_phrase('Contractor');?></div></th>
                                    <th><div><?php echo get_phrase('property_address');?></div></th>
                                    <th><div><?php echo get_phrase('Total Expense');?></div></th>
                                    <th><div><?php echo get_phrase('Authorized ');?></div></th>
                                    <th><div><?php echo get_phrase('payment_status ');?></div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php 
                            $count = 1;foreach($work_order as $row):
                            $totalExpense = ($row['Material1Cost'] + $row['Material2Cost'] + $row['Labor1Charge'] + $row['Labor2Charge']);
                            $property_name = $this->Operation_Model->getSingleDataOfTable('property_name', 'property_id', $row['PropertyId'], 'property');
                        ?>
                        
                        <tr>
                            <td><?php echo $row['wo_id'];?></td>
                            <td><?php echo date('m-d-Y',  strtotime($row['Timestamp']));?></td>
                            <td><?php echo $row['JobTitle'];?></td>
                            <td><?php if($row['contractor']==1): echo 'Diversified Renovating Solutions'; else: echo 'Other'; endif;?></td>
                            <td><?php echo $property_name;?></td>
                            <td><?php echo '$'.$totalExpense;?></td>
                            <?php if($row['isAuthorized']=='Approve'):?><td style="text-align: center; color: #eaebef; font-weight: 600; background-color: green;"><?php echo $row['isAuthorized'];?></td>
                            <?php elseif($row['isAuthorized']=='Decline'):?><td style="background-color: rgb(255, 0, 0); text-align: center; font-weight: bold; color: rgb(255, 255, 255);"><?php echo $row['isAuthorized'];?></td>
                            <?php elseif($row['isAuthorized']=='Defer'):?><td style="background-color: rgb(254, 191, 16); text-align: center; color: rgb(18, 73, 239); font-weight: 600;"><?php echo $row['isAuthorized'];?></td><?php endif;?>
                            
                            <?php if($row['isPaid']=='Yes'):?><td style="text-align: center; color: #eaebef; font-weight: 600; background-color: green;"><?php echo $row['isPaid'];?></td>
                            <?php elseif($row['isPaid']=='No'):?><td style="background-color: rgb(255, 0, 0); text-align: center; font-weight: bold; color: rgb(255, 255, 255);"><?php echo $row['isPaid'];?></td><?php endif;?> 
                           
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
    </div>
</div>

  
  
  <script>
  $(document).ready(function() {

    // page is now ready, initialize the calendar...

    $("#schedule_calendar").fullCalendar({
            header: {
                left: "prev,next",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            editable: 0,
            droppable: 0,
            events: [
					<?php 
					
                    $notices	=	$this->db->get('noticeboard')->result_array();
                    foreach($notices as $row):
                    ?>
					{
						title: "<?php echo $row['notice_title'];?>",
						start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
						end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>)  
            		},
					<?php
					endforeach;
					?>
					]
        })

});
  </script>
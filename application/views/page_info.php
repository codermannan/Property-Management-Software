        <div class="container-fluid" >
            <div class="row-fluid">
                <div class="area-top clearfix">
                    <div class="pull-left header">
                        <h3 class="title">
                        <i class="icon-info-sign"></i>
                        <?php echo $page_title;?> </h3>
                    </div>
                    <ul class="inline pull-right sparkline-box">
                        <li class="sparkline-row">
                            <h4 class="green">
                                <span><?php echo get_phrase('tenant');?></span> 
                                <?php echo $this->db->count_all_results('p_tenant');?>
                            </h4>
                        </li>
                        <li class="sparkline-row">
                            <h4 class="red">
                                <span><?php echo get_phrase('property');?></span> 
                                <?php echo $this->db->count_all_results('property');?>
                            </h4>
                        </li>
                        <li class="sparkline-row">
                            <h4 class="blue">
                                <span><?php echo get_phrase('owner');?></span> 
                                <?php echo $this->db->count_all_results('p_landlord');?>
                            </h4>
                        </li>
                        <li class="sparkline-row">
                            <h4 class="green">
                                <span><?php echo get_phrase('work_order');?></span> 
                                <?php echo $this->db->count_all_results('work_order');?>
                            </h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!--------FLASH MESSAGES--->
        
		<!--<?php if($this->session->flashdata('flash_message') != ""):?>
        <div class="container-fluid padded">
        	<div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert">Ã—</button>
              <?php echo $this->session->flashdata('flash_message');?>
            </div>
        </div>
        <?php endif;?>-->
        
        
        <?php if($this->session->flashdata('flash_message') != ""):?>
 		<script>
			$(document).ready(function() {
				Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:""})
			});
		</script>
        <?php endif;?>
<div class="clearfix js-responses js-load-admin-chart-stores">
	<?php
		$class = 'admin-dashboard-chart';
		$class_pass = 'admin-dashboard-pass-usage-chart';
		?>
			 <?php
 		$arrow = "down-arrow";
 		if(isset($this->request->params['named']['is_ajax_load'])){
         $arrow = "up-arrow";
	   }
 ?>
	<div class="main-tl">
		<div class="main-tr">
			<div class="main-tm"> </div>
		</div>
	</div>
	<div class="main-left-shadow">
		<div class="main-right-shadow">
			<div class="main-inner clearfix">
			<div class="admin-side1-tc admin-side1-tc1 clearfix">
				<h2 class="chart-dashboard-title ribbon-title clearfix">
                     <?php echo __l('Stores'); ?>
                 <span class="js-chart-showhide <?php echo $arrow; ?> {'chart_block':'admin-dashboard-stores', 'dataloading':'div.js-load-admin-chart-stores',  'dataurl':'admin/charts/chart_stores/is_ajax_load:1'}"></span>
                 </h2>
<?php if(isset($this->request->params['named']['is_ajax_load'])){ ?>
				<div class="admin-center-block clearfix dashboard-center-block" id="admin-dashboard-stores">
					<div class="clearfix">
						<?php echo $this->Form->create('Chart' , array('class' => 'language-form', 'action' => 'chart_stores')); ?>
						<?php 			echo $this->Form->input('is_ajax_load', array('type' => 'hidden', 'value' => 1));?>
						<?php echo $this->Form->input('select_range_id', array('class' => 'js-chart-autosubmit', 'label' => __l('Select Range'))); ?>
						<div class="hide"> <?php echo $this->Form->submit('Submit');  ?> </div>
						<?php echo $this->Form->end(); ?>
					</div>
						<div class="clearfix">
					<div class="js-load-line-graph chart-half-section {'data_container':'stores_line_data', 'chart_container':'stores_line_chart', 'chart_title':'<?php echo __l('Stores') ;?>', 'chart_y_title': '<?php echo __l('Stores');?>'}">
						<div class="dashboard-tl">
							<div class="dashboard-tr">
								<div class="dashboard-tc"></div>
							</div>
						</div>
						<div class="dashboard-cl">
							<div class="dashboard-cr">
								<div class="dashboard-cc clearfix">
									<div id="stores_line_chart" class="<?php echo $class; ?>"></div>
									<div class="hide">
										<table id="stores_line_data" class="list">
											<thead>
												<tr>
													<th>Period</th>
													<?php foreach($chart_stores_periods as $_period): ?>
														<th><?php echo $_period['display']; ?></th>
													<?php endforeach; ?>              	
												</tr>
											</thead>
											<tbody>
												<?php foreach($chart_stores_data as $display_name => $chart_data): ?>
													<tr>
														<th><?php echo $display_name; ?></th>
														<?php foreach($chart_data as $val): ?>
															<td><?php echo $val; ?></td>
														<?php endforeach; ?> 
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="dashboard-bl">
							<div class="dashboard-br">
								<div class="dashboard-bc"></div>
							</div>
						</div>
					</div>
					<div class="js-load-line-graph chart-half-section {'data_container':'store_pass_line_data', 'chart_container':'store_pass_line_chart', 'chart_title':'<?php echo __l('Affiliates/Stores') ;?>', 'chart_y_title': '<?php echo __l('Affiliates/Stores');?>'}">
						<div class="dashboard-tl">
							<div class="dashboard-tr">
								<div class="dashboard-tc"></div>
							</div>
						</div>
						<div class="dashboard-cl">
							<div class="dashboard-cr">
								<div class="dashboard-cc clearfix">
									<div id="store_pass_line_chart" class="<?php echo $class; ?>"></div>
									<div class="hide">
										<table id="store_pass_line_data" class="list">
											<thead>
												<tr>
													<th>Period</th>
													<?php foreach($chart_store_pass_periods as $_period): ?>
														<th><?php echo $_period['display']; ?></th>
													<?php endforeach; ?>              	
												</tr>
											</thead>
											<tbody>
												<?php foreach($chart_store_pass_data as $display_name => $chart_data): ?>
													<tr>
														<th><?php echo $display_name; ?></th>
														<?php foreach($chart_data as $val): ?>
															<td><?php echo $val; ?></td>
														<?php endforeach; ?> 
													</tr>
												<?php endforeach; ?>     	        							
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="dashboard-bl">
							<div class="dashboard-br">
								<div class="dashboard-bc"></div>
							</div>
						</div>
					</div>
					</div>
    			</div>
    			<?php } ?>
			</div>
		</div>
		</div>
	</div>
	<div class="main-bl">
		<div class="main-br">
			<div class="main-bm"> </div>
		</div>
	</div>
</div>
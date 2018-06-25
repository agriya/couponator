<div class="js-response">
<div class="info-details"><?php echo __l('Diagnostics are for developer purpose only.'); ?></div>
  <ul class="setting-links   clearfix">
			<li class="grid_12 omega alpha">
    			<div class="setting-details-info search-logs">
                    <h3><?php echo $this->Html->link(__l('Search Logs'), array('controller' => 'search_logs', 'action' => 'index'),array('title' => __l('Search Logs'))); ?></h3>
                    <div><?php echo __l('Search Logs'); ?></div>
                </div>
            </li>
            	<li class="grid_12 omega alpha">
    			<div class="setting-details-info search-keywords">
                    <h3><?php echo $this->Html->link(__l('Search Keywords'), array('controller' => 'search_keywords', 'action' => 'index'),array('title' => __l('Search Keywords'))); ?></h3>
                    <div><?php echo __l('Search by keywords'); ?></div>
                </div>
            </li>
			<li class="grid_12 omega alpha">
    			<div class="setting-details-info debug-error">
                    <h3><?php echo $this->Html->link(__l('Debug & Error Log'), array('controller' => 'devs', 'action' => 'logs'),array('title' => __l('Debug & Error Log'))); ?></h3>
                    <div><?php echo __l('View debug, error log, used cache memory and used log memory'); ?></div>
                </div>
            </li>
    </ul>
</div>
<?php $this->pageTitle = __l('Tools'); ?>
<div>
	<div class="info-details"><?php echo __l('When cron is not working, you may trigger it by clicking below link. For the processes that happen during a cron run, refer the ').$this->Html->link('product manual','http://dev1products.dev.agriya.com/doku.php?id=couponator-install#manual_cron_update_process', array('target'=>'_blank'));?></div>
	<div class="add-block1"><?php echo $this->Html->link(__l('Manually trigger cron to update coupon status, user rankings'), array('controller' => 'crons', 'action' => 'main', '?f=' . $this->request->url, 'admin' => false), array('title' => __l('You can use this to update various status. This will be used in the scenario where cron is not working.'), 'class' => 'js-confirm-msg')); ?></div>
	<div class="add-block1"><?php echo $this->Html->link(__l('Manually trigger cron to import coupons from affiliate sites'), array('controller' => 'crons', 'action' => 'affiliates', '?f=' . $this->request->url, 'admin' => false), array('title' => __l('You can use this to update various status. This will be used in the scenario where cron is not working.'), 'class' => 'js-confirm-msg')); ?></div>
</div>


<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="community-block-left grid_4 omega alpha">
	<?php if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'latest') { ?>
		<h3 class="top-list"><?php 	echo  __l('Top Contributors:'); ?></h3>
	<?php } elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'top') { ?>
		<h3 class="top-list"><?php echo  __l('Last') . ' ' . Configure::read('coupon.shared_days') . ' ' . __l('days:'); ?></h3>
	<?php } ?>
	<ol class="community-block-list">
		<?php
			if (!empty($users)):
				foreach ($users as $user):
		?>
		<li class="clearfix">
			<div class="community-block-img">
				<p><?php echo $this->Html->getUserAvatar($user['User']['id'], 'nano_medium_thumb'); ?></p>
			</div>
			<div class="community-block-value">
				<h3><?php echo $this->Html->link($this->Html->cText($user['User']['username']), array('controller' => 'users', 'action' => 'view', $user['User']['username']), array('title' => $user['User']['username'], 'escape' => false)); ?></h3>
				<p><?php echo $user['User']['coupon_points'] . ' ' . __l('points'); ?></p>
			</div>
		</li>
		<?php
				endforeach;
			else:
		?>
		<li>
			<p class="notice"><?php echo __l('No results found');?></p>
		</li>
		<?php
			endif;
		?>	 
	</ol>
</div>
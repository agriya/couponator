<div class="store-left">
	<div class="store-right">
		<div class="store-center clearfix">
		<h3><?php echo __l('Favorite Stores'); ?></h3>
			<ol class="list clearfix">
			<?php 	 
				if (!empty($stores)):
					$i = 0;
					foreach ($stores as $store):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow contain"';
						} else {
							$class = ' class="contain"';
						}
						$store_url = Router::url(array(
							'controller' => 'stores',
							'action' => 'view',
							$store['Store']['slug']
						) , true);
			?>
				<li><?php echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'),	$this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false)); ?><?php echo $this->Text->truncate($store['Store']['name'], 15, array('ending' => '...')); ?></li>
			<?php
					endforeach;
				else:
			?>
				<li class="notice notice-info"><p><?php echo __l('No Favorites Stores available');?></p></li>
			<?php
				endif;
			?>
			</ol>
		</div>
	</div>
</div>
<div class="coupon-bottom"></div>
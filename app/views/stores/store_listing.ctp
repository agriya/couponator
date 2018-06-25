<div class="view-discount-block coupon-codes-block">
	<div class="store-left">
		<div class="store-right">
			<h2><?php echo sprintf(__l('Top %s stores'), $tag_name); ?></h2>
			<div class="view-discount-inner offer-inner">
				<ul class="top-store-list clearfix">
					<?php 
						if (!empty($stores)) {
							$i=1;
							foreach ($stores AS $store) {
					?>
					<li>
						<?php echo $i . '. ' . $this->Html->link($this->Html->cText($store['Store']['name'], false), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?>
					</li>
					<?php
								$i++;
							}
						} else {
					?>
					<li class="notice-info notice"><p><?php echo __l('No Stores found');?></p></li>
					<?php
						}
					?>
				</ul>
			</div>
			<div class="coupon-bottom"></div>
		</div>
	</div>
</div>
<div class="tools-block">
	<div class="store-left">
		<div class="store-right">
			<div class="store-center coupon-center">
		<h3><?php echo __l('Power Tools'); ?></h3>
	
			<ul class="share-list clearfix">
				<li class="facebook"><a href="<?php echo Configure::read('facebook.site_facebook_url'); ?>" title="<?php echo __l('Facebook'); ?>" target="_blank"><?php echo __l('Facebook'); ?></a></li>
				<li class="twitter"><a href="<?php echo Configure::read('twitter.site_twitter_url'); ?>" title="<?php echo __l('Twitter'); ?>" target="_blank"><?php echo __l('Twitter'); ?></a></li>
				<li class="rss"><?php echo $this->Html->link(__l('RSS'), array_merge(array('controller'=>'coupons', 'action'=>'index', 'ext'=>'rss')), array('target' => '_blank','title'=>__l('RSS Feed'))); ?></li>
			</ul>
	
		<div class="goodies-block">
			<h4><?php echo __l('Links and Goodies'); ?></h4>
			<ul class="share-list1 clearfix">
				<li class="newsletter1 active"><?php  echo $this->Html->link(__l('Popular Coupons Newsletter'), array('controller'=> 'subscriptions', 'action'=> 'add'),array('title'=>'Popular Coupons Newsletter')); ?></li>
			</ul>
		</div>
	</div>
	</div>
	</div>
	<div class="tools-bottom"></div>
</div>
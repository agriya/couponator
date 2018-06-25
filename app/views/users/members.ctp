<div class="community-block clearfix">
	<div class="store-left">
		<div class="store-right">
			<div class="store-center coupon-center">
				<h2><?php echo __l('Welcome to the community'); ?></h2>
				<p class="share-feedback"> <?php echo $this->Html->link(__l('Tell us what to improve'), array('controller' => 'contacts', 'action' => 'add'), array('title' => __l('Tell us what to improve')), null, false) .(__l(" - share feedback and ideas for what we should be working on.")); ?></p>
				<p class="community"><?php echo __l("The ").Configure::read('site.name').__l(" Community is a place for like-minded bargain hunters to share and discuss the latest and greatest online shopping deals."); ?></p>
				<div class="clearfix">
					<?php  echo $this->element('user-shared', array('type'=>'latest','config' => 'sec', 'limit' =>10)); ?>	
					<?php  echo $this->element('user-shared', array('type'=>'top', 'config' => 'sec', 'limit' =>10)); ?>
				</div>
						           
			</div>
		</div>
	</div>
	<div class="coupon-bottom"></div>
</div>
	<?php  echo $this->element('latest-coupons', array('config' => 'sec', 'limit' =>10)); ?>
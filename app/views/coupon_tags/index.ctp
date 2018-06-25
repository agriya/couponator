<?php if (isset($this->request->params['named']['q'])): ?>
<div class="view-discount-block coupon-codes-block">
	<div class="store-left">
		<div class="store-right">
			<h3><?php echo __l('Related Coupon Categories');?></h3>
			<div class="view-discount-inner offer-inner">
				<ul class="discount-list clearfix">
<?php else: ?>
    <div class="tag-block">
	<h3><?php echo __l('Browse Coupons');?></h3>
	<div class="tag-inner">
		<?php
			$tag = '';
			if(!empty($this->request->params['named']['tag'])){
				echo $tag = $this->request->params['named']['tag'];
			}
			echo $this->Form->create('Coupon', array('class' => 'tag clearfix', 'action' => 'lst'));
		?>
		<div class="js-overlabel ">
			<?php echo $this->Form->input('tag', array('label' => __l('Find a Tag'))); ?>
		</div>
		<?php echo $this->Form->submit(__l('Search'));?>
		<?php echo $this->Form->end();?>
		<ul class="tag-link clearfix">
<?php endif; ?>
			<?php
				//1. Need to set the config variables for min, max tag class, no of tags
				//2. Need to give the links for tags
				//3. Need to add more link if necessary
				if (!empty($tag_arr)) {
					$min_tag_classes = 1;
					$max_tag_classes = 6;
					// set min max count
					$max_qty 	=	($tag_arr) ? max(array_values($tag_arr)) : 0;
					$min_qty 	= 	($tag_arr) ? min(array_values($tag_arr)) : 0;
					// Find spread range and  Set step size
					$spread 	=	$max_qty - $min_qty;
					$spread		=	(0 == $spread) ? 1 : $spread;
					$step		=	($max_tag_classes - $min_tag_classes) / ($spread);
					// Sort tag by name
					//ksort($tag_arr);
					// print tags clouds
					$i=1;
					foreach ($tag_arr AS $key => $value) {
						$size = ceil($min_tag_classes + (($value - $min_qty) * $step));
						if ($size>0) {
							$class='tag'.$size;
						} else {
							$class='';
						}
			?>
				<li class="<?php echo $class;?>"><?php echo $this->Html->link($tag_name_arr[$key].' ', array('controller'=> 'coupons', 'action' => 'lst', 'tag' => $key)); ?></li>
			<?php
						$i++;
						if ($i>$limit) {
							break;
						}
					}
				} else {
			?>
				<li class="tag3 notice"><p><?php echo __l('Sorry, no tags found');?></p></li>
			<?php
				}
			?>
		</ul>
	</div>
	<div class="coupon-bottom"></div>
<?php if (isset($this->request->params['named']['q'])): ?>
		</div>
	</div>
</div>
<?php else: ?>
</div>
<?php endif; ?>
<?php /* SVN: $Id: index.ctp 428 2009-11-24 14:42:35Z annamalai_034ac09 $ */ ?>
<div class="store-right">
	<h3 class="printable-coupon"><?php echo __l('Printable Coupon Categories');?></h3>
	<div class="view-discount-inner offer-inner">
		<?php if (!empty($categories)): ?>
			<ul class="discount-list clearfix">
				<?php foreach ($categories as $category): ?> 
					<li><?php echo $this->Html->link($this->Html->cText($category['Category']['title'], false), array('controller' => 'coupons', 'action' => 'index', 'category' => $category['Category']['slug']), array('title' => $this->Html->cText($category['Category']['title'], false), 'escape' => false)); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p class="notice"><?php echo __l('No categories available.'); ?></p>
		<?php endif; ?>
	</div>
	<div class="coupon-bottom"></div>
</div>
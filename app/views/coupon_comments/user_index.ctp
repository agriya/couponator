<?php /* SVN: $Id: index.ctp 906 2009-12-04 12:15:17Z annamalai_034ac09 $ */ ?>
<div class="couponComments index inner">
	<h3><?php echo __l('Latest comments made:');?></h3> 
	<ol class="activities-list comments-list clearfix js-responses" start="<?php echo $this->Paginator->counter(array('format' => '%start%'));?>">
		<?php
			if (!empty($couponComments)):
				$i = 0;
				foreach ($couponComments as $couponComment): 
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
		?>
		<li>
			<h3><?php echo $this->Html->link($this->Html->cText($couponComment['Coupon']['Store']['name']), array('controller'=> 'stores', 'action' => 'view', $couponComment['Coupon']['Store']['slug']), array('escape' => false));?></h3>
			<p><?php echo nl2br($this->Html->cText($couponComment['CouponComment']['comment'])); ?></p>
			<p class="activities-info"><?php  echo $this->Time->timeAgoInWords($couponComment['CouponComment']['created']); ?></p>
		</li>
		<?php
				endforeach;
			else:
		?>
		<li class="notice"><?php echo __l('No Coupon Comments available');?></li>
		<?php
			endif;
		?>
	</ol>
	<?php
		if (!empty($couponComments)) {
			echo $this->element('paging_links');
		}
	?>
</div>
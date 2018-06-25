<?php /* SVN: $Id: index.ctp 906 2009-12-04 12:15:17Z annamalai_034ac09 $ */ ?>
<div class="couponComments index">
	<h2><?php echo __l('Coupon Comments');?></h2>
	<?php echo $this->element('paging_counter');?>
	<ol class="list clearfix comments js-responses" start="<?php echo $this->Paginator->counter(array('format' => '%start%'));?>">
		<?php
			if (!empty($couponComments)):
				$i = 0;
				foreach ($couponComments as $couponComment):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
		?>
		<li<?php echo $class;?>>
			<p>
				<div class="avatar">
					<?php echo $this->Html->link($this->Html->showImage('UserAvatar', $couponComment['User']['UserAvatar'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($couponComment['User']['username'], false)), 'title' => $this->Html->cText($couponComment['User']['username'], false))), array('controller' => 'users', 'action' => 'view', $couponComment['User']['username']), array('escape' => false));?>
				</div>
				<?php echo $this->Html->link($this->Html->cText($couponComment['User']['username']), array('controller'=> 'users', 'action' => 'view', $couponComment['User']['username']), array('escape' => false));?>
			</p>
			<p><?php echo nl2br($this->Html->cText($couponComment['CouponComment']['comment'])); ?></p>
			<?php if ($couponComment['CouponComment']['user_id'] == $this->Auth->user('id')) : ?>
				<div class="actions"><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $couponComment['CouponComment']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
			<?php endif; ?>
		</li>
		<?php
				endforeach;
			else:
		?>
		<li>
			<p class="notice"><?php echo __l('No Coupon Comments available');?></p>
		</li>
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
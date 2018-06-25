<li class="comment" id="comment-<?php echo $couponComment['CouponComment']['id']?>">

	<div>
	
		<div class="avatar">
        			<?php echo $this->Html->link($this->Html->showImage('UserAvatar', $couponComment['User']['UserAvatar'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($couponComment['User']['username'], false)), 'title' => $this->Html->cText($couponComment['User']['username'], false))), array('controller' => 'users', 'action' => 'view', $couponComment['User']['username']), array('escape' => false));?>
        		</div>
		
		<?php echo $this->Html->link($this->Html->cText($couponComment['User']['username']), array('controller'=> 'users', 'action' => 'view', $couponComment['User']['username']), array('escape' => false));?></p>
	     <?php echo __l('said');?>
		<blockquote>
			<p><?php echo $this->Html->cText($couponComment['CouponComment']['comment']);?></p>
		</blockquote>
		<p class="meta"><?php echo sprintf(__l('posted %s'), $this->Html->cDateTimeHighlight($couponComment['CouponComment']['created'])); ?></p>
		   <?php if ($couponComment['CouponComment']['user_id'] == $this->Auth->user('id')) : ?>
		<div class="actions"><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $couponComment['CouponComment']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
		<?php
endif;
?>

	</div>
</li>
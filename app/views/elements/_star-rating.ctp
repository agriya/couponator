<?php
$current_rating_percentage = $current_rating*20;
?>
<ul class="">
<?php
	if ($canRate) :
?>
	<li><?php echo $this->Html->link('Yes', array('controller' => 'coupon_ratings', 'action' => 'add',$coupon_slug, 'Up'), array('class' => 'js-rating', 'title' => __l('Yes')))?></li>
    <li><?php echo $this->Html->link('No', array('controller' => 'coupon_ratings', 'action' => 'add',$coupon_slug, 'Down'), array('class' => 'js-rating', 'title' => __l('No')))?></li>
<?php     endif; ?>
</ul>
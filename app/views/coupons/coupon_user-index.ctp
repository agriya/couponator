<?php /* SVN: $Id: index.ctp 4992 2010-03-04 02:23:37Z thulasi_103ac09 $ */ ?> 
<?php if (!$isAjax): ?>
<div class="js-response">
<?php endif; ?>
<h3>
<?php 
if(!empty($this->request->params['named']['vote'])){
if($this->request->params['named']['vote']=='up'){
	echo __l("Latest coupons used:"); 
}elseif($this->request->params['named']['vote']=='down' && !Configure::read('coupon.is_downvote_restrict')){
	echo __l("Latest coupons down-voted:"); 
}
}elseif(!empty($this->request->params['named']['type'])){
	echo __l("Latest Contributions:"); 	
}else{
	echo __l("Latest coupons submitted:"); 
}
?></h3>
<?php if(!empty($this->request->params['named']['vote']) && ($this->request->params['named']['vote']=='down') && (Configure::read('coupon.is_downvote_restrict')==1)):?>

<?php else:
?>
<ol class="activities-list">
<?php 
	if (!empty($coupons)):
	$i = 0;
	foreach ($coupons as $coupon):?>
	<li>
    	<h3>
        	<?php echo $this->Html->link($this->Text->truncate($coupon['Coupon']['description'], 200, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false)); ?>
    	</h3>
        	<p class="activities-info"><?php echo $this->Html->link($this->Text->truncate($coupon['Store']['name'], 30, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false)).' '.$this->Time->timeAgoInWords($coupon['Coupon']['created']);
    	?>
    	</p>
	</li>
	<?php
	endforeach;
	else:
	?>
	<li class="notice">
	 <?php
		if (!empty($this->request->params['named']['vote'])) {
			if ($this->request->params['named']['vote']=='up') {
				echo __l('No coupons used (don\'t forget to click on the tick when you have used a coupon successfully)'); 
			} elseif($this->request->params['named']['vote']=='down') {
				echo __l('No latest coupons voted'); 
			}
		} elseif (!empty($this->request->params['named']['type'])) {
			echo __l('No latest Contributions:');
		} else {
			echo __l('No coupons shared :('); 
		}
	?>
	</li>
<?php endif; ?>
</ol>
<?php
endif;
if (!empty($coupons)) {
echo $this->element('paging_links');
}
?> 
<?php if (!$isAjax): ?>
</div>
<?php endif; ?>
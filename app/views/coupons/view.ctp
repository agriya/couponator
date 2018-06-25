<?php /* SVN: $Id: view.ctp 19355 2011-01-18 08:09:18Z suresh_116act10 $ */ ?>
<div class="coupons view ">
<h2><?php echo $this->Html->cText($coupon['Coupon']['title']) ;?></h2>
	<dl class="list clearfix"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Store');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($coupon['Store']['name']), array('controller' => 'coupons', 'action' => 'index','store'=> $coupon['Store']['slug']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Category');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($coupon['Category']['title']), array('controller' => 'coupons', 'action' => 'index', 'category' => $coupon['Category']['slug']), array('escape' => false));?></dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('URL');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($coupon['Coupon']['url']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Coupon Code');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($coupon['Coupon']['coupon_code']);?></dd>
	    <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Discount Amount');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cFloat($coupon['Coupon']['discount']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Expiry Date');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cDate($coupon['Coupon']['expiry_date']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Coupon View');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($coupon['Coupon']['coupon_view_count']);?></dd>
	  
	   </dl>

	 <?php
	 if($this->Auth->sessionValid()):
	 if(!empty($coupon['CouponFavorite']) && $this->Auth->user('id') == $coupon['CouponFavorite'][0]['user_id']): ?>
		<h4>
		<?php 
		echo $this->Html->link(__l('Remove from favorites'),array('controller'=> 'coupon_favorites', 'action' => 'delete',$coupon['CouponFavorite'][0]['id'],'coupon_slug'=>$coupon['Coupon']['slug']), array('title'=>__l('Remove from favorites'),'escape' => false,'class'=>'js-ajax-submission removed_class {added_text:"Remove from favorites",removed_text:"Add to favorites", added_class:"added_class", removed_class:"removed_class"}'));?>		 
		</h4>
		<?php else: ?>
		<h4>
			<?php echo $this->Html->link(__l('Add to favorites'),array('controller'=> 'coupon_favorites', 'action' => 'add',$coupon['Coupon']['id']), array('title'=>__l('Add to favorites'),'escape' => false,'class'=>'js-ajax-submission added_class {added_text:"Remove from favorites",removed_text:"Add to favorites", added_class:"added_class", removed_class:"removed_class"}'));?>
		</h4>
	<?php endif; ?>	
	<?php endif; ?>	
		<h4><?php 
		echo $this->Html->link(__l('Send coupon to my mobile'), array('controller' =>'coupon_sms' ,'action' => 'add','coupon' =>$coupon['Coupon']['id']),array('title' => __l('Send coupon to my mobile'),'class'=>'js-thickbox'));
		?>
		</h4>

		<?php	if(empty($coupon['Coupon']['admin_suspend'])):
					// Twitter
					$tw_url = Router::url(array('controller' => 'coupons', 'action' => 'view', $coupon['Coupon']['slug']), true);
					$tw_url = urlencode_rfc3986($tw_url);
					$tw_message = __l('It Will'). ' '.$coupon['Coupon']['title'].' '.__l('for').' '.$number->currency($coupon['Coupon']['discount'], 'USD');
					//$tw_message = urlencode_rfc3986($tw_message);
					// Facebook
					$fb_status = Router::url(array('controller' => 'coupons', 'action' => 'view', $coupon['Coupon']['slug']), true);
					$fb_status = urlencode_rfc3986($fb_status);

				?>
        	    <ul class="share-list share-list1">
					<li class="email"><?php echo $this->Html->link(__l('email'), 'mailto:?subject='.__l('Cool! I found someone that will ').$coupon['Coupon']['title'].__l(' for '). $number->currency($coupon['Coupon']['discount'], 'USD').'&amp;body='.__l('Hi, Check it out: ').Router::url(array('controller' => 'coupons', 'action' => 'view', $coupon['Coupon']['slug']), true), array('target' => 'blank', 'title' => __l('mail'), 'class' => 'quick'));?></li>
					<li class="facebook"><fb:like href="<?php echo $fb_status;?>" layout="button_count" width="50" height="40" action="like"></fb:like></li>
					<li class="twitter"><a href="http://twitter.com/share?url=<?php echo $tw_url;?>&amp;text=<?php echo $tw_message;?>&amp;via=<?php echo Configure::read('twitter.site_username');?>&amp;lang=en" class="twitter-share-button"><?php echo __l('Tweet!');?></a></li>					
				</ul>
				<div class="share-link">
					<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4be1665734d1eaab"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4be1665734d1eaab"></script>
				</div>
				<?php endif;?>
			


	<?php echo __l('Did this coupon work?');?> :
	<div class="js-rating-display">
                    <?php
                	$average_rating = (!empty($coupon['Coupon']['coupon_rating_count'])) ? ($coupon['Coupon']['total_ratings']/$coupon['Coupon']['coupon_rating_count']) : 0;
                    echo $this->element('_star-rating', array(
                        'coupon_slug' => $coupon['Coupon']['slug'],
                        'current_rating' => $average_rating,
                        'canRate' => ($coupon['Coupon']['id'] != $this->Auth->user('id')) ? 1 : 0
                    ));
                    ?>
                </div>
            
	<div class ="js-block">
	<?php  echo $this->element('coupon_comments-index', array('config' => 'sec', 'key' => $coupon['Coupon']['id'])); ?>	
	<?php if($this->Auth->sessionValid() ):
	echo $this->element('../coupon_comments/add', array('config' => 'sec', 'key' => $coupon['Coupon']['id']));
	else:?>
	<p class="notice"><?php echo sprintf(__l('Please %s to post comment'), $this->Html->link(__l('login'), array('controller' => 'users', 'action' => 'login', '?' => 'f=coupon/' . $coupon['Coupon']['slug']), array('title' => 'login'))) ;?></p>
	<?php endif; ?>
</div>
	<span class="js-tell-us"><?php echo $this->Html->link(__l('Tell a friend'), array('controller' =>'coupons' ,'action' => 'send_to_friend',$coupon['Coupon']['slug']),array('class'=>'js-tell-us-friends'));?></span> 
</div>


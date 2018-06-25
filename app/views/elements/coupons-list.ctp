<h4><?php  echo $this->Html->link($this->Text->truncate($coupon['Coupon']['title'], 15, array('ending' => '...')), array('controller'=> 'coupons', 'action' => 'view', $coupon['Coupon']['slug'],'admin'=>false), array('escape' => false)); ?></h4>
            <?php  $coupsale_price =  $coupon['Coupon']['sale_price'];?>
            <p class="desc"><?php echo __l('Price: ').$number->currency($coupsale_price, 'USD');?>
			<?php echo __l('Code: '). $this->Html->cText($coupon['Coupon']['coupon_code']);?></p>
            <div class="more">
              <h4><?php 
	echo $this->Html->link($this->Text->truncate($coupon['Coupon']['title'], 30, array('ending' => '...')), array('controller'=> 'coupons', 'action' => 'view', $coupon['Coupon']['slug'],'admin'=>false), array('escape' => false));		  
 ?> </h4> <?php $url = Router::url(array('controller'=> 'coupons', 'action' => 'view', $coupon['Coupon']['slug']),true);	 ?>
 			  <div id="js-d_clip_container-<?php echo $coupon['Coupon']['id'];?>" style="position:relative" >
                <div id="js-multiple-<?php echo $coupon['Coupon']['id'];?>" class="copy {'copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $url;?>'}">copy &amp; open site</div>
               </div>
            <div class="js-copyclip" id="js-copyclip1-<?php echo $coupon['Coupon']['coupon_code'];?>"><span ></span></div>
              <p><?php echo nl2br($this->Html->cText($this->Html->truncate($coupon['Coupon']['description'], 50))); ?></p>
              <p><?php echo __l('more on '); ?> <?php echo $this->Html->link($this->Html->cText($coupon['Store']['name']), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));?> <?php echo __l('coupons'); ?>&raquo;</p>  
			  <?php if(Configure::read('coupon.is_coupon_share_enabled')): ?>
			  	<?php $tw_url = Router::url(array('controller' => 'coupons', 'action' => 'view', $coupon['Coupon']['slug']), true);
						$tw_url = urlencode_rfc3986($tw_url);
						$tw_message = __l('It Will'). ' '.$coupon['Coupon']['title'].' '.__l('for').' '.$number->currency($coupsale_price, 'USD');
						//$tw_message = urlencode_rfc3986($tw_message);
						// Facebook
						$fb_status = Router::url(array('controller' => 'coupons', 'action' => 'view', $coupon['Coupon']['slug']), true);
						$fb_status = urlencode_rfc3986($fb_status);

						?>
				<p class="email"><?php echo $this->Html->link(__l('email'), 'mailto:?subject='.__l('Cool! I found someone that will ').$coupon['Coupon']['title'].' '.__l('for').' '.$number->currency($coupsale_price, 'USD').'&amp;body='.__l('Hi, Check it out').':'.' '. Router::url(array('controller' => 'coupons', 'action' => 'view', $coupon['Coupon']['slug']), true), array('target' => 'blank', 'title' => __l('mail'), 'class' => 'quick'));?></p>
					
			   <p class="twitter-block"><a href="http://twitter.com/share?url=<?php echo $tw_url;?>&amp;text=<?php echo $tw_message;?>&amp;via=<?php echo Configure::read('twitter.site_username');?>&amp;lang=en&amp;" class="twitter-share-button"><?php echo __l('Tweet!');?></a></p>
				<p class="facebook"><fb:like href="<?php echo $fb_status;?>" layout="button_count" width="50" height="40" action="like"></fb:like></p>
			<?php endif; ?>
</div>
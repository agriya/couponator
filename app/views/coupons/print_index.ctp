<?php 
if(empty($this->request->params['named']['category']) &&  empty($this->request->params['named']['view_map']) && (!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] =='print') || (!empty($this->request->params['named']['where']) && !empty($this->request->params['named']['view_map'])) || (!empty($this->request->params['named']['where']) && empty($this->request->params['named']['view_map']) || !empty($this->request->params['named']['what'])  && empty($this->request->params['named']['view_map'])  )): ?>
 <div class="coupon-codes-block">
        <div class="store-left">
          <div class="store-right">
            <div class="codes-inner1">
              <h2 class="find-coupon"><?php echo __l('Find Local Printable Coupons'); ?></h2>
              <div class="code-discount clearfix">
                <div class="code-info clearfix">
						 <div id="map"></div>
                 <?php echo __l('Zoom in and pan around to see the individual coupons in your area.'); ?> </div>         
              </div>
            </div>
          </div>
        </div>
        <div class="coupon-bottom"></div>
      </div>
<?php endif; ?>      
      <div class="national-coupons-block">
        <div class="store-left">
          <div class="store-right">
            <div class="store-center coupon-center1 coupon-center">
		  <?php if(!empty($this->request->params['named']['what'])): ?>
            <h2><?php echo __l('National ').$this->request->params['named']['what'].(' Printable Coupons'); ?> </h2>
		  <?php elseif(!empty($this->request->params['named']['where'])): ?>
            <h2><?php echo __l('Local ').$this->request->params['named']['where'].(' Printable Coupons'); ?> </h2>
			<?php elseif(empty($this->request->params['named']['category'])): ?>
            <h2><?php echo __l('Top National Printable Coupons'); ?> </h2>
			<?php else: ?>
			<h2><?php echo __l('Printable ').$this->request->params['named']['category'].(' Coupons'); ?> </h2>
			<?php endif; ?>
          
              <ol class="grade-list">
			<?php  if (!empty($coupons)):
				$i = 0;
				foreach ($coupons as $coupon):
					$class = null;
					if ($i++ % 2 == 0) { 
						$class = ' class="altrow"';
					}
					$tracking_url=Router::url(array('controller'=> 'coupons', 'action' => 'out', $coupon['Coupon']['id']),true);
			?>  
                <li id="contain-print-<?php echo $coupon['Coupon']['id']; ?>" class="printableCoupon coupon contain-print contain-print-<?php echo $coupon['Coupon']['id']; ?> {'id':'<?php echo $coupon['Coupon']['id']; ?>'} ">
                  <div class="grade-info-block clearfix">
                     <div class="coupons-block-detail grid_6 omega alpha ">
                      <h3><?php echo $this->Html->link($coupon['Coupon']['description'], array('controller'=> 'coupons', 'action' => 'out', $coupon['Coupon']['id'],'admin'=>false), array('escape' => false));	?>	  </h3>

                      <?php echo $this->Html->link($coupon['Store']['name'], array('controller'=> 'coupons', 'action' => 'index', 'store'=>$coupon['Store']['slug'],'admin'=>false), array('escape' => false));	?>	 
                      </div>
                    <div class="coupons-user-block grid_right">
                   <?php
					if(!empty($coupon['Coupon']['image_url'])):  ?>
						 <img src='<?php echo $coupon['Coupon']['image_url'] ;?>' width='102' height='72' alt='<?php echo $coupon['Coupon']['title']; ?>'  />			
				<?php  else:
						echo $this->Html->link($this->Html->showImage('Store', $coupon['Store']['Attachment'], array('dimension' => 'print_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($coupon['Coupon']['title'], false)), 'title' => $this->Html->cText($coupon['Coupon']['title'], false))), array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug']), array('escape' => false));
		   
					endif; 
				?>
                 </div>
                  </div>
                  <div class="comment-block clearfix">
                    <ul class="commentActions clearfix">
                      <li class="no-date"><?php echo  __l('Shared') . ' ' . $this->Time->timeAgoInWords($coupon['Coupon']['created']); ?> </a></li>
                    <?php											 
									if(!empty($coupon['CouponComment'])):	?>
									<li class=" comment toggleComments"><a href='#'> <?php echo  count($coupon['CouponComment']).__l(" comments"); ?> </a></li>
									<?php else:									?>									 
									<li class=" comment"><?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add','coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?>		</li>
									<?php endif; ?>
									<li class="writeComment">
									<?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add', 'coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?>									
									 </li>
									 <li class="closeComments"><a href="#"><?php echo __l('Close comments'); ?></a></li>
									 <li class="flag"><?php echo $this->Html->link(__l('Flag this coupon'),array('controller' => 'coupon_flags', 'action' => 'add', $coupon['Coupon']['id']), array('class' => 'js-thickbox'));?></li>
                    </ul>
                  </div>
						<?php
			if(!empty($coupon['CouponComment'])):?>
		<div class="comments" style="display: none;">
		<?php foreach ($coupon['CouponComment'] as $comments): ?>
			<div>
				<?php
					$comments['User']['UserAvatar'] = !empty($comments['User']['UserAvatar']) ? $comments['User']['UserAvatar'] : array();
					echo $this->Html->link($this->Html->showImage('UserAvatar', $comments['User']['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($comments['User']['username'], false)), 'title' => $this->Html->cText($comments['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $comments['User']['username'], 'admin' => false), array('escape' => false));
				?>
				<p><?php echo $comments['comment'];	?>
				</p>
 
				<p class="attribution"><?php echo  $comments['User']['username'].__l("posted this "). $this->Time->timeAgoInWords($comments['created']); ?></p>
			</div>
		<?php endforeach; ?>
		</div>
		<?php
		endif; ?>
                </li>

              
      <?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Coupons available');?></p>
	</li>
<?php
endif;
?>
              </ol>
            </div>

          </div>
        </div>
        <div class="coupon-bottom"></div>
      </div>


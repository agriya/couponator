<?php /* SVN: $Id: index.ctp 4992 2010-03-04 02:23:37Z thulasi_103ac09 $ */ ?>
<?php 
	if (!empty($coupons)):
		if($is_ajax && isset($this->request->params['named']['coupon_id'])):
			$str = $coupons[0]['Store']['address']. ',';
			if(!empty($coupons[0]['City']['name'])){
				$str .= $coupons[0]['City']['name'].',';
			}
			if(!empty($coupons[0]['State']['name'])){
				$str .= $coupons[0]['State']['name'].',';
			}
			if(!empty($coupons[0]['Country']['name'])){
				$str .= $coupons[0]['Country']['name'].',';
			}
			$str .= $coupons[0]['Store']['zipcode'];
?>
<div class="maptimize_popup maptimize_info_window">
	<div style="overflow: auto;">
		<div id="couponMapBubbleContainer">
			<div class="couponMapBubble">
				<div class="bubbleMerchantName"><?php echo $coupons[0]['Store']['name']; ?></div>
				<div class="bubbleMerchantAddress"><?php echo $str;  ?></div>
				<?php
					foreach ($coupons as $coupon):
					$url = Router::url(array(
						'controller' => 'stores',
						'action' => 'view',
						$coupon['Store']['slug']
					) , true);
				?>
				<div class="bubbleDescription"><?php echo $this->Html->cText($coupon['Store']['name'], false); ?> only <?php echo $this->Html->cFloat($coupon['Coupon']['discount'], false); ?> %</div>
				<div class="bubbleLink"><a target="_blank" href="<?php echo  $url; ?>">View coupons</a></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php 
		else:
?>
<div class="responses js-response js-responses">
	<?php if(!empty($this->request->params['named']['view']) && $this->request->params['named']['view']=='print'): ?>
		<div id="map-container">
			<div id="map"></div>
		</div>
	<?php endif; ?>
	<div class="coupons index">
		<h2>
			<?php  
				if (!empty($this->request->params['named']['coupon_type'])) {
					if ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::SpecialOffer) {
						echo __l('Special Offers');
					} elseif($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Unreliable) {
						echo __l('Unreliable Coupons ');
					} elseif($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Normalcoupon) {
						echo __l('Active Coupons');
					} else {
						echo __l('Coupons');
					}
				} elseif(!empty($this->request->params['named']['type']) && $this->request->params['named']['type']=='home') {
					echo __l('Top Coupons');
				}
			?>
		</h2>
		<?php 
			if (!empty($coupons)):
				$i = 0;
				foreach ($coupons as $coupon):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' altrow contain contain-'.$coupon['Coupon']['id'];
					} else {
						$class = '  contain contain-'.$coupon['Coupon']['id'];
					}
					if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips) {
						$coupon_status= 'tip';
					} elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables) {
						$coupon_status= 'printable';
					} else {
						$coupon_status= '';
					}
					$store_url = Router::url(array(
						'controller' => 'stores',
						'action' => 'view',
						$coupon['Store']['slug']
					) , true);
					$stats = 0;
					if (!empty($coupon['Coupon']['coupon_impression_count']) && !empty($coupon['Coupon']['coupon_worked_count'])) {
						$stats = $coupon['Coupon']['coupon_worked_count']*100/$coupon['Coupon']['coupon_impression_count'];
					}
					if ($stats>60) {
						$status='good';
					} else if($stats<=60 && $stats >=40) {
						$status='average';
					} else if($stats<=39 && $stats >0) {
						$status='bad';
					} else {
						$status='new';
					}
		?>
    <div id="contain-print-<?php echo $coupon['Coupon']['id']; ?>" class=" contain-print-<?php echo $coupon['Coupon']['id']; ?> coupon <?php echo $coupon_status; ?> {'id':'<?php echo $coupon['Coupon']['id'];?>'} <?php echo $class;?> ">
      <div class="inner">
        <div class="stats <?php echo $status; ?>">
          <?php if($stats==0) { ?>
          New!
          <?php } else { ?>
          <em><?php echo $stats;?>%</em> <?php echo __l('Success'); ?>
          <?php } ?>
          <br/>
        </div>
        <?php $url = Router::url(array('controller'=> 'coupons', 'action' => 'track', 'user_id'=> $this->Auth->user('id'),'store_id' =>$coupon['Coupon']['store_id'],'coupon_id'=>$coupon['Coupon']['id']),true);	 ?>
        <div class="detail">
          <?php if(Configure::read('displaysettings.coupon_display') == ConstCouponDisplayTypes::ClickToCopy){ ?>
          <div class="crux" style="position:relative"  id="js-d_clip_container-<?php echo $coupon['Coupon']['id'];?>">
            <?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips){ ?>
            <span>Shopping Tips:</span>
            <?php } elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables){ ?>
            <span>Printable coupon:</span>
            <?php } else{ ?>
            <span>coupon code:</span>
            <?php } ?>
            <?php if(!empty($coupon['Coupon']['coupon_code'])){ ?>
            <strong id="js-multiple-<?php echo $coupon['Coupon']['id'];?>" class="copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];?>','track_url':'<?php echo $url;?>'}" class="" style="background-color: rgb(253, 237, 180); border-color: rgb(254, 191, 2);"><?php echo $coupon['Coupon']['coupon_code'];?></strong>
            <?php } else { ?>
            <div class="cou-code"> <a class="code-a  copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo  $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];?>','track_url':'<?php echo $url;?>'}" rel="nofollow" target="_blank" href="#">
              <?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips){ ?>
              <?php echo __l('Visit Store'); ?>
              <?php } elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables){ ?>
              <?php echo __l('Print coupon'); ?>
              <?php } else{ ?>
              <?php echo !empty($coupon['Coupon']['coupon_code'])?$coupon['Coupon']['coupon_code']:__l('Click to redeem');?>
              <?php } ?>
              </a></div>
            <?php } ?>
          </div>
          <div class="js-copyclip" id="js-copyclip1-<?php echo $store['Coupon'][0]['id'];?>"><span ></span></div>
          <?php } elseif(Configure::read('displaysettings.coupon_display') == ConstCouponDisplayTypes::ClickToReveal) {?>
          <div class="crux cou-code  code-cover-block code-reveal" ><a class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];?>','track_url':'<?php echo $url;?>'}" rel="nofollow" target="_blank" href="#">
            <?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips){ ?>
            <?php echo __l('Visit Store'); ?>
            <?php } elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables){ ?>
            <?php echo __l('Print coupon'); ?>
            <?php } else{ ?>
            <?php echo !empty($coupon['Coupon']['coupon_code'])?$coupon['Coupon']['coupon_code']:__l('Click to redeem');?>
            <?php } ?>
            </a> <a class="code-cover" href="#"> </a></div>
          <?php } ?>
          <p> <?php echo nl2br($this->Html->cText($coupon['Coupon']['title'])); ?></p>
        </div>
        <p>Did this coupon work for you?</p>
        <button class="yesVote ysvote-<?php echo $coupon['Coupon']['id'];?> {'id':'<?php echo $coupon['Coupon']['id'];?>','description':'<?php echo $coupon['Coupon']['description'];?>','url':'<?php echo $store_url;?>'}"><span>Yes</span></button>
        <button class="noVote {'id':'<?php echo $coupon['Coupon']['id'];?>'}"><span>No</span></button>
        <div class="break"></div>
        <?php


			if(empty($this->request->params['named']['type'])): ?>
        <div class="collateral">
          <ul class="commentActions">
            <?php
									if(!empty($coupon['CouponComment'])):	?>
            <li class="toggleComments"><a href='#'> <?php echo  count($coupon['CouponComment']).__l(" comments"); ?> </a></li>
            <?php else:									?>
            <li><?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add','coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?> </li>
            <?php endif; ?>
            <li class="addasfavorites">
              <?php if(!empty($coupon['CouponFavorite']) && $this->Auth->user('id') == $coupon['CouponFavorite'][0]['user_id']): ?>
              <?php
						echo $this->Html->link(__l('Remove favorites'),array('controller'=> 'coupon_favorites', 'action' => 'delete',$coupon['CouponFavorite'][0]['id'],'coupon_slug'=>$coupon['Coupon']['slug']), array('title'=>__l('Remove favorites'),'escape' => false,'class'=>'js-ajax-submission removed_class {added_text:"Remove favorites",removed_text:"Add to favorites", added_class:"added_class", removed_class:"removed_class"}'));?>
              <?php else: ?>
              <?php
						echo $this->Html->link(__l('Add to favorites'),array('controller'=> 'coupon_favorites', 'action' => 'add',$coupon['Coupon']['id']), array('title'=>__l('Add to favorites'),'escape' => false,'class'=>'js-ajax-submission added_class {added_text:"Remove favorites",removed_text:"Add to favorites", added_class:"added_class", removed_class:"removed_class"}'));?>
              <?php endif; ?>
            </li>
            <li class="closeComments"><a href="#"><?php echo __l('Close comments'); ?></a></li>
            <li class="writeComment"> <?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add', 'coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?> </li>
			<li class="flag"><?php echo $this->Html->link(__l('Flag this coupon'),array('controller' => 'coupon_flags', 'action' => 'add', $coupon['Coupon']['id']), array('class' => 'js-thickbox'));?></li>
          </ul>
          <div class="meta"><?php echo  __l('Shared') . ' ' . $this->Time->timeAgoInWords($coupon['Coupon']['created']); ?> </div>
        </div>
        <?php
			if(!empty($coupon['CouponComment'])):?>
		<ol class="comments clearfix " style="display: none;">
          <?php foreach ($coupon['CouponComment'] as $comments): ?>
          <li>
		  <div class="avatar"><?php
				$comments['User']['UserAvatar'] = !empty($comments['User']['UserAvatar']) ? $comments['User']['UserAvatar'] : array();
				echo $this->Html->link($this->Html->showImage('UserAvatar', $comments['User']['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($comments['User']['username'], false)), 'title' => $this->Html->cText($comments['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $comments['User']['username'], 'admin' => false), array('escape' => false));
		  ?></div>
            <p>
              <?php	echo $comments['comment'];	?>
            </p>
            <p class="attribution"><?php echo  $comments['User']['username'].__l("posted this "). $this->Time->timeAgoInWords($comments['created']); ?></p>
          </li>
          <?php endforeach; ?>
		  </ol>
        
        <?php
		endif; endif;?>
      </div>
    </div>
    <?php
    endforeach;
else:
?>
    <?php
endif;
?>
    <?php if(empty($this->request->params['named']['type'])): ?>
    <?php  
if (!empty($coupons) && count($coupons) > 10) {
    echo $this->element('paging_links');
}
?>
    <?php
endif;
?>
  </div>
</div>
<?php endif; ?>
<?php endif; ?>
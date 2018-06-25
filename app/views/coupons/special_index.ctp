<?php /* SVN: $Id: index.ctp 4992 2010-03-04 02:23:37Z thulasi_103ac09 $ */ ?>
<?php if (!empty($coupons)):?>
<?php if($is_ajax && isset($this->request->params['named']['coupon_id'])): ?>
<style>
.maptimize_info_window {
float:left;
height:125px;
overflow:auto;
padding:5px;
position:relative;
width:258px;
}

div.couponMapBubble div.bubbleDescription {
border:1px dashed #E0DFDC;
color:#302E2A;
font-family:Arial,Helvetica,sans-serif;
font-size:14px;
line-height:125%;
margin:0.5em 0;
padding:0.25em 0.5em;
}

div.couponMapBubble div.bubbleLink {
text-align:right;
}

div.couponMapBubble div.bubbleLink a {
color:#EF540A;
}

div#couponMapBubbleContainer {
height:192px;
overflow:auto;
}
</style>
<?php
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
<div class="maptimize_popup maptimize_info_window"><div style="overflow: auto;"><div id="couponMapBubbleContainer"><div class="couponMapBubble"><div class="bubbleMerchantName"><?php echo $coupons[0]['Store']['name']; ?></div><div class="bubbleMerchantAddress"><?php echo $str;  ?></div>
<?php foreach ($coupons as $coupon):

 $url =Router::url(array(
                'controller' => 'stores',
                'action' => 'view',
                $coupon['Store']['slug']
            ) , true)
?>
<div class="bubbleDescription"><?php echo $this->Html->cText($coupon['Store']['name'], false); ?> only <?php echo $this->Html->cFloat($coupon['Coupon']['discount'], false); ?> %</div>
<div class="bubbleLink"><a target="_blank" href="<?php echo  $url; ?>">View coupons</a></div>
<?php endforeach; ?>

</div></div></div></div>


<?php else: ?>
<div class="responses js-response js-responses">
<?php if(!empty($this->request->params['named']['view']) && $this->request->params['named']['view']=='print'): ?>
    <div id="map-container">
      <div id="map"></div>

    </div>
<?php endif; ?>
 
<div class="coupons index">
<h2>
<?php  
if(!empty($this->request->params['named']['coupon_type'])){
	if($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::SpecialOffer){
		echo __l('Current Special Offers');
	}elseif($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Unreliable){
			echo __l('Unreliable Coupons ');
	}elseif($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Normalcoupon){
		echo __l('Active Coupons');
	}else{
		echo __l('Coupons');
	}
}elseif(!empty($this->request->params['named']['type']) && $this->request->params['named']['type']=='home'){
	echo __l('Top Coupons');
}
?>

</h2>
<?php if(empty($this->request->params['named']['type'])): ?>
 <?php echo $this->element('paging_counter');?>
 <?php endif; ?>
<ol class="list" start="<?php echo $this->Paginator->counter(array(
    'format' => '%start%'
));?>">
<?php 
if (!empty($coupons)):
$i = 0;
foreach ($coupons as $coupon):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow contain contain-'.$coupon['Coupon']['id'].'"';
	}
	else
	{
		$class = ' class=" contain contain-'.$coupon['Coupon']['id'].'"';
	}

	$store_url =Router::url(array(
                'controller' => 'stores',
                'action' => 'view',
                $coupon['Store']['slug']
            ) , true);
 
?>   
	<li<?php echo $class;?>>
	<div class="clearfix top-content">
	<?php if(!empty($this->request->params['named']['type'])): ?>
           <div>
		   <?php
					echo $this->Html->link($this->Html->showImage('Store', $coupon['Store']['Attachment'] array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'),	$this->Html->cText($coupon['Store']['name'], false)), 'title' => $this->Html->cText($coupon['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug']), array('escape' => false));		   
		   ?>		   
		   </div>
		<?php    else: ?>
		   <div class="stats new"><?php echo __l('New!'); ?></div>
		   <?php endif; ?>
            <h4><?php  echo $this->Html->link($this->Text->truncate($coupon['Store']['name'], 15, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));		  
			?>
			</h4>
           <?php
		   if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::CouponCodes):?>
            <p class="desc"> 
			<?php echo __l('Coupon Code: '). $this->Html->cText($coupon['Coupon']['coupon_code']);?></p>
			<?php elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips):?>
			<?php echo __l('Shopping Tip: ');?></p>
			<?php elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables):?>
			<?php echo __l('Pritable Coupons: ');?></p>
			 <?php endif; ?>
            <div class="more">
              <h4><?php 
	echo $this->Html->link($this->Text->truncate($coupon['Store']['name'], 30, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));		  
 ?> </h4> <?php $url = Router::url(array('controller'=> 'coupons', 'action' => 'track', 'user_id'=> $this->Auth->user('id'),'store_id' =>$coupon['Coupon']['store_id'],'coupon_id'=>$coupon['Coupon']['id']),true);	 ?>
 			  <div id="js-d_clip_container-<?php echo $coupon['Coupon']['id'];?>" style="position:relative" >
                <div id="js-multiple-<?php echo $coupon['Coupon']['id'];?>" class="copy {'id':'<?php echo $coupon['Coupon']['id'];?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>', 'url':'<?php echo $coupon['Coupon']['url'];?>','track_url':'<?php echo $url;?>'}"><?php echo__l('copy'); ?> &amp; <?php echo __l('open site'); ?> </div>
               </div>
            <div class="js-copyclip" id="js-copyclip1-<?php echo $coupon['Coupon']['id'];?>"><span ></span></div>
		    <p class="desc">
					<?php echo nl2br($this->Html->cText($this->Html->truncate($coupon['Coupon']['description'], 50))); ?>
			</p>			 
			<?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables):?>
			<?php echo $coupon['Coupon']['url'];?>
			 <?php endif; ?></p>
             
              <p><?php echo __l('more on '); ?> <?php echo $this->Html->link($this->Html->cText($coupon['Store']['name']), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));?> <?php echo __l('coupons'); ?>&raquo;</p>  
			  <?php if(Configure::read('coupon.is_coupon_share_enabled')): ?>
			  	<?php $tw_url = Router::url(array('controller' => 'store', 'action' => 'view', $coupon['Store']['slug']), true);
						$tw_url = urlencode_rfc3986($tw_url);
						$tw_message = __l('It Will'). ' '.$coupon['Store']['name'].' '.__l('Sale');
						//$tw_message = urlencode_rfc3986($tw_message);
						// Facebook
						$fb_status = Router::url(array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug']), true);
						$fb_status = urlencode_rfc3986($fb_status);

						?>
						<?php
						if(empty($this->request->params['named']['type'])): ?>
									<p><?php echo __l('Did this coupon work for you?'); ?><button class="yesVote ysvote-<?php echo $coupon['Coupon']['id'];?> {'id':'<?php echo $coupon['Coupon']['id'];?>','description':'<?php echo $coupon['Coupon']['description'];?>','url':'<?php echo $store_url;?>'}"><span><?php echo __l('Yes'); ?></span></button><button class="noVote {'id':'<?php echo $coupon['Coupon']['id'];?>'}"><span><?php echo __l('No'); ?></span></button></p>
						<?php endif; ?>
						<?php endif; ?>
				
			<?php if ($this->Auth->sessionValid()): ?>	
			<?php	
			if(empty($this->request->params['named']['type'])): ?>
				<div>
					<?php 
					echo $this->Html->link(__l(' Click send coupon to my mobile'), array('controller' =>'coupon_sms' ,'action' => 'add','coupon' =>$coupon['Coupon']['id']),array('title' => __l(' Click Send coupon to my mobile'),'class'=>'js-thickbox'));
					?>
				</div>
	<?php endif; ?>	
	<?php endif; ?>	
</div>
</div>
	<?php	


			if(empty($this->request->params['named']['type'])): ?>
					<div class="collateral"> 
									<ul class="commentActions">
									<?php											 
									if(!empty($coupon['CouponComment'])):	?>
									<li class="toggleComments"><a href='#'> <?php echo  count($coupon['CouponComment']).__l(" comments"); ?> </a></li>
									<?php else:									?>									 
									<li><?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add','coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?>		</li>
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
									<li class="writeComment">
									<?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add', 'coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?>									
									 </li>
									 <li class="flag"><?php echo $this->Html->link(__l('Flag this coupon'),array('controller' => 'coupon_flags', 'action' => 'add', $coupon['Coupon']['id']), array('class' => 'js-thickbox'));?></li>
									</ul> 		
									<div class="meta"><?php echo  __l("Shared  ").$this->Time->timeAgoInWords($coupon['Coupon']['created']); ?>  </div></div>
 
		<?php
			if(!empty($coupon['CouponComment'])):?>
		<ol class="comments clearfix" style="display: none;">
		<?php foreach ($coupon['CouponComment'] as $comments): ?>
			<li>
				<div class="avatar"><?php
					$comments['User']['UserAvatar'] = !empty($comments['User']['UserAvatar']) ? $comments['User']['UserAvatar'] : array();
					echo $this->Html->link($this->Html->showImage('UserAvatar', $comments['User']['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($comments['User']['username'], false)), 'title' => $this->Html->cText($comments['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $comments['User']['username'], 'admin' => false), array('escape' => false));
				?></div>
				<p><?php	echo $comments['comment'];	?>		
				</p>
				<p class="attribution"><?php echo  $comments['User']['username'].__l("posted this "). $this->Time->timeAgoInWords($comments['created']); ?></p> 
			</li>   
		<?php endforeach; ?>
		</ol>
		
		<?php
		endif;
		endif;
		?>
 
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
<?php if(empty($this->request->params['named']['type'])): ?>
<?php  
if (!empty($coupons)) {
    echo $this->element('paging_links');
}
?> 
<?php
endif;
?>

</div></div>
<?php endif; ?>
<?php endif; ?>

									
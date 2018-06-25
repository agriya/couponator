<?php /* SVN: $Id: index.ctp 4992 2010-03-04 02:23:37Z thulasi_103ac09 $ */ ?>
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
	font-family:Arial, Helvetica, sans-serif;
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
<div class="maptimize_popup maptimize_info_window">
  <div style="overflow: auto;">
    <div id="couponMapBubbleContainer">
      <div class="couponMapBubble">
        <div class="bubbleMerchantName"><?php echo $coupons[0]['Store']['name']; ?></div>
        <div class="bubbleMerchantAddress"><?php echo $str;  ?></div>
        <?php foreach ($coupons as $coupon):

 $url =Router::url(array(
                'controller' => 'coupons',
                'action' => 'view',
                $coupon['Store']['slug']
            ) , true);


?>
        <div class="bubbleDescription"><?php echo $this->Html->cText($coupon['Store']['name'], false); ?> only <?php echo $this->Html->cFloat($store['Store']['discount'], false); ?> %</div>
        <div class="bubbleLink"><a target="_blank" href="<?php echo  $url; ?>">View coupons</a></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
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
}else{ 
	echo __l('Current Top Coupons');
}
?>
    </h2>
    <?php if(empty($this->request->params['named']['type'])): ?>
    <?php echo $this->element('paging_counter');?>
    <?php endif; ?>
    <div id="c2162354" class="coupon abstract">
      <?php 
if (!empty($coupons)):
$i = 0;
foreach ($coupons as $coupon): 

	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow contain contain-'.$coupon['Store']['id'].'"';
	}
	else
	{
		$class = ' class=" contain contain-'.$coupon['Store']['id'].'"';
	}

	$store_url =Router::url(array(
                'controller' => 'coupons',
                'action' => 'view',
                $coupon['Store']['slug']
           ) , true);
	$tracking_url=Router::url(array('controller'=> 'coupons', 'action' => 'out', $coupon['Coupon']['id']),true);

  
?>
      <div class="inner">
        <div class="subject">
          <?php
					echo $this->Html->link($this->Html->showImage('Store', $coupon['Store']['Attachment'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'),	$this->Html->cText($coupon['Store']['name'], false)), 'title' => $this->Html->cText($coupon['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug']), array('escape' => false, 'class' => 'thumb'));
		   ?>
          <h3><span>
            <?php  echo $this->Html->link($this->Text->truncate($coupon['Store']['name'], 15, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));		  
?>
            </span></h3>
          <ul>
            <li class="viewCoupons">
              <?php 
				$countstr = $coupon['Store']['coupon_count'].' + '.$coupon['Store']['url'].__l(' Coupon Codes');
				echo $this->Html->link($countstr, array('controller'=> 'coupons', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));	
			 ?>
            </li>
          </ul>
        </div>
        <?php $url = Router::url(array('controller'=> 'coupons', 'action' => 'track', 'user_id'=> $this->Auth->user('id'),'store_id' =>$coupon['Coupon']['store_id'],'coupon_id'=>$coupon['Coupon']['id']),true);	 ?>
        <div class="detail">
          <?php if(Configure::read('displaysettings.coupon_display') == ConstCouponDisplayTypes::ClickToCopy){ ?>
          <div class="crux" style="position:relative"  id="js-d_clip_container-<?php echo $coupon['Coupon']['id'];?>"><span>coupon code:</span>
            <?php if(!empty($coupon['Coupon']['coupon_code'])){ ?>
            <strong id="js-multiple-<?php echo $coupon['Coupon']['id'];?>" class="copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo str_replace('&', '&amp;', $coupon['Coupon']['url']);?>','track_url':'<?php echo $tracking_url;?>'}" class="" style="background-color: rgb(253, 237, 180); border-color: rgb(254, 191, 2);"><?php echo $coupon['Coupon']['coupon_code'];?></strong>
            <?php } else { ?>
            <div class="cou-code"> <a id="rev_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo str_replace('&', '&amp;', $coupon['Coupon']['url']);?>', 'track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>"><?php echo !empty($coupon['Coupon']['coupon_code'])?$coupon['Coupon']['coupon_code']:__l('Click to redeem');?></a></div>
            <?php } ?>
          </div>
          <div class="js-copyclip" id="js-copyclip1-<?php echo $coupon['Coupon']['id'];?>"><span ></span></div>
          <?php } elseif(Configure::read('displaysettings.coupon_display') == ConstCouponDisplayTypes::ClickToReveal) {?>
          <div class="crux cou-code code-cover-block" ><span>coupon code:</span><a id="rev_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo str_replace('&', '&amp;', $coupon['Coupon']['url']);?>', 'track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>"><?php echo !empty($coupon['Coupon']['coupon_code'])?$coupon['Coupon']['coupon_code']:__l('Click to redeem');?></a> <a class="code-cover" href="#"> </a></div>
          <?php } ?>
          <p ><?php echo $coupon['Coupon']['title']; ?></p>
          <p class="merchantLink"><?php echo __l('More '); ?> <?php echo $this->Html->link($this->Html->cText($coupon['Store']['name']), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));?> <?php echo __l('coupons'); ?>&raquo;</p>
        </div>
        <div class="break"></div>
      </div>
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
    </div>
    <?php if(empty($this->request->params['named']['type'])): ?>
  <div class="js-pagination">
    <?php  
if (!empty($coupons)) {
    echo $this->element('paging_links');
}
?>
  </div>
    <?php
endif;
?>
  </div>
</div>
<?php endif; ?>
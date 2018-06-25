 <div class="coupon-codes-block">
	<div class="store-left">
		<div class="store-right">
			<div class="codes-inner">
				<h2><?php echo $this->Html->cText($store['Store']['name'],false);?><?php echo __l(' Coupon Codes');?></h2>
				<div class="code-discount clearfix">
					<div class="code-info grid_6 omega alpha clearfix">
						<div class="code-description"><?php echo $this->Html->cText($store['Store']['description'], false); ?></div>
						<?php if (!empty($store['Coupon'][0])) { ?>
							<?php
								$tracking_url = Router::url(array('controller'=> 'coupons', 'action' => 'out', $store['Coupon'][0]['id']), true);
							?>
							<a id="rev_store_<?php echo $store['Coupon'][0]['id'];?>" class="code-a  copy {'id':'<?php echo $store['Coupon'][0]['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $store['Coupon'][0]['coupon_code'];?>','url':'<?php echo $store['Coupon'][0]['url'];?>','track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>" ><?php echo $store['Store']['url']; ?></a>
						<?php } ?>
					</div>
					<div class="discount-block grid_2 clearfix">
						<?php echo __l('Average discount'); ?><span><span class="dollar"><?php echo Configure::read('site.currency'); ?></span><?php echo $this->Html->cCurrency($store['Store']['average_discount'],false); ?></span>
					</div>
				</div>
				<?php
					if (Configure::read('googleads.is_show_top_of_the_page')):
						echo $this->element('google_adds', array('config' => 'sec', 'type' => 'top'));
					endif;
				?>      
			</div>
		</div>
	</div>
	<div class="coupon-bottom"></div>
</div>
<?php 
	echo $this->element('store-coupons-index', array('store_id' => $store['Store']['id'], 'coupon_type' => ConstCouponTypeStatus::SpecialOffer, 'config' => 'sec'));
	echo $this->element('store-coupons-index', array('store_id' => $store['Store']['id'], 'coupon_type' => ConstCouponTypeStatus::Normalcoupon, 'config' => 'sec'));
	echo $this->element('../subscriptions/add',array('type' => 'store_view', 'config' => 'sec'));
	echo $this->element('store-coupons-index',array('store_id' => $store['Store']['id'], 'coupon_type' => ConstCouponTypeStatus::Unreliable, 'config' => 'sec'));
	if (Configure::read('googleads.is_show_ads at_the_ bottom_of_the_page')):
		echo $this->element('google_adds', array('config' => 'sec', 'type' => 'top'));
	endif;
?>
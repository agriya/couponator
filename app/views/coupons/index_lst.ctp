<div class="coupon-block coupon-codes-block clearfix">
	<div class="store-left">
		<div class="store-right">
			<div class="store-center coupon-center">
				<?php if (!empty($this->request->params['named']['tag'])): ?>
					<h2><?php echo sprintf(__l('Current Top %s Coupons'), $tag_name); ?></h2>
				<?php elseif (!empty($search)): ?>
					<h2><?php echo $keyword . ' ' . __l('Search Results'); ?></h2>
				<?php elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'latest_contributions'): ?>
					<h2><?php echo __l('Latest Contributions:'); ?></h2>
				<?php elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'free_shipping'): ?>
					<h2><?php echo __l('Top Free Shipping Coupons'); ?></h2>
				<?php else: ?>
					<h2><?php echo __l('Today\'s Top Coupons'); ?></h2>
				<?php endif; ?>
				<ol class="coupon-list clearfix">
					<?php
						if (!empty($coupons)):
							$i = 0;
							foreach ($coupons as $coupon):
								$class = null;
								if ($i++ % 2 == 0) {
									$class = ' class="altrow contain contain-'.$coupon['Store']['id'].'"';
								} else {
									$class = ' class=" contain contain-'.$coupon['Store']['id'].'"';
								}
								$store_url = Router::url(array(
									'controller' => 'stores',
									'action' => 'view',
									$coupon['Store']['slug']
								) , true);
								$tracking_url = Router::url(array('controller'=> 'coupons', 'action' => 'out', $coupon['Coupon']['id']),true);
								$store_name= $coupon['Store']['name'];
							
					?>
					<li class="clearfix">
				<div class="coupon-image-leftblock">
			     	<div class="coupon-image-rigthblock">
		     			<div class="coupon-image-midblock-outer clearfix">
							<div class="coupon-image-midblock clearfix">
								<div class="coupon-image-block grid_3 omega alpha">
									<div class="coupon-img-block grid_left">
										<?php
											echo $this->Html->link($this->Html->showImage('Store', !empty($coupon['Store']['Attachment']) ? $coupon['Store']['Attachment']:'', array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'),	$this->Html->cText($coupon['Store']['name'], false)), 'title' => $this->Html->cText($coupon['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug']), array('escape' => false,'class'=>'thumb'));
										?>
									</div>
									<div class="img-desc-block grid_left">
										<h3><?php echo $this->Html->link($this->Text->truncate($store_name, 17, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));?></h3>
										<p><?php echo $coupon['Store']['coupon_count'].' + ';?></p>
										<?php echo $this->Html->link($this->Text->truncate($coupon['Store']['name'], 15, array('ending' => '...')), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));	 ?>
										<p><?php echo __l('coupon codes'); ?></p>
									</div>
								</div>
								<div class="coupon-desc-block grid_5 omega alpha">
									<div class="coupon-cm">
										<?php $url = Router::url(array('controller'=> 'coupons', 'action' => 'track', 'user_id' => $this->Auth->user('id'),'store_id' => $coupon['Coupon']['store_id'], 'coupon_id' => $coupon['Coupon']['id']), true); ?>
										<?php if(!empty($coupon['Coupon']['coupon_code'])) { ?>
											<div class="clearfix code-cover-block">
												<?php if (Configure::read('displaysettings.coupon_display') != ConstCouponDisplayTypes::ClickToReveal) {?>
													<div class="coupon-code" style="position:relative"  id="js-d_clip_container-<?php echo $coupon['Coupon']['id'];?>">
														<a href="#" id="js-multiple-<?php echo $coupon['Coupon']['id'];?>" class="copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo str_replace('&', '&amp;', $coupon['Coupon']['url']);?>','track_url':'<?php echo $tracking_url;?>'}"><?php echo $coupon['Coupon']['coupon_code'];?></a>
													</div>
												<?php } else { ?>
													<div class="offer-info-code clearfix cou-code">
														<a id="rev_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo str_replace('&', '&amp;', $coupon['Coupon']['url']);?>','track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>"><?php echo $coupon['Coupon']['coupon_code'];?></a>
													</div>
												<?php } ?>
												<?php if(Configure::read('displaysettings.coupon_display') == ConstCouponDisplayTypes::ClickToReveal) {?>
													<a class="code-cover" href="#"> </a>
												<?php } ?>
											</div>
										<?php } else { ?>
											<div class="clearfix">
												<div class="offer-info-code clearfix cou-code">
													<a id="rev_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo str_replace('&', '&amp;', $coupon['Coupon']['url']);?>','track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>"><?php echo !empty($coupon['Coupon']['coupon_code'])?$coupon['Coupon']['coupon_code']:__l('Click to redeem');?></a>
												</div>
											</div>
										<?php }  ?>
										<div class="js-desc-to-trucate"><?php echo $this->Html->cText($coupon['Coupon']['description']);?></div>
										<?php echo __l('More '); ?> <?php echo $this->Html->link($this->Html->cText($coupon['Store']['name']), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin'=>false), array('escape' => false));?> <?php echo __l('coupons'); ?> &raquo;
										<?php if(!empty($this->request->params['named']['coupons']) && $this->request->params['named']['coupons']=='latest'): ?>
											<div class="avatar-blocks">
												<?php
													if($coupon['Coupon']['user_id']!=ConstUserTypes::Admin): 
														echo $this->Html->getUserInfo($coupon['Coupon']['user_id']);
												?>
												<span><?php echo  __l('Shared') . ' ' . $this->Time->timeAgoInWords($coupon['Coupon']['created']); ?> </span>
												<?php
													endif;
												?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
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
<?php if(!isset($this->request->params['named']['coupons']) || isset($this->request->params['named']['coupons']) && $this->request->params['named']['coupons']!='latest'): ?>
	<div class="coupon-bottom"></div>
<?php endif; ?>
</div>
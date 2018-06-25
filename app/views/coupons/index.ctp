<?php if($is_ajax && isset($this->request->params['named']['coupon_id'])) { ?>
	<style>
		.maptimize_info_window {
			float:left;
			height:100px;
			overflow-y:auto;
			padding:5px;
			position:relative;
		}
		.maptimize_info_window .img,.maptimize_info_window .info {
			float:left;
		}
		div.couponMapBubble div.bubbleDescription {
			border:1px dashed #E0DFDC;
			color:#302E2A;
			font-family:Arial, Helvetica, sans-serif;
			font-size:12px;
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
		.info {
			padding:0 0 0 2px;
			width:120px;
			font-family:Arial;
		}
	</style>
	<?php
		$str = $coupons[0]['Store']['address'];
	?>
<div class="maptimize_popup maptimize_info_window">
	<div>
		<div id="couponMapBubbleContainer">
			<div class="couponMapBubble">
				<div class="img"><?php echo $this->Html->showImage('Store', $coupons[0]['Store']['Attachment'], array('dimension' => 'store_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($coupons[0]['Store']['name'], false)), 'title' => $this->Html->cText($coupons[0]['Store']['name'], false))); ?></div>
				<div class="info">
					<div class="bubbleMerchantName"> <?php echo $coupons[0]['Store']['name']; ?></div>
					<div class="bubbleMerchantAddress"> <?php echo $str; ?></div>
				</div>
				<br style="clear:both;">
				<?php
					foreach ($coupons as $coupon) {
						$url = Router::url(array(
							'controller' => 'stores',
							'action' => 'view',
							$coupon['Store']['slug'],
							'#contain-print-'.$coupon['Coupon']['id']
						) , true);
				?>
				<div class="bubbleDescription"><?php echo $this->Html->cText($coupon['Coupon']['description'], false); ?></div>
				<div class="bubbleLink"><a target="_blank" href="<?php echo  $url; ?>"><?php echo __l('View coupons'); ?></a></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } else { ?>
	<?php  
		if (!empty($coupons)) {
			if (!empty($this->request->params['named']['coupon_type'])) {
				if ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::SpecialOffer) {
					$main_class='offer-block coupon-codes-block';
				} elseif ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Unreliable) {
					$main_class='unreliable-coupon-block coupon-codes-block';
				} elseif ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Normalcoupon) {
					$main_class='active-block coupon-codes-block';
				}
			}
	?>
<div class="<?php echo !empty($main_class)? $main_class:''; ?> js-response">
	<div class="store-left">
		<div class="store-right">
			<div class="store-center coupon-center1 coupon-center">
			<h2>
				<?php
					if (!empty($this->request->params['named']['coupon_type'])) {
						if ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::SpecialOffer) {
							$main_class='offer-block coupon-codes-block';
							echo __l('Current Special Offers');
						} elseif ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Unreliable) {
							$main_class='unreliable-coupon-block coupon-codes-block';
							echo __l('Unreliable Coupons ');
						} elseif ($this->request->params['named']['coupon_type'] ==ConstCouponTypeStatus::Normalcoupon) {
							$main_class='active-block coupon-codes-block';
							echo __l('Active Coupons');
						} else {
							echo __l('Coupons');
						}
					} elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type']=='home') {
						echo __l('Top Coupons');
					}
				?>
			</h2>
		
				<ol class="grade-list">
					<?php 
						if (!empty($coupons)) {
							$i = 0;
							$google_ads=$count_ads= $loop= $lop=0;
							foreach ($coupons as $coupon) {
								$class = null;
								if ($i++ % 2 == 0) {
									$class = ' altrow contain contain-'.$coupon['Coupon']['id'];
								} else {
									$class = '  contain contain-'.$coupon['Coupon']['id'];
								}
								if ($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips) {
									$coupon_status= 'tip';
								} elseif ($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables) {
									$coupon_status= 'printable';
								}elseif ($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::FreeShipping) {
									$coupon_status= 'freeshipping';
								} else {
									$coupon_status= '';
								}
								$store_url = Router::url(array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug'] ) , true);
								$stats = 0;
								if (!empty($coupon['Coupon']['coupon_worked_count'])) {
									$stats = ($coupon['Coupon']['coupon_worked_count']*100)/($coupon['Coupon']['coupon_worked_count']+$coupon['Coupon']['coupon_not_worked_count']);
								}
								if($stats>60) {
									$status='good';
								} else if($stats<=60 && $stats >=40) {
									$status='average';
								} else if($stats<=39 && $stats >0) {
									$status='bad';
								} else {
									$status='good new';
								}
								if($stats > 100) {
									$stats=100;
								}
								if (empty($coupon['Coupon']['coupon_code'])) {
									if ($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips) {
										$status=$status;
									} elseif ($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables) { 
										$status=$status;
									} else {
										$status='good sale';
									}
								}
								$url = Router::url(array('controller' => 'coupons', 'action' => 'track', 'user_id' => $this->Auth->user('id'), 'store_id' => $coupon['Coupon']['store_id'], 'coupon_id' => $coupon['Coupon']['id']), true);
								$tracking_url = Router::url(array('controller'=> 'coupons', 'action' => 'out', $coupon['Coupon']['id']), true);
					?>
						<li class="<?php echo $class; ?>  contain-print-<?php echo $coupon['Coupon']['id']; ?> coupon <?php echo $coupon_status; ?> {'id':'<?php echo $coupon['Coupon']['id'];?>'}" id="contain-print-<?php echo $coupon['Coupon']['id']; ?>">
							<div class="grade-info-block clearfix">
								<div class="grade-block grid_left">
									<p class="<?php echo $status; ?>">
										<?php if($stats==0) { ?>
											<?php echo __l('New!'); ?>
										<?php } else { ?>
											<span><?php echo ceil($stats);?>%</span> <?php echo __l('Success'); ?>
										<?php } ?>
									</p>
								</div>
								<?php if (!empty($coupon['Coupon']['coupon_code'])) { ?>
									<div class="offer-info grid_5">
										<div class="clearfix">
											<div class="offer-info-code clearfix">
												<?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::FreeShipping){ ?>
													<span class="freeshipping code"><?php echo __l('Freeshipping:'); ?></span>
												<?php } else { ?>
												<span class="code"><?php echo __l('Coupon code:'); ?></span>
												<?php } ?>
												<div class="clearfix coupon-code-info code-cover-block">
													<?php if(Configure::read('displaysettings.coupon_display') != ConstCouponDisplayTypes::ClickToReveal) {?>
														<div class="coupon-code store-view" id="js-d_clip_container-<?php echo $coupon['Coupon']['id'];?>">
															<a href="#" id="js-multiple-<?php echo $coupon['Coupon']['id'];?>" class="copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>', 'url':'<?php echo $coupon['Coupon']['url'];?>','track_url':'<?php echo $tracking_url;?>'}"><?php echo $coupon['Coupon']['coupon_code'];?></a>
                                                        </div>
                                                	<?php } else { ?>
                                                		<div class="clearfix">
														<div class="offer-info-code clearfix cou-code">
															<a id="rev_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];;?>','track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>"><?php echo $coupon['Coupon']['coupon_code'];?></a>
                                                        	</div>
                                                            </div>
                                                	<?php } ?>
													<?php if (Configure::read('displaysettings.coupon_display') == ConstCouponDisplayTypes::ClickToReveal) {?>
															<a class="code-cover" href="#"> </a>
													<?php } ?>
													
												
											</div>
										</div>
											</div>
										<p><a id="rev_store_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];?>', 'track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>" ><?php echo $coupon['Coupon']['description']; ?></a></p>
								
										</div>
								<?php } else { ?>
									<div class="offer-info grid_5">
										<div class="clearfix">
											<div class="offer-info-code clearfix cou-code">
												<?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips){ ?>
													<span class="shopping"><?php echo __l('Shopping Tips:'); ?></span>
												<?php } elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables){ ?>
													<span class="print"><?php echo __l('Printable:'); ?></span>
												<?php } elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::FreeShipping){ ?>
													<span class="freeshipping"><?php echo __l('Freeshipping:'); ?></span>
												<?php } ?>
												<a class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];?>','track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>">
													<?php if($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::ShoppingTips){ ?>
														<?php echo __l('Visit Store'); ?>
													<?php } elseif($coupon['Coupon']['coupon_type_id']==ConstCouponTypes::Printables){ ?>
														<?php echo __l('Print coupon'); ?>
													<?php } else{ ?>
														<?php echo !empty($coupon['Coupon']['coupon_code'])?$coupon['Coupon']['coupon_code']:__l('Click to redeem');?>
													<?php } ?>
												</a>
											</div>
										</div>
										<p><a id="rev_store_<?php echo $coupon['Coupon']['id'];?>" class="code-a copy {'id':'<?php echo $coupon['Coupon']['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $coupon['Coupon']['coupon_code'];?>','url':'<?php echo $coupon['Coupon']['url'];?>', 'track_url':'<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>" ><?php echo $coupon['Coupon']['description']; ?></a></p>
									</div>
								<?php } ?>
								<?php if($coupon['Coupon']['user_id']!=$this->Auth->user('id')): ?>
								<div class="coupon-work-block grid_right">
									<p><?php echo __l('Like it?'); ?></p>
									<a href="#" title="yes" class="yes yesVote ysvote-<?php echo $coupon['Coupon']['id'];?> {'id':'<?php echo $coupon['Coupon']['id'];?>','description':'<?php echo $coupon['Coupon']['description'];?>','url':'<?php echo $store_url . '#contain-print-' . $coupon['Coupon']['id'];?>'}"><?php echo __l('Yes'); ?></a>
									<?php if (!Configure::read('coupon.is_downvote_restrict')) { ?>
									<a href="#" title="no" class="no noVote {'id':'<?php echo $coupon['Coupon']['id'];?>'}"><?php echo __l('No'); ?></a>
									<?php } ?>
									
								</div>
								<?php endif; ?>
						</div>
							
							<div class="comment-block clearfix">
								<ul class="commentActions collateral clearfix">
									<?php if ($coupon['User']['user_type_id']!=ConstUserTypes::Admin && $coupon['Coupon']['user_id']) { ?>
										<?php if (!empty($coupon['User']['UserAvatar'])) { ?>
											<li>
												<?php
													$avatar_class ='';
													echo $this->Html->link($this->Html->showImage('UserAvatar', $coupon['User']['UserAvatar'], array('dimension' => 'nano_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($coupon['User']['username'], false)), 'title' => $this->Html->cText($coupon['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $coupon['User']['username'], 'admin' => false), array('escape' => false)); 
												?>
												<?php echo ' ' . $this->Html->link($coupon['User']['username'] , array('controller' => 'users', 'action' => 'view',  $coupon['User']['username'], 'admin' => false), null); ?>
											</li>
										<?php } else { ?>
											<?php $avatar_class ='link1'; ?>
											<li class="<?php echo  $avatar_class; ?>">
												<?php echo $this->Html->link($coupon['User']['username'] , array('controller' => 'users', 'action' => 'view',  $coupon['User']['username'], 'admin' => false), null); ?>
											</li>
										<?php } ?>
										
									<?php } ?>		
									
									<?php if(!empty($coupon['Coupon']['average_savings_amount']) && $coupon['Coupon']['average_savings_amount'] > 0): ?>
									<li><?php echo __l('♥ avg saving: ').Configure::read('site.currency').$this->Html->cInt($coupon['Coupon']['average_savings_amount']); ?></li>
									<?php else: ?>
									<li><?php echo  __l('Shared') . ' ' . $this->Time->timeAgoInWords($coupon['Coupon']['created']); ?> </li>
									<?php endif; ?>
									<?php if ($this->Auth->sessionValid()) { ?>
										<li class="addasfavorites">
											<?php if (!empty($coupon['CouponFavorite']) && $this->Auth->user('id') == $coupon['CouponFavorite'][0]['user_id']) { ?>
												<?php
													echo $this->Html->link(__l('Remove favorites'),array('controller'=> 'coupon_favorites', 'action' => 'delete',$coupon['CouponFavorite'][0]['id'],'coupon_slug'=>$coupon['Coupon']['slug']), array('title'=>__l('Remove favorites'),'escape' => false,'class'=>"js-ajax-submission removed_class {'added_text':'Remove favorites','removed_text':'Add to favorites', 'added_class':'added_class', 'removed_class':'removed_class'}"));
												?>
											<?php } else { ?>
												<?php
													echo $this->Html->link(__l('Add to favorites'),array('controller'=> 'coupon_favorites', 'action' => 'add',$coupon['Coupon']['id']), array('title'=>__l('Add to favorites'),'escape' => false,'class'=>"js-ajax-submission added_class {'added_text':'Remove favorites','removed_text':'Add to favorites', 'added_class':'added_class', 'removed_class':'removed_class'}"));
												?>
											<?php } ?>
										</li>
									<?php } ?>
									<?php if (!empty($coupon['CouponComment'])) { ?>
										<li class="comment toggleComments"><a href='#'> <?php echo  count($coupon['CouponComment']).__l(" comments"); ?> </a></li>
									<?php } else { ?>
										<li class="comment"><?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add','coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?> </li>
									<?php } ?>
									<li class="writeComment"><?php echo $this->Html->link(__l('Add comment'),array('controller'=>'coupon_comments', 'action'=>'add', 'coupon_id'=>$coupon['Coupon']['id']),array('class' => 'js-thickbox'));?></li>
									<li class="closeComments"><a href="#"><?php echo  __l("Close comments"); ?></a></li>
									<?php if($coupon['Coupon']['user_id']!= $this->Auth->user('id')):?>
									<li class="flag"><?php echo $this->Html->link(__l('Flag this coupon'),array('controller' => 'coupon_flags', 'action' => 'add', $coupon['Coupon']['id']), array('class' => 'js-thickbox'));?></li>
									<?php endif;?>
								</ul>
							</div>
							<?php if (!empty($coupon['CouponComment'])) { ?>
								
								<ol class="comments clearfix" style="display: none;">
									<?php foreach ($coupon['CouponComment'] as $comments) {  ?>
										<li>
                                          	<div class="avatar"><?php
												$comments['User']['UserAvatar'] = !empty($comments['User']['UserAvatar']) ? $comments['User']['UserAvatar'] : array();
                                                if(!empty($comments['User']['username'])):
												echo $this->Html->link($this->Html->showImage('UserAvatar', $comments['User']['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($comments['User']['username'], false)), 'title' => $this->Html->cText($comments['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $comments['User']['username'], 'admin' => false), array('escape' => false));
												else:
												echo $this->Html->showImage('UserAvatar', $comments['User']['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText(__l('Guest'), false)), 'title' => $this->Html->cText(__l('Guest'), false)));
												endif;?>
											</div>
											<p><?php echo $comments['comment'];	?></p>
											<p class="attribution">
												<?php 
													if (!empty($comments['User']['username'])) {
														$username = $this->Html->link($comments['User']['username'], array('controller' => 'users', 'action' => 'view',  $comments['User']['username'], 'admin' => false));
													} else {
														$username = __l('Guest');
													}
													echo  $username . ' ' . __l('posted this') . ' ' . $this->Time->timeAgoInWords($comments['created']);
												?>
											</p>
											<?php if ($comments['user_id'] == $this->Auth->user('id') || $this->Auth->user('user_type_id') == ConstUserTypes::Admin) { ?>
												<div class="actions">
													<?php echo $this->Html->link(__l('Delete'), array('controller' => 'coupon_comments', 'action' => 'delete', $comments['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?>
												</div>
											<?php } ?>
										</li>
									<?php } ?>
									</ol>
								
							<?php } ?>
						</li>
					<?php
						if(Configure::read('googleads.is_show_mixed_of_the_page') && Configure::read('googleads.no_of_records_display_between_ads') > 0) {
							if ($lop % Configure::read('googleads.no_of_records_display_between_ads') == 0) {
					?>
						<li><?php echo $this->element('google_adds', array('config' => 'sec', 'type' => 'top')); ?></li>
					<?php 
							}
						}
					$lop++;
					}
				} else {
			?>
			<?php if(!empty($this->request->params['named']['category'])) { ?>
				<li>
					<p class="notice"><?php echo __l('No Coupons available');?></p>
				</li>
			<?php } ?>
			<?php } ?>
		</ol>
			<div class="js-pagination">
	<?php echo $this->element('paging_links'); ?>
</div>
		</div>
	
	</div>
</div>

<div class="coupon-bottom"></div>
</div>
<?php } ?>
<?php } ?>
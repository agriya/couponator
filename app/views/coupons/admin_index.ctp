<?php /* SVN: $Id: admin_index.ctp 1243 2009-12-23 12:56:38Z arivuchelvan_086at09 $ */ ?>
<div class="coupons index js-response">
	<fieldset class="form-block round-5">
		<legend><?php echo __l('Coupon Type Status'); ?></legend>
		<ul class="filter-list clearfix">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypeStatus::Normalcoupon) { echo 'class="active"';} ?>>
				<span class="active" title="<?php echo __l('Normal Coupons'); ?>"><?php echo $this->Html->link($this->Html->cInt($active_count,false).'<span>' .__l('Normal  Coupons'). '</span>', array('controller'=>'coupons','action'=>'index','filter_id' => ConstCouponTypeStatus::Normalcoupon), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypeStatus::SpecialOffer) { echo 'class="active"';} ?> >
				<span class="special-coupon" title="<?php echo __l('SpecialOffer'); ?>"><?php echo $this->Html->link($this->Html->cInt($special_count,false).'<span>' .__l('SpecialOffer'). '</span>', array('controller'=>'coupons','action'=>'index','filter_id' => ConstCouponTypeStatus::SpecialOffer), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypeStatus::Unreliable) { echo 'class="active"';} ?>>
				<span class="unreliable-coupon" title="<?php echo __l('Unreliable Coupons'); ?>"><?php echo $this->Html->link($this->Html->cInt($unreliable_count,false).'<span>' .__l('Unreliable Coupons'). '</span>', array('controller'=>'coupons','action'=>'index','filter_id' => ConstCouponTypeStatus::Unreliable), array('escape' => false));?></span> 
			</li>
		</ul>
	</fieldset>
	<fieldset class="form-block round-5">
		<legend><?php echo __l('Coupon Status'); ?></legend>
		<ul class="filter-list clearfix">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::CheckStore) { echo 'class="active"';} ?>>
				<span class="check-store" title="<?php echo __l('Check Store'); ?>"><?php echo $this->Html->link($this->Html->cInt($checkstore_count,false).'<span>' .__l('Check Store'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::CheckStore), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::NewCoupon) { echo 'class="active"';} ?>>
				<span class="new-coupon" title="<?php echo __l('New Coupons'); ?>"><?php echo $this->Html->link($this->Html->cInt($newcoupon_count,false).'<span>' .__l('New Coupons'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::NewCoupon), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::ActiveCoupon) { echo 'class="active"';} ?>>
				<span class="actives-coupon" title="<?php echo __l('Active Coupons'); ?>"><?php echo $this->Html->link($this->Html->cInt($activecoupon_count,false).'<span>' .__l('Active Coupons'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::ActiveCoupon), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::RejectedStore) { echo 'class="active"';} ?>>
				<span class="rejected-store " title="<?php echo __l('Rejected Store'); ?>"><?php echo $this->Html->link($this->Html->cInt($rejectedstore_count,false).'<span>' .__l('Rejected Store'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::RejectedStore), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::RejectedCoupon) { echo 'class="active"';} ?>>
				<span class="rejected-coupon" title="<?php echo __l('Rejected Coupons'); ?>"><?php echo $this->Html->link($this->Html->cInt($rejectedcoupon_count,false).'<span>' .__l('Rejected Coupons'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::RejectedCoupon), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::OutdatedCoupon) { echo 'class="active"';} ?>>
				<span class="outdated-coupon" title="<?php echo __l('Outdated Coupons'); ?>"><?php echo $this->Html->link($this->Html->cInt($outdatedcoupon_count,false).'<span>' .__l('Outdated Coupons'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::OutdatedCoupon), array('escape' => false));?></span> 
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponStatus::Partner) { echo 'class="active"';} ?>>
				<span class="partner" title="<?php echo __l('Partner'); ?>"><?php echo $this->Html->link($this->Html->cInt($partner_count,false).'<span>' .__l('Subscribed Users'). '</span>', array('controller'=>'coupons','action'=>'index','status_id' => ConstCouponStatus::Partner), array('escape' => false));?></span> 
			</li>

		</ul>
	</fieldset>
	<fieldset class="form-block round-5">
		<legend><?php echo __l('Coupon Types'); ?></legend>
		<ul class="filter-list clearfix">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypes::CouponCodes) { echo 'class="active"';} ?>>
				<span class="couponcode-coupon" title="<?php echo __l('Coupon code'); ?>"><?php echo $this->Html->link($this->Html->cInt($couponcode_count,false).'<span>' .__l('Coupon code'). '</span>', array('controller'=>'coupons','action'=>'index','coupon_type_id' => ConstCouponTypes::CouponCodes), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypes::ShoppingTips) { echo 'class="active"';} ?>>
				<span class="shopping-coupon" title="<?php echo __l('Shopping Tips'); ?>"><?php echo $this->Html->link($this->Html->cInt($shoppingtip_count,false).'<span>' .__l('Shopping Tips'). '</span>', array('controller'=>'coupons','action'=>'index','coupon_type_id' => ConstCouponTypes::ShoppingTips), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypes::Printables) { echo 'class="active"';} ?>>
				<span class="printable-coupon" title="<?php echo __l('Printable'); ?>"><?php echo $this->Html->link($this->Html->cInt($printable_count,false).'<span>' .__l('Printable'). '</span>', array('controller'=>'coupons','action'=>'index','coupon_type_id' => ConstCouponTypes::Printables), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstCouponTypes::FreeShipping) { echo 'class="active"';} ?>>
				<span class="free-coupon" title="<?php echo __l('Freeshipping'); ?>"><?php echo $this->Html->link($this->Html->cInt($freeshipping_count,false).'<span>' .__l('Freeshipping'). '</span>', array('controller'=>'coupons','action'=>'index','coupon_type_id' => ConstCouponTypes::FreeShipping), array('escape' => false));?></span>
			</li>
		</ul>
	</fieldset>
	<?php if (!empty($affiliateSites)): ?>
		<fieldset class="form-block round-5">
			<legend><?php echo __l('Affiliate'); ?></legend>
			<ul class="filter-list clearfix">
				<?php
					foreach($affiliateSites as $affiliate_site_id => $affiliate_site_name):
				?>
						<li <?php if (!empty($this->request->params['named']['affiliate_site_id']) && $this->request->params['named']['affiliate_site_id'] == $affiliate_site_id) { echo 'class="active"';} ?>>

							<span class="affiliate-coupon-<?php echo $affiliate_site_id; ?>" title="<?php echo $affiliate_site_name; ?>"><?php echo $this->Html->link($affiliate_coupon_count[$affiliate_site_id] .'<span>' .$affiliate_site_name. '</span>', array('controller'=>'coupons','action'=>'index','affiliate_site_id' => $affiliate_site_id), array('escape' => false));?></span>
						</li>
				<?php
					endforeach;
				?>
			</ul>
		</fieldset>
	<?php endif; ?>
	<div class="page-count-block clearfix">
		<div class="grid_left"><?php echo $this->element('paging_counter');?></div>
		<div class="grid_left">
			<?php echo $this->Form->create('Coupon' , array('class' => 'normal search-form','action' => 'index')); ?>
			<div class="filter-section clearfix">
				<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
				<?php echo $this->Form->submit(__l('Search'));?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="js-confirm-message-block add-block grid_right clearfix">
		<span class="update-status-info"><?php echo $this->Html->link(__l('Permanent delete system for expired coupons'), array('controller' => 'coupons', 'action' => 'coupon_delete'), array('class' => 'js-confirm-msg update-status', 'title' => __l('You can use this to delete coupons permanently which are marked as expired')));?></span>
	</div>
	</div>
	
	<?php echo $this->Form->create('Coupon' , array('class' => 'normal','action' => 'update')); ?>
		<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
		<div class="overflow-block">
			<table class="list" id="js-expand-table">
                <tr class="js-even">
					<th rowspan="2" class="select"><?php echo __l('Select'); ?>
                        
                    </th>
					<th rowspan="2" class="dl"><?php echo __l('Coupon');?></th>
					<th rowspan="2" class="dl"><?php echo $this->Paginator->sort('store_id');?></th>
				</tr>
				<tr class="js-even">

		    	</tr>
			<?php
					if (!empty($coupons)):
					$i = 0;
					foreach ($coupons as $coupon):
						$class = null;
						$active_class = '';
						if ($i++ % 2 == 0) {
							$class = 'altrow';
						}
						$status_class ='';
						if($coupon['Coupon']['admin_suspend']):
							$status_class.= ' js-checkbox-suspended';
						else:
							$status_class.= ' js-checkbox-unsuspended';
						endif;
						if($coupon['Coupon']['is_system_flagged']):
							$status_class.= ' js-checkbox-flagged';
						else:
							$status_class.= ' js-checkbox-unflagged';
						endif;
						if($coupon['Coupon']['is_active']):
	                        $status_class = 'js-checkbox-active';
                        else:
							$active_class = ' inactive-record';
							$status_class = 'js-checkbox-inactive';
                        endif;
						if($coupon['Coupon']['coupon_type_id'] ==ConstCouponTypes::ShoppingTips):
							$coupon_type = 'ShoppingTips';
							$class_type = 'shopping-coupon';
						elseif($coupon['Coupon']['coupon_type_id'] ==ConstCouponTypes::CouponCodes):
							$coupon_type = 'CouponCode';
							$class_type = 'couponcode-coupon';
						elseif($coupon['Coupon']['coupon_type_id'] ==ConstCouponTypes::Printables):
							$coupon_type = 'Printables';
							$class_type = 'printable-coupon';
						elseif($coupon['Coupon']['coupon_type_id'] ==ConstCouponTypes::FreeShipping):
							$coupon_type = 'FreeShipping';
							$class_type = 'free-coupon';
						endif;
						$couponstatustype = $class_type_status = $class_status = '';
						if($coupon['Coupon']['coupon_type_status_id'] ==ConstCouponTypeStatus::SpecialOffer):
							$couponstatustype = 'SpecialOffer';
							$class_type_status = 'special-coupon';
						elseif($coupon['Coupon']['coupon_type_status_id'] ==ConstCouponTypeStatus::Unreliable):
							$couponstatustype = 'Unreliable';
							$class_type_status = 'unreliablel-coupon';
						elseif($coupon['Coupon']['coupon_type_status_id'] ==ConstCouponTypeStatus::Normalcoupon):
							$couponstatustype = 'Normalcoupon';
							$class_type_status = 'active-coupon';
						endif;
						if($coupon['Coupon']['coupon_status_id'] ==ConstCouponStatus::CheckStore):
							$couponstatus = 'CheckStore';
							$class_status = 'check-store';
						elseif($coupon['Coupon']['coupon_status_id'] ==ConstCouponStatus::NewCoupon):
							$couponstatus = 'New Coupon';
							$class_status = 'new-coupon';
						elseif($coupon['Coupon']['coupon_status_id'] ==ConstCouponStatus::RejectedStore):
							$couponstatus = 'RejectedStore';
							$class_status = 'rejected-store';
						elseif($coupon['Coupon']['coupon_status_id'] ==ConstCouponStatus::ActiveCoupon):
							$couponstatus = 'Activecoupon';
							$class_status = 'actives-coupon';
						elseif($coupon['Coupon']['coupon_status_id'] ==ConstCouponStatus::RejectedCoupon):
							$couponstatus = 'RejectedCoupon';
							$class_status = 'rejected-coupon';
						elseif($coupon['Coupon']['coupon_status_id'] ==ConstCouponStatus::OutdatedCoupon):
							$couponstatus = 'OutdatedCoupon';
							$class_status = 'outdated-coupon';
						endif;
			?>
			<tr class="<?php echo $class.$active_class;?> expand-row js-odd">
				<td class="<?php echo $class;?> select"><div class="arrow"></div><?php echo $this->Form->input('Coupon.'.$coupon['Coupon']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$coupon['Coupon']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
				<td class="dl coupon-status-info">
				<div class="clearfix">
                    <div class="grid_left">
                	<span class="coupon-status-info <?php echo $class_type_status; ?>" title="<?php echo  $couponstatustype; ?>"><?php echo  $couponstatustype; ?></span>
					<span class="coupon-status-info <?php echo $class_status; ?>" title="<?php echo  $couponstatus; ?>"><?php echo  $couponstatus; ?></span>
					<span class="coupon-status-info <?php echo !empty($class_type)?$class_type:''; ?>" title="<?php echo  $coupon_type; ?>"><?php echo  $coupon_type; ?></span>					
					<?php
						echo $this->Html->link($this->Html->cText($coupon['Coupon']['description']), array('controller'=> 'stores', 'action' => 'view', $coupon['Store']['slug'], 'admin' => false), array('escape' => false));
					?>
					</div>
					 <div class="grid_right">
                    <?php	echo '<span class="affiliate-coupon-' . $coupon['AffiliateSite']['id'] . '">' . $coupon['AffiliateSite']['name'] . '</span>';
					?>
					</div>
					</div>
				</td>
				<td class="dl">
						<?php echo $this->Html->link($this->Html->cText($coupon['Store']['name']), array('controller'=> 'coupons', 'action' => 'index', 'store' =>$coupon['Store']['slug'], 'admin' => false), array('escape' => false));?>
				</td>
   			</tr>
			<tr class="hide">
				<td colspan="15" class="action-block">
					<div class="action-info-block clearfix">
						<div class="action-left-block">
							<h3> <?php echo __l('Action');?>  </h3>
								<ul>
									<li><span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $coupon['Coupon']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit'))); ?></span></li>
        				            <li><span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $coupon['Coupon']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete'))); ?></span></li>
        				            <li><span><?php if($coupon['Coupon']['is_system_flagged']):?>
                						<span><?php echo $this->Html->link(__l('Clear flag'), array('action' => 'admin_update_status', $coupon['Coupon']['id'], 'flag' => 'deactivate'), array('class' => 'js-admin-update-coupon clear-flag', 'title' => __l('Clear flag')));?></span>
                						<?php else:?>
                						<span><?php echo $this->Html->link(__l('Flag'), array('action' => 'admin_update_status', $coupon['Coupon']['id'], 'flag' => 'active'), array('class' => 'js-admin-update-coupons flag', 'title' => __l('Flag')));?></span>
                						<?php endif;?></span>
                                    </li>
                                    <li><span><?php if($coupon['Coupon']['admin_suspend']):?>
                						<span><?php echo $this->Html->link(__l('Unsuspend'), array('action' => 'admin_update_status', $coupon['Coupon']['id'], 'flag' => 'unsuspend'), array('class' => 'js-admin-update-coupon  unsuspend', 'title' => __l('Unsuspend')));?></span>
                						<?php else:?>
                						<span><?php echo $this->Html->link(__l('Suspend'), array('action' => 'admin_update_status', $coupon['Coupon']['id'], 'flag' => 'suspend'), array('class' => 'js-admin-update-coupon suspend', 'title' => __l('Suspend')));?></span>
                						<?php endif;?>
                                        </span>
                                        
                                    </li>
                                   
						           
								</ul>
							</div>
							<div class="action-right-block  clearfix">
							   <div class="clearfix">
							     <div class="action-right">
                                       <h3><?php echo __l('Count'); ?></h3>
                                       <dl class="clearfix">
        								   <dt><?php echo __l('Coupon Feedback'); ?></dt>
                                           <dd>
												<?php echo $this->Html->link($coupon['Coupon']['coupon_feedback_count'], array('controller' => 'coupon_feedbacks', 'action' => 'index', 'coupon_id' => $coupon['Coupon']['id'], 'admin' => true), array('class' => 'js-admin-coupon_feedbacks', 'title' => $coupon['Coupon']['coupon_feedback_count']));?>
											</dd>
        								   <dt><?php echo __l('Coupon Worked'); ?></dt>
        								   <dd><?php echo $coupon['Coupon']['coupon_worked_count'];?></dd>
        								   <dt><?php echo __l('Coupon Not Worked'); ?></dt>
        								   <dd><?php echo $coupon['Coupon']['coupon_not_worked_count'];?></dd>
        								   <dt><?php echo __l('Impression'); ?></dt>
        								   <dd>
												<?php echo $this->Html->link($coupon['Coupon']['coupon_impression_count'], array('controller' => 'coupon_impressions', 'action' => 'index', 'coupon_id' => $coupon['Coupon']['id'], 'admin' => true), array('class' => 'js-admin-coupon_impression', 'title' => $coupon['Coupon']['coupon_impression_count']));?>
											</dd>
        								   <dt><?php echo __l('Comment'); ?></dt>
        								   <dd>
												<?php echo $this->Html->link($coupon['Coupon']['coupon_comment_count'], array('controller' => 'coupon_comments', 'action' => 'index', 'coupon_id' => $coupon['Coupon']['id'], 'admin' => true), array('class' => 'js-admin-coupon_comment', 'title' => $coupon['Coupon']['coupon_comment_count']));?>
											</dd>
        								   <dt><?php echo __l('Tag'); ?></dt>
        								   <dd><?php echo $coupon['Coupon']['coupon_tag_count'];?></dd>
        								   <dt><?php echo __l('View'); ?></dt>
        								   <dd><?php echo $coupon['Coupon']['coupon_view_count'];?></dd>
        								   <dt><?php echo __l('Favorite'); ?></dt>
        								   <dd>
												<?php echo $this->Html->link($coupon['Coupon']['coupon_favorite_count'], array('controller' => 'coupon_favorites', 'action' => 'index', 'coupon_id' => $coupon['Coupon']['id'], 'admin' => true), array('class' => 'js-admin-coupon_favorite', 'title' => $coupon['Coupon']['coupon_favorite_count']));?>	
										   </dd>
        								</dl>
                                 </div>
                                  <?php if(!empty($coupon['Ip']['ip'])):?>
                                   <div class="action-right action-right1">
                                    <h3><?php echo __l('Auto detected'); ?></h3>
                                       <dl class="clearfix">
        								   <dt><?php echo __l('IP');?></dt>
                                           <dd><?php echo !empty($coupon['Ip']['ip']) ? $this->Html->cText($coupon['Ip']['ip']) : '-'; ?></dd>
        								   <dt><?php echo __l('City');?></dt>
        								   <dd><?php echo !empty($coupon['Ip']['City']['name']) ? $this->Html->cText($coupon['Ip']['City']['name']) : '-'; ?></dd>
        								   <dt><?php echo __l('State');?></dt>
        								   <dd><?php echo !empty($coupon['Ip']['State']['name']) ? $this->Html->cText($coupon['Ip']['State']['name']) : '-'; ?></dd>
        								   <dt><?php echo __l('Country');?></dt>
        								   <dd><?php echo !empty($coupon['Ip']['Country']['name']) ? $this->Html->cText($coupon['Ip']['Country']['name']) : '-'; ?></dd>
        								    <dt><?php echo __l('Latitude');?></dt>
        								    <dd><?php echo !empty($coupon['Ip']['latitude']) ? $this->Html->cText($coupon['Ip']['latitude']) : '-'; ?></dd>
        								    <dt><?php echo __l('Longitude');?></dt>
        								   <dd><?php echo !empty($coupon['Ip']['longitude']) ? $this->Html->cText($coupon['Ip']['longitude']) : '-'; ?></dd>
        								</dl>
                                   </div>
                                   <?php endif;?>
                                    </div>
                                   <div class="city-action">
                                        <dl class="clearfix">
                                        <dt><?php echo $this->Paginator->sort(__l('URL'),'url');?></dt>
                                        <dd>
											<?php $url = str_replace('&', '&amp;', $coupon['Coupon']['url']);?>
											<a href="<?php echo $url;?>" target="_blank"><?php echo $url;?></a>
										</dd>
                                          <dt><?php echo __l('Status: '); ?> </dt>
                                            <dd>
                                            <div class="clearfix">
                                               	<span class="mark-deleted">
                    							<?php
                    								if($coupon['Coupon']['status_id'] ==ConstStatuses::Expired):
                    									echo __l('Marked as deleted');
                    								endif;
                    							?>
    					                        </span>
                        						<span class="<?php echo $class_type_status; ?>"><?php echo  $couponstatustype; ?></span>
                        						<span class="<?php echo $class_status; ?>"><?php echo  $couponstatus; ?></span>
                    						    <span class="<?php echo !empty($class_type)?$class_type:''; ?>"><?php echo  $coupon_type; ?></span>
                        						<?php if($coupon['Coupon']['is_partner']) : ?>
                        						<span class="partner"><?php echo  __l('Partner'); ?></span>
                        						<?php endif; ?>
												<?php
													if($coupon['Coupon']['admin_suspend']):
														echo '<span class="suspended">'.__l('Admin Suspended').'</span>';
													else:
														if(!empty($coupon['CouponFlag'])):
															echo '<span class="flagged">'.__l('Flagged').'</span>';
														endif;
														if($coupon['Coupon']['is_system_flagged']):
															echo '<span class="system-flagged">'.__l('System Flagged').'</span>';
														endif;
													endif;
												?>
                                             </div>
                                            </dd>
                                        </dl>
                                    </div>
                                     
                                 </div>
                                 <div class="action-right4 action-right-block">
                                     <div class="store-img-block">
                                      	<?php
                    						$coupon['Store']['Attachment'] = !empty($coupon['Store']['Attachment']) ? $coupon['Store']['Attachment'] : array();
                    						echo $this->Html->link($this->Html->showImage('Store', $coupon['Store']['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($coupon['Coupon']['title'], false)), 'title' => $this->Html->cText($coupon['Coupon']['title'], false))), array('controller' => 'stores', 'action' => 'view', $coupon['Store']['slug'],'admin' => false), array('escape' => false));
                    					?>
                                     </div>
                                     <dl class="clearfix">
                                            <dt><?php echo __l('Added 0n').': '?>  </dt>
                                            <dd><?php echo $this->Html->cDateTimeHighlight($coupon['Coupon']['created']); ?> </dd>
                                          
                                         <dt><?php echo $this->Paginator->sort(__l('Username'),'user_id');?></dt>
                                         <dd><?php echo $this->Html->link($coupon['User']['username'], array('controller'=>'user','action'=>'view',$coupon['User']['username'],'admin' => false), array('class' => $class, 'title' => $coupon['User']['username']));?></dd>
                                         <dt><?php echo $this->Paginator->sort('category_id');?></dt>
                                         <dd><?php echo $this->Html->link($this->Html->cText($coupon['Category']['title']), array('controller'=> 'coupons', 'action'=>'index', 'category' =>$coupon['Category']['slug']), array('escape' => false));?></dd>
                                         <dt><?php echo $this->Paginator->sort(__l('Coupon Code'),'coupon_code');?></dt>
                                         <dd><?php echo $this->Html->cText($coupon['Coupon']['coupon_code']);?></dd>
                                          </dl>
                                    </div>

                        </div>
                    </td>
			 </tr>
		<?php
				endforeach;
			else:
		?>
			<tr class="js-odd">
				<td colspan="31" class="notice"><?php echo __l('No Coupons available');?></td>
			</tr>
		<?php
			endif;
		?>
		</table>
	</div>
	<?php if (!empty($coupons)): ?>
	   <div class="clearfix">
		<div class="admin-select-block grid_left">
			<div>
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
			</div>
			<div class="admin-checkbox-button">
				<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- Change Coupon Status --'))); ?>
			</div>
		</div>
		<div class="grid_right"><?php echo $this->element('paging_links'); ?></div>
		</div>
		<div class="hide">
			<?php echo $this->Form->submit('Submit');  ?>
		</div>
	<?php endif; ?>
    <?php echo $this->Form->end(); ?>
</div>
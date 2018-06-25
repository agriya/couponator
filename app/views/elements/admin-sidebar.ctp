<h5 class="hidden-info"><?php echo __l('Admin side links'); ?></h5>
<ul class="admin-links clearfix">
	<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_stats') ? ' admin-active' : null; ?>
	<li class="no-bor<?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center home">
					<em><?php echo __l('Dashboard'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<h4><?php echo __l('Dashboard '); ?></h4>
								<ul>
									<li> <?php echo $this->Html->link(__l('Snapshot'), array('controller' => 'users', 'action' => 'stats'), array('title' => __l('Snapshot'))); ?></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('users', 'user_profiles',  'user_logins',  'user_comments',  'user_views');
		$class = (in_array( $this->request->params['controller'], $controller) && !in_array($this->request->params['action'], array('admin_logs', 'admin_stats', 'admin_diagnostics'))) ? ' admin-active' : null;
	?>
	<li class="no-bor<?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center users">
                     <em><?php echo __l('Users'); ?></em>
                 </span>
            </span>
         </span>
		 <div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<h4><?php echo __l('Users'); ?></h4>
								<ul>
                        		   <?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_index') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Users'), array('controller' => 'users', 'action' => 'index'),array('title' => __l('Users'))); ?></li>                        			
								</ul>
							</li>
							<li>
								<h4><?php echo __l('Activities'); ?></h4>
								<ul>                        		   
                        			<?php $class = ($this->request->params['controller'] == 'user_logins') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('User Logins'), array('controller' => 'user_logins', 'action' => 'index'),array('title' => __l('User Logins'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'user_comments') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('User Comments'), array('controller' => 'user_comments', 'action' => 'index'),array('title' => __l('User Comments'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'user_views') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('User Views'), array('controller' => 'user_views', 'action' => 'index'),array('title' => __l('User Views'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_send_mail') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Send Email to Users'), array('controller' => 'users', 'action' => 'send_mail'),array('title' => __l('Send Email to Users'))); ?></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('coupons', 'coupon_feedbacks',  'coupon_comments',  'coupon_impressions',  'coupon_favorites', 'coupon_flags');
		$class = (in_array( $this->request->params['controller'], $controller)) ? ' admin-active' : null;
	?>
	<li class="no-bor<?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center sightings">
					<em><?php echo __l('Coupons'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<h4><?php echo __l('Coupons'); ?></h4>
								<ul>
									<?php $class = ($this->request->params['controller'] == 'coupons'  && $this->request->params['action'] == 'admin_index' ) ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupons'), array('controller' => 'coupons', 'action' => 'index'),array('title' => __l('Coupons'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'coupons' && $this->request->params['action'] == 'admin_add' ) ? ' class="active sub-link clearfix"' : ' class=" sub-link clearfix"'; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Add Coupon'), array('controller' => 'coupons', 'action' => 'add'), array('title' => __l('Coupon Add'))); ?>
                                    <span class="sub-link-info"><?php echo $this->Html->link(__l('CSV Import'), array('controller' => 'coupons', 'action' => 'admin_import'),array('title' => __l('CSV Import'))); ?></span></li>
                        			<?php $class = ($this->request->params['controller'] == 'coupon_feedbacks') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupon Feedbacks'), array('controller' => 'coupon_feedbacks', 'action' => 'index'),array('title' => __l('Coupon Feedbacks'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'coupon_comments') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupon Comments'), array('controller' => 'coupon_comments', 'action' => 'index'),array('title' => __l('Coupon Comments'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'coupon_impressions') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupon Impressions'), array('controller' => 'coupon_impressions', 'action' => 'index'),array('title' => __l('Coupon Impressions'))); ?></li>
                        			<?php $class = ($this->request->params['controller'] == 'coupon_favorites') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupon Favorites'), array('controller' => 'coupon_favorites', 'action' => 'index'),array('title' => __l('Coupon Favorites'))); ?></li>
                        			<?php if (Configure::read('coupon.is_allow_coupon_flag')): ?>
                        			<?php $class = ($this->request->params['controller'] == 'coupon_flags') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupon Flags'), array('controller' => 'coupon_flags', 'action' => 'index'),array('title' => __l('Coupon Flags'))); ?></li>
                        			<?php endif; ?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('stores', 'store_views');
		$class = (in_array( $this->request->params['controller'], $controller)) ? ' admin-active' : null;
	?>
	<li class="no-bor<?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center places">
					<em><?php echo __l('Stores'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<h4> <?php echo __l('Stores'); ?></h4>
								<ul>
									<?php $class = ($this->request->params['controller'] == 'stores'  && $this->request->params['action'] == 'admin_index') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Stores'), array('controller' => 'stores', 'action' => 'index'),array('title' => __l('Stores'))); ?>
                                    </li>
                                    <?php $class = ($this->request->params['controller'] == 'stores'  && $this->request->params['action'] == 'admin_add') ? ' class="active sub-link clearfix"' : ' class="sub-link clearfix"'; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Add Store'), array('controller' => 'stores', 'action' => 'add'),array('title' => __l('Add Store'))); ?><span class="sub-link-info"><?php echo $this->Html->link(__l('CSV Import'), array('controller' => 'stores', 'action' => 'admin_import'),array('title' => __l('CSV Import'))); ?></span></li>
                        			<?php $class = ($this->request->params['controller'] == 'store_views') ? ' class="active"' : null; ?>
                        			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Store Views'), array('controller' => 'store_views', 'action' => 'index'),array('title' => __l('Store Views'))); ?></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('subscriptions');
		$class = (in_array( $this->request->params['controller'], $controller)) ? ' admin-active' : null;
	?>
	
	<li class="no-bor<?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center guides">
					<em><?php echo __l('Subscriptions'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<h4><?php echo __l('Subscriptions'); ?></h4>
								<ul>
									<?php $class = ($this->request->params['controller'] == 'subscriptions'  && $this->request->params['action'] == 'admin_index') ? ' class="active"' : null; ?>
									<li <?php echo $class;?>><?php echo $this->Html->link(__l('Subscriptions'), array('controller' => 'subscriptions', 'action' => 'index'),array('title' => __l('Subscriptions'))); ?></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('google_ads');
		$class = (in_array( $this->request->params['controller'], $controller)) ? ' admin-active' : null;
	?>
	<li class="no-bor<?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center settings">
					<em><?php echo __l('Google Ads'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<h4><?php echo __l('Google Ads'); ?></h4>
								<ul>
									<?php $class = ($this->request->params['controller'] == 'google_ads') ? ' class="active"' : null; ?>
									<li <?php echo $class;?>><?php echo $this->Html->link(__l('Google Ads'), array('controller' => 'google_ads', 'action' => 'index'), array('title' => __l('Google Ads')));?></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('settings');
		$class = (in_array( $this->request->params['controller'], $controller)) ? ' admin-active' : null;
	?>
	<li class="masters  setting-masters-block masters-block <?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center settings1">
					<em><?php echo __l('Settings'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-top-lblock">
				<div class="admin-top-rblock">
					<div class="admin-top-cblock"></div>
				</div>
			</div>
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul class="admin-sub-links clearfix">
							<li>
								<ul>
									<li class="setting-overview setting-overview1 clearfix"><?php echo $this->Html->link(__l('Setting Overview'), array('controller' => 'settings', 'action' => 'index'),array('title' => __l('Setting Overview'), 'class' => 'setting-overview')); ?></li>
									<li>
										<h4 class="setting-title"><?php echo __l('Settings'); ?></h4>
										<ul>
											<li class="admin-sub-links-left">
												<ul>
													<li>
														<ul>
															<li><?php echo $this->Html->link(__l('System'), array('controller' => 'settings', 'action' => 'edit', 1),array('title' => __l('System'))); ?></li>
															<li><?php echo $this->Html->link(__l('Developments'), array('controller' => 'settings', 'action' => 'edit', 2),array('title' => __l('Developments'))); ?></li>
															<li><?php echo $this->Html->link(__l('SEO'), array('controller' => 'settings', 'action' => 'edit', 3),array('title' => __l('SEO'))); ?></li>
															<li><?php echo $this->Html->link(__l('Regional, Currency & Language'), array('controller' => 'settings', 'action' => 'edit', 4),array('title' => __l('Regional, Currency & Language'))); ?></li>
															<li><?php echo $this->Html->link(__l('Account '), array('controller' => 'settings', 'action' => 'edit', 5),array('title' => __l('Account'))); ?></li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="admin-sub-links-right">
												<ul>
													<li>
														<ul>
															<li><?php echo $this->Html->link(__l('Coupons'), array('controller' => 'settings', 'action' => 'edit', 6),array('title' => __l('Coupons'))); ?></li>
															<li><?php echo $this->Html->link(__l('Affiliates'), array('controller' => 'settings', 'action' => 'edit', 7),array('title' => __l('Affiliates'))); ?></li>
															<li><?php echo $this->Html->link(__l('Third Party API'), array('controller' => 'settings', 'action' => 'edit', 8),array('title' => __l('Third Party API'))); ?></li>
															<li><?php echo $this->Html->link(__l('Suspicious Word Detector'), array('controller' => 'settings', 'action' => 'edit', 9),array('title' => __l('Suspicious Word Detector'))); ?></li>
															<li><?php echo $this->Html->link(__l('Google Ads'), array('controller' => 'settings', 'action' => 'edit', 10),array('title' => __l('Google Ads'))); ?></li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
	<?php
		$controller = array('cities', 'countries', 'states', 'banned_ips', 'languages', 'translations', 'pages', 'email_templates', 'categories', 'ips');
		$class = (in_array( $this->request->params['controller'], $controller)) ? ' admin-active' : null;
	?>
	<li class="masters setting-masters-block <?php echo $class;?>">
		<span class="amenu-left">
			<span class="amenu-right">
				<span class="menu-center masters">
					<em><?php echo __l('Masters'); ?></em>
				</span>
			</span>
		</span>
		<div class="admin-sub-block">
			<div class="admin-sub-lblock">
				<div class="admin-sub-rblock">
					<div class="admin-sub-cblock">
						<ul>
							<li>
								<div class="page-info master-page-info"><?php echo __l('Warning! Please edit with caution.');?></div>
								<ul class="clearfix">
									<li class="admin-sub-links-left">
										<h4><?php echo __l('Regional'); ?></h4>
										<ul>
											<li><?php echo $this->Html->link(__l('Cities'), array('controller' => 'cities', 'action' => 'index'),array('title' => __l('Cities'))); ?></li>
											<li><?php echo $this->Html->link(__l('Countries'), array('controller' => 'countries', 'action' => 'index'),array('title' => __l('Countries'))); ?></li>
											<li><?php echo $this->Html->link(__l('States'), array('controller' => 'states', 'action' => 'index'),array('title' => __l('States'))); ?></li>
											<li><?php echo $this->Html->link(__l('Banned IPs'), array('controller' => 'banned_ips', 'action' => 'index'),array('title' => __l('Banned IPs'))); ?></li>
										</ul>
										<h4><?php echo __l('Languages'); ?></h4>
										<ul>
											<li><?php echo $this->Html->link(__l('Languages'), array('controller' => 'languages', 'action' => 'index'),array('title' => __l('Languages'))); ?></li>
											<li><?php echo $this->Html->link(__l('Translations'), array('controller' => 'translations', 'action' => 'index'),array('title' => __l('Translations'))); ?></li>
										</ul>
									</li>
									<li class="admin-sub-links-right">
										<h4><?php echo __l('Static pages'); ?></h4>
										<ul>
											<li><?php echo $this->Html->link(__l('Manage Static Pages'), array('controller' => 'pages', 'action' => 'index', 'plugin' => NULL),array('title' => __l('Manage Static Pages')));?></li>
										</ul>
										<h4><?php echo __l('Email'); ?></h4>
										<ul>
											<li><?php echo $this->Html->link(__l('Email Templates'), array('controller' => 'email_templates', 'action' => 'index'),array('title' => __l('Email Templates'))); ?></li>
										</ul>
										<h4><?php echo __l('Others'); ?></h4>
										<ul>
											<li><?php echo $this->Html->link(__l('Categories'), array('controller' => 'categories', 'action' => 'index'), array('title' => __l('Categories'))); ?></li>
											<li><?php echo $this->Html->link(__l('IPs'), array('controller' => 'ips', 'action' => 'index'), array('title' => __l('IPs'))); ?></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="admin-bot-lblock">
				<div class="admin-bot-rblock">
					<div class="admin-bot-cblock"></div>
				</div>
			</div>
		</div>
	</li>
</ul>
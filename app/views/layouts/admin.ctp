<?php
/* SVN FILE: $Id: admin.ctp 1240 2009-12-23 11:33:56Z arivuchelvan_086at09 $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo sprintf(__l('Admin - %s'), $this->Html->cText($title_for_layout, false)); ?></title>
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
		echo $this->Html->css('admin.cache', null, array('inline' => true));
		$js_inline = "document.documentElement.className = 'js';";
		$js_inline .= 'var cfg = ' . $this->Javascript->object($js_vars_for_layout) . ';';
		$js_inline .= "(function() {";
		$js_inline .= "var js = document.createElement('script'); js.type = 'text/javascript'; js.async = true;";
		if (!$_jsPath = Configure::read('cdn.js')) {
			$_jsPath = Router::url('/', true);
		}
		$js_inline .= "js.src = \"" . $_jsPath . 'js/default.cache.js' . "\";";
		$js_inline .= "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(js, s);";
		$js_inline .= "})();";
		echo $this->Javascript->codeBlock($js_inline, array('inline' => true));
	?>
</head>
<body>
<div id="<?php echo $this->Html->getUniquePageId();?>" class="admin-content admin-content-block">
	<?php if ($this->Session->check('Message.error') || $this->Session->check('Message.success') || $this->Session->check('Message.flash')): ?>
		<div class="js-flash-message flash-message-block">
			<?php
				if ($this->Session->check('Message.error')):
					echo $this->Session->flash('error');
				endif;
				if ($this->Session->check('Message.success')):
					echo $this->Session->flash('success');
				endif;
				if ($this->Session->check('Message.flash')):
					echo $this->Session->flash();
				endif;
			?>
		</div>
	<?php endif; ?>
  	<div class="admin-container-24">
			<div class="clearfix" id="header">
				<div class="clearfix">
					<h1 class="grid_5 mega alpha">
						<?php echo $this->Html->link((Configure::read('site.name').' '.'<span>Admin</span>'), array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('escape' => false, 'title' => (Configure::read('site.name').' '.'Admin')));?>
					</h1>
					<ul class="admin-menu clearfix">
						<li class="view-site"><?php echo $this->Html->link(__l('Visit site'), '/', array('title' => __l('Visit site')));?></li>
						<li><?php echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true),array('title' => __l('Diagnostics'))); ?></li>
						<li><?php echo $this->Html->link(__l('Tools'), array('controller' => 'pages', 'action' => 'display', 'tools', 'admin' => true), array('escape' => false, 'title' => __l('View Site')));?></li>
						<li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id')), array('title' => __l('My Account')));?></li>
						<li><?php echo $this->Html->link(__l('Change Password'), array('controller' => 'users', 'action' => 'admin_change_password'), array('title' => __l('Change Password')));?></li>
						<li class="logout"><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('title' => __l('Logout')));?></li>
					</ul>
				</div>
				<?php echo $this->element('admin-sidebar', array('config' => 'sec')); ?>
			</div>
			<div id="main" class="clearfix">
				<?php
					$user_menu = array('users', 'user_profiles', 'user_logins', 'user_comments', 'user_views');
					$coupons_menu = array('coupons', 'coupon_feedbacks',  'coupon_comments',  'coupon_impressions','coupon_favorites','coupon_flags');
					$stores_menu = array('stores', 'store_views');
					$subscriptions_menu = array('subscriptions');
					$google_ads_menu =  array('google_ads');
					$settings_menu = array('settings');
					$master_menu = array('currencies', 'email_templates',  'pages', 'translations', 'languages', 'banned_ips', 'cities', 'states', 'countries', 'genders', 'categories', 'ips');
					$search_keywords_menu = array('search_keywords');
					$devs_menu = array('devs');
					$search_logs_menu = array('search_logs');
					if (($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_referred_users') || ($this->request->params['controller'] == 'deal_users' && $this->request->params['action'] == 'admin_referral_commission')) {
						$class = "referral-title";
					} elseif(in_array($this->request->params['controller'], $user_menu) && $this->request->params['action'] != 'admin_diagnostics') {
						$class = "users-title";
					} elseif(in_array($this->request->params['controller'], $coupons_menu)) {
						$class = "coupons-title";
					} elseif(in_array($this->request->params['controller'], $stores_menu)) {
						$class = "stores-title";
					} elseif(in_array($this->request->params['controller'], $subscriptions_menu)) {
						$class = "subscriptions-title";
					}elseif(in_array($this->request->params['controller'], $master_menu)) {
						$class = "master-title";
					} elseif(in_array($this->request->params['controller'], $google_ads_menu)) {
						$class = "google_ads-title";
					} elseif(in_array($this->request->params['controller'], $settings_menu)) {
						$class = "settings-title";
					}elseif(in_array($this->request->params['controller'], $search_keywords_menu)) {
						$class = "diagnostics-title";
					}elseif(in_array($this->request->params['controller'], $devs_menu)) {
						$class = "diagnostics-title";
					}elseif(in_array($this->request->params['controller'], $search_logs_menu)) {
						$class = "diagnostics-title";
					}elseif($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_diagnostics') {
						$class = "diagnostics-title";
					}
					if ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_stats') {
						echo $content_for_layout;
					}  else {
				?>
					<div class="admin-side1-tc page-title-info">
						<h2 class="<?php echo $class; ?>">
							<?php if($this->request->params['controller'] == 'settings' && $this->request->params['action'] == 'index') { ?>
								<?php echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'), array('title' => __l('Back to Settings')));?>
							<?php } elseif($this->request->params['controller'] == 'settings' && $this->request->params['action'] == 'admin_edit' ) { ?>
								<?php echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'), array('title' => __l('Back to Settings')));?> &raquo; <?php echo $setting_category['SettingCategory']['name']; ?>
							<?php } elseif(in_array($this->request->params['controller'], $search_logs_menu)) { ?>
								<?php echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true), array('title' => __l('Diagnostics')));?> &raquo; <?php echo $this->pageTitle;?>
							<?php } elseif(in_array($this->request->params['controller'], $search_keywords_menu)) { ?>
								<?php echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true), array('title' => __l('Diagnostics')));?> &raquo; <?php echo $this->pageTitle;?>
							<?php } elseif(in_array($this->request->params['controller'], $devs_menu)) { ?>
								<?php echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true), array('title' => __l('Diagnostics')));?> &raquo; <?php echo $this->pageTitle;?>
							<?php } else { ?>
								<?php echo $this->pageTitle;?>
							<?php } ?>
							<?php if($this->request->params['controller'] == 'settings') { ?>
								<span class="setting-info info"><?php echo __l('To reflect setting changes, you need to') . ' ' . $this->Html->link(__l('clear cache'), array('controller' => 'devs', 'action' => 'clear_cache', '?f=' . $this->request->url), array('title' => __l('clear cache'), 'class' => 'js-delete'));  ?>.</span>
							<?php } ?>
						</h2>
					</div>
					<div class="admin-center-block clearfix">
						<div>
							<?php echo $content_for_layout; ?>
						</div>
					</div>
				<?php } ?>
			</div>

			
		</div>
		<div class="clearfix" id="footer">
			<div class="footer-wrap admin-footer clearfix">
						<div id="agriya" class="clearfix grid_left copywrite-info">
						<p>&copy;<?php echo date('Y');?> <?php echo $this->Html->link(Configure::read('site.name'), Router::Url('/',true), array('title' => Configure::read('site.name'), 'escape' => false));?>. <?php echo __l('All rights reserved');?>.</p>
						<p class="powered clearfix"><span><a href="http://couponator.dev.agriya.com/" title="<?php echo __l('Powered by Couponator');?>" target="_blank" class="powered"><?php echo __l('Powered by Couponator');?></a>,</span> <span><?php echo __l('made in'); ?></span> <?php echo $this->Html->link('Agriya Web Development', 'http://www.agriya.com/', array('target' => '_blank', 'title' => 'Agriya Web Development', 'class' => 'company'));?>  <span><?php echo Configure::read('site.version');?></span></p>
						<p><?php echo $this->Html->link('CSSilized by CSSilize, PSD to XHTML Conversion', 'http://www.cssilize.com/', array('target' => '_blank', 'title' => 'CSSilized by CSSilize, PSD to XHTML Conversion', 'class' => 'cssilize'));?></p>
					</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('site_tracker', array('config' => 'sec'));?>
	<?php echo $this->element('sql_dump', array('config' => 'sec')); ?>
</body>
</html>
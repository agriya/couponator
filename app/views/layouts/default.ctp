<?php
/* SVN FILE: $Id: default.ctp 2093 2010-01-18 08:58:31Z bharathdayal_092at09 $ */
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
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo $this->Html->cText($title_for_layout, false);?></title>	 
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
		echo $this->Html->css('default.cache', null, array('inline' => true));
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
		// For other than Facebook (facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)), wrap it in comments for XHTML validation...
		if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
			echo '<!--', "\n";
		endif;
	?>
<meta content="<?php echo Configure::read('facebook.app_id');?>" property="og:app_id" />
<meta content="<?php echo Configure::read('facebook.app_id');?>" property="fb:app_id" />
<?php if(!empty($meta_for_layout['store_name'])):?>
<meta property="og:site_name" content="<?php echo Configure::read('site.name'); ?>"/>
<meta property="og:title" content="<?php echo $meta_for_layout['store_name'];?>"/>
<?php endif;?>
<?php if(!empty($meta_for_layout['store_image'])):?>
<meta property="og:image" content="<?php echo $meta_for_layout['store_image'];?>"/>
<?php else:?>
<meta property="og:image" content="<?php echo Router::url(array(
'controller' => 'img',
'action' => 'logo.png',
'admin' => false
) , true);?>"/>
<?php endif;?>
	<?php
	if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
		echo '-->', "\n";
	endif;
	?>
<?php
		echo $this->element('site_tracker', array('config' => 'sec'));
	?>
	<link href="<?php echo Router::url('/', true) . 'coupons/store.rss';?>" type="application/rss+xml" rel="alternate" title="RSS Feeds" target="_blank" />
</head>
<body>
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
 
	<div id="<?php echo $this->Html->getUniquePageId();?>" class="content">
		<?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
	   <div class="clearfix admin-wrapper">
    			<h1 class="admin-site-logo">
					<?php echo $this->Html->link((Configure::read('site.name').' '.'<span>Admin</span>'), array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('escape' => false, 'title' => (Configure::read('site.name').' '.'Admin')));?>
                </h1>
                <p class="logged-info">
                <?php echo __l(' You are logged in as Admin');?>

                </p>
    			<ul class="admin-menu clearfix">
    			 	<li class="logout"><span><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('title' => __l('Logout')));?></span></li>
				</ul>
	   </div>
	<?php endif; ?>
		<div id="header">
			<div class="header-content container_12">
				<div class="search-block clearfix">
					<h1 class="grid_left "><?php echo $this->Html->link(__l('Home'), Router::url('/',true), array('title' => Configure::read('site.name')));?></h1>
					<?php
						if(($this->request->params['controller'] == 'coupons' && $this->request->params['action'] =='index' && !empty($this->request->params['named']['view']) && $this->request->params['named']['view'] =='print') || (!empty($this->request->params['named']['what'])) || (!empty($this->request->params['named']['where'])) || $this->request->params['controller'] == 'coupons' && $this->request->params['action'] =='search' || !empty($this->request->params['named']['category']) || !empty($this->request->params['named']['coupon_store'])):
							if(isset($this->request->params['named']['what'])):
								$what = $this->request->params['named']['what'];
							else:
								$what = '';
							endif;
							if(isset($this->request->params['named']['where'])):
								$where = $this->request->params['named']['where'];
							else:
								$where = '';
							endif;
							echo $this->element('coupon-search', array('config' => 'sec', 'view' => 'print', 'what' => $what, 'where' => $where));
						else:
							echo $this->element('coupon-search', array('config' => 'sec'));
						endif;
					?>
				</div>
				<div class="menu-block clearfix">
					<ul class="menu clearfix">						
						<?php 
							if($this->request->params['controller'] == 'pages' && $this->request->params['action'] =='display' &&  isset(			$this->request->params['pass']['0']) && $this->request->params['pass']['0']=='home'){
								$class = 'class="active"';
							} elseif($this->request->params['controller'] == 'coupons' && $this->request->params['action'] =='lst') {
								$class = 'class="active"';
							} else {
								$class = '';
							}
						?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Coupon Codes'), Router::url('/',true), array('title' => __l('Coupon Codes')));?></li>
						<?php $class = ($this->request->params['controller'] == 'stores') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Stores'), array('controller' => 'stores', 'action' => 'index', 'admin' => false), array('title' => __l('Stores')));?></li>
						<?php $class = ($this->request->params['controller'] == 'coupons' && $this->request->params['action'] == 'index' && isset($this->request->params['named']['view']) && $this->request->params['named']['view'] == 'print') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Printable Coupons'), array('controller' => 'coupons', 'action' => 'index', 'view'=> 'print','admin' => false), array('title' => __l('Printable Coupons')));?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'index' && $this->request->params['named']['shared'] == 'shared') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Community'), array('controller' => 'users', 'action' => 'index','shared'=>'shared','admin' => false), array('title' => __l('Community')));?></li>
					</ul>
			     	<?php $languages = $this->Html->getLanguage();
							if(Configure::read('user.is_allow_user_to_switch_language') && !empty($languages)) : ?>
				 	          <div class="clearfix language-form-block grid_left">
					      <?php echo $this->Form->create('Language', array('action' => 'change_language', 'class' => 'normal'));
								echo $this->Form->input('language_id', array('label'=>__l('Language'),'class' => 'js-autosubmit', 'empty' => __l('Please Select'), 'options' => $languages, 'value' => isset($_COOKIE['CakeCookie']['user_language']) ?  $_COOKIE['CakeCookie']['user_language'] : Configure::read('site.language')));
								echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); 
				       		?>
						<div class="hide">
							<?php echo $this->Form->submit('Submit');  ?>
						</div>
						<?php
								echo $this->Form->end(); ?>
									</div>
						<?php	endif;	?>
				
				
						<?php if(!$this->Auth->sessionValid()): ?>
						<div class="sign-in grid_right">
							<?php echo __l('Join the crew:'); ?>
							<?php echo $this->Html->link(__l('sign in to the community'), array('controller' => 'users', 'action' => 'login','admin'=>false), array('title' => __l('sign in to the community'))); ?>
                        </div>
                    	<?php else: ?>
                    	<ul class="sign-in grid-right">
                    	   <li>
							<?php
								echo $this->Html->getUserAvatar($this->Auth->user('id'), 'nano_thumb');
								echo ucfirst($this->Auth->user('username'));?>:
							</li>
							<li>
                                 <?php echo $this->Html->link(__l('View your profile'), array('controller' => 'users', 'action' => 'view',$this->Auth->user('username')), array('title' => __l('View your profile')));?> |
                            </li>
                            <li>
                                 <?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('title' => __l('Logout')));
							?>
							</li>
							</ul>
						<?php endif; ?>		
				
				
				</div>
			</div>
		</div>
		<div id="main" class="clearfix container_12 js-lazyload">
			<div class="side1 grid_8 omega alpha">
				<!-- Center area -->
				<?php echo $content_for_layout;?>
			</div>
			<div class="side2 grid_4 omega alpha">
				<?php
					$page_url = $this->request->params['controller'].'/'.$this->request->params['action'];
					switch ($page_url) :
						case 'pages/display' :
							if(isset($this->request->params['pass']['0']) && $this->request->params['pass']['0']=='home'):
								echo $this->element('../subscriptions/add', array('config' => 'sec'));
								if(!empty($q)):
									echo $this->element('coupon_tags-index', array('config' => 'sec', 'q' => $q));
								else:
									echo $this->element('coupon_tags-index', array('config' => 'sec'));
								endif;						
								echo $this->element('free-shipping', array('config' => 'sec'));
								echo $this->element('power-tool', array('config' => 'sec'));
							endif;
							break;
						case 'stores/search':
							echo $this->element('free-shipping', array('config' => 'sec')); 
							echo $this->element('power-tool', array('config' => 'sec'));
							break;
						case 'pages/view' :
						case 'contacts/add' :
						case 'user_profiles/edit' :
						case 'subscriptions/add' :
							echo $this->element('power-tool', array('config' => 'sec'));						  
							break;
						case 'coupons/index' :
							if ((!empty($this->request->params['named']['view']) && $this->request->params['named']['view']=='print') || (!empty($this->request->params['named']['category'])) || !empty($this->request->params['named']['what']) || !empty($this->request->params['named']['where'])) {
								echo $this->element('categories-index',array('config' => 'sec'));
							}
							if (isset($this->request->params['named']['where'])) {
								$is_valid = preg_match("/^([0-9]{6})(-[0-9]{4})?$/i",$this->request->params['named']['where']);
								if ($is_valid) {
									echo $this->element('top-stores',array('config' => 'sec', 'zipcode' => $this->request->params['named']['where']));
								}
							}
							break;
						case 'coupons/search' :
							echo $this->element('categories-index', array('config' => 'sec'));
							if (isset($this->request->params['named']['where'])) {
								$is_valid = preg_match("/^([0-9]{6})(-[0-9]{4})?$/i",$this->request->params['named']['where']);
								if ($is_valid) {
									echo $this->element('top-stores',array('config' => 'sec', 'zipcode' => $this->request->params['named']['where']));
								}
							}
							break;
						case 'users/login':
						case 'coupons/lst':
						case 'stores/index':
							if (!empty($this->request->data['Store']['keyword']) || !empty($this->request->params['named']['tag'])) {
								if (!empty($this->request->data['Store']['keyword'])) {
									$keyword = $this->request->data['Store']['keyword'];
								} elseif (!empty($this->request->params['named']['tag'])) {
									$keyword = $this->request->params['named']['tag'];
								}
								echo $this->element('coupon_tags-index',array('config' => 'sec', 'q' => $keyword));   
								if (!empty($this->request->params['named']['tag'])):
									echo $this->element('top-stores',array('config' => 'sec', 'tag' => $this->request->params['named']['tag']));
								endif;
							} else {
								echo $this->element('../subscriptions/add', array('config' => 'sec'));
								if(!empty($q)):
									echo $this->element('coupon_tags-index',array('config' => 'sec', 'q' => $q));
								else:
									echo $this->element('coupon_tags-index',array('config' => 'sec'));
								endif;
								if (!empty($this->request->data['Store']['keyword']) || !empty($this->request->params['named']['tag'])):
									if (!empty($this->request->data['Store']['keyword'])) {
										$keyword = $this->request->data['Store']['keyword'];
									} elseif (!empty($this->request->params['named']['tag'])) {
										$keyword = $this->request->params['named']['tag'];
									}
								endif;
								echo $this->element('free-shipping', array('config' => 'sec'));
							}
							echo $this->element('power-tool', array('config' => 'sec'));
							break;
						case 'users/index':
							if (!empty($this->request->params['named']['shared'])) {
								if (!$this->Auth->sessionValid()) {
									echo $this->element('sign-in', array('config' => 'sec'));
								} else {
									echo $this->element('user-links',array('user' => 'compact', 'config' => 'sec'));
								}
					?>
								<div class="store-left">
                        	   	   <div class="store-right">
                        			<div class="store-center coupon-center">
									<h3><?php echo __l('Live chat'); ?></h3>
									<!-- BEGIN CBOX - www.cbox.ws - v001 -->
									<div id="cboxdiv" style="text-align: center; line-height: 0">
										<div><iframe frameborder="0" width="300" height="129" src="http://www4.cbox.ws/box/?boxid=3933120&amp;boxtag=4ww9l1&amp;sec=form" marginheight="2" marginwidth="2" scrolling="no" allowtransparency="yes" name="cboxform" style="border:#FFFFFF 1px solid;border-bottom:0px" id="cboxform"></iframe></div>
										<div><iframe frameborder="0" width="300" height="381" src="http://www4.cbox.ws/box/?boxid=3933120&amp;boxtag=4ww9l1&amp;sec=main" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="cboxmain" style="border:#F6F3E0 1px solid;" id="cboxmain"></iframe></div>
									</div>
									</div>
									</div>
									</div>
									<!-- END CBOX -->
									<div class="coupon-bottom"></div>
								
					<?php
							}
							break;
						case 'users/view' :
					?>
							<div class="view-discount-block coupon-codes-block">
								<h2><?php echo __l('Stats'); ?></h2>
								<div class="store-left">
									<div class="store-right">
										<div class="store-center clearfix">
											<div class="states-inner-block">
												<div class="clearfix user-points-block">
													<div class="user-points">
														<strong><?php echo $user['User']['coupon_points']; ?></strong><?php echo ' ' . __l('points'); ?>
														<p class="explanation-info"><?php echo $this->Html->link(__l('Explanation'), '#', array('class'=>'explanation js-explaination', 'title' => __l('Explanation'))); ?></p>
													</div>
													<dl class="community-list clearfix">
														<dt><?php echo __l("Community rank:"); ?></dt>
															<dd>
																<?php
																	$rank ='Not In Yet';
																	if ($user['User']['rank'] > 0) {
																		$rank = $user['User']['rank'];
																	}
																	echo $rank;
																?>
															</dd>
														<dt><?php echo __l('Points this week:'); ?></dt>
															<dd><?php echo $user['User']['coupon_points']; ?></dd>
														<dt><?php echo __l('Coupons used:'); ?></dt>
															<dd><?php echo $couponused ; ?></dd>
														<?php if (!Configure::read('coupon.is_downvote_restrict')):?>
														<dt><?php echo __l('Coupons rejected:'); ?></dt>
															<dd><?php echo $couponrejected ; ?></dd>
															<?php endif;?>
														<dt><?php echo __l('Coupons submitted:'); ?></dt>
															<dd><?php echo $couponsubmitted ; ?></dd>
														<dt><?php echo __l('Money saved:'); ?></dt>
															<dd><?php  echo $saved ; ?></dd>
														<dt><?php echo __l('Saved others:'); ?></dt>
															<dd><?php  echo $othersaved ; ?></dd>
														<dt><?php echo __l('Comments made:'); ?></dt>
															<dd><?php echo $commentsmade ; ?></dd>
													</dl>
												</div>
												<div class="states-information hide">
													<p><?php echo __l("You earn a point every time another user votes 'yes' for a coupon you've shared."); ?></p>
													<p><?php echo __l("Community members are ranked on the total points they've earned and can win great prizes and giveaways." );?></p>
													<p><?php echo __l("To earn points, simply find and share coupons with the community."); ?></p>
													<p><?php echo __l("Number of points are calculated hourly."); ?></p>
													<p><?php __l("Note: shopping tips do not count towards your points."); ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="coupon-bottom"></div>
							</div>
					<?php
						if ($this->request->params['controller']!='users' && $this->request->params['controller']!='view') {
							echo $this->element('coupons-add',array('type'=>'', 'config' => 'sec'));
						} else {

							echo $this->element('coupons-add',array('type'=>'user', 'config' => 'sec'));
						}
						echo $this->element('coupon_favorite-index',array('view_name'=>'favorite','username'=>$user['User']['username'],'config' => 'sec'));
						break;
					case 'users/register' :
						echo $this->element('sign-in', array('config' => 'sec'));
						break;
					case 'stores/view' :
					if(!empty($store)):
					?>
						<div class="sales-block coupon-codes-block">
							<?php echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'medium_big_thumb',  'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug'],'admin'=> false), array('escape' => false));  ?>
							<?php if (!empty($store['Coupon'][0])) { ?>
								<?php $tracking_url = Router::url(array('controller'=> 'coupons', 'action' => 'out', $store['Coupon'][0]['id']),true); ?>
								<a id="rev_<?php echo $store['Coupon'][0]['id'];?>" class="shop code-a copy {'id':'<?php echo $store['Coupon'][0]['id'];?>','showcode':'<?php echo ConstCouponDisplayTypes::ClickToCopy ;?>','copy':'<?php echo $store['Coupon'][0]['coupon_code'];?>','url':'<?php echo $store['Coupon'][0]['url'];?>','track_url': '<?php echo $tracking_url;?>'}" rel="nofollow" target="_blank" href="<?php echo $tracking_url;?>"><?php echo __l('Shop');?> <?php echo $store['Store']['url'];?> &raquo;</a>
						<?php } ?>
						</div>
				<?php
						echo $this->element('../coupons/add', array('config' => 'sec'));
						endif;
						echo $this->element('power-tool', array('config' => 'sec'));
						break;
					endswitch;
				?>
			</div>
		</div>
		<div id="footer">
			<div class="footer-inner container_12">
				<div class="footer-image">
				<div class="hide">
				<h6>
                   <?php echo __l("get the couponator hot coupon newsletter" );?>
                   </h6>
                   <p><?php echo __l("Get the week's most popular coupons delivered");?> </p>
                </div>
					<?php echo $this->Html->link('subscribe', array('controller' => 'subscriptions', 'action' => 'add','display'=>'home','admin' => false), array('class'=>'subscribe','title' => __l('subscribe')));?>
				</div>
				<div class="footer-link-block clearfix">
				
					<ul class="footer-link grid_right clearfix">
						<li><?php echo $this->Html->link(__l('Tips'), array('controller' => 'pages', 'action' => 'view', 'tips', 'admin' => false), array('title' => __l('Tips')));?></li>
						<li><?php echo $this->Html->link(__l('Offers'), array('controller' => 'pages', 'action' => 'view', 'offers', 'admin' => false), array('title' => __l('Offers')));?> </li>
						<li><?php echo $this->Html->link(__l('Terms Of Use'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('title' => __l('Terms Of Use')));?></li>
						<li><?php echo $this->Html->link(__l('Privacy Policy'), array('controller' => 'pages', 'action' => 'view', 'privacy', 'admin' => false), array('title' => __l('Privacy Policy')));?>  </li>
						<li>  <?php echo $this->Html->link(__l('Advertise'), array('controller' => 'pages', 'action' => 'view', 'advetiser', 'admin' => false), array('title' => __l('Advertise')));?></li>
						<li><?php echo $this->Html->link(__l('Press'), array('controller' => 'pages', 'action' => 'view', 'press', 'admin' => false), array('title' => __l('Press')));?> </li>
						<li><?php echo $this->Html->link(__l('Contact Us'), array('controller' => 'contacts', 'action' => 'add', 'admin' => false), array('title' => __l('Contact Us')));?></li>
					</ul>
						<div id="agriya" class="clearfix grid_left copywrite-info">
						<p>&copy;<?php echo date('Y');?> <?php echo $this->Html->link(Configure::read('site.name'), Router::Url('/',true), array('title' => Configure::read('site.name'), 'escape' => false));?>. <?php echo __l('All rights reserved');?>.</p>
						<p class="powered clearfix"><span><a href="http://couponator.dev.agriya.com/" title="<?php echo __l('Powered by Couponator');?>" target="_blank" class="powered"><?php echo __l('Powered by Couponator');?></a>,</span> <span><?php echo __l('made in'); ?></span> <?php echo $this->Html->link('Agriya Web Development', 'http://www.agriya.com/', array('target' => '_blank', 'title' => 'Agriya Web Development', 'class' => 'company'));?>  <span><?php echo Configure::read('site.version');?></span></p>
						<p><?php echo $this->Html->link('CSSilized by CSSilize, PSD to XHTML Conversion', 'http://www.cssilize.com/', array('target' => '_blank', 'title' => 'CSSilized by CSSilize, PSD to XHTML Conversion', 'class' => 'cssilize'));?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
/**
 * Couponator
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    couponator
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
/* SVN: $Id: config.php 4998 2010-03-04 08:19:31Z thulasi_103ac09 $ */
/**
 * Custom configurations
 */
if (!defined('DEBUG')) {
    define('DEBUG', 1);
    // permanent cache re1ated settings
    define('PERMANENT_CACHE_CHECK', (!empty($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] != '127.0.0.1') ? true : false);
    // site default language
    define('PERMANENT_CACHE_DEFAULT_LANGUAGE', 'en');
    // cookie variable name for site language
    define('PERMANENT_CACHE_COOKIE', 'user_language');
	// salt used in setcookie
    define('PERMANENT_CACHE_GZIP_SALT', 'e9a556134534545ab47c6c81c14f06c0b8sdfsdf');
    // sub admin is available in site or not
    define('PERMANENT_CACHE_HAVE_SUB_ADMIN', false);
	// Enable support for HTML5 History/State API
	// By enabling this, users will not see full page load
	define('IS_ENABLE_HTML5_HISTORY_API', false);
	// Force hashbang based URL for all browsers
	// When this is disabled, browsers that don't support History API (IE, etc) alone will use hashbang based URL. When enabled, all browsers--including links in Google search results will use hashbang based URL (similar to new Twitter).
    define('IS_ENABLE_HASHBANG_URL', false);
    $_is_hashbang_supported_bot = (!empty($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Googlebot') !== false);
    define('IS_HASHBANG_SUPPORTED_BOT', $_is_hashbang_supported_bot);
}
$config['debug'] = DEBUG;
// site actions that needs random attack protection...
$config['site']['_hashSecuredActions'] = array(
    'edit',
    'delete',
    'update',
    'download',
	'unsubscribe'
);
$config['avatar']['file'] = array(
    'allowedMime' => array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ) ,
    'allowedExt' => array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => true
);
$config['coupon']['file'] = array(
    'allowedMime' => array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ) ,
    'allowedExt' => array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => true
);
$config['storecsv']['file'] = array(
    'allowedMime' => array(
        'application/vnd.ms-excel',
        'application/application/CSV',
        'text/plain',
        'application/octet-stream'
    ) ,
    'allowedExt' => array(
        'csv',
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => true
);
// CDN...
$config['cdn']['images'] = null; // 'http://images.localhost/';
$config['cdn']['css'] = null; // 'http://static.localhost/';
// CJ
$config['cj']['coupon_url'] = 'https://linksearch.api.cj.com/wsdl/version2/linkSearchServiceV2.wsdl';
// linkshare
$config['linkshare']['coupon_url'] = 'http://couponfeed.linksynergy.com/coupon';
// Pepperjam
$config['pepperjam']['coupon_url'] = 'http://feeds.pepperjamnetwork.com/coupon/rss20';
// Shareasale
$config['shareasale']['coupon_url'] = 'https://shareasale.com/x.cfm?action=couponDeals&current=1&version=1.3&XMLFormat=1';
$config['shareasale']['merchant_url'] = 'https://shareasale.com/x.cfm?version=1.1&action=merchantStatus&programStatus=online&XMLFormat=1';

// Formetocoupon
$config['formetocoupon']['coupon_url'] = 'http://services.formetocoupon.com/getDeals';
$config['formetocoupon']['merchant_url'] = 'http://services.formetocoupon.com/getMerchants';

$config['sitemap']['models'] = array(
    'Store' => array(
		'conditions' => array(
			'Store.store_status_id' => 2, // Active store
		)
	) 
);
$config['site']['exception_array'] = array(
	'pages/view',
	'pages/display',
	'users/register',
	'users/login',
	'users/logout',
	'users/reset',
	'users/forgot_password',
	'users/openid',
	'users/activation',
	'users/resend_activation',
	'users/view',
	'users/show_captcha',
	'users/captcha_play',
	'images/view',
	'devs/robots',
	'devs/asset_css',
	'devs/asset_js',
	'devs/sitemap',
	'coupon_comments/index',
	'coupon_ratings/add',
	'coupons/data',
	'coupon_ratings/edit',
	'coupon_comments/add',
	'coupon_flags/add',
	'coupon_comments/show_captcha',
	'user_comments/add',
	'coupon_comments/captcha_play',
	'coupon_tags/index',
	'contacts/add',
	'users/admin_login',
	'users/admin_logout',
	'languages/change_language',
	'contacts/show_captcha',
	'contacts/captcha_play',
	'coupons/index',
	'coupons/view',
	'coupons/simillar',
	'coupons/search_box',
	'stores/view',
	'stores/index',
	'crons/main',
	'crons/affiliates',
	'news_letters/add',
	'ads/index',
	'stores/index',
	'stores/index_lst',
	'categories/index',
	'coupons/send_to_friend',
	'coupons/add',
	'cities/index',
	'users/oauth_callback',
	'settings/fb_update',
	'coupons/search',
	'coupons/track',
	'stores/autocomplete',
	'stores/tag_search',
	'coupon_feedbacks/add',
	'coupon_feedbacks/index',
	'user_comments/index',
	'users/members',
	'users/index',
	'coupons/out',
	'subscriptions/add',
	'subscriptions/activation',
	'stores/instant',
	'settings/index',
	'store_tags/index',
	'google_ads/index',
	'subscriptions/confirmation',
	'stores/search',
	'users/oauth_facebook',
	'coupons/lst',
	'devs/yadis',
);
/*
date_default_timezone_set('Asia/Calcutta');

Configure::write('Config.language', 'spa');
setlocale (LC_TIME, 'es');
*/
/*
** to do move to settings table
*/
$config['site']['is_admin_settings_enabled'] = true;
if (!empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'couponator.dev.agriya.com' && !in_array($_SERVER['REMOTE_ADDR'], array('118.102.143.2', '119.82.115.146', '122.183.135.202', '122.183.136.34', '122.183.136.36'))) {
	$config['site']['is_admin_settings_enabled'] = false;
	$config['site']['admin_demo_mode_update_not_allowed_pages'] = array(
		'pages/admin_edit',
		'settings/admin_edit',
		'email_templates/admin_edit',
	);
	$config['site']['admin_demo_mode_not_allowed_actions'] = array(
		'admin_delete',
		'admin_update',
	);
}
?>
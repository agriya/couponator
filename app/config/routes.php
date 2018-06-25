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
Router::parseExtensions('rss', 'csv', 'json', 'txt', 'xml');
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
Router::connect('/', array(
    'controller' => 'pages',
    'action' => 'display',
    'home'
));
//  pages/install as home page...
Router::connect('/pages/*', array(
    'controller' => 'pages',
    'action' => 'display'
));
Router::connect('/admin/pages/tools', array(
	'controller' => 'pages',
	'action' => 'display',
	'tools',
	'prefix' => 'admin',
	'admin' => true
));
Router::connect('/subscribe', array(
    'controller' => 'subscriptions',
    'action' => 'add',
    'display' => 'home'
));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
Router::connect('/admin', array(
    'controller' => 'users',
    'action' => 'stats',
    'prefix' => 'admin',
    'admin' => 1
));
Router::connect('/css/*', array(
	'controller' => 'devs',
	'action' => 'asset_css'
));
Router::connect('/js/*', array(
	'controller' => 'devs',
	'action' => 'asset_js'
));

//Code to show the images uploaded by upload behaviour
Router::connect('/img/:size/*', array(
    'controller' => 'images',
    'action' => 'view'
) , array(
    'size' => '(?:[a-zA-Z_]*)*'
));
Router::connect('/files/*', array(
    'controller' => 'images',
    'action' => 'view',
    'size' => 'original'
));
Router::connect('/sitemap', array(
    'controller' => 'devs',
    'action' => 'sitemap'
));
Router::connect('/img/*', array(
    'controller' => 'images',
    'action' => 'view',
    'size' => 'original'
));
Router::connect('/community', array(
    'controller' => 'users',
    'action' => 'index',
    'shared' => 'shared'
));
Router::connect('/cron/:action/*', array(
    'controller' => 'crons',
));
Router::connect('/tag/:tag', array(
    'controller' => 'coupons',
    'action' => 'lst'
) , array(
    'tag' => '[a-zA-Z0-9\-\s]+'
));
Router::connect('/coupon/store/:store', array(
    'controller' => 'coupons',
    'action' => 'index'
) , array(
    'store' => '[a-zA-Z0-9\-\s]+'
));
Router::connect('/freeshipping', array(
    'controller' => 'coupons',
    'action' => 'lst',
    'type' => 'free_shipping'
));
Router::connect('/printables', array(
    'controller' => 'coupons',
    'action' => 'index',
    'view' => 'print'
));
Router::connect('/coupons/tag/:tag', array(
    'controller' => 'coupons',
    'action' => 'index'
) , array(
    'tag' => '[a-zA-Z0-9\-]+'
));
Router::connect('/out/*', array(
    'controller' => 'coupons',
    'action' => 'out'
));
Router::connect('/users/twitter/login', array(
    'controller' => 'users',
    'action' => 'login',
    'type' => 'twitter'
));
Router::connect('/users/facebook/login', array(
    'controller' => 'users',
    'action' => 'login',
    'type' => 'facebook'
));
Router::connect('/users/yahoo/login', array(
    'controller' => 'users',
    'action' => 'login',
    'type' => 'yahoo'
));
Router::connect('/users/gmail/login', array(
    'controller' => 'users',
    'action' => 'login',
    'type' => 'gmail'
));
Router::connect('/users/openid/login', array(
    'controller' => 'users',
    'action' => 'login',
    'type' => 'openid'
));
Router::connect('/robots', array(
    'controller' => 'devs',
    'action' => 'robots'
));
Router::connect('/contactus', array(
    'controller' => 'contacts',
    'action' => 'add'
));
Router::connect('/stores/lst', array(
    'controller' => 'stores',
    'action' => 'index_lst'
));
Router::connect('/coupons/category/:category', array(
    'controller' => 'coupons',
    'action' => 'index'
) , array(
    'category' => '[a-zA-Z0-9\-]+'
));
Router::connect('/coupons/store/:store', array(
    'controller' => 'coupons',
    'action' => 'index'
) , array(
    'store' => '[a-zA-Z0-9\-]+'
));
Router::connect('/coupons/brand/:brand', array(
    'controller' => 'coupons',
    'action' => 'index'
) , array(
    'brand' => '[a-zA-Z0-9\-]+'
));
Router::connect('/coupons/type/:type', array(
    'controller' => 'coupons',
    'action' => 'index'
) , array(
    'type' => '[a-zA-Z0-9\-]+'
));
?>
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
class AppController extends Controller
{
    public $components = array(
        'RequestHandler',
        'Session',
        'Security',
        'Auth',
        'XAjax',
        'DebugKit.Toolbar',
        'Cookie'
    );
    public $helpers = array(
        'Html',
        'Session',
        'Javascript',
        'Form',
        'Auth',
        'Time',
        'Tree',
        'List',
        'Text'
    );
    public $isHome = false;
    var $cookieTerm = '+4 weeks';
    //    var $view = 'Theme';
    var $theme = 'themes';
    function beforeRender()
    {
        $this->set('meta_for_layout', Configure::read('meta'));
        $this->set('js_vars_for_layout', (isset($this->js_vars)) ? $this->js_vars : '');
        parent::beforeRender();
    }
    function __construct($request = null)
    {
        parent::__construct($request);
        // site settings are set in config
        $setting_key_value_pairs = Cache::read('setting_key_value_pairs');
        if (empty($setting_key_value_pairs)) {
			// site settings are set in config
			App::import('Model', 'Setting');
			$setting_model_obj = new Setting();
			$setting_key_value_pairs = $setting_model_obj->getKeyValuePairs();
			Cache::write('setting_key_value_pairs', $setting_key_value_pairs);
		}
        Configure::write($setting_key_value_pairs);
        $lang_code = Configure::read('site.language');
        if (!empty($_COOKIE['CakeCookie']['user_language'])) {
            $lang_code = $_COOKIE['CakeCookie']['user_language'];
        }
        Configure::write('lang_code', $lang_code);
        App::import('Model', 'Translation');
        $translation_model_obj = new Translation();
        Cache::set(array(
            'duration' => '+100 days'
        ));
        $translations = Cache::read($lang_code . '_translations');
        if (empty($translations) and $translations === false) {
            $translations = $translation_model_obj->find('all', array(
                'conditions' => array(
                    'Language.iso2' => $lang_code
                ) ,
                'fields' => array(
                    'Translation.key',
                    'Translation.lang_text'
                ) ,
                'contain' => array(
                    'Language' => array(
                        'fields' => array(
                            'Language.iso2'
                        )
                    )
                ) ,
                'recursive' => 0
            ));
            Cache::set(array(
                'duration' => '+100 days'
            ));
            Cache::write($lang_code . '_translations', $translations);
        }
        if (!empty($translations)) {
            foreach($translations as $translation) {
                $GLOBALS['_langs'][$translation['Language']['iso2']][$translation['Translation']['key']] = $translation['Translation']['lang_text'];
            }
        }
        $this->js_vars = array();
        $js_trans_array = array(
            'Are you sure you want to' => __l('Are you sure you want to') ,
            'Cool, how much did you save?' => __l('Cool, how much did you save?') ,
            'And I purchased a...' => __l('And I purchased a...') ,
            'Share Result' => __l('Share Result') ,
            'Nice one- thanks for sharing!' => __l('Nice one- thanks for sharing!') ,
            'Tell the World:' => __l('Tell the World:') ,
            'sa' => __l('sa') ,
        );
        foreach($js_trans_array as $k => $v) {
            $this->js_vars['cfg']['lang'][$k] = $v;
        }
    }
    function beforeFilter()
    {
		// Coding done to disallow demo user to change the admin settings
		if ($this->request->params['action'] != 'flashupload') {
			$cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
			if ($this->Auth->user('id') && !Configure::read('site.is_admin_settings_enabled') && (in_array($this->request->params['action'], Configure::read('site.admin_demo_mode_not_allowed_actions')) || (!empty($this->request->data) && in_array($cur_page, Configure::read('site.admin_demo_mode_update_not_allowed_pages'))))) {
				$this->Session->setFlash(__l('Sorry. We have disabled this action in demo mode') , 'default', null, 'error');
				if (in_array($this->request->params['controller'], array('settings', 'email_templates'))) {
					unset($this->request->data);
				} else {
					$this->redirect(array(
						'controller' => $this->request->params['controller'],
						'action' => 'index'
					));
				}
			}
		}
        $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
        // check ip is banned or not. redirect it to 403 if ip is banned
        App::import('Model', 'BannedIp');
        $bannedIpModelObj = new BannedIp();
        if ($bannedIpModelObj->checkIsIpBanned($this->RequestHandler->getClientIP())) {
            throw new ForbiddenException(__l('Invalid request'));
        }
        // check site is under maintenance mode or not. admin can set in settings page and then we will display maintenance message, but admin side will work.
		$maintenance_exception_array = array(
			'devs/asset_js',
			'devs/asset_css',
		);
        if (Configure::read('site.maintenance_mode') && $this->Auth->user('user_type_id') != ConstUserTypes::Admin && empty($this->request->params['prefix']) && !in_array($cur_page, $maintenance_exception_array)) {
            throw new MaintenanceModeException(__l('Maintenance Mode'));
        }
        //Fix to upload the file through the flash multiple uploader
        if ((isset($_SERVER['HTTP_USER_AGENT']) and ((strtolower($_SERVER['HTTP_USER_AGENT']) == 'shockwave flash') or (strpos(strtolower($_SERVER['HTTP_USER_AGENT']) , 'adobe flash player') !== false))) and isset($this->request->params['pass'][0]) and ($this->action == 'flashupload')) {
            session_id($this->request->params['pass'][0]);
            session_start();
        }
        if (!$this->Auth->user() && Configure::read('facebook.is_enabled_facebook_connect')) {
            App::import('Vendor', 'facebook/facebook');
            // Prevent the 'Undefined index: facebook_config' notice from being thrown.
            $GLOBALS['facebook_config']['debug'] = NULL;
            // Create a Facebook client API object.
            $this->facebook = new Facebook(array(
                'appId' => Configure::read('facebook.app_id') ,
                'secret' => Configure::read('facebook.secrect_key') ,
                'cookie' => true
            ));
        }
        if (strpos($this->here, '/view/') !== false) {
            trigger_error('*** dev1framework: Do not view page through /view/; use singular/slug', E_USER_ERROR);
        }
        // check the method is exist or not in the controller
        $methods = array_flip($this->methods);
        if (!isset($methods[strtolower($this->request->params['action']) ])) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->_checkAuth();
        $this->js_vars['cfg']['site_name'] = Configure::read('site.name');
        $this->js_vars['cfg']['site_currency'] = Configure::read('site.currency');
        $this->js_vars['cfg']['date_format'] = 'M d, Y';
        $this->js_vars['cfg']['path_relative'] = Router::url('/');
        $this->js_vars['cfg']['path_absolute'] = Router::url('/', true);
		$this->js_vars['cfg']['today_date'] = date('Y-m-d');
        $this->js_vars['cfg']['json_data_url'] = Router::url(array(
            'controller' => 'coupons',
            'action' => 'data',
        ) , true);
        parent::beforeFilter();
    }
    function _checkAuth()
    {
        $this->Auth->fields = array(
            'username' => Configure::read('user.using_to_login') ,
            'password' => 'password'
        );
        $exception_array = Configure::read('site.exception_array');
        $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
        if (!in_array($cur_page, $exception_array) && $this->request->params['action'] != 'flashupload') {
            if (!$this->Auth->user('id')) {
                // check cookie is present and it will auto login to account when session expires
                $cookie_hash = $this->Cookie->read('User.cookie_hash');
                if (!empty($cookie_hash)) {
                    if (is_integer($this->cookieTerm) || is_numeric($this->cookieTerm)) {
                        $expires = time() +intval($this->cookieTerm);
                    } else {
                        $expires = strtotime($this->cookieTerm, time());
                    }
                    App::import('Model', 'User');
                    $user_model_obj = new User();
                    $this->request->data = $user_model_obj->find('first', array(
                        'conditions' => array(
                            'User.cookie_hash =' => md5($cookie_hash) ,
                            'User.cookie_time_modified <= ' => date('Y-m-d h:i:s', $expires) ,
                        ) ,
                        'fields' => array(
                            'User.' . Configure::read('user.using_to_login') ,
                            'User.password'
                        ) ,
                        'recursive' => -1
                    ));
                    // auto login if cookie is present
                    if ($this->Auth->login($this->request->data)) {
                        $user_model_obj->UserLogin->insertUserLogin($this->Auth->user('id'));
                        $this->redirect(Router::url('/', true) . $this->request->url);
                    }
                }
                $this->Session->setFlash(__l('Authorisation Required'));
                $is_admin = false;
                if (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin') {
                    $is_admin = true;
                }
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                    'admin' => $is_admin,
                    '?f=' . $this->request->url
                ));
            }
            if (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin' and $this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
                $this->redirect('/');
            }
        } else {
            $this->Auth->allow('*');
        }
        $this->Auth->autoRedirect = false;
        $this->Auth->userScope = array(
            'User.is_active' => 1,
            'User.is_email_confirmed' => 1
        );
        if (isset($this->Auth)) {
            $this->Auth->loginError = __l(sprintf('Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.', Configure::read('user.using_to_login')));
        }
        $this->layout = 'default';
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin && (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin')) {
            $this->layout = 'admin';
        }
		if (Configure::read('site.maintenance_mode') && !$this->Auth->user('user_type_id')) {
			$this->layout = 'maintenance';
		}
    }
    function autocomplete($param_encode = null, $param_hash = null)
    {
        $modelClass = Inflector::singularize($this->name);
        $conditions = false;
        if (isset($this->{$modelClass}->_schema['is_approved'])) {
            $conditions['is_approved = '] = '1';
        }
        $this->XAjax->autocomplete($param_encode, $param_hash, $conditions);
    }
    function _redirectGET2Named($whitelist_param_names = null)
    {
        $query_strings = array();
        $ajax_query_strings = '';
        if (is_array($whitelist_param_names)) {
            foreach($whitelist_param_names as $param_name) {
                if (!empty($this->request->query[$param_name])) { // querystring
                    if ($this->request->params['isAjax']) {
                        $ajax_query_strings.= $param_name . ':' . $this->request->query[$param_name] . '/';
                    } else {
                        $query_strings[$param_name] = urlencode($this->request->query[$param_name]);
                    }
                }
            }
        } else {
            $query_strings = $this->request->query;
            unset($query_strings['url']); // Can't use ?url=foo

        }
        if (!empty($query_strings) || !empty($ajax_query_strings)) {
            if ($this->request->params['isAjax']) {
                $this->redirect(array(
                    'controller' => $this->request->params['controller'],
                    'action' => $this->request->params['action'],
                    $ajax_query_strings
                ) , null, true);
            } else {
                $query_strings = array_merge($this->request->params['named'], $query_strings);
                $this->redirect($query_strings, null, true);
            }
        }
    }
	function _redirectPOST2Named($paramNames = array())
    {
        //redirect the URL with query string to namedArg like URL structure...
        $query_strings = array();
        foreach($paramNames as $paramName) {
            if (!empty($this->data[Inflector::camelize(Inflector::singularize($this->params->controller))][$paramName])) { //via GET query string
				 $query_strings[$paramName] = $this->data[Inflector::camelize(Inflector::singularize($this->params->controller))][$paramName];
            }
        }
        if (!empty($query_strings)) {
            // preserve other named params
            $query_strings = array_merge($this->request->params['named'], $query_strings);
            $this->redirect($query_strings, null, true);
        }
    }
    function admin_update() 
    {
        if (!empty($this->request->data[$this->modelClass])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $ids = array();
            foreach($this->request->data[$this->modelClass] as $id => $is_checked) {
                if ($is_checked['id']) {
                    $ids[] = $id;
                }
            }
            if ($actionid && !empty($ids)) {
                switch ($actionid) {
                    case ConstMoreAction::Inactive:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.is_active' => 0
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been deactivated') , 'default', null, 'success');
                        break;

                    case ConstMoreAction::Active:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.is_active' => 1
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been activated') , 'default', null, 'success');
                        break;

                    case ConstMoreAction::Disapproved:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.is_approved' => 0
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been disapproved') , 'default', null, 'success');
                        break;

                    case ConstMoreAction::Approved:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.is_approved' => 1
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been approved') , 'default', null, 'success');
                        break;

                    case ConstMoreAction::Suspend:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.admin_suspend' => 1
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been Suspended') , 'default', null, 'success');
                        break;

                    case ConstMoreAction::Unsuspend:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.admin_suspend' => 0
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been changed to Unsuspended') , 'default', null, 'success');
                        break;

                    case ConstMoreAction::Delete:
                        foreach($ids as $id) {
                            $this->{$this->modelClass}->delete($id);
                        }
						$this->Session->setFlash(__l('Checked records has been deleted') , 'default', null, 'success');
                        break;
					case ConstMoreAction::NewStore:
                        foreach($ids as $id) {
								$data=array();
								$data[$this->modelClass]['store_status_id']=ConstStoreStatus::NewStore;
								$data[$this->modelClass]['id']=$id;
								$this->{$this->modelClass}->save($data,false);
						 }
						$this->Session->setFlash(__l('Store status changed into "New store"') , 'default', null, 'success');
                        break;
					case ConstMoreAction::ActiveStore:
                        foreach($ids as $id) {
								$data=array();
								$data[$this->modelClass]['store_status_id']=ConstStoreStatus::ActiveStore;
								$data[$this->modelClass]['id']=$id;
								$this->{$this->modelClass}->save($data,false);
							
								//send newsletter
								$this->sentSubscriptionStoremail($id);
								$this->{$this->modelClass}->socialStoreUpdates($id);
									exit;

                        }
						$this->Session->setFlash(__l('Store status changed into "Active store"') , 'default', null, 'success');
                        break;
					case ConstMoreAction::RejectedStore:
                        foreach($ids as $id) {
								$data=array();
								$data[$this->modelClass]['store_status_id']=ConstStoreStatus::RejectedStore;
								$data[$this->modelClass]['id']=$id;
								$this->{$this->modelClass}->save($data,false);
                        }
						$this->Session->setFlash(__l('Store status changed into "Rejected store"') , 'default', null, 'success');
                        break;
					case ConstMoreAction::Partner:
                        foreach($ids as $id) {
								$data=array();
								$data[$this->modelClass]['is_partner']=1;
								$data[$this->modelClass]['id']=$id;
								$this->{$this->modelClass}->save($data,false);
                        }
						$this->Session->setFlash(__l('Store status changed into "Partner"') , 'default', null, 'success');
                        break;
                    case ConstMoreAction::UnSubscribe:
                        $this->{$this->modelClass}->updateAll(array(
                            $this->modelClass . '.is_subscribed' => 0
                        ) , array(
                            $this->modelClass . '.id' => $ids
                        ));
						$this->Session->setFlash(__l('Checked records has been unsubscribed') , 'default', null, 'success');
                        break;
                    }
            }
        }
        $this->redirect(Router::url('/', true) . $r);
    }
	
    function admin_update_status($id = null)
    {
         if (!empty($this->request->params['named']['flag']) && ($this->request->params['named']['flag'] == 'deactivate')) {
            $this->{$this->modelClass}->updateAll(array(
                $this->modelClass . '.is_system_flagged' => 0
            ) , array(
                $this->modelClass . '.id' => $id
            ));
            $this->Session->setFlash(__l('Clicked records has been changed to unflagged') , 'default', null, 'success');
        } else if (!empty($this->request->params['named']['flag']) && ($this->request->params['named']['flag'] == 'active')) {
            $this->{$this->modelClass}->updateAll(array(
                $this->modelClass . '.is_system_flagged' => 1
            ) , array(
                $this->modelClass . '.id' => $id
            ));
            $this->Session->setFlash(__l('Clicked records has been changed to flagged') , 'default', null, 'success');
        } else if (!empty($this->request->params['named']['flag']) && ($this->request->params['named']['flag'] == 'suspend')) {
            $this->{$this->modelClass}->updateAll(array(
                $this->modelClass . '.admin_suspend' => 1
            ) , array(
                $this->modelClass . '.id' => $id
            ));
            $this->Session->setFlash(__l('Clicked records has been suspended') , 'default', null, 'success');
        } else if (!empty($this->request->params['named']['flag']) && ($this->request->params['named']['flag'] == 'unsuspend')) {
            $this->{$this->modelClass}->updateAll(array(
                $this->modelClass . '.admin_suspend' => 0
            ) , array(
                $this->modelClass . '.id' => $id
            ));
            $this->Session->setFlash(__l('Clicked records has been changed to unsuspended') , 'default', null, 'success');
        }
        $this->redirect(array(
            'action' => 'index',
        ));
    }
    function StatsFilter($stats = null)
    {
        Switch ($stats) {
            case 'day':
                $conditions['TO_DAYS(NOW()) - TO_DAYS(' . $this->modelClass . '.created) <= '] = 0;
                $this->pageTitle.= __l(' - Rated today');
                break;

            case 'week':
                $conditions['TO_DAYS(NOW()) - TO_DAYS(' . $this->modelClass . '.created) <= '] = 7;
                $this->pageTitle.= __l(' - Rated in this week');
                break;

            case 'month':
                $conditions['TO_DAYS(NOW()) - TO_DAYS(' . $this->modelClass . '.created) <= '] = 30;
                $this->pageTitle.= __l(' - Rated in this month');
                break;
        }
        return $conditions;
    }
    function show_captcha()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new securimage();
        $img->show(); // alternate use:  $img->show('/path/to/background.jpg');
        $this->autoRender = false;
    }
    function captcha_play()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new Securimage();
        $this->disableCache();
        $this->RequestHandler->respondAs('wav', array(
            'attachment' => 'captcha.wav'
        ));
        echo $img->getAudibleCode();
    }
    function Storeactivecount()
    {
        App::import('Model', 'Store');
        $this->Store = new Store();
        $storecount = $this->Store->find('count', array(
            'conditions' => array(
                'Store.store_status_id' => ConstStoreStatus::ActiveStore
            ) ,
            'recursive' => -1
        ));
        return $storecount;
    }
    function coupon_printable()
    {
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $couponcount = $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_id' => ConstCouponTypes::Printables
            ) ,
            'recursive' => -1
        ));
        return $couponcount;
    }
}
?>
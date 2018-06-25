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
class AppModel extends Model
{
    public $actsAs = array(
        'Containable'
    );
    function beforeSave()
    {
        $this->useDbConfig = 'master';
        return true;
    }
    function afterSave()
    {
        $this->useDbConfig = 'default';
        return true;
    }
    function beforeDelete()
    {
        $this->useDbConfig = 'master';
        return true;
    }
    function afterDelete()
    {
        $this->useDbConfig = 'default';
        return true;
    }
    function findOrSaveAndGetId($data)
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'name' => $data
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => -1
        ));
        if (!empty($findExist)) {
            return $findExist[$this->name]['id'];
        } else {
            $this->data[$this->name]['name'] = $data;
            $this->save($this->data[$this->name]);
            return $this->id;
        }
    }
    function findCountryId($data)
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'iso2' => $data
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => -1
        ));
        return $findExist[$this->name]['id'];
    }
    function findCouponStatus($store_id)
    {
        App::import('Model', 'Store');
        $this->Store = new Store();
        App::import('Model', 'Coupon');
        $store = $this->Store->find('first', array(
            'conditions' => array(
                'Store.id' => $store_id
            ) ,
            'recursive' => -1
        ));
        if ($store['Store']['store_status_id'] == ConstStoreStatus::NewStore) {
            return ConstCouponStatus::CheckStore;
        } else if ($store['Store']['store_status_id'] == ConstStoreStatus::ActiveStore) {
            if ($_SESSION['Auth']['User']['user_type_id'] != ConstUserTypes::Admin) {
                return ConstCouponStatus::NewCoupon;
            } else {
                return ConstCouponStatus::ActiveCoupon;
            }
        } else if ($store['Store']['store_status_id'] == ConstStoreStatus::RejectedStore) {
            return ConstCouponStatus::RejectedStore;
        }
    }
    function socialCouponUpdates($coupon_id = null)
    {
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $coupon = $this->Coupon->find('first', array(
            'conditions' => array(
                'Coupon.id = ' => $coupon_id
            ) ,
            'contain' => array(
                'Store' => array(
                    'fields' => array(
                        'Store.id',
                        'Store.name',
                        'Store.slug',
                        'Store.description',
                    ) ,
                    'Attachment'
                ) ,
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username',
                    ) ,
                ) ,
            ) ,
            'fields' => array(
                'Coupon.id',
                'Coupon.description',
                'Coupon.store_id',
            ) ,
            'recursive' => 2,
        ));
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'OauthConsumer');
        $this->OauthConsumer = new OauthConsumerComponent($collection);
        //posting in twitter and facebook while approving coupons
        if (Configure::read('twitter.enable_twitter_post_of_coupon') or Configure::read('facebook.enable_facebook_post_coupon')) {
            $twitter_access_token = Configure::read('twitter.site_user_access_token');
            $twitter_access_key = Configure::read('twitter.site_user_access_key');
            $fb_access_token = Configure::read('facebook.fb_access_token');
            $fb_user_id = Configure::read('facebook.fb_user_id');
            $slug = $coupon['Store']['slug'];
            $url = $url = Router::url('/', true) . 'store/' . $coupon['Store']['slug'] . '#contain-print-' . $coupon['Coupon']['id'];
            $message = $coupon['User']['username'] . ' ' . __l('shared a new coupon in "') . '' . $coupon['Store']['name'] . __l('" in ') . Configure::read('site.name');
            $message.= ' ' . $url;
            if (Configure::read('twitter.enable_twitter_post_of_coupon')) {
                $xml = $this->OauthConsumer->post('Twitter', $twitter_access_token, $twitter_access_key, 'https://twitter.com/statuses/update.xml', array(
                    'status' => $message
                ));
            }
            if (Configure::read('facebook.enable_facebook_post_coupon')) {
                $slug = $coupon['Store']['slug'];
                $image_options = array(
                    'dimension' => 'normal_thumb',
                    'class' => '',
                    'alt' => $coupon['Store']['name'],
                    'title' => $coupon['Store']['name'],
                    'type' => 'jpg'
                );
                if ($_SESSION['Auth']['User']['user_type_id'] == ConstUserTypes::Admin) {
                    $facebook_dest_user_id = Configure::read('facebook.fb_user_id');
                    $facebook_dest_access_token = Configure::read('facebook.fb_access_token');
                }
                App::import('Vendor', 'facebook/facebook');
                $this->facebook = new Facebook(array(
                    'appId' => Configure::read('facebook.app_id') ,
                    'secret' => Configure::read('facebook.secrect_key') ,
                    'cookie' => true
                ));
                if (empty($message)) {
                    $message = $coupon['Coupon']['description'];
                }
                $image_url = Router::url('/', true) . getImageUrl('Store', $coupon['Store']['Attachment'], $image_options);
                $image_link = Router::url(array(
                    'controller' => 'store',
                    'action' => 'view',
                    'admin' => false,
                    $slug,
                    '#contain-print-' . $coupon['Store']['id'],
                ) , true);
                try {
                    $getPostCheck = $this->facebook->api('/' . $facebook_dest_user_id . '/feed', 'POST', array(
                        'access_token' => $facebook_dest_access_token,
                        'message' => $message,
                        'picture' => $image_url,
                        'icon' => $image_url,
                        'link' => $image_link,
                        'description' => $coupon['Coupon']['description']
                    ));
                }
                catch(Exception $e) {
                    $this->log('Post on facebook error');
                    return 2;
                }
            }
        }
    }
    function socialStoreUpdates($store_id = null)
    {
        App::import('Model', 'Store');
        $this->Store = new Store();
        $store = $this->Store->find('first', array(
            'conditions' => array(
                'Store.id = ' => $store_id
            ) ,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username',
                    ) ,
                ) ,
                'Attachment',
            ) ,
            'fields' => array(
                'Store.id',
                'Store.name',
                'Store.slug',
                'Store.description',
            ) ,
            'recursive' => 2,
        ));
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'OauthConsumer');
        $this->OauthConsumer = new OauthConsumerComponent($collection);
        //posting in twitter and facebook while approving coupons
        if (Configure::read('twitter.enable_twitter_post_of_coupon') or Configure::read('facebook.enable_facebook_post_coupon')) {
            $twitter_access_token = Configure::read('twitter.site_user_access_token');
            $twitter_access_key = Configure::read('twitter.site_user_access_key');
            $fb_access_token = Configure::read('facebook.fb_access_token');
            $fb_user_id = Configure::read('facebook.fb_user_id');
            $slug = $store['Store']['slug'];
            $url = $url = Router::url('/', true) . 'store/' . $store['Store']['slug'];
            $message = !empty($store['User']['username']) ? $store['User']['username'] : __l('admin') . ' ' . __l('shared a new store  "') . '' . $store['Store']['name'] . __l('" in ') . Configure::read('site.name');
            $message.= ' ' . $url;
            if (Configure::read('twitter.enable_twitter_post_of_coupon')) {
                $xml = $this->OauthConsumer->post('Twitter', $twitter_access_token, $twitter_access_key, 'https://twitter.com/statuses/update.xml', array(
                    'status' => $message
                ));
            }
            if (Configure::read('facebook.enable_facebook_post_coupon')) {
                $slug = $store['Store']['slug'];
                $image_options = array(
                    'dimension' => 'normal_thumb',
                    'class' => '',
                    'alt' => $store['Store']['name'],
                    'title' => $store['Store']['name'],
                    'type' => 'jpg'
                );
                if ($_SESSION['Auth']['User']['user_type_id'] == ConstUserTypes::Admin) {
                    $facebook_dest_user_id = Configure::read('facebook.fb_user_id');
                    $facebook_dest_access_token = Configure::read('facebook.fb_access_token');
                }
                App::import('Vendor', 'facebook/facebook');
                $this->facebook = new Facebook(array(
                    'appId' => Configure::read('facebook.app_id') ,
                    'secret' => Configure::read('facebook.secrect_key') ,
                    'cookie' => true
                ));
                if (empty($message)) {
                    $message = $store['Store']['description'];
                }
                $image_url = Router::url('/', true) . getImageUrl('Store', $store['Attachment'], $image_options);
                $image_link = Router::url(array(
                    'controller' => 'store',
                    'action' => 'view',
                    'admin' => false,
                    $slug,
                ) , true);
                try {
                    $getPostCheck = $this->facebook->api('/' . $facebook_dest_user_id . '/feed', 'POST', array(
                        'access_token' => $facebook_dest_access_token,
                        'message' => $message,
                        'picture' => $image_url,
                        'icon' => $image_url,
                        'link' => $image_link,
                        'description' => $store['Store']['description']
                    ));
                }
                catch(Exception $e) {
                    $this->log('Post on facebook error');
                    return 2;
                }
            }
        }
    }
    function sentSubscriptionmail($coupon_id = null)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        App::import('Model', 'Subscription');
        $this->Subscription = new Subscription();
        if (!empty($coupon_id)) {
            $coupon = $this->Coupon->find('first', array(
                'conditions' => array(
                    'Coupon.id' => $coupon_id,
                    'Coupon.is_mail_sent' => 0,
                ) ,
                'recursive' => 0
            ));
            if (!empty($coupon)) {
                $conditions = array();
                $conditions['OR']['Subscription.store_id'] = array(
                    $coupon['Coupon']['store_id'],
                    0
                );
                $conditions['Subscription.is_subscribed'] = 1;
                $subscriptions = $this->Subscription->find('all', array(
                    'conditions' => $conditions,
                    'recursive' => -1,
                ));
                if (!empty($subscriptions)) {
                    foreach($subscriptions as $subscription) {
                        $emailFindReplace = array(
                            '##SITE_NAME##' => Configure::read('site.name') ,
                            '##SITE_URL##' => Router::url('/', true) ,
                            '##STORE_NAME##' => $coupon['Store']['name'],
                            '##COUPON_LINK##' => Router::url(array(
                                'controller' => 'stores',
                                'action' => 'view',
                                $coupon['Store']['slug'],
                                '#contain-print-' . $coupon['Coupon']['id'],
                                'admin' => false
                            ) , true) ,
                            '##UNSUBSCRIBE_LINK##' => Router::url(array(
                                'controller' => 'subscriptions',
                                'action' => 'unsubscribe',
                                $subscription['Subscription']['id'],
                                'admin' => false
                            ) , true) ,
                        );
                        $email = $this->EmailTemplate->selectTemplate('Coupon of the day');
                        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('site.from_email') : $email['from'];
                        $this->Email->to = $subscription['Subscription']['email'];
                        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                        //update mail sent status
                        $data = array();
                        $data['Coupon']['id'] = $coupon_id;
                        $data['Coupon']['is_mail_sent'] = 1;
                        $this->Coupon->save($data, false);
                    }
                }
            }
        }
    }
    function sentStoreModeratorAlert($store_id = null)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        App::import('Model', 'Store');
        $this->Store = new Store();
        if (!empty($store_id)) {
            $store = $this->Store->find('first', array(
                'conditions' => array(
                    'Store.id' => $store_id
                ) ,
                'contain' => array(
                    'User',
                    'Ip',
                ) ,
                'recursive' => 1
            ));
            if (!empty($store)) {
                $emailFindReplace = array(
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##SITE_URL##' => Router::url('/', true) ,
                    '##STORE##' => $store['Store']['name'],
                    '##USER_INFO##' => !empty($store['Store']['user_id']) ? __l('user ') . $store['User']['username'] : __l('guest user') ,
                    '##IP##' => $store['Ip']['ip'],
                    '##STORE_LINK##' => Router::url(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $store['Store']['slug'],
                        'admin' => false
                    ) , true) ,
                );
                $email = $this->EmailTemplate->selectTemplate('New store added');
                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('site.from_email') : $email['from'];
                $this->Email->to = Configure::read('site.contact_email');
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->send(strtr($email['email_content'], $emailFindReplace));
            }
        }
    }
    function sentCouponModeratorAlert($coupon_id = null)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        if (!empty($coupon_id)) {
            $coupon = $this->Coupon->find('first', array(
                'conditions' => array(
                    'Coupon.id' => $coupon_id
                ) ,
                'recursive' => 0
            ));
            if (!empty($coupon)) {
                $emailFindReplace = array(
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##SITE_URL##' => Router::url('/', true) ,
                    '##STORE##' => $coupon['Store']['name'],
                    '##IP##' => $coupon['Ip']['ip'],
                    '##USER_INFO##' => !empty($coupon['Coupon']['user_id']) ? __l('user ') . $coupon['User']['username'] : __l('guest user') ,
                    '##CODE##' => $coupon['Coupon']['coupon_code'],
                    '##COUPON_TYPE##' => $coupon['CouponType']['name'],
                    '##DESCRIPTION##' => $coupon['Coupon']['description'],
                    '##STORE_LINK##' => Router::url(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $coupon['Store']['slug'],
                        'admin' => false
                    ) , true) ,
                    '##COUPON_LINK##' => Router::url(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $coupon['Store']['slug'],
                        '#contain-print-'.$coupon_id,
                        'admin' => false
                    ) , true) ,
                );
                $email = $this->EmailTemplate->selectTemplate('New coupon added');
                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('site.from_email') : $email['from'];
                $this->Email->to = Configure::read('site.contact_email');
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->send(strtr($email['email_content'], $emailFindReplace));
            }
        }
    }
    function import($filename = null, $model_name = null)
    {
        $fpointer = fopen($filename, "r");
        if (!$fpointer) {
            return $return['errors'][] = __l('Sorry, file can not open');
        }
        App::import('Component', 'Affiliate');
        $this->Affiliate = new Affiliate();
        Switch ($model_name) {
            case 'Store':
                App::import('Model', 'Store');
                $this->Store = new Store();
                while (!feof($fpointer)) {
                    $data = array();
                    $data = fgetcsv($fpointer, 10*1024, ',');
                    $store_data = array();
                    if (!empty($data[0])) {
                        $store_data[$model_name]['url'] = utf8_encode($data[0]);
                        if (!empty($data[1])) {
                            $store_data[$model_name]['description'] = utf8_encode($data[1]);
                        }
                        if (!empty($data[2])) {
                            $store_data[$model_name]['meta_keywords'] = utf8_encode($data[2]);
                        }
                        if (!empty($data[3])) {
                            $store_data[$model_name]['meta_description'] = utf8_encode($data[3]);
                        }
                        if (!empty($data[4])) {
                            $store_data[$model_name]['address'] = utf8_encode($data[4]);
                        }
                        if (!empty($data[5])) {
                            $store_data[$model_name]['zip_code'] = utf8_encode($data[5]);
                        }
                        if (preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/', $store_data[$model_name]['url'], $matches)) {
                            $store_data[$model_name]['url'] = $url = $store_data[$model_name]['name'] = $matches[3] . '.' . $matches[4];
                        } else {
                            $store_data[$model_name]['url'] = str_replace('http://', '', $store_data[$model_name]['url']);
                            $url = $store_data[$model_name]['url'] = $store_data[$model_name]['name'] = str_replace('www.', '', $store_data[$model_name]['url']);
                        }
                        if (empty($store[$model_name]['description'])) {
                            $jump = $store_data[$model_name]['url'];
                            $host = $this->Affiliate->_getjumphost($jump);
                            $desc = $this->Affiliate->_grabDescriptions($host);
                            $store_data[$model_name]['description'] = $desc;
                        }
                        $store_data[$model_name]['ip_id'] = $this->toSaveIp();
                        $store_data[$model_name]['store_status_id'] = ConstStoreStatus::NewStore;
                        if (!$this->Affiliate->checkStore($this->Store->Coupon, $url)) {
                            $this->Store->create();
                            $this->Store->save($store_data, false);
                            $store_id = $this->Store->getLastInsertId();
                            $host = $this->Affiliate->_getjumphost($url);
                            if (!empty($host)) {
                                $this->Affiliate->_fetchSiteThumb($this->Store->Coupon, $store_id, $host);
                            }
                        }
                    }
                }
                $return['messages'][] = __l('Store imported successfully');
                break;

            case 'Coupon':
                App::import('Model', 'Coupon');
                $this->Coupon = new Coupon();
                while (!feof($fpointer)) {
                    $data = array();
                    $data = fgetcsv($fpointer, 10*1024, ',');
                    $coupon_data = array();
                    if (!empty($data)) {
                        $store_url = utf8_encode($data[1]);
                        if (!empty($data[1])) {
                            $coupon_data[$model_name]['description'] = utf8_encode($data[1]);
                            if (preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/', $store_url, $matches)) {
                                $url = $matches[3] . '.' . $matches[4];
                            } else {
                                $store_url = str_replace('http://', '', $store_url);
                                $url = str_replace('www.', '', $store_url);
                            }
                            $coupon_data[$model_name]['store_id'] = $this->Affiliate->checkStore($this->Coupon, $url);
                        }
                        if (!empty($data[0])) {
                            $coupon_data[$model_name]['coupon_code'] = $data[0];
                        }
                        if (!empty($data[2])) {
                            $start = explode('/', utf8_encode($data[2]));
                            $coupon_data[$model_name]['start_date'] = $start[2] . '-' . $start[1] . '-' . $start[0];
                        }
                        if (!empty($data[3])) {
                            $end = explode('/', utf8_encode($data[3]));
                            $coupon_data[$model_name]['end_date'] = $end[2] . '-' . $end[1] . '-' . $end[0];
                        }
                        if ((empty($coupon_data[$model_name]['end_date']) && empty($coupon_data[$model_name]['end_date'])) || empty($coupon_data[$model_name]['end_date'])) {
                            $coupon_data[$model_name]['is_ongoing'] = 1;
                        }
                        if (!empty($data[4])) {
                            $coupon_data[$model_name]['description'] = utf8_encode($data[4]);
                        } else {
                            $coupon_data[$model_name]['description'] = '';
                        }
                        if (preg_match('/free shipping/i', $coupon_data[$model_name]['description'])) {
                            $coupon_data[$model_name]['coupon_type_id'] = ConstCouponTypes::FreeShipping;
                        } else if (!empty($coupon_data[$model_name]['coupon_code'])) {
                            $coupon_data[$model_name]['coupon_type_id'] = ConstCouponTypes::CouponCodes;
                        } else {
                            $coupon_data[$model_name]['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
                        }
                        if (!empty($data[5])) {
                            $coupon_data[$model_name]['tag'] = $data[5];
                        }
                        if (!empty($data[6])) {
                            $coupon_data[$model_name]['url'] = $data[6];
                        }
                        $coupon_data[$model_name]['ip_id'] = $this->toSaveIp();
                        $coupon_data[$model_name]['is_active'] = 1;
                        if (!empty($coupon_data[$model_name]['store_id'])) {
                            $coupon_data[$model_name]['coupon_status_id'] = $this->Coupon->findCouponStatus($coupon_data[$model_name]['store_id']);
                        }
                        $coupon_data[$model_name]['coupon_status_id'] = ConstCouponStatus::CheckStore;
                        $coupon_data[$model_name]['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
                        $this->Coupon->create();
                        $this->Coupon->save($coupon_data, false);
                    }
                }
                $return['messages'][] = __l('Coupon imported successfully');
                break;
            }
            fclose($fpointer);
            return $return;
    }
    function _isValidCaptcha()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new Securimage();
        return $img->check($this->data[$this->name]['captcha']);
    }
    function formatToAddress($user = null)
    {
        if (!empty($user['UserProfile']['first_name'])) {
            $name = $user['UserProfile']['first_name'];
            if (!empty($user['UserProfile']['last_name'])) {
                $name.= ' ' . $user['UserProfile']['last_name'];
            }
            return $name . ' <' . $user['User']['email'] . '>';
        } else {
            return $user['User']['email'];
        }
    }
    function toSaveIp()
    {
        App::import('Model', 'Ip');
        $this->Ip = new Ip();
        $this->data['Ip']['ip'] = RequestHandlerComponent::getClientIP();
        $ip = $this->Ip->find('first', array(
            'conditions' => array(
                'Ip.ip' => $this->data['Ip']['ip']
            ) ,
            'fields' => array(
                'Ip.id'
            ) ,
            'recursive' => -1
        ));
        if (empty($ip)) {
            $this->data['Ip']['host'] = gethostbyaddr($this->data['Ip']['ip']);
            if (!empty($_COOKIE['_geo'])) {
                $_geo = explode('|', $_COOKIE['_geo']);
                $country = $this->Ip->Country->find('first', array(
                    'conditions' => array(
                        'Country.iso2' => $_geo[0]
                    ) ,
                    'fields' => array(
                        'Country.id'
                    ) ,
                    'recursive' => -1
                ));
                if (empty($country)) {
                    $this->data['Ip']['country_id'] = 0;
                } else {
                    $this->data['Ip']['country_id'] = $country['Country']['id'];
                }
                $state = $this->Ip->State->find('first', array(
                    'conditions' => array(
                        'State.Name' => $_geo[1]
                    ) ,
                    'fields' => array(
                        'State.id'
                    ) ,
                    'recursive' => -1
                ));
                if (empty($state)) {
                    $this->data['State']['name'] = $_geo[1];
                    $this->Ip->State->create();
                    $this->Ip->State->save($this->data['State']);
                    $this->data['Ip']['state_id'] = $this->Ip->getLastInsertId();
                } else {
                    $this->data['Ip']['state_id'] = $state['State']['id'];
                }
                $city = $this->Ip->City->find('first', array(
                    'conditions' => array(
                        'City.Name' => $_geo[2]
                    ) ,
                    'fields' => array(
                        'City.id'
                    ) ,
                    'recursive' => -1
                ));
                if (empty($city)) {
                    $this->data['City']['name'] = $_geo[2];
                    $this->Ip->City->create();
                    $this->Ip->City->save($this->data['City']);
                    $this->data['Ip']['city_id'] = $this->Ip->City->getLastInsertId();
                } else {
                    $this->data['Ip']['city_id'] = $city['City']['id'];
                }
                $this->data['Ip']['latitude'] = $_geo[3];
                $this->data['Ip']['longitude'] = $_geo[4];
            }
            $this->Ip->create();
            $this->Ip->save($this->data['Ip']);
            return $this->Ip->getLastInsertId();
        } else {
            return $ip['Ip']['id'];
        }
    }
    public function getAffiliateSites($get_list = null)
    {
        $affiliateSites = $this->AffiliateSite->find('list');
        if (!Configure::read('linkshare.is_linkshare_enable')) {
            unset($affiliateSites[ConstAffiliateSites::LinkShare]);
        }
        if (!Configure::read('cj.is_cj_enable')) {
            unset($affiliateSites[ConstAffiliateSites::CommunityJunction]);
        }
        if (!Configure::read('pepperjam.is_pepperjam_enable')) {
            unset($affiliateSites[ConstAffiliateSites::Pepperjam]);
        }
        if (!Configure::read('shareasale.is_shareasale_enable')) {
            unset($affiliateSites[ConstAffiliateSites::Shareasale]);
        }
		if (!Configure::read('formetocoupon.is_formetocoupon_enable')) {
            unset($affiliateSites[ConstAffiliateSites::Formetocoupon]);
        }
		if (!Configure::read('connectcommerce.is_connectcommerce_enable')) {
            unset($affiliateSites[ConstAffiliateSites::ConnectCommerce]);
        }
        if (!empty($get_list)) {
            return $affiliateSites;
        } else {
            return array_keys($affiliateSites);
        }
    }
    public function toSaveKeyword($keyword)
    {
        App::import('Model', 'SearchKeyword');
        $this->SearchKeyword = new SearchKeyword();
        $searchKeyword = $this->SearchKeyword->find('first', array(
            'conditions' => array(
                'SearchKeyword.keyword' => $keyword
            ) ,
            'fields' => array(
                'SearchKeyword.id'
            ) ,
            'recursive' => -1
        ));
        if (empty($searchKeyword)) {
            $_data['SearchKeyword']['keyword'] = $keyword;
            $this->SearchKeyword->create();
            $this->SearchKeyword->save($_data, false);
            $_data['SearchLog']['search_keyword_id'] = $this->SearchKeyword->id;
        } else {
            $_data['SearchLog']['search_keyword_id'] = $searchKeyword['SearchKeyword']['id'];
        }
        $_data['SearchLog']['ip_id'] = $this->SearchKeyword->toSaveIp();
        $this->SearchKeyword->SearchLog->create();
        $this->SearchKeyword->SearchLog->save($_data, false);
    }
}
?>
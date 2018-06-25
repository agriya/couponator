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
App::import('Core', 'Helper');
/**
 * This is a placeholder class.
 * Create the same file in app/app_helper.php
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake
 */
class AppHelper extends Helper
{
   function getUserLink($user_details)
    {
       if ($user_details['user_type_id'] == ConstUserTypes::Admin || $user_details['user_type_id'] == ConstUserTypes::User) {
           $user_details['full_name'] = (!empty($user_details['full_name'])) ? $user_details['full_name'] : $user_details['username'];
               return $this->link($this->cText($user_details['username']) , array(
                'controller' => 'users',
                'action' => 'view',
                $user_details['username'],
                'admin' => false
            ) , array(
                'title' => $this->cText($user_details['full_name'], false) ,
                'escape' => false,
                'class' => 'user-name'
            ));
        }
    
    }
    function getUserAvatar($user_id, $type = '')
    {
        App::import('Model', 'User');
        $this->User = new User();
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'fields' => array(
                'UserAvatar.id',
                'UserAvatar.dir',
                'UserAvatar.filename',
                'UserAvatar.height',
                'UserAvatar.width',
                'User.fb_user_id',
                'User.avatar_url',
                'User.username',
                'User.id',
            ) ,
            'recursive' => 0
        ));
        if (!empty($user['User']['avatar_url'])) {
            if ($type == 'micro_thumb' || $type == 'small_thumb' || $type == 'nano_thumb') {
				$user['User']['avatar_url'] = str_replace('_normal','_mini',$user['User']['avatar_url']);
                return $this->image($user['User']['avatar_url'], array(
                    'title' => $this->cText($user['User']['username'], false) ,
                ));
            } else  if ($type == 'normal_thumb' || $type == 'medium_thumb' || $type == 'nano_medium_thumb') {
				 return $this->link($this->image($user['User']['avatar_url'], array(
                    'title' => $this->cText($user['User']['username'], false)
                )) , array(
                    'controller' => 'users',
                    'action' => 'view',
                    $user['User']['username']
                ) , array(
                    'escape' => false
                ));
				
			} else {
				$user['User']['avatar_url'] = str_replace('_normal','_bigger',$user['User']['avatar_url']);
                return $this->link($this->image($user['User']['avatar_url'], array(
                    'title' => $this->cText($user['User']['username'], false)
                )) , array(
                    'controller' => 'users',
                    'action' => 'view',
                    $user['User']['username']
                ) , array(
                    'escape' => false
                ));
            }
        } elseif (!empty($user['User']['fb_user_id'])) {
            if ($type == 'micro_thumb' || $type == 'nano_thumb') {
                return $this->image('http://graph.facebook.com/' . $user['User']['fb_user_id'] . '/picture?type=small', array(
                    'title' => $this->cText($user['User']['username'], false)
                ));
            } else if ($type == 'normal_thumb' || $type == 'medium_thumb' || $type == 'nano_medium_thumb') {
                return $this->image('http://graph.facebook.com/' . $user['User']['fb_user_id'] . '/picture?type=normal', array(
                    'title' => $this->cText($user['User']['username'], false)
                ));
            } else {
                return $this->link($this->image('http://graph.facebook.com/' . $user['User']['fb_user_id'] . '/picture?type=large', array(
                    'title' => $this->cText($user['User']['username'], false)
                )) , array(
                    'controller' => 'users',
                    'action' => 'view',
                    $user['User']['username']
                ) , array(
                    'escape' => false
                ));
            }
        } else {
            return $this->link($this->showImage('UserAvatar', $user['UserAvatar'], array(
                'dimension' => $type,
                'alt' => sprintf(__l('[Image: %s]') , $this->cText($user['User']['username'], false)) ,
                'title' => $this->cText($user['User']['username'], false)
            ) , null, null, false) , array(
                'controller' => 'users',
                'action' => 'view',
                $user['User']['username']
            ) , array(
                'escape' => false
            ));
        }
    }
      function getLanguage()
    {
        App::import('Model', 'Translation');
        $modelObj = new Translation();
        $languages = $modelObj->find('all', array(
            'fields' => array(
                'DISTINCT(Translation.language_id)',
                'Language.name',
                'Language.iso2'
            )
        ));
        $languageList = array();
        if (!empty($languages)) {
            foreach($languages as $language) {
                $languageList[$language['Language']['iso2']] = $language['Language']['name'];
            }
        }
        return $languageList;
    }
    function Storeactivecount()
    {
        App::import('Model', 'Store');
        $this->Store = new Store();
        $storecount = $this->Store->find('count', array(
            'conditions' => array(
                'Store.store_status_id' => ConstStoreStatus::ActiveStore,
				'Store.affiliate_site_id' => $this->Store->getAffiliateSites(),
            ) ,
            'recursive' => -1
        ));
        return $storecount;
    }
    function getUserInfo($user_id)
    {
        App::import('Model', 'User');
        $modelObj = new User();
        $user = $modelObj->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'fields' => array(
                'UserAvatar.id',
                'User.username',
                'UserAvatar.dir',
                'UserAvatar.filename'
            ) ,
            'recursive' => 0
        ));
        $user_image = $this->showImage('UserAvatar', (!empty($user['UserAvatar'])) ? $user['UserAvatar'] : '', array(
            'dimension' => 'nano_thumb',
            'alt' => sprintf('[Image: %s]', $user['User']['username']) ,
            'title' => $user['User']['username']
        ));
        return $user_image . $this->link($user['User']['username'], array(
            'controller' => 'users',
            'action' => 'view',
            $user['User']['username'],
            'admin' => false
        ) , array(
            'title' => $this->cText($user['User']['username'], false) ,
            'escape' => false
        ));
    }
	function getAffiliateSites($get_list = null)
	{
		App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
		return $this->Coupon->getAffiliateSites($get_list);
	}
}
?>
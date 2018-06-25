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
class UserLogin extends AppModel
{
    public $name = 'UserLogin';
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ),
		'Ip' => array(
            'className' => 'Ip',
            'foreignKey' => 'user_login_ip_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
    );
    public function insertUserLogin($user_id)
    {
        $this->data['UserLogin']['user_id'] = $user_id;
        $this->data['UserLogin']['user_login_ip_id'] = $this->toSaveIp();
        $this->data['UserLogin']['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $this->save($this->data);
        $language = $this->User->UserProfile->find('first', array(
            'conditions' => array(
                'UserProfile.user_id' => $_SESSION['Auth']['User']['id'],
            ) ,
            'fields' => array(
                'Language.iso2'
            ) ,
            'recursive' => 0
        ));
        if (!empty($language['Language']['iso2'])) {
			App::import('Core', 'ComponentCollection');
			$collection = new ComponentCollection();
			App::import('Component', 'Cookie');
			$this->Cookie = new CookieComponent($collection);
			$this->Cookie->write('user_language', $language['Language']['iso2'], false);
        }
    }
    public function afterSave($is_created)
    {		
        $this->User->updateAll(array(
            'User.last_login_ip_id' => $this->toSaveIp(),
            'User.last_logged_in_time' => '\'' . date('Y-m-d h:i:s') . '\'',
        ) , array(
            'User.id' => $_SESSION['Auth']['User']['id']
        ));
    }
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete')
        );
    }
}
?>
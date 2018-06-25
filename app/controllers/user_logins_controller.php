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
class UserLoginsController extends AppController
{
    public $name = 'UserLogins';
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'user_id',
            'q'
        ));
        $conditions = array();
		if (!empty($this->request->params['named']['stat'])) {
			if ($this->request->params['named']['stat'] == 'day') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(UserLogin.created) <= '] = 0;
				$this->pageTitle.= __l(' - Added today');
			}
			if ($this->request->params['named']['stat'] == 'week') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(UserLogin.created) <= '] = 7;
				$this->pageTitle.= __l(' - Added in this week');
			}
			if ($this->request->params['named']['stat'] == 'month') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(UserLogin.created) <= '] = 30;
				$this->pageTitle.= __l(' - Added in this month');
			}
			if ($this->request->params['named']['stat'] == 'total') {
				$conditions = array();
			}
		}
		if (!empty($this->request->params['named']['filter_id'])) {
            if ($this->request->params['named']['filter_id'] == ConstMoreAction::OpenID) {
                $conditions['User.is_openid_register'] = 1;
                $this->pageTitle.= __l(' - Login through OpenID ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Active) {
                $conditions['User.is_active'] = 1;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Twitter) {
                $conditions['User.twitter_user_id != '] = 0;
                $this->pageTitle.= __l(' - Login through Twitter ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Facebook) {
                $conditions['User.fb_user_id !='] = 0;
                $this->pageTitle.= __l(' - Login through Facebook ');
	         } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Gmail) {
                $conditions['User.is_gmail_register !='] = 0;
                $this->pageTitle.= __l(' - Login through Gmail ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Yahoo) {
                $conditions['User.is_yahoo_register !='] = 0;
	            $this->pageTitle.= __l(' - Login through Yahoo ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['User.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Normal) {
				$conditions['User.is_yahoo_register'] = 0;
				$conditions['User.is_gmail_register'] = 0;
				$conditions['User.is_openid_register'] = 0;
				$conditions['User.is_facebook_register'] = 0;
                $conditions['User.is_twitter_register'] = 0;
                $this->pageTitle.= __l(' - Normal Users ');
            }
            $this->request->params['named']['filter_id'] = $this->request->params['named']['filter_id'];
        }
        $this->pageTitle = __l('User Logins');
        if (!empty($this->request->params['named']['username']) || !empty($this->request->params['named']['user_id'])) {
            $userConditions = !empty($this->request->params['named']['username']) ? array(
                'User.username' => $this->request->params['named']['username']
            ) : array(
                'User.id' => $this->request->params['named']['user_id']
            );
            $user = $this->{$this->modelClass}->User->find('first', array(
                'conditions' => $userConditions,
                'fields' => array(
                    'User.id',
                    'User.username'
                ) ,
                'recursive' => -1
            ));
            if (empty($user)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $conditions['User.id'] = $this->request->data[$this->modelClass]['user_id'] = $user['User']['id'];
            $this->pageTitle.= ' - ' . $user['User']['username'];
        }
        if (isset($this->request->params['named']['q'])) {
            $this->request->data['UserLogin']['q'] = $this->request->params['named']['q'];
              }
        $this->UserLogin->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array(
                'UserLogin.id',
                'UserLogin.created',
                'UserLogin.user_login_ip_id',
                'UserLogin.user_agent',
                'User.username'
            ) ,
			'contain' => array(
				'Ip' => array(
                    'City' => array(
                        'fields' => array(
                            'City.name',
                        )
                    ) ,
                    'State' => array(
                        'fields' => array(
                            'State.name',
                        )
                    ) ,
                    'Country' => array(
                        'fields' => array(
                            'Country.name',
                            'Country.iso2',
                        )
                    ) ,
                ) ,
				'User' => array(
                    'UserAvatar',
                )
			),
            'order' => array(
                'UserLogin.id' => 'desc'
            ) ,
        );
		if (!empty($this->request->params['named']['q'])) {
			$this->request->data['UserLogin']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array('search' => $this->request->data['UserLogin']['q']));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
		}
        $this->set('userLogins', $this->paginate());
        $moreActions = $this->UserLogin->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserLogin->delete($id)) {
            $this->Session->setFlash(__l('User Login deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
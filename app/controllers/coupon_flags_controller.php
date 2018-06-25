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
class CouponFlagsController extends AppController
{
    public $name = 'CouponFlags';
	public function beforeFilter()
    {
		if (!Configure::read('coupon.is_allow_coupon_flag')) {
            throw new NotFoundException(__l('Invalid request'));
        }
		parent::beforeFilter();
	}
	public function add($coupon_id = null) 
    {
		if (!empty($this->request->data)) {
            $this->CouponFlag->create();

            if (empty($this->request->data['CouponFlag']['user_id'])&& $this->Auth->user('id')) {
                 $this->request->data['CouponFlag']['user_id'] = $this->Auth->user('id');
            }
            $this->request->data['CouponFlag']['coupon_id'] = $this->request->data['Coupon']['id'];
            $this->request->data['CouponFlag']['ip_id'] = $this->CouponFlag->toSaveIp();
			$coupon = $this->CouponFlag->Coupon->find('first', array(
				'conditions' => array(
					'Coupon.id' => $this->request->data['Coupon']['id'],
				) ,
				'fields' => array(
					'Coupon.id',
					'Store.slug',
				) ,
				'recursive' => 0
			));
            if ($this->CouponFlag->save($this->request->data)) {
                $this->Session->setFlash(__l('Flag has been added') , 'default', null, 'success');
                if ($this->RequestHandler->isAjax()) {
                    echo "redirect*" . Router::url(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $coupon['Store']['slug'],
						'#contain-print-' . $coupon['Coupon']['id'],
                        'admin' => false
                    ) , true);
                    exit;
                } else {
                    $this->redirect(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $coupon['Store']['slug'],
						'#contain-print-' . $coupon['Coupon']['id'],
                        'admin' => false
                    ));
                }
            } else {
				$this->Session->setFlash(__l('Flag could not be added. Please, try again.') , 'default', null, 'error');
				$this->redirect(array(
					'controller' => 'stores',
					'action' => 'view',
					$coupon['Store']['slug'],
					'#contain-print-' . $coupon['Coupon']['id'],
					'admin' => false
				));
            }
        } else {
            $this->request->data = $this->CouponFlag->Coupon->find('first', array(
                'conditions' => array(
                    'Coupon.id' => $coupon_id,
                ) ,
                'recursive' => -1
            ));
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $couponFlagCategories = $this->CouponFlag->CouponFlagCategory->find('list', array(
            'conditions' => array(
                'CouponFlagCategory.is_active' => 1
            )
        ));
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            $users = $this->CouponFlag->User->find('list');
            $this->set(compact('users'));
        }
        $this->set(compact('couponFlagCategories'));
    }
    public function admin_index() 
    {
        $this->_redirectPOST2Named(array(
            'q'
        ));
        $this->pageTitle = __l('Flags');
        $conditions = array();
        if (!empty($this->request->params['named']['coupon_flag_category_id '])) {
            $couponFlagCategory = $this->CouponFlag->CouponFlagCategory->find('first', array(
                'conditions' => array(
                    'CouponFlagCategory.id' => $this->request->params['named']['coupon_flag_category_id ']
                ) ,
                'fields' => array(
                    'CouponFlagCategory.id',
                    'CouponFlagCategory.name'
                ) ,
                'recursive' => -1
            ));
            if (empty($couponFlagCategory)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $conditions['CouponFlagCategory.id'] = $couponFlagCategory['CouponFlagCategory']['id'];
            $this->pageTitle.= sprintf(__l(' - Category - %s') , $couponFlagCategory['CouponFlagCategory']['name']);
        }
        if (!empty($this->request->params['named']['coupon']) || !empty($this->request->params['named']['coupon_id'])) {
            $couponConditions = !empty($this->request->params['named']['coupon']) ? array(
                'Coupon.slug' => $this->request->params['named']['coupon']
            ) : array(
                'Coupon.id' => $this->request->params['named']['coupon_id']
            );
            $coupon = $this->CouponFlag->Coupon->find('first', array(
                'conditions' => $couponConditions,
                'fields' => array(
                    'Coupon.id',
                    'Coupon.title'
                ) ,
                'recursive' => -1
            ));
            if (empty($coupon)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $conditions['Coupon.id'] = $this->request->data[$this->modelClass]['coupon_id'] = $coupon['Coupon']['id'];
            $this->pageTitle.= ' - ' . $coupon['Coupon']['title'];
        }
        if (!empty($this->request->params['named']['username']) || !empty($this->request->params['named']['user_id'])) {
            $userConditions = !empty($this->request->params['named']['username']) ? array(
                'User.username' => $this->request->params['named']['username']
            ) : array(
                'User.id' => $this->request->params['named']['user_id']
            );
            $user = $this->CouponFlag->User->find('first', array(
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
        // check the filer passed through named parameter
        if (isset($this->request->params['named']['filter_id'])) {
            $this->request->data['Coupon']['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFlag.created) <= '] = 0;
            $this->pageTitle.= __l(' - Added today');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFlag.created) <= '] = 7;
            $this->pageTitle.= __l(' - Added in this week');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFlag.created) <= '] = 30;
            $this->pageTitle.= __l(' - Added in this month');
        }
        if (isset($this->request->params['named']['q'])) {
            $this->request->data['CouponFlag']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        if (!empty($this->request->data['Coupon']['filter_id'])) {
            if ($this->request->data['Coupon']['filter_id'] == ConstMoreAction::UserFlagged) {
                $conditions['Coupon.coupon_flag_count'] != 0;
                $conditions['Coupon.admin_suspend'] = 0;
                $this->pageTitle.= __l(' - User Flagged ');
            }
            $this->request->params['named']['filter_id'] = $this->request->data['Coupon']['filter_id'];
        }
        $this->CouponFlag->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.username'
                    )
                ) ,
                'CouponFlagCategory' => array(
                    'fields' => array(
                        'CouponFlagCategory.name'
                    )
                ) ,
                'Coupon' => array(
                    'fields' => array(
                        'Coupon.title',
                        'Coupon.slug',
                        'Coupon.id',
                        'Coupon.description',
                    ) ,
                ) ,
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
            ) ,
            'order' => array(
                'CouponFlag.id' => 'desc'
            )
        );
        if (isset($this->request->data['CouponFlag']['q'])) {
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['CouponFlag']['q']
            ));
        }
        $this->set('couponFlags', $this->paginate());
        $moreActions = $this->CouponFlag->moreActions;
        $this->set(compact('moreActions'));
        $this->set('page_title', $this->pageTitle);
    }
    public function admin_delete($id = null) 
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponFlag->delete($id)) {
			if(!empty($this->request->params['named']['coupon_id']))
			{
				$this->redirect(array(
					'controller' => 'coupons',
					'action' => 'delete',
					 $this->request->params['named']['coupon_id'],
					'type'=>'flag'
				));
			}
			else
			{
            $this->Session->setFlash(__l('Flag has been cleared') , 'default', null, 'success');
				$this->redirect(array(
					'action' => 'index'
				));
			}
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
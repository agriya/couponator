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
class CouponCommentsController extends AppController
{
    public $name = 'CouponComments';
	public function index($coupon_id = null)
    {
        $this->pageTitle = __l('Coupon Comments');
        $conditions = array();
        if (!empty($this->request->params['named']['user_id'])) {
            $conditions['CouponComment.user_id'] = $this->request->params['named']['user_id'];
        }
        if (!empty($coupon_id)) {
            $conditions['CouponComment.coupon_id'] = $coupon_id;
        }
        if (is_null($coupon_id) && empty($this->request->params['named']['user_id'])) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->CouponComment->recursive = 2;
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'UserAvatar' => array(
                        'fields' => array(
                            'UserAvatar.id',
                            'UserAvatar.filename',
                            'UserAvatar.dir',
                            'UserAvatar.width',
                            'UserAvatar.height'
                        )
                    ) ,
                ) ,
                'Coupon'=>array(
                 'Store'
                )
            ) ,
            'order' => array(
                'CouponComment.id' => 'desc'
            )
        );
        $this->set('couponComments', $this->paginate());
        if (!empty($this->request->params['named']['user_id'])) {
            $this->autoRender = false;
            $this->render('user_index');
        }
    }
    public function view($id = null, $view_name = 'view')
    {
        $this->pageTitle = __l('Coupon Comment');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $couponComment = $this->CouponComment->find('first', array(
            'conditions' => array(
                'CouponComment.id = ' => $id
            ) ,
            'User' => array(
                'UserAvatar' => array(
                    'fields' => array(
                        'UserAvatar.id',
                        'UserAvatar.dir',
                        'UserAvatar.filename'
                    )
                ) ,
                'fields' => array(
                    'User.username'
                )
            ) ,
            'recursive' => 2,
        ));
        if (empty($couponComment)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $couponComment['CouponComment']['id'];
        $this->set('couponComment', $couponComment);
        $this->render($view_name);
    }
    public function add()
    {
        $this->pageTitle = __l('Add Coupon Comment');
        if (!empty($this->request->data)) {
            $this->CouponComment->create();
            if ($this->Auth->user('id')) {
                $this->request->data['CouponComment']['user_id'] = $this->Auth->user('id');
            }
            $coupon = $this->CouponComment->Coupon->find('first', array(
                'conditions' => array(
                    'Coupon.id' => $this->request->data['CouponComment']['coupon_id'],
                ) ,
				'fields' => array(
					'Store.slug',
					'Coupon.id'
				) ,
                'recursive' => 0
            ));
            $this->request->data['CouponComment']['ip_id'] = $this->CouponComment->toSaveIp();
            if ($this->CouponComment->save($this->request->data)) {
				$this->Session->setFlash(__l('Coupon Comment has been added') , 'default', null, 'success');
				if (!$this->RequestHandler->isAjax()) {
                    $this->redirect(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $coupon['Store']['slug'],
                        'admin' => false,
						'#contain-print-' . $coupon['Coupon']['id']
                    ));
				} else {
					echo 'redirect*' . Router::url(array(
                        'controller' => 'stores',
                        'action' => 'view',
                        $coupon['Store']['slug'],
                        'admin' => false
                    ), true);
					exit;
				}
            } else {
                $this->Session->setFlash(__l('Coupon Comment could not be added. Please, try again.') , 'default', null, 'error');
				 if (!$this->RequestHandler->isAjax()) {
					$this->redirect(array(
						'controller' => 'stores',
						'action' => 'view',
						$coupon['Store']['slug'],
						'admin' => false,
						'#contain-print-' . $coupon['Coupon']['id']
					));
				 }
            }
        }
        $this->request->data['CouponComment']['coupon_id'] = isset($this->request->params['named']['coupon_id']) ? $this->request->params['named']['coupon_id'] : $this->request->data['CouponComment']['coupon_id'];
		$users = $this->CouponComment->User->find('list');
		$this->set(compact('users'));
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $couponComment = $this->CouponComment->find('first', array(
            'conditions' => array(
                'CouponComment.user_id' => $this->Auth->user('id') ,
                'CouponComment.id' => $id
            ) ,
            'contain' => array(
                'Coupon' => array(
					'Store' => array(
						'fields' => array(
							'Store.slug'
						)
					) ,
					'fields' => array(
						'Coupon.id'
					)
				)
            ) ,
            'recursive' => 2
        ));
		if (empty($couponComment)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponComment->delete($id)) {
            $this->Session->setFlash(__l('Coupon Comment deleted') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'stores',
                'action' => 'view',
                $couponComment['Coupon']['Store']['slug'].
				'#contain-print-' . $couponComment['Coupon']['id']
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'q'
        ));
        $this->pageTitle = __l('Coupon Comments');
        $conditions = array();
        if (!empty($this->request->params['named']['stat'])) $this->StatsFilter($this->request->params['named']['stat']);
       /* if (isset($this->request->params['named']['q'])) {
            $this->request->data['CouponComment']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }*/
		if(!empty($this->request->params['named']['coupon_id'])){
			$conditions['CouponComment.coupon_id'] = $this->request->params['named']['coupon_id'];
		}
		// guest user
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) == 'guest') {
			$conditions  = array(
			  array('CouponComment.user_id' => 0),			  
		   );
			$this->request->data['CouponComment']['q'] = $this->request->params['named']['q'];
		}
        $this->CouponComment->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.username'
                    )
                ) ,
                'Coupon' => array(
					'Store' => array(
						'fields' => array(
							'Store.id',
							'Store.name',
							'Store.slug',
						)
					),
                    'fields' => array(
                        'Coupon.title',
                        'Coupon.slug',
                        'Coupon.description',
                    )
                ) ,
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
            ) ,
            'order' => array(
                'CouponComment.id' => 'desc'
            )
        );		
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) != 'guest') {
			$this->request->data['CouponComment']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array('search' => $this->request->data['CouponComment']['q']));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $moreActions = $this->CouponComment->moreActions;
        $this->set('couponComments', $this->paginate());
        $this->set(compact('moreActions'));
    }
    public function admin_add()
    {
        $this->setAction('add');
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponComment->delete($id)) {
            $this->Session->setFlash(__l('Coupon Comment deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
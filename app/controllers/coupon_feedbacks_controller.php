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
class CouponFeedbacksController extends AppController
{
    public $name = 'CouponFeedbacks';
    public function add()
    {
        $this->CouponFeedback->create();
        $this->pageTitle = __l('Add Coupon Feedback');
        if (!empty($this->request->data) || (!empty($this->request->query['vote']))) {
            if (!empty($this->request->query['vote']) && $this->request->query['vote'] == 'yes') {
                $this->request->data['CouponFeedback']['purchased'] = $this->request->query['savings_purchased'];
                $this->request->data['CouponFeedback']['purchased_price'] = $this->request->query['savings_dollars'] . '.' . $this->request->query['savings_cents'];
            }
            if (!empty($this->request->query['vote'])) {
                if ($this->request->query['vote'] == 'no') {
                    $this->request->data['CouponFeedback']['is_worked'] = 0;
                } else {
                    $this->request->data['CouponFeedback']['is_worked'] = 1;
                }
            }
			$this->request->data['CouponFeedback']['ip_id'] = $this->CouponFeedback->toSaveIp();
            $this->request->data['CouponFeedback']['coupon_id'] = $this->request->query['couponId'];
            if ($this->Auth->user('id')) {
                $this->request->data['CouponFeedback']['user_id'] = $this->Auth->user('id');
            }
            if ($this->CouponFeedback->save($this->request->data, false)) {
                if ($this->request->data['CouponFeedback']['is_worked'] == 1) {
                    $user = $this->CouponFeedback->Coupon->find('first', array(
                        'conditions' => array(
                            'Coupon.id = ' => $this->request->data['CouponFeedback']['coupon_id'] ,
                        ) ,
                        'contain' => array(
                            'User' => array(
							  'fields' => array(
                                'User.id',
                                'User.coupon_points'
                            )),
                        ) ,
                        'recursive' => 2
                    ));
                    if (!empty($user['User'])) {
                        $user_data = array();
                        $user_data['User']['id'] = $user['User']['id'];
                        $user_data['User']['coupon_points'] = $user['User']['coupon_points']+Configure::read("coupon.point_value");
                        $this->CouponFeedback->User->save($user_data, false);
                    }
					//average count calculation for coupon
					 $average = $this->CouponFeedback->find('all', array(
                        'conditions' => array(
                            'CouponFeedback.coupon_id = ' => $this->request->data['CouponFeedback']['coupon_id'] ,
							'CouponFeedback.is_worked' => 1 ,
                        ) ,
                        'fields' => array(
                                '(SUM(CouponFeedback.purchased_price)/count(CouponFeedback.id)) as average',
                            ),
						 'group' => array(
							'CouponFeedback.coupon_id'
						 ),
                        'recursive' => -1
                    ));
					$data=array();
					$data['Coupon']['id']=$this->request->data['CouponFeedback']['coupon_id'];
					$data['Coupon']['average_savings_amount']=$average[0][0]['average'];
					$this->CouponFeedback->Coupon->save($data, false);

					//average calculation for store
					$couponList = $this->CouponFeedback->Coupon->find('list', array(
                        'conditions' => array(
                            'Coupon.store_id = ' => $user['Coupon']['store_id'] ,
							'Coupon.coupon_status_id' => array(
								ConstCouponStatus::ActiveCoupon,
								ConstCouponStatus::OutdatedCoupon
							), 
                        ) ,
                        'fields' => array(
                                'Coupon.id',
                            ),
                        'recursive' => -1
                    ));

					$store_average = $this->CouponFeedback->find('all', array(
                        'conditions' => array(
                            'CouponFeedback.coupon_id' => $couponList ,
							'CouponFeedback.is_worked' => 1 ,
                        ) ,
                        'fields' => array(
                                '(SUM(CouponFeedback.purchased_price)/count(CouponFeedback.id)) as average',
                            ),
                        'recursive' => -1
                    ));
					$data=array();
					$data['Store']['id']=$user['Coupon']['store_id'];
					$data['Store']['average_discount']=ceil($store_average[0][0]['average']);
					$this->CouponFeedback->Coupon->Store->save($data, false);
                }
               
                if ($this->RequestHandler->isAjax()) {
                    exit;
                }
				$this->Session->setFlash(__l('Coupon Feedback has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Coupon Feedback could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
    }
    public function admin_index()
    {
        $this->pageTitle = __l('Coupon Feedbacks');
		$this->_redirectPOST2Named(array(
            'q'
        ));

	   $conditions=array();
	   if (!empty($this->request->params['named']['stat'])) {
			if ($this->request->params['named']['stat'] == 'day') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFeedback.created) <= '] = 0;
				$this->pageTitle.= __l(' - Added today');
			}
			if ($this->request->params['named']['stat'] == 'week') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFeedback.created) <= '] = 7;
				$this->pageTitle.= __l(' - Added in this week');
			}
			if ($this->request->params['named']['stat'] == 'month') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFeedback.created) <= '] = 30;
				$this->pageTitle.= __l(' - Added in this month');
			}
			if ($this->request->params['named']['stat'] == 'total') {
				$conditions = array();
			}
		}
		 if(!empty($this->request->params['named']['coupon_id'])){
			 $conditions['CouponFeedback.coupon_id'] = $this->request->params['named']['coupon_id'];
		 }	
		// guest user
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) == 'guest') {
			$conditions  = array(
			  array('CouponFeedback.user_id' => 0),			  
		   );
			$this->request->data['CouponFeedback']['q'] = $this->request->params['named']['q'];
		}

        $this->CouponFeedback->recursive = 1;
		$this->CouponFeedback->order = array(
            'CouponFeedback.id' => 'DESC'
        );
		$this->paginate = array(
			'conditions' => $conditions,
			'contain' => array(
				'Coupon' => array(
					'Store'
				) ,
				'User',
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
			) ,
		);
		// not guest user
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) != 'guest') {
					$this->request->data['CouponFeedback']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array(
				'search' => $this->request->data['CouponFeedback']['q']
			));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }

        $this->set('couponFeedbacks', $this->paginate());
		$moreActions = $this->CouponFeedback->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponFeedback->delete($id)) {
            $this->Session->setFlash(__l('Coupon Feedback deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
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
class CouponImpressionsController extends AppController
{
    public $name = 'CouponImpressions';
    public function admin_index()
    {
        $this->pageTitle = __l('Coupon Impressions');
		$this->_redirectPOST2Named(array(
            'q'
        ));		
		$conditions=array();
		if (!empty($this->request->params['named']['stat'])) {
			if ($this->request->params['named']['stat'] == 'day') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponImpression.created) <= '] = 0;
				$this->pageTitle.= __l(' - Added today');
			}
			if ($this->request->params['named']['stat'] == 'week') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponImpression.created) <= '] = 7;
				$this->pageTitle.= __l(' - Added in this week');
			}
			if ($this->request->params['named']['stat'] == 'month') {
				$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponImpression.created) <= '] = 30;
				$this->pageTitle.= __l(' - Added in this month');
			}
			if ($this->request->params['named']['stat'] == 'total') {
				$conditions = array();
			}
		}
		if(!empty($this->request->params['named']['coupon_id'])){
			$conditions['CouponImpression.coupon_id'] = $this->request->params['named']['coupon_id'];
		}
		// guest user
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) == 'guest') {
			$conditions  = array(
			  array('CouponImpression.user_id' => 0),			  
		   );
			$this->request->data['CouponImpression']['q'] = $this->request->params['named']['q'];
		}
        $this->CouponImpression->recursive = 0;
		$this->CouponImpression->order = array(
            'CouponImpression.id' => 'DESC'
        );
		$this->paginate = array(
			'conditions' => $conditions,
			'contain' => array(
				'User',
				'Coupon',
				'Store',
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
			)
		);
		// not guest user
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) != 'guest') {
			$this->request->data['CouponImpression']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array(
				'search' => $this->request->data['CouponImpression']['q']
			));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
		}
        $this->set('couponImpressions', $this->paginate());
		$moreActions = $this->CouponImpression->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponImpression->delete($id)) {
            $this->Session->setFlash(__l('Coupon Impression deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
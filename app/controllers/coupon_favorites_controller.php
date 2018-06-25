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
class CouponFavoritesController extends AppController
{
    public $name = 'CouponFavorites';
    public function add($coupon_id = null)
    {
        $is_sucees = false;
        $this->pageTitle = __l('Add Coupon Favorite');
        if (!empty($this->request->params['named']['coupon'])) {
            $coupon_id = $this->request->params['named']['coupon'];
        }
        $couponFavorite = $this->CouponFavorite->find('first', array(
            'conditions' => array(
                'CouponFavorite.coupon_id' => $coupon_id,
                'CouponFavorite.user_id' => $this->Auth->user('id')
            ) ,
            'fields' => array(
                'CouponFavorite.id',
            ) ,
            'recursive' => -1
        ));
        $slug = $this->CouponFavorite->Coupon->find('first', array(
            'conditions' => array(
                'Coupon.id' => $coupon_id,
            ) ,
            'fields' => array(
                'Coupon.slug',
            ) ,
            'recursive' => -1,
        ));
        if (empty($couponFavorite)) {
            $is_sucees = true;
            $this->request->data['CouponFavorite']['coupon_id'] = $coupon_id;
            $this->request->data['CouponFavorite']['user_id'] = $this->Auth->user('id');
			$this->request->data['CouponFavorite']['ip_id'] = $this->CouponFavorite->toSaveIp();
            $this->CouponFavorite->create();
            $this->CouponFavorite->save($this->request->data, false);
            //  $message = __l('Coupon Favorite has been added');
            if ($this->RequestHandler->isAjax()) {
                if ($is_sucees) {
                    echo "added|" . Router::url(array(
                        'controller' => 'coupon_favorites',
                        'action' => 'delete',
                        $this->CouponFavorite->getInsertID() ,
                        'coupon_slug' => $slug['Coupon']['slug']
                    ) , true);
                }
                exit;
            } else {
            $this->Session->setFlash(__l('Coupon Favorite has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'controller' => 'coupons',
                    'action' => 'view',
                    $slug['Coupon']['slug']
                ));
            }
        } else {
            //$message = __l('Coupon Favorite is already has been added,Please try another only');
            $this->Session->setFlash(__l('Coupon Favorite is already has been added') , 'default', null, 'error');
        }
        $this->set('message', $message);
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $couponFavorite = $this->CouponFavorite->find('first', array(
            'conditions' => array(
                'CouponFavorite.id' => $id,
            ) ,
            'fields' => array(
                'CouponFavorite.',
            ) ,
            'recursive' => -1
        ));
        $coupon_slug = $this->CouponFavorite->Coupon->find('first', array(
            'conditions' => array(
                'Coupon.id' => $couponFavorite['CouponFavorite']['coupon_id'],
            ) ,
            'fields' => array(
                'Coupon.slug',
            ) ,
            'recursive' => -1,
        ));
        $coupon_id = $this->CouponFavorite->Coupon->find('first', array(
            'conditions' => array(
                'Coupon.slug' => $coupon_slug['Coupon']['slug'],
            ) ,
            'fields' => array(
                'Coupon.id',
            ) ,
            'recursive' => -1,
        ));
        if ($this->CouponFavorite->delete($id)) {
            $this->Session->setFlash(__l('Coupon Favorite deleted') , 'default', null, 'success');
            if ($this->RequestHandler->isAjax()) {
                echo "removed|" . Router::url(array(
                    'controller' => 'coupon_favorites',
                    'action' => 'add',
                    $coupon_id['Coupon']['id']
                ) , true);
                exit;
            }
            $this->redirect(array(
                'controller' => 'coupon_favorites',
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_index()
    {
        $this->pageTitle = __l('Coupon Favorites');
		$this->_redirectPOST2Named(array(
            'q'
        ));
	   $conditions=array();
	   if (!empty($this->request->params['named']['stat'])) {
		if ($this->request->params['named']['stat'] == 'day') {
			$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFavorite.created) <= '] = 0;
			$this->pageTitle.= __l(' - Added today');
		}
		if ($this->request->params['named']['stat'] == 'week') {
			$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFavorite.created) <= '] = 7;
            $this->pageTitle.= __l(' - Added in this week');
		}
		if ($this->request->params['named']['stat'] == 'month') {
			$conditions['TO_DAYS(NOW()) - TO_DAYS(CouponFavorite.created) <= '] = 30;
            $this->pageTitle.= __l(' - Added in this month');
		}
		if ($this->request->params['named']['stat'] == 'total') {
			$conditions = array();
		}
	  }
		if(!empty($this->request->params['named']['coupon_id'])){
			$conditions['CouponFavorite.coupon_id'] = $this->request->params['named']['coupon_id'];
		}	
		// guest user
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) == 'guest') {
			$conditions  = array(
			  array('CouponFavorite.user_id' => 0),			  
		   );
			$this->request->data['CouponFavorite']['q'] = $this->request->params['named']['q'];
		}
        $this->CouponFavorite->recursive = 1;
        $this->CouponFavorite->order = array(
            'CouponFavorite.id' => 'DESC'
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
			$this->request->data['CouponFavorite']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array(
				'search' => $this->request->data['CouponFavorite']['q']
			));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
		}
        $this->set('couponFavorites', $this->paginate());
		$moreActions = $this->CouponFavorite->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponFavorite->delete($id)) {
            $this->Session->setFlash(__l('Coupon Favorite deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
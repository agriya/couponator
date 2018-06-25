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
class CouponFlagCategoriesController extends AppController
{
    public $name = 'CouponFlagCategories';
    public function beforeFilter()
    {
		if (!Configure::read('coupon.is_allow_coupon_flag')) {
            throw new NotFoundException(__l('Invalid request'));
        }
		parent::beforeFilter();
	}
    public function admin_index() 
    {
        $this->_redirectPOST2Named(array(
            'filter_id'
        ));
        $this->pageTitle = __l('Coupon Flag Categories');
        $conditions = array();
        if (isset($this->request->params['named']['filter_id'])) {
            $this->request->data[$this->modelClass]['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (!empty($this->request->data[$this->modelClass]['filter_id'])) {
            if ($this->request->data[$this->modelClass]['filter_id'] == ConstMoreAction::Active) {
                $conditions[$this->modelClass . '.is_active'] = 1;
                $this->pageTitle.= __l(' - Approved');
            } else if ($this->request->data[$this->modelClass]['filter_id'] == ConstMoreAction::Inactive) {
                $conditions[$this->modelClass . '.is_active'] = 0;
                $this->pageTitle.= __l(' - Unapproved');
            }
            $this->request->params['named']['filter_id'] = $this->request->data[$this->modelClass]['filter_id'];
        }
        $this->CouponFlagCategory->recursive = 1;
        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array(
                'CouponFlagCategory.id',
                'CouponFlagCategory.name',
                'CouponFlagCategory.coupon_flag_count',
                'CouponFlagCategory.is_active'
            ) ,
            'order' => array(
                'CouponFlagCategory.id' => 'desc'
            )
        );
        $this->set('couponFlagCategories', $this->paginate());
        $filters = $this->CouponFlagCategory->isFilterOptions;
        $moreActions = $this->CouponFlagCategory->moreActions;
        $this->set(compact('moreActions', 'filters'));
        $this->set('pending', $this->CouponFlagCategory->find('count', array(
            'conditions' => array(
                'CouponFlagCategory.is_active' => 0
            )
        )));
        $this->set('approved', $this->CouponFlagCategory->find('count', array(
            'conditions' => array(
                'CouponFlagCategory.is_active' => 1
            )
        )));
    }
    public function admin_add() 
    {
        $this->pageTitle = __l('Add') . __l('Flag Category');
        if (!empty($this->request->data)) {
            $this->CouponFlagCategory->create();
            if ($this->CouponFlagCategory->save($this->request->data)) {
                $this->Session->setFlash(__l('Flag Category has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Flag Category could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
    }
    public function admin_edit($id = null) 
    {
        $this->pageTitle = __l('Edit Flag Category');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->CouponFlagCategory->save($this->request->data)) {
                $this->Session->setFlash(__l('Flag Category has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Flag Category could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->CouponFlagCategory->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['CouponFlagCategory']['name'];
    }
    public function admin_delete($id = null) 
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->CouponFlagCategory->delete($id)) {
            $this->Session->setFlash(__l('Flag Category deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
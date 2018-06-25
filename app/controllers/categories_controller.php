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
class CategoriesController extends AppController
{
    public $name = 'Categories';
	public function index()
    {
        $this->pageTitle = __l('Categories');
		$conditions = array();
        if (!empty($this->request->params['named']['type'])) {
            $coupons = $this->Category->Coupon->find('list', array(
                'conditions' => array(
                    'Coupon.coupon_type_id' => ConstCouponTypes::Printables
                ) ,
                'fields' => array(
                    'Coupon.id',
                    'Coupon.category_id',
                ) ,
                'recursive' => -1
            ));
			if (!empty($coupons)) {
				$conditions['Category.id'] = array_values($coupons);
			}
        }
        $conditions['Category.is_active'] = 1;
        $categories = $this->Category->find('all', array(
            'conditions' => $conditions,
            'recursive' => -1
        ));
        $this->set('categories', $categories);
    }
    public function admin_index()
    {
		$this->_redirectPOST2Named(array(
            'q'
        ));
        $this->pageTitle = __l('Categories');
		// total active Ads list
        $this->set('pending', $this->Category->find('count', array(
            'conditions' => array(
                'Category.is_active = ' => 0,
            ) ,
            'recursive' => -1
        )));
        // total inactive Ads list
        $this->set('approved', $this->Category->find('count', array(
            'conditions' => array(
                'Category.is_active = ' => 1,
            ) ,
            'recursive' => -1
        )));
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
        $this->Category->recursive = -1;
        $this->paginate = array(
			'conditions' => $conditions,
            'order' => array(
                'Category.id' => 'desc'
            ) ,
        );
		if (!empty($this->request->params['named']['q'])) {
			$this->request->data['Category']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array('search' => $this->request->data['Category']['q']));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->set('categories', $this->paginate());
		$moreActions = $this->Category->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Category');	
        if (!empty($this->request->data)) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__l('Category has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Category could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $categories = $this->Category->find('list', array(
            'fields' => array(
                'id',
                'title'
            )
        ));			
        $this->set(compact('categories'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Category');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__l('Category has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Category could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->Category->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['Category']['title'];
        $categories = $this->Category->find('list', array(
            'fields' => array(
                'id',
                'title'
            )
        ));
        $this->set(compact('categories'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__l('Category has been deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
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
class StoreViewsController extends AppController
{
    public $name = 'StoreViews';
    public function admin_index()
    {
		$this->_redirectPOST2Named(array(
            'q'
        ));
        $this->pageTitle = __l('Store Views');
        $this->StoreView->recursive = 0;
        $moreActions = $this->StoreView->moreActions;
        $this->set(compact('moreActions'));
		$conditions = array();
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) == 'guest') {
			$conditions  = array(
			  array('StoreView.user_id' => 0),			  
		   );
			$this->request->data['StoreView']['q'] = $this->request->params['named']['q'];
		}
        $this->paginate = array(
			'conditions' => $conditions,
            'contain' => array(
                'Store' => array(
                    'fields' => array(
                        'Store.id',
                        'Store.name',
                        'Store.slug',
                    )
                ) ,
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username',
                    )
                ) ,
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
            ) ,
			'order' => array(
				'StoreView.id' => 'desc'
			)
        );
		if (!empty($this->request->params['named']['q']) && strtolower($this->request->params['named']['q']) != 'guest') {
			$this->request->data['StoreView']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array(
				'search' => $this->request->data['StoreView']['q']
			));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->set('storeViews', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->StoreView->delete($id)) {
            $this->Session->setFlash(__l('Store View deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
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
class UserViewsController extends AppController
{
    public $name = 'UserViews';
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'user_id',
            'q'
        ));
        $this->pageTitle = __l('User Views');
        $conditions = array();
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
		// quick fix
		if(!empty($this->request->params['named']['q']) &&  strtolower($this->request->params['named']['q']) == 'guest'){
		$conditions  = array( 
		   'OR' => array(
			  array('UserView.viewing_user_id IS NULL'),
			  array('UserView.user_id IS NULL')
		   ));
			$this->request->data['UserView']['q'] = $this->request->params['named']['q'];
		} elseif (!empty($this->request->params['named']['q'])) {
		    $this->request->data['UserView']['q'] = $this->request->params['named']['q'];
			$conditions['OR']['ViewingUser.username LIKE'] = '%' . $this->request->params['named']['q'] . '%';
			$conditions['OR']['User.username LIKE'] = '%' . $this->request->params['named']['q'] . '%';
		}
		$this->UserView->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
			'contain' => array(
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
				'User' => array(
					'fields' => array(
						'User.username'
					)
				) ,
				'ViewingUser' => array(
					'fields' => array(
						'ViewingUser.username'
					)
				) ,
			) ,
            'order' => array(
                'UserView.id' => 'desc'
            ) ,
        );
        $this->set('userViews', $this->paginate());
        $users = $this->UserView->User->find('list');
        $moreActions = $this->UserView->moreActions;
        $this->set(compact('moreActions', 'users'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserView->delete($id)) {
            $this->Session->setFlash(__l('User View deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
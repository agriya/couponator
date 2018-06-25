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
class UserCommentsController extends AppController
{
    public $name = 'UserComments';
    public $uses = array(
        'UserComment',
        'User'
    );
    public function index()
    {
        $this->pageTitle = __l('User Comments');
        if (!empty($this->request->params['named']['user_id'])) {
            $user = $this->UserComment->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->request->params['named']['user_id'],
                ) ,
                'recursive' => -1
            ));
            $conditions['UserComment.to_user_id'] = $this->request->params['named']['user_id'];
        }
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
                    'fields' => array(
                        'User.username'
                    ) ,
                ) ,
            ) ,
            'order' => array(
                'UserComment.id' => 'desc'
            ) ,
        );
        $this->set('userComments', $this->paginate());		
        $this->set('username', $user['User']['username']);
    }
    public function view($id = null, $view_name = 'view')
    {
        $this->pageTitle = __l('User Comment');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $userComment = $this->UserComment->find('first', array(
            'conditions' => array(
                'UserComment.id = ' => $id
            ) ,
            'fields' => array(
                'UserComment.id',
                'UserComment.created',
                'UserComment.modified',
                'UserComment.user_id',
                'UserComment.comment',
                'User.id',
                'User.created',
                'User.modified',
                'User.username',
                'User.user_type_id',
                'User.email',
                'User.password',
                'User.is_active',
            ) ,
            'recursive' => 0,
        ));
        if (empty($userComment)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $userComment['UserComment']['id'];
        $this->set('userComment', $userComment);
    }
    public function add($username = null)
    {
        $this->pageTitle = __l('Add User Comment');
        if (!empty($this->request->data)) {
            $this->request->data['UserComment']['user_id'] = $this->Auth->user('id');
            if (empty($this->request->data['UserComment']['user_id'])) {
                $this->request->data['UserComment']['user_id'] = 0;
            }
            $this->UserComment->create();
			$this->request->data['UserComment']['ip_id'] = $this->UserComment->toSaveIp();
            if ($this->UserComment->save($this->request->data)) {
                $this->Session->setFlash(__l('User Comment has been added') , 'default', null, 'success');
					if (!$this->RequestHandler->isAjax()) {
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'view',
                        $this->request->data['UserComment']['username'],
                        'admin' => false,						
                    ));
				} else {
					echo 'redirect*' . Router::url(array(
                        'controller' => 'users',
                        'action' => 'view',
                        $this->request->data['UserComment']['username'],
                        'admin' => false
                    ), true);
					exit;
				}
            } else {
                $this->Session->setFlash(__l('User Comment could not be added. Please, try again.') , 'default', null, 'error');
            }
            if (isset($this->request->data['UserComment']['username'])) {
                $username = $this->request->data['UserComment']['username'];
            }
        }
        $user = $this->UserComment->User->find('first', array(
            'conditions' => array(
                'User.username' => $username
            ) ,
            'fields' => array(
                'User.id'
            ) ,
            'recursive' => -1
        ));
		if ($user['User']['id'] == $this->Auth->user('id')) {
			throw new NotFoundException(__l('Invalid request'));
		}
        $this->request->data['UserComment']['to_user_id'] = $user['User']['id'];
        $this->request->data['UserComment']['username'] = $username;
        $this->set(compact('users'));
        $this->set('username', $username);
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$userComment = $this->UserComment->find('first', array(
            'conditions' => array(
                'UserComment.id = ' => $id
            ) ,
			'contain' => array(
				'ToUser'
			) ,
            'recursive' => 0
        ));
		if (empty($userComment)) {
			throw new NotFoundException(__l('Invalid request'));
		}
        if ($this->UserComment->delete($id)) {
            $this->Session->setFlash(__l('User Comment deleted') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'view',
				$userComment['ToUser']['username']
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_index()
    {
        $this->pageTitle = __l('User Comments');
        $this->UserComment->recursive = 0;
		$this->paginate = array(
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
				'ToUser' => array(
					'fields' => array(
						'ToUser.username'
					)
				) ,
			) ,
            'order' => array(
                'UserComment.id' => 'desc'
            ) ,
        );
        $this->set('userComments', $this->paginate());
		$moreActions = $this->UserComment->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit User Comment');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->UserComment->save($this->request->data)) {
                $this->Session->setFlash(__l('User Comment has been updated') , 'default', null, 'success');
            } else {
                $this->Session->setFlash(__l('User Comment could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->UserComment->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['UserComment']['id'];
        $users = $toUsers = $this->UserComment->User->find('list');
        $this->set(compact('users', 'toUsers'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserComment->delete($id)) {
            $this->Session->setFlash(__l('User Comment deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
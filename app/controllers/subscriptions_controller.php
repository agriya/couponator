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
class SubscriptionsController extends AppController
{
    public $name = 'Subscriptions';
    public $uses = array(
        'Subscription',
        'User'
    );
    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    public function add()
    {
        $this->pageTitle = __l('Add Subscription');
        if ($this->RequestHandler->isAjax()) {
            if (isset($this->request->query['email'])) {
                $this->request->data['Subscription']['email'] = $this->request->query['email'];
            }
        }
        $conditions = array();
        if (!empty($this->request->data)) {
            $conditions['Subscription.email'] = $this->request->data['Subscription']['email'];
            if (!empty($this->request->data['Subscription']['store_id'])) {
                $conditions['Subscription.store_id'] = $this->request->data['Subscription']['store_id'];
            }
            $subscription = $this->Subscription->find('first', array(
                'conditions' => $conditions,
                'recursive' => -1
            ));
            $this->request->data['Subscription']['user_id'] = $this->Auth->user('id');
            if (empty($subscription)) {
                $this->Subscription->create();
                $this->request->data['Subscription']['is_subscribed'] = 0;
                if ($this->Subscription->save($this->request->data)) {
                    $subscription_id = $this->Subscription->getLastInsertId();
                    $this->_sendActivationMail($this->request->data['Subscription']['email'], $subscription_id, $this->Subscription->getActivateHash($subscription_id));
                    if ($this->RequestHandler->isAjax()) {
                        echo __l('Thanks, check your email for confirmation...');
                        exit;
                    } else {
                        $this->Session->setFlash(__l('We sent mail for confirmation') , 'default', null, 'success');
                        $this->layout = 'confirmation';
                        $this->redirect(array(
                            'controller' => 'subscriptions',
                            'action' => 'confirmation'
                        ));
                    }
                }
            } else {
                if ($this->RequestHandler->isAjax()) {
                    echo __l('You are already subscribed');
                    exit;
                } else {
                    $this->Session->setFlash(__l('You are already subscribed') , 'default', null, 'error');
                }
                $this->redirect('/', true);
            }
        }
        $this->set('pageTitle', __l('Subscribe'));
    }
    public function confirmation()
    {
    }
    public function unsubscribe($id = null)
    {
        $this->pageTitle = __l('Unsubscribe');
		if (!empty($this->request->data['Subscription']['id'])) {
			$id = $this->request->data['Subscription']['id'];
		}
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            $subscription = $this->Subscription->find('first', array(
                'conditions' => array(
                    'Subscription.id' => $this->request->data['Subscription']['id']
                ) ,
                'fields' => array(
                    'Subscription.id'
                ) ,
                'recursive' => -1
            ));
            if (empty($subscription)) {
                $this->Session->setFlash(__l('Please provide a subscribed email') , 'default', null, 'error');
            } else {
                $this->request->data['Subscription']['is_subscribed'] = 0;
                if ($this->Subscription->save($this->request->data)) {
                    $this->Session->setFlash(__l('You have unsubscribed from the subscribers list') , 'default', null, 'success');
                    $this->redirect('/',true);
                }
            }
        } else {
            $this->request->data['Subscription']['id'] = $id;
        }
    }
    public function admin_index()
    {
		$this->pageTitle = __l('Subscriptions');
		$this->_redirectPOST2Named(array(
			'q'
		));
		$conditions = array();
		if (!empty($this->request->data['Subscription']['type'])) {
			$this->request->params['named']['type'] = $this->request->data['Subscription']['type'];
		}
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'subscribed') {
			$this->request->data['Subscription']['type'] = $this->request->params['named']['type'];
			$conditions['Subscription.is_subscribed'] = 1;
			$this->pageTitle = __l('Subscribed Users');
		} elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'unsubscribed') {
			$this->request->data['Subscription']['type'] = $this->request->params['named']['type'];
			$conditions['Subscription.is_subscribed'] = 0;
			$this->pageTitle = __l('Unsubscribed Users');
		}
		if (isset($this->request->data['Subscription']['q']) && !empty($this->request->data['Subscription']['q'])) {
			$this->request->params['named']['q'] = $this->request->data['Subscription']['q'];
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->data['Subscription']['q']);
		}
		$this->Subscription->recursive = 0;
		$this->paginate = array(
			'conditions' => $conditions,
			'order' => array(
				'Subscription.id' => 'desc'
			) ,
		);
		if (!empty($this->request->params['named']['q'])) {
			$this->request->data['Subscription']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array('search' => $this->request->data['Subscription']['q']));
		}
		$this->set('subscriptions', $this->paginate());
		$this->set('subscribed', $this->Subscription->find('count', array(
			'conditions' => array(
				'Subscription.is_subscribed' => 1,
			) ,
			'recursive' => 0
		)));
		$this->set('unsubscribed', $this->Subscription->find('count', array(
			'conditions' => array(
				'Subscription.is_subscribed' => 0,
			) ,
			'recursive' => 0
		)));
		$this->set('pageTitle', $this->pageTitle);
		$moreActions = $this->Subscription->moreActions;
		if (!empty($this->request->params['named']['type']) && ($this->request->params['named']['type'] == 'unsubscribed')) {
			unset($moreActions[ConstMoreAction::UnSubscribe]);
		}
		$this->set(compact('moreActions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Subscription->delete($id)) {
            $this->Session->setFlash(__l('Subscription deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function _sendActivationMail($user_email, $subscriber_id, $hash)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $emailFindReplace = array(
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##SITE_URL##' => Router::url('/', true) ,
            '##ACTIVATION_URL##' => Router::url(array(
                'controller' => 'subscriptions',
                'action' => 'activation',
                $subscriber_id,
                $hash
            ) , true) ,
        );
        $email = $this->EmailTemplate->selectTemplate('Subscription Activation Request');
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('site.from_email') : $email['from'];
        $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('site.reply_to_email') : $email['reply_to'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->content = strtr($email['email_content'], $emailFindReplace);
        $this->Email->send($this->Email->content);
    }
    public function _sendWelcomeMail($user_email)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $template = $this->EmailTemplate->selectTemplate('Subscription Welcome Mail');
        $emailFindReplace = array(
            '##SITE_NAME##' => Configure::read('site.name') ,
			'##SITE_URL##' => Router::url('/', true) ,
        );
        $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('site.from_email') : $template['from'];
        $this->Email->replyTo = ($template['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('site.reply_to_email') : $template['reply_to'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($template['subject'], $emailFindReplace);
        $this->Email->content = strtr($template['email_content'], $emailFindReplace);
        $this->Email->send($this->Email->content);
    }
    public function activation($subscriber_id = null, $hash = null)
    {
        $this->pageTitle = __l('Activate your account');
        if (is_null($subscriber_id) or is_null($hash)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $subscriber = $this->Subscription->find('first', array(
            'conditions' => array(
                'Subscription.id' => $subscriber_id,
                'Subscription.is_subscribed' => 0
            ) ,
            'recursive' => -1
        ));
        if (empty($subscriber)) {
            $this->Session->setFlash(__l('Invalid activation request, please register again'));
            $this->redirect(array(
                'controller' => 'subscriptions',
                'action' => 'add'
            ));
        }
        $this->request->data['Subscription']['id'] = $subscriber_id;
        $this->request->data['Subscription']['is_subscribed'] = 1;
        $this->Subscription->save($this->request->data, false);
        $this->_sendWelcomeMail($subscriber['Subscription']['email']);
        $this->Session->setFlash(__l('You have successfully confirmed your subscription.') , 'default', null, 'success'); 
        $this->redirect(array('controller' => 'pages','action' => 'display','home'));
    }
}
?>
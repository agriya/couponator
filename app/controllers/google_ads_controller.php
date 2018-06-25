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
class GoogleAdsController extends AppController
{
    public $name = 'GoogleAds';
	public function index()
    {
        $this->pageTitle = __l('Google Ads');
        $this->GoogleAd->recursive = 0;
        $this->paginate = array(
            'order' => array(
                'RAND()'
            ) ,
            'limit' => 1
        );
        $this->set('googleAds', $this->paginate());
    }

    public function admin_index()
    {
        $this->pageTitle = __l('Google Ads');
		$conditions = array();
        // total active Ads list
        $this->set('pending', $this->GoogleAd->find('count', array(
            'conditions' => array(
                'GoogleAd.is_active = ' => 0,
            ) ,
            'recursive' => -1
        )));
        // total inactive Ads list
        $this->set('approved', $this->GoogleAd->find('count', array(
            'conditions' => array(
                'GoogleAd.is_active = ' => 1,
            ) ,
            'recursive' => -1
        )));
		// check the filer passed through named parameter
        if (isset($this->request->params['named']['filter_id'])) {
            $this->request->data['GoogleAd']['filter_id'] = $this->request->params['named']['filter_id'];
        }
		if (!empty($this->request->data['GoogleAd']['filter_id'])) {
            if ($this->request->data['GoogleAd']['filter_id'] == ConstMoreAction::Active) {
                $conditions['GoogleAd.is_active'] = 1;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->data['GoogleAd']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['GoogleAd.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive ');
            }
            $this->request->params['named']['filter_id'] = $this->request->data['GoogleAd']['filter_id'];
        }
        $this->GoogleAd->recursive = 0;
		$this->paginate = array(
                'conditions' => $conditions,                
                'order' => array(
                    'GoogleAd.id' => 'desc'
                )
            );
        $this->set('googleAds', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Google Ad');
        if (!empty($this->request->data)) {
            $this->GoogleAd->create();
            if ($this->GoogleAd->save($this->request->data)) {
                $this->Session->setFlash(__l('Google Ad has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Google Ad could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
		$googleAds = $this->GoogleAd->find('list');
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Google Ad');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->GoogleAd->save($this->request->data)) {
                $this->Session->setFlash(__l('Google Ad has been updated') , 'default', null, 'success');
            } else {
                $this->Session->setFlash(__l('Google Ad could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->GoogleAd->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['GoogleAd']['name'];
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->GoogleAd->delete($id)) {
            $this->Session->setFlash(__l('Google Ad deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
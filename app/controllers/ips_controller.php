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
class IpsController extends AppController
{
    public $name = 'Ips';
    public function admin_index()
    {
        $this->pageTitle = __l('IPs');
        $this->Ip->recursive = 0;
        $conditions = array();
        $this->_redirectPOST2Named(array(
            'q'
        ));
        $order = array(
            'Ip.id' => 'DESC'
        );
        if (isset($this->request->params['named']['q'])) {
            $conditions[] = array(
                'OR' => array(
                    array(
                        'City.name LIKE ' => '%' . $this->request->params['named']['q'] . '%'
                    ) ,
                    array(
                        'Ip.ip LIKE ' => '%' . $this->request->params['named']['q'] . '%'
                    ) ,
                    array(
                        'Country.name LIKE ' => '%' . $this->request->params['named']['q'] . '%'
                    )
                )
            );
            $this->request->data['Ip']['q'] = $this->request->params['named']['q'];
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => $order
        );
        $moreActions = $this->Ip->moreActions;
        $this->set(compact('moreActions'));
        $this->set('ips', $this->paginate());
    }
	public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Ip->delete($id)) {
            $this->Session->setFlash(__l('Ip deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
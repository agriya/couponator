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
class SearchKeywordsController extends AppController
{
    public $name = 'SearchKeywords';
    public function admin_index()
    {
        $this->pageTitle = __l('Search Keywords');
        $this->SearchKeyword->recursive = 0;
        $conditions = array();
        $this->_redirectPOST2Named(array(
            'q'
        ));
        if (!empty($this->request->params['named']['stat'])) $this->StatsFilter($this->request->params['named']['stat']);
        // check the filer passed through named parameter
        if (isset($this->request->params['named']['filter_id'])) {
            $this->request->data['SearchKeyword']['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(SearchKeyword.created) <= '] = 0;
            $this->pageTitle.= __l(' - Search today');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(SearchKeyword.created) <= '] = 7;
            $this->pageTitle.= __l(' - Search in this week');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(SearchKeyword.created) <= '] = 30;
            $this->pageTitle.= __l(' - Search in this month');
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array(
				'SearchKeyword.id' => 'DESC'
			)
        );
		if (!empty($this->request->params['named']['q'])) {
			$this->request->data['SearchKeyword']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array('search' => $this->request->data['SearchKeyword']['q']));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
		}
        $moreActions = $this->SearchKeyword->moreActions;
        $this->set(compact('moreActions'));
        $this->set('searchKeywords', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->SearchKeyword->delete($id)) {
            $this->Session->setFlash(__l('Search Keyword deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
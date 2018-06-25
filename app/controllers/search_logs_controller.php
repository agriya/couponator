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
class SearchLogsController extends AppController
{
    public $name = 'SearchLogs';
    public function admin_index()
    {
        $this->pageTitle = __l('Search Logs');
        $this->SearchLog->recursive = 3;
        $conditions = array();
        $this->_redirectPOST2Named(array(
            'q'
        ));
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(SearchLog.created) <= '] = 0;
            $this->pageTitle.= __l(' - Registered today');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(SearchLog.created) <= '] = 7;
            $this->pageTitle.= __l(' - Registered in this week');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(SearchLog.created) <= '] = 30;
            $this->pageTitle.= __l(' - Registered in this month');
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
                'SearchKeyword'
            ) ,
            'order' => array(
				'SearchLog.id' => 'DESC'
			)
        );
		if (!empty($this->request->params['named']['q'])) {
			$this->request->data['SearchLog']['q'] = $this->request->params['named']['q'];
			$this->paginate = array_merge($this->paginate, array('search' => $this->request->data['SearchLog']['q']));
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
		}
        $moreActions = $this->SearchLog->moreActions;
        $this->set(compact('moreActions'));
        $this->set('searchLogs', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$search_log = $this->SearchLog->find('first', array(
			'conditions' => array(
				'SearchLog.id' => $id
			),
			'recursive' => -1
		));
		$search_keyword_id = $search_log['SearchLog']['search_keyword_id'];		
        if ($this->SearchLog->delete($id)) {
			$search_log_count = $this->SearchLog->SearchKeyword->find('first', array(
				'conditions' => array(
					'SearchKeyword.id' => $search_keyword_id
				),
			'recursive' => -1
			));
			if($search_log_count['SearchKeyword']['search_log_count'] == 0) {
				$this->SearchLog->SearchKeyword->delete($search_keyword_id);
			}
            $this->Session->setFlash(__l('Search Log deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
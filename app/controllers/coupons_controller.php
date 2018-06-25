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
class CouponsController extends AppController
{
    public $name = 'Coupons';
    public $uses = array(
        'Coupon',
        'Attachment',
        'EmailTemplate',
        'User',
        'Store',
        'CouponTag',
        'SearchKeyword',
        'Subscription',
        'CouponFeedback',
        'CouponImpression'
    );
    public $components = array(
        'Email'
    );
    public $helpers = array(
        'Number',
        'Csv'
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Store.name',
            'Store.id',
			'Coupon.store',
			'Coupon.store_id',
			'Coupon.store_slug',
			'Coupon.type',
			'Coupon.store_name',
        );
        parent::beforeFilter();
    }
    public function data()
    {
        $conditions = array();
        $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
        $coupons = $this->Coupon->find('list', array(
            'conditions' => $conditions,
            'fields' => array(
                'Coupon.id',
                'Coupon.store_id',
            ) ,
            'recursive' => 1,
        ));
        $conditions1 = array();
        $conditions1['Store.id'] = $coupons;
        $conditions2 = array();
        $conditions2['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
        $stores_count = $this->Store->find('count', array(
            'conditions' => $conditions1,
            'recursive' => -1,
        ));
        $stores = $this->Store->find('all', array(
            'conditions' => $conditions1,
            'contain' => array(
                'Coupon' => array(
                    'conditions' => $conditions2,
                    'fields' => array(
                        'Coupon.id',
                    ) ,
                ) ,
            ) ,
            'fields' => array(
                'Store.id',
                'Store.latitude',
                'Store.longitude',
            ) ,
            'recursive' => 1,
        ));
        $store_data = array();
        foreach($stores as &$store) {
            $store['Count'] = count($store['Coupon']);
            unset($store['Coupon']);
        }
        $stores['Count'] = $stores_count;
        $this->view = 'Json';
        $this->set('json', $stores);
    }
	public function lst()
	{
		$this->_redirectPOST2Named(array(
            'q',
            'tag',
            'keyword'
        ));
		$conditions = array();
		$conditions['Coupon.admin_suspend !='] = 1;
		$conditions['Coupon.is_active'] = 1;
		$conditions['Coupon.coupon_status_id'] = array(
			ConstCouponStatus::ActiveCoupon,
			ConstCouponStatus::OutdatedCoupon
		);

		if (!empty($this->request->params['named']['tag'])) {
			$this->request->params['named']['tag']=Inflector::slug($this->request->params['named']['tag'], '-');
            $this->pageTitle = $this->request->params['named']['tag'] . __l(' coupon codes. Find and share  coupons, discounts and promotion codes for  ') . $this->request->params['named']['tag'];
            $couponTag = $this->Coupon->CouponTag->find('first', array(
                'conditions' => array(
                    'CouponTag.slug' => Inflector::slug($this->request->params['named']['tag'], '-')
                ) ,
                'contain' => array(
                    'Coupon' => array(
                        'fields' => array(
                            'Coupon.id',
                            'Coupon.store_id'
                        ) ,
                    ) ,
                ) ,
                'fields' => array(
                    'CouponTag.id',
					'CouponTag.name'
                ) ,
                'recursive' => 1
            ));
			$coupon_ids = array();
            if (!empty($couponTag['Coupon'])) {
				foreach($couponTag['Coupon'] as $tag) {
					$coupon_ids[] = $tag['id'];
				}
	            $conditions['Coupon.id'] = $coupon_ids;
				$this->set('tag_name', $couponTag['CouponTag']['name']);
            } else {
				$this->request->params['named']['keyword'] = $this->request->params['named']['tag'];
			}
        }
		if (!empty($this->request->params['named']['keyword'])) {
			$keyword = $this->request->params['named']['keyword'];
			if (preg_match('/([A-Za-z0-9\-.])*.([a-zA-Z]{2,3})/', $keyword)) {
				$store_conditions['OR']['Store.url'] = $keyword;
				$store_conditions['OR']['Store.url LIKE'] = '%.' . $keyword;
				$store_conditions['Store.store_status_id'] = ConstStoreStatus::ActiveStore;
				$store = $this->Coupon->Store->find('first', array(
					'conditions' => $store_conditions,
					'fields' => array(
						'Store.id',
						'Store.slug',
					) ,
					'recursive' => -1
				));
				if (!empty($store)) {
					$this->redirect(Router::url(array(
						'controller' => 'stores',
						'action' => 'view',
						$store['Store']['slug']
					) , true));
				}
			}
			//tag search
			 $tag = $this->Coupon->CouponTag->find('first', array(
					'conditions' => array(
						'CouponTag.slug' => Inflector::slug($keyword, '-'),
					),
					'fields' => array(
						'CouponTag.id',
						'CouponTag.slug',
					) ,
					'recursive' => -1
				));
			if (!empty($tag)) {
				$this->redirect(Router::url(array(
					'controller' => 'coupons',
					'action' => 'lst',
					'tag' => $tag['CouponTag']['slug']
				) , true));
			}
			$coupon_conditions['OR']['Coupon.description LIKE'] = '%' . $keyword . '%';
            $coupon_conditions['OR']['Coupon.coupon_code'] = $keyword;
            $coupons = $this->Coupon->find('list', array(
                'conditions' => $coupon_conditions,
                'fields' => array(
                    'Coupon.id',
                    'Coupon.store_id',
                ) ,
                'recursive' => -1
            ));
			if (empty($coupons)) {
				$this->redirect(array(
                    'controller' => 'stores',
                    'action' => 'search',
					'keyword' => urlencode($keyword)
                ));
			} else {
				$conditions['Coupon.id'] = array_keys($coupons);
			}
			$this->request->data['Store']['keyword'] = $keyword;
			$this->set('keyword', $keyword);
			$this->set('search', 'yes');
		}
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'home') {
			$couponImpressions = $this->Store->Coupon->CouponImpression->find('list', array(
				'conditions' => array(
                    'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 0,
                ) ,
				'fields' => array(
					'CouponImpression.id',
					'CouponImpression.coupon_id',
				) ,
				'recursive' => -1
			));
			if (!empty($couponImpressions)) {
				$conditions['Coupon.id'] = array_values($couponImpressions);
			}
		} elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'free_shipping') {
			$conditions['Coupon.coupon_type_id'] = ConstCouponTypes::FreeShipping;
			$this->pageTitle = __l('Free Shipping Deals - Coupons and  Discounts for Free Shipping');
		} elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'latest_contribution') {
			$conditions['Coupon.user_id != '] = ConstUser::Admin;
		}
		$this->paginate = array(
			'conditions' => $conditions,
			'contain' => array(
				'Store' => array(
					'Attachment'
				)
			) ,
			'order' => array(
				'Store.rank' => 'desc',
				'Coupon.id' => 'desc'
			) ,
			'group' => array(
				'Coupon.store_id'
			) ,
			'recursive' => 2
		);
		$this->set('coupons', $this->paginate());
		$this->render('index_lst');
	}
    public function index()
    {
        $this->_redirectPOST2Named(array(
            'q',
            'keyword',
            'is_free_shipping',
            'is_printable',
            'is_expired',
            'category_id',
            'category',
            'store',
            'is_expired',
            'is_code',
            'is_wo_code',
            'is_per',
            'is_dollar',
            'tag',
            'recent',
            'expiry',
            'searchtype',
            'tagsearch',
            'specialsearch',
            'what',
            'where',
            'view_map',
        ));
        $limit = '10';
        if (!empty($this->request->data['Coupon']['keyword'])) {
            $this->request->params['named']['keyword'] = $this->request->data['Coupon']['keyword'];
            $this->request->params['named']['searchtype'] = $this->request->data['Coupon']['searchtype'];
        }
        $conditions = array();
        if (!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] == Configure::read('site.city')) {
            $this->request->params['named']['city'] = Configure::read('site.city');
        }
        $order = array(
			'Store.rank' => 'desc',
            'Coupon.id' => 'DESC'
        );
        $store_conditions = array();
        //category fileter
        if (!empty($this->request->params['named']['what'])) {
            $this->pageTitle = __l('Printable ') . $this->request->params['named']['what'] . __l(' Coupons');
            $conditions['Coupon.description LIKE'] = '%' . $this->request->params['named']['what'] . '%';
            $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
        }
        if (!empty($this->request->params['named']['where'])) {
            $this->pageTitle = __l('Printable Coupons ZIP ') . $this->request->params['named']['where'];
            if (is_numeric($this->request->params['named']['where'])) {
                $is_valid = preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $this->request->params['named']['where']);
                if ($is_valid) {
                    $store_id = $this->Coupon->Store->find('list', array(
                        'conditions' => array(
                            'Store.zip_code' => $this->request->params['named']['where']
                        ) ,
                        'fields' => array(
                            'Store.id'
                        ) ,
                        'recursive' => -1
                    ));
                    $this->pageTitle = __l('where') . ' - ' . $this->request->params['named']['where'];
                    $conditions['Coupon.store_id '] = $store_id;
                    $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
                }
            } else {
                $storesList = $this->Store->find('list', array(
                    'conditions' => array(
                        'Store.address like' => '%' . $this->request->params['named']['where'] . '%'
                    ) ,
                    'fields' => array(
                        'Store.id'
                    ) ,
                    'recursive' => -1
                ));
                $this->pageTitle = __l('where') . ' - ' . $this->request->params['named']['where'];
                $conditions['Coupon.store_id '] = $storesList;
                $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
            }
        }
        //category fileter
        if (!empty($this->request->params['named']['category'])) {
            $this->pageTitle = __l('Printable ') . $this->request->params['named']['category'] . (' Coupons.Find Printable Coupons  for ') . $this->request->params['named']['category'];
            $category_id = $this->Coupon->Category->find('first', array(
                'conditions' => array(
                    'Category.slug' => $this->request->params['named']['category']
                ) ,
                'fields' => array(
                    'Category.id'
                ) ,
                'recursive' => -1
            ));
            if (!empty($category_id)) {
                $conditions['Coupon.category_id'] = $category_id['Category']['id'];
            }
            $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
        }
        //store fileter
        if (!empty($this->request->params['named']['store'])) {
            $this->pageTitle = __l('category') . ' - ' . $this->request->params['named']['store'];
            $store_id = $this->Coupon->Store->find('first', array(
                'conditions' => array(
                    'Store.slug' => $this->request->params['named']['store']
                ) ,
                'fields' => array(
                    'Store.id'
                ) ,
                'recursive' => -1
            ));
            if (!empty($store_id)) {
                $conditions['Coupon.store_id'] = $store_id['Store']['id'];
            }
            $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
        }
        if (!empty($this->request->params['named']['specialsearch'])) {
            $conditions['Coupon.is_special_offer'] = 1;
        }
        if (!empty($this->request->params['named']['user_id']) && empty($this->request->params['named']['vote'])) {
            $conditions['Coupon.user_id'] = $this->request->params['named']['user_id'];
        }
        if (!empty($this->request->params['named']['user_id']) && !empty($this->request->params['named']['vote'])) {
            $coupon_feecback = array();
            if ($this->request->params['named']['vote'] == 'up') {
                $coupon_feecback['CouponFeedback.is_worked'] = 1;
            } elseif ($this->request->params['named']['vote'] == 'down') {
                $coupon_feecback['CouponFeedback.is_worked'] = 0;
            }
            $coupon_feecback['CouponFeedback.user_id'] = $this->request->params['named']['user_id'];
            $couponids = $this->CouponFeedback->find('list', array(
                'conditions' => $coupon_feecback,
                'fields' => array(
                    'CouponFeedback.coupon_id'
                ) ,
                'recursive' => -1
            ));
            $conditions['Coupon.id'] = $couponids;
        }
        if (!empty($this->request->params['named']['tagsearch'])) {
            $order = array(
                'Coupon.coupon_impression_count' => 'DESC'
            );
        }
        if (!empty($this->request->params['named']['tag'])) {
            $this->set('tag', $this->request->params['named']['tag']);
            $this->autoRender = false;
            $this->render('search');
        }
        if (!empty($this->request->params['named']['keyword'])) {
            $this->set('q', $this->request->params['named']['keyword']);
            $this->set('searchtype', $this->request->params['named']['searchtype']);
            $this->autoRender = false;
            $this->render('search');
        }
        if (!empty($this->request->params['named']['view_name'])) {
            if ($this->request->params['named']['view_name'] == 'home') {
                $conditions['Coupon.coupon_type_status_id'] = ConstCouponTypeStatus::Live;
            } else if ($this->request->params['named']['view_name'] == 'printable') {
                $conditions['Coupon.is_printable'] = 1;
            } else if ($this->request->params['named']['view_name'] == 'popular') {
                $conditions['Coupon.is_popular'] = 1;
                $this->set('page_title', 'Popular Coupons');
            } else if ($this->request->params['named']['view_name'] == 'store_view') {
                $conditions['Coupon.store_id'] = $this->request->params['named']['store_id'];
                if (!empty($this->request->params['named']['coupon_type'])) {
                    $conditions['Coupon.coupon_type_status_id'] = $this->request->params['named']['coupon_type'];
                }
                $this->set('page_title', 'Store Coupons');
            } else if ($this->request->params['named']['view_name'] == 'user_coupon') {
                $conditions['Coupon.user_id'] = $this->Auth->user('id');
                $this->set('page_title', 'User Coupons');
            }
        }
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['SearchKeyword']['keyword'] = $this->request->params['named']['q'];
            $SearchKeywordcount = $this->SearchKeyword->find('first', array(
                'conditions' => array(
                    'SearchKeyword.keyword' => $this->request->params['named']['q']
                ) ,
                'fields' => array(
                    'SearchKeyword.id'
                ) ,
                'recursive' => -1
            ));
            if (empty($SearchKeywordcount)) {
                $this->SearchKeyword->create();
                $this->SearchKeyword->save($this->request->data, false);
                $this->request->data['SearchLog']['search_keyword_id'] = $this->SearchKeyword->id;
            } else {
                $this->request->data['SearchLog']['search_keyword_id'] = $SearchKeywordcount['SearchKeyword']['id'];
            }
            $conditions['OR']['Coupon.description LIKE'] = '%' . $this->request->params['named']['q'] . '%';
            $conditions['OR']['Coupon.coupon_code LIKE'] = '%' . $this->request->params['named']['q'] . '%';
            $conditions['OR']['Store.name LIKE'] = '%' . $this->request->params['named']['q'] . '%';
            $conditions['OR']['Coupon.description LIKE'] = '%' . $this->request->params['named']['q'] . '%';
            $this->request->data['Ip']['ip'] = $this->RequestHandler->getClientIP();
            $this->request->data['SearchLog']['ip_id'] = $this->Coupon->toSaveIp();
            $this->SearchKeyword->SearchLog->create();
            $this->SearchKeyword->SearchLog->save($this->request->data);
            $this->request->data['Coupon']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->data['Coupon']['q']);
        }
        if (!empty($this->request->params['named']['coupon'])) {
            $coupon = $this->Coupon->find('first', array(
                'conditions' => array(
                    'Coupon.slug' => $this->request->params['named']['coupon']
                ) ,
                'fields' => array(
                    'Coupon.id',
                    'Coupon.slug',
                ) ,
                'recursive' => -1,
            ));
            $conditions['Coupon.id'] = $coupon['Coupon']['id'];
        }
        if (!empty($this->request->params['named']['filter'])) {
            Switch ($this->request->params['named']['filter']) {
                case 'recent':
                    $conditions['Coupon.created <'] = date("Y-m-d h:m:s");
                    $order = array(
                        'Coupon.id' => 'DESC'
                    );
                    $this->pageTitle.= __l(' - Recent Coupons');
                    break;

                case 'expiry':
                    $conditions['Coupon.expiry_date >'] = date("Y-m-d h:m:s");
                    $order = array(
                        'Coupon.id' => 'ASC'
                    );
                    $this->pageTitle.= __l(' - Expiry Coupons');
                    break;
            }
        }
        if (empty($this->request->params['named']['view_name']) && empty($this->request->params['named']['category']) && empty($this->request->params['named']['store']) && empty($this->request->params['named']['keyword']) && empty($this->request->params['named']['viewsearch']) && empty($this->request->params['named']['what']) && empty($this->request->params['named']['where']) && empty($this->request->params['named']['user_id'])) {
            $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::CouponCodes;
            $limit = Configure::read('coupon.coupons_code_limit');
        }
        $this->set('is_ajax', false);
        if (!empty($this->request->params['named']['coupon_id'])) {
            $conditions['Coupon.store_id'] = $this->request->params['named']['coupon_id'];
            $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
            $this->set('is_ajax', true);
            $this->layout = 'ajax';
        }
        $conditions['Coupon.admin_suspend'] = 0;
        if (!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] = 'print') {
            // $this->layout = 'print';
            $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
            $limit = Configure::read('coupon.printable_coupons_limit');
            $printables_count = $this->coupon_printable();
            $this->pageTitle = $printables_count . __l('  free printable coupons');
        }
        if (!empty($this->request->params['named']['view_name']) && $this->request->params['named']['view_name'] == 'alpha_list') {
            $coupons = array();
            $coupon = array();
            for ($i = 48; $i < 58; $i++) {
                $value = chr($i);
                $condition = array();
                $condition['Coupon.description LIKE'] = $value . '%';
                $coupon[] = $this->Coupon->find('all', array(
                    'conditions' => $condition,
                    'fields' => array(
                        'Coupon.slug',
                        'Coupon.title',
                    ) ,
                    'recursive' => -1,
                ));
            }
            for ($i = 65; $i < 91; $i++) {
                $value = chr($i);
                $conditions = array();
                $conditions['Coupon.description LIKE'] = $value . '%';
                $coupons[] = $this->Coupon->find('all', array(
                    'conditions' => $conditions,
                    'fields' => array(
                        'Coupon.slug',
                        'Coupon.title',
                    ) ,
                    'recursive' => -1,
                ));
            }
            $this->set('coupon', $coupon);
            $this->set('coupons', $coupons);
        } else {

            $conditions['Coupon.admin_suspend'] = 0;
            $conditions['Coupon.coupon_status_id'] = array(
                ConstCouponStatus::ActiveCoupon,
              //  ConstCouponStatus::OutdatedCoupon
            );
            if ($this->RequestHandler->prefers('rss')) {
                $limit = 20;
                $this->pageTitle = __l('Latest Coupons');
            }
            if (empty($limit)) {
                $limit = 10;
            }
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => array(
                    'User' => array(
                        'fields' => array(
                            'User.id',
                            'User.username',
                            'User.user_type_id',
                        ) ,
                        'UserAvatar',
                    ) ,
                    'CouponFeedback' => array(
                        'fields' => array(
                            'CouponFeedback.coupon_id',
                            'CouponFeedback.purchased',
                            'CouponFeedback.user_id',
                            'CouponFeedback.purchased_price',
                            'CouponFeedback.is_worked',
                        )
                    ) ,
                    'CouponFavorite',
                    'Store' => array(
                        'fields' => array(
                            'Store.id',
                            'Store.name',
                            'Store.rank',
                            'Store.slug',
                            'Store.coupon_count',
                            'Store.url',
                            'Store.address',
                            'Store.zip_code',
                        ) ,
                        'Attachment'
                    ) ,
                    'CouponComment' => array(
                        'User' => array(
                            'UserAvatar'
                        ) ,
                    )
                ) ,
                'recursive' => 3,
                'order' => $order,
                'limit' => $limit,
            );
            $this->set('coupons', $this->paginate());
        }
        $this->set('pagetitle', $this->pageTitle);
        if ($this->RequestHandler->isAjax()) {
            $this->set('isAjax', true);
        } else {
            $this->set('isAjax', false);
        }
        if (!empty($this->request->params['named']['view_name']) && $this->request->params['named']['view_name'] == 'alpha_list') {
            $this->render('alpha_list');
        } else if ((!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] = 'print') || !empty($this->request->params['named']['category']) || !empty($this->request->params['named']['store']) || !empty($this->request->params['named']['what']) || !empty($this->request->params['named']['where'])) {
            if (!empty($this->request->params['named']['what'])) {
                $this->request->data['Coupon']['what'] = $this->request->params['named']['what'];
            }
            if (!empty($this->request->params['named']['where'])) {
                $this->request->data['Coupon']['where'] = $this->request->params['named']['where'];
            }
            $this->autoRender = false;
            $this->render('print_index');
        } else if (!empty($this->request->params['named']['viewsearch']) && $this->request->params['named']['viewsearch'] == 'search') {
        } else if (!empty($this->request->params['named']['specialsearch']) && $this->request->params['named']['specialsearch'] == 'search') {
            $this->autoRender = false;
            $this->render('special_index');
        } else if (!empty($this->request->params['named']['tagsearch']) && $this->request->params['named']['tagsearch'] == 'search') {
            $this->autoRender = false;
            $this->render('top_index');
        } else if (!empty($this->request->params['named']['user_id'])) {
            $this->autoRender = false;
            $this->render('coupon_user-index');
        }
    }
    public function out($id)
    {
        $coupon = $this->Coupon->find('first', array(
            'conditions' => array(
                'Coupon.id = ' => $id
            ) ,
            'contain' => array(
                'Store' => array(
                    'fields' => array(
                        'Store.id',
                        'Store.name',
                        'Store.url',
                    )
                ) ,
            ) ,
            'fields' => array(
                'Coupon.id',
                'Coupon.title',
                'Coupon.slug',
                'Coupon.store_id',
                'Coupon.category_id',
                'Coupon.url',
                'Coupon.coupon_code',
                'Coupon.coupon_view_count',
            ) ,
            'recursive' => 1,
        ));
        //tracking the count
        if (count($coupon) > 0) {
            $user_id = $this->Auth->user('id');
            if (empty($user_id)) {
                $user_id = 0;
            }
            $store_id = $coupon['Store']['id'];
            $coupon_id = $id;
            $this->Coupon->CouponImpression->insertCouponImpression($user_id, $store_id, $coupon_id);
        }
		$search_pattern = '/http/';
		if(!preg_match($search_pattern, $coupon['Coupon']['url'], $matches))
		{
			$store_url='http://'.$coupon['Coupon']['url'];
		}
		else
		{
			$store_url=$coupon['Coupon']['url'];
		}
		if(!Configure::read('coupon.is_store_show_in_iframe'))
		{
			$this->redirect($store_url);
		}
		$this->set('store_url', $store_url);
        $this->set('coupon', $coupon);
        $this->layout = 'frame';
    }
    public function track()
    {
        if (!empty($this->request->params['named']['user_id'])) {
            $user_id = $this->request->params['named']['user_id'];
        } else {
            $user_id = 0;
        }
        $store_id = $this->request->params['named']['store_id'];
        $coupon_id = $this->request->params['named']['coupon_id'];
        $this->Coupon->CouponImpression->insertCouponImpression($user_id, $store_id, $coupon_id);
        echo 'success';
        exit;
    }
    public function add()
    {
        $this->pageTitle = __l('Add Coupon');
        if (!empty($this->request->data)) {
            $conditions = array();
			$this->request->data['Coupon']['coupon_status_type_id'] = ConstCouponTypeStatus::Normalcoupon;
			$this->request->data['Coupon']['user_id'] = ($this->Auth->user('id')) ? $this->Auth->user('id') : 0;
			if (!empty($this->request->data['Coupon']['tips'])) {
				$this->request->data['Coupon']['description'] = $this->request->data['Coupon']['tips'];
			}
			if (!empty($this->request->data['Coupon']['discount'])) {
				$this->request->data['Coupon']['description'] = $this->request->data['Coupon']['discount'];
			}
			if ($this->request->data['Coupon']['coupon_type_id'] == ConstCouponTypes::Printables) {
				$this->request->data['Coupon']['coupon_type_id'] = ConstCouponTypes::Printables;
			} else if (preg_match('/free shipping/i', $this->request->data['Coupon']['description']) || preg_match('/freeshipping/i', $this->request->data['Coupon']['description'])) {
				$this->request->data['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
			} else if (!empty($this->request->data['Coupon']['coupon_code'])) {
				$this->request->data['Coupon']['coupon_type_id'] = ConstCouponTypes::CouponCodes;
			} else {
				$this->request->data['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
			}
			$this->request->data['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
			// existing store detection
			$is_valid_store = 1;
			if (!empty($this->request->data['Store']['id']) && !empty($this->request->data['Store']['name'])) {
				$this->set('is_store_id', true);
				$this->request->data['Coupon']['store_id'] = $this->request->data['Store']['id'];
				$store = $this->Coupon->Store->find('first', array(
					'conditions' => array(
						'Store.id' => $this->request->data['Coupon']['store_id']
					) ,
					'recursive' => -1
				));
				if (!empty($store)) {
					unset($this->Coupon->Store->validate['url']);
					$this->set('store', $store);
				} else {
					$is_valid_store = 0;
				}
			} elseif (!empty($this->request->data['Coupon']['store_id'])) {
				$store = $this->Coupon->Store->find('first', array(
					'conditions' => array(
						'Store.id' => $this->request->data['Coupon']['store_id']
					) ,
					'recursive' => -1
				));
				if (!empty($store)) {
					$this->set('store', $store);
				}
			}
			$this->Coupon->set($this->request->data);
			$this->Store->set($this->request->data);
			if ($this->Coupon->validates() & $this->Store->validates() & $is_valid_store) {
				//new store
				if (empty($this->request->data['Store']['id']) && !empty($this->request->data['Store']['name'])) {
					require_once (COMPONENTS . 'affiliate.php');
					define('_THUMBALIZR', 1);
					$affiliate = new Affiliate();
					$data = array();
					$data['Store']['name'] = $this->request->data['Store']['name'];
					if (preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/', $this->request->data['Store']['url'], $matches)) {
						$data['Store']['url'] =  $matches[3].'.'.$matches[4];
					} else {
						$this->request->data['Store']['url'] = str_replace('http://', '', $this->request->data['Store']['url']);
						$url = $data['Store']['url'] = str_replace('www.', '', $this->request->data['Store']['url']);
					}
					$data['Store']['store_status_id'] = ConstStoreStatus::NewStore;
					$data['Store']['description'] = $affiliate->_grabDescriptions($url);
					$data['Store']['user_id'] = ($this->Auth->user('id')) ? $this->Auth->user('id') : 0;
					$data['Store']['ip_id'] = $this->Coupon->Store->toSaveIp();
					$host = $affiliate->_getjumphost($url);
					if ($this->Coupon->Store->save($data, false)) {
						$store_id = $this->Coupon->Store->getLastInsertId();
						$this->Coupon->sentStoreModeratorAlert($store_id);
						$this->request->data['Coupon']['store_id'] = $store_id;
						$store = $this->Coupon->Store->find('first', array(
							'conditions' => array(
								'Store.id' => $this->request->data['Coupon']['store_id']
							) ,
							'recursive' => -1
						));
						$this->set('store', $store);
						if (!empty($host)) {
							$affiliate->_fetchSiteThumb($this->Coupon, $store_id, $host);
						}
					}
				}
				if (!empty($store['Store']['is_partner'])) {
					$this->request->data['Coupon']['is_partner'] = 1;
				}
				$this->request->data['Coupon']['ip_id'] = $this->Coupon->toSaveIp();
				$this->request->data['Coupon']['coupon_status_id'] = $this->Coupon->findCouponStatus($store['Store']['id']);
				$this->Coupon->create();
				$this->Coupon->save($this->request->data, false);
				$coupon_id = $this->Coupon->getLastInsertId();
				$this->Coupon->sentCouponModeratorAlert($coupon_id);
				$this->Session->setFlash(__l('Coupon has been added.') , 'default', null, 'success');
				if ($this->RequestHandler->isAjax()) {
					echo 'Success';
					exit;
				} else {
					$this->redirect(array(
						'action' => 'index'
					));
				}
			} else {
				unset($this->Coupon->Store->validate['url']);
				$this->Session->setFlash(__l('Coupon could not be added. Please, try again.') , 'default', null, 'error');
			}
        } else {
            unset($this->Coupon->Store->validate['url']);
        }
        if (!isset($this->request->data['Coupon']['store'])) {
            $this->request->data['Coupon']['store'] = __l('example.com');
        }
        $this->set('storename', $this->request->data['Coupon']['store']);
        $couponTypes = $this->Coupon->CouponType->find('list');
		$couponTypes[4]=__l('Free shipping');
        $users = $this->Coupon->User->find('list');
        $categories = $this->Coupon->Category->find('list');
        $this->set(compact('categories', 'couponTypes', 'users'));
    }
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'q',
            'category',
            'store',
            'status'
        ));
        $this->pageTitle = __l('Coupons');
        $conditions = array();
        $conditionsarray = array();
        if (!empty($this->request->params['named']['stat'])) {
            $this->StatsFilter($this->request->params['named']['stat']);
        }
		
        if (!empty($this->request->params['named']['filter_id'])) {
            if ($this->request->params['named']['filter_id'] == ConstCouponTypeStatus::SpecialOffer) {
                $conditions['Coupon.coupon_type_status_id'] = ConstCouponTypeStatus::SpecialOffer;
				$this->pageTitle.= __l(' - SpecialOffer ');
            } else if ($this->request->params['named']['filter_id'] == ConstCouponTypeStatus::Normalcoupon) {
                $conditions['Coupon.coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
				$this->pageTitle.= __l(' - Normal Coupons ');
            } else if ($this->request->params['named']['filter_id'] == ConstCouponTypeStatus::Unreliable) {
                $conditions['Coupon.coupon_type_status_id'] = ConstCouponTypeStatus::Unreliable;
				$this->pageTitle.= __l(' - Unreliable Coupons ');
            }
        }		
        if (!empty($this->request->params['named']['coupon_type_id'])) {
            if ($this->request->params['named']['coupon_type_id'] == ConstCouponTypes::CouponCodes) {
                $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::CouponCodes;
				$this->pageTitle.= __l(' - Coupon Codes ');
            } else if ($this->request->params['named']['coupon_type_id'] == ConstCouponTypes::ShoppingTips) {
                $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::ShoppingTips;
				$this->pageTitle.= __l(' - Shopping Tips ');
            } else if ($this->request->params['named']['coupon_type_id'] == ConstCouponTypes::Printables) {
                $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::Printables;
				$this->pageTitle.= __l(' - Printables ');
            } else if ($this->request->params['named']['coupon_type_id'] == ConstCouponTypes::FreeShipping) {
                $conditions['Coupon.coupon_type_id'] = ConstCouponTypes::FreeShipping;
				$this->pageTitle.= __l(' - FreeShipping ');
            }
        }
        if (!empty($this->request->params['named']['status_id'])) {
            if ($this->request->params['named']['status_id'] == ConstCouponStatus::CheckStore) {
                $conditions['Coupon.coupon_status_id'] = ConstCouponStatus::CheckStore;
				$this->pageTitle.= __l(' - Check Stores');
            } else if ($this->request->params['named']['status_id'] == ConstCouponStatus::NewCoupon) {
                $conditions['Coupon.coupon_status_id'] = ConstCouponStatus::NewCoupon;
				$this->pageTitle.= __l(' - New Coupons ');
            } else if ($this->request->params['named']['status_id'] == ConstCouponStatus::RejectedStore) {
                $conditions['Coupon.coupon_status_id'] = ConstCouponStatus::RejectedStore;
				$this->pageTitle.= __l(' - Rejected Stores ');
            } else if ($this->request->params['named']['status_id'] == ConstCouponStatus::ActiveCoupon) {
                $conditions['Coupon.coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
				$this->pageTitle.= __l(' - Active Coupons ');
            } else if ($this->request->params['named']['status_id'] == ConstCouponStatus::RejectedCoupon) {
                $conditions['Coupon.coupon_status_id'] = ConstCouponStatus::RejectedCoupon;
				$this->pageTitle.= __l(' - Rejected Coupons ');
            } else if ($this->request->params['named']['status_id'] == ConstCouponStatus::OutdatedCoupon) {
                $conditions['Coupon.coupon_status_id'] = ConstCouponStatus::OutdatedCoupon;
				$this->pageTitle.= __l(' - Outdated Coupons ');
            } else if ($this->request->params['named']['status_id'] == ConstCouponStatus::Partner) {
                $conditions['Coupon.is_partner'] = 1;
				$this->pageTitle.= __l(' - Partners ');
            }
        }
        if (!empty($this->request->params['named']['affiliate_site_id'])) {
            $conditions['Coupon.affiliate_site_id'] = $this->request->params['named']['affiliate_site_id'];
        }

        if (!empty($this->request->params['named']['coupon_status_id'])) {
            $conditions['Coupon.coupon_status_id'] = $this->request->params['named']['coupon_status_id'];
        }
        if (!empty($this->request->params['named']['approval'])) {
            $conditions['Coupon.is_active'] = 0;
        }
        if (!empty($this->request->params['named']['coupon_status'])) {
            $conditions['Coupon.coupon_type_status_id'] = $this->request->params['named']['coupon_status'];
        }
        if (!empty($this->request->params['named']['status'])) {
            $conditions['Coupon.status_id'] = $this->request->params['named']['status'];
        }
        if (!empty($this->request->params['named']['track_count'])) {
            $conditions['Coupon.coupon_impression_count >'] = 0;
        }
        if (!empty($this->request->params['named']['stat'])) {
            if ($this->request->params['named']['stat'] == 'day') {
                $conditionsarray['TO_DAYS(NOW()) - TO_DAYS(CouponImpression.created) <= '] = 0;
                $conditions['TO_DAYS(NOW()) - TO_DAYS(Coupon.created) <= '] = 0;
            }
            if ($this->request->params['named']['stat'] == 'week') {
                $conditionsarray['TO_DAYS(NOW()) - TO_DAYS(CouponImpression.created) <= '] = 7;
                $conditions['TO_DAYS(NOW()) - TO_DAYS(Coupon.created) <= '] = 7;
            }
            if ($this->request->params['named']['stat'] == 'month') {
                $conditionsarray['TO_DAYS(NOW()) - TO_DAYS(CouponImpression.created) <= '] = 30;
                $conditions['TO_DAYS(NOW()) - TO_DAYS(Coupon.created) <= '] = 30;
            }
            if ($this->request->params['named']['stat'] == 'total') {
                $conditionsarray = array();
                $conditions = array();
            }
        }
        if (!empty($this->request->params['named']['code'])) {
            $couponids = $this->CouponImpression->find('list', array(
                'conditions' => $conditionsarray,
                'fields' => array(
                    'CouponImpression.coupon_id'
                ) ,
                'order' => array(
                    'CouponImpression.id' => 'DESC'
                ) ,
                'recursive' => -1
            ));
            $conditions['Coupon.id'] = $couponids;
        }
        $coupon_status_count = $this->Coupon->checkCouponCount();
        $this->set('coupon_status_count', $coupon_status_count);
        if (!empty($this->request->params['named']['category'])) {
            $conditions['Category.slug'] = $this->request->data['Coupon']['category'] = $this->request->params['named']['category'];
            $this->pageTitle.= sprintf(__l('- Category  - %s') , $this->request->params['named']['category']);
        }
        if (!empty($this->request->params['named']['store'])) {
            $conditions['Store.slug'] = $this->request->data['Coupon']['store'] = $this->request->params['named']['store'];
            $this->pageTitle.= sprintf(__l('- Store  - %s') , $this->request->params['named']['store']);
        }
        if (!empty($this->request->params['named']['status'])) {
            $conditions['Coupon.coupon_type_status_id'] = $this->request->data['Coupon']['status'] = $this->request->params['named']['status'];
        }
        $order = array(
            'Coupon.id' => 'DESC'
        );
        $this->Coupon->recursive = 2;
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'Store' => array(
                    'Attachment',
                    'fields' => array(
                        'Store.id',
                        'Store.name',
                        'Store.slug'
                    )
                ) ,
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username'
                    )
                ) ,
                'CouponStatus' => array(
                    'fields' => array(
                        'CouponStatus.id',
                        'CouponStatus.name',
                    )
                ) ,
                'Category' => array(
                    'fields' => array(
                        'Category.id',
                        'Category.title',
                        'Category.slug',
                    )
                ) ,
                'AffiliateSite' => array(
                    'fields' => array(
                        'AffiliateSite.id',
                        'AffiliateSite.name',
                    )
                ) ,
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
            ) ,
            'order' => $order,
        );
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['Coupon']['q'] = $this->request->params['named']['q'];
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['Coupon']['q']
            ));
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $stores = $this->Coupon->Store->find('list', array(
            'conditions' => array(
                'Store.store_status_id' => ConstStoreStatus::ActiveStore
            ) ,
            'order' => array(
                'Store.name' => 'ASC'
            ) ,
            'recursive' => -1
        ));
        $categories = $this->Coupon->Category->find('list', array(
            'conditions' => array(
                'Category.is_active' => 1
            ) ,
            'order' => array(
                'Category.title' => 'ASC'
            ) ,
            'recursive' => -1
        ));
        $this->set('active_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::Normalcoupon
            ) ,
            'recursive' => -1
        )));
        $this->set('unreliable_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::Unreliable
            ) ,
            'recursive' => -1
        )));
        $this->set('special_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::SpecialOffer
            ) ,
            'recursive' => -1
        )));
        $this->set('partner_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.is_partner' => 1
            ) ,
            'recursive' => -1
        )));		
        $this->set('couponcode_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_id' => ConstCouponTypes::CouponCodes
            ) ,
            'recursive' => -1
        )));		
        $this->set('shoppingtip_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_id' => ConstCouponTypes::ShoppingTips
            ) ,
            'recursive' => -1
        )));
        $this->set('printable_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_id' => ConstCouponTypes::Printables
            ) ,
            'recursive' => -1
        )));
        $this->set('freeshipping_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_id' => ConstCouponTypes::FreeShipping
            ) ,
            'recursive' => -1
        )));
        $this->set('checkstore_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_status_id' => ConstCouponStatus::CheckStore
            ) ,
            'recursive' => -1
        )));
        $this->set('newcoupon_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_status_id' => ConstCouponStatus::NewCoupon
            ) ,
            'recursive' => -1
        )));
        $this->set('activecoupon_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_status_id' => ConstCouponStatus::ActiveCoupon
            ) ,
            'recursive' => -1
        )));
        $this->set('rejectedstore_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_status_id' => ConstCouponStatus::RejectedStore
            ) ,
            'recursive' => -1
        )));
        $this->set('rejectedcoupon_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_status_id' => ConstCouponStatus::RejectedCoupon
            ) ,
            'recursive' => -1
        )));
        $this->set('outdatedcoupon_count', $this->Coupon->find('count', array(
            'conditions' => array(
                'Coupon.coupon_status_id' => ConstCouponStatus::OutdatedCoupon
            ) ,
            'recursive' => -1
        )));
        $affiliateSites = $this->Coupon->getAffiliateSites(true);
        $affiliate_coupon_count = array();
        foreach($affiliateSites as $affiliate_site_id => $affiliate_site_name) {
            $affiliate_coupon_count[$affiliate_site_id] = $this->Coupon->find('count', array(
                'conditions' => array(
                    'Coupon.affiliate_site_id' => $affiliate_site_id
                ) ,
                'recursive' => -1
            ));
        }		
        $this->set('affiliateSites', $affiliateSites);
        $this->set('affiliate_coupon_count', $affiliate_coupon_count);
        $moreActions = $this->Coupon->moreActions;
        $this->set(compact('moreActions'));
        $this->set(compact('stores', 'categories'));
        $this->set('coupons', $this->paginate());
    }
    public function simillar()
    {
        $conditions = array();
        $this->pageTitle = __l('Simillar tags and stores');
        if (isset($this->request->params['named']['store'])) {
            $store = $this->Coupon->Store->find('first', array(
                'conditions' => array(
                    'Store.slug' => $this->request->params['named']['store']
                ) ,
                'fields' => array(
                    'Store.id',
                ) ,
                'recursive' => -1,
            ));
            $store_id = $store['Store']['id'];
            $couponList = $this->Coupon->find('list', array(
                'conditions' => array(
                    'Coupon.store_id' => $store_id
                ) ,
                'fields' => array(
                    'Coupon.id',
                ) ,
                'recursive' => -1,
            ));
            $couponsTagList = $this->Coupon->CouponTag->CouponsCouponTag->find('all', array(
                'conditions' => array(
                    'CouponsCouponTag.coupon_id' => $couponList
                ) ,
                'fields' => array(
                    'CouponsCouponTag.coupon_tag_id',
					'CouponsCouponTag.coupon_id',
                ) ,
                'recursive' => -1,
            ));
			$couponsTagList=array_unique($couponsTagList);
            $other_coupons = array();
			foreach($couponsTagList as $taglist)
			{
				$otherlist = $this->Coupon->CouponTag->CouponsCouponTag->find('all', array(
                'conditions' => array(
                    'CouponsCouponTag.coupon_tag_id' => $taglist['CouponsCouponTag']['coupon_tag_id'],
                    'CouponsCouponTag.coupon_id !=' => $taglist['CouponsCouponTag']['coupon_id'],
                ) ,
                'fields' => array(
                    'CouponsCouponTag.coupon_id',
                ) ,
                'recursive' => -1,
				));
				foreach($otherlist as $other)
				{
					$other_coupons[]=$other['CouponsCouponTag']['coupon_id'];
				}
			}
        $other_coupons = array_unique($other_coupons);
		$storeList = $this->Coupon->find('list', array(
                'conditions' => array(
                    'Coupon.id' => $other_coupons,
					'Coupon.store_id !=' => $store['Store']['id'],
					'Coupon.coupon_status_id' => array(
								ConstCouponStatus::ActiveCoupon,
								ConstCouponStatus::OutdatedCoupon
							), 
			) ,
                'fields' => array(
                    'Coupon.store_id',
                ) ,
                'recursive' => -1,
            )); 
        }
		$storeList=array_unique($storeList);
        $similarstores_condition = $similarstores = array();
        $similarstores_condition['Store.id'] = $storeList;
		if(!empty($storeList))
		{
			$similarstores = $this->Store->find('all', array(
				'conditions' => $similarstores_condition,
				'recursive' => 1,
				'contain' => array(
					'Coupon' => array(
						'fields' => array(
							'Coupon.id',
							'Coupon.store_id',
							'Coupon.description',
						) ,
						'limit' => 1
					) ,
					'Attachment' 
				) ,
				'fields' => array(
					'id',
					'description',
					'url',
					'name',
					'slug',
				) ,
			'recursive' => 2,
			));
		}
        $this->set('stores', $store);
        $this->set('similarstores', $similarstores);
    }
    public function admin_add()
    {
     $this->pageTitle = __l('Add Coupon');
        if (!empty($this->request->data)) {
            $this->request->data['Coupon']['is_active'] = 1;
            $this->request->data['Coupon']['user_id'] = $this->Auth->user('id');
            $this->request->data['Coupon']['is_active'] = 1; //auto approval;
            if (!empty($this->request->data['Coupon']['store_id'])) {
                $this->request->data['Coupon']['coupon_status_id'] = $this->Coupon->findCouponStatus($this->request->data['Coupon']['store_id']);
            }
            $this->Coupon->set($this->request->data);
            if ($this->Coupon->validates()) {
                $this->Coupon->create();
				$this->request->data['Coupon']['ip_id'] = $this->Coupon->toSaveIp();
                if ($this->Coupon->save($this->request->data)) {
                    $this->Session->setFlash(__l('Coupon has been added.') , 'default', null, 'success');
                    $this->redirect(Router::url(array(
                        'controller' => 'coupons',
                        'action' => 'index'
                    ) , true));
                }
            } else {
                $this->Session->setFlash(__l('Coupon could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $stores = $this->Coupon->Store->find('list', array(
            'conditions' => array(
                'Store.store_status_id' => array(
                    ConstStoreStatus::ActiveStore,
                    ConstStoreStatus::NewStore,
                ) ,
            ) ,
            'order' => array(
                'Store.name' => 'ASC'
            ) ,
            'recursive' => -1
        ));
        $couponStatuses = $this->Coupon->CouponStatus->find('list');
        $couponTypeStatuses = $this->Coupon->CouponTypeStatus->find('list');
        $categories = $this->Coupon->Category->find('list', array(
            'conditions' => array(
                'Category.is_active' => 1
            ) ,
            'order' => array(
                'Category.title' => 'ASC'
            ) ,
            'recursive' => -1
        ));
        if (empty($this->request->data['Coupon']['coupon_status_id'])) {
            $this->request->data['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
        }
        if (empty($this->request->data['Coupon']['coupon_type_status_id'])) {
            $this->request->data['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
        }
        $couponTypes = $this->Coupon->CouponType->find('list');
		$couponTypes[4]=__l('Free shipping');
        $this->set(compact('stores', 'categories', 'couponStatuses', 'couponTypeStatuses', 'couponTypes'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Coupon');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Coupon']['tips'])) {
                $this->request->data['Coupon']['description'] = $this->request->data['Coupon']['tips'];
            }
            if (!empty($this->request->data['Coupon']['discount'])) {
                $this->request->data['Coupon']['description'] = $this->request->data['Coupon']['discount'];
            }
            if (!empty($this->request->data['Coupon']['store_id'])) {
                $this->request->data['Coupon']['coupon_status_id'] = $this->Coupon->findCouponStatus($this->request->data['Coupon']['store_id']);
            }
            if ($this->Coupon->save($this->request->data)) {
                $this->Session->setFlash(__l('Coupon has been updated.') , 'default', null, 'success');
                $this->redirect(array(
                    'controller' => 'coupons',
                    'action' => 'index',
                ));
            } else {
                $this->Session->setFlash(__l('Coupon could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->Coupon->find('first', array(
                'conditions' => array(
                    'Coupon.id' => $id
                ) ,
                'contain' => array(
                    'CouponTag' => array(
                        'fields' => array(
                            'CouponTag.name'
                        )
                    ) ,
                    'Category' => array(
                        'fields' => array(
                            'Category.id',
                            'Category.title'
                        )
                    ) ,
                    'Store' => array(
                        'fields' => array(
                            'Store.id',
                            'Store.name'
                        )
                    )
                ) ,
                'recursive' => 2
            ));
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
           $this->request->data['Coupon']['tag'] = $this->Coupon->formatTags($this->request->data['CouponTag']);
        }
        $stores = $this->Coupon->Store->find('list', array(
            'conditions' => array(
                'Store.store_status_id' => array(
                    ConstStoreStatus::ActiveStore,
                    ConstStoreStatus::NewStore,
                ) ,
            ) ,
            'order' => array(
                'Store.name' => 'ASC'
            ) ,
            'recursive' => -1
        ));
        $couponStatuses = $this->Coupon->CouponStatus->find('list');
        $categories = $this->Coupon->Category->find('list', array(
            'conditions' => array(
                'Category.is_active' => 1
            ) ,
            'order' => array(
                'Category.title' => 'ASC'
            ) ,
            'recursive' => -1
        ));
        $couponTypeStatuses = $this->Coupon->CouponTypeStatus->find('list');
        $couponTypes = $this->Coupon->CouponType->find('list');
		$couponTypes[4]=__l('Free shipping');
        $this->set(compact('stores', 'categories', 'couponStatuses', 'couponTypeStatuses', 'couponTypes'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Coupon->delete($id)) {
            $this->Session->setFlash(__l('Coupon deleted') , 'default', null, 'success');
			if(!empty($this->request->params['named']['type']) && $this->request->params['named']['type']=='flag')
			{
				$this->redirect(array(
					'controller' => 'coupon_flags',
					'action' => 'index'
				));
			}
			else
			{
				$this->redirect(array(
					'action' => 'index'
				));
			}
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_import()
    {
    $this->pageTitle = __l('CSV Import');
        if (!empty($this->request->data)) {
            $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('storecsv.file'));
            $this->Attachment->set($this->request->data);
			if(empty($this->request->data['Attachment']['filename']['tmp_name']) && empty($this->request->data['Coupon']['url']))
			{
                    $this->Session->setFlash(__l('You have to attach the file or direct url of csv has to give') , 'default', null, 'error');
                    $this->redirect(array(
                        'controller' => 'coupons',
                        'action' => 'admin_import'
                    ));
			}
			if(empty($this->request->data['Attachment']['filename']['tmp_name']))
			{
				unset($this->Attachment->validate['filename']);
			}

			if(!empty($this->request->data['Attachment']['filename']['tmp_name']))
			{
				$filename=$this->request->data['Attachment']['filename']['tmp_name'];
			}
			else if(!empty($this->request->data['Coupon']['url']))
			{
				$filename=$this->request->data['Coupon']['url'];
			}
            //$attachmentValidation = $this->Attachment->validate;
            if ($this->Attachment->validates()) {
                $messages = $this->{$this->modelClass}->import($filename, 'Coupon');
                if (!empty($messages['messages'][0])) {
                    $this->Session->setFlash(__l('Coupons has been imported successfully') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'coupons',
                        'action' => 'index'
                    ));
                } else if (!empty($messages['errors'][0])) {
                    $this->Session->setFlash(__l('Coupons not imported') , 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash(__l('Coupons not imported') , 'default', null, 'error');
            }
        }
    }
    public function search_box()
    {
        //example searches
        $search_data = $this->CouponTag->find('all', array(
            'fields' => array(
                'CouponTag.name',
                'CouponTag.slug'
            ) ,
            'limit' => 3,
            'order' => array(
                'CouponTag.coupon_count' => 'desc'
            ) ,
            'recursive' => -1
        ));
        $search = array();
        foreach($search_data as $data) {
            $search[$data['CouponTag']['name']] = Router::url(array(
                'controller' => 'stores',
                'action' => 'index',
                'tag' => $data['CouponTag']['slug']
            ) , true);
        }
        $search_data = $this->Store->find('all', array(
            'conditions' => array(
                'Store.name !=' => 'empty'
            ) ,
            'fields' => array(
                'Store.name',
                'Store.slug'
            ) ,
            'limit' => 3,
            'order' => array(
                'Store.coupon_count ' => 'desc'
            ) ,
            'recursive' => -1
        ));
        foreach($search_data as $data) {
            $pattern = '/.com/';
            $subject = $data['Store']['name'];
            if (!preg_match($pattern, $subject, $matches)) {
                $store_name_with_com = str_replace(' ', '', $data['Store']['name']) . '.com';
            } else {
                $store_name_with_com = str_replace(' ', '', $data['Store']['name']);
            }
            $search[$store_name_with_com] = Router::url(array(
                'controller' => 'stores',
                'action' => 'view',
                $data['Store']['slug']
            ) , true);
        }
        // rand array with no key value changes
        $new = array();
        $c = count($search);
        $k = array_keys($search);
        $v = array_values($search);
        foreach($search_data as $data) {
            $search[$data['Store']['slug']] = Router::url(array(
                'controller' => 'stores',
                'action' => 'view',
                $data['Store']['slug']
            ) , true);
        }
        while ($c > 0) {
            $i = array_rand($k);
            $new[$k[$i]] = $v[$i];
            unset($k[$i]); //exlude selected number from list
            $c--;
        }
        $this->set('search', $new);
    }
    public function admin_update()
    {
        $this->autoRender = false;
        if (!empty($this->request->data['Coupon'])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $couponids = array();
            foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                if ($is_checked['id']) {
                    $couponids[] = $coupon_id;
                }
            }
            if ($actionid && !empty($couponids)) {
                if ($actionid == ConstMoreActionCoupon::ActiveStatus) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.is_active' => 1
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon activated successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Activecoupon) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::Normalcoupon
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to active successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Specialoffer) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::SpecialOffer
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to special offer successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Unreliable) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::Unreliable
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to unreliable successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::CouponCode) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_id' => ConstCouponTypes::CouponCodes
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon type changed to coupon code successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Shoppingtip) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_id' => ConstCouponTypes::ShoppingTips
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon type changed to shopping tips successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Printables) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_id' => ConstCouponTypes::Printables
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon type changed to printable coupons successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Freeshipping) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.coupon_type_id' => ConstCouponTypes::FreeShipping
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon type changed to free shipping successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::CheckStore) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
							$data=array();
							$data['Coupon']['id']=$coupon_id;
							$data['Coupon']['coupon_status_id']=ConstCouponStatus::CheckStore;
							$this->Coupon->save($data,false);
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to check store successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::RejectedStore) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
							$data=array();
							$data['Coupon']['id']=$coupon_id;
							$data['Coupon']['coupon_status_id']=ConstCouponStatus::RejectedStore;
							$this->Coupon->save($data,false);
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to rejected store successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::NewCoupon) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
							$data=array();
							$data['Coupon']['id']=$coupon_id;
							$data['Coupon']['coupon_status_id']=ConstCouponStatus::NewCoupon;
							$this->Coupon->save($data,false);
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to new coupon successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::ActivesCoupon) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
							$data=array();
							$data['Coupon']['id']=$coupon_id;
							$data['Coupon']['coupon_status_id']=ConstCouponStatus::ActiveCoupon;
							$this->Coupon->save($data,false);
                            //send newsletter
                            $this->Coupon->sentSubscriptionmail($coupon_id);
							//update social networking
							$this->Coupon->socialCouponUpdates($coupon_id);
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to active coupon successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::RejectedCoupon) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
							$data=array();
							$data['Coupon']['id']=$coupon_id;
							$data['Coupon']['coupon_status_id']=ConstCouponStatus::RejectedCoupon;
							$this->Coupon->save($data,false);
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to rejected coupon successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::OutdatedCoupon) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
							$data=array();
							$data['Coupon']['id']=$coupon_id;
							$data['Coupon']['coupon_status_id']=ConstCouponStatus::OutdatedCoupon;
							$this->Coupon->save($data,false);
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to outdated coupon successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Partner) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->Coupon->updateAll(array(
                                'Coupon.is_partner' => 1
                            ) , array(
                                'Coupon.id' => $coupon_id
                            ));
                        }
                    }
                    $this->Session->setFlash('Coupon status changed to partner coupon successfully', 'default', null, 'success');
                } elseif ($actionid == ConstMoreActionCoupon::Delete) {
                    foreach($this->request->data['Coupon'] as $coupon_id => $is_checked) {
                        if ($is_checked['id']) {
                            $this->{$this->modelClass}->delete($coupon_id);
                        }
                    }
                    $this->Session->setFlash(__l('Checked coupons has been deleted') , 'default', null, 'success');
                }
            }
        }
        $this->redirect(Router::url('/', true) . $r);
    }
    public function admin_coupon_delete()
    {
        $coupons = $this->Coupon->find('all', array(
            'conditions' => array(
                'Coupon.status_id' => ConstStatuses::Expired
            ) ,
            'fields' => array(
                'Coupon.id',
                'Coupon.status_id',
            ) ,
            'recursive' => -1
        ));
        $coupon_ids = array();
        if (!empty($coupons)) {
            foreach($coupons as $coupon) {
                $coupon_ids[] = $coupon['Coupon']['id'];
            }
            $this->Coupon->deleteAll(array(
                'Coupon.id' => $coupon_ids
            ));
            $this->Session->setFlash('Coupon deleted successfully', 'default', null, 'success');
        } else {
            $this->Session->setFlash('No expired coupons available', 'default', null, 'error');
        }
        $this->redirect(array(
            'controller' => 'coupons',
            'action' => 'index'
        ));
    }
}
?>
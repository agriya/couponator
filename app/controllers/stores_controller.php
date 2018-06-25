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
class StoresController extends AppController
{
    public $name = 'Stores';
    public $uses = array(
        'Store',
        'Country',
        'State',
        'City',
        'StoreStatus',
        'Attachment',
        'Subscription',
        'Coupon',
        'CouponTag',
        'CouponType',
        'CouponImpression',
        'CouponFeedback',
        'User',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment.filename',
            'Store.latitude',
            'Store.longitude',
            'Store.id',
			'Store.name',
			'Store.id',
            'Store.country_id',
            'City.name',
            'State.name',
            'City.id',
            'State.id',
			'Coupon.store',
			'Coupon.store_id',
			'Coupon.store_slug',
			'Coupon.type',
			'Coupon.store_name',
        );
        parent::beforeFilter();
    }
    public function instant()
    {
		$conditions = array(			
			'OR' => array(
				'Store.name LIKE' => '%' . $this->request->query['q'] . '%',
				'Store.url LIKE' => '%' . $this->request->query['q'] . '%'
			) ,
			'AND' => array(
				'Store.affiliate_site_id' => $this->Store->getAffiliateSites() ,
				'Store.store_status_id' => ConstStoreStatus::ActiveStore,
				'Store.coupon_count >' => 0					
			)
		);
		$stores = $this->Store->find('all', array(
            'conditions' => $conditions,
            'fields' => array(
                'Store.id',
                'Store.name',
                'Store.slug',
                'Store.url',
            ) ,
            'contain' => array(
                'Attachment' => array(
                    'fields' => array(
                        'Attachment.id',
                        'Attachment.dir',
                        'Attachment.filename',
                        'Attachment.width',
                        'Attachment.height'
                    ) ,
                ) ,
            ) ,
            'recursive' => 1,
        ));
        $image_options = array(
            'dimension' => 'big_thumb',
            'type' => 'jpg',
			'full_url' => true
        );
        foreach($stores as &$store) {
            $store['Store']['img'] = getImageUrl('Store', $store['Attachment'], $image_options);
        }
        $this->view = 'Json';
        $this->set('json', $stores);
    }
    public function search()
    {
		if (!empty($this->request->params['named']['keyword'])) {
			$this->request->data['Store']['keyword'] = $this->request->params['named']['keyword'];
		}
        if (!empty($this->request->data)) {
            $keyword = $this->request->data['Store']['keyword'];
			$this->Store->toSaveKeyword($keyword);
            $conditions = array();
			$conditions['OR']['Store.name LIKE'] = '%' . $keyword . '%';
			$conditions['OR']['Store.description LIKE'] = '%' . $keyword . '%';
			$conditions['OR']['Store.slug'] = '%' . Inflector::slug($keyword,'-') . '%';
			$conditions['OR']['Store.url LIKE'] = '%' . $keyword . '%';
			$couponTag = $this->Store->Coupon->CouponTag->find('first', array(
                'conditions' => array(
                    'CouponTag.slug' => Inflector::slug($keyword, '-')
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
				array_unique($coupon_ids);
            } 
			if(!empty($coupon_ids))
			{
				$store_ids = $this->Coupon->find('list', array(
					'conditions' => array(
						'Coupon.id' => $coupon_ids,
					) ,
					'fields' => array(
						'Coupon.store_id'
					) ,
					'recursive' => -1
				));
				$conditions['OR']['Store.id']=$store_ids; 
			}
			$conditions['Store.store_status_id']=ConstStoreStatus::ActiveStore;
			$this->paginate = array(
				'conditions' => $conditions,
				'contain' => array(
					'Coupon' => array(
						'fields' => array(
							'Coupon.id',
							'Coupon.description',
						) ,
					) ,
					'Attachment' => array(
						'fields' => array(
							'Attachment.id',
							'Attachment.dir',
							'Attachment.filename',
							'Attachment.width',
							'Attachment.height'
						) ,
					) ,
				) ,
				'fields' => array(
					'Store.id',
					'Store.name',
					'Store.slug',
					'Store.url',
				) ,
				'order' => array(
					'Store.id' => 'DESC'
				) ,
				'recursive' => 1,
			);
			$this->set('stores', $this->paginate());
			$this->render('index');
        }
    }
    public function index()
    {
		$this->_redirectPOST2Named(array(
            'q',
            'searchtype'
        ));
        $conditions = array();
        if (!empty($this->request->params['named']['q'])) {
            $conditions['OR']['Store.name LIKE'] = '%' . $this->request->params['named']['q'] . '%';
            $conditions['OR']['Store.description LIKE'] = '%' . $this->request->params['named']['q'] . '%';
            $conditions['OR']['Store.url LIKE'] = '%' . $this->request->params['named']['q'] . '%';
        }
        if (!empty($this->request->params['named']['zipcode'])) {
            $conditions['Store.zip_code'] = $this->request->params['named']['zipcode'];
        }
        if (!empty($this->request->params['named']['view_name']) && $this->request->params['named']['view_name'] == 'favorite') {
            $this->pageTitle = __l('Favorite Coupons');
            if (!empty($this->request->params['named']['username'])) {
                $user_fav = $this->Coupon->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $this->request->params['named']['username']
                    ) ,
                    'fields' => array(
                        'User.id'
                    ) ,
                    'recursive' => -1
                ));
                $user_id = $user_fav['User']['id'];
            }
            if (empty($user_id)) {
                $user_id = $this->Auth->user('id');
            }
            $coupon_id = array();
            $coupons_favorites = $this->Coupon->CouponFavorite->find('all', array(
                'conditions' => array(
                    'CouponFavorite.user_id' => $user_id
                ) ,
                'fields' => array(
                    'CouponFavorite.id',
                    'CouponFavorite.user_id',
                    'CouponFavorite.coupon_id',
                ) ,
                'contain' => array(
                    'Coupon.store_id'
                ) ,
                'recursive' => 0
            ));
            $store_id = array();
            foreach($coupons_favorites as $coupons_favorite) {
                $store_id[] = $coupons_favorite['Coupon']['store_id'];
            }
            $store_ids = array_unique($store_id);
            $conditions['Store.id'] = $store_ids;
        } elseif (!empty($this->request->params['named']['view_name']) && $this->request->params['named']['view_name'] == 'popular') {
			$this->set('page_title', __l('Popular Stores'));
			$store_ids = $this->Coupon->find('list', array(
				'conditions' => array(
					'Coupon.admin_suspend !=' => 1,
					'Coupon.coupon_status_id' =>array(ConstCouponStatus::ActiveCoupon,ConstCouponStatus::OutdatedCoupon)
				) ,
				'fields' => array(
					'Coupon.store_id'
				) ,
				'recursive' => -1
			));
			$conditions['Store.id'] = $store_ids;
		} elseif (!empty($this->request->params['named']['tag'])) {
			$couponTag = $this->Store->Coupon->CouponTag->find('first', array(
                'conditions' => array(
                    'CouponTag.slug' => $this->request->params['named']['tag']
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
                    'CouponTag.name',
                ) ,
                'recursive' => 1
            ));
			$store_ids = array();
            if (!empty($couponTag['Coupon'])) {
				foreach($couponTag['Coupon'] as $tag) {
					$store_ids[] = $tag['store_id'];
				}
	            $conditions['Store.id'] = $store_ids;
				$this->set('tag_name', $couponTag['CouponTag']['name']);
            } else {
				$conditions['Store.id'] = 0;
			}
		}
		$conditions['Store.coupon_count >'] = 0;
		$conditions['Store.affiliate_site_id'] = $this->Store->getAffiliateSites();
		$conditions['Store.store_status_id'] = ConstStoreStatus::ActiveStore;
		$this->paginate = array(
			'conditions' => $conditions,
			'contain' => array(
				'Attachment'
			) ,
			'order' => array(
				'Store.id' => 'DESC'
			) ,
			'recursive' => 1,
		);
		$this->set('stores', $this->paginate());
        if (!empty($this->request->params['named']['view_name']) && $this->request->params['named']['view_name'] == 'popular') {
            $this->render('popular');
        }
        if (!empty($this->request->params['named']['view_name']) && $this->request->params['named']['view_name'] == 'favorite') {
            $this->render('favorite-index');
        }
        if (!empty($this->request->params['named']['tag'])) {
            $this->autoRender = false;
            $this->render('store_listing');
        }
        if (!empty($this->request->params['named']['zipcode'])) {
            $this->autoRender = false;
            $this->render('store-location');
        }
    }
    public function view($slug = null)
    {
        $this->_redirectPOST2Named(array(
            'store'
        ));
        if (isset($this->request->params['named']['store'])) {
            $slug = $this->request->params['named']['store'];
            $this->pageTitle.= sprintf(__l('- Store  - %s') , $this->request->params['named']['store']);
        }
        if (is_null($slug)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $store = $this->Store->find('first', array(
            'conditions' => array(
                'Store.slug' => $slug,
                'Store.affiliate_site_id' => $this->Store->getAffiliateSites() ,
            ) ,
            'contain' => array(
                'Coupon' => array(
                    'fields' => array(
                        'Coupon.id',
                        'Coupon.url',
                        'Coupon.coupon_code',
                    )
                ) ,
                'Attachment' => array(
                    'fields' => array(
                        'Attachment.id',
                        'Attachment.dir',
                        'Attachment.filename',
                        'Attachment.width',
                        'Attachment.height'
                    ) ,
                    'limit' => 1
                ) ,
            ) ,
            'recursive' => 1,
        ));
        if (empty($store) || ((!empty($store['Store']['admin_suspend']) || $store['Store']['store_status_id'] != ConstStoreStatus::ActiveStore) && $this->Auth->user('user_type_id') != ConstUserTypes::Admin)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		if (!empty($store['Store']['name'])) {
            Configure::write('meta.store_name', $store['Store']['name']);
        }
        if (!empty($store['Attachment'])) {
            $image_options = array(
                'dimension' => 'medium_thumb',
                'class' => '',
                'alt' => $store['Store']['name'],
                'title' => $store['Store']['name'],
                'type' => 'png'
            );
            Configure::write('meta.store_image', Router::url('/', true) . getImageUrl('Store', $store['Attachment'], $image_options));
        }
        $this->Store->StoreView->create();
        if ($this->Auth->user('id')) {
            $data['StoreView']['user_id'] = $this->Auth->user('id');
        } else {
            $data['StoreView']['user_id'] = 0;
        }
        $this->request->data['Coupon']['store'] = $store['Store']['slug'];
        $this->request->data['Coupon']['store_slug'] = $store['Store']['slug'];
        $this->request->data['Coupon']['store_id'] = $store['Store']['id'];
        $data['StoreView']['store_id'] = $store['Store']['id'];
        $this->request->data['Subscription']['store_id'] = $store['Store']['id'];
        $this->request->data['Subscription']['store_slug'] = $slug;
        $data['StoreView']['ip_id'] = $this->Store->StoreView->toSaveIp();
        $this->Store->StoreView->save($data, false);
        if (!empty($store['Store']['meta_keywords'])) {
            Configure::write('meta.keywords', $store['Store']['meta_keywords']);
        }
        if (!empty($store['Store']['meta_description'])) {
            Configure::write('meta.description', $store['Store']['meta_description']);
        }
        $this->pageTitle = $store['Store']['name'] . __l(' Coupon Codes - all coupons , discounts and promo codes for ') . $store['Store']['slug'];
        $this->set('store', $store);
        $this->set('storename', $store['Store']['name']);
        $couponTypes = $this->CouponType->find('list');
		$couponTypes[4]=__l('Free shipping');
        $users = $this->User->find('list');
        $this->set(compact('couponTypes', 'users'));
    }
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'q',
            'filter_id',
        ));
        $this->pageTitle = __l('Stores');
        $conditions = array();
        if (!empty($this->request->params['named']['stat'])) {
            $this->StatsFilter($this->request->params['named']['stat']);
        }
		if (!empty($this->request->params['named']['affiliate_site_id'])) {
            $conditions['Store.affiliate_site_id'] = $this->request->params['named']['affiliate_site_id'];
        }
		if (!empty($this->request->params['named']['stat'])) {
            if ($this->request->params['named']['stat'] == 'day') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(Store.created) <= '] = 0;
            }
            if ($this->request->params['named']['stat'] == 'week') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(Store.created) <= '] = 7;
            }
            if ($this->request->params['named']['stat'] == 'month') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(Store.created) <= '] = 30;
            }
          
        }
        $store_status_count = $this->Store->checkStoreStatusCount();		
        $this->set('store_status_count', $store_status_count);

        $this->set('store_manual_count', $this->Store->find('count', array(
            'conditions' => array(
                'Store.is_manual_update = ' => 1
            ) ,
            'recursive' => -1
        )));
       $this->set('store_auto_count', $this->Store->find('count', array(
            'conditions' => array(
               'Store.is_manual_update = ' => 2,
            ),
            'recursive'=> -1,
        )));
             if (!empty($this->request->params['named']['status_id'])) {
            if ($this->request->params['named']['status_id'] == ConstStoreStatus::NewStore) {
                $conditions['Store.store_status_id'] = ConstStoreStatus::NewStore;
                $this->pageTitle.= __l(' - New Store ');
            } else if ($this->request->params['named']['status_id'] == ConstStoreStatus::ActiveStore) {
                $conditions['Store.store_status_id'] = ConstStoreStatus::ActiveStore;
                $this->pageTitle.= __l(' - Active Store ');
            } else if ($this->request->params['named']['status_id'] == ConstStoreStatus::RejectedStore) {
                $conditions['Store.store_status_id'] = ConstStoreStatus::RejectedStore;
                $this->pageTitle.= __l(' - Rejected Store ');
            }else if ($this->request->params['named']['status_id'] == ConstStoreStatus::Partner) {
                $conditions['Store.is_partner'] = 1;
                $this->pageTitle.= __l(' - Partner ');
            }
            $this->request->data['Store']['status_id'] = $this->request->params['named']['status_id'];
        }
        if (!empty($this->request->params['named']['update_id'])) {
            if ($this->request->params['named']['update_id'] == ConstStoreUpdate::Manual) {
                $conditions['Store.is_manual_update'] = 1;
                $this->pageTitle.= __l(' - Manaully Updated Store ');
            } else if ($this->request->params['named']['update_id'] == ConstStoreUpdate::Auto) {
                $conditions['Store.is_manual_update'] = 2;
                $this->pageTitle.= __l(' - Auto Updated Store ');
            } 
            $this->request->data['Store']['update_id'] = $this->request->params['named']['update_id'];
        }
		
        $this->Store->recursive = 2;
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'City' => array(
                    'fields' => array(
                        'City.id',
                        'City.name'
                    )
                ) ,
                'State' => array(
                    'fields' => array(
                        'State.id',
                        'State.name'
                    )
                ) ,
                'Country' => array(
                    'fields' => array(
                        'Country.id',
                        'Country.name'
                    )
                ) ,
                'AffiliateSite' => array(
                    'fields' => array(
                        'AffiliateSite.id',
                        'AffiliateSite.name'
                    )
                ) ,
                'Attachment' => array(
                    'fields' => array(
                        'Attachment.id',
                        'Attachment.dir',
                        'Attachment.filename',
                        'Attachment.width',
                        'Attachment.height'
                    ) ,
                ) ,
				'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
            ) ,
            'order' => array(
                'Store.id' => 'DESC'
            ) ,
        );
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['Store']['q'] = $this->request->params['named']['q'];
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['Store']['q']
            ));
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $moreActions = $this->Store->moreActions;
        $this->set(compact('moreActions'));
        $this->set('stores', $this->paginate());
		$affiliateSites = $this->Store->getAffiliateSites(true);
		$affiliate_store_count = array();
		foreach($affiliateSites as $affiliate_site_id => $affiliate_site_name) {
			$affiliate_store_count[$affiliate_site_id] = $this->Store->find('count', array(
				'conditions' => array(
					'Store.affiliate_site_id' => $affiliate_site_id
				) ,
				'recursive' => -1
			));
		}
		$this->set('affiliateSites', $affiliateSites);
		$this->set('affiliate_store_count', $affiliate_store_count);
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Store');
        $this->Store->Attachment->Behaviors->attach('ImageUpload', Configure::read('coupon.file'));
        if (!empty($this->request->data)) {
            //state and country looking
            if (!empty($this->request->data['City']['name'])) {
                $this->request->data['Store']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->Store->City->findOrSaveAndGetId($this->request->data['City']['name']);
            }
            if (!empty($this->request->data['Store']['country_id'])) {
                $this->request->data['Store']['country_id'] = $this->Store->Country->findCountryId($this->request->data['Store']['country_id']);
            }
			else
			{
				$this->request->data['Store']['country_id'] =0;
			}
			$this->request->data['Store']['is_manual_update'] =1;
			if (!empty($this->request->data['State']['name'])) {
                $this->request->data['Store']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->Store->State->findOrSaveAndGetId($this->request->data['State']['name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('avatar.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
                $this->Store->Attachment->set($this->request->data);
            }
            $this->Store->set($this->request->data);
            $this->Store->Country->set($this->request->data);
            $this->Store->City->set($this->request->data);
            $this->Store->State->set($this->request->data);
            $ini_upload_error = 1;
            if ($this->request->data['Attachment']['filename']['error'] == 1) {
                $ini_upload_error = 0;
            }
            if ($this->Store->validates() &$this->Store->Attachment->validates() && $ini_upload_error) {
				require_once (COMPONENTS . 'affiliate.php');
				$affiliate = new Affiliate();
				if(preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/',$this->request->data['Store']['url'],$matches))
				{
					$this->request->data['Store']['url'] = $url=  $matches[3].'.'.$matches[4];
				}
				else {
				$this->request->data['Store']['url'] = str_replace('http://', '', $this->request->data['Store']['url']);
				$url = $this->request->data['Store']['url'] = str_replace('www.', '', $this->request->data['Store']['url']);
				}
				if(empty($this->request->data['Store']['description']))
				{
					$this->request->data['Store']['description']=$affiliate->_grabDescriptions($url);
				}
				$this->request->data['Store']['ip_id'] = $this->Store->toSaveIp();
                $this->Store->create();
                $this->Store->save($this->request->data, false);
                $store_id = $this->Store->getLastInsertId();
				//subscription email
				if(!empty($this->request->data['Store']['store_status_id']) && $this->request->data['Store']['store_status_id']==ConstStoreStatus::ActiveStore)
				{
					$this->sentSubscriptionStoremail($store_id);
				}
                $this->Store->Attachment->create();
                $store_id = $this->Store->getLastInsertId();
                if (!empty($this->request->data['Attachment']['filename']['name'])) {
                    $this->Store->Attachment->create();
                    $this->request->data['Attachment']['class'] = 'Store';
                    $this->request->data['Attachment']['foreign_id'] = $store_id;
                    $this->Store->Attachment->save($this->request->data['Attachment']);
                } //thublizer thumb creation
				else
				{
					define('_THUMBALIZR', 1);
					$host = $affiliate->_getjumphost($url);
					if (!empty($host)) {
						$affiliate->_fetchSiteThumb($this->Store->Coupon, $store_id, $host);
					}

				}
                $this->Session->setFlash(__l('Store has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'controller' => 'stores',
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Store could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
		if(empty($this->request->data['Store']['rank']))
		{
			$this->request->data['Store']['rank']=5;
		}
        $storeStatuses = $this->StoreStatus->find('list');
		$rank=array();
		for($i=1;$i<=10;$i++)
		{
			$rank[$i]=$i;
		}
		$this->set('rank',$rank);
        $this->set(compact('storeStatuses'));
    }
    public function domain_update()
    {
        $stores = $this->Store->find('all', array(
            'fields' => array(
                'Store.id',
                'Store.url',
            ) ,
            'recursive' => -1,
        ));
        foreach($stores as $store) {
            $url = $store['Store']['url'];
            preg_match('@^(?:http://)?([^/]+)@i', $url, $matches);
            $host = $matches[1];
            preg_match("/^(.*?)\.(.*)/", $host, $rest);
            $domain_name = $rest[2];
            $this->Store->updateAll(array(
                'Store.slug' => '\'' . $domain_name . '\'',
            ) , array(
                'Store.id' => $store['Store']['id']
            ));
        }
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Store');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Store->Attachment->Behaviors->attach('ImageUpload', Configure::read('coupon.file'));
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['City']['name'])) {
                $this->request->data['Store']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->Store->City->findOrSaveAndGetId($this->request->data['City']['name']);
            }
            if (!empty($this->request->data['Store']['country_id'])) {
                $this->request->data['Store']['country_id'] = $this->Store->Country->findCountryId($this->request->data['Store']['country_id']);
            }
            if (!empty($this->request->data['State']['name'])) {
                $this->request->data['Store']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->Store->State->findOrSaveAndGetId($this->request->data['State']['name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('coupon.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
                $this->Store->Attachment->set($this->request->data);
            }
			$this->request->data['Store']['is_manual_update'] =1;
			$this->Store->set($this->request->data);
            $this->Store->Country->set($this->request->data);
            $this->Store->City->set($this->request->data);
            $this->Store->State->set($this->request->data);
            $ini_upload_error = 1;
            if ($this->request->data['Attachment']['filename']['error'] == 1) {
                $ini_upload_error = 0;
            }
            if ($this->Store->validates() &$this->Store->Attachment->validates() && $ini_upload_error) {
				if(preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/',$this->request->data['Store']['url'],$matches))
				{
					$this->request->data['Store']['url'] = $url=  $matches[3].'.'.$matches[4];
				}
				else {
				$this->request->data['Store']['url'] = str_replace('http://', '', $this->request->data['Store']['url']);
				$url = $this->request->data['Store']['url'] = str_replace('www.', '', $this->request->data['Store']['url']);
				}         
                if ($this->Store->save($this->request->data,false)) {
                    if (!empty($this->request->data['Attachment']['filename']['name'])) {
                        if (!empty($this->request->data['Attachment']['id'])) {
                            $this->request->data['Attachment']['id'] = $this->request->data['Attachment']['id'];
                        } else {
                            $this->Store->Attachment->create();
                        }
                        $this->request->data['Attachment']['class'] = 'Store';
                        $this->request->data['Attachment']['foreign_id'] = $this->request->data['Store']['id'];
                        $this->Store->Attachment->save($this->request->data['Attachment']);
                    }
                    $this->Session->setFlash(__l('Store has been updated') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'stores',
                        'action' => 'index'
                    ));
                }
            } else {
                $this->Session->setFlash(__l('Store could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->Store->find('first', array(
                'conditions' => array(
                    'Store.id' => $id
                ) ,
                'contain' => array(
                    'Attachment',
                ) ,
                'recursive' => 2
            ));
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
		$rank=array();
		for($i=1;$i<=10;$i++)
		{
			$rank[$i]=$i;
		}
		$this->set('rank',$rank);
        $storeStatuses = $this->StoreStatus->find('list');
        $this->set(compact('storeStatuses'));
        $this->pageTitle.= ' - ' . $this->request->data['Store']['name'];
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Store->delete($id)) {
            $this->Session->setFlash(__l('Store deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
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
			if(empty($this->request->data['Attachment']['filename']['tmp_name']) && empty($this->request->data['Store']['url']))
			{
                    $this->Session->setFlash(__l('You have to attach the file or direct url of csv has to give') , 'default', null, 'error');
                    $this->redirect(array(
                        'controller' => 'stores',
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
			else if(!empty($this->request->data['Store']['url']))
			{
				$filename=$this->request->data['Store']['url'];
			}
            if ($this->Attachment->validates()) {
                $messages = $this->{$this->modelClass}->import($filename, 'Store');
                if (!empty($messages['messages'][0])) {
                    $this->Session->setFlash(__l('Stores has been imported successfully') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'stores',
                        'action' => 'index'
                    ));
                } else if (!empty($messages['errors'][0])) {
                    $this->Session->setFlash(__l('Stores not imported') , 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash(__l('Stores not imported') , 'default', null, 'error');
            }
        }
    }
    public function sentSubscriptionStoremail($store_id = null)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        if (!empty($store_id)) {
            $store = $this->Store->find('first', array(
                'conditions' => array(
                    'Store.id' => $store_id,
                    'Store.is_mail_sent' => 0,

                ) ,
                'recursive' => 0
            ));
		 if (!empty($store)) {
            $conditions = array();
            $conditions['OR']['Subscription.store_id'] = array($store_id,0);
			$conditions['Subscription.is_subscribed'] = 1;
            $subscriptions = $this->Subscription->find('all', array(
                'conditions' => $conditions,
                'recursive' => -1,
            ));
            if (!empty($subscriptions)) {
                foreach($subscriptions as $subscription) {
                    $emailFindReplace = array(
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##SITE_URL##' => Router::url('/', true) ,
                        '##STORE_LINK##' => Router::url(array(
                            'controller' => 'stores',
                            'action' => 'view',
                            $store['Store']['slug'],
                            'admin' => false
                        ) , true) ,
                        '##STORE_NAME##' => $store['Store']['name'],
						'##UNSUBSCRIBE_LINK##' => Router::url(array(
                            'controller' => 'subscriptions',
                            'action' => 'unsubscribe',
                            $subscription['Subscription']['id'],
                            'admin' => false
                        ) , true) ,
                    );
                    $email = $this->EmailTemplate->selectTemplate('Store of the day');
                    $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('site.from_email') : $email['from'];
                    $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('site.reply_to_email') : $email['reply_to'];
                    $this->Email->to = $subscription['Subscription']['email'];
                    $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                    $this->Email->send(strtr($email['email_content'], $emailFindReplace));

                }
            }
				//update mail sent status
				$data=array();
				$data['Store']['id']=$store_id;
				$data['Store']['is_mail_sent']=1;
				$this->Store->save($data,false);

		 }
        }
    }
}
?>
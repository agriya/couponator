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
class Store extends AppModel
{
    public $name = 'Store';
    public $displayField = 'name';
    public $actsAs = array(
        'Taggable',
        'SuspiciousWordsDetector' => array(
            'fields' => array(
                'name',
                'description',
                'tag'
            )
        ) ,
		'Sluggable' => array(
            'label' => array(
                'url'
            )
        ) ,
    );
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
		'AffiliateSite' => array(
            'className' => 'AffiliateSite',
            'foreignKey' => 'affiliate_site_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'StoreStatus' => array(
            'className' => 'StoreStatus',
            'foreignKey' => 'store_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'Ip' => array(
            'className' => 'Ip',
            'foreignKey' => 'ip_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasOne = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment.class' => 'Store',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
    );
    public $hasMany = array(
        'CouponImpression' => array(
            'className' => 'CouponImpression',
            'foreignKey' => 'store_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Coupon' => array(
            'className' => 'Coupon',
            'foreignKey' => 'store_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'StoreView' => array(
            'className' => 'StoreView',
            'foreignKey' => 'store_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'name' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'slug' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'url' => array(
                'rule2' => array(
                    'rule' => array(
                        'url',
                        true
                    ) ,
                    'allowEmpty' => false,
                    'message' => __l('Enter valid URL')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
            ) ,		
        );
		$this->moreActions = array(
            'Store Manage' => array(
                ConstMoreAction::Delete => __l('Delete') ,
            ) ,
			'Store Status' => array(
                ConstMoreAction::NewStore => __l('New Store') ,
                ConstMoreAction::ActiveStore => __l('Active Store') ,
                ConstMoreAction::RejectedStore => __l('Rejected Store') ,
                ConstMoreAction::Partner => __l('Partner') ,
            ) ,
        );
    }
	public function afterSave()
        {
		 $_data=array();
		 if(!empty($this->data['Store']['store_status_id']))
			{
			if($this->data['Store']['store_status_id']==ConstStoreStatus::NewStore)
			{
				$_data['Coupon']['coupon_status_id']= ConstCouponStatus::CheckStore;
			}
			else if($this->data['Store']['store_status_id']==ConstStoreStatus::ActiveStore)
			{
				if(!empty($_SESSION['Auth']) && $_SESSION['Auth']['User']['user_type_id'] != ConstUserTypes::Admin)
				{
					$_data['Coupon']['coupon_status_id']= ConstCouponStatus::NewCoupon;
				}

			}
			else if($this->data['Store']['store_status_id']==ConstStoreStatus::RejectedStore)
			{
				$_data['Coupon']['coupon_status_id']= ConstCouponStatus::RejectedStore;
			}

			$coupons = $this->Coupon->find('all', array(
				'conditions' => array(
					'Coupon.coupon_status_id' => array(
								ConstCouponStatus::CheckStore,
								ConstCouponStatus::NewCoupon,
								ConstCouponStatus::ActiveCoupon,
								ConstCouponStatus::RejectedStore,
								),
					'Coupon.store_id' => $this->id,
				) ,
				'fields' => array(
					'Coupon.id',
					'Coupon.coupon_status_id'
				),
				'recursive' => -1
			 ));
		 
			 foreach($coupons as $coupon)
			 {
				$_data['Coupon']['id']=$coupon['Coupon']['id'];
                $_data['Coupon']['coupon_status_id']=$coupon['Coupon']['coupon_status_id'];
				if(!empty($this->data['Store']['is_partner']))
				 {
					$_data['Coupon']['is_partner']=1;
				 }
				$this->Coupon->save($_data,false);
				if($_data['Coupon']['coupon_status_id']==ConstCouponStatus::ActiveCoupon)
				{
					$this->Coupon->sentSubscriptionmail($coupon['Coupon']['id']);
				}
			 }
		  }
    }
    public function findStoreName($slug = null)
    {
        $store = $this->find('first', array(
            'conditions' => array(
                'Store.slug' => $slug,
            ) ,
            'fields' => array(
                'Store.name',
            ) ,
            'recursive' => -1
        ));
        return ($store['Store']['name']);
    }
    public function checkStoreStatusCount()
    {
        $store_count = array();
        $store_count['active'] = $this->find('count', array(
            'conditions' => array(
                'Store.store_status_id = ' => ConstStoreStatus::ActiveStore,
            ) ,
            'recursive' => -1
        ));
        $store_count['new'] = $this->find('count', array(
            'conditions' => array(
                'Store.store_status_id = ' => ConstStoreStatus::NewStore,
            ) ,
            'recursive' => -1
        ));
        $store_count['rejected'] = $this->find('count', array(
            'conditions' => array(
                'Store.store_status_id = ' => ConstStoreStatus::RejectedStore,
            ) ,
            'recursive' => -1
        ));
		 $store_count['party'] = $this->find('count', array(
            'conditions' => array(
                'Store.is_partner = ' => 1,
            ) ,
            'recursive' => -1
        ));
        return $store_count;
    }
}
?>
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
class Coupon extends AppModel
{
    public $name = 'Coupon';
    public $displayField = 'title';
    public $actsAs = array(
        'Sluggable' => array(
            'label' => array(
                'title'
            )
        ) ,
        'Taggable',
        'SuspiciousWordsDetector' => array(
            'fields' => array(
                'title',
                'description',
                'coupon_code',
                'tag'
            )
        ) ,
    );
	var $aggregatingFields = array(
        'coupon_worked_count' => array(
            'mode' => 'real',
            'key' => 'coupon_id',
            'foreignKey' => 'coupon_id',
            'model' => 'CouponFeedback',
            'function' => 'COUNT(CouponFeedback.coupon_id)',
            'conditions' => array(
                'CouponFeedback.is_worked' => 1,
            )
        ) ,
		'coupon_not_worked_count' => array(
            'mode' => 'real',
            'key' => 'coupon_id',
            'foreignKey' => 'coupon_id',
            'model' => 'CouponFeedback',
            'function' => 'COUNT(CouponFeedback.coupon_id)',
            'conditions' => array(
                'CouponFeedback.is_worked' => 0,
            )
        )
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Store' => array(
            'className' => 'Store',
            'foreignKey' => 'store_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'CouponType' => array(
            'className' => 'CouponType',
            'foreignKey' => 'coupon_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
		 'AffiliateSite' => array(
            'className' => 'AffiliateSite',
            'foreignKey' => 'affiliate_site_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'CouponStatus' => array(
            'className' => 'CouponStatus',
            'foreignKey' => 'coupon_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
		'CouponTypeStatus' => array(
            'className' => 'CouponTypeStatus',
            'foreignKey' => 'coupon_type_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'Ip' => array(
            'className' => 'Ip',
            'foreignKey' => 'ip_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    public $hasMany = array(
        'CouponImpression' => array(
            'className' => 'CouponImpression',
            'foreignKey' => 'coupon_id',
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
        'CouponFeedback' => array(
            'className' => 'CouponFeedback',
            'foreignKey' => 'coupon_id',
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
        'CouponComment' => array(
            'className' => 'CouponComment',
            'foreignKey' => 'coupon_id',
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
        'CouponFavorite' => array(
            'className' => 'CouponFavorite',
            'foreignKey' => 'coupon_id',
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
    );
    public $hasAndBelongsToMany = array(
        'CouponTag' => array(
            'className' => 'CouponTag',
            'joinTable' => 'coupons_coupon_tags',
            'foreignKey' => 'coupon_id',
            'associationForeignKey' => 'coupon_tag_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ) ,
    );
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'coupon_type_id' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'store_id' => array(
                'rule' => 'numeric',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'category_id' => array(
            'rule2' => array(
                    'rule' =>'_isallowempty',
                    'allowEmpty' => true,
                    'message' => __l('Requires')
                ) ,
            ) ,
			'description' => array(
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
			'start_date' => array(
                'rule2' => array(
                    'rule' => '_isValidDate',
                    'message' => __l('Should be greater than today date'),
					'allowEmpty' => true
                ) ,
                'rule1' => array(
                    'rule' => 'date',
                    'message' => __l('Should be valid date'),
					'allowEmpty' => true
                )
            ) ,
            'end_date' => array(
                'rule3' => array(
                    'rule' => '_isGreaterThanStartDate',
                    'message' => __l('End date must be greater than start date'),
					'allowEmpty' => true
                ) ,
                'rule1' => array(
                    'rule' => 'date',
                    'message' => __l('Should be valid date'),
					'allowEmpty' => true
                )
            ) ,
            'is_ongoing' => array(
                'rule1' => array(
                    'rule' => 'checkOngoing',
                    'message' => __l('You have to check ongoing, if there is no start and end date'),
					'allowEmpty' => true
                ) ,
            ) ,            'captcha' => array(
                'rule2' => array(
                    'rule' => '_isValidCaptcha',
                    'message' => __l('Please enter valid captcha')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            )
        );
        $this->moreActions = array(
            'Coupon Manage' => array(
                ConstMoreActionCoupon::Delete => __l('Delete') ,
            ) ,
            'Coupon Type Status' => array(
                ConstMoreActionCoupon::Specialoffer => __l('Special Offer') ,
                ConstMoreActionCoupon::Unreliable => __l('Unreliable Coupon') ,
                ConstMoreActionCoupon::Activecoupon => __l('Normal coupon')
            ) ,
            'Coupon Types' => array(
                ConstMoreActionCoupon::CouponCode => __l('Coupon Code') ,
                ConstMoreActionCoupon::Shoppingtip => __l('Shopping Tips') ,
                ConstMoreActionCoupon::Printables => __l('Printable Coupon') ,
                ConstMoreActionCoupon::Freeshipping => __l('Free shipping')
            ),
			'Coupon Status' => array(
                ConstMoreActionCoupon::CheckStore => __l('Check Store') ,
                ConstMoreActionCoupon::NewCoupon => __l('New Coupon') ,
                ConstMoreActionCoupon::RejectedStore => __l('Rejected Store') ,
                ConstMoreActionCoupon::ActivesCoupon => __l('Active Coupon') ,
                ConstMoreActionCoupon::RejectedCoupon => __l('Rejected Coupon') ,
                ConstMoreActionCoupon::OutdatedCoupon => __l('Outdated Coupon') ,
				ConstMoreActionCoupon::Partner => __l('Partner') ,
            ) ,
        );
    }
	public function afterSave()
        {
		 $_data=array();
		 $store = $this->find('first', array(
				'conditions' => array(
					'Coupon.id' => $this->id ,
				) ,
				'fields' => array(
						'Coupon.store_id',
					),
				'recursive' => -1
			));
			//average calculation for store
			$couponList = $this->find('list', array(
				'conditions' => array(
					'Coupon.store_id = ' => $store['Coupon']['store_id'] ,
					'Coupon.id != ' => $this->id ,
					'Coupon.coupon_status_id' => array(
						ConstCouponStatus::ActiveCoupon,
						ConstCouponStatus::OutdatedCoupon
					), 
				) ,
				'fields' => array(
						'Coupon.id',
					),
				'recursive' => -1
			));

			$store_average = $this->CouponFeedback->find('all', array(
				'conditions' => array(
					'CouponFeedback.coupon_id' => $couponList ,
					'CouponFeedback.is_worked' => 1 ,
				) ,
				'fields' => array(
						'(SUM(CouponFeedback.purchased_price)/count(CouponFeedback.id)) as average',
					),
				'recursive' => -1
			));
		  $this->Store->updateAll(array(
						'Store.average_discount' => ceil($store_average[0][0]['average'])
					) , array(
						'Store.id' => $store['Coupon']['store_id']
					));
    }
    public function checkCouponCount()
    {
        $coupon_count = array();
        $coupon_count['live'] = $this->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::Normalcoupon,
            ) ,
            'recursive' => -1
        ));
        $coupon_count['expired'] = $this->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::SpecialOffer,
            ) ,
            'recursive' => -1
        ));
        $coupon_count['unreliable'] = $this->find('count', array(
            'conditions' => array(
                'Coupon.coupon_type_status_id' => ConstCouponTypeStatus::Unreliable,
            ) ,
            'recursive' => -1
        ));
        return $coupon_count;
    }
	function _isValidDate() 
    {
        if (strtotime($this->data[$this->name]['start_date']) >= strtotime(date('Y-m-d'))) {
            return true;
        } else {
            return false;
        }
    }
	function checkOngoing() 
    {
		 if ((empty($this->data[$this->name]['end_date']) || empty($this->data[$this->name]['start_date'])) && empty($this->data[$this->name]['is_ongoing'])) {
            return false;
        } else {
            return true;
        }
	}
	function _isGreaterThanStartDate() 
    {
        if (strtotime($this->data[$this->name]['end_date']) >= strtotime($this->data[$this->name]['start_date'])) {
            return true;
        } else {
            return false;
        }
    }
    function _isallowempty(){
      if(empty($this->data[$this->name]['category_id']) and $this->data[$this->name]['coupon_type_id'] != 3){
            return false;
        } else {
            return true;
        }

    }
}
?>
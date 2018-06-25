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
class CouponImpression extends AppModel
{
    public $name = 'CouponImpression';
    public $belongsTo = array(
        'Store' => array(
            'className' => 'Store',
            'foreignKey' => 'store_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'Coupon' => array(
            'className' => 'Coupon',
            'foreignKey' => 'coupon_id',
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
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
    );
    //$validate set in __construct for multi-language support
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
		$this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete')
        );
    }
    public function insertCouponImpression($user_id, $store_id, $coupon_id)
    {
        $_data['CouponImpression']['user_id'] = $user_id;
        $_data['CouponImpression']['store_id'] = $store_id;
        $_data['CouponImpression']['coupon_id'] = $coupon_id;
		$_data['CouponImpression']['ip_id'] = $this->toSaveIp();
        $this->save($_data);
    }
}
?>
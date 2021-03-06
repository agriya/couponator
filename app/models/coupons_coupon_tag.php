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
class CouponsCouponTag extends AppModel
{
    public $name = 'CouponsCouponTag';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Coupon' => array(
            'className' => 'Coupon',
            'foreignKey' => 'coupon_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ) ,
        'CouponTag' => array(
            'className' => 'CouponTag',
            'foreignKey' => 'coupon_tag_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        )
    );
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'coupon_id' => array(
                'rule' => 'numeric',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'coupon_tag_id' => array(
                'rule' => 'numeric',
                'allowEmpty' => false,
                'message' => __l('Required')
            )
        );
    }
}
?>
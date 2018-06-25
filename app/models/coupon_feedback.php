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
class CouponFeedback extends AppModel
{
    public $name = 'CouponFeedback';
	public $actsAs = array(
        'Aggregatable',
        'SuspiciousWordsDetector' => array(
            'fields' => array(
                'purchased',
            )
        ) ,
    );
    public $belongsTo = array(
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
        ) ,
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        )
    );
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
		$this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete')
        );
    }
}
?>
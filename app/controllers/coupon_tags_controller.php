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
class CouponTagsController extends AppController
{
    public $name = 'CouponTags';
    public $uses = array(
        'CouponTag',
        'Coupon',
        'Store',
    );
    public function index()
    {
        $this->pageTitle = __l('Coupon Tags');
        $conditions = array();
        $this->_redirectPOST2Named(array(
            'q'
        ));
        $tag_name_arr = $tag_arr = array();
		if (!empty($this->request->params['named']['q'])) {
			$limit = 20;
			$couponTag = $this->CouponTag->find('first', array(
				'conditions' => array(
					'CouponTag.slug' => $this->request->params['named']['q']
				) ,
				'contain' => array(
					'Coupon' => array(
						'fields' => array(
							'Coupon.id',
							'Coupon.store_id',
						)
					)
				) ,
				'recursive' => 1
			));
			if (!empty($couponTag['Coupon'])) {
				foreach($couponTag['Coupon'] as $tag) {
					$ids[$tag['id']] = $tag['store_id'];
				}
				$coupons = $this->CouponTag->Coupon->find('all', array(
					'conditions' => array(
						'Coupon.id' => array_keys($ids)
					) ,
					'contain' => array(
						'CouponTag'
					) ,
					'fields' => array(
						'Coupon.id'
					)
				));
				foreach($coupons as $coupon) {
					foreach($coupon['CouponTag'] as $tag) {
						$tag_arr[$tag['slug']] = $tag['coupon_count'];
						$tag_name_arr[$tag['slug']] = $tag['name'];
					}
				}
			}
		} else {
			$limit = 50;
			$conditions['CouponTag.coupon_count >'] = 0;
			$couponTags = $this->CouponTag->find('all', array(
				'conditions' => $conditions,
				'recursive' => -1,
				'limit' => $limit,
				'order' => array(
					'CouponTag.coupon_count' => 'DESC'
				) ,
				'contain' => array(
					'Coupon' => array(
						'fields' => array(
							'id'
						)
					)
				)
			));
			foreach($couponTags as $couponTag) {
				$tag_arr[$couponTag['CouponTag']['slug']] = $couponTag['CouponTag']['coupon_count'];
				$tag_name_arr[$couponTag['CouponTag']['slug']] = $couponTag['CouponTag']['name'];
			}
			if (!empty($tag_name_arr)) {
				$tag_name_arr = array_unique($tag_name_arr);
			}
			if (!empty($tag_arr)) {
				ksort($tag_arr);
			}
		}
        $this->set('limit', $limit);
        $this->set('tag_arr', $tag_arr);
        $this->set('tag_name_arr', $tag_name_arr);
    }
}
?>
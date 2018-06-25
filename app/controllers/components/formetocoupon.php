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
/**
 * Formetocoupon Affiliate program implementation
 */
class FormetocouponComponent extends Component
{
    function __construct()
    {
        require_once dirname(__FILE__) . DS . 'affiliate.php';
        $this->Affiliate = new Affiliate();
    }
    function importCoupons()
    {
        $s = $this->Affiliate->_query(Configure::read('formetocoupon.coupon_url') . '?key=' . Configure::read('formetocoupon.access_key') . '&incremental=1');
        $s1 = $this->Affiliate->_query(Configure::read('formetocoupon.merchant_url') . '?key=' . Configure::read('formetocoupon.access_key'));
        App::import('Xml');
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $data = Xml::toArray(Xml::build($s));
        //merchant information
        $store_data = Xml::toArray(Xml::build($s1));
        $merchants = array();
        foreach($store_data['merchants']['merchant'] as $merchant) {
            $merchants[$merchant['id']]['homepageurl'] = $merchant['homepageurl'];
        }
        foreach($data['deals']['item'] as $link) {
            $coupon = array();
            $coupon['Coupon']['user_id'] = ConstUserTypes::Admin;
            $coupon['Coupon']['description'] = $link['label'];
            if (empty($link['startdate']) && empty($link['enddate'])) {
                $coupon['Coupon']['is_ongoing'] = 1;
            }
            if (!empty($link['startdate'])) {
                $start = explode(' ', $link['startdate']);
                if (!empty($start[0])) {
                    $coupon['Coupon']['start_date'] = $start[0];
                }
            }
            if (!empty($link['enddate'])) {
                $end = explode(' ', $link['enddate']);
                if (!empty($end[0])) {
                    $coupon['Coupon']['end_date'] = $end[0];
                }
            } else {
                $coupon['Coupon']['is_ongoing'] = 1;
            }
            if (!empty($link['couponcode'])) {
                $coupon['Coupon']['coupon_code'] = $link['couponcode'];
            }
            if (!empty($link['couponcode'])) {
                $coupon['Coupon']['coupon_code'] = $link['couponcode'];
            }
            if (preg_match('/free shipping/i', $link['label'])) {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
            } else if (!empty($coupon['Coupon']['coupon_code'])) {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::CouponCodes;
            } else {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
            }
            $coupon['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
            $coupon['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
            $coupon['Coupon']['url'] = $link['link'];
            $coupon['Coupon']['is_free_shipping'] = 0;
            $coupon['Coupon']['cid'] = $link['couponid'];
            $coupon['Coupon']['affiliate_site_id'] = ConstAffiliateSites::Formetocoupon;
			if(!empty($link['categories']['category']))
			{
				$tags = '';
				foreach($link['categories']['category'] as $categories) {
					$tags = $tags . $categories . ',';
				}
				if (!empty($tags)) {
					$coupon['Coupon']['tag'] = $tags;
				}
			}
            if (!$this->Affiliate->_couponSearch($this->Coupon, $coupon['Coupon']['cid'], ConstAffiliateSites::Formetocoupon)) {
                $store = array();
                // Additional parementer with url then retrieve only domain
                if (preg_match('/^((.+\.)([A-Za-z]{2,3}))\/(.+)$/', $merchants[$link['merchantid']]['homepageurl'], $matches)) {
                    $merchants[$link['merchantid']]['homepageurl'] = $matches[1];
                }
                $store['Store']['store_status_id'] = ConstStoreStatus::ActiveStore;
                if (preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/', $merchants[$link['merchantid']]['homepageurl'], $matches)) {
                    $store['Store']['url'] = $store['Store']['name'] = $matches[3] . '.' . $matches[4];
                } else {
                    $store['Store']['url'] = parse_url($merchants[$link['merchantid']]['homepageurl'], PHP_URL_HOST);
                    $store['Store']['url'] = $store['Store']['name'] = str_replace('www.', '', $store['Store']['url']);
                }
                if (!preg_match('/^(.+\.)([A-Za-z]{2,3})$/', $store['Store']['url'], $matches)) {
                    //subdomain check
                    if (preg_match('/^(.+\.)([A-Za-z0-9]{1,50})\.([A-Za-z]{2,3})$/', $store['Store']['url'], $matches)) {
                        $store['Store']['name'] = $store['Store']['name'] . '.' . $matches[2] . '.' . $matches[3];
                    } elseif (preg_match('/^(.+\.)([A-Za-z]{2,3})$/', $store['Store']['url'], $matches)) {
                        $store['Store']['name'] = $store['Store']['name'] . '.' . $matches[2];
                    }
                }
                $store['Store']['affiliate_site_id'] = ConstAffiliateSites::Formetocoupon;
                $coupon['Coupon']['store_id'] = $this->Affiliate->_storeLookup($this->Coupon, $store);
                $this->Coupon->create();
                $this->Coupon->save($coupon, false);
            }
        }
    }
}
?>
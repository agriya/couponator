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
 * Shareasale Affiliate program implementation
 */
class ShareasaleComponent extends Component
{
	function __construct() 
	{
		require_once dirname(__FILE__) . DS . 'affiliate.php';
		$this->Affiliate = new Affiliate();
	}
     function importCoupons()
    {
       $s = $this->Affiliate->_query(Configure::read('shareasale.coupon_url') . '&affiliateId=' . Configure::read('shareasale.affiliateID').'&token=' . Configure::read('shareasale.token'));
       $s1 = $this->Affiliate->_query(Configure::read('shareasale.merchant_url') . '&affiliateId=' . Configure::read('shareasale.affiliateID').'&token=' . Configure::read('shareasale.token'));
	   if(!preg_match('/\b(Error Code)\b/',$s,$output))
	   {
        App::import('Xml');
		App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $data = Xml::toArray(Xml::build($s));
        //merchant information
        $store_data = Xml::toArray(Xml::build($s1));
        $merchants = array();
        foreach($store_data['merchantstatusreport']['merchantstatusreportrecord'] as $merchant) {
            $merchants[$merchant['merchantid']]['homepageurl'] = $merchant['www'];
        }
        foreach($data['dealcouponlistreport']['dealcouponlistreportrecord'] as $link) {
            $coupon = array();
			$coupon['Coupon']['user_id'] = ConstUserTypes::Admin;
			$coupon['Coupon']['description'] = $link['description'];
			$coupon['Coupon']['start_date'] = $link['startdate'];
            $coupon['Coupon']['end_date'] = $link['enddate'];
			if ($link['enddate'] == '' || $link['enddate'] == Null || $link['enddate'] == 'ongoing') {
                $coupon['Coupon']['is_ongoing'] = 1;
            }
			if (!empty($link['couponcode'])) {
				$coupon['Coupon']['coupon_code'] = $link['couponcode'];
			}
			if (preg_match('/free shipping/i', $link['description'])) {
					$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
			} else if (!empty($coupon['Coupon']['coupon_code'])) {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::CouponCodes;
            } else {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
            }
			$coupon['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
			$coupon['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
            $coupon['Coupon']['url'] = $link['trackingurl'];
            $coupon['Coupon']['cid'] = $link['dealid'];
			$coupon['Coupon']['affiliate_site_id'] = ConstAffiliateSites::Shareasale;
			$coupon['Coupon']['tag'] =  $link['category'];
            if (!$this->Affiliate->_couponSearch($this->Coupon, $coupon['Coupon']['cid'], ConstAffiliateSites::Shareasale)) {
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
				$store['Store']['affiliate_site_id'] = ConstAffiliateSites::Shareasale;
				$coupon['Coupon']['store_id'] = $this->Affiliate->_storeLookup($this->Coupon, $store);
				if(!empty($coupon['Coupon']['store_id']))
				{
					$this->Coupon->create();
					$this->Coupon->save($coupon,false);
				}
            }
        }
	  }
    }
}
?>
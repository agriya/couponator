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
 * Pepperjam Affiliate program implementation
 */
class PepperjamComponent extends Component
{
	function __construct() 
	{
		require_once dirname(__FILE__) . DS . 'affiliate.php';
		$this->Affiliate = new Affiliate();
	}
	function importCoupons()
    {
        $s = $this->Affiliate->_query(Configure::read('pepperjam.coupon_url') . '?affiliate_id=' . Configure::read('pepperjam.affiliate_id') . '&program_ids=all');
        App::import('Xml');
		App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $data = Xml::toArray(Xml::build($s));
		if (!empty($data['rss']['channel']['item'])) {
			foreach($data['rss']['channel']['item'] as $item) {
				$coupon = array();
				$coupon['Coupon']['user_id'] = ConstUserTypes::Admin;
				$coupon['Coupon']['description'] = $item['description'];
				if (!empty($item['coupon:begin']) && $item['coupon:begin'] != '0000-00-00') {
					$coupon['Coupon']['start_date'] = $item['coupon:begin'];
				}
				if (!empty($item['coupon:expire']) && $item['coupon:expire'] != '0000-00-00') {
					$coupon['Coupon']['end_date'] = $item['coupon:expire'];
					if (strtotime($coupon['Coupon']['end_date']) < time()) {
						continue;
					}
				}
				if (preg_match('/^([A-Za-z0-9\-])*$/', $item['coupon:coupon_code'])) {
					$coupon['Coupon']['coupon_code'] = $item['coupon:coupon_code'];
				}
				$coupon['Coupon']['url'] = $item['link'];
				$coupon['Coupon']['is_free_shipping'] = 0;
				$coupon['Coupon']['affiliate_site_id'] = ConstAffiliateSites::Pepperjam;
				if (preg_match('/free shipping/i', $item['description'])) {
					$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
				} else if (!empty($coupon['Coupon']['coupon_code'])) {
					$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::CouponCodes;
				} else {
					$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
				}
				$coupon['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
				$coupon['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
				$coupon['Coupon']['cid'] = md5($item['link']);
				if (!$this->Affiliate->_couponSearch($this->Coupon, $coupon['Coupon']['cid'], ConstAffiliateSites::Pepperjam)) {
					$store = array();
					$store_name = explode(' - ', $item['title']);
					$store['Store']['name'] = $store_name[0];
					$store_url_arr = explode('?url=', urldecode($item['link']));
					if(preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/',$store_url_arr[1],$matches))
					{
					$store['Store']['url'] =  $matches[3].'.'.$matches[4];
					}
					else {
					$store['Store']['url'] = parse_url($store_url_arr[1], PHP_URL_HOST);
					$store['Store']['url'] = str_replace('www.', '', $store['Store']['url']);
					}
					if(!preg_match('/^(.+\.)([A-Za-z]{2,3})$/', $store['Store']['name'], $matches))
					{
						//subdomain check
						if(preg_match('/^(.+\.)([A-Za-z0-9]{1,50})\.([A-Za-z]{2,3})$/',$store['Store']['url'],$matches))
						{
							$store['Store']['name'] =$store['Store']['name'].'.'.$matches[2].'.'.$matches[3];
						}
						elseif(preg_match('/^(.+\.)([A-Za-z]{2,3})$/',$store['Store']['url'],$matches))
						{
							$store['Store']['name'] =$store['Store']['name'].'.'.$matches[2];
						}
					}
					$store['Store']['affiliate_site_id'] = ConstAffiliateSites::Pepperjam;
					$coupon['Coupon']['store_id'] = $this->Affiliate->_storeLookup($this->Coupon, $store);
					$this->Coupon->create();
					$this->Coupon->save($coupon);
				}
			}
		}
    }
}
?>
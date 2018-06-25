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
 * Linkshare Affiliate program implementation
 */
class LinkShareComponent extends Component
{
	function __construct() 
	{
		require_once dirname(__FILE__) . DS . 'affiliate.php';
		$this->Affiliate = new Affiliate();
	}
     function importCoupons()
    {
        /*
        category: 1-32
        promotiontype: 1-11, 14, 30, 31
        network: 1(US), 2(UK), 3(CAN)
        mid: nnnn
        *  Multiple Values   'category=1|2|3'
        *  !!limited to 50 calls per GMT day!!
        */
        $s = $this->Affiliate->_query(Configure::read('linkshare.coupon_url') . '?token=' . Configure::read('linkshare.token'));
        App::import('Xml');
		App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $data = Xml::toArray(Xml::build($s));
        foreach($data['couponfeed']['link'] as $link) {
            $coupon = array();
			$coupon['Coupon']['user_id'] = ConstUserTypes::Admin;
			$coupon['Coupon']['description'] = $link['offerdescription'];
			$coupon['Coupon']['start_date'] = $link['offerstartdate'];
            $coupon['Coupon']['end_date'] = $link['offerenddate'];
			if ($link['offerenddate'] == '' || $link['offerenddate'] == Null || $link['offerenddate'] == 'ongoing') {
                $coupon['Coupon']['is_ongoing'] = 1;
            }
			if ($coupon['Coupon']['end_date'] != '' && strtolower($coupon['Coupon']['end_date']) != 'ongoing' && strtotime($coupon['Coupon']['end_date']) < time()) {
				continue;
			}
			if (!empty($link['couponcode'])) {
				$coupon['Coupon']['coupon_code'] = $link['couponcode'];
			}
			if (preg_match('/free shipping/i', $link['offerdescription'])) {
					$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
			} else if (!empty($coupon['Coupon']['coupon_code'])) {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::CouponCodes;
            } else {
                $coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
            }
			$coupon['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
			$coupon['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
            $coupon['Coupon']['url'] = $link['clickurl'];
            $coupon['Coupon']['is_free_shipping'] = 0;
            foreach($link['promotiontypes']['promotiontype'] as $promotiontype) {
                if ($promotiontype['@'] == 'Free Shipping') {
                    $coupon['Coupon']['is_free_shipping'] = 1;
					$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
                }
            }
            preg_match('%offerid=(.+?)&%', $link['clickurl'], $m);
            $coupon['Coupon']['cid'] = !empty($m[1]) ? $m[1] : 0;
			$coupon['Coupon']['affiliate_site_id'] = ConstAffiliateSites::LinkShare;
			$tags='';
			foreach($link['categories']['category'] as $categories) {
				$tags = $tags . $categories['@'] . ',';
			}
			if (!empty($tags)) {
				$coupon['Coupon']['tag'] = $tags;
			}
            if (preg_match('%(affiliate|468x60|392x72|234x60|120x90|120x60|120x240|400x260|180x150|300x250|240x400|336x280|88x31|80x15|250x250|125x125|150x150|745x100|728x90|160x600|120x600|300x600)%msi', $coupon['Coupon']['description'])) {
				continue;
			}
            if (!$this->Affiliate->_couponSearch($this->Coupon, $coupon['Coupon']['cid'], ConstAffiliateSites::LinkShare)) {
	            $store = array();
				$store['Store']['name'] = $link['advertisername'];
				$store['Store']['store_status_id'] = ConstStoreStatus::ActiveStore;
				if(preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/',$link['clickurl'],$matches))
				{
				$store['Store']['url'] =  $matches[3].'.'.$matches[4];
				}
				else {
				$store['Store']['url'] = parse_url($link['clickurl'], PHP_URL_HOST);
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
				$store['Store']['affiliate_site_id'] = ConstAffiliateSites::LinkShare;
				$coupon['Coupon']['store_id'] = $this->Affiliate->_storeLookup($this->Coupon, $store);
                $this->Coupon->create();
                $this->Coupon->save($coupon,false);
            }
        }
    }
}
?>
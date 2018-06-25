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
 * Community Junction Affiliate program implementation
 */
class CjComponent extends Component
{
	function __construct() 
    {
		require_once dirname(__FILE__) . DS . 'affiliate.php';
		$this->Affiliate = new Affiliate();
    }
	function importCoupons($paras = array())
    {
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
		$ini = ini_set('soap.wsdl_cache_enabled', '0');
        try {
            include_once (APP . DS . 'vendors' . DS . 'class.G.php');
            $client = new SoapClient(Configure::read('cj.coupon_url'), array(
                'trace' => true
            ));
            //Enter the request parameters for LinkSearch below.
            //For detailed usage of the parameter values, please refer to CJ Web Services online documentation
            $coupons_list = $client->searchLinks(array(
                'developerKey' => Configure::read('cj.developerkey') ,
                'token' => '',
                'websiteId' => Configure::read('cj.websiteid') ,
                'advertiserIds' => 'joined',
                'keywords' => '',
                'category' => '',
                'linkType' => '',
                'linkSize' => '',
                'language' => '',
                'serviceableArea' => '',
                'promotionType' => 'coupon',
                'promotionStartDate' => '',
                'promotionEndDate' => '',
                'sortBy' => 'creativeHeight',
                'sortOrder' => 'asc',
                'startAt' => 0,
                'maxResults' => 10
            ));
            $coupons = (array)$coupons_list->out->links;
            // The entire response structure will be printed in the next line
            foreach($coupons as $coupon) {
                foreach($coupon as $item) {
                    preg_match('%<a href="(.+?)">(.*?)<%msi', $item->linkCodeHTML, $m);
                    if (!$m) {
						continue;
					}
                    $coupon = array();
					$coupon['Coupon']['affiliate_site_id'] = ConstAffiliateSites::CommunityJunction;
                    $coupon['Coupon']['url'] = $m[1];
                    $coupon['Coupon']['link'] = $item->linkDestination;
                    $coupon['title'] = trim($m[2]);
                    $coupon['Coupon']['title'] = $item->linkDescription;
                    $coupon['title'] = empty($coupon['title']) ? $coupon['description'] : $coupon['title'];
                    $coupon['Coupon']['coupon_code'] = G::fetchCode($coupon['Store']['name'], $coupon['title'], $coupon['Coupon']['title']);
					if (preg_match('/free shipping/i', $item->linkDescription)) {
							$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
					} else if (!empty($coupon['Coupon']['coupon_code'])) {
						$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::CouponCodes;
					} else {
						$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
					}
					$coupon['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
					$coupon['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
                    $coupon['Coupon']['start_date'] = trim($item->promotionStartDate);
                    $coupon['Coupon']['end_date'] = trim($item->promotionEndDate);
                    if (trim($item->promotionEndDate) == 'ongoing') {
                        $coupon['Coupon']['is_ongoing'] = 1;
                    }
                    $coupon['Coupon']['cid'] = $item->linkId;
                    if ($coupon['Coupon']['end_date'] != '' && strtolower($coupon['Coupon']['end_date']) != 'ongoing' && strtotime($coupon['Coupon']['end_date']) < time()) {
						continue;
					}
					if(!empty($item->category))
					{
						$coupon['Coupon']['tag'] = $item->category;
					}
					//ignore expired coupon
                    if (preg_match('%(affiliate|468x60|392x72|234x60|120x90|120x60|120x240|400x260|180x150|300x250|240x400|336x280|88x31|80x15|250x250|125x125|150x150|745x100|728x90|160x600|120x600|300x600)%msi', $coupon['title'])) {
						continue;
					}
                    if (!$this->Affiliate->_couponSearch($this->Coupon, $coupon['Coupon']['cid'], ConstAffiliateSites::CommunityJunction)) {
						$store['Store']['name'] = $item->advertiserName;
						if(preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/',$item->linkDestination,$matches))
						{
						$store['Store']['url'] =  $matches[3].'.'.$matches[4];
						}
						else {
						$store['Store']['url'] = parse_url($item->linkDestination, PHP_URL_HOST);
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
						$store['Store']['store_status_id'] = ConstStoreStatus::ActiveStore;
						$store['Store']['affiliate_site_id'] = ConstAffiliateSites::CommunityJunction;
	                    $coupon['Coupon']['store_id'] = $this->Affiliate->_storeLookup($this->Coupon, $store);
                        $this->Coupon->create();
                        $this->Coupon->save($coupon);
                    }
                }
            }
        }
        catch(Exception $e) {
            // echo 'There was an error with your request or the service is unavailable.';
        }
    }
}
?>
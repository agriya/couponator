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
class CronComponent extends Component
{
    var $controller;
    function main()
	{
		$this->makeExpiredEndedCoupons();
		$this->updateUserRanking();
		$this->fetchSiteThumb();
	}
	function fetchSiteThumb()
	{
		require_once dirname(__FILE__) . DS . 'affiliate.php';
		$this->Affiliate = new Affiliate();
		App::import('Model', 'Store');
        $this->Store = new Store();
        $stores = $this->Store->find('all', array(
            'conditions' => array(
				'Store.is_thumblized' => 0
			) ,
            'fields' => array(
                'Store.id',
                'Store.url'
            ) ,
            'recursive' => -1
        ));
		if (!empty($stores)) {
			foreach($stores as $store) {
				$this->Affiliate->_fetchSiteThumb($this->Store->Coupon, $store['Store']['id'], $store['Store']['url']);
			}
		}
	}
	function affiliates()
    {
		App::import('Core', 'ComponentCollection');
		$collection = new ComponentCollection();
		// Formetocoupon programs
		if (Configure::read('formetocoupon.is_formetocoupon_enable')) {
			App::import('Component', 'Formetocoupon');
			$this->Formetocoupon = new FormetocouponComponent($collection);
			$this->Formetocoupon->importCoupons();
		}
		// Sharasale programs
		if (Configure::read('shareasale.is_shareasale_enable')) {
			App::import('Component', 'Shareasale');
			$this->Shareasale = new ShareasaleComponent($collection);
			$this->Shareasale->importCoupons();
		}
		// Connect Commerce programs
		if (Configure::read('connectcommerce.is_connectcommerce_enable')) {
			App::import('Component', 'ConnectCommerce');
			$this->ConnectCommerce = new ConnectCommerceComponent($collection);
			$this->ConnectCommerce->importCoupons();
		}
		// Pepperjam programs
		if (Configure::read('pepperjam.is_pepperjam_enable')) {
			App::import('Component', 'Pepperjam');
			$this->Pepperjam = new PepperjamComponent($collection);
			$this->Pepperjam->importCoupons();
		}
		// Link Share programs
		if (Configure::read('linkshare.is_linkshare_enable')) {
			App::import('Component', 'LinkShare');
			$this->LinkShare = new LinkShareComponent($collection);
			$this->LinkShare->importCoupons();
		}
		// Community Junction programs
		if (Configure::read('cj.is_cj_enable')) {
			App::import('Component', 'Cj');
			$this->Cj = new CjComponent($collection);
			$this->Cj->importCoupons();
		}
	}
    function makeExpiredEndedCoupons()
    {
        $conditions = array();
        $curent_date = date('Y-m-d');
        $conditions['Coupon.end_date  <'] = date('Y-m-d');
		$conditions['Coupon.coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
        App::import('Model', 'Coupon');
        $this->Coupon = new Coupon();
        $coupons = $this->Coupon->find('all', array(
            'conditions' => $conditions,
            'fields' => array(
                'Coupon.id'
            ) ,
            'recursive' => -1
        ));
		if (!empty($coupons)) {
			$selectedIds = array();
			foreach($coupons as $coupon) {
				$selectedIds[] = $coupon['Coupon']['id'];
			}
			$this->Coupon->updateAll(array(
				'Coupon.is_popular' => 0,
				'Coupon.coupon_status_id' =>ConstCouponStatus::OutdatedCoupon
			) , array(
				'Coupon.id' => $selectedIds
			));
		}
    }
    function updateUserRanking()
    {
        App::import('Model', 'User');
        $this->User = new User();
        $users = $this->User->find('all', array(
            'conditions' => array(
                'User.coupon_points >' => 0,
                'User.user_type_id != ' => ConstUserTypes::Admin
            ) ,
            'order' => array(
                'User.coupon_points' => 'DESC'
            ) ,
            'recursive' => -1
        ));
        if (!empty($users)) {
            $i = 1;
            foreach($users as $user) {
                $data = array();
                $this->User->create();
                $data['User']['id'] = $user['User']['id'];
                $data['User']['rank'] = $i;
                $this->User->set($data);
                $this->User->save($data, false);
                $i = $i+1;;
            }
        }
    }
}
?>
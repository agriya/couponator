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
 * Affiliate program implementation
 */
class Affiliate
{
	function __construct()
	{
			define('_THUMBALIZR', 1);
	}
	function _grabDescriptions($url)
    {
        $pattern = '/http/';
        $subject = $url;
        if (!preg_match($pattern, $subject, $matches)) {
            $url = 'http://' . $url;
        }
        $tags = @get_meta_tags($url);
		if (!empty($tags['description'])) {
	        return $tags['description'];
		} else {
			return '';
		}
    }
	function _getjumphost($url)
    {
        include_once (APP . DS . 'vendors' . DS . 'class.G.php');
        return G::dumpDomain($url);
    }
	function _query($url)
    {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$data = curl_exec($ch);
		if (!curl_errno($ch)) {
			curl_close($ch);
		} else {
			$data = false;
		}
		return $data;
    }
	function _couponSearch($coupon, $cid, $affiliate_site_id)
    {
		$this->Coupon = $coupon;
        $conditions['Coupon.cid'] = $cid;
        $conditions['Coupon.affiliate_site_id'] = $affiliate_site_id;
        return $this->Coupon->find('count', array(
            'conditions' => $conditions,
            'recursive' => -1,
        ));
    }
	function _storeLookup($coupon, $store)
    {
		$this->Coupon = $coupon;
        $chkStore = $this->Coupon->Store->find('first', array(
            'conditions' => array(
                'Store.url' => $store['Store']['url']
            ) ,
            'recursive' => -1
        ));
        if (!empty($chkStore)) {
            return $chkStore['Store']['id'];
        } else {
            $jump = $store['Store']['url'];
            $host = $this->_getjumphost($jump);
            $desc = $this->_grabDescriptions($host);
            $store['Store']['description'] = $desc;
			$store['Store']['store_status_id'] = ConstStoreStatus::ActiveStore;
            $this->Coupon->Store->create();
            if ($this->Coupon->Store->save($store,false)) {
				$store_id = $this->Coupon->Store->getLastInsertId();
                if (!empty($host)) {
                    $this->_fetchSiteThumb($this->Coupon, $store_id,$host);
                }
                return $store_id;
            }
        }
    }
	function checkStore($coupon, $url)
    {
		$this->Coupon = $coupon;
        $chkStore = $this->Coupon->Store->find('first', array(
            'conditions' => array(
                'Store.url' => $url
            ) ,
            'recursive' => -1
        ));
        if (!empty($chkStore))
		{
            return $chkStore['Store']['id'];
        } else
		{
			return 0;
        }
	}
	function _fetchSiteThumb($coupon, $store_id,$host)
	{
		$this->Coupon = $coupon;
		$thumbalizr_config = array(
			'api_key' => Configure::read('thumbalizr.api_key'),
			'service_url' => 'http://api.thumbalizr.com/',
			'use_local_cache' => TRUE,
			'local_cache_dir' => '../media/Store/' . $store_id,
			'local_cache_expire' => 12
		);
		$thumbalizr_defaults = array(
			'width' => '383',
			'delay' => '8',
			'encoding' => 'jpg',
			'quality' => '80',
			'bwidth' => '1280',
			'mode' => 'screen',
			'bheight' => '1024'
		);
		App::import('Vendor', 'thumbalizr/thumbalizr');
		$image = new thumbalizr($thumbalizr_config, $thumbalizr_defaults);
		$image->request($host);
		if ($image->headers['Status'] == 'OK' || $image->headers['Status'] == 'LOCAL') {
			$_data['Attachment']['dir'] = 'Store/' . $store_id;
			$_data['Attachment']['filename'] = $image->local_cache_file;
			$_data['Attachment']['foreign_id'] = $store_id;
			$_data['Attachment']['class'] = 'Store';
			$_data['Attachment']['filesize'] = filesize('../media/Store/' . $store_id . '/' . $image->local_cache_file);
			$sizes = getimagesize('../media/Store/' . $store_id . '/' . $image->local_cache_file);
			$_data['Attachment']['width'] = $sizes[0];
			$_data['Attachment']['height'] = $sizes[1];
			$_data['Attachment']['mimetype'] = $sizes['mime'];
			$_data['Store']['id'] = $store_id;
			$_data['Store']['is_thumblized'] = 1;
			$this->Coupon->Store->save($_data, false);
			$this->Coupon->Store->Attachment->enableUpload(false);
			$this->Coupon->Store->Attachment->set($_data);
			$this->Coupon->Store->Attachment->create();
			$this->Coupon->Store->Attachment->save($_data);
		}
	}
}
?>
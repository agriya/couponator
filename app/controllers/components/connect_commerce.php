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
 * Connect Commerce Affiliate program implementation
 */
class ConnectCommerceComponent extends Component
{
	function __construct() 
	{
		require_once dirname(__FILE__) . DS . 'affiliate.php';
		$this->Affiliate = new Affiliate();
	}
	function importCoupons()
    {
		if (!($conn_id = ftp_connect(Configure::read('connectcommerce.ftp_host'), Configure::read('connectcommerce.ftp_port')))) {
			$this->log('Given FTP host was not working');
			return false;
		}
		if (!ftp_login($conn_id, Configure::read('connectcommerce.ftp_username'), Configure::read('connectcommerce.ftp_password'))) {
			$this->log('Given FTP username and Password is not working');
			return false;
		}
		$contents = ftp_nlist($conn_id, '/');
		if (!empty($contents)) {
			$local_file_path = APP . 'media' . DS . 'ConnectCommerce' . DS;
			App::import('Model', 'Coupon');
			$this->Coupon = new Coupon();
			foreach($contents as $content) {
				$server_zip_file = str_replace('/', '', $content);
				$local_txt_file = str_replace('.zip', '.txt', $server_zip_file);
				$local_zip_file = $local_file_path . $server_zip_file;
				if (!ftp_get($conn_id, $local_zip_file, $server_zip_file, FTP_BINARY)) {
					$this->log('Cant able to download file using FTP connection for connect commerce affiliates');
					return false;
				}
				if (file_exists($local_zip_file)) {
					$zip = new ZipArchive();
					$res = $zip->open($local_zip_file);
					if ($res === TRUE) {
						$zip->extractTo($local_file_path);
						$zip->close();
					}
					@unlink($local_zip_file);
					if (file_exists($local_txt_file)) {
						$ch = fopen($local_txt_file, 'rb');
						while (!feof($ch) ) {
							$line_of_text = fgets($ch);
							if (!empty($line_of_text)) {
								$item = explode("\t", $line_of_text);
								if (!empty($item)) {
									$coupon = array();
									$coupon['Coupon']['user_id'] = ConstUserTypes::Admin;
									// LongDesc from txt file
									$coupon['Coupon']['description'] = $item[11];
									// ProductURL from txt file
									$coupon['Coupon']['url'] = $item[2];
									$coupon['Coupon']['is_free_shipping'] = 0;
									$coupon['Coupon']['affiliate_site_id'] = ConstAffiliateSites::ConnectCommerce;
									if (preg_match('/free shipping/i', $item[11])) {
										$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::FreeShipping;
									} else {
										$coupon['Coupon']['coupon_type_id'] = ConstCouponTypes::ShoppingTips;
									}
									$coupon['Coupon']['coupon_status_id'] = ConstCouponStatus::ActiveCoupon;
									$coupon['Coupon']['coupon_type_status_id'] = ConstCouponTypeStatus::Normalcoupon;
									// ProductID from txt file
									$coupon['Coupon']['cid'] = $item[0];
									if (!$this->Affiliate->_couponSearch($this->Coupon, $coupon['Coupon']['cid'], ConstAffiliateSites::ConnectCommerce)) {
										$store = array();
										$store_url_arr = explode('?adurl=', urldecode($item[2]));
										if (preg_match('/^((.+)\.)?([A-Za-z][0-9A-Za-z\-]{1,63})\.([A-Za-z]{3})(\/.*)?$/', $store_url_arr[1], $matches)) {
											$store['Store']['url'] =  $matches[3] . '.' . $matches[4];
										} else {
											$store['Store']['url'] = parse_url($store_url_arr[1], PHP_URL_HOST);
											$store['Store']['url'] = str_replace('www.', '', $store['Store']['url']);
										}
										$store_name = explode('.', $store['Store']['url']);
										$store['Store']['name'] = ucfirst($store_name[0]);
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
										$store['Store']['affiliate_site_id'] = ConstAffiliateSites::ConnectCommerce;
										$coupon['Coupon']['store_id'] = $this->Affiliate->_storeLookup($this->Coupon, $store);
										$this->Coupon->create();
										$this->Coupon->save($coupon);
									}
								}
							}
						}
						fclose($ch);
						@unlink($local_txt_file);
					}
				}
				ftp_delete($conn_id, $server_zip_file);
			}
		}
		ftp_close($conn_id);
		return true;
    }
}
?>
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

abstract class AbstractConsumer {
	private $consumerKey = null;
	private $consumerSecret = null;
	
	public function __construct($consumerKey, $consumerSecret) {
		$this->consumerKey = $consumerKey;
		$this->consumerSecret = $consumerSecret;
	}
	
	final public function getConsumer() {
		return new OAuthConsumer($this->consumerKey, $this->consumerSecret);
	}
}
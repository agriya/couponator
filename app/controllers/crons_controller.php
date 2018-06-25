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
class CronsController extends AppController
{
    public $name = 'Crons';
	public $components = array(
		'Cron',
    );
    public function main()
	{
		$this->Cron->main();
        $this->autoRender = false;
		if (!empty($_GET['f'])) {
            $this->Session->setFlash(__l('Coupon and user status updated successfully'), 'default', null, 'success');
            $this->redirect(Router::url('/', true) . $_GET['f']);
        }
    }
    public function affiliates()
	{
		$this->Cron->affiliates();
        $this->autoRender = false;
		if (!empty($_GET['f'])) {
            $this->Session->setFlash(__l('Coupons imported from affiliate sites successfully'), 'default', null, 'success');
            $this->redirect(Router::url('/', true) . $_GET['f']);
        }
    }
}
?>
<?php
/* SVN FILE: $Id: admin.ctp 1240 2009-12-23 11:33:56Z arivuchelvan_086at09 $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo $this->Html->cText($title_for_layout, false);?></title>
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
		echo $this->Html->css('default.cache', null, array('inline' => true));
		$js_inline = "document.documentElement.className = 'js';";
		$js_inline .= 'var cfg = ' . $this->Javascript->object($js_vars_for_layout) . ';';
		$js_inline .= "(function() {";
		$js_inline .= "var js = document.createElement('script'); js.type = 'text/javascript'; js.async = true;";
		if (!$_jsPath = Configure::read('cdn.js')) {
			$_jsPath = Router::url('/', true);
		}
		$js_inline .= "js.src = \"" . $_jsPath . 'js/default.cache.js' . "\";";
		$js_inline .= "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(js, s);";
		$js_inline .= "})();";
		echo $this->Javascript->codeBlock($js_inline, array('inline' => true));
	?>
</head>
<body class="iframe-info">
	<div id="index" class="content">
		<div id="header" class="iframe-header">
			<div class="header-content container_12 clearfix">
				<h1 class="logo1 grid_left"> <a href="<?php echo Router::url('/',true); ?>" target="_parent"><?php echo Configure::read('site.name'); ?></a></h1>
				<div class="header-right grid_right clearfix">
					<p><?php echo __l('Did this coupon work? Don\'t forget to use it. "Click I Got It" if its worked!'); ?></p>
					<div class="get">
						<a href="#" class="{'id':'<?php echo $coupon['Coupon']['id'];?>'}" id="getCoupon"><?php echo __l('i got it'); ?></a>
					</div>
					<a id="close_link" href="http://<?php echo $coupon['Store']['url']; ?>" target="_parent"><img alt="Close" src="./img/close_frame.png" title="Close frame" width="18" height="18"></a>
				</div>
			</div>
				</div>
			<div id="main" class="clearfix">
				<?php echo $content_for_layout; ?>
			</div>
	
	</div>
</body>
</html>
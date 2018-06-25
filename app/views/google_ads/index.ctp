<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<?php
if (!empty($googleAds)):?>
<div class="codes-block">
<?php

$i = 0;
foreach ($googleAds as $googleAd):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	 
	<p><?php echo $googleAd['GoogleAd']['content'];?></p>
	<?php
	endforeach;
?> 
</div> 
<?php
endif;
?>
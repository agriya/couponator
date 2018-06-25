<?php /* SVN: $Id: index_simple.ctp 2959 2010-01-29 07:21:27Z bharathdayal_092at09 $ */ ?>
 <div class="store-block">
        <div class="store-left">
          <div class="store-right">
            <div class="store-center">
              <h2><?php echo __l('Popular Stores'); ?></h2>
              <div class="store-img-block clearfix">
                <ol class="stores-list clearfix gallery" id="mycarousel">
				<?php
if (!empty($stores)):

$i = 0;
foreach ($stores as $store):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$store['Attachment'] = !empty($store['Attachment']) ? $store['Attachment'] : array();
?>
						  <li><?php echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?>
						  <h3><?php echo $this->Html->link($this->Html->cText($store['Store']['url'], false), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?></h3>

						  </li>
					<?php
			endforeach;
		else:
		?>
			<li class="notice">
				<p><?php echo __l('No Stores available');?></p>
			</li>
		<?php
		endif;
		?>
                </ol>
                 </div>
              <div class="store-bottom"> </div>
            </div>
          </div>
        </div>
      </div>
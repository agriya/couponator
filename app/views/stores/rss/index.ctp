<?php /* SVN: $Id: index.ctp 12757 2010-07-09 15:01:40Z jayashree_028ac09 $ */ ?>
	<?php if(!empty($stores)): ?>
            <?php
				foreach($stores as $store):
                  echo $this->Rss->item(array() , array(
                            'title' => $store['Store']['name'],
                            'link' => array(
                                'controller' => 'stores',
                                'action' => 'view',
                                $store['Store']['slug']
                            ) ,
                          'description' => $store['Store']['description']
                        ));
            	endforeach;
			?>
    <?php endif; ?>
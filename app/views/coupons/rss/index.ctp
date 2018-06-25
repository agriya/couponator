<?php /* SVN: $Id: index.ctp 12757 2010-07-09 15:01:40Z jayashree_028ac09 $ */ ?>
	<?php if(!empty($coupons)): ?>
            <?php
				foreach($coupons as $coupon):
                  echo $this->Rss->item(array() , array(
                            'title' => $coupon['Store']['name'],
                            'link' => array(
                                'controller' => 'stores',
                                'action' => 'view',
                                $coupon['Store']['slug']
                            ) ,
                          'description' => $coupon['Coupon']['description']
                        ));
            	endforeach;
			?>
    <?php endif; ?>
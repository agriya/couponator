 <?php
// print_r($this->request->params);
if(empty($this->request->params['named']['display'])):
 if(isset($type)):
 ?>
 <div class="monitor-block coupon-codes-block">
        <div class="store-left">
          <div class="store-right">
            <div class="store-center coupon-center">
            <h2><?php echo __l('Latest'); ?> <?php echo $store['Store']['url']; ?> <?php echo __l('Coupons Via Email'); ?></h2>
            <div class="offer-inner monitor-inner">
              <p><?php echo __l('Receive an email when new');?> <?php echo $store['Store']['url']; ?> <?php echo __l('coupons are added (it&acute;s cool, we hate spam too):');?></p>
             <?php echo $this->Form->create('Subscription', array('class' => 'monitor clearfix'));?>
				<div class="js-overlabel">
				<?php echo $this->Form->input('email', array('label' => __l('Enter Your Email'))); ?>
				</div>
				<?php echo $this->Form->input('store_id',array('type' => 'hidden', 'value' => $this->request->data['Subscription']['store_id']));
					echo $this->Form->input('store_slug',array('type' => 'hidden', 'value' => $this->request->data['Subscription']['store_slug'])); ?>
					<div class="submit-block clearfix">
               <?php echo $this->Form->submit(__l('Monitor'));?>
			   </div>
             <?php echo $this->Form->end();?>
            </div>
            </div>
            <div class="coupon-bottom"></div>
          </div>
        </div>
      </div>
 <?php else: ?>
 <div class="newsletter-block clearfix">
        <h3><?php echo __l('Get our newsletter'); ?></h3>
        <div class="newsletter-inner clearfix">
		<?php echo $this->Form->create('Subscription', array('class' => 'subscription clearfix'));?>
		<div class="js-overlabel ">
		 <?php echo $this->Form->input('email',array('label' =>__l('Enter Your Email'))); ?>
		</div>
		<div class="submit-block clearfix">
		 <?php echo $this->Form->submit(__l('Get It'));?>
		 </div>
             <?php echo $this->Form->end();?>
          <p class="privacy-link"><?php echo __l('Don\'t worry, your email is safe and secure with us.');
		 ?></p>
        </div>
      </div>
<?php endif; ?>
<?php else: ?>
<div class="newsletter-block clearfix">
    <h3><?php echo __l('Hot Coupons Newsletter');?></h3>
        <div class="newsletter-inner clearfix">
		 <p><?php echo __l('Receive a weekly email featuring the best coupon codes as voted by the users of ').Configure::read('site.name').__l(':');?></p>
		<?php echo $this->Form->create('Subscription', array('class' => 'subscription clearfix'));?>
		 <?php echo $this->Form->input('email',array('label' =>false,'value'=>'Enter Your Email')); ?>
		 <div class="submit-block clearfix">
		 <?php echo $this->Form->submit(__l('Get It'));?>
		 </div>
             <?php echo $this->Form->end();?>
        <p><?php echo __l('Subscription is free, you can unsubscribe at any time and we will never use your email address for any other purpose.');?></p>
        </div>
      </div>


<?php endif; ?>

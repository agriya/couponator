<?php /* SVN: $Id: unsubscribe.ctp 12596 2010-07-09 09:41:14Z boopathi_026ac09 $ */ ?>
<?php echo $this->Form->create('Subscription', array('url'=>array('action'=>'unsubscribe'),'class' => 'normal'));?>
	<fieldset>
	<div class="store-left">
          <div class="store-right">
    	<h2><?php echo __l('Manage Your Subscription'); ?></h2>
		<div class="offer-inner monitor-inner">
        <div class="wallet-amount-block">
		<h3>
			<?php 
                echo __l('Are sure you want to unsubscribe?');
                echo $this->Form->input('id',array('type' => 'hidden'));
            ?>
			</h3>
        </div>
	<div class="submit-block unsubscrib-submit-block clearfix">
		<?php echo $this->Form->submit(__l('Unsubscribe'), array('title' => __l('Unsubscribe'))); ?>
        <div class="cancel-block">
            <?php echo $this->Html->link(__l('Oops, i changed my mind'), array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'cancel-button', 'title' => __l('Oops, i changed my mind'))); ?>
        </div>
    </div>
    <?php echo $this->Form->end();?>
	</div>
	</div>
	</div>
	<div class="coupon-bottom"></div>
	</fieldset>
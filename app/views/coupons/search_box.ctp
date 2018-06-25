<?php
	if(!empty($this->request->params['named']['view'])  && $this->request->params['named']['view'] =='print'):
		$what = !empty($this->request->params['named']['what'])?$this->request->params['named']['what']:'';
		$where=!empty($this->request->params['named']['where'])?$this->request->params['named']['where']:'';
		if(isset($this->request->params['named']['what'])){
			$what = $this->request->params['named']['what'];
		}
		if(isset($this->request->params['named']['where'])){
			$where = $this->request->params['named']['where'];
		}

?>
<div class="search-form-block grid_7 grid_right omega alpha clearfix">
	<div class="form-tl">
		<div class="form-tr">
			<div class="form-tm"> </div>
		</div>
	</div>
	<div class="form-cm clearfix">
		<?php echo $this->Form->create('Coupon' , array('class ' => 'monitor clearfix search-monitor', 'action' => 'index', 'id'=>"CouponLstFormTop")); ?>
			<div class="search-left-block">
				<div class="clearfix">
					<?php
						echo $this->Form->input('what', array('label' => __l('What'), 'type' => 'text', 'value' => $what));
						echo $this->Form->input('where', array('label' => __l('Where'), 'type' => 'text', 'value' => $where));
					?>
				</div>
				<p><?php echo __l('e.g.Pizza'); ?> 	<span class="info-coupon"><?php echo __l('e.g 92630 or houston'); ?></span></p>
			</div>
			<div class="search-button-block">
				<?php echo $this->Form->submit(__l('Search'));?>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="form-bl">
		<div class="form-br">
			<div class="form-bm"> </div>
		</div>
	</div>
	<div class="form-shadow"></div>
</div>
<?php else:
?>
<div class="search-form-block grid_7 omega grid_right alpha clearfix">
	<div class="form-tl">
		<div class="form-tr">
			<div class="form-tm"> </div>
		</div>
	</div>
	<?php $store_count = $this->Html->Storeactivecount(); ?>
		<div class="form-cm clearfix">
			<?php
				$overlabel = __l('Search coupon codes for ').$store_count.__l(' stores...');
				$keyword = '';
				$class = '';
				if(!empty($this->request->params['named']['keyword']))
				{  
					$this->request->data['Coupon']['keyword'] = $this->request->params['named']['keyword'];
					$class = 'label-hide';
				}
			?>
			<?php echo $this->Form->create('Coupon' , array('class ' => 'search clearfix', 'action' => 'lst')); ?>
				<div class="js-overlabel <?php echo $class; ?>">
					<?php echo $this->Form->input('keyword', array('label'=>$overlabel,'type' => 'text')); ?>
				</div>
				<?php echo $this->Form->submit(__l('Search'));?>
			<?php echo $this->Form->end(); ?>
			<div class="clearfix">
			<h5 class="search-info"><?php echo __l('e.g.');?></h5>
			<ul class="search-list">
				<?php foreach($search as $key => $value) { ?>
					<li><a href="<?php echo $value;?>"><?php echo ucfirst($key); ?></a></li>
				<?php } ?>
			</ul>
			</div>
		</div>
		<div class="form-bl">
			<div class="form-br">
				<div class="form-bm"> </div>
			</div>
		</div>
	<div class="form-shadow"></div>
</div>
<?php endif; ?>